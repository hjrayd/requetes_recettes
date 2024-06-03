
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

    if(isset($_GET['action'])) {
        switch($_GET['action']) {
            case "addIngredient": if (isset($_POST['submit'])){
    
                 $ingredient = filter_input(INPUT_POST, "ingredient", FILTER_VALIDATE_INT );
                 $recipe = filter_input(INPUT_POST, "recipe", FILTER_VALIDATE_INT );
                 $quantity = filter_input(INPUT_POST, "quantity", FILTER_VALIDATE_INT );

                     if($ingredient && $recipe && $quantity) {
 
                         $recipeIngredient = [
                         "ingredient" => $ingredient,
                         "recipe" => $recipe,
                         "quantity" => $quantity
                         ];
                
                         $sqlll = "INSERT INTO recipe_ingredient (id_recipe, id_ingredient, quantity)
                         VALUES (:recipe, :ingredient, :quantity)";
                        $recipeStmt = $mysqlClient->prepare($sqlll);
                        $recipeStmt->execute($recipeIngredient);   

                          $_SESSION['message'] = "Les ingrédients ont bien été ajoutés.";
             
                         } else {
                             $_SESSION['message'] ="Les ingrédients n'ont pas pu être ajoutés.";
                             }
                         
                     } header("Location:recettes.php");
                 break;
                }
                    }
                    ?>