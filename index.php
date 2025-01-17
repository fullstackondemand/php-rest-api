<?php
use RestJS\App;
use RestJS\Api\Category\Router as CategoryRouter;

require __DIR__ . '/vendor/autoload.php';

/** Create Application */
$app = App::create(__DIR__);

/** Routers */
$app->group('/category', CategoryRouter::class);

/** Application Execute or Run */
$app->run();