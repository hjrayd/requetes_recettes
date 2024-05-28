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

$sqlQuery = 'SELECT recipe_name
FROM recipe
ORDER BY preparation_time DESC';

$recipeStatement = $mysqlClient->prepare($sqlQuery);
$recipeStatement -> execute();
$recipes = $recipeStatement->fetchAll();

echo "<table>
        <tr>
            <th>Nom de la recette</th>
        </tr>";

        foreach ($recipes as $recipe) {
            echo "<tr>
            <td><a href='info.php?id=".$recipe['id_recipe']."'>".$recipe['recipe_name']."</a></td>";
        }
    
        echo "</table>"

        ?>