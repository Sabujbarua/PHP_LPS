<?php

// fichier de configuration de site

// connecxion à la BDD
$pdo = new PDO('mysql:host = localhost;dbname=site_commerce',
                'root', 
                '', 
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8') 
);

// session :
session_start();

// Constante qui contient le chemin de site :
define('RACINE_SITE', '/03-php/08-site/'); // indiquer le dossiere dans lequel se situe le sote sans "localhost". permet de créer des chemins absolus utilisés notamment dans le header du site inclus dans différents sous-dossiers : par conséquent les chemins relatifs vers les sources changent selon le sous-dossier, ce qui n'est pas le cas en chemin absolu// echo __DIR__ . '<br>'; 
// affiche le chemin complet (absolu) vers le dossier de notre fichier

// variable d'affichaege :
$contenu = '';
$contenu_gauche = '';
$contenu_droite = '';

// inclusion de fichier qui contien les function de site :
require_once 'fonctions.inc.php';