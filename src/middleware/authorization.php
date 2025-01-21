<?php
declare(strict_types=1);
namespace RestJS\Middleware;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use RestJS\Api\Author\Model as Author;
use Slim\Exception\HttpUnauthorizedException;

/** Authorization Middleware Function */
class Authorization implements MiddlewareInterface {

    function __construct(private Author $author) {}

    function process(Request $req, RequestHandler $handler): ResponseInterface {
        $token = $_COOKIE['SSID'] ?? str_replace('Bearer ', '', $req->getHeader('Authorization'))[0] ?? $req->getQueryParams()['accessToken'] ?? null;

    if (!$token)
            throw new HttpUnauthorizedException($req, 'Unauthorized request');

        /** Decode Json Web Token */
        $decodedToken = (array) JWT::decode($token, new Key($_ENV['ACCESS_TOKEN_SECRET'], 'HS256'));

        /** Get Author Detail */
        $author = $this->author->fetchById($decodedToken['id']);

        if (!$author)
            throw new HttpUnauthorizedException($req, "Invalid access token");

        $req->author = $author;

        return $handler->handle($req);
    }
}