<?php
require __DIR__ . '/../../MODEL/formaggy.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[6])) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$formaggy = new Formaggy();

$result = $formaggy->getFormaggyIngredients($parts[6]);

if ($result != false) {
    echo json_encode($result);
} else {
    http_response_code(400);
    echo json_encode(["message" => "ingredients not found"]);
}
