<?php
use RestJS\Database;

require __DIR__ . '/vendor/autoload.php';

/** Environment Variables */
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** Headers Variables */
header("Access-Control-Allow-Origin: {$_ENV['CORS_ORIGIN']}");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST, GET, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

/** External Files */
Database::connection();
require 'src/main.php';

/** App Execute or Run */
$app->run();