<?php 

/* Delete Class */
class DeleteModel {
  
  function __construct() { }

  /* DELETE Data */
  function deleteData($table, $id) {

    /* Check ID */
    if(!isset($id)) { 
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
     }

    /* Include Database File */
    include 'views/database.view.php';

    /* Delete Data */
    $sql = "DELETE FROM $table WHERE id= $id";

    if ($con->query($sql) === TRUE) {
      echo json_encode(array('status'=>'Success', 'message'=>'Data is Deleted.'));
    } 
    else {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }
  }
}