<?php

// Récupération des variables à l'aide du client MySQL
$usersStatement = $mysqlClient->prepare('SELECT * FROM users');
$usersStatement->execute();
$users = $usersStatement->fetchAll();

$recipesStatement = $mysqlClient->prepare('SELECT * FROM recipes WHERE is_enabled is TRUE');
$recipesStatement->execute();
$recipes = $recipesStatement->fetchAll();

if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
    $limit = (int) $_GET['limit'];
} else {
    $limit = 100;
}

// Si le cookie est présent
if (isset($_COOKIE['LOGGED_USER']) || isset($_SESSION['LOGGED_USER'])) {
    $loggedUser = [
        'email' => $_COOKIE['LOGGED_USER'] ?? $_SESSION['LOGGED_USER'],
    ];
}

$rootPath = $_SERVER['DOCUMENT_ROOT'];
$rootUrl = (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';









// variables gérer juste dans un tableau "old-one"
/* <?php

$users = [
    [
        'full_name' => 'Mickaël Andrieu',
        'email' => 'mickael.andrieu@exemple.com',
        'age' => 34,
		'password' => 'agenla',
    ],
    [
        'full_name' => 'Mathieu Nebra',
        'email' => 'mathieu.nebra@exemple.com',
        'age' => 34,
		'password' => 'agenla',
    ],
    [
        'full_name' => 'Laurène Castor',
        'email' => 'laurene.castor@exemple.com',
        'age' => 28,
		'password' => 'agenla',
    ],
	[
        'full_name' => 'David AKANA',
        'email' => 'agenla.academy@exemple.com',
        'age' => 17,
		'password' => 'agenla',
    ],	
];

$recipes = [
    [
        'title' => 'Cassoulet',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Couscous',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope milanaise',
        'recipe' => '',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Salade Romaine',
        'recipe' => '',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => false,
    ],
	 [
        'title' => 'Kondre',
        'recipe' => 'Mélanger les condiments et mettre le tout dans la marmite',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
	[
        'title' => 'Couscous Gombo',
        'recipe' => 'Ecraser le couscous, tourner dans de l\'eau chaude. Préparer la sauche gombo',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => true,
    ],
	[
        'title' => 'Ndolè Plantain',
        'recipe' => '',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => false,
    ],
	[
        'title' => 'Riz Sénégalais',
        'recipe' => '',
        'author' => 'mickael.andrieu@exemple.com',
        'is_enabled' => true,
    ],
	[
        'title' => 'Riz Confort',
        'recipe' => '',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => true,
    ],
    [
        'title' => 'Bongo Tchobi',
        'recipe' => '',
        'author' => 'agenla.academie@exemple.com',
        'is_enabled' => true,
    ],
	[
        'title' => 'Beignets Haricot',
        'recipe' => '',
        'author' => 'agenla.academie@exemple.com',
        'is_enabled' => true,
    ],
	[
        'title' => 'Banane malaxée',
        'recipe' => '',
        'author' => 'agenla.academie@exemple.com',
        'is_enabled' => true,
    ],
	[
        'title' => 'Eru Pistache',
        'recipe' => '',
        'author' => 'agenla.academie@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Escalope Milanaise',
        'recipe' => '',
        'author' => 'mathieu.nebra@exemple.com',
        'is_enabled' => false,
    ],
    [
        'title' => 'Salade Romaine',
        'recipe' => '',
        'author' => 'laurene.castor@exemple.com',
        'is_enabled' => true,
    ],
];

if(isset($_GET['limit']) && is_numeric($_GET['limit'])) {
    $limit = (int) $_GET['limit'];
} else {
    $limit = 100;
} */
