<?php
require __DIR__ . '/../../MODEL/size.php';
header("Content-type: application/json; charset=UTF-8");

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
    echo json_encode(["messaggio" => "Nessuna dimensione è stata trovata"]);
} else {
    http_response_code(200);
    echo json_encode($sizeArchivesizes);
}
