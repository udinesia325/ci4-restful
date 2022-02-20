<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->post('v1/auth/login', 'Login::login');
$routes->get('v1/auth/logout', 'Login::logout');

// untuk places

$routes->get("v1/place", "Place::index");
$routes->get("v1/place/(:num)", "Place::index/$1");
$routes->post("v1/place", "Place::create");
$routes->post("v1/place/(:num)", "Place::edit/$1");
$routes->delete("v1/place/(:num)", "Place::delete/$1");


// untuk schedule
$routes->post("v1/schedule", "Schedule::create");
$routes->delete("v1/schedule/(:num)", "Schedule::delete/$1");

//untuk search

$routes->get("v1/route/search/(:num)/(:num)", "Route::search/$1/$2");
$routes->get("v1/route/search/(:num)/(:num)/(:any)", "Route::search/$1/$2/$3");
$routes->post("v1/route/selection", "Route::selection");


//untuk frontend
$routes->get("/", "Frontend/Home::index");


/*
 *
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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
  require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}