<?php

/* PUT Model Class */
class PutModel {

  function __construct() { }

  /* PUT Document */
  function putDocument($collection, $id, $data) {

    /* Check Data and ID */
    if ($data == '' || $id == '') {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    }

    /* Update Document */
    $data = json_decode($data, true);
    $putResult = $collection->updateOne(
      ['_id' => (new MongoId($id))->toBSONType()],
      ['$set' => $data]
    );

    if ($putResult->getModifiedCount() == 1) {
      echo json_encode(array('status' => 'Success', 'message' => 'Document is Updated.'));
    } 
    else {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    }
    
  }
}