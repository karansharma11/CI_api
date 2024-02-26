<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'Home::getusers');
$routes->get('users/(:num)', 'Home::getusers/$1');
$routes->get('delete/(:num)', 'Home::delete/$1');
$routes->get('role/(:num)/(:any)', 'Home::role/$1/$2');
$routes->match(['get' , 'post'] , 'create', 'User::create');
$routes->match(['get' , 'post'] , 'login', 'User::login');


// for getting rss data 
// get shakha nagar 
$routes->get('/get/shaka-nagar', 'Shaka_nagar::getshaka_nagar');
$routes->get('/get/shaka-nagar/(:num)', 'Shaka_nagar::getshaka_nagar/$1');
// $routes->match(['get' , 'post'] , 'create', 'Shaka_nagar::create');


// get basti 
$routes->get('/get/basti', 'Basti::getbasti');
$routes->get('/get/basti/(:num)', 'Basti::getbasti/$1');


// get shkha 
$routes->get('/get/shaka', 'Shaka::getshaka');
$routes->get('/get/shaka/(:num)', 'Shaka::getshaka/$1');

// get basti by shaka_nagar id 
$routes->get('/get/basti/by-shakha-nagar/(:num)', 'Basti::getbasti_byshaka/$1');
// $routes->get('/get/shaka/(:num)', 'Rss::getshaka/$1');




