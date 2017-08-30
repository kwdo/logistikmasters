<?php
	/**
	 * Routes configuration
	 *
	 * In this file, you set up routes to your controllers and their actions.
	 * Routes are very important mechanism that allows you to freely connect
	 * different urls to chosen controllers and their actions (functions).
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
	 * @package       app.Config
	 * @since         CakePHP(tm) v 0.2.9
	 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
	 */
	/**
	 * Here, we are connecting '/' (base path) to controller called 'Pages',
	 * its action called 'display', and we pass a param to select the view file
	 * to use (in this case, /app/View/Pages/home.ctp)...
	 */
	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
	Router::connect('/wettbewerb', array('controller' => 'pages', 'action' => 'display', 'wettbewerb'));
    Router::connect('/preise', array('controller' => 'pages', 'action' => 'display', 'preise'));
    Router::connect('/faq', array('controller' => 'pages', 'action' => 'display', 'faq'));
	Router::connect('/hochschulen', array('controller' => 'pages', 'action' => 'display', 'hochschulen'));
    Router::connect('/teilnahmebedingungen', array('controller' => 'pages', 'action' => 'display', 'teilnahmebedingungen'));
    Router::connect('/regeln-und-punktevergabe', array('controller' => 'pages', 'action' => 'display', 'regeln'));
	Router::connect('/hochschulranking', array('controller' => 'pages', 'action' => 'display', 'hochschulranking'));
	Router::connect('/professoren', array('controller' => 'pages', 'action' => 'display', 'professoren'));
	Router::connect('/sponsoren', array('controller' => 'pages', 'action' => 'display', 'sponsoren'));
	Router::connect('/loesungen-aller-wettbewerbe', array('controller' => 'pages', 'action' => 'display', 'loesungen-aller-wettbewerbe'));
	Router::connect('/admin', array('controller' => 'forms', 'action' => 'index', 'admin' => true));
	Router::connect('/registrieren', array('controller' => 'users', 'action' => 'add', 'admin' => false));
	Router::connect('/forum/help/*', array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'help'));
	Router::connect('/forum/rules/*', array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'rules'));
	Router::connect('/admin/forum/settings/*', array('plugin' => 'forum', 'controller' => 'forum', 'action' => 'settings', 'admin' => true));
	Router::connect('/katalog2013', array('controller' => 'users', 'action' => 'index', null, 13));
    Router::connect('/katalog2014', array('controller' => 'users', 'action' => 'index', null, 14));
	Router::connect('/katalog2015', array('controller' => 'users', 'action' => 'index', null, 15));
	Router::connect('/katalog2015classic', array('controller' => 'users', 'action' => 'index', null, 15, 'classic' => true));
	Router::connect('/katalog2016', array('controller' => 'users', 'action' => 'index', null, 16));

    Router::parseExtensions('rss');
	/**
	 * ...and connect the rest of 'Pages' controller's urls.
	 */
	Router::connect('/pages/*', array('controller' => 'pages', 'action' => 'display'));

	/**
	 * Load all plugin routes.  See the CakePlugin documentation on
	 * how to customize the loading of plugin routes.
	 */
	CakePlugin::routes();

	/**
	 * Load the CakePHP default routes. Remove this if you do not want to use
	 * the built-in default routes.
	 */
	require CAKE . 'Config' . DS . 'routes.php';
