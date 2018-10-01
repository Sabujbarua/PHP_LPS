<?php

// Ouverture ou création d'une session :
session_start();

echo 'La session est accessible dans tout les script de site, comme ici : ';
print_r($_SESSION); // on voit les de la session crée dans la page sessions1.php

// ce fichier n'a rien à voir avec l'autre, il n'y a pas d'inclusion, il pourrait être dans un autre  dossier, s'appeler n'importe comment.  Les fichiers contenues dans la session restent accessibles grâce au session_start().