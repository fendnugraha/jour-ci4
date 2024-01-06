<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
// $routes->get('/', 'Auth::index');
$routes->get('/', 'Home::index');
$routes->get('/jurnal', 'Jurnal::index');
$routes->get('/jurnal/addJournal', 'Jurnal::addJournal');
$routes->post('/jurnal/addJournal', 'Jurnal::save');
