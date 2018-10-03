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