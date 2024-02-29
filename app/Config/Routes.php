<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/users', 'Home::getusers');
$routes->get('users/(:num)', 'Home::getusers/$1');
$routes->get('users/delete/(:num)', 'Home::delete/$1');
$routes->get('users/role/(:num)/(:any)', 'Home::role/$1/$2');
$routes->match(['get' , 'post'] , 'users/create', 'User::create');
$routes->match(['get' , 'post'] , 'users/login', 'User::login');


// for getting rss data 
// get shakha nagar 
$routes->get('/get/shaka-nagar', 'Shaka_nagar::getshaka_nagar');
$routes->get('/get/shaka-nagar/(:num)', 'Shaka_nagar::getshaka_nagar/$1');
$routes->match(['get' , 'post'] , 'shaka-nagar/create', 'Shaka_nagar::create');
$routes->get('shaka-nagar/delete/(:num)', 'Shaka_nagar::delete/$1');



// get basti 
$routes->get('/get/basti', 'Basti::getbasti');
$routes->get('/get/basti/(:num)', 'Basti::getbasti/$1');
$routes->match(['get' , 'post'] , 'basti/create', 'basti::create');
$routes->get('basti/delete/(:num)', 'basti::delete/$1');


// get shkha 
$routes->get('/get/shaka', 'Shaka::getshaka');
$routes->get('/get/shaka/(:num)', 'Shaka::getshaka/$1');
$routes->match(['get' , 'post'] , 'shaka/create', 'shaka::create');
$routes->get('shaka/delete/(:num)', 'shaka::delete/$1');

// get vibhag 
$routes->get('/get/vibhag', 'Vibhag::getvibhag');
$routes->get('/get/vibhag/(:num)', 'Vibhag::getvibhag/$1');
$routes->match(['get' , 'post'] , 'vibhag/create', 'Vibhag::create');
$routes->get('vibhag/delete/(:num)', 'Vibhag::delete/$1');


// get shikshan 
$routes->get('/get/shikshan', 'Shikshan::getshikshan');
$routes->get('/get/shikshan/(:num)', 'Shikshan::getshikshan/$1');
$routes->match(['get' , 'post'] , 'shikshan/create', 'Shikshan::create');
$routes->get('shikshan/delete/(:num)', 'Shikshan::delete/$1');


// get daitva 
$routes->get('/get/daitva', 'Daitva::getdaitva');
$routes->get('/get/daitva/(:num)', 'Daitva::getdaitva/$1');
$routes->match(['get' , 'post'] , 'daitva/create', 'Daitva::create');
$routes->get('daitva/delete/(:num)', 'Daitva::delete/$1');


// get basti by shaka_nagar id 
$routes->get('/get/basti/by-shaka-nagar/(:num)', 'Basti::getbasti_byshaka_nagar/$1');
// $routes->get('/get/shaka/(:num)', 'Rss::getshaka/$1');


// get shaka by basti 
$routes->get('/get/shaka/by-basti/(:num)', 'Shaka::getshaka_by_basti/$1');



