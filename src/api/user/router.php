<?php
declare(strict_types=1);
namespace RestJS\Api\User;

use Slim\Routing\RouteCollectorProxy;
use RestJS\Api\User\Controller;
use RestJS\Middleware\Upload;

class Router {
    public function __invoke(RouteCollectorProxy $router) {
        $router->get('/', [Controller::class, "findAll"]);
        $router->get('/{id:[0-9]+}/', [Controller::class, "findByColumn"]);
        $router->get('/{username:[a-z0-9-]+}/', [Controller::class, "findByColumn"]);
        $router->put('/{id:[0-9]+}/', [Controller::class, "update"])->add(Upload::class);
        $router->post('/', [Controller::class, "insert"])->add(Upload::class);
        $router->delete('/{id:[0-9]+}/', [Controller::class, "delete"]);
    }
}