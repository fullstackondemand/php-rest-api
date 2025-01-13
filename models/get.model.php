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

    while ($row = mysqli_fetch_assoc($result)) {
      $arr[] = $row;
    }

    foreach ($arr[0] as $key => $val) {

      // String convert to Array
      if (strpos($val, "[{") === 0) {
        $arr[0][$key] = json_decode($val, true);
      }
    }

    if (mysqli_num_rows($result) > 0) {
      echo json_encode(array('status'=>'Success', 'data'=>$arr));
    } 
    else {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }
  }
}