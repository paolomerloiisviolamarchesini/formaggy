<?php
require __DIR__ . '/../../MODEL/warehouse.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[5])) {
    http_response_code(404);
    echo json_encode(["message" => "Inserisci un ID valido"]);
    exit();
}

$warehouseformaggy = new Warehouse();

$result = $warehouseformaggy->getWarehouseFormaggy($parts[5]);
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
    echo json_encode(["message" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($warehouseArchiveFormaggys);
}

?>
