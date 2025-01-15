<?php
declare(strict_types=1);
use Slim\Factory\AppFactory;
use RestJS\Api\Category\Controller;

/** Server App initialize */
$app = AppFactory::create();

/** Middlewares */
$app->setBasePath("/api");                   // set base path

/** Routers */
$app->get('/category/', [Controller::class, "findAll"]);
$app->get('/category/{id:[0-9]+}/', [Controller::class, "findById"]);
$app->put('/category/{id:[0-9]+}/', [Controller::class, "updateById"]);
$app->post('/category/', [Controller::class, "create"]);
$app->delete('/category/{id:[0-9]+}/', [Controller::class, "deleteById"]);