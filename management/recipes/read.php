<?php
session_start();

include_once('../database/database.php');
    
include_once('../use/variables.php');

$getData = $_GET;
if (!isset($getData['id']) && is_numeric($getData['id']))
{
	echo('La recette n\'existe pas');
    return;
}	

$recipeId = $getData['id'];

$retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recette WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => $recipeId,
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - <?php echo($recipe['title']); ?></title>
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" 
        rel="stylesheet"
    >
    <link rel="stylesheet" href="bootstrap.css">
	<script src="jquery-3.6.0.js"></script>
    <script src="bootstrap.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">

    <?php include_once('../header.php'); ?>
        <h1><?php echo($recipe['title']); ?></h1>
        <div class="row">
            <article class="col">
                <?php echo($recipe['recipe']); ?>
				<?php if(isset($loggedUser) && $recipe['author'] === $loggedUser['email']): ?>
						<ul class="list-group list-group-horizontal">
							
							<li class="list-group-item"><a class="link-warning" href="./update.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
							<li class="list-group-item"><a class="link-danger" href="./delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
							
						</ul>
					<?php endif; ?>
            </article>
            <aside class="col">
                <p><i>Contribuée par <?php echo($recipe['author']); ?></i></p>
            </aside>
        </div>
    </div>
    <?php include_once('../footer.php'); ?> 
</body>
</html>
