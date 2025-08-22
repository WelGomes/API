<?php

require_once('../../vendor/autoload.php');
require_once('../config/Routes.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once('../app/models/DataBase.php');

$uri = $_SERVER['REQUEST_URI'];
$request = $_SERVER['REQUEST_METHOD'];

try {
    $routes = new Routes(
        uri: $uri,
        request: $request
    );

    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'data' => [
            $routes->routes()
        ],
    ]);
} catch (Exception $e) {
    http_response_code(400);
    echo json_encode([
        'status' => 'error',
        'data' => [
            $e->getMessage()
        ],
    ]);
}
