<?php

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Mailer\Email;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use GoogleAuthenticator;

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
        $this->Auth->allow([
            'confirmation',
            'registration'
        ]);
    }

    public function profile()
    {
        if ($this->is_logged) {
            $user = $this->current_user;
            $this->set('user', $user);
        } else {
            $this->redirect($this->app_root);
        }
    }

    public function login()
    {
        $this->viewBuilder()->layout('login_register');
        if ($this->is_logged) {
            $this->redirect($this->Auth->redirectUrl());
        } else {
            /* login functions */
            if ($this->request->is('post')) {
                $user = $this->Auth->identify();
                if ($user) {
                    if ($user['status_id'] === 1) {
                        $this->Auth->setUser($user);

                        /* redirect after login */
                        $this->redirect($this->Auth->redirectUrl());
                    } else {
                        $this->set('error_msg', t('Utente non attivo!'));
                    }
                } else {
                    $this->set('error_msg', t('Username o Password errati!'));
                }
            } /* password recovery functions */
            else if ($this->request->is('post') && isset($this->request->data['btn-recovery'])) {
                if (isset($this->request->data['recovery_email']) && $this->request->data['recovery_email'] !== '') {
                    $check_user = $this->users_table->checkByEmail($this->request->data['recovery_email']);
                    if ($check_user !== 0) {
                        $user_array = $this->users_table->getByEmail($this->request->data['recovery_email']);
                        $user_entity = $this->users_table->get($user_array['id']);
                        $user_entity->temp_pass = $this->_randomPass(8);
                        $user_entity->password = $user_entity->temp_pass;
                        if ($this->users_table->save($user_entity)) {
                            $email_data = [
                                $user_array['user_info']['email'],
                                $user_array['user_info']['fullname'],
                                $user_array['username'],
                                $user_entity->temp_pass
                            ];
                            $this->_sendPasswordRecoveryEmail($email_data[0], $email_data[1], $email_data[2], $email_data[3]);
                            $this->set('success_msg', t('Recupero Password effettuato con successo!<br />A breve riceverai una mail con le tue nuove credenziali.'));
                        }
                    } else {
                        $this->set('error_msg', t('<span class="recovery-error-msg">E-mail specificata non registrata!</span>'));
                    }
                } else {
                    $this->set('error_msg', t('<span class="recovery-error-msg">Inserisci una mail valida!</span>'));
                }
            }
        }
    }

    public function logout()
    {
        $this->viewBuilder()->layout(false);
        $this->Auth->logout();
        $this->redirect($this->app_root);
    }

    public function registration()
    {
        $this->viewBuilder()->layout('login_register');
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

                // check user exist by email before saving
                $check_exist_user = $this->_userExistByEmail(trim($data['email']));
                if (!is_null($token)) {
                    $entity = $this->users_table->getEntityByToken($token);
                    // TODO: $this->users_table->getEntityByToken();
                } else if (is_null($token) && $check_exist_user == false) {
                    $entity = $this->users_table->newEntity();
                    $entity->token = $this->getRandomString(50);
                    $entity->confirmation_token = $this->getRandomString(50);
                } else {
//                    $this->redirect(['controller' => 'users', 'action' => 'login']);
                    $this->set('show_user_exist_alert', true);
                    return;
                }
                $entity->first_name = $data['first_name'];
                $entity->last_name = $data['last_name'];
                $entity->email = trim($data['email']);
                $entity->password = trim($data['password']);

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

    private function _userExistByEmail($email = null)
    {
        $result = false;
        if (!is_null($email)) {
            $result = $this->users_table->userExistByEmail($email);
        }
        return $result;
    }

    public function confirmation($confirmation_token = null)
    {
        $confirmation_result = 0;
        if (!is_null($confirmation_token)) {
            if ($this->users_table->confirmUserByConfirmationToken($confirmation_token)) {
                $confirmation_result = 1;
            } else {
                $confirmation_result = 2;
            }
        }
        $this->set('confirmation_result', $confirmation_result);
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
        $this->set('text_user_exist_alert', t('<b>Error Alert:</b> UTENTE CON QUESTO EMAIL GIA REGISTART0 (UsersController LINE: 142)'));
        $this->set('text_user_confirmation_success', t('text utente confirmato con sucesso (UsersController LINE: 143)'));
        $this->set('text_user_confirmation_success_title', t('text utente confirmato con sucesso (UsersController LINE: 144)'));
        $this->set('text_user_confirmation_no_user', t('Text per utente non trovato o gia confirmato (UsersController LINE: 145)'));
        $this->set('text_user_confirmation_no_user_title', t('Text per utente non trovato o gia confirmato (UsersController LINE: 146)'));
        $this->set('text_user_confirmation_need_confirm', t('text: Vai su email e clichi il link; Atenzione link valido 24 ore; se hai gia confirmato fai login <a href="' . $this->app_root . 'users/login"><b>QUI</b></a> (UsersController LINE: 147)'));
        $this->set('text_user_confirmation_need_confirm_title', t('text (UsersController LINE: 148)'));
        $this->set('text_scan_qr', t('1) Scansiona QR codice'));
        $this->set('text_confirm_qr', t('2) Inserisci codece di conferma'));
        $this->set('text_2fa_code', t('Codece di conferma'));
    }
}