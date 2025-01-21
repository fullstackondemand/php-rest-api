<?php
use RestJS\App;
use RestJS\Api\Category\Router as CategoryRouter;
use RestJS\Api\Author\Router as AuthorRouter;
use RestJS\Api\Author\Controller as AuthorController;
use RestJS\Middleware\Authorization;

require __DIR__ . '/vendor/autoload.php';

/** Create Application */
$app = App::create(__DIR__);

/** Routers */
$app->get('/login/', [AuthorController::class, 'login']);
$app->get('/logout/', [AuthorController::class, 'logout']);
$app->group('/category', CategoryRouter::class)->add(Authorization::class);
$app->group('/author', AuthorRouter::class)->add(Authorization::class);

/** Application Execute or Run */
$app->run();