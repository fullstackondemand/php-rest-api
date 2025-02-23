<?php
use RestJS\App;
use RestJS\Api\Category\Router as CategoryRouter;
use RestJS\Api\User\Router as UserRouter;
use RestJS\Api\User\Controller as UserController;
use RestJS\Middleware\Authorization;

require __DIR__ . '/vendor/autoload.php';

/** Create Application */
$app = App::create(__DIR__);

// Authentication Routes
$app->post('/auth/login/', [UserController::class, 'login']);
$app->get('/auth/logout/', [UserController::class, 'logout'])->add(Authorization::class);
$app->get('/auth/refreshtoken/', [UserController::class, 'regenerateAccessToken']);

// Application Routes
$app->group('/categories', CategoryRouter::class)->add(Authorization::class);
$app->group('/users', UserRouter::class)->add(Authorization::class);

// Application Execute or Run
$app->run();