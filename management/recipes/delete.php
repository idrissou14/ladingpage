<?php session_start();

include_once('../database/database.php');
    
include_once('../use/variables.php');
echo $rootPath;
echo $rootUrl;
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
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Supprimer la recette ?</title>
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
	
			<div class="alert alert-danger" role="alert">
				<h2>Voulez vous vraiment supprimer la recette </h2> 
				<br>
				<h1><?php echo($recipe['title']); ?> ?	<h1> 
				<br>				
				<strong> La suppression est definitive ooo !!!!! </strong>
			</div>
        
		
        <form action="<?php echo('post_delete.php') ?>" method="POST">
            <div class="mb-3 visually-hidden">
                <label for="id" class="form-label">Identifiant de la recette</label>
                <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $_GET['id']; ?>">
            </div>
            
            <button type="submit" class="btn btn-danger">SUPPRIMER</button>
        </form>
        <br />
    </div>

    <?php include_once('../footer.php'); ?> 
</body>
</html>