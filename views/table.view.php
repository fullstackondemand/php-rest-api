<?php

/* Check Table Name */
if(!isset($_GET['table'])) {
    echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
    die();
}
else { $table = $_GET['table']; }

?>