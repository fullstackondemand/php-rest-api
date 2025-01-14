<?php

/* Collection Controller Class */
class Collection {

    /* Table Check Method Function */
    public function Collection($database) {

        /* Check Collection Name */
        if (!isset($_GET['collection'])) {
            echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid collection.'));
            die();
        } 
        else {
            $table = $database->{$_GET['collection']};
            return $table;
        }
        
    }
}