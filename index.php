<?php

/* Include View Files */
include 'views/header.view.php';
include 'views/table.view.php';

/* Check ID */
if(!isset($_GET['id'])) { $id = null; }
else { $id = $_GET['id']; }

/* Check Upload File */
if(isset($_GET['table']) && $_GET['table'] === "file") {
    include 'controllers/file.controller.php';
    $file = new FileController();
    $file->FileController($_SERVER['REQUEST_METHOD']);
    die();
}

/* Method Controller File */
include 'controllers/method.controller.php';
$method = new MethodController();
$method->methodController($_SERVER['REQUEST_METHOD'], $table , $id);

?>