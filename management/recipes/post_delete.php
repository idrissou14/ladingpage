<?php
session_start();

include_once('../database/database.php');
    
include_once('../use/variables.php');

if (!isset($_POST['id']))
{
	echo 'Il faut un identifiant valide pour supprimer une recette.';
    return;
}	

$id = intval($_POST['id']);

$deleteRecipeStatement = $mysqlClient->prepare('DELETE FROM recette WHERE recipe_id = :id');
$deleteRecipeStatement->execute([
    'id' => $id,
]);

header('Location: home.php');
?>
