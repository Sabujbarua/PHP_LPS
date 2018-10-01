<?php
//------------------------
// LA superglobale $_POST
//------------------------
//$_POST est une superglobale qui permet de récupérer les données saisies dans un formulaire
//$_POST est une superglobale donc un array, il est disponible dans tous les contexte du script y compris au sein des fonction.
// Syntaxe des $_POST : $_POST = array('name1' => 'valeur input1', 'nameN') => 'valeur inputN')

// echo "<pre>";
// print_r($_POST);
// echo "</pre>";

// ou

print_r($_POST);
echo '<hr>';

if(!empty($_POST)){ //is $_POST n'est pas vide, c'est qu'on a reçu des données du formulaire (le formulaire a été soumis)
    echo 'Prenom : ' . $_POST['prenom'] . '<br>';
    echo 'Description : ' . $_POST['description'] . '<br>'; // les indices prenom et description proviennent des "name" du formulaire HTML
}


// pour réinitialiser un formulaire avec le dernier code saisi : on cloque dans l'url + "entrée"
// Pour répéter la dernière action et donc renvoyer les données du formulaire : F5


// PHP end here
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>$_POST</title>
</head>
<body>
<h1>Formulaire</h1>
<!-- Un formulaire doit toujours être dans des balises <form> pour fonctionner. Attribut action définit l'url de destination des saisie -->
<form method="POST" action="">
    <label for="prenom">Prénom</label>
    <br>
    <input type="text"  id="prenom" name="prenom">
    <!-- Les name des inputs constituent les indices de l'array $_POST qui réceptionne les infos-->
    <br>
    <label for="description">Description</label>
    <br>
    <textarea name="description" id="description" cols="30" rows="10"></textarea>
    <!-- Lees id et le for sont liées : ils permettent de placer le curseur dans l'input quand on clique sur le label-->
    <br>
    <input type="submit" value="Valider" style="background-color:green; color:#fff;">
</form>
</body>
</html>