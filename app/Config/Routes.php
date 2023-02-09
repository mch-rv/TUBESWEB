<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

$routes->get('/', 'Auth::login');

$routes->group('Auth', function($routes){
	$routes->get('register', 'Auth::register');
	$routes->post('regprocess', 'Auth::registerprocess');
	$routes->get('login', 'Auth::login');
	$routes->post('logprocess', 'Auth::loginprocess');
	$routes->get('logout', 'Auth::logout');
	
});
$routes->group('Profile', function($routes){
	$routes->get('/(:segment)', 'Users::index/$1');
	$routes->get('/edit/(:segment)', 'Users::edit/$1');
});
$routes->group('ekspedisi', function($routes){
	$routes->get('/', 'Ekspedisi::index');
	$routes->post('/', 'Ekspedisi::index');
	$routes->get('preview/(:segment)', 'Ekspedisi::preview/$1');
	$routes->get('create', 'Ekspedisi::create');
	$routes->post('store', 'Ekspedisi::store');
	$routes->get('edit/(:segment)', 'Ekspedisi::edit/$1');
	$routes->post('update/(:segment)', 'Ekspedisi::update/$1');
	$routes->get('delete/(:num)', 'Ekspedisi::delete/$1');
	$routes->post('import', 'Ekspedisi::import');
	$routes->get('generateword', 'Ekspedisi::generate');
});
$routes->group('masuk', function($routes){
	$routes->get('/', 'Masuk::index');
	$routes->post('/', 'Masuk::index');
	$routes->get('preview/(:segment)', 'Masuk::preview/$1');
	$routes->get('create', 'Masuk::create');
	$routes->post('store', 'Masuk::store');
	$routes->get('edit/(:segment)', 'Masuk::edit/$1');
	$routes->post('update/(:segment)', 'Masuk::update/$1');
	$routes->get('delete/(:num)', 'Masuk::delete/$1');
	$routes->post('import', 'Masuk::import');
	$routes->get('generate', 'Masuk::generate');
});
$routes->group('keluar', function($routes){
	$routes->get('/', 'Keluar::index');
	$routes->post('/', 'Keluar::index');
	$routes->get('preview/(:segment)', 'Keluar::preview/$1');
	$routes->get('create', 'Keluar::create');
	$routes->post('store', 'Keluar::store');
	$routes->get('edit/(:segment)', 'Keluar::edit/$1');
	$routes->post('update/(:segment)', 'Keluar::update/$1');
	$routes->get('delete/(:num)', 'Keluar::delete/$1');
	$routes->post('import', 'Keluar::import');
	$routes->get('generateword', 'Keluar::generate');
	$routes->get('export-pdf','Masuk::exportPDF');
});
$routes->group('Kejadian', function($routes){
	$routes->get('/', 'Kejadian::index');
	$routes->post('/', 'Kejadian::index');
	$routes->get('preview/(:segment)', 'Kejadian::preview/$1');
	$routes->get('create', 'Kejadian::create');
	$routes->post('store', 'Kejadian::store');
	$routes->get('edit/(:segment)', 'Kejadian::edit/$1');
	$routes->post('update/(:segment)', 'Kejadian::update/$1');
	$routes->get('delete/(:num)', 'Kejadian::delete/$1');
	$routes->post('import', 'Kejadian::import');
	$routes->get('generateword', 'Kejadian::generate');
});
    $routes->get('/About', 'About::index');
	$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
