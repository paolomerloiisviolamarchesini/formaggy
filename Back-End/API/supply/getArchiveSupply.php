<?php
require __DIR__ . '/../../MODEL/supply.php';

header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$supply = new Supply();
$result = $supply->getArchiveSupply();
$orderArchiveSupplys = array();

for ($i = 0; $i < (count($result)); $i++) {
    $getSupplyFormaggy = $supply->getSupplyFormaggy($result[$i]["id"]);
    $productArchiveSupply = array(
        "id" => $result[$i]["id"],
        "username" => $result[$i]["username"],
        "dairy_name" => $result[$i]["dairy_name"],
        "date_supply" => $result[$i]["date_supply"],
        "total_price" => $result[$i]["total_price"],
        "status" => $result[$i]["status"],
        "formaggy" => $getSupplyFormaggy
    );
    array_push($orderArchiveSupplys, $productArchiveSupply);
}

if (empty($orderArchiveSupplys)) {
    http_response_code(404);
} else {
    http_response_code(200);
    echo json_encode($orderArchiveSupplys);
}
?>
