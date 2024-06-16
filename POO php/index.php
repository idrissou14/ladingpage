<?php
   include_once('connection.php');
   include_once('ClasseTache.php');
  
  $datestrin = '10/11/2024';
  $date = new DateTime($datestrin);
  
  $tache1 = new Tache('faire les courses',$date ,0);
  echo $tache1->getLibelle();
  $libelle = $tache1->getLibelle();
  $datef = $tache1->getdate();
  $effect  = $tache1->getEffectuer();
  
  
  $stmt = $cnx->prepare("INSERT INTO tache (libelle, date_creation, effectuer) VALUES (:lib, :dateC, :effect)");
  $stmt ->bindParam(':lib', $libelle);
  $stmt ->bindParam(':dateC', $datef);
  $stmt ->bindParam(':effect', $effect);
  $stmt->execute();
  
 echo "insertion effectuer";
  

  
?>


