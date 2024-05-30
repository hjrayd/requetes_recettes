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


    <!--Formulaire ingrédient-->
    <form action="traitementt.php?action=add" method="post">
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
        <form action="traitement.php?action=addRecette" method="post">
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
                    Instructions
                    <textarea class="form-control" name="instructions" rows="5" cols="33">
                </textarea>
            </label>
            </p>
            <p>
                <label class="form-label">
                    <select name ="category">
                        Catégorie
                        <option value ="1">Entrée</option>
                        <option value ="2">Plat</option>
                        <option value ="3">Dessert</option>
                        <!--php ne fonctionne pas ici non plus
                       $stmt = $pdo->query('SELECT id_category, name FROM category');
                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['id_categorie']). '">' . htmlspecialchars($row['id_category']) . '</option>';
                       }
                       ?>
                    -->
                    </select>
                </label>
            </p>
            <input type="submit" name="submit" value="Ajouter la recette">
            <br>
        </form>
        <br>
        
        <form action="traitementtt.php?action=addIngredient" method="post">
        <label class="form-label">
        <select name="ingrédients">
    <?php 
    $resultat = $connexion->query("SELECT id_ingredient, ingredient_name FROM recipe_ingredient");
    while($row = $resultat->fetch_assoc()) {
        echo "<option value='" . $row['id_ingredient'] . "'>" . $row['ingredient_name'] . "</option>";
    }
    ?>
</select>
</label>
</form>
         <!--Formulaire Ingredient/recette-->
         <!--Ne fonctionne pas à partir d'ici

         
         <form action="traitementtt.php?action=addIngredient" method="post">
            <p>
                <label class="form-label" >
                <select name ="recette">
                    Recette
                   
                   METTRE <PHP ICI
                       /*  $stmt = $pdo->query('SELECT id_recipe FROM recipe_ingredient');
                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['id_recipe']). '">' . htmlspecialchars($row['id_recipe']) . '</option>';
                       }
                       ?>
                    </select>
                </label>
            </p>
            <p>
                <label class="form-label" >
                <select name ="ingredient">
                    Ingredient
                    METTRE <PHP ICI
                    /*
                       $stmt = $pdo->query('SELECT id_ingredient FROM recipe_ingredient');
                       while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<option value="' . htmlspecialchars($row['id_ingredient']). '">' . htmlspecialchars($row['id_ingredient']) . '</option>';
                       }
                       ?>
                    </select>
                </label>
            </p>
            <p>
                <label class="form-label">
                    Quantité: 
                    <input class="form-control" type="number" name="qtt">
                </label>
            </p>
        </form>-->

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
$sqlQuery = 'SELECT recipe_name, preparation_time, id_recipe
FROM recipe
ORDER BY preparation_time DESC';

$recipeStatement = $mysqlClient->prepare($sqlQuery);
$recipeStatement -> execute();
$recipes = $recipeStatement->fetchAll();

echo "<table class='table'>
        <tr>
            <br> <th>Nom de la recette</th>
        </tr>";

        foreach ($recipes as $recipe) {
            echo "<tr>
            <td><a class='link-offset-2 link-underline link-underline-opacity-0' href='info.php?id=".$recipe['id_recipe']."'>".$recipe['recipe_name']."</a></td>";
        }
    
        echo "</table>";

        ?>
</body>
</html>
