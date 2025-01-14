<?php

/* Check Access Token */
if (isset($_GET['access_token'])) {

    if ($_GET['access_token'] != $_ENV['ACCESS_TOKEN']) {
        echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid access token'));
        die();
    }
}

/* Check Authorization */ 
else if (isset($headers['Authorization'])) {

    if ($headers['Authorization'] != "Bearer " . $_ENV['ACCESS_TOKEN']) {
        echo json_encode(array('status' => 'Fail', 'error' => 'Please provide valid access token'));
        die();
    }
}

/* Not Enter Token */ 
else {
    echo json_encode(array('status' => 'Fail', 'error' => 'Please provide access token'));
    die();
}

?>