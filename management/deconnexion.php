<?php
session_start();

include_once('./../config/database.php');
include_once('./../config/user.php');
include_once('./../variables.php');



$loggedUser = ['email' => null];

session_destroy();



header('Location: '.$rootUrl.'home.php');
?>
