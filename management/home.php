<?php session_start(); // $_SESSION ?>

<?php
    include_once('./database/database.php');
	include_once('./use/variables.php'); //variables
    include_once('./use/functions.php'); // Fonctions
	include_once('loged.php'); 
	
	
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
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

    <!-- Navigation -->
    <?php include_once('header.php'); ?>
	
	
	
	
	
	<?php if(isset($_SESSION['LOGGED_USER'])): ?>
		
			<div class="alert alert-success" role="alert">
				Bonjour <?php echo($loggedUser['email']); ?> !
				une session a été créé pour votre séjour
			</div>
		

			<!-- Plus facile à lire -->
			<?php foreach(get_recipes($recipes, $limit) as $recipe) : ?>
				<article>
					<h3><?php echo($recipe['title']); ?></h3>
					<div><?php echo($recipe['recipe']); ?></div>
					<i><?php echo(display_author($recipe['author'], $users)); ?></i>
					<?php if(isset( $loggedUser ) && $recipe['author'] === $loggedUser['email']): ?>
						<ul class="list-group list-group-horizontal">
							<li class="list-group-item"><a class="link-success" href="./recipes/read.php?id=<?php echo($recipe['recipe_id']); ?>">Lire l'article</a></li>
							<li class="list-group-item"><a class="link-warning" href="./recipes/update.php?id=<?php echo($recipe['recipe_id']); ?>">Editer l'article</a></li>
							<li class="list-group-item"><a class="link-danger" href="./recipes/delete.php?id=<?php echo($recipe['recipe_id']); ?>">Supprimer l'article</a></li>
							
						</ul>
					<?php endif; ?>
					<ul class="list-group list-group-horizontal">
					<li class="list-group-item"><a class="link-danger" href="./comments/create.php?id=<?php echo($recipe['recipe_id']); ?>">noter</a></li>
					</ul>
				</article>
			<?php endforeach ?>
		
		<?php else: ?>
			<div class="alert alert-danger" role="alert">
				Vous devez vous authentifier !
			</div>
			<?php if(isset($errorMessage)){
				echo($errorMessage);
			} ?> 
			
			<a class="nav-link active" aria-current="page" href="login.php">Cliquer ici pour vous Authentifier</a>

		<?php endif; ?>
		
		
    </div>

    <?php include_once('footer.php'); ?> 
</body>
</html>

