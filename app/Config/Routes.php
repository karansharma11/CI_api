<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/(:num)', 'Home::index/$1');
$routes->get('delete/(:num)', 'Home::delete/$1');
$routes->get('role/(:num)/(:any)', 'Home::role/$1/$2');
$routes->match(['get' , 'post'] , 'create', 'User::create');
$routes->match(['get' , 'post'] , 'login', 'User::login');





