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
    public $components = ['Utility'];

    public function initialize()
    {
        parent::initialize();
        $this->_setTextVariables();
        $this->Auth->allow([
            'confirmation',
            'registration',
            'recoveryEmail',
            'resetPassword'
        ]);
    }

    public function registration()
    {
        $this->_userForm();
    }

    public function login()
    {
        $this->set('scr', true);
        if ($this->is_logged) {
            $this->redirect($this->Auth->redirectUrl());
        } else {
            /* login functions */
            if ($this->request->is('post')) {
                $data = $this->request->data;
                if (isset($data['g-recaptcha-response'])) {
                    $captcha = $data['g-recaptcha-response'];
                    $ip = $this->request->clientIp();
                    if ($this->_checkRecaptcha($captcha, $ip)) {
                        $user = $this->Auth->identify();
                        if ($user) {
                            if ($user['status_id'] === 1) {
                                $this->Auth->setUser($user);

                                /* redirect after login */
                                $this->redirect($this->Auth->redirectUrl());
                            } else {
                                $this->showAlert('warning', 'Utente non attivo!');
                            }
                        } else {
                            $this->showAlert('danger', 'Username o Password errati!');
                        }
                    } else {
                        $this->redirect('https://www.google.ru/');
                    }
                } else {
                    $this->showAlert('danger', 'reCaptcha Error!');
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

    public function profile()
    {
        if ($this->is_logged) {
            $user = $this->current_user;
            $this->set('user', $user);
        } else {
            $this->redirect($this->app_root);
        }
    }

    public function recoveryEmail()
    {
        if ($this->request->is('post')) {
            $data = $this->request->data;
            if (isset($data['g-recaptcha-response'])) {
                $captcha = $data['g-recaptcha-response'];
                $ip = $this->request->clientIp();
                if ($this->_checkRecaptcha($captcha, $ip)) {
                    $check_exist_user = $this->_userExistByEmail(trim($data['email']));
                    if ($check_exist_user) {
                        if ($this->users_table->setRecoveryTokenByEmail(trim($data['email']), $this->Utility->getRandomString(50), $this->reset_password_token_expiration)) {
                            $user = $this->users_table->getByEmail(trim($data['email']));
                            if ($this->_sendResetPasswordEmail($user['email'], $user['first_name'], $user['reset_password_token'])) {
                                $this->showAlert('success', 'Richiesta reset password andata abuon fine. Controla email');
                            }
                        }
                    } else {
                        $this->showAlert('danger', 'Indirizzo email non valido! Per favore, verifica di averlo scritto correttamente.');
                    }
                } else {
                    $this->redirect('https://www.google.ru/');
                }
            } else {
                $this->showAlert('danger', 'reCaptcha Error!');
            }
        }
    }

    public function resetPassword()
    {

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
                    $entity->token = $this->Utility->getRandomString(50);
                    $entity->confirmation_token = $this->Utility->getRandomString(50);
                    $entity->confirmation_token_expiration = time() + $this->confirmation_token_expiration;
                } else {
                    $this->showAlert('warning', 'Utente con questo email è gia registrato (UsersController LINE: 127)');
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

    private function _checkRecaptcha($captcha = null, $ip = null)
    {
        $result = false;
        $response = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=" . $this->reCAPTCHA_secret_key . "&response=" . $captcha . "&remoteip=" . $ip);
        $responseKeys = json_decode($response, true);
        $this->set('alert_c', $response);
        if ($responseKeys['success'] == true && $responseKeys['score'] > 0.5) {
            $result = true;
        }
        return $result;
    }

    private function _sendConfirmationEmail($to = null, $name = null, $confirmation_token = null)
    {
        $subject = t('Conferma registrazione - ' . $this->app_name);
        $from = $this->app_email;
        $layout = 'default';
        $template = 'user_confirmation';
        $content_lines[] = 'Ciao ' . $name . ',';
        $content_lines[] = 'Per confermare email vai a <a href="' . $this->https_domain . $this->app_root . 'users/confirmation/' . $confirmation_token . '">link</a>';
        $content_lines[] = 'Atenzione link valido <b>' . $this->confirmation_token_expiration / 3600 . ' </b> ore.';

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

    private function _sendResetPasswordEmail($to = null, $name = null, $token = null)
    {
        $subject = t('Reset Password - ' . $this->app_name);
        $from = $this->app_email;
        $layout = 'default';
        $template = 'user_confirmation';
        $content_lines[] = 'Ciao ' . $name . ',';
        $content_lines[] = 'Per resetare la password vai a <a href="' . $this->https_domain . $this->app_root . 'users/reset-password/' . $token . '">link</a>';
        $content_lines[] = 'Atenzione link valido <b>' . $this->reset_password_token_expiration / 3600 . ' </b> ore.';

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
        /* General */
        $this->set('text_first_name', t('Nome'));
        $this->set('text_last_name', t('Cognome'));

        /* Confirmation text */
        $this->set('text_user_confirmation_success', t('text utente confirmato con sucesso (UsersController LINE: 143)'));
        $this->set('text_user_confirmation_success_title', t('text utente confirmato con sucesso (UsersController LINE: 144)'));
        $this->set('text_user_confirmation_no_user', t('Text per utente non trovato o gia confirmato o scaduto il link (UsersController LINE: 145)'));
        $this->set('text_user_confirmation_no_user_title', t('Text per utente non trovato o gia confirmato (UsersController LINE: 146)'));
        $this->set('text_user_confirmation_need_confirm', t('text: Vai su email e clichi il link; Atenzione link valido ' . $this->confirmation_token_expiration / 3600 . ' ore; se hai gia confirmato fai login <a href="' . $this->app_root . 'users/login"><b>QUI</b></a> (UsersController LINE: 147)'));
        $this->set('text_user_confirmation_need_confirm_title', t('text (UsersController LINE: 148)'));

        /* Recovery password text */
        $this->set('text_button_recovery', t('Invia richiesta'));
        $this->set('text_password_forgotten', t('Password dimenticata?'));
        $this->set('text_reset_password', t('Richiesta recupero password'));
        $this->set('text_token_status_false', t('Link non è valido o scaduto! <br>Si prega di fare una nuova richiesta'));
        $this->set('text_modal_email_error_text', t('Indirizzo email non valido! Per favore, verifica di averlo scritto correttamente.'));
    }
}