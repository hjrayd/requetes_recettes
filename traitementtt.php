

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
                 $qte = filter_input(INPUT_POST, "qte", FILTER_VALIDATE_INT );

                     if($ingredient && $recipe && $qte) {
 
                         $recipeIngredient = [
                         "ingredient" => $ingredient,
                         "recipe" => $recipe,
                         "qte" => $qte
                         ];
                
                         $sqlll = "INSERT INTO recipe_ingredient (id_recipe, id_ingredient, quantity)
                         VALUES (:recipe :ingredient :qte)";
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