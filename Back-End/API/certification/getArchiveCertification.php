<?php
require __DIR__ . '/../../MODEL/certification.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$certification = new Certification();

$result = $certification->getArchiveCertification();
$certificationArchivecertifications = array();
for ($i = 0; $i < (count($result)); $i++) {
$certificationArchivecertification = array(
    "id" => $result[$i]["id"],
    "acronym" => $result[$i]["acronym"],
    "name" => $result[$i]["name"]
);
array_push($certificationArchivecertifications, $certificationArchivecertification);
}

if (empty($certificationArchivecertifications)) {
    echo json_encode(404);
    echo json_encode(["messaggio" => "Nessuna certificazione è stata trovata"]);
} else {
    http_response_code(200);
    echo json_encode($certificationArchivecertifications);
}
