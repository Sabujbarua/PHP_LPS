<?php

// -----------------------------------------------
//La superglobal $_GET
// -----------------------------------------------
// $_GET représente l'url. il s'agit d'une superglobal, et comme toutes les superglobal, il s'agit d'un array. Superglobal signifie que ce tableau est disponible dans tous les contextes du script , y compris dans l'espase local des function.

// Dans notre exemple, les informations transitent dans l'url de la manière suivante : ?article=jean&couleur=blanc&prix=30.

//la syntaxe de l'url est donc : page.php?indice1=valeur1&indiceN=valeurN. 

// la superglobale $_GET transform les informations passées dans l'url en cet array : $_GET = array('incide1' => 'valeur1', 'indiceN' => 'valeurN');

echo "<pre>";
var_dump($_GET) . '<br>';
echo "</pre>";

if(isset($_GET['article']) && isset($_GET['couleur']) && isset($_GET['prix'])){ // si existe les indices "article" et "couleur" et "prix" alors on peut afficher leur valeur :

echo "<h1>Détail de produit</h1>";
echo '<p> Article : ' . $_GET['article'] . '</p>';
echo '<p> couleur : ' . $_GET['couleur'] . '</p>';
echo '<p> prix : ' . $_GET['prix'] . ' €</p>';

} else{ // sinon on met un message à l'internaute :

    echo '<p>ce produit n\'existe pas !</p>';

}