<?php
namespace RestJS\Api\Category;
use Slim\Routing\RouteCollectorProxy;
use RestJS\Api\Category\Controller;

class Router {
    function __invoke(RouteCollectorProxy $router) {
        $router->get('/', [Controller::class, "findAll"]);
        $router->get('/{id:[0-9]+}/', [Controller::class, "findById"]);
        $router->get('/{slug:[a-z0-9-]+}/', [Controller::class, "findBySlug"]);
        $router->put('/{id:[0-9]+}/', [Controller::class, "updateById"]);
        $router->post('/', [Controller::class, "create"]);
        $router->delete('/{id:[0-9]+}/', [Controller::class, "deleteById"]);
        $router->get('/{filter:[a-z-,_A-Z]+}/', [Controller::class, "selectContent"]);
    }
}