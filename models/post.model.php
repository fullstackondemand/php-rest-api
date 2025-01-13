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
    $vals = array();

    foreach (array_values($data) as $value) {

      // Array convert to String
      if (is_array($value)) {
        $value = json_encode($value);
      }

      // Value Push in Array
      array_push($vals, html_entity_decode($value));
    }

    $val = implode("','", $vals);

    $sql = "INSERT INTO $table ($keys) VALUES ('$val')";

    if ($con->query($sql) === TRUE) {
      echo json_encode(array('status'=>'Success', 'message'=>'Data is Inserted.'));
    }
    else {
      echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid input.'));
      die();
    }
  }
}