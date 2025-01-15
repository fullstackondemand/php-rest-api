<?php
require __DIR__ . '/vendor/autoload.php';

/** Environment Variables */
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

/** External Files */
require 'src/database.container.php';
require 'src/main.php';

/** App Execute or Run */
$app->run();