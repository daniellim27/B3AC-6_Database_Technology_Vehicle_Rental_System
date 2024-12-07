<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('/dashboard', 'Dashboard::index');

// Vehicles
$routes->get('/vehicles', 'Vehicles::index');
$routes->get('/vehicles/create', 'Vehicles::create');
$routes->post('/vehicles/create', 'Vehicles::store');
$routes->get('/vehicles/(:segment)', 'Vehicles::show/$1');
$routes->get('/vehicles/(:segment)/edit', 'Vehicles::edit/$1');
$routes->post('/vehicles/(:segment)/edit', 'Vehicles::update/$1');
$routes->get('/vehicles/(:segment)/delete', 'Vehicles::delete/$1');

// Customers
$routes->get('/customers', 'Customers::index');
$routes->get('/customers/create', 'Customers::create');
$routes->post('/customers/create', 'Customers::store');
$routes->get('/customers/(:segment)/edit', 'Customers::edit/$1');
$routes->post('/customers/(:segment)/edit', 'Customers::update/$1');
$routes->get('/customers/(:segment)/delete', 'Customers::delete/$1');

// Rentals
$routes->get('/rentals', 'Rentals::index');
$routes->get('/rentals/create', 'Rentals::create');
$routes->post('/rentals/create', 'Rentals::store');
$routes->get('/rentals/(:segment)/edit', 'Rentals::edit/$1');
$routes->post('/rentals/(:segment)/edit', 'Rentals::update/$1');
$routes->get('/rentals/(:segment)/delete', 'Rentals::delete/$1');

// Maintenances
$routes->get('/maintenances', 'Maintenances::index');
$routes->get('/maintenances/create', 'Maintenances::create');
$routes->post('/maintenances/create', 'Maintenances::store');
$routes->get('/maintenances/(:segment)/edit', 'Maintenances::edit/$1');
$routes->post('/maintenances/(:segment)/edit', 'Maintenances::update/$1');
$routes->get('/maintenances/(:segment)/delete', 'Maintenances::delete/$1');

// Payments
$routes->get('/payments', 'Payments::index');
$routes->get('/payments/create', 'Payments::create');
$routes->post('/payments/create', 'Payments::store');
$routes->get('/payments/(:segment)/edit', 'Payments::edit/$1');
$routes->post('/payments/(:segment)/edit', 'Payments::update/$1');
$routes->get('/payments/(:segment)/delete', 'Payments::delete/$1');

// Insurance
$routes->get('/insurance', 'Insurance::index');
$routes->get('/insurance/create', 'Insurance::create');
$routes->post('/insurance/create', 'Insurance::store');
$routes->get('/insurance/(:segment)/edit', 'Insurance::edit/$1');
$routes->post('/insurance/(:segment)/edit', 'Insurance::update/$1');
$routes->get('/insurance/(:segment)/delete', 'Insurance::delete/$1');

// Employees
$routes->get('/employees', 'Employees::index');
$routes->get('/employees/create', 'Employees::create');
$routes->post('/employees/create', 'Employees::store');
$routes->get('/employees/(:segment)/edit', 'Employees::edit/$1');
$routes->post('/employees/(:segment)/edit', 'Employees::update/$1');
$routes->get('/employees/(:segment)/delete', 'Employees::delete/$1');