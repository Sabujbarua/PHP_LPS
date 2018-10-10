
<?php 
require_once '../inc/init.inc.php';

//-----------------------------  TRAITEMENT -----------------------------
// 1 - On vérifie que le membre est administrateur :
if(!internauteEstConnecteEtAdmin()){
    header('location:../connexion.php'); // je remonte dans le dossier parent pour accéder au fichier connexion.php
    exit(); // pour quitter le script
}

//  4- TRAITEMENT de formulaire : enregisterement de produit
// debug($_POST);

if($_POST){ // si le formulaire est posté
     
    // ICI il fauarait mettre tous les controles sur le formulaire ..

    $photo_bdd = ''; //pour pouvoir insérer cette valeur par defaut en BDD

    // 5- suite de la $PHOTO : 
    // debug($_FILES);

    if(!empty($_FILES['photo']['name'])){ // si existe l'indice "name" à l'intérieur de l'indice "phpto", c'est que je suis en train d'uploader un ficher

        $nom_photo = 'ref' . $_POST['reference'] . '_' . $_FILES['photo']['name']; // on cocatène la référence du produit avec le nom du ficher unique (et ne pas écraser une photo existante).

        $photo_bdd = 'photo/' . $nom_photo; // cette variable est le chemin relatif de les photo enregisteré en BDD et utilisé par les balises <img> de site.

        copy($_FILES['photo']['tmp_name'], '../' . $photo_bdd); // copy le fichier temporaire qui se trouve à l'adresse $_FILES['photo']['tmp_name'] dans le chimin est "../photo/nomdelaphotp.jpg"
    }

    // 4- suite: enregisterement de produit
    executeRequete("REPLACE INTO produit VALUES (:id_produit, :reference, :categorie, :titre, :description, :couleur, :taille, :public, :photo, :prix, :stock)", 
        array(':id_produit' => $_POST['id_produit'],
              ':reference' => $_POST['reference'],
              ':categorie' => $_POST['categorie'],
              ':titre' => $_POST['titre'],
              ':description' => $_POST['description'],
              ':couleur' => $_POST['couleur'],
              ':taille' => $_POST['taille'],
              ':public' => $_POST['public'],
              ':photo' => $photo_bdd,
              ':prix' => $_POST['prix'],
              ':stock' => $_POST['stock']    
        ));
// REPLACE INTO se comporte comme un INSERT INTO quand l'id produit fourni n'existe pas en BDD (= création d'un produit). Il se comporte comme un UPDATE quand l'id_produit fourni existe en BDD(=modification d'un produit).

$contenu .= '<div class="alert alert-success">Le produit a bien été enregistré.</div>';


} // fin de if($_POST)








// --------------------AFFICHAGE--------------------

require_once '../inc/haut.inc.php';
?>

<h1 class="mt-4">Gestion Boutique</h1>
<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link">Affichage des produits</a></li>
    <li><a href="ajout_modif_produit.php" class="nav-link active bg-info">Ajout des produit</a></li>
</ul>



<?php
echo $contenu; // affiage la table
?>

<!-- 3- formulaire d'ajout d'un produit -->

<form method="post" action="" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" spécifie que le formulier envoie des données binaires (correspondants aux autre champs). il est obligatoire pour pouvoir uploadeer des fichieres.-->

    <input type="hidden" name="id_produit" value="0"> <!--champ caché utile pour la modification d'un produit existant, car on a besoin de le connaitre pour la requête sql replace into qui se comporte comme un update en présence d'un id existant la value à 0 permet de specifier que l'id n'existe pas donc replace into doit se comporter comme un insert pour crer le produit-->

    <label for="reference">Référence</label> <br>
    <input type="text" id="reference" name="reference" value=""> <br><br>

    <label for="categorie">Catégorie</label> <br>
    <input type="text" id="categorie" name="categorie" value=""> <br><br> 

    <label for="titre">Titre</label> <br>
    <input type="text" id="titre" name="titre" value=""> <br><br>

    <label for="description">description</label> <br>
    <textarea name="description" id="" cols="30" rows="5"></textarea> <br><br>

    <label for="couleur">couleur</label> <br>
    <input type="text" id="couleur" name="couleur" value=""> <br><br>

    <label for="">Taille</label> <br>
    <select name="taille" id="taille">
        <option value="S">S</option>
        <option value="M">M</option>
        <option value="L">L</option>
        <option value="XL">XL</option>
    </select> <br><br>

    <label for="public">Public</label>
    <input type="radio" name="public" value="m" checked> Homme
    <input type="radio" name="public" value="f" > Femme <br><br>

    <label for="photo">Photo</label> <br>
    <!--5- photos-->
    <input type="file" id="photo" name="photo"> <br> <br> <!-- ne pas oublier l'atribut enctype de la balise form pour pouvoir uploder de fichiers-->

    <label for="prix">prix</label> <br>
    <input type="text" name="prix" id="prix" value="0"> <br> <br>

    <label for="stock">Stock</label> <br>
    <input type="text" name="stock" id="stock" value="0"> <br><br>

    <input type="submit" value="enregistrer" class="btn">






</form>



<?php

require_once '../inc/bas.inc.php';