<?php

require __DIR__ . '/../../MODEL/dairy.php';

header("Content-type: application/json; charset=UTF-8");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$query = new Dairy;
$result = $query->getArchiveDairy();

$archiveDairies = array();
for ($i = 0; $i < (count($result)); $i++) {
    $archiveDairy = array(
        "id" =>  $result[$i]["id"],
        "name" => $result[$i]["name"],
        "address" => $result[$i]["address"],
        "telephon_number" => $result[$i]["telephon_number"],
        "email" => $result[$i]["email"],
        "website" => $result[$i]["website"],
    );
    array_push($archiveDairies, $archiveDairy);
}

if (!empty($archiveDairies)) {
    echo json_encode($archiveDairies);
} else {
    http_response_code(404);
    echo json_encode(["message" => "Can't find any dairies"]);
}

?>
