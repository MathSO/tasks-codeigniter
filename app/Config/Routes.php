<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// View routes
$routes->group('', ['filter' => [ 'csrf', 'cors' ]], static function($routes) {
    $routes->get('tasks', 'TaskController::index');
    $routes->get('tasks/edit/(:num)', 'TaskController::edit/$1');
    $routes->view('tasks/create', 'tasks/create');

    $routes->post('tasks/update/(:num)', 'TaskController::update/$1');
    $routes->post('tasks/store', 'TaskController::store');
});