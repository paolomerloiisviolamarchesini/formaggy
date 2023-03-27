<?php
require __DIR__ . '/../../MODEL/warehouse.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$warehouse = new Warehouse();

$result = $warehouse->getArchiveWarehouse();
$warehouseArchiveWarehouses = array();
for ($i = 0; $i < (count($result)); $i++) {
$warehouseArchiveWarehouse = array(
    "id" => $result[$i]["id"],
    "address" => $result[$i]["address"]
);
array_push($warehouseArchiveWarehouses, $warehouseArchiveWarehouse);
}

if (empty($warehouseArchiveWarehouses)) {
    echo json_encode(404);
    echo json_encode(["message" => "Can't find any warehouse"]);
} else {
    http_response_code(200);
    echo json_encode($warehouseArchiveWarehouses);
}
