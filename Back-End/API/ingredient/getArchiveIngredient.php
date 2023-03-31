<?php
require __DIR__ . '/../../MODEL/ingredient.php';
header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

header("Content-type: application/json; charset=UTF-8");
header("Content-type: application/json; charset=UTF-8");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Origin');

$ingredient = new Ingredient();

$result = $ingredient->getArchiveIngredient();
$ingredientArchiveIngredients = array();

for ($i = 0; $i < (count($result)); $i++) {
$ingredientArchiveIngredient = array(
    "id" => $result[$i]["id"],
    "name" => $result[$i]["name"],
    "description" => $result[$i]["description"]
);
array_push($ingredientArchiveIngredients, $ingredientArchiveIngredient);
}

if (empty($ingredientArchiveIngredients)) {
    echo json_encode(404);
    echo json_encode(["message" => "La ricerca non ha prodotto risultati"]);
} else {
    http_response_code(200);
    echo json_encode($ingredientArchiveIngredients);
}

?>
