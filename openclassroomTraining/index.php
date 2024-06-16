<?php

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
];



?>
<!DOCTYPE html>
<html>
<head>
    <title>Affichage des utilisateur</title>
</head>
<body>
   <title> Affichage des recette</title><br/>
   <?php foreach($recipes as $recipe): ?>
      <?php if($recipe['is_enabled'] == true ): ?>
         <h2><?php echo $recipe['title'] ?></h2>
         <?php echo $recipe['author'] ?>
      <?php endif ?>
   <?php endforeach ?>
   
</body>
</html>