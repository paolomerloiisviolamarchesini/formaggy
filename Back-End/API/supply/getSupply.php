<?php

require __DIR__ . '/../../MODEL/supply.php';
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[5])) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$supply = new Supply();

$result = $supply->getSupply($parts[5]);
$getSupplyFormaggy = $supply->getSupplyFormaggy($parts[5]);
$formaggy = array(
    "id" => $result["id"],
    "username" => $result["username"],
    "dairy_name" => $result["dairy_name"],
    "date_supply" => $result["date_supply"],
    "total_price" => $result["total_price"],
    "status" => $result["status"],
    "formaggy" => $getSupplyFormaggy
);

if ($result != false) {
    echo json_encode($formaggy);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Product not found"]);
}
?>
