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
            case "addRecette": if (isset($_POST['submit'])){
    
                $nomRecette = filter_input(INPUT_POST, "nomRecette", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                 $temps = filter_input(INPUT_POST, "temps", FILTER_VALIDATE_INT );
                 $instructions = filter_input(INPUT_POST, "instructions", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                 $category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT );

                     if($nomRecette && $temps && $instructions && $category) {
 
                         $recette = [
                         "nomRecette" => $nomRecette,
                         "temps" => $temps,
                         "instructions" => $instructions,
                         "category" => $category
                         ];
                
                         $sqll = "INSERT INTO recipe (recipe_name, preparation_time, instructions, id_category)
                         VALUES (:nomRecette, :temps, :instructions, :category)";
                          $recettesStatement = $mysqlClient->prepare($sqll);
                          $recettesStatement->execute($recette);   

                          $_SESSION['message'] = "La recette a bien été ajoutée.";
             
                         } else {
                             $_SESSION['message'] ="La recette n'a pas pu être ajoutée.";
                             }
                         
                     } header("Location:recettes.php");
                 break;
                }
                    }
                    ?>