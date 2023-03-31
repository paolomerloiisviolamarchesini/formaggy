<?php
require __DIR__ . '/../../MODEL/order.php';

header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$order = new Order();
$result = $order->getArchiveOrder();
$orderArchiveOrders = array();

for ($i = 0; $i < (count($result)); $i++) {
    $getOrderFormaggy = $order->getOrderFormaggy($result[$i]["id"]);
    $productArchiveOrder = array(
        "id" => $result[$i]["id"],
        "username" => $result[$i]["username"],
        "address" => $result[$i]["address"],
        "date_order" => $result[$i]["date_order"],
        "total_price" => $result[$i]["total_price"],
        "status" => $result[$i]["status"],
        "formaggy" => $getOrderFormaggy
    );
    array_push($orderArchiveOrders, $productArchiveOrder);
}

if (empty($orderArchiveOrders)) {
    http_response_code(404);
    echo json_encode(["Message" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($orderArchiveOrders);
}
?>
