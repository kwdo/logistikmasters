<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('AppController', 'Controller');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link          http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController
{

    /**
     * Controller name
     *
     * @var string
     */
    public $name = 'Pages';

    /**
     * This controller does not use a model
     *
     * @var array
     */
    public $uses = array();

    /**
     * Displays a view
     *
     * @param mixed What page to display
     *
     * @return void
     */
    public function display()
    {
        $path = func_get_args();

        $count = count($path);
        if (!$count)
        {
            $this->redirect('/');
        }

        switch ($path[0])
        {
            case 'home':
                $this->Session->write('Navi', 'Home');
                break;

            case 'wettbewerb':
                $this->Session->write('Navi', 'Wettbewerb');
                break;

            case 'preise':
                $this->Session->write('Navi', 'Preise');
                break;

            case 'teilnahmebedingungen':
                $this->Session->write('Navi', 'Teilnahmebedingungen');
                break;

            case 'faq':
                $this->Session->write('Navi', 'FAQ');
                break;

            case 'loesungen-aller-wettbewerbe':
                $this->Session->write('Navi', 'LOESUNGEN');
                break;

            case 'sponsoren':
                $this->Session->write('Navi', 'Sponsoren');
                $this->layout = 'sponsoren';
                break;

            case 'hochschulen':
                $this->Session->write('Navi', 'Hochschulen');
                break;

            case 'hochschulranking':
                $this->Session->write('Navi', 'Hochschulranking');
                break;

            case 'professoren':
                $this->Session->write('Navi', 'Professoren');
                break;
        }

        $page = $subpage = $title_for_layout = null;

        if (!empty($path[0]))
        {
            $page = $path[0];
        }
        if (!empty($path[1]))
        {
            $subpage = $path[1];
        }
        if (!empty($path[$count - 1]))
        {
            $title_for_layout = Inflector::humanize($path[$count - 1]);
        }


        $this->set(compact('page', 'subpage', 'title_for_layout'));
        $this->render(implode('/', $path));
    }

    /**
     * beforeFilter
     *
     * @param
     *
     * @return void
     */
    public function beforeFilter()
    {
        parent::beforeFilter();
        $this->Auth->allow();
    }

}
