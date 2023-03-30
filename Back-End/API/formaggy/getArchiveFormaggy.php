<?php
require __DIR__ . '/../../MODEL/formaggy.php';
header("Content-type: application/json; charset=UTF-8");
$parts = explode("/", $_SERVER["REQUEST_URI"]);

$formaggy = new Formaggy();
$result = $formaggy->getArchiveFormaggy();
$formaggyArchiveFormaggys = array();
for ($i = 0; $i < (count($result)); $i++) {
    $ingredients = $formaggy->getFormaggyIngredients($result[$i]["id"]);
    $sizes = $formaggy->getFormaggySizes($result[$i]["id"]);
    $formaggyArchiveFormaggy = array(
        "id" => $result[$i]["id"],
        "name" => $result[$i]["name"],
        "description" => $result[$i]["description"],
        "price_kg" => $result[$i]["price_kg"],
        "category" => $result[$i]["category"],
        "certification" => $result[$i]["certification"],
        "color" => $result[$i]["color"],
        "smell" => $result[$i]["smell"],
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
    array_push($formaggyArchiveFormaggys, $formaggyArchiveFormaggy);
}
if (empty($formaggyArchiveFormaggys)) {
    http_response_code(404);
    echo json_encode(["Message" => "Can't find any cheese"]);
} else {
    http_response_code(200);
    echo json_encode($formaggyArchiveFormaggys);
}
