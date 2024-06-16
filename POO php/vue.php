<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8"/>
        <title>Les taches</title>
    </head>
    <body>
        <h1>liste de taches</h1>
        
        <?php  include_once('connection.php'); 
        
                $requete = "select libelle,date_creation from tache ORDER BY libelle";

                try{
                    $stmt = $cnx->query($requete);
                    $Taches = $stmt->fetchAll(PDO::FETCH_ASSOC);

                    echo "<ul>";
                    foreach($Taches as $tache){
                        echo "<li> {$tache['libelle']} _______{$tache['date_creation']}";
                    }
                    echo"</ul>";
                } catch(PDOException $e){
                    echo "Erreur :" + $e->getMessage();
                }
        ?>
    </body>
</html>


