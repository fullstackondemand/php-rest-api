<?php

/* Include View Files */
include 'views/header.view.php';
include 'views/table.view.php';

/* Check ID */
if(!isset($_GET['id'])) { $id = null; }
else { $id = $_GET['id']; }

/* Method Controller File */
include 'controllers/method.controller.php';
$method = new MethodController();
$method->MethodController($_SERVER['REQUEST_METHOD'], $table , $id);

?>