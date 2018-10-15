<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');

        $this->_setTableVariables();
        $this->_setVariables();
        $this->_setTextVariables();
    }


    private function _setTableVariables()
    {
        $this->users_table = TableRegistry::get('Users');
    }

    private function _setVariables()
    {
        $this->app_root = $this->getConfig('app_root');
        $this->app_name = $this->getConfig('app_name');
        $this->app_email = $this->getConfig('app_email');
        $this->app_owner = $this->getConfig('app_owner');
        $this->https_domain = $this->getConfig('https_domain');
        $this->app_text_footer = $this->getConfig('app_text_footer');
        $this->app_version = $this->getConfig('app_version');
        $this->app_logo_big = $this->getConfig('app_logo_big');
        $this->app_logo_medium = $this->getConfig('app_logo_medium');
        $this->app_logo_small = $this->getConfig('app_logo_small');
        $this->app_logo_name_big = $this->getConfig('app_logo_name_big');
        $this->app_logo_name_medium = $this->getConfig('app_logo_name_medium');
        $this->app_logo_name_small = $this->getConfig('app_logo_name_small');

        $this->current_controller = $this->request->getParam('controller');
        $this->current_action = $this->request->getParam('action');

        $this->set('app_root', $this->app_root);
        $this->set('app_name', $this->app_name);
        $this->set('app_email', $this->app_email);
        $this->set('app_owner', $this->app_owner);
        $this->set('https_domain', $this->https_domain);
        $this->set('app_text_footer', $this->app_text_footer);
        $this->set('app_version', $this->app_version);
        $this->set('app_logo_big', $this->app_logo_big);
        $this->set('app_logo_medium', $this->app_logo_medium);
        $this->set('app_logo_small', $this->app_logo_small);
        $this->set('app_logo_name_big', $this->app_logo_name_big);
        $this->set('app_logo_name_medium', $this->app_logo_name_medium);
        $this->set('app_logo_name_small', $this->app_logo_name_small);

        $this->set('current_controller', $this->current_controller);
        $this->set('current_action', $this->current_action);

        /* date configurations */
        $this->date_format = Configure::read('date_format');
        $this->date_format_for_db = Configure::read('date_format_for_db');

        $this->set('date_format', $this->date_format);
        $this->set('date_format_for_db', $this->date_format_for_db);
    }

    private function _setTextVariables()
    {
        $this->set('text_user', 'Utente');
        $this->set('text_password', 'Password');
        $this->set('text_login', 'Login');
        $this->set('text_logout', 'Logout');
        $this->set('text_email', 'Email');
        $this->set('text_save', 'Salva');
        $this->set('text_cancel', 'Annulla');
        $this->set('text_confirm', t('Conferma'));
        $this->set('text_login', t('Accedi'));
        $this->set('text_registration', t('Registrati'));

        /* days text */
        $this->text_week_mo = t('Lu');
        $this->text_week_monday = t('Lunedì');
        $this->text_week_tu = t('Ma');
        $this->text_week_tuesday = t('Martedì');
        $this->text_week_we = t('Me');
        $this->text_week_wednesday = t('Mercoledì');
        $this->text_week_th = t('Gi');
        $this->text_week_thursday = t('Giovedì');
        $this->text_week_fr = t('Ve');
        $this->text_week_friday = t('Venerdì');
        $this->text_week_sa = t('Sa');
        $this->text_week_saturday = t('Sabato');
        $this->text_week_su = t('Do');
        $this->text_week_sunday = t('Domenica');
        $this->set('text_week_mo', $this->text_week_mo);
        $this->set('text_week_monday', $this->text_week_monday);
        $this->set('text_week_tu', $this->text_week_tu);
        $this->set('text_week_tuesday', $this->text_week_tuesday);
        $this->set('text_week_we', $this->text_week_we);
        $this->set('text_week_wednesday', $this->text_week_wednesday);
        $this->set('text_week_th', $this->text_week_th);
        $this->set('text_week_thursday', $this->text_week_thursday);
        $this->set('text_week_fr', $this->text_week_fr);
        $this->set('text_week_friday', $this->text_week_friday);
        $this->set('text_week_sa', $this->text_week_sa);
        $this->set('text_week_saturday', $this->text_week_saturday);
        $this->set('text_week_su', $this->text_week_su);
        $this->set('text_week_sunday', $this->text_week_sunday);
        /* months text */
        $this->months = [
            '01' => t('Gennaio'),
            '02' => t('Febbraio'),
            '03' => t('Marzo'),
            '04' => t('Aprile'),
            '05' => t('Maggio'),
            '06' => t('Giugno'),
            '07' => t('Luglio'),
            '08' => t('Agosto'),
            '09' => t('Settembre'),
            '10' => t('Ottobre'),
            '11' => t('Novembre'),
            '12' => t('Dicembre'),
        ];
        $this->months_days = [
            '01' => '31',
            '02' => '29',
            '03' => '31',
            '04' => '30',
            '05' => '31',
            '06' => '30',
            '07' => '31',
            '08' => '31',
            '09' => '30',
            '10' => '31',
            '11' => '30',
            '12' => '31',
        ];
        $this->set('months_names', $this->months);
        foreach ($this->months as $i => $month) {
            $this->set('text_month_' . $i, $month);
        }
    }

    public function getConfig($name)
    {
        return Configure::read($name);
    }

    public function setConfig($name, $value)
    {
        return Configure::write($name, $value);
    }

    public function getError404()
    {
        throw new \Cake\Network\Exception\NotFoundException(t('404'));
    }

    public function isAuthorized($user)
    {
        return true;
    }

    public function getRandomString($length)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-><!?_=&%$£€;.,';
        $token = '';

        if (!is_null($length)) {
            while (strlen($token) <= $length)
            {
                $randstring = '';
                for ($i = 0; $i < $length; $i++) {
                    $randstring .= $characters[rand(0, strlen($characters) - 1)];
                }
                $randstring = substr($randstring, 0, $length);
                $token .= sha1(md5($randstring));
            }

            if (strlen($token) > $length)
            {
                $token = substr($token, 0, $length);
            }
        }
        return $token;
    }
}
