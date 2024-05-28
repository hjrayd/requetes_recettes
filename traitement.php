<?php 
    session_start();
    if(isset($_GET['action'])) {
        switch($_GET['action']) {
    
            case "add": if (isset($_POST['submit'])){
                if(isset($_FILES['file'])){
                    $name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING); 
                    $unity = filter_input(INPUT_POST, "qtt", FILTER_SANITIZE_STRING);
                    $price = filter_input(INPUT_POST, "price", FILTER_VALIDATE_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                   
    
                        if($name && $unity && $price) {
    
                            $ingredient = [
                            "name" => $name,
                            "unity"=> $unity,
                            "price" => $price,
                            ];
                   
                    $_SESSION['recette'][] = $ingredient;
                    
                    $_SESSION['message'] = "L'ingrédient a bien été ajouté.";
                    
                        } else {
                            $_SESSION['message'] ="L'ingrédient n'a pas pu être ajouté'.";
                            }
                        }
                    }
                }
            }
                    
                    header("Location:recettes.php");
                    break;
    