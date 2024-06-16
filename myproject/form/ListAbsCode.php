<?php
include_once('../database.php'); 

function ChargerAbs($pdo) {
    $sql = "SELECT etudiant.MLE,etudiant.NOM,etudiant.PRENOM,etudiant.sexe,classe.CODE_CL,unite_enseignement.LIBELLE,programmer.DATEP,
    HEURE_ABS,JUSTIFICATIF,programmer.id 
    FROM manquer,programmer,etudiant,unite_enseignement,classe
    WHERE manquer.MLE=etudiant.MLE AND manquer.id_programmer=programmer.id
    AND programmer.ID_UE=unite_enseignement.ID AND programmer.ID_CLASSE=classe.ID
    ORDER BY programmer.DATEP "; 
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC); //  fetch()   récupérer une seule ligne
    return $resultat;
}

$rows = ChargerAbs($cnx);

function RechercheAbs($pdo,$cl,$mat,$date1,$date2){
    $sql = "SELECT etudiant.MLE, etudiant.NOM, etudiant.PRENOM, etudiant.sexe,
    classe.CODE_CL, unite_enseignement.LIBELLE, programmer.DATEP,
    HEURE_ABS, JUSTIFICATIF, programmer.id 
    FROM manquer
    INNER JOIN programmer ON manquer.id_programmer = programmer.id
    INNER JOIN etudiant ON manquer.MLE = etudiant.MLE
    INNER JOIN unite_enseignement ON programmer.ID_UE = unite_enseignement.ID
    LEFT JOIN classe ON programmer.ID_CLASSE = classe.ID
    WHERE (:code IS NULL OR classe.CODE_CL = :code) 
    XOR (:mat IS NULL OR etudiant.MLE = :mat)
    XOR (:date_debut IS NULL AND :date_fin IS NULL) 
    XOR (:date_debut IS NULL AND programmer.DATEP <= COALESCE(:date_fin, programmer.DATEP)) 
    XOR (:date_fin IS NULL AND programmer.DATEP >= COALESCE(:date_debut, programmer.DATEP)) 
    XOR (programmer.DATEP BETWEEN COALESCE(:date_debut, programmer.DATEP) AND COALESCE(:date_fin, programmer.DATEP))";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':code', $cl, PDO::PARAM_STR);
    $stmt->bindValue(':mat', $mat, PDO::PARAM_STR);
    $stmt->bindValue(':date_debut', $date1, PDO::PARAM_STR);
    $stmt->bindValue(':date_fin', $date2, PDO::PARAM_STR);
    $stmt->execute();
    $resultat = $stmt->fetchAll(PDO::FETCH_ASSOC); //  fetch()   récupérer une seule ligne
    return $resultat;
}


//BOUTON DE RECHERCHE

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['form-sub'])){
    
    $classe = $_POST['form-classe'];
    $mle = $_POST['form-mle'];
    $Date1 = $_POST['date-1'];
    $Date2 = $_POST['date-2'];

    echo $Date1."<br>";
    echo $Date2;

    $rows = RechercheAbs($cnx,$classe,$mle,$Date1,$Date2);
    // $base_url = strtok($_SERVER["REQUEST_URI"],'?');
    //         header("Location: $base_url");

}

//EXPORTER SOUS EXCEL

if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['export-excel'])){
   

}