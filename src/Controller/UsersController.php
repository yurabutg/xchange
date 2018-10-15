<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class UsersController extends AppController
{
    public function initialize()
    {
        parent::initialize();
        $this->_setTextVariables();
    }

    public function login()
    {
        /**/
    }

    public function registration()
    {
        $this->_userForm();
    }

    private function _userForm($token = null)
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (isset($data['first_name']) && !empty($data['first_name']) && !is_null($data['first_name']) &&
                isset($data['last_name']) && !empty($data['last_name']) && !is_null($data['last_name']) &&
                isset($data['email']) && !empty($data['email']) && !is_null($data['email']) &&
                isset($data['password']) && !empty($data['password']) && !is_null($data['password'])) {
                //TODO: add check user exist by email before saving
                if (!is_null($token)) {
                    $entity = $this->users_table->getEntityByToken($token);
                    // TODO: $this->users_table->getEntityByToken();
                } else {
                    $entity = $this->users_table->newEntity();
                    $entity->token = $this->getRandomString(50);
                    $entity->confirmation_token = $this->getRandomString(50);
                }
                $entity->first_name = $data['first_name'];
                $entity->last_name = $data['last_name'];
                $entity->email = $data['email'];
                $entity->password = $data['password'];

                if ($this->users_table->save($entity)) {
                    if (is_null($token)) {
                        if ($this->_sendConfirmationEmail($entity->email, $entity->first_name . ' ' . $entity->last_name, $entity->confirmation_token)) {
                            $this->redirect(['controller' => 'users', 'action' => 'confirmation']);
                        }//TODO: esle set email send error
                    } else {
                        $this->redirect($this->app_root);
                    }

                } // TODO: set error save user
            }
        }
    }

    public function confirmation($confirmation_token = null)
    {
        if (!is_null($confirmation_token)) {
            echo $confirmation_token;
        }
    }

    private function _sendConfirmationEmail($to = null, $name = null, $confirmation_token = null)
    {
        $subject = t('Conferma registrazione - ' . $this->app_name);
        $from = $this->app_email;
        $layout = 'default';
        $template = 'user_confirmation';
        $content_lines[] = 'Ciao ' . $name . ',';
        $content_lines[] = 'Per confermare email vai a <a href="' . $this->https_domain . $this->app_root . 'users/confirmation/' . $confirmation_token . '">link</a>';

        $regards_lines[] = 'Saluti,';
        $regards_lines[] = '<em>Lo Staff</em>';

        $return = false;
        $variables = [
            'title_for_layout' => $subject,
            'logo' => $this->https_domain . $this->logo,
            'app_name' => $this->app_name,
            'content_lines' => $content_lines,
            'regards_lines' => $regards_lines
        ];
        if (!is_null($to)) {
            $email = new Email();
            $email->template($template, $layout)
                ->helpers(['Html'])
                ->emailFormat('html')
                ->viewVars($variables)
                ->subject($subject)
                ->to($to)
                ->from($from)
                ->send();
            $return = true;
        }
        return $return;
    }

    private function _setTextVariables()
    {
        $this->set('text_first_name', t('Nome'));
        $this->set('text_last_name', t('Cognome'));
    }
}