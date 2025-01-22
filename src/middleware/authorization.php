<?php
declare(strict_types=1);
namespace RestJS\Middleware;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use RestJS\Api\User\Model as User;
use Slim\Exception\HttpUnauthorizedException;

/** Authorization Middleware Function */
class Authorization implements MiddlewareInterface {

    function __construct(private User $user) {}

    function process(Request $req, RequestHandler $handler): ResponseInterface {
        $token = $_COOKIE['SSID'] ?? str_replace('Bearer ', '', $req->getHeader('Authorization'))[0] ?? $req->getQueryParams()['accessToken'] ?? null;

        if (!$token)
            throw new HttpUnauthorizedException($req, 'Unauthorized request');

        /** Decode Json Web Token */
        try {
            $decodedToken = (array) JWT::decode($token, new Key($_ENV['ACCESS_TOKEN_SECRET'], 'HS256'));
        }
        catch (\Exception $e) {
            $decodedToken = null;
        }

        if (!$decodedToken)
            throw new HttpUnauthorizedException($req, "Invalid access token");

        /** Get User Detail */
        $user = $this->user->fetchById($decodedToken['id']);

        if (!$user)
            throw new HttpUnauthorizedException($req, "Invalid access token");

        $req->user = $user;

        return $handler->handle($req);
    }
}