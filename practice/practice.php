<style>
h2{color: orange; background: #404040; text-align: center;}
</style>
<?php
echo '<h2>Hello PHP World</h2>';
?>

<P>Bonjour</P>  
<!-- we can write HTML out of <?php    ?> sigh because we are out of php -->

<?php
//--------------------------------------------------
echo '<h2>Affichage</h2>';
//---------------------------------------------------
echo 'Bongour PHP ';
echo 'nous sommes jeudi';


//--------------------------------------------------------------
echo '<h2>Variable : Déclaration / Affection / Type</h2>';
//--------------------------------------------------------------
$a = 127;
echo gettype($a);
echo '<br>';

$a = 'une chaîne de caractères';
echo gettype($a);
echo '<br>';

$b = '127';
echo gettype($b);
echo '<br>';

$a = true;
echo gettype($a);
echo '<br>';


//----------------------------------
echo '<h2>Concaténation</h2>';
//----------------------------------
$x = 'Bonjour '; $y = 'tout le monde';
echo $x . $y . '<br>'; // "+" here is "."
echo $x , $y , '<br>'; // "+" here is ","

echo '<br>';

$prenom1 = 'Bruno'; $prenom1 = 'Claire';
echo $prenom1 . '<br>';

$prenom2 = 'Nicolas ';
$prenom2 .= 'Marie'; // it is how the same variable hold two different value and add between
echo $prenom2 . '<br>';


//------------------------------------
echo '<h2>Guillemets et Quotes</h2>';
//------------------------------------
$message = "Aujord'hui";
$message = 'Aujord\'hui';

$text = 'Bonjour ';
echo "$text tout le monde <br>";
echo '$text tout le monde <br>';


//----------------------------------------------
echo '<h2>Constante et Constante Magique</h2>';
//----------------------------------------------
define('CAPITALE', 'paris');
echo CAPITALE . '<br>';
echo __DIR__ .'<br>'; // affiche le chemin complet vers le dossier de notre fichier
echo __FILE__ . '<br>'; // affiche le chemin complet vers le fichier (dossier + nom du fichier)

echo '<br>';
$a = 'blue';
$b = 'red';
$c = 'white';
echo "$a-$b-$c <br>";
echo $a.'-'.$b.'-'.$c;


//----------------------------------------
echo '<h2>Opérateurs Arithmétique</h2>';
//----------------------------------------
$a = 10;
$b = 2; 
echo 'a = 10, ';
echo 'b = 2 <br><br>';

echo 'a + b = ' . ($a + $b) . '<br>';
echo 'a - b = ' . ($a - $b) . '<br>';
echo 'a * b = ' . ($a * $b) . '<br>';
echo 'a / b = ' . ($a / $b) . '<br>';
echo 'a % b = ' . ($a % $b) . '<br>';
echo '<br>';

echo '(a += b) = ' . ($a += $b) . '<br>';
echo '(a -= b) = ' . ($a -= $b) . '<br>';
echo '(a *= b) = ' . ($a *= $b) . '<br>';
echo '(a /= b) = ' . ($a /= $b) . '<br>';
echo '(a %= b) = ' . ($a %= $b) . '<br>';

//-----------------------------------
// Incrémenter et décrementer :
//-----------------------------------
$i = 0;
echo $i++;
echo '<br>';
echo ++$i;
echo '<br>';
echo --$i;
echo '<br>';
echo $i--;
echo '<br>';

$i = 0;
$k = $i++;

echo '$i vaut ' . $i . '<br>';
echo '$k vaut ' . $k . '<br>';


//---------------------------------------------------------------------
echo '<h2>Structures Conditionnelles - Opération de Comparaison</h2>';
//---------------------------------------------------------------------
$a = 10;
$b = 5;
$c = 2;

//---------------
// if.....eles :
//---------------
if($a > $b){
    echo '$a est supérieur à $b <br>';
} else {
    echo 'Non, c\'est $b qui est supérieur ou égal à <br>';
}

//---------------------------
// l'opérateur AND écrit && :
//---------------------------
if ($a > $b && $b > $c){
    echo 'OK pour les 2 condition <br>';
}

//---------------------------
// l'opérateur OR écrit || :
//---------------------------
if ($a == 9 || $b > $c) {
    echo 'OK pour au mois une des 2 condition <br>';
}

//-------------------------
// if ... elseif ... else :
//-------------------------
$a = 10;
$b = 5;
$c = 2;

if ($a == 8) {
    echo '$a est égal à 8 <br>';
} elseif ($a != 10) {
    echo '$a est différent de 10 <br>';
} else {
    echo 'les 2 conditation précédentes sont fausses <br>';
}

//-------------------
// l'opérateur XOR :
//-------------------
$question1 ='mineur';
$question2 ='je vote';

if($question1 == 'mineur' XOR $question2 == 'je vote') {
    echo 'Vos réponses sont coérentes <br>';
} else {
    echo 'Vos réponses ne sont coérentes <br>';
}


//-------------------------------
//Exrecice switch
//-------------------------------
echo '<h2>Switch</h2>';
//--------------------------------
$testSwitch = 'hello';

switch($testSwitch){
    case 'test1' :
        echo 'test 1 is the best';
    break;
    case 'test2' :
        echo 'test 2 is the best';
    break;
    case 'hello' :
        echo 'hello world';
    break;
    default:
        echo 'nothing is correct';
    break;
}

//---------------------------------------------------------------------------
// Exercice : reécrire le switch précédent en condition if ... classiques. on doit obtenir le même résultat.
//---------------------------------------------------------------------------
echo '<h2>if ... elseif ... else</h2>';
//---------------------------------------
$testIfElse = 'hello';
 if($testIfElse == 'test1'){
    echo 'test 1 is the best';
 } elseif ($testIfElse == 'test2'){
    echo 'test 2 is the best';
 } elseif ($testIfElse == 'hello'){
    echo 'hello world';
 } else {
    echo 'nothing is correct';
 }


//------------------------------------------
echo '<h2>Fonction Utilisateur</h2>';
//------------------------------------------

//----------
//EXERCICE: TVA
//----------
// Ecrivez une function appliqueTva2 qui calcule un nombre multiplié par un taux donnés lors de l'appel de la function.
function appliqueTva2($price, $taux){
    return $price * $taux;
}
echo 'TVA de 10€ est : ' . appliqueTva2(10, 1.2) . '<br>';

//------------------
//EXERCICE: saison
//------------------
// au sein d'une nouvelle function, exoMeteo, afficher l'article "au" ou "en" selon la saison (en été, en hiver, en automen, au printemps)

function exoMeteo($saison){
    if ($saison == 'printemps'){
        $auEn = 'au';
    }else {
        $auEn = 'en';
    }
    echo "Nous sommes $auEn $saison <br>";
}
exoMeteo('hiver');

//------------------
//EXERCICE: loop while
//------------------
//à l'aide d'une boucle while, afficher dans un sélecteur les années de 1918 à 2018
$années = 1918;
echo "<select>";
while($années < 2018){
    echo "<option> $années </option>";
    $années++;
}
echo "</select>";

$years = 2018;
echo "<select>";
while($years > 1918){
    echo "<option> $years </option>";
    $years--;
}
echo "</select>";

$years1 = 1950;
echo "<select>";
while($years1 < 2050){
    echo "<option> $years1 </option>";
    $years1++;
}
echo "</select>";

$years2 = 2018;
echo "<select>";
while($years2 < 3000){
    echo "<option> $years2 </option>";
    $years2++;
}
echo "</select>";


















