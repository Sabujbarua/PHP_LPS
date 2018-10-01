<?php
// créer un formulaire avec les champs ville, code posta et une zone de texte adresse.
// vous affichez les données saisies par l'internaute dans la page formulaire2-traitement.php
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formulaire2</title>
</head>
<body>
    <h1 style="color: orange; background: #232323;display: inline-block;">Formulaire-2</h1>
    <form method="POST" action="formulaire2-traitement.php">
        <label for="ville">Ville</label>
        <!-- ID is work with for (whene we click on "ville" it send me to input) -->
        <input name="ville" id="ville" type="text" style="margin-left: 52px">
        <!-- name is to work with PHP -->
        <br>
        <br>
        <label for="cPostal">Code Postal</label>
        <input name="cPostal" id="cPostal" type="text" style="margin-left: 10px">
        <br>
        <br>
        <label for="adress">Adresse</label>
        <input name="adress" id="adress" type="text" style="margin-left: 36px">
        <br>
        <br>
        <input type="submit" value="Valider" style="background-color:green; color:#fff;">

    </form>
    
</body>
</html>