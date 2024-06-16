<?php

$dsn = 'mysql:host=localhost;dbname=voyage';
$username = 'root' ;
$psw = '' ;

try{
      $cnx = new PDO($dsn, $username, $psw);
      $cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      //echo "Connexion réussie !";
}
catch(PDOException $e){
      echo "Erreur" + $e->getMessage();
} 

function save($pdo,$nom,$tel,$email,$nbplace,$code){
    $requete = " INSERT INTO client(nomComplet,telephone,adresseEmail,nombreplace,codeConfirmation) VALUES(:nom ,:tel ,:adresse ,:place,:code) ";
    $stmt = $pdo->prepare($requete);
    $stmt->bindValue(':nom', $nom, PDO::PARAM_STR);
    $stmt->bindValue(':tel', $tel, PDO::PARAM_STR);
    $stmt->bindValue(':adresse', $email, PDO::PARAM_STR);
    $stmt->bindValue(':place', $nbplace, PDO::PARAM_INT);
    $stmt->bindValue(':code', $code, PDO::PARAM_STR);
    //$stmt->execute();
    $stmt->execute();  
    echo "Enregistrement reussi !!!!"; 
}

function chargerBD($pdo){
    // Utiliser l'objet de connexion PDO pour exécuter des requêtes SQL, par exemple :
    $req = " SELECT * FROM client" ;
    $stmt = $pdo->prepare($req);
    $stmt->execute();
    $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $cnx->close();
    return $Rows;
}

$toutClient = chargerBD($cnx);



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bot-add'])){
    
    $nomClient = $_POST['nom'];
    $telephone = $_POST['telephone'];
    $mail = $_POST['email'];
    $place = $_POST['place'];
    $confirmation = $_POST['confirmation'];

    save($cnx,$nomClient,$telephone,$mail,$place,$confirmation);
    
}