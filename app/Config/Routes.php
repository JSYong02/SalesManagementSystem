<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Dashboard::index');

$routes->post('/api/transactions/search', 'TransactionSearch::search');