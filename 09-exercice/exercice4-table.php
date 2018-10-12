
<?php

/* SUITE DE L'EXERCICE 3
    1- Afficher dans une table HTML la liste des contacts avec les champs nom, prénom, téléphone, et un champ supplémentaire "autres infos" avec un lien qui permet d'afficher le détail de chaque contact.    
    2- Afficher sous la table HTML le détail d'un contact quand on clique sur le lien "autres infos".
*/

// connect with dataBase
$conneDB = new PDO('mysql:host = localhost;dbname=contacts', 
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8')
);

$content = '';

$requete = $conneDB->query("SELECT *  FROM contact");

$content .= '<div class="container">';
    $content .= '<h2 class="alert-info text-center mb-4 mt-4 p-3">contacts</h2>';

    $content .= '<table class="table table-striped mb-5">';
    $content .= '<tr>';       
        $content .= '<th scope="col">Nom</th>';
        $content .= '<th scope="col">Prnom</th>';
        $content .= '<th scope="col">Telephone</th>';
        $content .= '<th scope="col">See More</th>';
    $content .= '</tr>';

    while($info = $requete->fetch(PDO::FETCH_ASSOC)){
        // $id = $_GET['id'];
        $content .= '<tr>';
            $content .= "<td>$info[nom]</td>";
            $content .= "<td>$info[prenom]</td>";
            $content .= "<td>$info[telephone]</td>";
            $content .= '<td><a href="?action=details&id='.$info['id_contac'].'">Full Details</a></td>';

            

        $content .= '</tr>';
    }
// $content .= '</table>';




if(isset($_GET['action']) && $_GET['action'] == 'details' && isset($_GET['id'])){

    $prepare_requete = $conneDB->prepare("SELECT id_contac, nom, prenom, telephone, annee_rencontre, email, type_contact FROM contact WHERE id_contac = :id_contac");
    // $prepare_requete = $conneDB->prepare("SELECT * FROM contact (nom, prenom, telephone, annee_rencontre, email, type_contact) VALUES (:nom, :prenom, :telephone, :annee_rencontre, :email, :type_contact)");


    $prepare_requete->bindParam(':id_contac', $_GET['id']);
        
    $result = $prepare_requete->execute();

        // var_dump($result); // test boolen of  $result = $prepare_requete->execute();

    $result = $prepare_requete->fetch(PDO::FETCH_ASSOC);

    $content .= '<table class="table table-striped">';

        $content .= '<tr>';       
            $content .= '<th scope="col">ID</th>';
            $content .= '<th scope="col">Nom</th>';
            $content .= '<th scope="col">Prnom</th>';
            $content .= '<th scope="col">Telephone</th>';
            $content .= '<th scope="col">Rencontre</th>';
            $content .= '<th scope="col">Email</th>';
            $content .= '<th scope="col">Type</th>';
        $content .= '</tr>';

        $content .= '<tr class="alert-warning">';

            $content .= '<td>'.$result['id_contac'].'</td>';
            $content .= '<td>'.$result['nom'].'</td>';
            $content .= '<td>'.$result['prenom'].'</td>';
            $content .= '<td>'.$result['telephone'].'</td>';
            $content .= '<td>'.$result['annee_rencontre'].'</td>';
            $content .= '<td>'.$result['email'].'</td>';
            $content .= '<td>'.$result['type_contact'].'</td>';

        $content .= '</tr>';
    $content .= '</table>';
}

$content .= '</div>'; // end of div class container















?>



<?php 
// __________________________________________________________________________________
// ____________________________________correction____________________________________
// __________________________________________________________________________________
$contenu = '';

$query = $conneDB->prepare("SELECT * FROM contact");
$query->execute(); //les méthodes prepare() et execute() vont toujour ensemble


// on prepare la table HTML :
$contenu .= '<table border="1">';
    $contenu .= '<tr>';
        $contenu .= '<th>Nom</th>';
        $contenu .= '<th>Prenom</th>';
        $contenu .= '<th>Telephone</th>';
        $contenu .= '<th>Autre Info</th>';

    $contenu .= '</tr>';

// tant qu'il y a un retult dans $query, on prepare la ligne de la table HTML correspondant au contant :
while($contact = $query->fetch(PDO::FETCH_ASSOC)){
    $contenu .= '<tr>';
        $contenu .= '<td>'.$contact['nom'].'</td>';
        $contenu .= '<td>'.$contact['prenom'].'</td>';
        $contenu .= '<td>'.$contact['telephone'].'</td>';
        // link to click
        $contenu .= '<td><a href="?id_contac='.$contact['id_contac'].'">Plus d\' info</a></td>';        
    $contenu .= '</tr>';

    //  test $contact
    // echo '<pre>';
    //     print_r($contact);
    // echo '</pre>';
}
$contenu .= '</table>';



// si on clique sur un link Plus d\' info
if(isset($_GET['id_contac'])){ // si l'index "id_contact" ent dans $_GET, donc dans l'url, c'est qu'on a demandé le detailsd'un contact

    // echo 'ligne 148'; //on peut faire un echo ou un exit ou un die pour vérifier que l'on passe bien dans cette condition

    $_GET['id_conta'] = htmlspecialchars($_GET['id_contac'], ENT_QUOTES); // permet de transform les caractères special en entités HTML pour se prémunir des risques JS (XSS) et CSS

    // on fait une requete prepare de selection de contact dans la DB :
    $query = $conneDB->prepare("SELECT * FROM contact WHERE id_contac = :id_contac");
    $query->bindParam(':id_contac', $_GET['id_contac']);
    $query->execute(); // avec un prepare() TOUJOURS execute()

    // on transform le result de la requete en un array associatif :
    $contact = $query->fetch(PDO::FETCH_ASSOC);// pas de while car on certain de n'avoir qu'un seul résultat

    // var_dump($contact); // test contact $contact

    // on affiche les infos de contact
    $contenu .= '<h2>Détail de contact</h2>';


    if($contact == false){
        $contenu .= '<p>Ce contact n\'exiest pas</p>';
    }else{
        $contenu .= '<ul>';
            $contenu .= '<p> <strong> Nom : </strong>'.$contact['nom'].'</p>';
            $contenu .= '<p> <strong> Prenom : </strong>'.$contact['prenom'].'</p>';
            $contenu .= '<p> <strong> Telephone : </strong>'.$contact['telephone'].'</p>';
            $contenu .= '<p> <strong> Rencontre : </strong>'.$contact['annee_rencontre'].'</p>';
            $contenu .= '<p> <strong> Email : </strong>'.$contact['email'].'</p>';
            $contenu .= '<p> <strong> Contact : </strong>'.$contact['type_contact'].'</p>';
        $contenu .= '</ul>';
    }
    


}













?>

<!DOCTYPE html>
<html lang="en">
<head>
         <!-- Bootstrap Core CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
<?php 
echo $content;
echo $contenu;
?>

</body>
</html>




