<?php

/* GET Model Class */
class GetModel {

  function __construct() { }

  /* GET Document */
  function getDocument($collection, $id) {

    /* Get Document by _id */
    if ($id == '') {
      $resultArr =  $collection->find()->toArray();

      /* BSONObjectID convert to String */
      $getResult = array();
      foreach ($resultArr as $result) {
        $result['_id'] = $result->_id->__toString();
        array_push($getResult, $result);
      }

    }

    /* Get All Document */ 
    else {
      $getResult =  $collection->findOne(["_id"  => (new MongoId($id))->toBSONType()]);
      $getResult['_id'] = $getResult->_id->__toString();
    }

    if (is_null($getResult)) {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    } 
    else {
      echo json_encode(array('status' => 'Success', 'data' => $getResult));
    }

  }
}
