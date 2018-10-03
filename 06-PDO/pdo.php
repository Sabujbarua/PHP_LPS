<?php
// -------------------------------
//         PDO (PHP data object)
// -------------------------------
// PDO pour PHP data objects, définit une interface pour accéder à une base de données depuis le PHP.


function debug($param){
    echo '<pre style="background: lightgreen">';
        print_r($param);
    echo '</pre>';
}

// --------------------------------------
echo '<h3>01 - Connexion</h3>';
// --------------------------------------

$pdo = new PDO('mysql:host = localhost;dbname=societe', // driver (càd système de gestion de BDD) ici mysql (pourraît etre Oracle, IBM, ODBC ...) + nom du serveur de la BDD + nom de la BDD

                'root', // pseudo de la BDD
                '', // mot de passe de la BDD
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // pour afficher les message d'erreur SQL
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8') // définition de jeu de  caractères des échabges avec la BDD
);

// mysql => système de gestion de BDD (aurait pût être du Oracle, IBM, ODBC ...)
// host => serveur où est la BDD
// dbname => nom de la BDD
// 'root' => login
// '' => mdp ('root' sur Macs)
// PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, ==> affichage des erreurs SQL en mode 'avertissement' non bloquant
// :: se met après une classe (ici on a des constantes de classes en majuscules) et remplace la -> qui est utilisée après un objet


// $pdo est un objet issu de la classe prédéfinie PDO, il représente la connexion à la BDD ici "societe"

// -------------------------------------------
echo '<h3>02 - la méthode exec() </h3>';
// -------------------------------------------
// exec() est utilisée pour la formulation de requêtes de retournant pas de résultat : INSERT, UPDATE, DELETE

$resultat = $pdo->exec("INSERT INTO employes (prenom, nom, sexe, service, date_embauche, salaire) VALUES('test', 'test', 'm', 'test', '2016-02-08', 500)");
// les objets qui viennent de la BDD ne prennet pas de quotes, les valeurs à insérer par contre oui elles prennent des quotes

/**
 * Valeur de retour :
 *  - Succès : renvoie le nombre de lignes affectées par la requête
 *  - Echec : retourne false
 */

//echo 'Nombre de lignes affectées par la requête INSERT INTO : ' . $resultat . '<br>';

echo "Number de line affectées le INSERT INTO: $resultat <br>"; // entre "" la variable est évaluée
echo 'Dernier id généré par la BDD :' . $pdo->lastInsertID() . '<br>';


//----------------------------------------
echo '<h3> 02.1 - Supprimer les lignes avec "test" </h3>';
//----------------------------------------
$resultat = $pdo->exec("DELETE FROM employes WHERE prenom ='test' ");
echo "<br> Nombre de lignne affectées par le DELETE : $resultat <br>";


// --------------------------------------------------------------
echo '<h3>03 - la méthode query() et les différents fetch</h3>';
// --------------------------------------------------------------

// Au contraire de exec(), query() s'utilise pour la formulation de requêtes retournant 1 ou plusieurs résultats : SELECT.
$result = $pdo->query("SELECT * FROM employes WHERE prenom ='daniel'");// Daniel ou daniel ne change rien SQL est insensible à la casse
// $result est in objet de la classe PDOStatement

//next line is to test to collect prenom and nom
// $result = $pdo->query("SELECT prenom, nom FROM employes WHERE prenom ='daniel'");
debug($pdo);
debug($result);


/**
explication simplifiée
l'objet $pdo provient de la classe PDO et représente la connexion à la BDD, query() est une méthode de PDO qui 
permet de sélectionner des éléments de la BDD et retourne un autre objet issu d'une autre classe (la classe PDO_Statement)

        $pdo (connexion à la bdd)
 *****************************************
 *   à l'intérieur de $pdo je peux       *
 *   utiliser la méthode query() :       *
 *                                       *
 *   function query() {                  *
 *        $res = new PDOStatement();     *
 *        return $res;                   *
 *   }                                   *
 *****************************************
 */

/**
 * Valeur de retour de la méthode query() :
 *  - Succès : elle nous fournit un objet issu de la classe prédéfinie PDOStatement qui contient 1 ou plusieurs 
 * jeux de résultats
 *  - Echec : retourne false
 *
 * Notez que query() peut aussi être utilisée avec INSERT, UPDATE et DELETE
 */


 // $result est le résultat de la requête sous forme inexploitable directement
 // en effet on ne voit pas le jeu de résultat concernant ici Daniel à l'intérieur ...
 // il faut donc transformer $result avec la méthode fetch() :

$employe = $result->fetch(PDO::FETCH_ASSOC); // la méthode fetch() avec le paramètre PDO::FETCH_ASSOC permet de transformer l'objet $result en un ARRAY....
// "$result->fetch(PDO::FETCH_ASSOC);"      transforme $result en array associatif
// "$employe ="                             l'affecte à $employe
debug($employe);
echo "Je suis $employe[prenom] $employe[nom] du service $employe[service] <br>"; // n'oubliez pas que qu'un array écrit dans des quotes ou des guillemets perd ses quotes à son indice


// résumé des 4 étapes principle pour afficher daniel chevel : 
// 1 - connecxion à la BDD
// 2 - on fait la  requête : on obtient un objet PDOStatement
// 3 - on fait un fetch sur cet object pour le transformer
// 4 - on affiche le résumtat final


// date: 02-10-2018 *****************************

// -------------------
// on peut aussi transformer l'objet PDOStatement $result selon les methodes fetch suivantes :
$result = $pdo->query("SELECT * FROM employes WHERE prenom ='daniel'");
$employe = $result->fetch(PDO::FETCH_NUM); // transformer l'objet $result en un ARRAY indicé numériquement
debug($employe);
echo $employe[1] . '<br>'; // on passe par l'indice numérique 1 pour afficher le prenom

$result = $pdo->query("SELECT * FROM employes WHERE prenom ='daniel'");
$employe = $result->fetch(); // transformer l'objet $result en un ARRAY associatif et numérique.
debug($employe);
echo $employe['prenom'] . '<br>';
echo $employe[1] . '<br>';  // On passe par l'indice numérique pour afficher le prénom

$result = $pdo->query("SELECT * FROM employes WHERE prenom ='daniel'");
$employe = $result->fetch(PDO::FETCH_OBJ); //transformer l'objet $result en un autre OBJET stdClass dans lequel on accéde aux information de Daniel Chevel : les propriétés de cet objet correspondent aux champs de la requête SQL
debug($employe);
echo $employe->prenom . '<br>';
echo '<br>';

// NOTE : on répète la requête SQL avant chaque fetch(), car on ne peut pas réaliser PLUSIEURS fetch() sur le même, résultat. 

// exercice : afficher le service de l'employé dont l'id employes est 417
$result = $pdo->query("SELECT service FROM employes WHERE id_employes = 417");
$employe = $result->fetch(PDO::FETCH_ASSOC); //PDO::FETCH_ASSOC ou PDO::FETCH_num
// debug($employe);
echo " le service de l'employé 417 est :  <strong> $employe[service] </strong> "; // $employe[service] ou $employe[0] 


// --------------------------------------------------------------
echo '<h3> 04 - la méthode query() et boucle while </h3>';
// --------------------------------------------------------------

// Quand on est certain d'avoir qu'un résulta dans  notre requête : pas de boucle. si on peut avoir potentiellement plusieurs : on fait un loop.

$resultat = $pdo->query("SELECT * FROM employes");
echo "nombre d'employes dans l'intreprise : " . $resultat->rowCount() . '<br>';
// rowCount() compte le nombre de lignes retournées par la requête. on peut anisi compter le nombre de produits, de membres inscrits...

// $employe = $resultat->fetch(PDO::FETCT_ASSOC);

while($employe = $resultat->fetch(PDO::FETCH_ASSOC)){ //fetch() retourne la ligne suivante de jeu de résultat en un array associatif. la loop while permet de faire avance le curseur dans le jeu de résultat et s'arrête quand le curseur est à la fin des résultat/.
    // debug($employe); // $employe est un array associatif qui contient les données d'une ligne de jeu de résultat contenu dans $resultat pour chaque tour de loop
    
    echo '<div>';
        echo '<p>' . $employe['id_employes'] . '</p>';
        echo '<p>' . $employe['prenom'] . '</p>';
        echo '<p>' . $employe['nom'] . '</p>';
    echo '<div> <hr>';
    $employe++;
}
// conclusion: on fait une loop si on a potentiellement plusieurs résultats.

// --------------------------------------------------------------
echo '<h3> 05 - la méthode fetchAll()</h3>';
// --------------------------------------------------------------
$resultat = $pdo->query("SELECT * FROM employes");
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC); // retourne toutes les ligne de résultats dans un tableau multidimensionnel : on a 1 sous-array associatif à chaque indicés numérique de donnees. On peut mettre aussi FETCH8NUM pour des sous-array indicé numériquement ou fetchALL() vide pour des sous-array numérique et associatifs.
debug($donnees);

// on parcort $donnees avec une loop foreach pour en afficher le contenu :
foreach($donnees as $employe){
    //debug($donnees);  // $employe correspond à chaque sous-array associatif contenu dans $donnees

    // echo '<div>';
    //     echo '<p>' . $employe['id_employes'] . '</p>';
    //     echo '<p>' . $employe['prenom'] . '</p>';
    //     echo '<p>' . $employe['nom'] . '</p>';
    // echo '<div> <hr>';

    foreach($employe as $employe2){
        echo '<p>' . $employe2 . '</p>';
    }
    echo '<hr>';
}
    

// --------------------------------------------------------------
echo '<h3> 06 - Exercice </h3>';
// --------------------------------------------------------------
//  afficher la liste des différents services de l'enterprise, dans une liste <ul> <li>
$resultat = $pdo->query("SELECT DISTINCT service FROM employes");

// loop foreach
$donnees = $resultat->fetchAll(PDO::FETCH_ASSOC);
echo '<ul>';
foreach($donnees as $value){
    echo '<li>'. $value['service'] .'</li>';
}
echo '</ul>';


// loop while
echo '<ul>';
while($value = $resultat->fetch(PDO::FETCH_ASSOC)){
    echo '<li>'. $value['service'] .'</li>';
    $value++;
}
echo '</ul>';


// --------------------------------------------------------------
echo '<h3> 07 - Table HTML </h3>';
// --------------------------------------------------------------

$resultat = $pdo->query("SELECT * FROM employes");
echo '<table border="1">';
    // Affichage de la ligne des entêtes dynamiquement
    echo '<tr>';

        for($i=0; $i < $resultat->columnCount(); $i++){
            debug($resultat->getColumnMeta($i)); // la méthode "getColumnMeta()" retourne un array qui contient notamment l'indice "name" avec le nom de chaque colonne (=champs de la tableau)
            $colonne = $resultat->getColumnMeta($i);
            echo '<th>' . $colonne['name'] . '</th>'; // l'indice "name" contient le nom de champ à chaque tour de loop 
        }
        // echo '<th> action</th>'; //test to put a heade "action"


    echo '</tr>';
    // Affichage des ligne :
    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
            // $ligne étant un array, je peux faire une foreach pour le parcourir
            foreach($ligne as $information){

                echo '<td>'. $information .'</td>';
                
            }
            // echo '<td> <a href="?action=delete&id='.$ligne['id_employes'].'">Delete</a> <td>'; // test to put a delete button

        echo '<tr>';
    }

echo '</table>';

// debug(get_class_methods($resultat));


// --------------------------------------------------------------
echo '<h3> 08 - requête préparée et bindParam() </h3>';
// --------------------------------------------------------------

$nom = 'sennard'; 
// une requête préparée se réalise en 3 étapes :

// etape 1: pr&parer le requête :
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); // :nom est marqueur nominatif qui est en  attente d'une valeur

// etape 2 : lier les marqueurs aux valeurs :
$resultat->bindParam(':nom', $nom); // bindParam() recoit exclusivement une VARIABLE vers laquelle pointe le marqueur (on ne peut pas y mettre une valeur directement). anisi, si le contenu de la variable change, la valeur de marqueur changera automatiqument (pas besoin de refaire bindOaram).

// etape 3 : exécuter la requête :
$resultat->execute();

// puis on fait un fetch sur $resultat pour obtenir le jeu de résultat qu'il contient :
$donnees = $resultat->fetch(PDO::FETCH_ASSOC); // pas de while car il n'y a qu'un seul résultat.
debug($donnees);

// $nom = 'Chevel';
// $resultat->execute(); 
// $donnees = $resultat->fetch(PDO::FETCH_ASSOC);
// debug($donnees);

/*
    prepare() permet de préparer une requête mais ne execute pas.
    execute() permet de execute une requête prepare

    Valeurs de retour :
        prepare() renvoie toujours un objet PDOStatment.
        execute() : 
            succès : TRUE
            Echec : FALSE
    Les requêtes préparées sont préconisées i vous exécutez plusieurs fois la même requête et ainsi vouloir éviter de répéter le cycle analyse / interprétation / exécution réalisé par le SGBD (gain de performance). 

    Les requêtes préparées sont  souvent utilisées pour assénir les données et éviter les injections SQL (ce que nous verrons dans un chapitre ultérieur). 
                
*/

// si on change la valeur contenue dans $nom sans refaire in bindParam(), le marqueur de la requête pointe automatiquement vers la nouvelle valeur. on peut donc faire une execute() directement

$nom ='durand';
$resultat->execute(); 
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees); // on accède aux données de durand sans avoir refait un bindParam().


// --------------------------------------------------------------
echo '<h3> 08 - requête préparée et bindParam() </h3>';
// --------------------------------------------------------------

$nom = 'thoyer';

// 1 prépare la requête
$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom"); 

// 2 lier les marqueurs aux valeurs :
$resultat->bindValue(':nom', $nom); // bindValu() reçoit une variable OU une valeur directement. le marqueur point uniquement vers la valeur : si celle-ci change, il faudra refaire un bindValue lors d'un nouvel execute() pour tenir compte de cette nouvelle valeur (sinon le marqueur conserve l'ancienne valeur).

// 3 execute la requête
$resultat->execute(); 

// puis on affiche le résultat :
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);

// Si on change la valeur de $nom, sans nouveau bindValue, le marqueur de la requête continue de pointer vers "thoyer"
$nom ='durand';
$resultat->execute(); 
$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);  // on continue d'accéder aux valeurs de "thoyer" si on ne refait pas notre bindValue.


// --------------------------------------------------------------
echo '<h3> 10 - requête préparée et points complémentaires </h3>';
// --------------------------------------------------------------

echo '<h4> le Marqueur "?" </h4>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = ? AND prenom = ? ");
// on prépar la requête avec les parties variable représente par des marqueurs sous form de "?"

$resultat->bindValue(1, 'durand'); // le chiffre 1 représente le premier marqueur "?" de la requête
$resultat->bindValue(2, 'damien'); // le chiffre 2 représente le second marqueur "?" de la requête
$resultat->execute();

//on peut aussi utiliser cette sytaxe directement :
$resultat->execute(array('durand', 'damien')); // on peut remplacer les 2 bindValue et le execute() précédent par cette ligne, en passant un array à la méthode execute(). Les valeurs sont dans le même ordre que les marqueursdans la requête

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);

echo '<h4> execute() sans bindParam() ni bindValue() </h4>';

$resultat = $pdo->prepare("SELECT * FROM employes WHERE nom = :nom AND prenom = :prenom");

$resultat->execute(array(':nom'=>'chevel', 'prenom'=>'daniel')); // on associe les mlarqueurs à leur valeur directement dans un array passé à la méthode execute()

$donnees = $resultat->fetch(PDO::FETCH_ASSOC);
debug($donnees);


// --------------------------------------------------------------
echo '<h3> 11 L\'extension MySqli </h3>';
// --------------------------------------------------------------

//connecxion à la BDD :
$mysqli = new Mysqli('localhost', 'root', '', 'societe');

// example de requête :
$resultat = $mysqli->query("SELECT * FROM employes");
debug($resultat);


//--------------------- FIN DU FICHIER ----------------------------------
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style> h3{ color: orange; background: #232323; text-align: center; padding: 10px;}</style>
</head>
<body>
    
</body>
</html>