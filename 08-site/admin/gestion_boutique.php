
<?php 
require_once '../inc/init.inc.php';

// --------------------TRAITEMENT--------------------

// 1- on vérifie que le membre est administreteur :
if(!internauteEstConnecteEtAdmin()){
    header('location:../connexion.php'); // je remonte dans le dossier parents pour accéder au fichier connexion.php
    exit(); // pour quitter le script
}

// 7- suppression d'un produit :
// debug($_GET);

if(isset($_GET['action']) && $_GET['action'] == 'suppression' && isset($_GET['id_produit'])){ // is existe l'index "action" dans $_GET et que sa valeur est "suppression" et que existe aussi l'index "id_produit", alors je peux traiter la suppression du produit demandé

    $resultat = executeRequete("DELETE FROM produit WHERE id_produit = :id_produit", array('id_produit' => $_GET['id_produit']));

    if($resultat->rowCount() == 1){
        // si le DELETE retourne 1 ligne, c'est l'id_produit  existant et qu'il a pu être suprimé :
        $contenu .= '<div class="alert alert-success">Le produit n° '.$_GET['id_produit'].' a bien été supprime</div>';
    } else {
        // sinon c'est que l'id_produit n'existe pas ou plus
        $contenu .= '<div class="alert alert-danger">Error lors de la supression de produit n° '.$_GET['id_produit'].'</div>';
    }

}

// 6- Affichage des produits dans une table HTML :
// Exercice : afficher tous les produit sous form de table HTML. cette table est stockée dans la variable $contenu. Tous les champs doivent être affichés. pour la photo, vous affichez l'image (90px de largeur).


/* # test pour affisage le table en boutique
_______________________________________________
$resultat = $pdo->query("SELECT * FROM produit");
echo '<table border="1">';
    echo '<tr>';
        for($i=0; $i < $resultat->columnCount(); $i++){

            //  debug($resultat->getColumnMeta($i));

            $colonne = $resultat->getColumnMeta($i);

                echo '<th>'. $colonne['name'] .'</th>';               
        }
    echo '</tr>';

    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        echo '<tr>';
        foreach($ligne as $index => $info){
            
            if($index == 'photo'){
                echo '<td><img style="height: 90px; width: 90px;" src="../'.$info.'"></td>';
            } else {
                echo '<td>'. $info .'</td>';
            }
        }
        echo '</tr>';
    }
echo '</table>'; */  

$resultat = $pdo->query("SELECT * FROM produit");
$contenu .= '<h3> Le nombre de produits est : ' . $resultat->rowCount() .'</h3>';

$contenu .= '<table border="1">';
    $contenu .= '<tr>';
        for($i=0; $i < $resultat->columnCount(); $i++){

            //  debug($resultat->getColumnMeta($i));

            $colonne = $resultat->getColumnMeta($i);

                $contenu .= '<th>'. $colonne['name'] .'</th>';               
        }

        $contenu .= '<th>Action</th>'; // on ajoute cette colonne en pluse de autre rs  affichages daynamiquement

    $contenu .= '</tr>';

    // Affichage des ligne
    while($ligne = $resultat->fetch(PDO::FETCH_ASSOC)){
        $contenu .= '<tr>';
            foreach($ligne as $index => $value){
                
                if($index == 'photo' && !empty($value)){
                    $contenu .= '<td><img style="height: 90px; width: 90px;" src="../'.$value.'" alt="'. $ligne['titre'] .'"></td>';
                } else {
                    $contenu .= '<td style="height: 90px; width: 90px;">'. $value .'</td>';
                }
            }
            // debug($ligne);
            $contenu .= '<td>
                            <a href="ajout_modif_produit.php?action=modification&id_produit='.$ligne['id_produit'].'">Modifier</a> <br>
                            <a href="?action=suppression&id_produit='.$ligne['id_produit'].'"  onclick="return(confirm(\'Etes vous certain de vouloir supprimer ce produit ?\'))">Supprimer</a>
                        </td>';

        $contenu .= '</tr>';
    }
$contenu .= '</table>';




// --------------------AFFICHAGE--------------------

require_once '../inc/haut.inc.php';
?>
<!-- 1 - navigation :-->
<h1 class="mt-4">Gestion Boutique</h1>
<ul class="nav nav-tabs">
    <li><a href="gestion_boutique.php" class="nav-link active bg-info">Affichage des produits</a></li>
    <li><a href="ajout_modif_produit.php" class="nav-link">Ajout des produit</a></li>
</ul>



<?php
echo $contenu; // pour afficher la table HTML des produits

require_once '../inc/bas.inc.php';