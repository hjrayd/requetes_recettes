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

                            }

                        } 
            
               