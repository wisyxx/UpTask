<?php 

require_once __DIR__ . '/../includes/app.php';

use Controllers\LoginController;
use MVC\Router;
$router = new Router();

/*======> ACCOUNTS <======*/
$router->get('/', [LoginController::class, 'login']);
$router->post('/', [LoginController::class, 'login']);
$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);
$router->get('/logout', [LoginController::class, 'logout']);
$router->get('/forgot', [LoginController::class, 'forgotPassword']);
$router->post('/forgot', [LoginController::class, 'forgotPassword']);
$router->get('/reset', [LoginController::class, 'resetPassword']);
$router->post('/reset', [LoginController::class, 'resetPassword']);
/* Messages & account confirmation */
$router->get('/message', [LoginController::class, 'message']);
$router->get('/verify', [LoginController::class, 'confirmAccount']);


$router->checkRoutes();