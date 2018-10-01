
<?php
// Exercice :
// -- crée un formulaire avec le champs ville, code postal et une zone de texte adress.
// -- vous afficher le données saisies par l'internaute dans la page formulaire2-traitement.php.

print_r($_POST);
echo '<hr>';

if(!empty($_POST)){
    echo 'Ville : ' . $_POST['ville'] . '<br>';
    echo 'Code Postal : ' . $_POST['cPostal'] . '<br>';
    echo 'Adresse : ' . $_POST['adress'] . '<br>';
}

?>