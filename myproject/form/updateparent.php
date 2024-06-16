
<?php 
        include_once('../database.php');
        include_once('../models/parent.php');

        $connexion = new Connexion();
        $id = $_GET['id'];
        $pdo = $connexion->getConnexion();
        // Utiliser l'objet de connexion PDO pour exécuter des requêtes SQL, par exemple :
        $stmt = $pdo->query('SELECT id,nom,telephone FROM parent WHERE id='.$id);
        $parentEnCour = $stmt->fetchAll(PDO::FETCH_ASSOC);
         $upnom = $parentEnCour[0]['nom'];
         $uptel = $parentEnCour[0]['telephone'];

        ;

            //FONCTION DE MISE A JOUR
            function Update(ParentClass $parent, $cnx , $ID){

                $pdo = $cnx->getConnexion();
                $sql = "UPDATE parent SET nom= :nom, telephone= :tel WHERE id= :id";
                $stmt = $pdo->prepare($sql);
            
                // Liaison des valeurs
                $stmt->bindValue(':nom', $parent->getNom(), PDO::PARAM_STR);
                $stmt->bindValue(':tel', $parent->getTel(), PDO::PARAM_INT);
                $stmt->bindValue(':id', $ID, PDO::PARAM_STR);
                 // Exécuter la requête
                 if ($stmt->execute()) {
                    echo "<script> alert(Enregistrement réussi !);</script>";
                } else {
                    echo "Erreur lors de l'enregistrement : " . $stmt->errorInfo()[2];
                }
            }

        
        if ($_SERVER["REQUEST_METHOD"] == "POST"  && isset($_POST['bot-update'])){

                $upnom = $_POST['nom'];
                $uptel = $_POST['num'];
                $parentUpdate = new ParentClass($upnom, $uptel);
                Update($parentUpdate,$connexion,$id);
                header("LOCATION: formparent.php");
                exit();
        }

        if(isset($_POST['annuler'])){
            header("LOCATION: formparent.php");
            exit();
        }
        
        
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Etudiants</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/formparent.css">

    </head>
    <body>
        <?php include_once('../database.php'); ?>
        <?php //include_once('codeparent.php'); ?>

        <h2> Modifier le parent ayant pour ID #<?=$_GET['id']?></h2>
        <form method="POST" action="updateparent.php?id=<?=$_GET['id']?>" id="add">
            <input type="text" id="name" name="nom" placeholder="Nom" value="<?php echo htmlspecialchars($upnom); ?>">
            <input type="number" id="tel" name="num" placeholder="Telephone" value="<?php echo htmlspecialchars($uptel); ?>">
            <input type="submit" class="bouton" value="Enregistrer" name="bot-update">
            <button class="bouton" name="annuler">Annuler</button>
        </form>
        
    </body>
</html>    
