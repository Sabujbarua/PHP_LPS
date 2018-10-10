<?php
/*
  1- Créer une fonction qui retourne la conversion d'une date FR en date US ou inversement.
  Cette fonction prend 2 paramètres : une date et le format de conversion de sortie "US" ou "FR". Pour faire cette conversion, vous utilisez la classe DateTime.
	  
  2- Vous validez que le paramètre de format est bien "US" ou "FR". La fonction retourne un message si ce n'est pas le cas.
  
  3- Vous validez que la date fournie est bien une date. La fonction retourne un message si ce n'est pas le cas.
  
*/

// 1- Créer une fonction______Cette fonction prend 2 paramètres $date et $format
function changeDateFormat($date, $format){ 
  //  3- Vous validez que la date fournie est bien une date. La fonction retourne un message si ce n'est pas le cas.
  if(!strtotime($date)){
    return '....ce n\'est pas le cas.';    
  } 
  
  // 2- Vous validez que le paramètre de format est bien "US" ou "FR".
  if($format == 'FR'){
    // format de date US ou FR
    $objDate = new DateTime($date);
    return date_format($objDate, 'd-m-Y'). '<br>';
    
  } elseif($format == 'US'){
    // format de date US ou FR
    $objDate = new DateTime($date);
    return date_format($objDate, 'Y-m-d');
    
  } else {
    // La fonction retourne un message si ce n'est pas le cas.
    return 'ce n\'est pas le cas';
  }

}
echo changeDateFormat('2018/10/08', 'US') . '<br>';



// _______________________________________________
// __________________Correction___________________
// _______________________________________________
function afficheDate($date, $format){
  if(!strtotime($date)){
      return 'la date est invalide !';    // return nous fait quitter la function, le reste de code qui suit n'est donc pas exécute.
  }

// on controle d'abord les valeurs reçues :
if($format != 'FR' && $format != 'US'){
  return '<p> Le format demandé n\'est pas valide !</p>';
}

// traitement de i'affichage de la date :
  $objetDate = new DateTime($date);
  if($format == 'FR'){
    return $objetDate->format('d-m-Y');
  } elseif ($format == 'US') {
    return $objetDate->format('Y-m-d');
  }
}
echo afficheDate('10/02/2018', 'FR');

