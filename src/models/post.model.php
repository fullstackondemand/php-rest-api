<?php

/* Post Model Class */
class PostModel {

  function __construct() { }

  /* POST Document */
  function postDocument($collection, $data) {

    /* Check Data */
    if ($data == '') {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    }

    /* Insert Document */
    $data = json_decode($data, true);
    $postResult = $collection->insertOne($data);

    if ($postResult->getInsertedCount() == 1) {
      echo json_encode(array('status' => 'Success', 'message' => 'Document is Inserted.'));
    } 
    else {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    }

  }
}