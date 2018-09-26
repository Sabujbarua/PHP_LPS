<style>
h2{ color: orange; background: #232323; text-align: center;}
</style>

<?php
//------------
echo '<h2>Hello PHP</h2>';
//------------
?>

<?php
//pour puvrir un passage en PHP, on utilise la balise précédente
// pour fermer un passage en PHP, on utilise la balise suivant:
?>
<p>Bonjour</p> 
<!-- en dehors des balises d'ouverture et fermeture de PHP, nous pouvons écrire de HTML quqnd on est dans un fichier ayant l'extention .php-->
<?php
// ce n'ai pas obligé de fermer un passage en PHP en fin de script

echo '<h2>affichage</h2> <br>';
//------------------------

echo 'Bonjour <br>'; // echo est une instraction qui permet d'afficher dans le navigateur. toutes les instraction se terminent par un ";" dans un echo, nous pouvons mettre aussi de HTML.

print 'Nous sommes mardi <br>'; // print est une autre instraction d'affichage. pas (ou peu) de different avec ECHO;

//Autres instruction d'affichage que nous verrons plus loin :
//print_r();
//var_dump();

// pour faire un commenter sur une seule ligne

/*
pour faire un commenter sur une plusieurs lignes
*/

# autre syntaxe de commenter sur une seule ligne

//------------------------------------
echo '<h2>Variable : déclaration / affectation / type</h2>';
//------------------------------------
// Définition : une variable est un espace mémoire qui porte un nom et permrttant de conserver une valeur.
//Ee PHP on déclare une variable avec le signe $.

$a = 127; // affectation de la valeur 127 à la variable $a
echo gettype($a); // gettype() est une function prédéfinie qui indique le type d'une variable. Ici i'agit d'un integer (entier)
echo '<br>';

$a = 'une chaîne de caractères';
echo gettype($a); // affiche string

echo '<br>';

$b = '127';
echo gettype($b); // affiche string car un nombre écrit entre quotes est interprété comme un string.
echo '<br>';

$a = true; // ou false
echo gettype($a); // affiche boolean

// par convention, un nom de variable commence par une lettre minuscule, puis on met une majuscule à ahaque mot. il peut contenir des chiffres (jamais au debut), ou un "_"(jamais au début car signipication particular en object, ni à la fin).

//-------------------------------
echo '<h2>concaténation</h2>';
//-------------------------------

$x = 'Bonjour ';
$y = 'tout le monde';
echo $x . $y . '<br>'; // le point de concaténation peut être traduit par 'suivi de'

// Remarque sur echo :
echo $x, $y, '<br>'; // Dans l'instraction echo on peut séparer les éléments à afficher par une virgul. cette syntaxe est spécifique eu echo, et ne marche pas avec print.

//------------------
// Concaténation lore de l'affectation :

$prenom1 = 'Bruno';
$prenom1 = 'Claire';
echo $prenom1 . '<br>'; // affiche Claire

$prenom2 = 'Nicolas ';
$prenom2 .= 'Marie';
echo $prenom2 . '<br>'; // affiche "Nicolas Marie" grâce à l'opérateur combiné ".=", la valeur "Mari" vient se concaténer à la valeur "Nicolas" sans la remplacer.

//----------------
echo '<h2>Guillement et quotes</h2>';
//-------------------------------------

$message = "aujord'hui"; // ou bien
$message = 'aujord\'hui'; // on échappe les apostrophes dans les qutes simples avec "\"

$txt ='Bonjour';
echo "$txt tout le monde <br>"; // dans les guillements, la variable est évaluée : c'est son  contenu qui est affiché, ici "Bonjour"
echo '$txt tout le monde <br>'; // dans des quotes simple, la variable n'est pas évaluée, elle est traitée comme de texte brute. affiche '$txt'

// ----------------------------
echo '<h2>Constante et Constante magique</h2>';
// -----------------------------

// Une constante permet de conserver une valeur sauf que celle ci ne peut pas être modifié durant l'exécution  du ou des script. Utile pour, par exemple, conserver les parametre de connexion à la BDD sans pouvoir le modifiés une fois définis.

define('CAPITALE', 'Paris'); // on déclare une constante avec la function prédéfinie definr() qui s'appelle CAPITALE et prend pour valeur "paris" . par convention les constantes sont toujours écrites en majuscules.
echo CAPITALE . '<br>'; // affiche Paris

// Deux constantes magique :
echo __DIR__ . '<br>'; // affiche le chemin complet vers le dossier de notre fichier
echo __FILE__ . '<br>'; // affiche le chemin complet vers le fichier (dossier + nom du fichier)


//-----------------------
// exerice
//-----------------------

// vious affichez bleu-blanc-rouge (avec les tirets) en mettant le texte de chaque coulour dans des variable.
echo '<br>';
$a = 'Blue-';
$b = 'Blanc-';
$c = 'Rouge';
echo $a . $b . $c . '<br>';
echo $a . '-' . $b . '-' . $c . '<br>';
echo "$a-$b-$c";


//-----------------------------
echo '<h2>Opérateurs Arithmétique</h2>';
//-----------------------------

$a = 10;
$b = 2;

echo 'a + b = ' . ($a + $b) . '<br>'; // 12
echo 'a - b = ' . ($a - $b) . '<br>'; // 8
echo 'a * b = ' . ($a * $b) . '<br>'; // 20
echo 'a / b = ' . ($a / $b) . '<br>'; // 5
echo 'a % b = ' . ($a % $b) . '<br>'; // 0   modulo = rest de la division entière. emample 3%2 = 1

echo '<br>';
//--------------------------------------------------------------------------------------------------

// Opération et affectation combinées :
$a = 10;
$b = 2;

$a += $b; // équivaut à $a = $a + $b, $a vaut donc au final 12
$a -= $b; // équivaut à $a = $a + $b, $a vaut donc au final 10
$a *= $b; // équivaut à $a = $a + $b, $a vaut donc au final 20
$a /= $b; // équivaut à $a = $a + $b, $a vaut donc au final 10
$a %= $b; // équivaut à $a = $a + $b, $a vaut donc au final 0

// Exemple d'utilisation : pratique pour faire des calculs de quantités dant les paniers d'achat (+= et -=)


//---------------------------------------------
// Incrémenter et décrementer :
$i = 0;
$i++; // on ajoute 1 à $i qui vaut au final 1
$i--; // on retire 1 à $ qui vaut au final 0

$i = 0;
$k = ++$i; // la variable $i est Incrémenter de 1, puis elle est retournée : on affecte donc 1 à $k
echo '$i vaut ' . $i . '<br>';
echo '$k vaut ' . $k . '<br>';

$i = 0;
$k = $i++; // la variable $i est d'abord retournée, puis elle est Incrémenter de 1
echo '$i vaut ' . $i . '<br>'; // 1
echo '$i vaut ' . $k . '<br>'; // 0


//--------------------------------------------------------------
echo '<h2>Structures conditionnelles - Opération de comparaison</h2>';
//--------------------------------------------------------------
$a = 10;
$b = 5;
$c = 2;
//------
// if.....eles :

if($a > $b) { // si la condition est évaluée à TRUE, on exécute les accolades qui suivent :
    echo '$a est supérieur à $b <br>';
}else{ // sinon... si la condition est évaluée à false, on exécute le eles
    echo 'Non, c\'est $b qui est supérieur ou égal à <br>';
}


//------------
// l'opérateur AND écrit && :
if($a > $b && $b > $c){ // si $a est supérieur à $b ET que dans le méme temps $b est supérieur à $c, alors on entre dans les accolades :
    echo 'OK pour les 2 condition <br>';
}

//-----------
// l'opérateur OR écrit || :
if($a == 9 || $b > $c) {
    echo 'OK pour au mois une des 2 condition <br>';
}


//-------------------------
// if ... elseif ... else :
$a = 10;
$b = 5;
$c = 2;

if($a == 8) {
    echo '$a est égal à 8 <br>';
} elseif($a != 10) {
    echo '$a est différent de 10 <br>';
} else {
    echo 'les 2 conditation précédentes sont fausses <br>';
}
// Note : on ne fait jamais suivre eles par une condition (sinon utiliser un elseif). On ne met pas de ";" à la fin d'une condition car il s'agit d'une structure.


//---------------
// l'opérateur XOR :
$question1 ='mineur';
$question2 ='je vote'; // exemple d'un questionnaire statistique

if ($question1 == 'mineur' XOR $question2 == 'je vote') { // si seulement une des deux conditions doit être vrai (soit l'une ou soit l'autre). Si les  2 conditions sont vraies alors l'expression complete est fausse : c'est le cas ici, on entre donc dans le else.
    echo 'Vos réponses sont coérentes <br>';
} else {
    echo 'Vos réponses ne sont coérentes <br>';
}

//-------------------
// Forme contractée de la condition, dite ternaire :
echo ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>'; // dans la ternaire, le "?" remplace if, et le ":" remplace else. Ici, si $a égale 10, ja fais echo de 1er string, sinon de second

// ou encore :
$resultat = ($a == 10) ? '$a est égal à 10 <br>' : '$a est différent de 10 <br>';
echo $resultat;


//----------------------
// comparaison en == et en ===
$varA = 1; // integer
$varB = '1'; // string

if ($varA == $varB) echo '$varA est égale à $varB en valeur uniquement <br>';

if ($varA === $varB) {
    echo '$varA est égale à $varB en valeur ET en type <br>';
} else {
    echo '$varA est différent de $varB en valeur ou en type <br>';
}

/*
    =   signe d'affectation
    ==  sign de comparaison en valeur
    === sign de comparaison en valeur et en type
*/

//----------------------
// isset() et enpty() :
// Définition : 
// isset() teste si c'est défini (si exist) et a une valeur non NULL
// enpty() teste si c'est vide, c'est-à-dire 0, string vide '', NULL, false ou non défini
$var1 = 0;
$var2 = '';
if(empty($var1)) echo '0, vide, NULL, false ou non défini <br>'; // ici la condition est vraie car $var1 est vide au sens de empty (voir la définition ci-dessus)
if(isset($var2)) echo 'existe et nom NULL <br>'; // la condition est vraie car $var2 existe bien (et est non NULL)
// si on ne déclare pas le variable $var1  et $var2 ligne 259 et 260, la condition avec empty reste vraie (car non définie), mais la condition avec osset devient fausse(car la variable ne serait pas définie)

// exemple d'utilisation : empty() pour vérifier qu'un champ de formulaire est vide. isset() pour vérifier qu'une variable existe bien avant de l'utiliser.


//---------------------------------
// l'opérateur NOT écrit "!"
$var3 ='une chîne de caractères';
if(!empty($var3)) echo '$var3 n\'est pas vide<br>'; // ! pour NOT. il s'agit d'une négation qui transforme false en true et inversement (!false vaut et !true vaut false). Littéralement on teste ici si $var3 N'est pas vide.

//-----------------------------------
// phpinfo();       // pour vérifier la version de PHP sur notre serveur local

// PHP7 : entrer une valeur dans une variable si elle existe :
$varAutre = "W3 !";
$var1 = $variableInconnue  ?? $varAutre ?? 'valeur par défaut'; // l'opérateur "??" indique qu'il faut prendre la première variable ou valeur qui existe : $variableInconnue n'existant pas, on passe à $varAutre qui n'existe pas non plus, donc on prend la 'valeur par défaut pour l'affecter à $var1
echo $var1;

// Utilisation : pour pré-rémplir les values des formulaires quand l'internaite aura saisie et envoyé des valeurs.


//-----------------------------
echo '<h2>Condition switch </h2>';
//-----------------------------
// La condition switch est une autre syntaxe du if / elseif / else quand on veut comparer une variable à une multitude de valeurs.

$couleur = 'jaune';
switch($couleur){
    case 'bleu' : // on compare $couleur à la valeur des "case" et exécute le code qui suit les ":" si elle correspond
        echo 'Vous aiimez le bleu <br>';
    break; // break est obligatoire pour quitter la condition une fois le case exécuté

    case 'rouge' :
        echo 'Vous aiimez le rouge <br>';
    break;

    case 'vert' :
        echo 'Vous aiimez le vert <br>';
    break;
    
    default: // cas par défaut si on n'entre pas dans les cases précédents (équivalent de ELSE)
        echo 'vous n\'aimez aucune de ces couleurs <br>';
    break;
}


//------------------------
// Exercice : réécrire le switch précédent en condition if ... classiques. on doit obtenir le même résultat.
//------------------------

$couleur = 'jaune';

if($couleur == 'bleu'){
    echo 'i like blue';
} elseif ($couleur == 'rouge'){
    echo 'i like red';
}elseif ($couleur == 'vert'){
    echo 'i like green';
}else{
    echo 'vous n\'aimez aucune de ces couleurs <br>';
}


//---------------------------
echo '<h2>Quelques function prédéfinies</h2>';
//---------------------------

// une fonction prédéfinie permet de réaliser un traitement spécifique prédéterminé dans le langage PHP.

//------
// strpos : 

$email1 = 'prenom@site.fr';
echo strpos($email1, '@'); // affiche la position 6 de l'@ en comptant à partir de 0
echo '<br>';

$email2 = 'Bonjour';
echo strpos($email2, '@'); // cette ligne n'affiche rien, pourtantla fonction retourne bien quelque chose : false
var_dump(strpos($email2, '@')); // grâce au var_dump, on peut apercevoir ce que retourne cette
echo '<br>';

// --------------
//  strlen :
$phrase = 'mettez une phrase ici à cet endroit';
echo strlen($phrase); //strlen retourne la taille d'une chaine (nombre d'octets de cette chaîne, une caractère accentué valant 2 octets).
echo '<br>';

//-------------
// substr :
$texte = 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa sit obcaecati optio hic id sint quaerat tenetur reprehenderit odio velit voluptatum neque, eligendi odit, minus, quia veniam. Cumque, illum quasi!';

echo substr($texte, 0, 20) . '... <a href=""> lire la suite </a>'; //substr retourne une partie du string de la position 0 et sur 20 caractères
echo '<br>';

//------------------
// trim :

$message = '     Hello World    ';

echo strlen($message) . '<br>'; // on compte la taille avec les espaces
echo strlen(trim($message)) . '<br>'; // on compte la taille une fois les espaces supprimés avec trim en début et fin de string

//-----------------
// die() et exit() :

// exit('un message'); // quitte le script après avoir affiché le message
// die('un message'); // fait la même chose : die() est un alias de exit


//-------------------------------------------
echo '<h2>Fonction Utilisateur</h2>';
//-------------------------------------------
// les functions sont des morceaux de codes encapsulés dans des accolades et portant un nom, qu'on appelle au besoin pour exécuter le code qui s'y trouve.

// Déclaration d'une function :
function separation(){ // Déclaration d'une function sans paramètre
    echo '<hr>';
}
// appel de la function :
separation(); // on appelle une function en écrivant so nom suivi d'une paire de ()

// function avec paramètres et return :
function bonjour($qui){ // ($qui ce un paramètre) $qui appraît ici pour la première fois : il permet de recevoir un argument. il s'agit d'une variable de réception. notez que l'on peut mettre plueeurs paramètres dans les parentèses séparés par une virgule
    return 'Bonjour' . $qui . '<br>'; // return renvoie le string qui le suit à l'endroit où est appelée la function
    echo 'cette ligne ne sera pas exécutée car après un return';
}
echo bonjour('Sabuj'); // ("sabuj" ce un argument) si une function attend un argument, il faul lui envoyer.


//-----------------------
// Exercice :

function appliqueTva ($nombre){
    return $nombre * 1.2;
}
// Ecrivez une function appliqueTva2 qui cqlcule un nombre multiplié par un taux donnés lors de l'appel de la function.

function appliqueTva2($nombre, $taux){ // on peut initialiser par défaut un paramètre dans le cas ou on ne recoit pas de valeur en argument lors de l'appel de la fonction. On a renommé notre fonction car on ne peut pas déclarer deuc fonction qui porte le même nom.
    return $nombre * $taux;
}
echo appliqueTva(10, 1.2) . '<br>';


//-----------------------
// Exercice :
function meteo($saison){
    echo "nous sommes en $saison. <br>";
}
meteo('automne');
meteo('printemps');

// au sein d'une nouvelle function, exoMeteo, afficher l'article "au" ou "en" selon la saison (en été, en hiver, en automen, au printemps)

function exoMeteo($saison){

    if($saison == 'été'){
        echo "Nous sommes en été <br>";
    } elseif ($saison == 'hiver') {
        echo "Nous sommes en hiver <br>";
    } elseif ($saison == 'automen'){
        echo "Nous sommes en automen <br>";
    } elseif ($saison == 'printemps'){
        echo "Nous sommes au printemps <br>";
    } else {
        echo 'error';
    }
    
}
exoMeteo('printemps');

//-------------------------
//  correction
//-------------------------
function exoMeteo2($saison) {
    if($saison === 'printemps'){
        $article = 'au';
    } else {
        $article = 'en';
    }
    echo "Nous sommes $article $saison <br>";
}
exoMeteo2('été');
exoMeteo2('printemps');

//---------------------------
// variables locales et variable globales :

// de l'espace local et global :
function joursemaine(){
    $jour = 'mardi'; // variable cocale à la function
    return $jour;
}
//echo $jour; // erreur car cette variable n'est connue qu'à l'intérieur de la functiion
echo joursemaine(); // on récupère ici la valeur "mardi" grâce au return qui se situe dans la function
 
echo '<br>';

// de l'espace global à l'espace local :
$pays = 'France'; // variable globale

function affichePays(){
    global $pays; // le mot cle "global" permet de récupérer une variable globele au sein de l'espace local de la function
    echo $pays; // affiche Freance
}
affichePays();


//-------------------------------------------------
echo '<h2>Structures itératives : les boucles</h2>';
//-------------------------------------------------
// les loop sont destinéees à répéter des lignes de codes de façon automatique.
// Boucle While :
$i = 0; // valeur de départ de la boucle
while($i <= 3){ // tant que $i est inférieur à 3 nous entrons dans la boucle
    echo "$i---"; // affiche 0---1---2---
    $i++; // on n'oublie pas d'incrémenter à chaque tour de boucle pour ne pas avoir une boucle infinie
}
// note: pas de ";" à la fin des Structures itératives
echo '<br><br>';


echo '<select>';
    echo '<option>1<option>';
    echo '<option>2<option>';
    echo '<option>...<option>';
echo '</select>';

echo '<br><br>';

//-------------------
//Exercice : à l'aide d'une boucle while, afficher dans un sélecteur les années de 1918 à2018
$i = 1918;
echo '<select>';
while ($i < 2018 ){
    echo "<option> $i </option>";
    $i++;
}
echo '</select>';

echo '<br><br>';

$i = 2018;
echo '<select>';
while ($i > 1918 ){
    echo "<option> $i </option>";
    $i--;
}
echo '</select>';

echo '<br><br>';
//----------------------------------
$date1 = date('Y-m-d');
// echo $date1;
echo '<select>';

while ($date1 <= date('Y-m-d')){

    echo "<option> $date1 </option>";

    $date1++;

}

echo '</select>';
//------------------------------------
echo '<br><br>';


// boucle do while :
// la loop do while a la particullaroté de s'exécuter au mois une fois (correspondant à "do"), puis tant que la conditation while est vraie.

$j = 1;

do{
    echo 'je fais un tour de loop <br>';
    $j++;
}while($j > 10); // la condition renvoie false ici, pourtant la boucle a bien tourné une fois. Attention au ";" après le while de cette loop

// Exemple d'utilisation : poser une question à l'internaute une première fois avec le "do", puis tant qu'il n'a pas repondu avec le "while".


// loop for :
// la loop "for" est une autre syntaxe de la boucle while.
for($i = 0; $i < 10; $i++){ // on trouve dans les parenthèses de for : valeur de départ; condition d'entrée dans la loop; variation de $i (incrémentation décrémentation ou autre chose)
    echo $i . '<br>'; //affiche 0 à9 en 10 tours
}
// Rappel : si on veut faire varier $i de 10 en 10, écrit $i += 10 à la place de $i++

// Exercice : afficher 12 <option> de 1 à 12 à l'aide d'une loop for.
echo '<select>';
for ($i = 1; $i <= 12; $i++){
    echo "<option>$i</option>";
}
echo '</select>';


//-----------------------
// Boucle foreach :
// Il existe aussi la loop foreach pour parcourir les array et les object. Nous la verrons dans un prochain chapitre.

//------------
// Exrcice : afficher avec une loop for les chiffres de 0 à 9 dans une table HTML

?> 

<!--************ -->
<table border="1">
    <tr>
        <td>0</td>
        <td>2</td>
        <td>...</td>
    </tr>
</table>
<!--************ -->

<!--************ -->
<table border="1">
    <tr>
        <?php
            for($i = 0; $i < 10; $i++){
            ?> <td> <?php echo $i; ?> </td>
           <?php } ?>
    </tr>
</table>
<!--************ -->

<!--************ -->
<?php
echo '<table border="1">';
    echo '<tr>';
        for($i = 0; $i < 10; $i++){
        echo "<td> $i </td>";
        }
    echo "</tr>";
echo "</table>";

// ************
echo '<br><br>';

echo '<table border="1">';
for($i = 0; $i < 10; $i++){
    echo '<tr>';
    for($j = 0; $j < 10; $j++){
        echo "<td style=\"background-color: red; color: white;\"> $j </td>";
    }
    echo "</tr>";

}
echo "</table>"; // nous avons ici le principe des loop imbriquée. quand le 1ere loop fait 1 tour, la loop intérieure en fait 10.

echo '<br><br>'; 

// 0 to 100 loop for
echo '<table border="1">';
$z = 0;
for($i = 0; $i < 10; $i++){
    echo '<tr>';
    for($j = 0; $j < 10; $j++){
        echo "<td> $z </td>";
        $z++;
    }
    echo "</tr>";
}
echo "</table>";


// --------------------------
echo '<h2>Les Tables ou Array</h2>';
// --------------------------
// un table ou array, est déclarée comme une variable améliorée dans laquelle on stocke une multitude de value. ces value peuvent être de n'importe quel type. Elle possèdent un dont la numérotation par défaut commence à 0.

// déclaration d'un array (méthode 1) :
$liste = array('grégoire', 'nathalie', 'émilie', 'françois', 'georges');
echo 'le type de $liste : ' . gettype($liste);

echo '<br><br>';

echo '<pre>';
var_dump($liste);  // affiche le contenu du tableau  plus certaines information comme le type
echo '</pre>'; // pre est une balise HTML qui permet de formater l'affichage du var_dump

echo '<br><br>';

echo '<pre>';
print_r($liste); // print_r est plus synthétique que var_dump, il n'affiche pas le type des éléments contenus dans l'array
echo '</pre>';
// echo $liste; // erreur de type "Array to string conversion" car on ne peut pas afficher directement un array avec un echo

// function d'affichage d'un print_r avec balises pre :
function debug($param){
    echo '<pre>';
        print_r($param);
    echo '</pre>';
}
debug('param');

// Autre méthode de déclaration d'un array :
$tab = ['France', 'Italie', 'Espagne', 'Portugal'];

$tab[] = 'Suisse'; // les [] vides permettent d'ajouter une value à la fin de notre array

debug($tab);

// Afficher "Italie" à partir de notre table $tab

echo $tab[1];

echo '<br><br>';

//-----------
// tableau associatife :
// un tableau associatif est un tableau dans lequel on choisit le dénomination des indices.

$couleur = array(
    'j' => 'Jeune',
    'b' => 'Bleu',
    'v' => 'Vert'
);
//pour accéder à un élément du tableau associatif
echo 'La seconde couleur de notre tableau est le ' . $couleur['b'] . '<br>';
echo "La seconde couleur de notre tableau est le $couleur[b]<br>"; // affiche bleu. un array écrit dans des guillemets ou des quotes perd les quotes autour de son indice

// Mesurer la taille d'un array : to see the longer of a table
echo 'Taille du tableau $couleur : ' . count($couleur) . '<br>';
echo 'Taille du tableau $couleur : ' . sizeof($couleur) . '<br>'; // count() et sizeof() font la même chose : ils comptent le nombre d'élement contenus dans l'array indiqué


//----------------------------------
echo '<h2>Boucle foreach</h2>';
//----------------------------------
// la loop foreach est un moyen simple de passer en revue un tableau ou un objet. elle retourne une erreur si vous tentez de l'utiliser sur autre chose.

debug($tab);

foreach($tab as $valeur){ // le mot clé fait partie de la structure syntaxique de la foreach : il est obligatoire. $valeur vient parcourir la colonne des value  de l'array. notez qu'on peut l'appeler comme on veut : c'est sa place apres "as" qui détermine qu'ell paecourt le valeurs.
echo $valeur . '<br>'; //on affiche successivement les elements du tableau a chaque tour de boucle et s'arréte a la fin du tableau
}

echo '<br><br>';

foreach($tab as $indice => $valeur){ // quand il y a 2 variable après "as", la première parcourt la colonne des indices (quelque soit son nom), et la seconde parcourt la colonne des valeurs (quelque soit son nom)
    echo $indice . ' correspond à ' . $valeur . '<br>';
}

// Exercice : écrivez un array associatif avec les indices prenom, nom, et telephone, et mettez y des information pour un seule personne. puis avec loop foreach, affichez les valeurs dans des <p>, sauf pour le prenom qui doit être dans un <h3>.

$table = array(
    'prenom' => 'Sabuj',
    'nom' => 'BARUA',
    'tel' => '0123456789'
);
//$table is the table------$user is index(prenom, nom, tel)------$users is the value(sabuj, barua, 0123456)
foreach($table as $user => $users){
    // echo $table;
    // echo $user;
    // echo $users;

    if($user == 'prenom'){
        echo "<h3> $users </h3>";
    } else {
        echo "<p>$users</p>";
    }
}















