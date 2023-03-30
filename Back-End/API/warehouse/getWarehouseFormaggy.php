<?php
require __DIR__ . '/../../MODEL/warehouse.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[6])) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$warehouseformaggy = new Warehouse();

$result = $warehouseformaggy->getWarehouseFormaggy($parts[6]);
$warehouseArchiveFormaggys = array();
for ($i = 0; $i < (count($result)); $i++) {
$warehouseArchiveFormaggy = array(
    "id" => $result[$i]["id"],
    "name" => $result[$i]["name"],
    "weight" => $result[$i]["weight"]
);
array_push($warehouseArchiveFormaggys, $warehouseArchiveFormaggy);
}

if (empty($warehouseArchiveFormaggys)) {
    echo json_encode(404);
    echo json_encode(["message" => "there isn't cheese in warehouse"]);
} else {
    http_response_code(200);
    echo json_encode($warehouseArchiveFormaggys);
}
