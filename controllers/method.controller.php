<?php 

/* Method Controller Class */
class MethodController {
    
    function __construct() { }

    /* Check Method Function */
    function methodController($method, $table, $id) {
        switch ($method) {

            /* GET Method */
            case "GET":
                
                /* Include GET Model File */
                include 'models/get.model.php' ;
                $get = new GetModel();
                $get->getData($table, $id);
            break;
    
            /* POST Method */
            case "POST":

                /* Recive POST Data */
                $data = file_get_contents('php://input');

                /* Include POST Model File */
                include 'models/post.model.php' ;
                $post = new PostModel();
                $post->postData($table, $data);
            break;
    
            /* PUT Method */
            case "PUT":

                /* Recive PUT Data */
                $data = file_get_contents('php://input');

                /* Include PUT Model File */
                include 'models/put.model.php' ;
                $put = new PutModel();
                $put->putData($table, $id, $data);
            break;
    
            /* DELETE Method */
            case "DELETE":

                /* Include DELETE Model File */
                include 'models/delete.model.php' ;
                $delete = new DeleteModel();
                $delete->deleteData($table, $id);
            break;
        }
    }
}

?>