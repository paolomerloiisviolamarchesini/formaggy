<?php

spl_autoload_register(function ($class) {
    require __DIR__ . "/../../COMMON/$class.php";
});

require __DIR__ . '/../../MODEL/formaggy.php';
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    header('HTTP/1.1 200 OK');
}

$data = json_decode(file_get_contents("php://input"));


if (empty($data->id_formaggyo)) {
    http_response_code(400);
    echo json_encode(["message" => "Fill every field"]);
    die();
}

$formaggyo= new Formaggy();

if ($formaggyo->deleteFormaggyo($data->id_formaggyo)==1) {
    http_response_code(200);
    echo json_encode(["message" => "Formaggyo eliminato con successo"]);
}
else
{
    http_response_code(400);
    echo json_encode(["message" => "Problemi con l'eliminazione del formaggyo"]);
}
/*    "name":"prova",
    "description":"prova",
    "price_kg":145.21,
    "id_category":1,
    "id_certification":1,
    "color":"prova",
    "smell":"prova",
    "taste" :"prova",
    "expiry_date":"2023-12-2 15:20:03",
    "kcal":1,
    "fats":1,
    "satured_fats":1,
    "carbohydrates":1,
    "sugars":1,
    "proteins":1,
    "fibers":1,
    "salts":1,
    "id_ingredient":[1,2,3,4],
    "id_size":2*/ 
