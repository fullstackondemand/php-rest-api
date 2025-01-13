<?php 

/* POST Class */
class PostModel {
  
  function __construct() { }

  /* POST Data */
  function postData($table, $data) {
    
    /* Check Data */
    if(!isset($data)) { 
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
     }

    /* Include Database File */
    include 'views/database.view.php';

    /* Insert Data */
    $data = json_decode($data, true); 
    $keys = implode(",", array_keys($data));
    $vals = implode("','", array_values($data));
    
    $sql = "INSERT INTO $table ($keys) VALUES ('$vals')";

    if ($con->query($sql) === TRUE) {
      echo json_encode(array('status'=>'Success', 'message'=>'Data is Inserted.'));
    } 
    else {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }
  }
}