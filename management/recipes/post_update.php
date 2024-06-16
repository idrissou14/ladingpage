<?php
session_start();

include_once('../database/database.php');
    
include_once('../use/variables.php');

$postData = $_POST;

if (
    !isset($postData['id'])
    || !isset($postData['title']) 
    || !isset($postData['recipe'])
    )
{
	echo 'Il manque des informations pour permettre l\'édition du formulaire.';
    return;
}	

$id = $postData['id'];
$title = $postData['title'];
$recipe = $postData['recipe'];
$author = $postData['author'];
$is_enabled = intval($postData['is_enabled']);



//var_dump ($is_enabled);

$insertRecipeStatement = $mysqlClient->prepare('UPDATE recette SET title = :title, recipe = :recipe, is_enabled = :is_enabled WHERE recipe_id = :id');
$insertRecipeStatement->execute([
    'title' => $title,
    'recipe' => $recipe,
	'is_enabled' => $is_enabled,
    'id' => $id,
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
    <link rel="stylesheet" href="bootstrap.css">
	<script src=".jquery-3.6.0.js"></script>
    <script src=".bootstrap.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('../header.php'); ?>
        <h1>Recette modifiée avec succès !</h1>
        
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
