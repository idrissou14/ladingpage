<?php 
include_once('../models/Etudiant.php');

$connexion = new Connexion();
  

// Fermer la connexion
//$connexion->close();

//Fonctio charger les tout les donnees de la BD#####################################

function chargerBD($cnx){
    // Récupérer l'objet de connexion PDO
    $pdo = $cnx->getConnexion();
    // Utiliser l'objet de connexion PDO pour exécuter des requêtes SQL, par exemple :
    $stmt = $pdo->query('SELECT mle,etudiant.nom,prenom,datenais,sexe, parent.NOM, parent.TELEPHONE FROM parent,etudiant WHERE parent.id=etudiant.ID_PARENT');
    $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $Rows;
}
// charger les elements dans le tableau html
 $rows = chargerBD($connexion); 
 
 //Fonction sauvegarder###########################################

function save(Etudiant $etudiant, $cnx){

    // Récupérer l'objet de connexion PDO
$pdo = $cnx->getConnexion();
$sql = "INSERT INTO etudiant (mle,nom,prenom,datenais,sexe,id_parent) VALUES (:mle, :nom, :prenom, :datenais, :sexe, :idP)";
$stmt = $pdo->prepare($sql);

// Liaison des valeurs
$stmt->bindValue(':mle',$etudiant->getMle(), PDO::PARAM_STR);
$stmt->bindValue(':nom', $etudiant->getNom(), PDO::PARAM_INT);
$stmt->bindValue(':prenom', $etudiant->getPrenom(), PDO::PARAM_INT);
$stmt->bindValue(':datenais', $etudiant->getDateNais(), PDO::PARAM_INT);
$stmt->bindValue(':sexe', $etudiant->getSexe(), PDO::PARAM_INT);
$stmt->bindValue(':idP', $etudiant->getIdParent() , PDO::PARAM_INT);
 // Exécuter la requête
 if ($stmt->execute()) {
    echo "Enregistrement réussi !";
} else {
    echo "Erreur lors de l'enregistrement : " . $stmt->errorInfo()[2];
}

}

    // bouton ENREGISTRER
    if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['bot-add'])){

        if(empty($_POST['etud-mle']) || empty($_POST['etud-name']) || empty($_POST['etud-surname']) || empty($_POST['etud-date']) || 
          empty($_POST['etud-sexe']) || empty($_POST['etud-idparent']) ){
            echo "Tous les champs sont requis.";
        }
        else{
            $txtmle = $_POST['etud-mle'];
            $txtNom = $_POST['etud-name'];
            $txtprenom = $_POST['etud-surname'];
            $txtdate = $_POST['etud-date'];
            $txtsexe = $_POST['etud-idparent'];
            $txtIdParent = $_POST['etud-idparent'];
            echo "Les elements ont ete pris en compte !";
            
        }
            
       $etudiant = new Etudiant($txtmle,$txtNom,$txtprenom,$txtdate,$txtsexe,$txtIdParent);
        save($etudiant,$connexion);

        $txtmle = NULL;
        $txtNom = NULL;
        $txtprenom = NULL;
        $txtdate = NULL;
        $txtsexe = NULL;
        $txtIdParent = NULL;
        $base_url = strtok($_SERVER["REQUEST_URI"],'?');

        // Redirection vers la même page sans les paramètres de requête
        header("Location: $base_url");
        exit();
    }

?>