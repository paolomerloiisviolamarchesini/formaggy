<?php
require __DIR__ . '/../../MODEL/size.php';

header("Content-type: application/json; charset=UTF-8");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$size = new Size();

$result = $size->getArchiveSize();
$sizeArchivesizes = array();
for ($i = 0; $i < (count($result)); $i++) {
$sizeArchivesize = array(
    "id" => $result[$i]["id"],
    "weight" => $result[$i]["weight"]
);
array_push($sizeArchivesizes, $sizeArchivesize);
}

if (empty($sizeArchivesizes)) {
    echo json_encode(404);
    echo json_encode(["messaggio" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($sizeArchivesizes);
}
?>
