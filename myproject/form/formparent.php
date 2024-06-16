<?php 
include_once('../database.php'); 
 include_once('codeparent.php'); 
 
            
                if(isset($_GET['id'])){
                     
                    $element_id = $_GET['id'];
                    try{
                        $connexion = new Connexion();
           
                        $pdo = $connexion->getConnexion();

                        $stmt = $pdo->prepare('DELETE FROM parent WHERE id = :id');
                        $stmt->bindValue(':id', $element_id, PDO::PARAM_STR);
                       
                        if( $stmt->execute()){
                            echo "<script>alert('Suppression effectuée !');</script>";
                        }
                        $base_url = strtok($_SERVER["REQUEST_URI"],'?');

                        // Redirection vers la même page sans les paramètres de requête
                        header("Location: $base_url");

                    }
                    catch(PDOException $e){
                        echo "Erreur : " . $e->getMessage();
                    }
                    
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

    
        <form method="POST" action=" <?php include_once('codeparent.php'); ?>" id="add">
            <input type="text" id="name" name="nom" placeholder="Nom">
            <input type="number" id="tel" name="num" placeholder="Telephone">
            <input type="submit" class="bouton" value="Enregistrer" name="bot-add">
            <button class="bouton" name="Annuler">Annuler</button>
        </form>
        <form method="POST" action="<?php include_once('codeparent.php'); ?>" id="seach">
                 <input type="text" id="txt-rech" name="rech"  placeholder="Recherche...">
                 <input type="submit" class="bouton" value="Chercher" name="bot-seach">
            
        </form>
        <table>
        <thead>
            <tr>
                <th>Num</th>
                <th>ID</th>
                <th>Nom</th>
                <th>Téléphone</th>
                <th>Editer</th>
            </tr>
        </thead>
        <tbody>
        <?php  $i = 1; ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php  $id = $row['id']; echo  $row['id']; ?></td>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['telephone']; ?></td>
                    <td> <!--<button name="edit-parent">modifier</button>
                            <button name="sup-parent">supprimer</button> -->
                            <a href="updateparent.php?id=<?=$row['id']?>" class="edit"><button name="edit-parent" class="bot-tab"  
                            onclick="return confirm('Voulez-vous vraiment modifier ?');" id="modify">modifier</button></a>
                             <a href="formparent.php?id=<?=$row['id']?>" class="trash"> <button name="sup-parent" class="bot-tab"
                             onclick="return confirm('Voulez-vous vraiment supprimer ?');" id="delete">supprimer</button></i></a>
               
                     </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </body>
</html>