<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use Slim\Routing\RouteCollectorProxy;
use RestJS\Api\User\Controller;
use RestJS\Api\Category\Controller as CategoryController;

class Router {
    public function __invoke(RouteCollectorProxy $router) {
        $router->get('/', [Controller::class, "findAll"]);
        $router->get('/{username:[a-z0-9-]+}/', [Controller::class, "findByColumn"]);

        // Category Route
        $router->get('/{userId:[0-9]+}/categories/', [CategoryController::class, "findByColumn"]);
        $router->get('/{userId:[0-9]+}/categories/{id:[0-9]+}/', [CategoryController::class, "findByColumn"]);
        $router->post('/{userId:[0-9]+}/categories/', [CategoryController::class, "insert"]);
        $router->put('/{userId:[0-9]+}/categories/{id:[0-9]+}/', [CategoryController::class, "update"]);
        $router->delete('/{userId:[0-9]+}/categories/{id:[0-9]+}/', [CategoryController::class, "delete"]);
    }
}