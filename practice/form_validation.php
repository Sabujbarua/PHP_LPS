
<?php
// ------------php start here------------

$message = ''; // variable pour afficher les message d'erreur

// 2- connexion BDD :

$pdo = new PDO('mysql:host = localhost;dbname=validation_form', 
                'root',
                '',
                array(PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, 
                      PDO::MYSQL_ATTR_INIT_COMMAND => 'set NAMES utf8')
);

$msg1 = '';
$msg2 = '';
$msg3 = '';
$msg4 = '';
$msg5 = '';

// test if every form is complited bellow

if($_POST){
    // validation of prenom
    if(!isset($_POST['prenom']) || strlen($_POST['prenom']) < 3 || strlen($_POST['prenom']) > 20){
        echo $msg1 .= '<p>Prenom should be in 3-20 letters.</p>';
    } 
    // validation of nom
    if(!isset($_POST['nom']) || strlen($_POST['nom']) < 3 || strlen($_POST['nom']) > 20){
        echo $msg2 .= '<p>Nom should be in 3-20 letters.</p>';
    } 
    // validation of service
    if(!isset($_POST['service']) || strlen($_POST['service']) < 3 || strlen($_POST['service']) > 20){
        echo $msg3 .= '<p>Service should be fill.</p>';
    }
    // validation of date_embauche 
    if(!isset($_POST['date_embauche']) || strlen($_POST['date_embauche']) < 3 || strlen($_POST['date_embauche']) > 20){
        echo $msg4 .= '<p>Date D\'embauche should be fill.</p>';
    } 
    // validation of salaire
    if(!isset($_POST['salaire']) || strlen($_POST['salaire']) < 3 || strlen($_POST['salaire']) > 20){
        echo $msg5 .= '<p>Salaire should be fill.</p>';
    } 


    // data can insert only where pass this condition :
    if(empty($msg) && empty($msg1) && empty($msg2) && empty($msg3) && empty($msg4) && empty($msg5)){

        // prohibited all html tag to DB
        foreach($_POST as $index => $value){
            $_POST[$index] = htmlentities($value, ENT_QUOTES);
        }


        // date format
        $date = new DateTime($_POST['date_embauche']);
        $dformat = $date->format('d-m-Y');
        // requete for insert workers
        $requete = $pdo->prepare("INSERT INTO workers(prenom, nom, sexe, service, date_embauche, salaire) VALUES(:prenom, :nom, :sexe, :service, :date_embauche, :salaire)");

        $requete->bindparam(':prenom', $_POST['prenom']);
        $requete->bindparam(':nom', $_POST['nom']);
        $requete->bindparam(':sexe', $_POST['sexe']);
        $requete->bindparam(':service', $_POST['service']);
        $requete->bindparam(':date_embauche', $_POST['date_embauche']);
        $requete->bindparam(':salaire', $_POST['salaire']);

        // requete execute
        $result = $requete->execute();

    }
    



    
}


// echo $msg;
// print_r($_POST); // test form

// ------------php end here------------
?>


<h2 style="text-align: center; color: orange">Form validation</h2>
<!--1. validation de fourmula-->
<form method="post" action="" style="text-align: center;">
    <p style="margin-bottom: 0px; margin-top: 0px; margin-left: 12rem; color: red;"><?php echo $msg1; ?></p>
    <label for="prenom">Prenom : </label>
    <input type="text" id="prenom" name="prenom" value="<?php echo $_POST['prenom'] ?? ''; ?>" style="margin-left: 4rem;"> <br><br> 

    <p style="margin-bottom: 0px; margin-top: 0px; margin-left: 12rem; color: red;"><?php echo $msg2; ?></p>
    <label for="nom">Nom : </label>
    <input type="text" id="nom" name="nom" value="<?php echo $_POST['nom'] ?? ''; ?>"style="margin-left: 5rem;"> <br> <br>

    <label style="margin-right: 5rem;" for="">Sexe : </label>
    <input type="radio" name="sexe" value="m" checked>Homme
    <input type="radio" name="sexe" value="f" <?php if(isset($_POST['sexe']) && $_POST['sexe'] == 'f') echo 'checked'; ?>>Femme <br> <br>

    <p style="margin-bottom: 0px; margin-top: 0px; margin-left: 8rem; color: red;"><?php echo $msg3; ?></p>
    <label for="service">Service : </label>
    <input type="text" id="service" name="service" value="<?php echo $_POST['service'] ?? ''; ?>"style="margin-left: 4rem;"> <br> <br>

    <p style="margin-bottom: 0px; margin-top: 0px; margin-left: 12rem; color: red;"><?php echo $msg4; ?></p>
    <label for="date_embauche">Date D'embauche : </label>
    <input type="text" id="date_embauche" name="date_embauche" value="<?php echo $_POST['date_embauche'] ?? ''; ?>"> <br> <br>

    <p style="margin-bottom: 0px; margin-top: 0px; margin-left: 8rem; color: red;"><?php echo $msg5; ?></p>
    <label for="salaire">Salaire : </label>
    <input type="text" id="salaire" name="salaire" value="<?php echo $_POST['salaire'] ?? ''; ?>"style="margin-left: 4.4rem;"> <br> <br>

    <input type="submit" value="Enregistrer" style="margin-left: 3.5rem; height: 2rem; width: 10rem; background: lightblue;">

</form>