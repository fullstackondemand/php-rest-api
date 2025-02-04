<?php
declare(strict_types=1);
namespace RestJS;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

/** Query Response Function */
function response(Request $req, Response $res, mixed $args) {
    $res->getBody()->write(json_encode($args));
    return $res;
}