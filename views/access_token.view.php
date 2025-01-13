<?php

/* Check Access Token */
if(isset($_GET['access_token'])) {

    if ($_GET['access_token'] != ACCESS_TOKEN) {
        echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid access token'));
        die();
    }
}

/* Check Authorization */
else if (isset($headers['Authorization'])) {

    if ($headers['Authorization'] != "Bearer ".ACCESS_TOKEN) {
        echo json_encode(array('status'=>'Fail', 'error'=>'Please provide valid access token'));
        die();
    }
}

else {
    echo json_encode(array('status'=>'Fail', 'error'=>'Please provide access token'));
    die();
}

?>