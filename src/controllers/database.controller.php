<?php

/* Database Controller Class */
class Database {

    /* Connection Method Function */
    public function connection() {

        // Create a new client and connect to the server
        $client = new MongoDB\Client($_ENV['DATABASE_HOST']);

        try {

            // Send a ping to confirm a successful connection
            $database = $client->selectDatabase('php-rest-api');
            return $database;
        } 

        // Catch error to connection
        catch (Exception $e) {
            printf($e->getMessage());
        }

    }
}