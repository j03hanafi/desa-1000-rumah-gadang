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
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'LandingPage::index');
$routes->get('/app', 'Home::index');

// API
$routes->resource('api/rumahGadang');
$routes->get('api/recommendation', 'Api\RumahGadang::recommendation');
$routes->post('api/recommendationOwner', 'Api\RumahGadang::recommendationByOwner');
$routes->post('api/recommendation', 'Api\RumahGadang::updateRecommendation');
$routes->post('api/rumahGadangOwner', 'Api\RumahGadang::listByOwner');
$routes->post('api/rumahGadang/findByName', 'Api\RumahGadang::findByName');
$routes->resource('api/event');
$routes->post('api/eventOwner', 'Api\Event::listByOwner');
$routes->post('api/event/findByName', 'Api\Event::findByName');
$routes->resource('api/culinaryPlace');
$routes->post('api/culinaryPlaceOwner', 'Api\CulinaryPlace::listByOwner');
$routes->post('api/culinaryPlace/findByName', 'Api\CulinaryPlace::findByName');
$routes->post('api/culinaryPlace/findByMenu', 'Api\CulinaryPlace::findByMenu');
$routes->post('api/culinaryPlace/findByPrice', 'Api\CulinaryPlace::findByPrice');
$routes->resource('api/worshipPlace');
$routes->post('api/worshipPlaceOwner', 'Api\WorshipPlace::listByOwner');
$routes->post('api/worshipPlace/findByName', 'Api\WorshipPlace::findByName');
$routes->post('api/worshipPlace/findByCategory', 'Api\WorshipPlace::findByCategory');
$routes->resource('api/souvenirPlace');
$routes->post('api/souvenirPlaceOwner', 'Api\SouvenirPlace::listByOwner');
$routes->post('api/souvenirPlace/findByName', 'Api\SouvenirPlace::findByName');
$routes->post('api/souvenirPlace/findByProduct', 'Api\SouvenirPlace::findByProduct');
$routes->resource('api/account');
$routes->post('api/account/changePassword', 'Api\Account::changePassword');
$routes->post('api/account/visitHistory', 'Api\Account::visitHistory');
$routes->post('api/account/newVisitHistory', 'Api\Account::newVisitHistory');
$routes->resource('api/review');
$routes->resource('api/admin/owner');
$routes->resource('api/admin/user');

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
