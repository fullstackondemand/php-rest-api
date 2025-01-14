<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath("/api");
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$app->get('/', function (Request $request, Response $response, $args) {
    $response->getBody()->write("Hello {$_ENV['NAME']}!");
    return $response;
});

$app->run();