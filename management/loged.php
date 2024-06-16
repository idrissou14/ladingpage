<?php			
		$postData = $_POST;

		if (isset($postData['email']) &&  isset($postData['password'])) {
			foreach ($users as $user) {
				if (
					$user['email'] === $postData['email'] &&
					$user['password'] === $postData['password']
				) {
					$loggedUser = [
						'email' => $user['email'],
					];

					/**
					 * Cookie qui expire dans un an
					 */
					/* setcookie(
						'LOGGED_USER',
						$loggedUser['email'],
						[
							'expires' => time() + 365*24*3600,
							'secure' => true,
							'httponly' => true,
						]
					); */

					$_SESSION['LOGGED_USER'] = $loggedUser['email'];
				} else {
					$errorMessage = sprintf('Les informations envoyées ne permettent pas de vous identifier : (%s/%s)',
						$postData['email'],
						$postData['password']
					);
				}
			}
		}
		
		
		// Si la session sont présentes
		 if (isset($_SESSION['LOGGED_USER'])) {
			$loggedUser = [
				'email' => $_SESSION['LOGGED_USER'],
			];
		} 
		
		
		// Si le cookie ou la session sont présentes
		/* if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
			$loggedUser = [
				'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
			];
		} */

		// Si le cookie est présent
		/* if (isset($_COOKIE['LOGGED_USER'])) {
			$loggedUser = [
				'email' => $_COOKIE['LOGGED_USER'],
			];
		}

		if (isset($_SESSION['LOGGED_USER'])) {
			$loggedUser = [
				'email' => $_SESSION['LOGGED_USER'],
			];
		} */
    ?>



		
	
	