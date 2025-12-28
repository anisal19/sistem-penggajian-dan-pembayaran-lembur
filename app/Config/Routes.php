<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
//$routes->get('/', 'Home::index');
//$routes->get('/employee', 'Employee::index');
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index'); // ADD this
$routes->get('payroll', 'Payroll::index');
$routes->get('payroll/print', 'Payroll::printReport');
$routes->get('employee/create', 'Employee::create');
$routes->post('employee/store', 'Employee::store');
$routes->get('employee/test', 'Employee::testModel');
$routes->get('payroll/create', 'Payroll::create');
$routes->post('payroll/store', 'Payroll::store');
$routes->get('payroll/generate', 'Payroll::generateFromAttendance');




