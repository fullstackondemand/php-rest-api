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

        /** Variables Declaration */
        $username = false;
        $password = false;

        /** Overide username amd password */
        extract( $req->getParsedBody() ?? []);

        // Check login credentials
        if (!$username || !$password)
            throw new HttpBadRequestException($req, "Username or password is required.");

        /** Verify Entity Detail */
        $user = $this->model->fetchBy(['username' => $username])[0];
        $isValidPassword = $user->verifyPassword($password);

        if (!$isValidPassword)
            throw new HttpUnauthorizedException($req, 'Invalid user credentials');

        $accessToken = $user->generateAccessToken();
        
        // Add Authorization Cookies
        setcookie('SSID', $accessToken, time() + 84600 * intval($_ENV['ACCESS_TOKEN_EXPIRY']), path: '/', secure: true, httponly: true);

        return response($req, $res, new Response(message: "User logged in successfully.", data: ['accessToken' => $accessToken]));
    }

    /** User Logout Function */
    public function logout($req, $res) {

        // Remove Authorization Cookies
        setcookie('SSID', '', time() - 100, path: '/', secure: true, httponly: true);
        return response($req, $res, new Response(message: "User logged out successfully."));
    }
}