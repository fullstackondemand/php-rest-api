<?php

/* PUT Class */
class PutModel {

  function __construct() { }

  /* PUT Data */
  function putData($table, $id, $data) {

    /* Check Data and Check ID */
    if(!isset($data) && !isset($id)) {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }

    /* Include Database File */
    include 'views/database.view.php';

    /* Update Data */
    $data = json_decode($data, true);
    $dataString = '';

    foreach($data as $key=>$value) {

      // Array convert to String
      if (is_array($value)) {
        $value = json_encode($value);
      }

      $dataString = $dataString."$key = '$value', ";
    }

    $dataString =  substr($dataString, 0, -2);

    $sql = "UPDATE $table SET $dataString  WHERE id = $id";

    if ($con->query($sql) === TRUE) {
      echo json_encode(array('status'=>'Success', 'message'=>'Data is Updated.'));
    }
    else {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }
  }
}