<?php
declare(strict_types=1);
namespace RestJS;

use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;
use RestJS\Database;

/** Application Initialize */
class App {

    /** Create Application  */
    public static function create($dir) {

        /** Environment Variables */
        $dotenv = \Dotenv\Dotenv::createImmutable($dir);
        $dotenv->load();

        // Header All Allows
        header("Access-Control-Allow-Origin: {$_ENV['CORS_ORIGIN']}");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        // Database Connection
        Database::connection();

        /** Server Application */
        $app = AppFactory::create();

        // Core Middlewares
        $app->setBasePath("/api");                                       // set base path
        $app->addBodyParsingMiddleware();                                          // It is used to get json and form body data
        $app->add(new TrailingSlash(trailingSlash: true));             // It is used to stop shash error
        $app->addErrorMiddleware((bool) $_ENV['SHOW_ERROR'], (bool) $_ENV['SHOW_ERROR'], (bool) $_ENV['SHOW_ERROR']);           // It is used to get erors

        return $app;
    }
}