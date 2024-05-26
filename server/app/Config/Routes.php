<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 
$routes->get('/', 'Home::index');

$routes->group('/dashboard',['filter' => 'auth'], function (RouteCollection $routes) {
    $routes->get('/','DashboardController::index');

});

$routes->group('auth/', function (RouteCollection $routes) {
    $routes->get('login', 'AuthController::login');
    $routes->post('login', 'AuthController::processLogin');
    $routes->get('register', 'AuthController::register');
    $routes->post('register', 'AuthController::processRegister');
    $routes->get('dashboard', 'DashboardController::index');
    $routes->get('logout', 'AuthController::logout');
});

$routes->group('dashboard/articles',['filter' => 'auth'], function ($routes) {
    $routes->get('all-articles', 'ArticlesController::allArticles');
    $routes->get('create-article', 'ArticlesController::createArticle');
    $routes->post('create-article', 'ArticlesController::createArticle');
    $routes->get('edit-article/(:num)', 'ArticlesController::editArticle/$1');
    $routes->post('update-article/(:num)', 'ArticlesController::updateArticle/$1');
    $routes->get('delete-article/(:num)', 'ArticlesController::deleteArticle/$1');
    $routes->get('edit-delete-image/(:num)', 'ArticlesController::deleteImage/$1');   
});

$routes->group('dashboard/applications',['filter' => 'auth'], function ($routes) {
    $routes->get('all-applications', 'APIController::allApplications');
    $routes->get('delete-application/(:num)', 'APIController::deleteApplication/$1');
});

$routes->group('dashboard/bookings',['filter' => 'auth'], function ($routes) {
    $routes->get('all-bookings', 'APIController::allBookings');
    $routes->get('delete-booking/(:num)', 'APIController::deleteBooking/$1');
});





$routes->group('api/v1', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('articles', 'APIController::showAllArticles');
    $routes->get('articles/(:num)', 'APIController::showSingleArticle/$1');
    $routes->post('send-message', 'APIController::sendMessage');
    $routes->post('submit-training', 'APIController::submitApplication');
    $routes->post('submit-booking', 'APIController::submitBooking');
});


