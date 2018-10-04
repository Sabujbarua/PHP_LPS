<?php
require_once 'inc/init.inc.php';

// 2-Déconnexion de l'internaute :
if(isset($_GET['action']) && $_GET['action'] == 'deconnexion'){ // si on reçoit en GET dans l'url l'indice "action" et la valeur "deconnexion", c'est que le membre veut se déconnecter
    unset($_SESSION['membre']); // on suprime les info de membre dans la session

    $contenu .= '<div class="p-3 mb-2 bg-info text-white"> Vous avez été déconnecté.</div>';

}

// 3- l'internaut connecté est redirigé vers son profile : il n'y a pas de raison qu'il puisse se reconnecter une second fois :

if(internauteEstConnecte()){
    header('location:profil.php');
    exit();
}

// 1- Traitement de formulaire de connexion :
// debug($_POST);

if($_POST){
    // controle sur le formulaire
    if(empty($_POST['pseudo'])){ // empty vérifie si c'est vide(0, NULL, undifine, false)
        $contenu .= '<div class="text-danger"> Le pseudo est requis.</div>';
    }

    if(empty($_POST['mdp'])){ // empty vérifie si c'est vide(0, NULL, undifine, false)
        $contenu .= '<div class="text-danger"> Le mot passe est requis.</div>';
    }

    if(empty($contenu)){ // is $contenu, c'est qu'il n'y a pas d'erreur sur le formulaire : on peut donc interroger la BDD
        $resultat = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo AND mdp = :mdp", array(':pseudo' => $_POST['pseudo'], ':mdp' => $_POST['mdp']));

        if($resultat->rowCount() > 0){ // s'il y a 1 (ou plusers) lignes dans $resultat, le pseudo et le mot de passe existent pour le m^éme membre
            $membre = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car il n'y a qu'une seule ligle de résultat dans la requtet (les pseudos sont unique)

            $_SESSION['membre'] = $membre; // nous créons une session applée "membre" qui contient les information provenant de la BDD

            header('location:profil.php'); // on redirige (redirection) l'internaute vers la page située à l'url "profil.php"
            exit(); // et on quiter la page

        } else {
            // sinon il n'y pas de correspondent entre le login et le mdp pour le même membre :
            $contenu .= '<div class="bg-danger"> Erreur sur les identifiants.</div>';
        }

    } // fin de if(empty($contenu))



} // fin de if($_post)








// ---------------Affichage---------------
require_once 'inc/haut.inc.php';
?>
<h1 class="mt-4">Connexion</h1>
<p>Veuillez indiquer vos identifiants pour vous connecter.</p>
<?php echo $contenu; ?>

<form action="" method="post">
    <label for="pseudo">Pseudo</label> <br>
    <input type="text" placeholder="Pseudo" id="pseudo" name="pseudo"> <br>

    <label for="mdp">Mot de passe</label> <br>
    <input type="password" placeholder="Mot de passe" id="mdp" name="mdp" > <br>

    <input type="submit" value="Se connecter"  class=" mt-4 btn btn-success">

</form>


<?php
require_once 'inc/bas.inc.php';