<?php
/* 
	1- Vous réalisez un formulaire "Votre devis de travaux" qui permet de saisir le montant des travaux de votre maison en HT et de choisir la date de construction de votre maison (bouton radio) : "plus de 5 ans" ou "5 ans ou moins". Ce formulaire permettra de calculer le montant TTC de vos travaux selon la période de construction de votre maison.

	2- Vous créez une fonction montantTTC qui calcule le montant TTC à partir du montant HT donné par l'internaute et selon la période de construction : le taux de TVA est de 10% pour plus de 5 ans, et de 20% pour 5 ans ou moins. La fonction retourne  "Le montant de vos travaux est de X euros TTC." où X est le montant TTC calculé. Vous affichez le résultat au-dessus du formulaire.

*/

// // function tax($)

// $display = '';

// function tax($montant, $ann){
// // $montant = '';
// // $ann ='';

// if($ann == 'plus'){

// }


// return ($montant * $ann);

// }


function montantTTC($montant, $ann){
	// echo $montant . $ann; // for test

	if($ann == 'plus'){
		$montantTTC = $montant * 1.2;
	}else{
		$montantTTC = $montant * 1.1;
	}

	return "le montant de vos travaux  $montantTTC € TTC";
}






if($_POST){
	// print_r($_POST);
	$tax = montantTTC($_POST['montant'], $_POST['ann']);
}

?>








<form method="post" action="">
	<label for="montant">Montant Travaux</label> <br>
	<input type="text" name="montant" id="montant" value=""> <br> <br>

	<label for="">Anne</label> <br>
	<input type="radio" name="ann" value="plus" checked> plus de 5 ans <br>
	<input type="radio" name="ann" value="moins" > 5 ans ou moins <br> <br>

	<input type="submit" name="submit"> <br>
<?php echo $tax; ?>
</form>