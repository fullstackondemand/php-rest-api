<?php
declare(strict_types=1);
namespace RestJS\Api\Category;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use RestJS\Api\Category\Model;

class Controller {

    function __construct(private Model $model) { }

    /** Fetch All Data */
    function findAll(Request $req, Response $res, mixed $args) {
        $res->getBody()->write(json_encode($this->model->all()));
        return $res;
    }
}