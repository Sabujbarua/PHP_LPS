
<?php 
require_once 'inc/init.inc.php';

//-----------------------------  TRAITEMENT -----------------------------

// variable d'affichage : 
$panier = '';
$suggestion = '';

// 1- controle de l'existence de produit demandé (un produit en fvori a pu être supprimé de la BDD...) :
if(isset($_GET['id_produit'])){
    // si un produit a été sélectionné :
    $resultat = executeRequete("SELECT * FROM produit WHERE id_produit = :id_produit", array(':id_produit' => $_GET['id_produit']));

    if($resultat->rowCount() == 0){
        // s'il n'y a pas de ligne dans $resultat, c'est le produit n'existe pas
        header('location:boutique.php'); // on redirige vers la boutique
        exit();
    }

    // Afficage des infos de produit :
    $produit = $resultat->fetch(PDO::FETCH_ASSOC); // on ne fait pas de loop while ici car on est certain de n'avoir qu'un seul produit par id_produit
    // debug($produit);
    extract($produit); // crée autant de variable qu'il y a d'index dans array $produit. celles-ci ont pour nom le nom de l'indice et pour valeur la valeur associée à cet index.

    // 3- Afficage de formulaire d'ajout au panier si stock est positif :
    if($stock > 0){
        // si le stock existe, on ajout le bouton panier :
        $panier .= '<form action="panier.php" method="post">';
                    $panier .= '<input type="hidden" name="id_produit" value="'.$id_produit.'">'; // pour doneée le id de produit selectinné au panier

                    // sélecteur de quantité de produit
                    $panier .= '<select name="quantite" class="custom-select col-sm-2" id="">';
                        for($i = 1; $i <= $stock && $i <= 5; $i++){
                            $panier .= '<option>' .$i. '</option>';
                        }
                    $panier .= '</select>';

                    $panier .= '<input type="submit" name="ajout_panier" value="Ajout au panier" class="btn col-sm-8 ml-2" style="background: #00BFFF">';

        $panier .= '</form>';

        $panier .= '<p>Nombre de produit(s) disponible(s) : '.$stock.'</p>';

    }else{
        // si le stock est null on met le message suivant :
        $panier .= '<p class="text-danger"> Produit en repture de stock . . .</p>';
    }


}else{
    // sinon, l'indice "id_produit" n'existe pas dans l'url, ce qui signifie que l'on a accéde à la page directement sans choisir de prouit : on redirige donc vers la boutique 
    header('location:boutique.php');
    exit();
}


/**
* EXERCICE
*
* Créer des suggestions de produits : afficher 2 produits (photo et titre) aléatoirmement appartenant
* à la même catégorie que le produit affiché, ET différent du produit affiché
* Vous utilisez la variable $suggestion pour afficher le contenu
* la photo est cliqueable et mème à la fiche du produit
*/
// $resultat = executeRequete("SELECT id_produit, photo, titre FROM produit WHERE categorie = '$categorie' AND id_produit <> '$id_produit' ORDER BY RAND() LIMIT 5");

$resultat = executeRequete("SELECT * FROM produit WHERE categorie = :categorie AND id_produit != '$id_produit' ORDER BY RAND() LIMIT 5", array(':categorie' => $categorie));
    
        while($produit_suggestion = $resultat->fetch(PDO::FETCH_ASSOC)){
            $suggestion .= '<div class="col-md-3">';
                $suggestion .= '<h6>'.$produit_suggestion['titre'].'</h6>';
                $suggestion .= '<a href="fiche_produit.php?id_produit='.$produit_suggestion['id_produit'].'">
                                    <img class="img-fluid" src="'.$produit_suggestion['photo'].'" alt="'.$produit_suggestion['titre'].'">
                                </a>';
            $suggestion .= '</div>';
        }





// --------------------AFFICHAGE--------------------

require_once 'inc/haut.inc.php';
?>

<div class="row">

    <div class="col-12">
        <h1><?php echo $titre; ?></h1>
    </div>

    <div class="col-md-8">
        <img src="<?php echo $photo; ?>" class="img-fluid" alt="<?php echo $titre; ?>">
    </div>

    <div class="col-md-4">
        <h3>Description</h3>
        <p><?php echo $description; ?></p>

        <h3>Détails</h3>
        <ul>
            <li>Catégorie : <?php echo $categorie; ?></li>
            <li>Couleur : <?php echo $couleur; ?></li>
            <li>Taille : <?php echo $taille; ?></li>
        </ul>
        <h4>Prix : <?php echo number_format($prix, 2, ',', ''); ?> €</h4>

        <?php echo $panier; ?>

        <p>
            <a href="boutique.php?categorie=<?php echo $categorie; ?>">Retour vers la catégorie '<?php echo $categorie; ?>'</a>
        </p>

    </div> <!-- fin de class="col-md-4"-->


</div> <!--class="row"-->

<!-- Exercice : suggestion de produit-->
<hr>

<div class="row">
    <div class="col-12">
        <h3>Suggestion de produit</h3>
    </div>
    <?php echo $suggestion; ?>

</div> <!--fin de class="row"-->




<?php

require_once 'inc/bas.inc.php';