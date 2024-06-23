<?php

require dirname(__DIR__, 1) . '/vendor/autoload.php';

use EdSDK\FlmngrServer\FlmngrServer;

// Uncomment line below to enable CORS if your request domain and server domain are different
header('Access-Control-Allow-Origin: *');

FlmngrServer::flmngrRequest([
    'dirFiles' => __DIR__ . '/imgs/uploads/story/images/',
]);
