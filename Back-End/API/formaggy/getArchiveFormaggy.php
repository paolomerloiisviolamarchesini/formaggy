<?php

require __DIR__ . '/../../MODEL/formaggy.php';

header("Content-type: application/json; charset=UTF-8");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$parts = explode("/", $_SERVER["REQUEST_URI"]);

$formaggy = new Formaggy();

$result = $formaggy->getArchiveFormaggy();
$formaggyArchiveFormaggy = array();

for ($i = 0; $i < (count($result)); $i++) {
    $ingredients = $formaggy->getFormaggyIngredients($result[$i]["id"]);
    $sizes = $formaggy->getFormaggySizes($result[$i]["id"]);
    $formaggyArchiveFormaggyo = array(
        "id" => $result[$i]["id"],
        "name" => $result[$i]["name"],
        "description" => $result[$i]["description"],
        "price_kg" => $result[$i]["price_kg"],
        "category" => $result[$i]["category"],
        "certification" => $result[$i]["certification"],
        "color" => $result[$i]["color"],
        "smell" => $result[$i]["smell"],
        "taste" => $result[$i]["taste"],
        "expiry_date" => $result[$i]["expiry_date"],
        "kcal" => $result[$i]["kcal"],
        "fats" => $result[$i]["fats"],
        "satured_fats" => $result[$i]["satured_fats"],
        "carbohydrates" => $result[$i]["carbohydrates"],
        "sugars" => $result[$i]["sugars"],
        "proteins" => $result[$i]["proteins"],
        "fibers" => $result[$i]["fibers"],
        "salts" => $result[$i]["salts"],
        "sizes" => $sizes,
        "ingredients" => $ingredients
    );
    array_push($formaggyArchiveFormaggy, $formaggyArchiveFormaggyo);
}
if (empty($formaggyArchiveFormaggy)) {
    http_response_code(404);
    echo json_encode(["Message" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($formaggyArchiveFormaggy);
}
?>
