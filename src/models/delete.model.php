<?php

/* DELETE Model Class */
class DeleteModel {

  function __construct() { }

  /* DELETE Document */
  function deleteDocument($collection, $id) {

    /* Check ID */
    if (!isset($id)) {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    }

    /* Delete Document */
    $deleteResult = $collection->deleteOne(['_id' => (new MongoId($id))->toBSONType()]);

    if ($deleteResult->getDeletedCount() == 1) {
      echo json_encode(array('status' => 'Success', 'message' => 'Document is Deleted.'));
    } 
    else {
      echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid input.'));
      die();
    }

  }
}