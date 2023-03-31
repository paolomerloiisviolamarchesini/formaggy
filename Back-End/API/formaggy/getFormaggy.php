<?php

require __DIR__ . '/../../MODEL/formaggy.php';

header("Content-type: application/json; charset=UTF-8");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[5])) {
    http_response_code(404);
    echo json_encode(["message" => "Inserisci un ID valido"]);
    exit();
}

$formaggy = new Formaggy();

$result = $formaggy->getFormaggy($parts[5]);
$ingredients = $formaggy->getFormaggyIngredients($parts[5]);
$sizes = $formaggy->getFormaggySizes($parts[5]);
$formaggyArchiveFormaggy = array(
    "id" => $result["id"],
    "name" => $result["name"],
    "description" => $result["description"],
    "price_kg" => $result["price_kg"],
    "category" => $result["category"],
    "certification" => $result["certification"],
    "color" => $result["color"],
    "smell" => $result["smell"],
    "taste" => $result["taste"],
    "expiry_date" => $result["expiry_date"],
    "kcal" => $result["kcal"],
    "fats" => $result["fats"],
    "satured_fats" => $result["satured_fats"],
    "carbohydrates" => $result["carbohydrates"],
    "sugars" => $result["sugars"],
    "proteins" => $result["proteins"],
    "fibers" => $result["fibers"],
    "salts" => $result["salts"],
    "sizes" => $sizes,
    "ingredients" => $ingredients
);

if ($result != false) {
    echo json_encode($formaggyArchiveFormaggy);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Formaggyo non trovato"]);
}

?>
