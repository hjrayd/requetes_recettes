<?php

session_start()

try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=recettes_hajar;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT ingredient_name,recipe_ingredient.quantity, recipe.preparation_time, recipe.instructions
FROM ingredient
INNER JOIN recipe_ingredient
ON ingredient.id_ingredient = recipe_ingredient.id_ingredient
INNER JOIN recipe
ON recipe_ingredient.id_recipe = recipe.id_recipe;
WHERE recipe.id_recipe = :id_recipe';


$get_id_recipe = $_GET['id'];
$recipeStatement = $mysqlClient->prepare($sqlQuery);
$recipeStatement -> execute(["id_recipe" => $get_id_recipe]);
$recipes = $recipeStatement->fetchAll();

echo "<table>
        <tr>
        <th>Recette</th>
            <th>Temps de preparation </th>
        </tr>";

        foreach ($personnages as $personnage) {
            echo "<tr>
            <td>".$personnage."</td>";
        }
