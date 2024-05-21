<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('/dashboard', function (RouteCollection $routes) {
    $routes->get('/','DashboardController::index');

});

$routes->group('dashboard/articles', function ($routes) {
    $routes->get('all-articles', 'ArticlesController::allArticles');
    $routes->get('create-article', 'ArticlesController::createArticle');
    $routes->post('create-article', 'ArticlesController::createArticle');
    $routes->get('edit-article/(:num)', 'ArticlesController::editArticle/$1');
    $routes->post('update-article/(:num)', 'ArticlesController::updateArticle/$1');
    $routes->delete('delete-article/(:num)', 'ArticlesController::deleteArticle/$1');
});

$routes->group('api/v1', ['namespace' => 'App\Controllers'], function($routes) {
    $routes->get('articles', 'APIController::showAllArticles');
    $routes->get('articles/(:num)', 'APIController::showSingleArticle/$1');
});


