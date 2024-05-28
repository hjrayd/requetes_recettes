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

$sqlQuery = 'SELECT DISTINCT ingredient_name, recipe_ingredient.quantity, ingredient.unity, recipe.preparation_time, recipe.instructions, recipe.image
FROM ingredient
INNER JOIN recipe_ingredient
ON ingredient.id_ingredient = recipe_ingredient.id_ingredient
INNER JOIN recipe
ON recipe_ingredient.id_recipe = recipe.id_recipe;
WHERE recipe.id_recipe = :id_recipe';


$get_id_recipe = $_GET['id'];
$infoStatement = $mysqlClient->prepare($sqlQuery);
$infoStatement -> execute(["id_recipe" => $get_id_recipe]);
$infos = $infoStatement->fetchAll();

echo "<table>
        <tr>
            <th>Ingredient</th>
            <th>Quantité</th>
            <th>Temps de préparation</th>
            <th>Instructions</th>
            <th>Image</th>
        </tr>";

        foreach ($infos as $info) {
            echo "<tr>
          <td>".$info['ingredient_name']."</td>
          <td>".$info['quantity'].$info['unity']."</td>
          <td>".$info['preparation_time']."</td>
          <td>".$info['instructions']."</td>
          <td>".$info['image']."</td>";
        }

        echo "</table>"

        ?>