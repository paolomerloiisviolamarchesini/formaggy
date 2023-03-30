<?php
require __DIR__ . '/../../MODEL/order.php';
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

$order = new Order();

$result = $order->getOrder($parts[5]);
$getOrderFormaggy = $order->getOrderFormaggy($parts[5]);
$formaggy = array(
    "id" => $result["id"],
    "username" => $result["username"],
    "address" => $result["address"],
    "date_order" => $result["date_order"],
    "total_price" => $result["total_price"],
    "status" => $result["status"],
    "formaggy" => $getOrderFormaggy
);

if ($result != false) {
    echo json_encode($formaggy);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Product not found"]);
}
?>
