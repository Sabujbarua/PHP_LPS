<?php
echo '<h1>Les commerciaux et leur salaire</h1>';

// Exercice :
// - afficher dans une liste <ul><li> : le prenom, le nom et le salaire des employes du service commercial (1 commercial par <li>). pour cela, vous utilisez une requête préparée.
//Afficher le nombre de commerciaux dans l'entreprise

function debug($param){
    echo '<pre style="background: lightgreen">';
        print_r($param);
    echo '</pre>';
}

// 1 Connexion à la BDD

$pdo = new PDO('mysql:host = localhost;dbname=societe',
                'root', 
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8') 
);

// requête préparée
$service = 'commercial';

$resultat = $pdo->prepare("SELECT prenom, nom, salaire FROM employes WHERE service = :service ");

$resultat->bindParam(':service', $service);
$resultat->execute();

echo '<ul>';
while($donnees = $resultat->fetch(PDO::FETCH_ASSOC)){
    // echo '<li>';
    //     debug($donnees);
    // echo '</li>';

    echo '<li>' .  $donnees['prenom'] . ' ' .  $donnees['nom'] . ' ' . '<strong>' . $donnees['salaire'] . '</strong>' . '</li>';
}
echo '</ul>';

echo "Les nombers de commercial est : " . '<strong>' . $resultat->rowCount() . '</strong>' . '<br>';

echo '<pre>'; print_r(get_class_methods($resultat));
var_dump($resultat);