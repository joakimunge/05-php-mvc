<?php

//Error reporting. Remove before pushing live.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

use Blog\Core\Router;
use Blog\Core\Request;

//Autoload dependencies
function autoloader($classname) {
    $lastSlash = strpos($classname, '\\') + 1;
    $classname = substr($classname, $lastSlash);
    $directory = str_replace('\\', '/',  $classname);    
    $filename = __DIR__ . '/src/' . $directory . '.php';
    require_once($filename);
}

spl_autoload_register('autoloader');

//Init request and router
$request = new Request();
$router = new Router($request);

//Routes - Get
$router->get('/', 'IndexController', 'index');
$router->get('/login', 'LoginController', 'login');
$router->get('/admin', 'AdminController', 'admin');
$router->get('/add', 'AddnewController', 'add');
$router->get('/post', 'PostViewController', 'postView');
$router->get('/signup', 'SignupController', 'signup');

//Routes - Post
$router->post('/submitlogin', 'LoginController', 'submitLogin');
$router->post('/submit', 'SubmitController', 'submit');
$router->post('/register', 'SignupController', 'register');
$router->get('/logout', 'LoginController', 'logout');

//Populate routes
$router->dispatch();

var_dump($_SESSION);

?>