<?php
declare(strict_types=1);
namespace RestJS\Api\Category;

use Slim\Routing\RouteCollectorProxy;
use RestJS\Api\Category\Controller;

class Router {
    public function __invoke(RouteCollectorProxy $router) {
        $router->get('/', [Controller::class, "findAll"]);
        $router->get('/{id:[0-9]+}/', [Controller::class, "findByColumn"]);
        $router->get('/{slug:[a-z0-9-]+}/', [Controller::class, "findByColumn"]);
    }
}