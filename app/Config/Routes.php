<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::landing'); //default route - directs to the landing page
$routes->get('/login', 'Home::login'); //route for the login page
$routes->get('/register', 'Home::register'); //route for the register page
$routes->get('/dashboard', 'Home::dashboard'); //route for the dashboard page
$routes->post('/register-user', 'Home::registerUser');
$routes->post('/login-user', 'Home::loginUser');
$routes->get('/logout', 'Home::logout');