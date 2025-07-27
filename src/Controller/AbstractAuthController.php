<?php
declare(strict_types=1);
namespace RestJS\Controller;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use RestJS\Message\Response;
use function RestJS\response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpUnauthorizedException;

/** Abstract Authentication Controller Functions */
class AbstractAuthController extends AbstractController {

    /** Login Function */
    public function login($req, $res) {

        /** Username */
        $username = false;

        /** Password */
        $password = false;

        // Overide Username and Password Value
        extract($req->getParsedBody() ?? []);

        // Check Login Credentials
        if (!$username || !$password)
            throw new HttpBadRequestException($req, "Username or password is required.");

        /** Check User Entity */
        $user = $this->_model->filter(['username' => $username]);

        if (!$user)
            throw new HttpUnauthorizedException($req, 'Invalid user credentials');

        /** Verify User Password */
        $isValidPassword = $user->verifyPassword($password);

        if (!$isValidPassword)
            throw new HttpUnauthorizedException($req, 'Invalid user credentials');

        /** Generated Access Token  */
        $accessToken = $user->generateAccessToken();

        /** Generated Refresh Token  */
        $refreshToken = $user->generateRefreshToken();

        // Add Authorization Cookies
        // setcookie('accessToken', $accessToken, time() + 60 * (int) $_ENV['ACCESS_TOKEN_EXPIRY'], path: '/api', secure: true, httponly: true);
        // setcookie('refreshToken', $refreshToken, time() + 86400 * (int) $_ENV['REFRESH_TOKEN_EXPIRY'], path: '/api', secure: true, httponly: true);

        return response($req, $res, new Response(data: [
            'user' => $user, 
            'accessToken' => ['token' => $accessToken, 'exp' => time() + 60 * (int) $_ENV['ACCESS_TOKEN_EXPIRY']], 
            'refreshToken' => ['token' => $refreshToken, 'exp' => time() + 86400 * (int) $_ENV['REFRESH_TOKEN_EXPIRY']]
        ]));
    }

    /** Logout Function */
    public function logout($req, $res) {

        // Remove Authorization Cookies
        // setcookie('accessToken', '', time() - 100, path: '/api', secure: true, httponly: true);
        // setcookie('refreshToken', '', time() - 100, path: '/api', secure: true, httponly: true);

        return response($req, $res, new Response(message: "User logged out successfully."));
    }

    /** Regenrate Access Token to Refresh Token */
    public function regenerateAccessToken($req, $res) {

        /** User Refresh Token */
        $refreshToken = $_COOKIE['refreshToken'] ?? $req->getParsedBody()['refreshToken'] ?? null;

        try {
            /** Decode Json Web Token */
            $decodedToken = (array) JWT::decode($refreshToken, new Key($_ENV['REFRESH_TOKEN_SECRET'], 'HS256'));
        } catch (\Exception $e) {
            throw new HttpUnauthorizedException($req, "Invalid access token");
        }
        
        /** Check User Entity */
        $user = $this->_model->findById($decodedToken['id']);

        /** Generated Access Token  */
        $accessToken = $user->generateAccessToken();

        // Add Authorization Cookies
        // setcookie('accessToken', $accessToken, time() + 60 * (int) $_ENV['ACCESS_TOKEN_EXPIRY'], path: '/api', secure: true, httponly: true);

        return response($req, $res, new Response(data: [
            'accessToken' => ['token' => $accessToken, 'exp' => time() + 60 * (int) $_ENV['ACCESS_TOKEN_EXPIRY']]
        ]));
    }
}