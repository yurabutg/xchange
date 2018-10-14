<?php

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
//        $this->loadComponent('Auth', [
//            'authorize' => 'Controller',
//            'loginAction' => ['controller' => 'Users', 'action' => 'login'],
//            'loginRedirect' => ['controller' => 'Dashboards', 'action' => 'index'],
//            'storage' => 'Session',
//            'passwordHasher' => 'DefaultPasswordHasher'
//        ]);

        $this->_setTableVariables();
        $this->_setVariables();
//        $this->_setUserVariables();
        $this->_setTextVariables();
    }

    private function _setUserVariables()
    {
        $this->is_logged = false;
        $this->current_user = [];

        if ($this->Auth->user()) {
            $this->is_logged = true;
            $this->current_user = $this->users_table->getById($this->Auth->user()['id']);
        }

        $this->set('is_logged', $this->is_logged);
        $this->set('current_user', $this->current_user);

    }

    private function _setTableVariables()
    {
        $this->users_table = TableRegistry::get('Users');
    }

    private function _setVariables()
    {
        $this->app_root = $this->getConfig('app_root');
        $this->app_name = $this->getConfig('app_name');
        $this->app_owner = $this->getConfig('app_owner');
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
        $this->set('app_owner', $this->app_owner);
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
        $this->set('text_home', t('Dashboard'));
        $this->set('text_users', t('Utenti'));
        $this->set('text_clients', t('Clienti'));
        $this->set('text_licenses', t('Licenze'));
        $this->set('text_modules', t('Moduli'));
        $this->set('text_username', 'Username');
        $this->set('text_password', 'Password');
        $this->set('text_login', 'Login');
        $this->set('text_logout', 'Logout');
        $this->set('text_secret_code', 'Codice Segreto');
        $this->set('text_email', 'Email');
        $this->set('text_add', 'Aggiungi');
        $this->set('text_edit', 'Modifica');
        $this->set('text_delete', 'Elimina');
        $this->set('text_delete_confirmation', 'Conferma Eliminazione');
        $this->set('text_save', 'Salva');
        $this->set('text_cancel', 'Annulla');
        $this->set('text_list', 'Lista');
        $this->set('text_apply', t('Applica'));
        $this->set('text_clear', t('Clear'));
        $this->set('text_from', t('Da'));
        $this->set('text_to', t('A'));
        $this->set('text_copy', t('Copia'));
        $this->set('text_controller', t('Controller'));
        $this->set('text_controllers', t('Controllers'));
        $this->set('text_menu', t('Menu'));
        $this->set('text_submenu', t('Sottomenù'));
        $this->set('text_action', t('Action'));
        $this->set('text_actions', t('Actions'));
        $this->set('text_confirm', t('Conferma'));
        $this->set('text_link', t('Link'));
        $this->set('text_icon_class', t('Icona (Classe CSS)'));
        $this->set('text_client', t('Cliente'));
        $this->set('text_today', t('Oggi'));
        $this->set('text_day', t('Giorno'));
        $this->set('text_yesterday', t('Ieri'));
        $this->set('text_date', t('Data'));
        $this->set('text_date_start', t('Data iniziale'));
        $this->set('text_date_end', t('Data finale'));
        $this->set('text_last_30_days', t('Ultimi 30 giorni'));
        $this->set('text_last_7_days', t('Ultimi 7 giorni'));
        $this->set('text_last_month', t('Mese Scorso'));
        $this->set('text_last_year', t('Anno Scorso'));
        $this->set('text_this_month', t('Questo Mese'));
        $this->set('text_this_year', t('Questo Anno'));;

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
        debug($name);
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
}
