<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
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
if ($_SERVER['REMOTE_ADDR'] == '213.23.34.42') {
    Configure::write('debug', 2);
}

App::uses('Controller', 'Controller');


/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller
{
    protected $loggedIn = 0;
    protected $email = '';
    public $components = array
    (
        'Session',
        'Cookie',
        'Auth' => array
        (
            'authenticate' => array
            (
                'Authenticate.Cookie' => array
                (
                    'fields' => array
                    (
                        'username' => 'email', // Email statt Username 'username',
                        'password' => 'password'
                    ),
                    'userModel' => 'User',
                    'scope' => array('User.doubleoptin' => 1)
                ),
                'Form' => array
                (
                    'fields' => array
                    (
                        'username' => 'email', // Email statt Username 'username',
                        'password' => 'password'
                    ),
                ),
            ),
            'loginRedirect' => array('controller' => 'forms', 'action' => 'index','admin'=>false),
            'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
            'authorize' => array('Controller'),
            'authError' => 'Zugriff verweigert'
        )
    );




    public function isAuthorized($user)
    {
        if (!$user['doubleoptin']) {
            return false;
        } else {

            // Any registered user can access public functions
            if (empty($this->request->params['admin'])) {
                return true;
            }

            // Only admins can access admin functions
            if (isset($this->request->params['admin'])) {
                return (bool)($user['role'] === 'admin');
            }
            // Default deny
            return false;
        }
    }


    public function beforeFilter()
    {
        $this->Cookie->type('rijndael'); //Enable AES symetric encryption of cookie
        $this->Cookie->path = '/';

        // Admin log in
        if(isset($this->request->params['prefix']) && $this->request->params['prefix'] == 'admin') {
                $this->layout = 'backend';
            $this->loggedIn = $this->Auth->user('id');
            $this->email = $this->Auth->user('email');
            } else {
                $this->loggedIn = $this->Auth->user('id');
                $this->email = $this->Auth->user('email');
        }


        $cookie = $this->Cookie->read('User');
        $here = $this->request->here;
        $dontCheckArray = array(
            '/users/login',
            '/users/logout',
            '/users/login',
            '/users/login',
            '/users/login',

        );

        if (is_array($cookie) && !$this->loggedIn && !in_array($here,$dontCheckArray))
        {
            $this->redirect(array('controller' => 'users', 'action' => 'login'));
        }

        $this->set('loggedIn', $this->loggedIn);
        $this->set('email', $this->email);
        $this->Auth->allow('index', 'view');

     }

    public function beforeRender(){
	    $GLOBALS['controlArticle'] = sixArticleData(1314670);
    }


}
