<?php 

/* Include Varibles File */
include 'env.php';

/* Create connection */
$con = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
            
/* Check connection */
if ($con->connect_error) {
        die("Connection failed: " . $con->connect_error);	  
}

/* Change Character Set to UTF8 */
$con->set_charset("utf8");

?>