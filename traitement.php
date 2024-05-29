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

            case "add": if (isset($_POST['submit'])){
                
                    $nom = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
                    $unity = filter_input(INPUT_POST, "unity", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);

                   
    
                        if($nom && $unity && $price) {
    
                            $ingredient = [
                            "nom" => $nom,
                            "unity"=> $unity,
                            "price" => $price,
                            ];

                            $sql = "INSERT INTO ingredient (ingredient_name, unity, price)
                            VALUES (:nom, :unity, :price)";
                             $recetteStatement = $mysqlClient->prepare($sql);
                             $recetteStatement->execute($ingredient);    

                             $_SESSION['message'] = "L'ingrédient a bien été ajouté.";
                
                            } else {
                                $_SESSION['message'] ="L'ingrédient n'a pas pu être ajouté'.";
                                }
                        }
                       
                     header("Location:recettes.php");
                    break;
                    
                
               
                case "addRecette": if (isset($_POST['submit'])){
    
                   $nomRecette = filter_input(INPUT_POST, "nomRecette", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $temps = filter_input(INPUT_POST, "temps", FILTER_FLAG_ALLOW_FRACTION);
                    $instructions = filter_input(INPUT_POST, "instructions", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

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