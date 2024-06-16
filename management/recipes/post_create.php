<?php
session_start();

include_once('../database/database.php');
    
include_once('../use/variables.php');

// Vérification du formulaire soumis
if (!isset($_POST['title'])
    || !isset($_POST['recipe'])
	|| !isset($_POST['author'])
	|| !isset($_POST['is_enabled'])
	
    )
{
	echo 'Il faut renseigner tout le formulaire pour enregistrer une requette.';
    return;
}	

$title = $_POST['title'];
$recipe = $_POST['recipe'];
$author = $_POST['author'];
$is_enabled = $_POST['is_enabled'];

// Faire l'insertion en base
$insertRecipe = $mysqlClient->prepare('INSERT INTO recette(title, recipe, author, is_enabled) VALUES (:title, :recipe, :author, :is_enabled)');
$insertRecipe->execute([
    'title' => $title,
    'recipe' => $recipe,
	'author' => $author,
    'is_enabled' => $is_enabled,
    
]); 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Création de recette</title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <!-- MESSAGE DE SUCCES -->
    <?php include_once('../header.php'); ?>
        <h1>Recette ajoutée avec succès !</h1>
        
        <div class="card">
            
            <div class="card-body">
                <h5 class="card-title"><?php echo $title ; ?></h5>
                <p class="card-text"><b>Auteur</b> : <?php echo $author; ?></p>                
				<p class="card-text"><b>Recette</b> : <?php echo strip_tags($recipe); ?></p>
				<p class="card-text"><b>Est valide</b> : <?php echo $is_enabled; ?></p>
            </div>
        </div>
    </div>
    <?php include_once('../footer.php'); ?> 
</body>
</html>
