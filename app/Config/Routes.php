<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);

/*
|--------------------------------------------------------------------------
| Public pages
|--------------------------------------------------------------------------
*/

$routes->get('/', 'Home::index');
$routes->get('tasks', 'Tasks::index');
$routes->get('profile', 'Profile::index');
$routes->get('about', 'Pages::about');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

$routes->get('login', 'Auth::login', [
    'filter' => 'guest',
]);

$routes->post('login', 'Auth::attemptLogin', [
    'filter' => 'guest',
]);

/*
|--------------------------------------------------------------------------
| Protected management actions
|--------------------------------------------------------------------------
*/

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get(
        'tasks/new',
        'Tasks::newForm'
    );

    $routes->post(
        'tasks',
        'Tasks::create'
    );

    $routes->get(
        'tasks/(:num)/edit',
        'Tasks::edit/$1'
    );

    $routes->post(
        'tasks/(:num)',
        'Tasks::update/$1'
    );

    $routes->post(
        'tasks/(:num)/archive',
        'Tasks::archive/$1'
    );

    $routes->post(
        'logout',
        'Auth::logout'
    );
});