<?php

/* 1- Créer une base de données "contacts" avec une table "contact" :
	  id_contact PK AI INT(3)
	  nom VARCHAR(20)
	  prenom VARCHAR(20)
	  telephone VARCHAR(10)
	  annee_rencontre (YEAR)
	  email VARCHAR(255)
	  type_contact ENUM('ami', 'famille', 'professionnel', 'autre')

	2- Créer un formulaire HTML (avec doctype...) afin d'ajouter un contact dans la bdd. Le champ année est un menu déroulant de l'année en cours à 100 ans en arrière à rebours, et le type de contact est aussi un menu déroulant.
	
	3- Effectuer les vérifications nécessaires :
	   Les champs nom et prénom contiennent 2 caractères minimum, le téléphone 10 chiffres
	   L'année de rencontre doit être une année valide
	   Le type de contact doit être conforme à la liste des types de contacts
	   L'email doit être valide
	   En cas d'erreur de saisie, afficher des messages d'erreurs au-dessus du formulaire

	4- Ajouter les contacts à la BDD et afficher un message en cas de succès ou en cas d'échec.

*/



//-----------------------------------------
//  _________connect with database_________ 
//-----------------------------------------
$pdo = new PDO('mysql:host = localhost;dbname=contacts', 
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8')
);

$msg = '';

// print_r($_POST);

if($_POST){
	// verifiy nom
	if(!isset($_POST['nom']) || strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20) $msg .= '<p>Your "nom" should be in 3-20 .</p>';

	// verifiy prenom
	if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20) $msg .= '<p>Your "prenom" should be in 3-20 .</p>';

	// verifiy telephone
	// if(!isset($_POST['telephone']) || !preg_match("/^[0-9]{10}$/", $_POST['telephone'])) $msg .= '<p>Your "telephone" should be 10 number .</p>';
	// ____OU_____	
	if(!isset($_POST['telephone']) || !preg_match('#^[0-9]{10}$#', $_POST['telephone'])) $msg .= '<p>Your "telephone" should be 10 number .</p>';

	// verifiy date
	if(!isset($_POST['annee_rencontre']) || !strtotime($_POST['annee_rencontre'])) $msg .= '<p> Year is not in correct format.</p>';

	// verifiy email
	if(!isset($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) $msg .= '<p>Email is not in correct format.</p>';

	// verifiy Type contact
	if(!isset($_POST['type_contact']) || ($_POST['type_contact'] !='ami' && $_POST['type_contact'] != 'famille' && $_POST['type_contact'] !='professionnel' && $_POST['type_contact'] !='autre')) $msg .= '<p>Contect is not in correct.</p>';

	// si pas d'error sur le formulair, on enregister en BDD :
	if(empty($msg)){
		foreach($_POST as $index => $value){
			// $_POST[$index] = htmlentities($value, ENT_QUOTES);
			$_POST[$index] = htmlspecialchars($value, ENT_QUOTES);
		}

		// $prepare_requete is an object and PDOStatement
		$prepare_requete = $pdo->prepare("INSERT INTO contact (nom, prenom, telephone, annee_rencontre, email, type_contact) VALUES (:nom, :prenom, :telephone, :annee_rencontre, :email, :type_contact)");

		$prepare_requete->bindparam(':nom', $_POST['nom']);
		$prepare_requete->bindparam(':prenom', $_POST['prenom']);
		$prepare_requete->bindparam(':telephone', $_POST['telephone']);
		$prepare_requete->bindparam(':annee_rencontre', $_POST['annee_rencontre']);
		$prepare_requete->bindparam(':email', $_POST['email']);
		$prepare_requete->bindparam(':type_contact', $_POST['type_contact']);

		// $result ce un boolen = il savoir si le requete il a bien
		$result = $prepare_requete->execute();

		if($result){
			$msg .= '<p>Your contact is in the list.</p>';
		}else{
			$msg .= '<p>SORRY! Your contact is not the list.</p>';
		}

	}


}

// _______loop "for" year_______ 
// $year = 2119;
// for($i = date('Y'); $i < $year; $i++){
// 	echo $i;
// }


?>

<h1>Ajout un Contact</h1>
<?php echo $msg; ?>
<form method="post" action="">

    <label for="nom">Nom</label> <br>
    <input type="text" name="nom" id="nom" value="<?php echo $_POST['nom']?? '';?>"> <br><br>
    
    <label for="prenom">Prenom</label> <br>
    <input type="text" name="prenom" id="prenom" value="<?php echo $_POST['prenom']?? '';?>"> <br><br>
    
    <label for="telephone">Telephone</label> <br>
    <input type="text" name="telephone" id="telephone" value="<?php echo $_POST['telephone']?? '';?>"> <br><br>
    
	<label for="">Annee rencontre</label> <br>
	
	<?php 
	/*
		$year = date('Y');
		echo '<select name="annee_rencontre" id="">';
		for($i = 1919; $i < $year; $i++){
			echo '<option value="'.$i.'"> ' .$i. '</option>';
		}
		echo '</select><br><br>'; 
	*/
	?>

	<?php
		echo '<select name="annee_rencontre" id="">';
		for($i = date('Y'); $i >= date('Y')-100; $i--){
			echo '<option value="'.$i.'"> ' .$i. '</option>';
		}
		echo '</select><br><br>';
	?>
    
    <label for="email">Email</label> <br>
    <input type="text" name="email" id="email" value="<?php echo $_POST['email']?? '';?>"> <br><br>
    
    <label for="">Type contact</label> <br>
    <select name="type_contact">
        <option value="ami">Ami</option>
        <option value="famille">Famille</option>
        <option value="professionnel">Professionnel</option>
        <option value="autre">Autre</option>
    </select> <br><br>
    
    <input type="submit" value="Enregistrer">
</form>