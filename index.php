<?php
/**
 * Created by PhpStorm.
 * User: Bishaka
 * Date: 31/10/2015
 * Time: 22:01
 */
require 'vendor/autoload.php';
require 'Speeda.php';

if (isset($_SERVER['HTTP_ORIGIN'])) {
    header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
    header('Access-Control-Allow-Credentials: true');
    header('Access-Control-Max-Age: 86400');    // cache for 1 day
}

// Access-Control headers are received during OPTIONS requests
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");

    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");

}


$app = new \Slim\Slim();

$app->response->headers->set('Content-Type', 'application/json');

// return HTTP 200 for HTTP OPTIONS requests
$app->map('/:x+', function($x) {
    http_response_code(200);
})->via('OPTIONS');

$app->get('/', function () {
    $speeda = new Speeda();
    echo json_encode($speeda->helloWorld());
});


$app->run();