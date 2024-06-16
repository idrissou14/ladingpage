<?php 
include_once('../database.php'); 

$message = null;
//Fonctio charger les tout les donnees de la BD#####################################

function chargerBD($pdo,$classe,$annee){
    // Utiliser l'objet de connexion PDO pour exécuter des requêtes SQL, par exemple :
    $req = " SELECT etudiant.mle, nom, prenom, sexe 
    FROM etudiant, classe, frequenter
    WHERE etudiant.MLE = frequenter.MLE
    AND classe.ID = frequenter.ID_CLasse
    AND classe.CODE_CL = :code 
    AND YEAR(frequenter.FINANNEE) = :ans" ;
    $stmt = $pdo->prepare($req);
    $stmt->bindValue(':code', $classe , PDO::PARAM_STR);
    $stmt->bindValue('ans', $annee, PDO::PARAM_INT);
    $stmt->execute();
    $Rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    // $cnx->close();
    return $Rows;
}


 //CHARGER LES PROGRAMMATION

 function ChargerCours($pdo,$classe){
    $sql = "SELECT unite_enseignement.LIBELLE,programmer.id 
    FROM programmer,unite_enseignement,classe
    WHERE programmer.ID_UE = unite_enseignement.ID 
    AND programmer.ID_CLASSE = classe.ID
    AND classe.CODE_CL = :classe";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':classe', $classe,PDO::PARAM_STR);
    $stmt->execute();
    $resutat = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $resutat;
 }

 //RECUPERER LE NUMERO DU PARENT

  function getNumber($pdo,$mat){
    $sql = "SELECT telephone,etudiant.NOM FROM parent,etudiant
    WHERE parent.ID = etudiant.ID_PARENT
    AND etudiant.MLE = :mat";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':mat',$mat,PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result;
  }



//CHARGER LES DETAILLES D'UNE UE

function ChargerDetailUe($pdo, $id) {
    $sql = "SELECT salle.CODE, plage_horaire.PLAGE, classe.CODE_CL, enseignant.NOM, enseignant.PRENOM,enseignant.SIGNATURE, DATEP, programmer.id 
            FROM programmer, salle, plage_horaire, classe, enseignant
            WHERE programmer.ID_SALLE = salle.ID_SALLE 
            AND programmer.ID_HORAIRE = plage_horaire.ID
            AND programmer.ID_CLASSE = classe.ID
            AND programmer.ID_ENS = enseignant.ID
            AND programmer.id = :id"; 
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT); // lier le paramètre $id de manière sécurisée
    $stmt->execute();
    $resultat = $stmt->fetch(PDO::FETCH_ASSOC); //  fetch()   récupérer une seule ligne
    return $resultat;
}

//FONCTION AFFICHER POUR GERER LES MESSAGES
    function printMessage($m){
        if($m == "signature incorrecte"){
            echo "<script>
                                Swal.fire({
                                    title: 'ERREUR',
                                    text: 'La signature de l\'enseignant est incorrect!',
                                    icon: 'error', // Vous pouvez également utiliser 'success', 'error', 'info' etc.
                                    confirmButtonText: 'OK'
                                });
                            </script>" ;
        }
        elseif($m == "personne absent"){
            echo "<script>
                Swal.fire({
                    title: 'LISTE VIDE',
                    text: 'Aucun etudiant absen ??',
                    icon: 'question', // Vous pouvez également utiliser 'success', 'error', 'info' etc.
                    confirmButtonText: 'OUI'
                });
        </script>" ;
        }
        elseif($m == "sauvegarder"){
            echo "<script>
                Swal.fire({
                    title: 'APPEL',
                    text: 'Liste d\'absence sauvegarder !',
                    icon: 'success', // Vous pouvez également utiliser 'success', 'error', 'info' etc.
                    confirmButtonText: 'OUI'
                });
        </script>" ;
        }
    }

    //ENVOYER SMS
    
        function sendSms($numero, $message) {
            $from = 'WILLSEVENTS';

        $destination = $numero;		
        $sms = $message;
        $api_key = "TWxLZUtuaWZ6YUFQdXZCSnVpenI=";
        $url = 'https://app.techsoft-web-agency.com/sms/api';

        // Construire le corps de la requête
        $sms_body = array(
            'action' => 'send-sms',
            'api_key' => $api_key,
            'to' => $destination,
            'from' => $from,
            'sms' => $sms
        );

        $send_data = http_build_query($sms_body);
        $gateway_url = $url . "?" . $send_data;

        try {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $gateway_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_HTTPGET, 1);
            $output = curl_exec($ch);

            if (curl_errno($ch)) {
                $output = curl_error($ch);
            }
            curl_close($ch);

            var_dump($output);

        }catch (Exception $exception){
            echo $exception->getMessage();
        }
}





//FORMULAIRE CHARGER COURS

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bot-UE'])){
    $idEnCour = $_POST['id-UE'];
    //echo "l'id en cours est ".$idEnCour;
    $UeEnCour = ChargerDetailUe($cnx,$idEnCour);//charger dans la variable UeEnCour
   $periode = $UeEnCour['DATEP']." \ ".$UeEnCour['PLAGE'];
   $salle = $UeEnCour['CODE'];
   $classe = $UeEnCour['CODE_CL'];
   $enseignant = $UeEnCour['NOM']." ".$UeEnCour['PRENOM'];

}

//ENREGISTRER LES ETUDIANT ABSENT

    function saveAbs($pdo,$mat,$user,$prog,$heur){
        $requete = " INSERT INTO manquer(MLE,ID_USER,id_programmer,HEURE_ABS) VALUES(:mat ,:userid ,:prog ,:heure) ";
        $stmt = $pdo->prepare($requete);
        $stmt->bindValue(':mat', $mat, PDO::PARAM_STR);
        $stmt->bindValue(':userid', $user, PDO::PARAM_INT);
        $stmt->bindValue(':prog', $prog, PDO::PARAM_INT);
        $stmt->bindValue(':heure', $heur, PDO::PARAM_INT);
        //$stmt->execute();
        if ($stmt->execute()) {
            echo "<script> alert(Enregistrement réussi !);</script>";
        } else {
            echo "Erreur lors de l'enregistrement : " . $stmt->errorInfo()[2];
        }
    }

//BOUTON ENREGISTRER
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['valid-abs'])){
    
    $idEnCour = $_POST['id-UE'];
    $prof = ChargerDetailUe($cnx,$idEnCour); 
    $nbreHeure = $_POST['H-abs'];

    //recuperer la signature du prof et comparer
    if($prof['SIGNATURE'] == $_POST['signature']){
         
        if(isset($_POST['liste'])){
                // Chaîne d'origine
            $chaine = $_POST['liste'];

            // Diviser la chaîne en utilisant une expression régulière pour capturer les caractères avant le #
            $parts = preg_split("/#/", $chaine, -1, PREG_SPLIT_NO_EMPTY);

            // Parcourir le tableau résultant
            foreach ($parts as $part) {
                // ENREGISTRER LES ABSENT
                saveAbs($cnx,$part,$idus,$idEnCour,$nbreHeure);
                $tel = getNumber($cnx,$part);
                $sms = "chers parent, nous tenion a vous informer que notre etudiant : ".$tel['NOM']." etait absent ce jour entre".$prof['PLAGE'];
                // echo $sms;
                sendSms($tel['telephone'], $sms);
              //  echo $part."\\". $tel['telephone']."__".$tel['NOM']."<br>";
            }
            // sendSms('237691299440', 'ABSENCES!');
            $message = "sauvegarder";
        }
        else{
            $message = "personne absent";
        }
       
        //exit();
    }
    else{
          $message = "signature incorrecte";
          
    }
   
}

