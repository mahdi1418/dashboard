<?php
require_once 'loader.php';
$request = $_REQUEST['q'];

$requests = explode('/', $request);

$first = $requests[0];

$routes = [
    '' => 'templates/register.php',
    'register' => 'templates/register.php',
    'login' => 'templates/login.php',

    'panel' => 'templates/panel.php',

    'products' => 'templates/all-product.php',
    'product' => 'templates/new-product.php',
    
    'category' => 'templates/category.php',

    'profile' => 'templates/profile.php',
    'user' => 'templates/new-user.php',
    'users' => 'templates/all-users.php',


    'pass' => 'templates/pass.php',
    'orders' => 'templates/orders.php',
    'logout' => 'templates/logout.php'
];

if (isset($routes[$first])) {
    require_once $routes[$first];
} else {
    header('location:login');
}


