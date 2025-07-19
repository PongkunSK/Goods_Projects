<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

 $routes->get('/spec', 'Spec::index');
 $routes->get('/spec/login', 'Spec::Authen');
 $routes->post('/spec/authenticate', 'Spec::authenticate'); // Login Process
 $routes->get('/spec/logout', 'Spec::logout'); // Logout Route
 $routes->get('/spec/admin', 'Spec::Admin'); // Admin Panel (Requires Authentication)
 
 $routes->get('/spec/getCategories/(:num)', 'Spec::getCategories/$1');
 $routes->get('/spec/getSubCategories/(:num)', 'Spec::getSubCategories/$1');
 $routes->get('/spec/getEquipmentDetails/(:num)', 'Spec::getEquipmentDetails/$1');
 
 $routes->post('/spec/updateEquipment/(:num)', 'Spec::updateEquipment/$1');
 $routes->delete('/spec/deleteEquipment/(:num)', 'Spec::deleteEquipment/$1');
 $routes->delete('/spec/deleteCategory/(:num)', 'Spec::deleteCategory/$1'); 

 $routes->get('/home', 'Home::index');
