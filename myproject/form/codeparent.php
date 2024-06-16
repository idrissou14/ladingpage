<?php

include_once('../models/parent.php');

// Instancier la classe de connexion à la base de données
$connexion = new Connexion();
  

// Fermer la connexion
//$connexion->close();

//Fonctio charger les tout les donnees de la BD#####################################

function chargerBD($cnx){
    // Récupérer l'objet de connexion PDO
    $pdo = $cnx->getConnexion();
    // Utiliser l'objet de connexion PDO pour exécuter des requêtes SQL, par exemple :
    $stmt = $pdo->query('SELECT id,nom,telephone FROM parent');
    $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $Rows;
}
// charger les elements dans le tableau html
 $rows = chargerBD($connexion); 
  
 
 //Fonction sauvegarder###########################################

function save(ParentClass $parent, $cnx){

        // Récupérer l'objet de connexion PDO
    $pdo = $cnx->getConnexion();
    $sql = "INSERT INTO parent (nom, telephone) VALUES (:nom, :telephone)";
    $stmt = $pdo->prepare($sql);

    // Liaison des valeurs
    $stmt->bindValue(':nom', $parent->getNom(), PDO::PARAM_STR);
    $stmt->bindValue(':telephone', $parent->getTel(), PDO::PARAM_INT);
     // Exécuter la requête
     if ($stmt->execute()) {
        echo "Enregistrement réussi !";
    } else {
        echo "Erreur lors de l'enregistrement : " . $stmt->errorInfo()[2];
    }

}

  // bouton ENREGISTRER
    if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['bot-add'])){  

        if(empty($_POST['nom']) || empty($_POST['num'])){
            echo "Tous les champs sont requis.";
        }
        else{
            $txtNom = $_POST['nom'];
            $txtNum = $_POST['num'];
            echo "Les elements ont ete pris en compte !";
        }

        $parent = new ParentClass($txtNom, $txtNum);
        save($parent,$connexion);

        $txtNom = null;
        $txtNum = null;
        $base_url = strtok($_SERVER["REQUEST_URI"],'?');

        // Redirection vers la même page sans les paramètres de requête
        header("Location: $base_url");
        exit();
    }

    //FONCTION RECHERCHE ####################################

    function RechercheBD($cnx, $char){
        $pdo = $cnx->getConnexion();
        $stmt = $pdo->query("SELECT id,nom,telephone FROM parent WHERE nom like '%". $char."%'");
        $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $Rows;
    }

   //bouton recherche
    if(isset($_POST['bot-seach'])){
        if(empty($_POST['rech'])){
            echo "barre de recherche vide !!!!";
        }
        else{
            $txtRech = $_POST['rech'];
            $rows = RechercheBD($connexion, $txtRech);
           // echo $txtRech ;
          /*  $pdo = $connexion->getConnexion();

            // Utiliser l'objet de connexion PDO pour exécuter des requêtes SQL, par exemple :
            $stmt = $pdo->query("SELECT id,nom,telephone FROM parent WHERE nom like '%". $txtRech."%'");
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);*/
            $base_url = strtok($_SERVER["REQUEST_URI"],'?');
            header("Location: $base_url");
        }
    }

    //BOUTON ANNULER

    if(isset($_POST['Annuler'])){
        $base_url = strtok($_SERVER["REQUEST_URI"],'?');

        // Redirection vers la même page sans les paramètres de requête
        header("Location: $base_url");
    }

   



?>