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
$routes->get('/', 'Home::login');
$routes->get('/login', 'Home::login');
$routes->get('/logout', 'Home::logout');
// administrator
$routes->group('administrator', function ($routes) {
    $routes->get('/', 'Administrator::index');
    $routes->get('data-user', 'Administrator::data_user');
    $routes->post('api/save-data-user/(:any)', 'Administrator::store_data_user/$1');
    $routes->post('api/edit-data-user', 'Administrator::edit_data_user');
    $routes->post('api/delete-data-user', 'Administrator::delete_data_user');
    $routes->get('data-unit', 'Administrator::data_unit');
    $routes->post('api/save-data-lembaga', 'Administrator::store_data_lembaga');
    $routes->post('api/delete-data-lembaga', 'Administrator::delete_data_lembaga');
});
// use for unit
$routes->group('unit', function ($routes) {
    $routes->get('/', 'Unit::index');
    $routes->get('rpd', 'Unit::rpd');
    // kegiatan
    $routes->get('tambah-kegiatan/(:num)', 'Unit::tambah_kegiatan/$1');
    $routes->post('api/store-kegiatan/(:any)', 'Unit::store_kegiatan/$1');
    $routes->post('api/delete-kegiatan', 'Unit::delete_kegiatan');
    $routes->post('api/edit-kegiatan', 'Unit::edit_kegiatan');
    // penarikan bulanan
    $routes->get('tambah-penarikan-bulanan/(:num)/(:num)', 'Unit::tambah_penarikan_bulanan/$1/$2');
    $routes->post('api/store-penarikan-bulanan/(:any)', 'Unit::store_rincian_kegiatan/$1');
    $routes->post('api/edit-penarikan-bulanan', 'Unit::edit_rincian_kegiatan');
    $routes->post('api/delete-penarikan-bulanan', 'Unit::delete_rincian_kegiatan');
    // use for update pagu monthly
    $routes->post('api/update-pagu-perbulan', 'Unit::update_pagu_rincian_kegiatan_perbulan');
    // use for weekly data
    $routes->get('tambah-penarikan-mingguan/(:num)/(:num)/(:num)', 'Unit::tambah_penarikan_mingguan/$1/$2/$3');
});
// use for api
$routes->post('/api/login', 'Home::authorize');
$routes->get('/dashboard', 'ControllerRpd::dashboard');
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
