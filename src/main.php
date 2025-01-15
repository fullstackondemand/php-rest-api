<?php
declare(strict_types=1);
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;
use RestJS\Api\Category\Router as CategoryRouter;

/** Server App initialize */
$app = AppFactory::create();

/** Middlewares */
$app->setBasePath("/api");                                       // set base path
$app->addBodyParsingMiddleware();                                          // It is used to get json and form body data
$app->add(new TrailingSlash(trailingSlash: true));             // It is used to stop shash error
$app->addErrorMiddleware(boolval($_ENV['SHOW_ERROR']), boolval($_ENV['SHOW_ERROR']), boolval($_ENV['SHOW_ERROR']));           // It is used to get erors

/** Routers */
$app->group('/category', CategoryRouter::class);