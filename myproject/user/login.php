<?php include_once('loged.php'); ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>GAKUTRACK</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/login.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    </head>
    <body>
        <?php printMessage($message); 
                        $message = null;
                ?>
        <div class="login">
            <form method="POST" action="<?php include_once('loged.php'); ?>" class="login">
                <div>
                    <img src="/myproject/img/logo.jpg" class="logo"> <br>
                    <input type="text" class="login-form" placeholder="Nom d'utilisateur" name="userid"><br>
                    <input type="password" class="login-form" placeholder="mot de passe" name="userpsw"><br>
                    <input type="submit" class="login-form" id="bottom" name="login-val" value="Connexion" >
                </div>  
            </form>
        </div>
    </body>

</html>