<?php
try{
    $mysqlClient= new PDO(
        'mysql:host=localhost;
        dbname=app_db;
        charset=utf8',
        'root',
        ''
    );
    
}
catch(Exception $e)
{
    die('erreur:'. $e->getMessage());
}
?>