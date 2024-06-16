<?php  //POUR DEFINIR UNE VARIABLE GLOBALE ON LA DEFINI AVANT LE INCLUDE
 $userId = urldecode($_GET['id']);
 $idus = urldecode($_GET['ident']); //recuperer l'id de l'url
 list($cl,$ans) = explode('#',$userId);
//include_once('../user/loged.php');
include_once('abscode.php');

    // charger les elements dans le tableau html
    $rows = chargerBD($cnx,$cl,$ans);
    $cours = ChargerCours($cnx,$cl); 
 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>GAKUTRACK</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/present.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="/myproject/css/presence.js"></script>
    </head>
    <body>
        <?php include_once('../include/Header.php'); ?>
            <?php printMessage($message); 
                    $message = null;
            ?>
        <!-- CHARGER TOUT LES INFORMATION -->
        <form method="POST" action="<?php include_once('abscode.php'); ?>" id="form-pres">
            <div id="seach" class="formabs">
                 <select class="abs-form" id="UE" name="id-UE">
                    <?php foreach ($cours as $cour): ?>
                        <option value="<?php echo $cour['id']; ?>">
                                <?php echo $cour['LIBELLE']; ?>     
                        </option>
                    <?php endforeach; ?>     
                </select>
                        
                            <input type="text" name="Teach-UE" placeholder="Enseignant" value="<?php if(isset($_POST['bot-UE'])){ echo htmlspecialchars($enseignant); } ?>" readonly>
                            <input type="text" name="Classe-UE" placeholder="Classe" value="<?php if(isset($_POST['bot-UE'])) echo htmlspecialchars($classe); ?>" readonly>
                            <input type="text" name="Salle-UE" placeholder="Salle" value="<?php if(isset($_POST['bot-UE'])) echo htmlspecialchars($salle); ?>" readonly>
                            <input type="text" name="Plage-Date-UE" placeholder="Date/Periode" value="<?php if(isset($_POST['bot-UE'])) echo htmlspecialchars($periode); ?>" readonly>
                    <input type="submit" class="bouton" value="Valider" name="bot-UE" id="Val-UE">   
            </div>            
            <div class="tab">            
                    <table>
                        <thead>
                            <tr>
                                <th>Num</th>
                                <th>MLE</th>
                                <th>Nom</th>
                                <th>PRENOM</th>
                                <th>SEXE</th>
                                <th>PRESENCE</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $i = 0; ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?php echo ++$i; ?></td>
                                    <td><input id="<?php echo 'matricule'.$i; ?>" type="text" value="<?php  echo $row['mle']; ?>" readonly></td>
                                    <td><?php echo $row['nom']; ?></td>
                                    <td><?php echo $row['prenom']; ?></td>
                                    <td><?php echo $row['sexe']; ?></td>
                                    <td> 
                                        <input type="checkbox" onclick="bonjour()" name="stud_statut" id="<?php echo 'present'.$i; ?>" value="<?php  echo $row['mle']; ?>">
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
            </div>
                <select class="abs-form" id="H-abs" name="H-abs">
                            <option value="2">2H</option>
                            <option value="4">4H</option>
                            <option value="6">6H</option>
                            <option value="8">8H</option>
                </select>
                <!-- SIGNATURE DE L'ENSEIGNANT -->
                <input type="text" name="signature" id="signature" placeholder="signature de l'enseignant">
                <!-- BOUTON ENREGISTRER -->
                <input type="submit" class="bouton" value="Valider" name="valid-abs">
                <input type="Hidden" id="liste" name="liste">
            
        </form>
   
        
       
    
    </body>
</html>