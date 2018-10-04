<?php

require_once 'inc/init.inc.php';
$affiche_formulaire = true;  // pour affiche le formulaire tant que le membre n'est pas inscrit

// --------------------TRAITEMENT----------------

// traitement de $_POST

// debug($_POST);

if($_POST){ // si le formulaire est envoyé

    // validation de formulaire :
    if(!isset($_POST['pseudo']) || strlen($_POST['pseudo']) < 4 || strlen($_POST['pseudo']) > 20) $contenu .= '<div class="bg-danger"> Le pseudo doit contenir entre 4 et 20 caractères.</div>'; 

    if(!isset($_POST['mdp']) || strlen($_POST['mdp']) < 4 || strlen($_POST['mdp']) > 20) $contenu .= '<div class="bg-danger"> Le mot de passe doit contenir entre 4 et 20 caractères.</div>';

    if(!isset($_POST['nom']) || strlen($_POST['nom']) < 2 || strlen($_POST['nom']) > 20) $contenu .= '<div class="bg-danger"> Le nom doit contenir entre 2 et 20 caractères.</div>';

    if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 2 || strlen($_POST['prenom']) > 20) $contenu .= '<div class="bg-danger"> Le prenom doit contenir entre 2 et 20 caractères.</div>';

    if(!isset($_POST['ville']) || strlen($_POST['ville']) < 2 || strlen($_POST['ville']) > 20) $contenu .= '<div class="bg-danger"> Le ville doit contenir entre 2 et 20 caractères.</div>';

    if(!isset($_POST['adresse']) || strlen($_POST['adresse']) < 4 || strlen($_POST['adresse']) > 20) $contenu .= '<div class="bg-danger"> Le adresse doit contenir entre 4 et 20 caractères.</div>';

    if(!isset($_POST['civilite']) || ($_POST['civilite'] != 'm' && $_POST['civilite'] != 'f')) $contenu .= '<div class="bg-denger">La civilité est incorrecte. </div>';

    if(!isset($_POST['code_postal']) || !preg_match('#^[0-9]{5}$#', $_POST['code_postal'])) $contenu .= '<div class="bg-denger">La code postal est incorrecte. </div>'; // l'expression rationnelle (ou régulière) est encadré par des #. Le ^ signifie que le code postal "commence par " et le $ signifit qu'il "finit par". La présence des deux symboles en même temps signifie qu'on définit l'intégralité de l'expression. [0-9] définit les caractère autorisé de 0 à 9. {5} définit strictement le nombre de ces caractères. La fonction prédéfinie preg_match retourne 0 si le code postal n'est pas correct, sinon 1.

    if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $contenu .= '<div class="bg-denger">L\'email est incorrecte. </div>'; // filter_var() avec le paramètre FILTER_VALIDATE_EMAIL, permet de férivier que la variable est bien de type email. Pour info vous pouvez valider d'autre type : des adresse IP, des formats d'url... (voir la doc php.net).

    // Si plus d'erreur dur le formulaire, on vérifie la disponibilité de pseudo avec d'inscrire le membre en BDD :

    if(empty($contenu)){ // si $contenu est vide c'est qu'il n'y a plus de message d'erreur
        // vérifier en BDD que le pseudo n'existe pas
        $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo'=>$_POST['pseudo']));
        $_POST['pseudo']; // $membre contient un objet PDOStatement qui provient de la requete SQL

        if($membre->rowCount() > 0){
            // si la requete  returne des ligne c'est que le pseudo exiest en BDD
            $contenu .= '<div class="bg-denger">La pseudo existe déjà. </div>';
        } else {
            // le pseudo est disponible : on inscrit donc le membre en BDD
            executeRequete("INSERT INTO membre (pseudo, mdp, nom, prenom, email, civilite, ville, code_postal, adresse, statut) VALUES (:pseudo, :mdp, :nom, :prenom, :email, :civilite, :ville, :code_postal, :adresse, 0)", array(
                ':pseudo'       => $_POST['pseudo'],
                ':mdp'          => $_POST['mdp'],
                ':nom'          => $_POST['nom'],
                ':prenom'       => $_POST['prenom'],
                ':email'        => $_POST['email'],
                ':civilite'     => $_POST['civilite'],
                ':ville'        => $_POST['ville'],
                ':code_postal'  => $_POST['code_postal'],
                ':adresse'      => $_POST['adresse']
            ));

            $contenu .= '<div class="bg-success">Vous êtes inscrit.<a href="connexion.php">Cliquez ici pour vous connecter</a> </div>';
            $affiche_formulaire = false;
        } //fin de if($membre->rowCount() > 0)

    } // fin de if(empty($contenu))

} // fin de if($_POST)




// -----------------affiche----------------------
require_once 'inc/haut.inc.php';
?>

<h1 class="mt-4">Inscription</h1>

<?php
echo $contenu;

if($affiche_formulaire) : // si internaute n'est pas inscruot, cette variable valant true, on entre dans la condition en on affiche le formulaire

    print_r($_POST);

?>


    <p><strong style="color: #FF7F50;">Veuillez renseigner le formulair pour vous inscrire</strong></p>

    <form method="post" action="">
        <label for="pseudo">Pseudo</label> <br>
        <input placeholder="Pseudo" type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? ''; ?>"> <br><br>

        <label for="mdp">Mod de passe</label> <br>
        <input placeholder="Mod de passe" type="text" id="mdp" name="mdp" value="<?php echo $_POST['mdp'] ?? ''; ?>"> <br><br>

        <label for="nom">Nom</label> <br>
        <input placeholder="First name" type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"> <br><br>

        <label for="prenom">Prenom</label> <br>
        <input placeholder="Last name" type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"> <br><br>

        <label for="email">Email</label> <br>
        <input placeholder="Email" type="text" id="email" name="email" value="<?php echo $_POST['email'] ?? ''; ?>"> <br><br>

        <label>Civilité</label> <br>
        <input type="radio" name="civilite" value="m" checked> Homme
        <input type="radio" name="civilite" value="f"  <?php if(isset($_POST['civilite']) && $_POST['civilite'] == 'f') echo 'checked'; ?> > Femme <br><br>

        <label for="ville">Ville</label> <br>
        <input placeholder="Ville" type="text" id="ville" name="ville" value="<?php echo $_POST['ville'] ?? ''; ?>"> <br><br>

        <label for="code_postal">Code postal</label> <br>
        <input placeholder="Code postal" type="text" id="code_postal" name="code_postal" value="<?php echo $_POST['code_postal'] ?? ''; ?>"> <br><br>

        <label for="adresse">Adresse</label> <br>
        <textarea placeholder="Adresse" name="adresse" id="adresse" cols="30" rows="5"><?php echo $_POST['adresse'] ?? ''; ?></textarea> <br><br>

        <input type="submit" value="s'inscrire" name="inscription" class="btn btn-info">
    </form>


<?php
endif;


// echo 'ICI je mets le contenue de la page';

require_once 'inc/bas.inc.php';