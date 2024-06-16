<?php session_start();
   include_once('../database/database.php');
    
include_once('../use/variables.php');

$getData = $_GET;

if (!isset($getData['id']) && is_numeric($getData['id']))
{
	echo('Il faut un identifiant de recette pour le modifier.');
    return;
}	

$retrieveRecipeStatement = $mysqlClient->prepare('SELECT * FROM recette WHERE recipe_id = :id');
$retrieveRecipeStatement->execute([
    'id' => $getData['id'],
]);

$recipe = $retrieveRecipeStatement->fetch(PDO::FETCH_ASSOC);

// si la recette n'est pas trouvée, renvoyer un message d'erreur
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Edition de recette</title>
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
        <h1>Mettre à jour <?php echo($recipe['title']); ?></h1>
        <form action="<?php echo('post_update.php'); ?>" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo($getData['id']); ?>">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Titre de la recette</label>
                <input type="text" class="form-control" id="title" name="title" aria-describedby="title-help" value="<?php echo($recipe['title']); ?>">
                <div id="title-help" class="form-text">Choisissez un titre percutant !</div>
            </div>
            <div class="mb-3">
                <label for="recipe" class="form-label">Description de la recette</label>
                <textarea class="form-control" placeholder="Seulement du contenu vous appartenant ou libre de droits." id="recipe" name="recipe">
                <?php echo strip_tags($recipe['recipe']); ?>
                </textarea>
            </div>
			<div class="mb-3">
					<label for="author" class="form-label">Email</label>
					<input type="email" class="form-control" id="author" name="author" aria-describedby="author-help" value="<?php echo($recipe['author']); ?>" >
					<div id="author-help" class="form-text">L'email utilisé lors de la création de cette recette.</div>
			</div>
			<h4 class="mb-3">Est ce que la recette est valide</h4>
			
			<?php if($recipe['is_enabled']): ?>
				<div class="my-3">
					<div class="form-check">
					  <input id="1" name="is_enabled" value="1" type="radio" class="form-check-input" checked>
					  <label class="form-check-label" for="yes">Yes</label>
					</div>
					<div class="form-check">
					  <input id="0" name="is_enabled" value="0" type="radio" class="form-check-input" >
					  <label class="form-check-label" for="no">No</label>
					</div>
				</div>
			<?php else: ?>
				<div class="my-3">
					<div class="form-check">
					  <input id="1" name="is_enabled" value="1" type="radio" class="form-check-input" >
					  <label class="form-check-label" for="yes">Yes</label>
					</div>
					<div class="form-check">
					  <input id="0" name="is_enabled" value="0" type="radio" class="form-check-input" checked>
					  <label class="form-check-label" for="no">No</label>
					</div>
				</div>	
			
			<?php endif; ?>
			
						
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
        </form>
        <br />
    </div>

	<?php include_once('../footer.php'); ?> 
    	
</body>
</html>