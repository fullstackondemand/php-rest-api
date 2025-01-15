<?php
declare(strict_types=1);
use Slim\Factory\AppFactory;
use RestJS\Api\Category\Controller;

/** Server App initialize */
$app = AppFactory::create();

/** Middlewares */
$app->setBasePath("/api");                   // set base path

/** Router */
$app->get('/blog', [Controller::class, "findAll"]);