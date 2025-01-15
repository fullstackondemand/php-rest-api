<?php
declare(strict_types=1);
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;
use RestJS\Api\Category\Controller;

/** Server App initialize */
$app = AppFactory::create();

/** Middlewares */
$app->setBasePath("/api");                                       // set base path
$app->addBodyParsingMiddleware();                                          // It is used to get json and form body data
$app->add(new TrailingSlash(trailingSlash: true));             // It is used to stop shash error
$app->addErrorMiddleware(boolval($_ENV['SHOW_ERROR']), boolval($_ENV['SHOW_ERROR']), boolval($_ENV['SHOW_ERROR']));           // It is used to get erors

/** Routers */
$app->get('/category/', [Controller::class, "findAll"]);
$app->get('/category/{id:[0-9]+}/', [Controller::class, "findById"]);
$app->put('/category/{id:[0-9]+}/', [Controller::class, "updateById"]);
$app->post('/category/', [Controller::class, "create"]);
$app->delete('/category/{id:[0-9]+}/', [Controller::class, "deleteById"]);