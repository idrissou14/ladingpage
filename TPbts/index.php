<?php 
    include_once("database.php");
    
?>


<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8"/>
        <title>Voyage</title>
        <link rel="stylesheet" type="text/css" href="styles.css">
    </head>
    <body>
        <div id="entete"> <h1>Insertion d'un client</h1><br></div>
        <div id="contener">
            <div id="labels">
                <span>
                    <h3>Nom Complet :</h3><br>
                </span>
                <span>
                    <h3>Telephone :</h3><br>
                </span>
                <span>
                    <h3>Adresse E-mail :</h3><br>
                </span>
                <span>
                    <h3>Classe BUS :</h3><br>
                </span>
                <span>
                    <h3>Date de Voyage :</h3><br>
                </span>
                <span>
                    <h3>Nombre de place :</h3><br>
                </span>
                <span>
                    <h3>Code de Confirmation :</h3><br>
                </span>

               
                
            </div>
            <div id="champ">
                <form action="database.php"  method="POST" id="add">
                    <input type="text" name="nom" id="nom" class="form" placeholder="Nom Complet" minlength="5" required><br>
                    <input type="number" name="telephone" id="telephone" class="form" placeholder="Telephone" minlength="9" required><br>
                    <input type="email" name="email" id="email" class="form" placeholder="Adresse E-mail" required><br>
                    <input type="number" name="Classe" id="classe" class="form" placeholder="Classe Bus" required><br>
                    <input type="date" name="dateV" id="dateV" class="form" placeholder="date de voyage : jj/mm/AAAA"><br>
                    <input type="number" name="place" id="place" class="form" placeholder="Nombre de place"><br>
                    <input type="text" name="confirmation" id="conf" class="form" placeholder="code de confirmation"><br>
                    <input type="submit"  id="sub" class="form-buttom" name="bot-add" >
                    <button class="form-buttom" onclick="alerter()">Annuler</button>
                </form>
            </div>
        </div>
        <script>
            function alerter(){
              
              let n = document.getElementsByName("nom").value;
                if(n.trim() == ''){
                    alert("YOOOOOOO");
                }
              
            }
        </script>
        <div>
            <?php  $i = 1; ?>
            <?php foreach($toutClient as $client): ?>
                <?php $i++ ?>
            <?php endforeach; ?>
            <h2> Nombre de client : <?php echo $i; ?></h2>
        </div>
    </body>
</html>
