<?php 
include_once('../database.php'); 

    
    $mle = $_GET['mle'];
    $id = $_GET['id'];
   // echo $mle." & ".$id;

    //CHARGER LES DONNEES 

        $req = "SELECT etudiant.MLE, etudiant.NOM, etudiant.PRENOM, classe.CODE_CL, unite_enseignement.LIBELLE, programmer.DATEP,
        HEURE_ABS, programmer.id
        FROM manquer, programmer, etudiant, unite_enseignement, classe
        WHERE manquer.MLE = etudiant.MLE AND manquer.id_programmer = programmer.id
        AND programmer.ID_UE = unite_enseignement.ID AND programmer.ID_CLASSE = classe.ID
        AND etudiant.MLE = :mat AND programmer.id = :id";

        $stmt = $cnx->prepare($req);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->bindValue(':mat', $mle, PDO::PARAM_STR); // Utilisation de PDO::PARAM_STR pour un champ CHAR
        $stmt->execute();
        $JustiftEnCour = $stmt->fetch(PDO::FETCH_ASSOC);



        // //CHARGER DANS LES INPUT
        $matricule = $JustiftEnCour['MLE'];
        $nomEnCour = $JustiftEnCour['NOM'];
        $PrenomEnCour = $JustiftEnCour['PRENOM'];
        $ClassEnCour = $JustiftEnCour['CODE_CL'];
        $UE = $JustiftEnCour['LIBELLE'];
        $DateEnCour = $JustiftEnCour['DATEP'];
        $HeureEnCour = $JustiftEnCour['HEURE_ABS'];


        //FONCTION DE MISE A JOUR
        function AddJustif($pdo,$Mat,$Just,$ID){
            $requete = "UPDATE manquer SET JUSTIFICATIF = :justif WHERE MLE = :mat AND id_programmer = :id" ;
            $stmt = $pdo->prepare($requete);
            $stmt->bindValue(':justif', $Just, PDO::PARAM_STR);
            $stmt->bindValue(':mat', $Mat, PDO::PARAM_STR);
            $stmt->bindValue(':id', $ID, PDO::PARAM_INT);
            //$stmt->execute();
            if ($stmt->execute()) {
                echo "<script> alert(Enregistrement réussi !);</script>";
            } else {
                echo "Erreur lors de l'enregistrement : " . $stmt->errorInfo()[2];
            }
        }

        //VALIDATION AVEC LE BOUTON ENREGISTRER

        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['just-valide'])){

            $motif = $_POST['just'];
            if(isset($motif)){
                AddJustif($cnx,$mle,$motif,$id);
                header("LOCATION: listabs.php");
                exit();
            }else{
                header("LOCATION: listabs.php");
                exit();
            }

        }

 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>GAKUTRACK</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/justif.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/myproject/js/presence.js"></script>
    </head>
    <body>
        <?php include_once('../include/Header.php'); ?>
        <form method="POST" action="addjustif.php?mle=<?=$_GET['mle']; ?>&id=<?=$_GET['id']; ?>" id="justif-form" class="form">
            <div>
                <h2>AJOUTER UN JUSTIFICATIF</h2><br>
            </div>
            <div>
                <input type="text" name="just-mle" class="form-just" value="<?php echo htmlspecialchars($matricule); ?>"><br>
            </div>
            <div>
                <input type="text" name="just-nom" class="form-just" value="<?php echo htmlspecialchars($nomEnCour." ".$PrenomEnCour); ?>"><br>
            </div>
            <div>
                <input type="text" name="just-classe" class="form-just" value="<?php echo htmlspecialchars($ClassEnCour); ?>"><br>
            </div>
            <div>
                <input type="text" name="just-UE" class="form-just" value="<?php echo htmlspecialchars($UE); ?>"><br>
            </div>
            <div>
                <input type="date" name="just-date" class="form-just" value="<?php echo htmlspecialchars($DateEnCour); ?>"><br>
            </div>
            <div>
                <input type="number" name="just-heure" class="form-just" value="<?php echo htmlspecialchars($HeureEnCour); ?>"><br>
            </div>
            <div>
                <textarea class="form-just" name="just"></textarea><br>
            </div>
            <div>
                <input type="submit" name="just-valide" value="Enregistrer" class="form-just" id="valid-form">
            </div> 
            
        </form>
    </body>
</html> 