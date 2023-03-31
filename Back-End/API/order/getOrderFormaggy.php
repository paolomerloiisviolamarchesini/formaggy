<?php
require __DIR__ . '/../../MODEL/order.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[6])) {
    http_response_code(404);
    echo json_encode(["message" => "Inserisci un ID valido"]);
    exit();
}

$order = new Order();

$result = $order->getOrderFormaggy($parts[6]);

if ($result != false) {
    echo json_encode($result);
} else {
    http_response_code(400);
    echo json_encode(["messaggio" => "Ordine non trovato"]);
}
