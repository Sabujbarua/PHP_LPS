<?php

// ------------------------
// La superglobal $_COOKIE
// ------------------------

/*
un cookie est un petit fichier (4ko max) déposé par la servrur de site le poste de l'internaute, et qui peut contenir de information. les cookies sont automatiquement renvoyés au serveur web par le navigateur lorsque l'internaute navifue le pages concernée par les cookies. PHP permet de récupérer très facilement les donnée contenus dans un cookie n: elles sont stockées dans la superglobale $_COOKIE

Précution à prendre avec les cookies : 
Le cookie étant sauvegardé sur le poste de l'internaute, il peut être volé ou détourné. On n'y mettra donc pas d'information sensibles (mot de passe, carte bancaire,...), mais des informations relatives aux préférences ou aux traces de visite (produits consultées...).
*/
print_r($_GET);

// 2- on détermine la langue à afficher dans la variable dans la variable $langue :

if(isset($_GET['langue'])){
    $langue = $_GET['langue']; // si existe l'indice "langue, c'est qu'on a cliqué sur un lien. on affecte donc sa valeur à la variable $langue
} elseif(isset($_COOKIE['langue'])){
    $langue = $_COOKIE['langue']; // $_COOKIE est une superglobal : son indice correspond au nom de cookie reçu. si  on $_COOKIE['langue'] existe, c'est qu'on a reçu un cookie  de nom "langue". on affecte donc sa valeur à la variable $langue

    // Il n'existe pas de fonction prédéfinit pour supprimer un cookie, dans ce cas on le met à jour avec une date périmé ou à 0 ou encore en ne mettant que le nom du cookie dans les parenthèses de setcookie().
} else{
    $langue='fr'; //  Par defaut si l'on a pas cliqué sur un lien et si le cookie langue n'existe pas, on choisit "fr". 
}


// 3- création de cookie :
$un_an = 365 * 24 * 60 * 60; // exprime 1 an en secondes

setcookie('langue', $langue, time() + $un_an); // on envoie un cookie chez l'internaute avec nom, une valeur, une date d'expiration d'expiration exprimée en timestamp (maontenant + 1an)

// Il n'existe pas de function prédéfinie pour  supprimer un cookie. dans ce cas, on le met à jour avec une date les 

// 4-affichage de la langue :
echo 'le site es affiché en : ' . $langue . '<br>';

// HTML :
?>

<h1>Votre langue : </h1>
<ul>
    <li><a href="?langue=fr">Français</a></li>
    <li><a href="?langue=es">Spain</a></li>
    <li><a href="?langue=it">Italy</a></li>
    <li><a href="?langue=en">English</a></li>
</ul>