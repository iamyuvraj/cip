<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::login'); //default route - directs to the login page
$routes->get('/login', 'Home::login'); //route for the login page
$routes->get('/register', 'Home::register'); //route for the registeration page
$routes->get('/dashboard', 'Home::dashboard'); //route for the dashboard page
