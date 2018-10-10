
<?php 
require_once 'inc/init.inc.php';

//-----------------------------  TRAITEMENT -----------------------------
// 1- Affichage des catégories :
$resultat = executeRequete("SELECT DISTINCT categorie FROM produit");

$contenu_gauche .= '<div class="list-group">';

    // Affichage de la categorie "tout" par défaut :
    $contenu_gauche .= '<a href="?categorie=tous" class="list-group-item">Tous les produit</a>';

    // Affichage des autres categorie provenant de la BDD :
    while($cat = $resultat->fetch(PDO::FETCH_ASSOC)){ // FETCH_ASSOC crée un array associatif appelé $cat à chaque tour de loop
        // debug($cat);
        $contenu_gauche .= '<a href="?categorie='.$cat['categorie'].'" class="list-group-item">'.$cat['categorie'].'</a>';

    }
$contenu_gauche .= '</div>';


// 2- affichage des produits en fonction de la categorie
if(isset($_GET['categorie']) && $_GET['categorie'] != 'tous'){
    // si existe l'indice "categorie" dans l'url, et que sa valeur est différent de "tous", on sélectionne la categorie demandée :
    $donnees = executeRequete("SELECT * FROM produit WHERE categorie = :categorie", array(':categorie' => $_GET['categorie']));

} else {
    // sinon si "categorie" n'existe pas dans l'url ou qu'elle est égale à "tous", on sélectionne TOUS les produit
    $donnees = executeRequete("SELECT * FROM produit");
}

while($produit = $donnees->fetch(PDO::FETCH_ASSOC)){
    // debug($produit);
    $contenu_droite .= '<div class="col-sm-4 mb-4">';
        $contenu_droite .= '<div class="card">';
            // image cliqueable
            $contenu_droite .= '<a href="fiche_produit.php?id_produit='.$produit['id_produit'].'">
                                    <img src="'.$produit['photo'].'" class="card-img-top" alt="'.$produit['titre'].'">
                                </a>';
            
            // infos de produit
            $contenu_droite .= '<div class="card-body">';
                $contenu_droite .= '<h4>'.ucfirst($produit['titre']).'</h4>'; // ucfirst() is to make first letter in maciscul
                $contenu_droite .= '<h5>'. number_format($produit['prix'], 2, ',', '').' €</h5>';  // number_format(number, number de décimales, séparateur de décimal, séparateur des miliers)
                $contenu_droite .= '<p>'.$produit['description'].'</p>';

            $contenu_droite .= '</div>';




        $contenu_droite .= '</div>';
    $contenu_droite .= '</div>';
}











// --------------------AFFICHAGE--------------------

require_once 'inc/haut.inc.php';
?>

<h1 class="mt-4">Vêtement</h1>

<div class="row">

    <div class="col-md63">
        <?php echo $contenu_gauche; // pour afficher les catégories?> 
    </div>
    <div class="col-md-9">
        <div class="row">
            <?php echo $contenu_droite; // pour afficher les catégories?>
        </div>
    </div>

</div> <!--fin de class="row"-->






<?php

require_once 'inc/bas.inc.php';