<?php 
//include_once('../database.php'); 
include_once('ListAbsCode.php'); 
 ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>GAKUTRACK</title>
        <link rel="stylesheet" type="text/css" href="/myproject/css/present.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="/myproject/js/presence.js"></script>

        <script src="../sheet.js"></script>
    </head>
    <body>
        <?php include_once('../include/Header.php'); ?>
        <div class="tab">    
            <form action="<?php include_once('ListAbsCode.php'); ?>"  method="POST" class="form" id="rap-abs-form">
                <div class="div">
                    <h2>RAPPORT D'ABSENCE</h2><br>
                </div> 
                <div class="div">   
                    <input type="date" name="date-1" id="date-1" >
                    <input type="date" name="date-2" id="date-2" >
                    <input type="text" name="form-mle" id="form-mle" placeholder="Matricule">
                    <input type="text" name="form-classe" id="form-cl" placeholder="Classe">
                    <input type="submit" name="form-sub" id="form-sub" value="Chercher" class="bouton">
                </div>    
            </form>
        </div>
        <div class="tab">
                <table id="Mytab">
                        <thead>
                            <tr>
                                <th>Num</th>
                                <th>MLE</th>
                                <th>Nom</th>
                                <th>PRENOM</th>
                                <th>SEXE</th>
                                <th>CLASSE</th>
                                <th>UNIT ENSEIGNEMENT</th>
                                <th>DATE</th>
                                <th>HEURE</th>
                                <th>JUSTIFICATIF</th>
                                <th>EDITER</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php  $i = 1; ?>
                            <?php foreach ($rows as $row): ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['MLE']; ?></td>
                                    <td><?php echo $row['NOM']; ?></td>
                                    <td><?php echo $row['PRENOM']; ?></td>
                                    <td><?php echo $row['sexe']; ?></td>
                                    <td><?php echo $row['CODE_CL']; ?></td>
                                    <td><?php echo $row['LIBELLE']; ?></td>
                                    <td><?php echo $row['DATEP']; ?></td>
                                    <td><?php echo $row['HEURE_ABS']; ?></td>
                                    <td><?php echo $row['JUSTIFICATIF']; ?></td>
                                    <td> 
                                        <a href="addjustif.php?mle=<?=$row['MLE']; ?>&id=<?=$row['id']; ?>" class="edit"><button name="edit-parent" class="bot-tab"  
                                            onclick="return confirm('Voulez-vous vraiment modifier ?');" id="modify">Ajouter</button>
                                        </a>
                                 </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                </table>
            </div>
                     <div id="export">   
                        <button name="export-excel" onclick="exportToExcel('Mytab')" id="bout-export">Exporter</button>
                    </div>   
                    <script type="text/javascript">

                        function exportToExcel(tableId) {
                           
                            
                            var table = document.getElementById(tableId);
                            var rows = table.rows;
                            var csv = [];

                            // Parcourir les lignes du tableau
                            for (var i = 0; i < rows.length; i++) {
                                var row = [],
                                    cols = rows[i].querySelectorAll("td, th");

                                // Parcourir les colonnes de la ligne (excluant la dernière colonne)
                                for (var j = 0; j < cols.length - 1; j++) {
                                    // Ajouter le texte de la colonne à la ligne
                                    row.push(cols[j].innerText);
                                }

                                // Ajouter la ligne au CSV
                                csv.push(row.join(","));
                            }

                            // Convertir le CSV en chaîne et créer un lien de téléchargement
                            var csvData = csv.join("\n");
                            var blob = new Blob([csvData], { type: 'text/csv;charset=utf-8;' });
                            var link = document.createElement('a');
                            var url = URL.createObjectURL(blob);
                            link.setAttribute('href', url);
                            link.setAttribute('download', 'table.csv');
                            link.style.visibility = 'hidden';
                            document.body.appendChild(link);
                            link.click();
                            document.body.removeChild(link);
                        }

                    </script>
                    <?php // include_once('../include/footer.php'); ?>
    </body>
</html>