<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'Api::users_get');

$routes->resource('members');
// // Equivalent to the following:
// $routes->get('members/new', 'Members::new');
// $routes->post('members', 'Members::create');
// $routes->get('members', 'Members::index');
// $routes->get('members/(:segment)', 'Members::show/$1');
// $routes->get('members/(:segment)/edit', 'Members::edit/$1');
// $routes->put('members/(:segment)', 'Members::update/$1');
// $routes->patch('members/(:segment)', 'Members::update/$1');
// $routes->delete('members/(:segment)', 'Members::delete/$1');
