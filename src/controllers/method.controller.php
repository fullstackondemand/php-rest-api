<?php

/* Method Controller Class */
class MethodController {

    function __construct() { }

    /* Check Method Function */
    function methodController($method, $collection, $id, $dir) {

        switch ($method) {

            /* GET Method */
            case "GET":

                /* GET Model File */
                require $dir . '/src/models/get.model.php';
                (new GetModel())->getDocument($collection, $id);
                break;

            /* POST Method */
            case "POST":

                /* Recive POST Data */
                $data = file_get_contents('php://input');

                /* POST Model File */
                require $dir . '/src/models/post.model.php';
                (new PostModel())->postDocument($collection, $data);
                break;

            /* PUT Method */
            case "PUT":

                /* Recive PUT Data */
                $data = file_get_contents('php://input');

                /* PUT Model File */
                require $dir . '/src/models/put.model.php';
                (new PutModel())->putDocument($collection, $id, $data);
                break;

            /* DELETE Method */
            case "DELETE":

                /* DELETE Model File */
                require $dir . '/src/models/delete.model.php';
                (new DeleteModel())->deleteDocument($collection, $id);
                break;
        }
        
    }
}