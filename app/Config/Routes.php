<?php

namespace Config;

use CodeIgniter\Debug\Toolbar\Collectors\Routes;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::index');
$routes->get('auth', 'Auth::index');
$routes->get('auth/login', 'Auth::login');

$routes->group('/', ['filter' => 'auth'], function ($routes) {

	$routes->get('auth/logout', 'Auth::logout');

	$routes->get('dashboard', 'Dashboard::index');

	$routes->get('user/profile', 'User::profile');
	$routes->patch('user/(:segment)/changeprofile', 'User::changeProfile/$1');

	$routes->get('user/new', 'User::new');
	$routes->post('user', 'User::create');
	$routes->get('user', 'User::index');
	$routes->get('user/(:segment)/edit', 'User::edit/$1');
	$routes->patch('user/(:segment)', 'User::update/$1');
	$routes->delete('user/(:segment)', 'User::delete/$1');
	$routes->patch('user/(:segment)/changestatus', 'User::changeStatus/$1');
});

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need to it be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
