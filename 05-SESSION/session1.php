<?php
// -----------------------------
// La superglobale $_SESSION 
// -----------------------------

/*
un fichier temporaire appelé session est crée sur le serveur avec un identifiant unique. cette session est liée à un seul internaute car, dans le même temp, un cookie est déposé sur son poste avec l'inentfiant à l'intérieur (au nom PHPSESSID). ce cookie se détruit lorsque'on quitte la navigateur.

Le fivhier de session peut contenir toutes sortes d'information y compris sensible car il n'est pas accessible ni modifiable par l'internaute. On peut donc y mettre des login, mdp, panier d'acchat avant paiement...

Si l'internaute tente de modifier ce cookie, le lien avec la session est rompu automatiquement et donc l'internaute est déconnecté.

Les données du fichier session son accessible et manipulable à partir de la superglobale $_SESSION.
*/

// 1- Ouverture ou création d'une session :
session_start(); // permet de créer une session si elle n'existe pas ou de l'ouvrir si elle existe déjà. (on a reçu un cookie avec l'ID  de session à l'interieur)

// remplissage de la session :
$_SESSION['pseudo'] = 'Tintin';
$_SESSION['mdp'] = 'milou'; // $_SESSION étant un array, on utilise la syntaxe avec []

echo '<br> 1- La session après remplissage : ';
print_r($_SESSION);

// pour visualiser le fichier de session : xampp > tmp

// vider une partie de la session
unset($_SESSION['mdp']); // supprime l'incide "mdp" et la valeur correspondante

echo '<br> 2- La session après suppression de mdp : ';
print_r($_SESSION);

// supprime entièrement une session :
// session_destroy(); 
//on demande la suppression de la session, mais il faut savoir que la session_destroy()est dabord lu, puis exécuter selement à la fin de script.
echo '<br> 3- La session après session-destroy() : ';
print_r($_SESSION); // on voit encore notre session, car la fin du scipt se situ après ces lignes. Cependant si on rgarde dans le dossier tmp, la session est bien supprimée (à la fin du script).

