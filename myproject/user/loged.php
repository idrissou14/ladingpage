<?php
include_once('../database.php'); 

    $message = null;

    //RECUPERER LES UTILISATEUR DE LA BD

    function GetAllUser($pdo){
        $requete = "SELECT nom,password,statut,id FROM utilisateur" ;
        $stmt = $pdo->prepare($requete);
        $stmt->execute();
        $resultat = $stmt->fetchAll();
        return $resultat;
    }

    function printMessage($m){
        if($m == "incorrecte"){
            echo "<script>
                                Swal.fire({
                                    title: 'ERREUR',
                                    text: 'Information invalide!',
                                    icon: 'warning', // Vous pouvez également utiliser 'success', 'error', 'info' etc.
                                    confirmButtonText: 'OK'
                                });
                            </script>" ;
        }
        
    }

    $users = GetAllUser($cnx);


   if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login-val'])){

        // RECUPERER LES DONNEES DU FORMULAIRE

        $idLog = $_POST['userid'];
        $pswLog = $_POST['userpsw'];



         foreach($users as $user){
           
            if(($idLog == $user['nom']) && ($pswLog == $user['password'])){
                if($user['statut'] == "user"){
                    header("Location: /myproject/form/formabs.php?ident=".urlencode($user['id'])."&id=".urlencode($user['nom']));
                    exit();
                }
               
            }
            else{
                $message = "incorrecte";
                //header("Location: login.php");
            }
        }
   }