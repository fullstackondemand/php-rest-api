<?php
use Dotenv\Dotenv;

/* Include Varibles File */
require_once __DIR__ . '/vendor/autoload.php';

/* Environment File Config */
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

/* Head Allows Section */
require __DIR__ . '/src/views/header.view.php';
$headers = getallheaders();

/* Check Database Connection */
require __DIR__ . '/src/controllers/database.controller.php';
$database = (new Database())->connection();

/* Check Authentication */
require __DIR__ . '/src/views/access_token.view.php';

/* Check Collection */
require __DIR__ . '/src/controllers/collection.controller.php';
$collection = (new Collection())->Collection($database);

/* Check ID */
if (!isset($_GET['id'])) {
    $id = null;
} else {
    $id = $_GET['id'];
}

/* Check Upload File */
if (isset($_GET['collection']) && $_GET['collection'] === "file") {
    require __DIR__ . '/src/controllers/file.controller.php';
    (new FileController())->FileController($_SERVER['REQUEST_METHOD']);
    die();
}

/* Method Controller File */
require __DIR__ . '/src/controllers/method.controller.php';
(new MethodController())->methodController($_SERVER['REQUEST_METHOD'], $collection, $id, __DIR__);