<?php


$dsn = 'mysql:host=localhost;dbname=gestionabs';
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




// class Connexion {
//     private $host = 'localhost';
//     private $user = 'root';
//     private $password = '';
//     private $database = 'gestionabs';
//     private $conn;

//     public function __construct() {
//         try {
//             $dsn = "mysql:host={$this->host};dbname={$this->database}";
//             $this->conn = new PDO($dsn, $this->user, $this->password);
//             $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         } catch (PDOException $e) {
//             die('Échec de la connexion : ' . $e->getMessage());
//         }
//     }

//     public function getConnexion() {
//         return $this->conn;
//     }

//     public function close() {
//         $this->conn = null;
//     }

//     public function isConnected() {
//       return $this->conn !== null;
//   }

// }


// //require 'Connexion.php';

// // Instancier la classe de connexion à la base de données
// $connexion = new Connexion();

// // Vérifier si la connexion est établie
// if ($connexion->isConnected()) {
//     echo 'Connexion réussie !';
// } else {
//     echo 'Échec de la connexion !';
// }




