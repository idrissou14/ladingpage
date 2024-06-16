<?php

  

   $dsn = 'mysql:host=localhost;dbname=gest_taches';
   $username = 'root' ;
   $psw = '' ;

   try{
         $cnx = new PDO($dsn, $username, $psw);
         $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         echo "Connexion réussie !";
   }
   catch(PDOException $e){
         echo "Erreur" + $e->getMessage();
   }

   /*
   $datestrin = '10/01/2024';
   $date = new DateTime($datestrin);
   
   $tache1 = new Tache('menage',$date ,1);
   echo $tache1->getLibelle();
   $libelle = $tache1->getLibelle();
   $datef = $tache1->getdate();
   $effect  = $tache1->getEffectuer();
   
   
   $stmt = $cnx->prepare("INSERT INTO tache (libelle, date_creation, effectuer) VALUES (:lib, :dateC, :effect)");
   $stmt ->bindParam(':lib', $libelle);
   $stmt ->bindParam(':dateC', $datef);
   $stmt ->bindParam(':effect', $effect);
   $stmt->execute();
*/

?>