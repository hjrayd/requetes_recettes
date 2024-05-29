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
                        }
                }
                    header("Location:recettes.php");
                    break;
                
               
                case "addRecette": if (isset($_POST['submit'])){
    
                   $nomRecette = filter_input(INPUT_POST, "nomRecette", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $temps = filter_input(INPUT_POST, "temps", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                    $instruction = filter_input(INPUT_POST, "instruction", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                    $image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                  

    
                        if($nomRecette && $temps && $instruction && $image) {
    
                            $recette = [
                            "nomRecette" => $nomRecette,
                            "temps" => $temps,
                            "instruction" => $instruction,
                            "image" => $image
                          
                            ];
                   
                            $sql2 = "INSERT INTO recipe (recipe_name, preparation_time, instructions, image)
                            VALUES (:nomRecette, :temps, :instruction, :image)";
                             $recettesStatement = $mysqlClient->prepare($sql2);
                             $recettesStatement->execute($recette);   
                        
                        }
    
                }
      
                    header("Location:recettes.php");
                    break;
            }
                  
        } 
             

                
                    
    ?>