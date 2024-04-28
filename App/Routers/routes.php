<?php
use App\Controllers\BooksController;
use App\Routers\Router as Router;
use App\Controllers\AuthController;
use App\Middlewares\AuthMiddleware;

// ایجاد یک نمونه از میدلور
$authMiddleware = new AuthMiddleware();
$request = (object) [
    "headers" => $_SERVER['HTTP_TOKEN'] ?? null,
    "query"   => $_GET['token'] ?? null,
    "body"    => getPostDataInput()->token ?? null
];

$response = $authMiddleware->handle($request);

if(!$response) exit();

$router = new Router();

// Define routes
$router->post('v1','/login', AuthController::class, 'login');
$router->post('v1','/verify', AuthController::class, 'verify');

$router->get('v1','/books', BooksController::class, 'index');
$router->get('v1','/books/{id}', BooksController::class, 'show');
$router->post('v1','/books', BooksController::class, 'store');
$router->put('v1','/books/{id}', BooksController::class, 'update');
$router->delete('v1','/books/{id}', BooksController::class, 'destroy');