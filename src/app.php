<?php
declare(strict_types=1);
namespace RestJS;
use Slim\Factory\AppFactory;
use Middlewares\TrailingSlash;
use RestJS\Database;

class App {

    /** Create Application  */
    public static function create($dir) {

        /** Environment Variables */
        $dotenv = \Dotenv\Dotenv::createImmutable($dir);
        $dotenv->load();

        /** Headers Variables */
        header("Access-Control-Allow-Origin: {$_ENV['CORS_ORIGIN']}");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
        header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

        /** Database Connection Established */
        Database::connection();

        /** Server Application Initialize */
        $app = AppFactory::create();

        /** Middlewares */
        $app->setBasePath("/api");                                       // set base path
        $app->addBodyParsingMiddleware();                                          // It is used to get json and form body data
        $app->add(new TrailingSlash(trailingSlash: true));             // It is used to stop shash error
        $app->addErrorMiddleware(boolval($_ENV['SHOW_ERROR']), boolval($_ENV['SHOW_ERROR']), boolval($_ENV['SHOW_ERROR']));           // It is used to get erors

        return $app;
    }
}