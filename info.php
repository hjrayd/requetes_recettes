<?php

session_start();

try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=recettes_hajar;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT DISTINCT recipe_name, ingredient_name, recipe_ingredient.quantity, ingredient.unity, recipe.preparation_time, recipe.instructions, recipe.image
FROM ingredient
INNER JOIN recipe_ingredient
ON ingredient.id_ingredient = recipe_ingredient.id_ingredient
INNER JOIN recipe
ON recipe_ingredient.id_recipe = recipe.id_recipe
WHERE recipe.id_recipe = :id_recipe';


$get_id_recipe = $_GET['id'];
$recipeStatement = $mysqlClient->prepare($sqlQuery);
$recipeStatement -> execute(["id_recipe" => $get_id_recipe]);
$recipes = $recipeStatement->fetchAll();

echo "<table>
        <tr>
            <th> Nom de la recette </th>
            <th>Ingredient</th>
            <th>Quantité</th>
            <th>Temps de préparation</th>
            <th>Instructions</th>
            <th>Image</th>
        </tr>";

        foreach ($recipes as $recipe) {
            echo "<tr>
            <td>".$recipe['recipe_name']."</td>
          <td>".$recipe['ingredient_name']."</td>
          <td>".$recipe['quantity'].$recipe['unity']."</td>";
        }

    echo 
        "<td>".$recipe['preparation_time']."</td>
          <td>".$recipe['instructions']."</td>
          <img src='{$recipe['image']}' alt='Image de la recette'/>";

        echo "</table>"

        ?>