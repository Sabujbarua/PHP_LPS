<?php
// -------------------------------
//         PDO (PHP data object)
// -------------------------------
// PDO pour PHP data objects, définit une interface pour accéder à une base de données depuis le PHP.

function debug($param){
    echo '<pre>';
        print_r($param);
    echo '</pre>';
}

// --------------------------------------
echo '<h3>01 - Connexion</h3>';
// --------------------------------------

$pdo = new PDO('mysql:host = localhost;dbname=societe', // driver mysql (pourrait être oralce, IBM, ODBC...) + nom de la BDD
                'root', // pseudo de la BDD
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les message d'erreur SQL
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8') // définition de jeu de  caractères des échabges avec la BDD
);

// $pdo ci-dessus est un objet issu de la class prédéfinie PDO. il représente la connection à la base de données "societe".

// -------------------------------------------
echo '<h3>02 - la méthode exec() </h3>';
// -------------------------------------------

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES('test', 'test', 'm', 'test', '2016-02-08', 500)");
/*
valeur de retour :
    - sucssès : renvoie le number de line affectées par la requête
    - Echec : retourne false
*/ 

echo "Number de line affectées le INSERT : $resultat <br>";
echo 'Dernier id généré par la BDD :' . $pdo->lastInsertID();

// --------------------
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom ='test' ");
echo "<br> Nombre de lignne affectées par le DELETE : $resultat <br>";


// --------------------------------------------------------------
echo '<h3>02 - la méthode query() et les différents fetch</h3>';
// --------------------------------------------------------------

// Au contraire de exec(), query() s'utilise pour la formulation de requêtes retournant 1 ou plusieurs résultats : SELECT.
$result = $pdo->query("SELECT * FROM employes WHERE prenom ='daniel'");
//ou
// $result = $pdo->query("SELECT prenom, nom FROM employes WHERE prenom ='daniel'");


debug($pdo);
debug($result);

/*
valeur de retour de la méthode query() :
    - succès : elle nous fournit un objet issu de la class prédéfinie PDOStatement qui contient 1 ou plusieurs jeux de résultats
    - Echec : false
  Not.......
*/

// $result est le résultat de la requête sous forme inexploitalbe directement : en effet, on ne voit pas le jeu de résultat concernant Daniel à l'intérieur...
// il faut donc transformer $result avec la méthode fetch():

$employe = $result->fetch(PDO::FETCH_ASSOC); // la méthode fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $result en un ARRAY....
debug($employe);
echo "Je suis $employe[prenom] $employe[nom] du service $employe[service] <br>"; // n'oubliez pas que qu'un array écrit dans des quotes ou des guillemets perd ses quotes à son indice

// résumé des 4 étapes principle pour afficher daniel chevel : 
// 1 - connecxion à la BDD
// 2 - on fait la  requête : on obtient un objet PDOStatement
// 3 - on fait un fetch sur cet object pour le
// 4 - on