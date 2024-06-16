<?php
    try{
        $mysqlClient= new PDO(
            'mysql:host=localhost;
            dbname=recipe;
            charset=utf8',
            'root',
            ''
        );
        echo "connection true";
    }
    catch(Exception $e)
    {
        die('erreur:'. $e->getMessage());
    }


?>