<?php 
include_once('../database.php'); 
 //include_once('formabs.php');
 
 




 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>GAKUTRACK</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/present.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/myproject/js/presence.js"></script>
    </head>
    <body>
           
        <form action=""  method="POST">
            <!--  inserer deux balise select qui chargeront les classe et departement de la bd-->
        </form>

        <!-- CHARGER TOUT LES INFORMATION -->
        <form method="POST" action="" id="seach">
        <select class="abs-form" id="UE" name="UE">
                <?php foreach ($cours as $cour): ?>
                    <option>
                            <?php echo $cour; ?>     
                    </option>
                <?php endforeach; ?>     
            </select>
            <select id="heure" name="abs-heure" class="abs-form">
                <option value="2">2H</option>
                <option value="4">4H</option>
                <option value="6">6H</option>
                <option value="8">8H</option>
            </select>
                 <input type="submit" class="bouton" value="Chercher" name="bot-seach">
            
        </form>