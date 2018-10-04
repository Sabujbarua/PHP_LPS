<?php

function debug($param){
    echo '<pre>';
        var_dump($param);
    echo '</pre>';
}

/******************FONCTION MEMBRES******************/
// fonction m'indique si l'internaute est connecté :
function internauteEstConnecte(){
    if(isset($_SESSION['membre'])){
        return true; // si l'indice "membre" existe dans la session, c'est que l'internaute est passé dans le formulaire de connexion avec le log/mdp. On retourne donc "true".
    } else {
        return false; // dans le cas contraire il n'est pas connecté, on retourne "false".
    }
    // ou (line bellow is in short of "if" conditation)
    // return (isset($_SESSION['membre']));
}


// function qui indique si le membre est un administrateur et est connecté :
function internauteEstConnecteEtAdmin(){
    if(internauteEstConnecte() && $_SESSION['membre']['statut']==1){
        return true;
    } else {
        return false;
    }
}


// -------------------FONCTION DE REQUETE-------------------
// $membre = executeRequete("SELECT * FROM membre WHERE pseudo = :pseudo", array(':pseudo'=>$_POST['pseudo']));

function executeRequete($requete, $param = array()){
    if(!empty($param)) { // si j'ai bien reçu un array rempli, je peux faire la foreach dessus pour transformer les cractères spéciaux en entités HTML :
        foreach($param as $indice => $valeur){
            $param[$indice] = htmlspecialchars($valeur, ENT_QUOTES); // pour éviter les injection css et JS
        }
    }
    
    global $pdo; // permet d'avoir accès à la variable $pdo définie dans l'espace global(à l'extérieur de la function)
    $resultat = $pdo->prepare($requete); // ici on prepare la requete fournie lors de l'apple la function
    $resultat->execute($param); // on execute en liant les marqueurs aux valeurs qui se trouvent dans l'array$param fourni lors de l'appel de la fonction  

    return $resultat; // on  retourne l'objet pdo statement à l'endroit ou la fonction executeRequete est appelée.

}