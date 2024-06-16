<?php 
//include_once('../database.php'); 
 include_once('studentcode.php'); 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Etudiants</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/student.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/myproject/js/student.js"></script>
    </head>
    <body>
           
        <form action=""  method="POST">
            <!--  inserer deux balise select qui chargeront les classe et departement de la bd-->
        </form>

        <!-- FORMULAIRE POUR ENREGISTRER LES ETUDIANTS -->
        <form action="<?php include_once('studentcode.php'); ?>"  method="POST" id="add">
            <input type="text" name="etud-mle" id="etud-mle" class="etud-form" placeholder="matricule">
            <input type="text" name="etud-name" id="etud-name" class="etud-form" placeholder="Nom">
            <input type="text" name="etud-surname" id="etud-surname" class="etud-form" placeholder="prenom">
            <input type="date" name="etud-date" id="etud-date" class="etud-form" placeholder="date de naissance : jj/mm/AAAA">
            <select id="sexe"  name="etud-sexe" class="etu-form">
                <option value="M">M</option>
                <option value="F">F</option>
            </select>
            <input type="number" name="etud-idparent" id="etud-parent" class="etud-form" placeholder="id du parent"><br/>
            <input type="submit"  id="stud-sub" class="form-buttom" name="bot-add" value="Enregistrer">
            <button class="form-buttom">Annuler</button>
        </form>
        <form method="POST" action="" id="seach">
                 <input type="text" id="txt-rech" name="rech"  placeholder="Recherche...">
                 <input type="submit" class="bouton" value="Chercher" name="bot-seach">
            
        </form>
        <table>
        <thead>
            <tr>
                <th>Num</th>
                <th>MLE</th>
                <th>Nom</th>
                <th>PRENOM</th>
                <th>DATE NAISSANCE</th>
                <th>SEXE</th>
                <th>NOM DU PARENT</th>
                <th>TELEPHONE</th>
                <th>EDITER</th>
            </tr>
        </thead>
        <tbody>
        <?php  $i = 1; ?>
            <?php foreach ($rows as $row): ?>
                <tr>
                    <td><?php echo $i++; ?></td>
                    <td><?php  echo $row['mle']; ?></td>
                    <td><?php echo $row['nom']; ?></td>
                    <td><?php echo $row['prenom']; ?></td>
                    <td><?php echo $row['datenais']; ?></td>
                    <td><?php echo $row['sexe']; ?></td>
                    <td><?php echo $row['NOM']; ?></td>
                    <td><?php echo $row['TELEPHONE']; ?></td>
                    <td> <!--<button name="edit-parent">modifier</button>
                            <button name="sup-parent">supprimer</button> -->
                            <a href="#" class="edit"><button name="edit-parent" class="bot-tab"  
                            onclick="return confirm('Voulez-vous vraiment modifier ?');" id="modify">modifier</button></a>
                             <a href="#" class="trash"> <button name="sup-parent" class="bot-tab"
                             onclick="return confirm('Voulez-vous vraiment supprimer ?');" id="delete">supprimer</button></i></a>
               
                     </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    </body>
</html>