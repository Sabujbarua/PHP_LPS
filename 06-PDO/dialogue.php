<?php

// -------------------------------------------
// Cas pratique : un formulaire pour poster des comentaires
// -------------------------------------------

// objectif : sécuriser le formulaire

/*
Modélisation de la BDD :
    BDD     : dailogue
    table   : commentaire
    Champ   : id_commentaire       INT(3) PK AI
            pseudo                 VARCHAR(20)
            message                TEXT
            date_enregistrement    DATETIME
*/

// -----------------------------------------------------
// II. connexion à la BDD et traitement de $_POST :
// -----------------------------------------------------

$pdo = new PDO('mysql:host = localhost;dbname=dialogue',
                'root', 
                '', 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8') 
);

// print_r($_POST);

if(!empty($_POST)){

    // c. Traitement contre les failes Javascript ou CSS : on parle d'échapper les données ou d'échappement
    $_POST['pseudo'] = htmlspecialchars($_POST['pseudo'], ENT_QUOTES);
    $_POST['message'] = htmlspecialchars($_POST['message'], ENT_QUOTES); // Convertit les caractères spéciaux(<,>,&,'',"") en entités HTML inoffensives (par exemple le > devient &gt;). Ainsi les balises <style> ou <script>saisie dans le formulaire deviennent inopérantes.



    // a. nous commeçons par faire une requête d'insertion qui n'est pas protégée contre les injections et qui n'accepte pas les apostrophes :

    // $resultat = $pdo->query("INSERT INTO commentaire(pseudo, date_enregistrement, message) VALUES ('$_POST[pseudo]', NOW(), '$_POST[message]')"); // exemple typique de ce qu'il ne faut pas faire : mettre des entrées utilisateur (ici $_POST) directement dans la requête.

    // Nous faisons l'injection SQL suivante : ok'); DELETE FROM commentaire;(
    // Ele a pour effet de vider la table commentaire.

    // pour se prémunir des injections SQL, Nous faisons la requête préparée suivante :
    $resultat = $pdo->prepare("INSERT INTO commentaire (pseudo, date_enregistrement, message) VALUES (:pseudo, NOW(), :message)");

    $resultat->bindParam(':pseudo', $_POST['pseudo']);
    $resultat->bindParam(':message', $_POST['message']);
    //  short of two line top line \/ is in the down
    // $resultat->execute(array(':pseudo'=> $_POST['pseudo'],':message' => $_POST['message']));

    $resultat->execute();

    // comment ça marche? le faiit de mettre des marqueurs dans la requête permet de ne pas concaténer les instructions SQL les rendant directement exécutables. en faisant un bindparam, les instractions SQL sont automatiquement neutralisées par PDO qui les transforme en string bruts infoffensifs. Ainsi le SGBD attend des valeurs à la place des marqueurs dont il sait qu'elles ne sont pas du codeà exécuter. 



} // fin de !empty($_POST)



//  I. formulaire de saisie des commentaires :
?>

<h1>Votre commentaire</h1>

<form method="post" action="">
    <label for="pseudo">Pseudo</label> <br>
    <input type="text" id="pseudo" name="pseudo" value="<?php echo $_POST['pseudo'] ?? '' ?>"> <br>

    <label for="message">commentaire</label> <br>
    <textarea name="message" id="message" cols="30" rows="10"><?php echo $_POST['message'] ?? '' ?></textarea> <br>

    <input type="submit" name="envoi" value="envoyer">
</form>


<!--PHP start here-->
<?php
// ----------------------------------
// III. Affichage des commentaires :
// ----------------------------------
$resultat = $pdo->query("SELECT pseudo, message, DATE_FORMAT(date_enregistrement, '%d-%m-%Y') AS datefr, DATE_FORMAT(date_enregistrement, '%H-%i-%s') AS heurefr FROM commentaire ORDER BY date_enregistrement DESC");

echo $resultat->rowCount() . ' commentaires postés <br>';

while($commentaire = $resultat->fetch(PDO::FETCH_ASSOC)){
    echo '<div> par : ' . $commentaire['pseudo'] . ' le ' . $commentaire['datefr'] . 'à' . $commentaire['heurefr'] . '</div>';
    echo '<div>' . $commentaire['message'] . '</div> <hr>';
}