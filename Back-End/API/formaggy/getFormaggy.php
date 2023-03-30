<?php
require __DIR__ . '/../../MODEL/formaggy.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

if (empty($parts[6])) {
    http_response_code(404);
    echo json_encode(["message" => "Insert a valid ID"]);
    exit();
}

$formaggy = new Formaggy();

$result = $formaggy->getFormaggy($parts[6]);
$ingredients = $formaggy->getFormaggyIngredients($parts[6]);
$sizes = $formaggy->getFormaggySizes($parts[6]);
$formaggyArchiveFormaggy = array(
    "id" => $result["id"],
    "name" => $result["name"],
    "description" => $result["description"],
    "price_kg" => $result["price_kg"],
    "category" => $result["category"],
    "certification" => $result["certification"],
    "color" => $result["color"],
    "smell" => $result["smell"],
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
    echo json_encode(["message" => "Cheese not found"]);
}
