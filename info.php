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



$sqlQuery = 'SELECT *
FROM recipe
WHERE recipe.id_recipe = :id';

$id = $_GET['id'];
$recetteStatement = $mysqlClient->  prepare($sqlQuery);
$recetteStatement -> execute(["id" => $id]);
$recettes = $recetteStatement->fetch();

echo "<h2 class='text-center' >".$recettes['recipe_name']." </h2> <br>";


$sqlQuery2 = 'SELECT DISTINCT recipe_name, ingredient_name, recipe_ingredient.quantity, ingredient.unity, recipe.preparation_time, recipe.instructions, recipe.image
FROM ingredient
INNER JOIN recipe_ingredient
ON ingredient.id_ingredient = recipe_ingredient.id_ingredient
INNER JOIN recipe
ON recipe_ingredient.id_recipe = recipe.id_recipe
WHERE recipe.id_recipe = :id';

$recipeStatement = $mysqlClient->prepare($sqlQuery2);
$recipeStatement -> execute(["id" => $id]);
$recipes = $recipeStatement->fetchAll();

echo "<table class='table'>
        <tr>
            <th>Ingredient</th>
            <th>Quantité</th>";

    

 foreach ($recipes as $recipe) {
            echo "<tr>
          <td>".$recipe['ingredient_name']."</td>
          <td>".$recipe['quantity'].$recipe['unity']."</td> <br>"
          ;
        }

     echo "<br> <img class='rounded mx-auto d-block' src='{$recipe['image']}' alt='Image de la recette'/> <br>";

        echo "</table>";
       echo  "<br> <h4 class='text-center'>".$recipe['preparation_time']." minutes </h3>  <br>";
        echo "<br> <p class='text-center'>".$recipe['instructions']." </p> <br>";
        



        ?>

        </body>
</html>
