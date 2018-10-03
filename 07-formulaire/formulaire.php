<?php

// ------------------------------------
// Validation de formulaire
// ------------------------------------

// créer un formulaire qui permet d'enregistrer un nouvel employé dans le BDD societe.

$message = ''; // variable pour afficher les message d'erreur

// 2- connexion BDD :

$pdo = new PDO('mysql:host = localhost;dbname=societe', 
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8')
);

//  3- Traitement de $_POST : 

if($_POST){ // écriture simplifiée => if(!empty($_POST)) - grâce aux valeurs implicites - 
    // le formulaire est posté, on a reçu des informations

    print_r($_POST);

    // 3.1- contrôles de formulaire :

        if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) $message .= '<p> le prenom doit comporter entre 3 et 20 caractères</p>'; // on vérifie que l'indice prénom existe !isset($_POST['prenom'])
            // si n'existe pas l'indice prénom c'est que le name (du formulaire) correspondant a été modifié
            // on vérifie aussi la longueur du prénom

        if(!isset($_POST['nom']) || strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) $message .= '<p> le prenom doit comporter entre 3 et 20 caractères</p>';

        if(!isset($_POST['service']) || strlen($_POST['service']) < 3 || strlen($_POST['service']) > 30) $message .= '<p> le prenom doit comporter entre 3 et 30 caractères</p>';

        if(!isset($_POST['sexe']) || ($_POST['sexe'] != 'm' && $_POST['sexe'] != 'f')) $message .= '<p>le sexe n\'est pas valide</p>';

        if(!isset($_POST['date_embauche']) || !strtotime($_POST['date_embauche'])) $message .= '<p>la date n\'est pas valide</p>'; // rappel strtotime => renvoie FALSE si le timestamp de la date fournie ne peut pas être obtenue, autrement 
        // si la date n'est pas réputée valide (sinon cette fonction retourne un timestamp pour la date renseignée)

        if(!isset($_POST['salaire']) || !is_numeric($_POST['salaire']) || $_POST['salaire'] <= 0) $message .= '<p>la salaire nombre positif.</p>'; // is_numeric() vérifie si la variable est un nombre ou bien une chaîne numérique (un nombre en string)
        // is_int() recherche un chiffre alors qu'en BDD on récupère un chiffre mais entre quotes donc un string !!


        // -------------------------
        // si la variable $message est vide, c'est que le formulaire est valude : on peut enregistrer en BDD: 
        if (empty($message)){

            // on échappe toutes les valeurs de $_post :
            foreach ($_POST as $indice => $valeur){
                $_post[$indice] = htmlentities($valeur, ENT_QUOTES); // on prend la valeur que l'on traite avec htmlspecialchaea() puis que l'on range dans so emplacement initial qui est $_POST[$indice]
            }



            
            // on reformate la date en yyyy-mm-dd
            $date = new DateTime($_POST['date_embauche']); // on crée un objet date qui contient la date d'embauche à partir de la class DateTime.
            $date_embauche = $date->format('Y-m-d'); // on utilise la méthode format() pour changer le format de la date
            var_dump($date_embauche);
            
            // la requête préparée :
            $resultat = $pdo->prepare("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES (:prenom, :nom, :sexe, :service, :date_embauche, :salaire)");
            
            $resultat->bindparam(':prenom', $_POST['prenom']);
            $resultat->bindparam(':nom', $_POST['nom']);
            $resultat->bindparam(':sexe', $_POST['sexe']);
            $resultat->bindparam(':service', $_POST['service']);
            $resultat->bindparam(':date_embauche', $_POST['date_embauche']);
            $resultat->bindparam(':salaire', $_POST['salaire']);
            
            $req = $resultat->execute(); // $req est un booléen : true en cas de succès de la requête, sinon false en cas d'échec
            
            // message de réussite ou d'échec de l'enregistrement
            
            if($req){
                $prompt_msg = $message.= '<p style="background: lightgreen;">' . 'L\'employé a bien ajouté' . '</p>';
            } else {
                $message.= '<p style="background: red;">Erreur lors de l\'enregistrement' . '</p>';
            }
        } // fin de if (empty($message))


} // fin de la  if($_POST)







/**
 * CULTURE de programmeur => Les valeurs implicites
 * 
 * 0 est interprété => FALSE
 * 
 * 1 est interprété => TRUE
 * 24 est interprété => TRUE
 * -5 est interprété => TRUE
 * 
 * '' est interprété => FALSE
 * 'hello' est interprété => TRUE
 * 
 * array() est interprété => FALSE
 * array('azerty', 1, 'fghjk') est interprété => TRUE
 * 
 */

echo $message;
?>

<!--1. validation de fourmula-->
<!-- form[method="post"]>(label+br+input[id="" name="" value=""]+br)*7 -->

<form method="post" action="">
    <label for="prenom">Prénom</label> <br>
    <input type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>"><br>

    <label for="nom">Nom</label> <br>
    <input type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"> <br>

    <label for="">Sexe</label> <br>
    <input type="radio" name="sexe" value="m" checked> Homme<br>
    <input type="radio" name="sexe" value="f" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == 'f') echo 'checked'; ?>> Femme <br>

    <label for="service">Service</label> <br>
    <input type="text" id="service" name="service" value="<?php echo $_POST['service'] ?? ''; ?>"> <br>
    
    <label for="date_embauche">Date d'embauche</label> <br>
    <input type="text" id="date_embauche" name="date_embauche" placeholder="jj-mm-yyyy" value="<?php echo $_POST['date_embauche'] ?? ''; ?>"> <br>

    <label for="salaire">Salaire</label> <br>
    <input type="text" id="salaire" name="salaire" value="<?php echo $_POST['salaire'] ?? ''; ?>"> <br>


    <input type="submit" value="enregistrer">

</form>
