<?php 

// $dns = 'mysql::host=localhost,dbname= film2023';
// $username = 'root';
// $psw = '';


// try{
//    $con = new PDO($dns,$username,$psw);
//    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//    echo "Connexion réussie !";
   
// }
// catch(PDOException $e){
//    echo 'erreur'.$e->getMessage();
// }










if($_SERVER["REQUEST_METHOD"]== "POST"){
   
   $matricule = $_POST['matricule'];
   $Adresse_mail = $_POST['adresse_mail'];

   $host= "localhost";
   $matricule = "root";
   $Adresse_mail = "";
   $dbname = "soutenance";

   $conn = new mysqli( $host, $matricule, $Adresse_mail, $dbname);
   echo 'winnn'
   if($conn->connect_error){
      die("connection failed: ". $conn->connect_error);

   }

   $query = "SELECT matricule,Adresse_mail FROM utilisateur WHERE matricule='$matricule' AND Adresse_mail='$Adresse_mail' ";

   $result = $conn->query($query);

   if($result->num_rows == 1){
      header("location: success.html");
      exit();
   }
   else{
      header("location: failed.html");
      exit();
   }
   $conn->close();
}




// if(isset($_post['connexion'])){
//    $server = "localhost";
//    $matricule = "root";
//    $Adresse_mail ="";
//    $dbname = "soutenance";

//   //creer une connexion

//    $conn= new mysqli($servername, $matricule, $pAdresse_mail, $dbname );

//   // verifier la connexion 
//  if( $conn->connect_error){
//     die("connection failed: " . $conn->connect_error);
//   } else {
//    echo "Connected successfully";
// }
// }


?>