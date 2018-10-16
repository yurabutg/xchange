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
    }

    public function index()
    {
        /**/
    }
}