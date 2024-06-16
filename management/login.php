
<!DOCTYPE html>



<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Site de Recettes - Page d'accueil</title>
    <link rel="stylesheet" href="./style/bootstrap.css">
	<script src=".jquery-3.6.0.js"></script>
    <script src=".bootstrap.js"></script>
</head>
<body class="d-flex flex-column min-vh-100">
    <div class="container">
	
			<form action="home.php" method="post">
				
					
				
				<div class="mb-3">
					<label for="email" class="form-label">Email</label>
					<input type="email" class="form-control" id="email" name="email" aria-describedby="email-help" placeholder="you@exemple.com">
					<div id="email-help" class="form-text">L'email utilisé lors de la création de compte.</div>
				</div>
				<div class="mb-3">
					<label for="password" class="form-label">Mot de passe</label>
					<input type="password" class="form-control" id="password" name="password">
				</div>
				<button type="submit" class="btn btn-primary">Envoyer</button>
			</form>

 <footer class="bg-light text-center text-lg-start mt-auto">
	  <div class="text-center p-3">
		© 2023 Copyright:
    <a class="text-dark" href="https://agenlaacademy.edu/">Agenla Académie</a>
	  </div>
	</footer>
</body>
</html>