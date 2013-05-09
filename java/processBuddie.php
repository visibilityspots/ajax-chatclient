<?php
// Haal de parameters op uit de url
$userId = $_GET["id"];
$idBuddie = $_GET["idBud"];
$value = $_GET["value"];

// Initialiseer variabelen
$buddieIdArray = array();
$newBuddieString = "";

// Initialiseer de xml gegevens van het in te laden xml document
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/users.xml' );
$users = $xmlDoc->getElementsByTagName("user");

// Doorloop alle gebruikers uit xml document
foreach($users as $user) {
	// Haal de id van de gebruiker op
	$idList = $user->getElementsByTagName("id");
  	$id = $idList->item(0)->nodeValue;
  	
  	// Check of id van gebruiker overeenkomt met doorgegeven parameter
	if ($userId == $id) {
		// Wanneer dit zo is, haal zijn buddies op
		$buddies = $user->getElementsByTagName("buddies");
		$buddieIdList = $buddies->item(0)->nodeValue;
		
		// Stop de buddies in een arraylist (zonder ;)
		$tok = strtok($buddieIdList, ";");
		while ($tok !== false) {
			$buddieIdArray [] = $tok;
			$tok = strtok(";");
		}
	}
}
		
// Doorloop de arraylist met buddies (adhv id)
$length = sizeof($buddieIdArray);
if ($value == "false"){
	for($i=0;$i<$length;$i++){
		if($buddieIdArray[$i] == $idBuddie){
			array_splice($buddieIdArray, $i);
 		} 
 	}
} else {
	$newBuddieString = $newBuddieString.";".$idBuddie;	
}

foreach($buddieIdArray as $buddieId) {
	$newBuddieString = $newBuddieString.";".$buddieId;
}

$buddies->item(0)->nodeValue = $newBuddieString; 
$xmlDoc->save('../xml/users.xml');

// Stuur xml string door naar client
echo $newBuddieString;
?>