<?php
require __DIR__ . '/../../MODEL/warehouse.php';

header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

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
    echo json_encode(["message" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($warehouseArchiveWarehouses);
}

?>
