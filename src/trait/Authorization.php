<?php
declare(strict_types=1);
namespace RestJS\Trait;

use RestJS\Class\Response;
use function RestJS\response;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpUnauthorizedException;

/** Authorization Functions */
trait Authorization {

    /** Login Function */
    public function login($req, $res)  {

        /** Username Variable */
        $username = false;

        /** Password Variable */
        $password = false;

        // Overide Username and Password Value
        extract( $req->getParsedBody() ?? []);

        // Check Login Credentials
        if (!$username || !$password)
            throw new HttpBadRequestException($req, "Username or password is required.");

        /** Check User Entity */
        $user = $this->model->findBy(['username' => $username])[0];

        /** Verify User Password */
        $isValidPassword = $user->verifyPassword($password);

        if (!$isValidPassword)
            throw new HttpUnauthorizedException($req, 'Invalid user credentials');

        /** Generated Access Token  */
        $accessToken = $user->generateAccessToken();
        
        // Add Authorization Cookies
        setcookie('SSID', $accessToken, time() + 84600 * intval($_ENV['ACCESS_TOKEN_EXPIRY']), path: '/', secure: true, httponly: true);

        return response($req, $res, new Response(message: "User logged in successfully.", data: ['accessToken' => $accessToken]));
    }

    /** Logout Function */
    public function logout($req, $res) {

        // Remove Authorization Cookies
        setcookie('SSID', '', time() - 100, path: '/', secure: true, httponly: true);

        return response($req, $res, new Response(message: "User logged out successfully."));
    }
}