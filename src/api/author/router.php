<?php
namespace RestJS\Api\Author;
use Slim\Routing\RouteCollectorProxy;
use RestJS\Api\Author\Controller;

class Router {
    function __invoke(RouteCollectorProxy $router) {
        $router->get('/', [Controller::class, "findAll"]);
        $router->get('/{id:[0-9]+}/', [Controller::class, "findByColumn"]);
        $router->get('/{slug:[a-z0-9-]+}/', [Controller::class, "findByColumn"]);
        $router->put('/{id:[0-9]+}/', [Controller::class, "updateById"]);
        $router->post('/', [Controller::class, "create"]);
        $router->delete('/{id:[0-9]+}/', [Controller::class, "deleteById"]);
    }
}