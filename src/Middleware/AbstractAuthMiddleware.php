<?php
declare(strict_types=1);
namespace RestJS\Middleware;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use Psr\Http\Server\MiddlewareInterface;
use Slim\Exception\HttpUnauthorizedException;

/** Abstract Authorization Middleware */
abstract class AbstractAuthMiddleware implements MiddlewareInterface {

    /** User Class Object */
    private $_user;

    public function __construct($user) {
        $this->_user = $user;
    }

    public function process(Request $req, RequestHandler $handler): ResponseInterface {

        /** User Access Token */
        $token = str_replace('Bearer ', '', $req->getHeaderLine('Authorization')) ?? $req->getQueryParams()['accessToken'] ?? null;

        if (!$token)
            throw new HttpUnauthorizedException($req, 'Unauthorized request');

        try {
            /** Decode Json Web Token */
            $decodedToken = (array) JWT::decode($token, new Key($_ENV['ACCESS_TOKEN_SECRET'], 'HS256'));
        } catch (\Exception $e) {
            throw new HttpUnauthorizedException($req, "Invalid access token");
        }
        
        /** Check User Entity */
        $user = $this->_user->findById($decodedToken['id']);

        if (!$user)
            throw new HttpUnauthorizedException($req, "Invalid access token");

        $req->user = $user;

        return $handler->handle($req);
    }
}