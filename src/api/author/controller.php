<?php
declare(strict_types=1);
namespace RestJS\Api\Author;
use RestJS\Class\Response;
use RestJS\Trait\Controller as CoreController;
use RestJS\Api\Author\Model;
use Slim\Exception\HttpBadRequestException;
use Slim\Exception\HttpUnauthorizedException;
use function RestJS\response;

class Controller {

    function __construct(private Model $model) {
        $this->result = $this->model->fetchAll();
    }

    /** Use core controller functions */
    use CoreController;

    /** Author Login Function */
    public function login($req, $res)  {

        /** Variables Declaration */
        $username = false;
        $password = false;

        /** Overide username amd password */
        extract( $req->getParsedBody() ?? []);

        // Check login credentials
        if (!$username || !$password)
            throw new HttpBadRequestException($req, "Username or password is required.");

        /** Verify Author Detail */
        $author = $this->model->fetchBy(['username' => $username])[0];
        $isValidPassword = $author->verifyPassword($password);

        if (!$isValidPassword)
            throw new HttpUnauthorizedException($req, 'Invalid user credentials');

        $accessToken = $author->generateAccessToken();
        
        // Add Authorization Cookies
        setcookie('SSID', $accessToken, time() + 84600 * intval($_ENV['ACCESS_TOKEN_EXPIRY']), secure: true, httponly: true);

        return response($req, $res, new Response(message: "Author logged in successfully.", data: ['author' => ['accessToken' => $accessToken]]));
    }

    /** Author Logout Function */
    public function logout($req, $res) {

        // Remove Authorization Cookies
        setcookie('SSID', '', time() - 1, secure: true, httponly: true);
        return response($req, $res, new Response(message: "Author logged out successfully."));
    }
}