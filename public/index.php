<?php

use app\controllers\JsonPlaceholderController;
use app\controllers\PostController;
use app\controllers\RegisterController;
use app\db\Database;
use app\Request;
use app\Router;
use app\controllers\LoginController;
use app\controllers\HomeController;

require_once __DIR__.'/../vendor/autoload.php';
require_once __DIR__.'/../helpers.php';

session_start();

$database = new Database();

$router = new Router(new Request(), $database);

$router->get('/', 'home');
$router->get('/about', 'about');

$router->get('/contact', 'contact');
$router->post('/contact', [HomeController::class, 'contact']);

$router->get('/login', [LoginController::class, 'renderLogin']);
$router->post('/login', [LoginController::class, 'login']);
$router->get('/logout', [LoginController::class, 'logout']);


$router->get('/register', 'register');
$router->post('/register', [RegisterController::class,'register']);

$router->get('/post', 'post');
$router->post('/post', [PostController::class,'post']);



