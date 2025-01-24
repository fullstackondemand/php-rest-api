<?php
declare(strict_types=1);
namespace RestJS;

use Slim\Exception\HttpBadRequestException;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/** Query Response Function */
function response(Request $req, Response $res, mixed $args) {
    $res->getBody()->write(json_encode($args));
    return $res;
}

/** Check Null Value Function */
function checkNull($value, $req) {
    !boolval($value) && throw new HttpBadRequestException($req, "Something went wrong...");
}

/** Callback Error Handler Function */
function errorHandler($callback) {
    try {
        return $callback;
    } catch (\Exception $e) {
        return null;
    }
}