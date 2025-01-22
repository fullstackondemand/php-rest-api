<?php
use RestJS\App;
use RestJS\Api\Category\Router as CategoryRouter;
use RestJS\Api\User\Router as UserRouter;
use RestJS\Api\User\Controller as UserController;
use RestJS\Middleware\Authorization;

require __DIR__ . '/vendor/autoload.php';

/** Create Application */
$app = App::create(__DIR__);

/** Routers */
$app->get('/login/', [UserController::class, 'login']);
$app->get('/logout/', [UserController::class, 'logout'])->add(Authorization::class);
$app->group('/category', CategoryRouter::class)->add(Authorization::class);
$app->group('/user', UserRouter::class)->add(Authorization::class);

/** Application Execute or Run */
$app->run();