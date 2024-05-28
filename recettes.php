<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <title>Recette</title>
</head>
<body>
    
    <?php

    try
{
    $mysqlClient = new PDO('mysql:host=localhost;dbname=recettes_hajar;charset=utf8', 'root', '');
}
catch (Exception $e)
{
    die('Erreur : ' . $e->getMessage());
}

$sqlQuery = 'SELECT recipe_name, preparation_time, id_recipe
FROM recipe
ORDER BY preparation_time DESC';

$recipeStatement = $mysqlClient->prepare($sqlQuery);
$recipeStatement -> execute();
$recipes = $recipeStatement->fetchAll();

echo "<table class='table'>
        <tr>
            <th>Nom de la recette</th>
        </tr>";

        foreach ($recipes as $recipe) {
            echo "<tr>
            <td><a class='link-offset-2 link-underline link-underline-opacity-0' href='info.php?id=".$recipe['id_recipe']."'>".$recipe['recipe_name']."</a></td>";
        }
    
        echo "</table>"

        ?>
</body>
</html>
