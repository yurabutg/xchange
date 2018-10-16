<?php

namespace App\Controller;

use Cake\Core\Configure;
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
class HomesController extends AppController
{

    public function initialize()
    {
        parent::initialize();
        $this->Auth->allow([
            'index'
        ]);

        $this->_setTextVariables();
    }

    public function index()
    {
        $crypto_currencys = $this->currencys_table->getByCurrencyTypeName('crypto');
        $fiat_currencys = $this->currencys_table->getByCurrencyTypeName('fiat');
        $this->set('crypto_currencys', $crypto_currencys);
        $this->set('fiat_currencys', $fiat_currencys);
    }

    private function _setTextVariables()
    {
        $this->set('text_how_exxchange', t('HomesController LINE: 39
        
        Spiegazioni spiegazioni spiegazioni spiegazioni spiegazioni spiegazioni spiegazioni spiegazioni '));
    }
}