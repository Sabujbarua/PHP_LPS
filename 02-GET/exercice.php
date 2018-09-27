<?php

//  Exercice :

/*
1- vous crée une page "profil" avec un nom et prenom.
2- vous y ajouttez 1 lien "modifier mon profil". ce lien passe dans l'url à la page exercice.php elle même que l'action demandée est la modification de compte.
3- si la modification est demandée, c'est-à-dire que vius avez reçu cette info en GET, vous avez demandé la modification de votre profil§
*/

    echo '<h1>Profile</h1>';
    
    echo '<p>Prenom : Jaun <br> nom : Doe </p>';

    echo '<a href="exercice.php?article=sms"> Modification Mon Profile </a>';

    if(isset($_GET['article'])){

        echo '<p> you page had changed</p>';

    }