
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
                if(isset($_FILES['file'])){
                    $tmpName = $_FILES['file']['tmp_name'];
                    $name = $_FILES['file']['name'];
                    $size = $_FILES['file']['size'];
                    $error = $_FILES['file']['error'];

        
                    $tabExtension = explode('.', $name);
                    $extension = strtolower(end($tabExtension));
                    //Tableau des extensions que l'on accepte 
                    $extensions = ['jpg', 'png', 'jpeg', 'gif'];
                    $maxSize = 400000;

                    if(in_array($extension, $extensions) && $size <= $maxSize && $error==0) {

                    $uniqueName = uniqid('', true);
                    $file= $uniqueName.".".$extension;
                    move_uploaded_file($tmpName, './upload/'.$file);
                   
                }
                else {
                    echo "Une erreur est survenue";
                }
    
                $nomRecette = filter_input(INPUT_POST, "nomRecette", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                 $temps = filter_input(INPUT_POST, "temps", FILTER_VALIDATE_INT );
                 $instructions = filter_input(INPUT_POST, "instructions", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                 $category = filter_input(INPUT_POST, "category", FILTER_VALIDATE_INT );
                 

                     if($nomRecette && $temps && $instructions && $category ) {
 
                         $recette = [
                         "nomRecette" => $nomRecette,
                         "temps" => $temps,
                         "instructions" => $instructions,
                         "category" => $category,
                         "image" => $file
                         ];
                
                         $sqll = "INSERT INTO recipe (recipe_name, preparation_time, instructions, id_category, image)
                         VALUES (:nomRecette, :temps, :instructions, :category; :file)";
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
                }
                    ?>