<?php

require_once 'inc/init.inc.php';

// ---------------------TRAITEMENT---------------------

// 2- Si membre NON connecté, alors on le redirige vers la page de connexion : il n'a pas le doit d'accéder à son profil

if (!internauteEstConnecte()){
    header('location:connexion.php');
    exit();
}
// 1-préparation des variable d'affichage :
extract($_SESSION['membre']); // extrait tous les index pour en faire de variables qui reçovont la valeur qui leur correspondent



// ----------------AFFICHAGE----------------
require_once 'inc/haut.inc.php';
?>

<h1 class="mt-4">Profil</h1>
<h2>Bonjour <strong><?php echo $prenom; ?></strong></h2>

<?php 
if(internauteEstConnecteEtAdmin()) echo '<p>Vous êtes un Administrateur. </p>';
?>
<hr>

<h3>voici vos information de profil</h3>
<p>Votre email: <?php echo $email; ?></p>
<p>Votre adresse: <?php echo $adresse; ?></p>
<p>Votre ville: <?php echo $ville; ?></p>





<?php

require_once 'inc/bas.inc.php';