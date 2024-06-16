<?php session_start();
    include_once('../database/database.php');
    
    include_once('../use/variables.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Ajouter un commentaire</title>
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


        <h1>Ajouter un commentaire</h1>
        <form action="<?php echo('post_create.php') ?>" method="POST">
            <div class="mb-3">
                <label for="note" class="form-label">note de la recette</label>
                <input type="number" class="form-control" id="note" name="note" aria-describedby="note-help" required>
            
            </div>
            <div class="mb-3">
                <label for="comments" class="form-label">laisser un commentaire</label>
                <textarea class="form-control" placeholder="donner votre avis" id="recipe" name="comments" required></textarea>
            </div>
			

         
            <button type="submit" class="btn btn-primary">Enregistrer</button>
        </form>

        
        <br />
    </div>

    <?php include_once('../footer.php'); ?> 
</body>
</html>