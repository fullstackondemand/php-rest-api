<?php 

/* GET Class */
class GetModel {
  
  function __construct() { }

  /* GET All Data */
  function getData($table, $id) {
    
    /* Check ID */
    if(!isset($id)) { $where = ''; }
    else { $where = "WHERE id = $id"; }
    
    /* Include Database File */
    include 'views/database.view.php';
    
    /* Get All Data */
    $sql = "SELECT * FROM  $table $where";
    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
      echo json_encode(array('status'=>'Success', 'data'=>mysqli_fetch_all($result, MYSQLI_ASSOC)));
    } 
    else {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }
  }
}