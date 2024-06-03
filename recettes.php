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
 if (isset($_SESSION["message"]))
 {
     echo $_SESSION["message"]; 
     unset($_SESSION["message"]); 
 }
 ?>
    <!--Formulaire ingrédient-->
    <form action="traitement.php?action=add" method="post">
            <p>
                <label class="form-label" >
                    Nom de l'ingrédient : 
                    <input class="form-control" type="text" name="nom">
                </label>
            </p>
            <p>
                <label class="form-label">
                    Unité: 
                    <input class="form-control" type="text" name="unity">
                </label>
            </p>
            <p>
                <label class="form-label">
                    Prix: 
                    <input class="form-control" type="number" name="price" value="1">
                </label>
            </p>
            <input type="submit" name="submit" value="Ajouter l'ingrédient">
            <br>
        </form> <br>

        <!--Formulaire recette-->
        <form action="traitementt.php?action=addRecette" method="post">
            <p>
                <label class="form-label" >
                    Nom de la recette: 
                    <input class="form-control" type="text" name="nomRecette">
                </label>
            </p>
            <p>
                <label class="form-label">
                    Temps de préparation: 
                    <input class="form-control" type="number" name="temps">
                </label>
            </p>
            <p>
                <label class="form-label">
                    Instructions:
                    <textarea class="form-control" name="instructions" rows="5" cols="33">
                </textarea>
            </label>
            </p>
            <p>
                <label class="form-label">
                    <select name ="category" class="form-select" aria-label="Default select example">
                        Catégorie:
                        <option value ="1">Entrée</option>
                        <option value ="2">Plat</option>
                        <option value ="3">Dessert</option>
                    </select>
                </label>
            </p>
            <input type="submit" name="submit" value="Ajouter la recette">
            <br>
        </form>
        <br>
        <?php
        $sql = "SELECT ingredient_name FROM ingredient";
        $ingredientsStmt = $mysqlClient->query($sql);
        $ingredients = $ingredientsStmt->fetchAll();
        
        $sql = "SELECT recipe_name FROM recipe";
        $recipesStmt = $mysqlClient->query($sql);
        $recipes = $recipesStmt->fetchAll();

        ?>
         <!--Formulaire Ingredient/recette-->
        <form action="traitementtt.php?action=addIngredient" method="post">
            <label class="form-label">
                <!--PARTIE PHP-->
                    <?php
                echo '<select name="ingredient" class="form-select" aria-label="Default select example">';
                foreach ($ingredients as $ingredient) {
                    echo "<option value='".$ingredient['id_ingredient']."'>".$ingredient['ingredient_name']."</option>";
                }
                echo '</select>';
                    ?>
            </label> 
            <br>
            <label class="form-label" >
                <!--PARTIE PHP-->
                    <?php
                echo '<select name="recipe" class="form-select" aria-label="Default select example">';
                foreach ($recipes as $recipe) {
                    echo "<option value='".$recipe['id_recipe']."'>".$recipe['recipe_name']."</option>";
                }
                echo '</select> ';
                    ?>
            </label>
            <p>
                <label class="form-label">
                    Quantité: 
                    <input class="form-control" type="number" name="qte">
                </label>
            </p>
            <input type="submit" name="submit" value="Ajouter les ingrédients à la recette">
        </form>
            
<?php
$sqlQuery = 'SELECT recipe_name, preparation_time, id_recipe
FROM recipe
ORDER BY preparation_time DESC';

$recipeStatement = $mysqlClient->prepare($sqlQuery);
$recipeStatement -> execute();
$recipes = $recipeStatement->fetchAll();

echo "<table class='table'>
        <tr>
            <br> <th> Nom de la recette </th>
        </tr>";

        foreach ($recipes as $recipe) {
            echo "<tr>
            <td><a class='link-offset-2 link-underline link-underline-opacity-0' href='info.php?id=".$recipe['id_recipe']."'>".$recipe['recipe_name']."</a></td>";
        }
    
        echo "</table>";

        ?>
</body>
</html>