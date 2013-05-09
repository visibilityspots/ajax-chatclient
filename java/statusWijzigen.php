<?php
// Haal de parameters op uit de url
$id = $_GET["id"];
$newState = $_GET["status"];

$response = false;

// Initialiseer de xml gegevens
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/users.xml' );

$users = $xmlDoc->getElementsByTagName("user");

// Lus welke alle gebruikers uit xml doc doorloopt
foreach($users as $user) {
	// Haal de naam op van de gebruiker
	$idList = $user->getElementsByTagName("id");
  	$idUser = $idList->item(0)->nodeValue;
  		
  	// Controleer of de namen overeenkomen
  	if ($id == $idUser){
		// Haal de status van de gebruiker op
		$states = $user->getElementsByTagName("state");
		$state = $states->item(0)->nodeValue;
			
		// Verander status		
		$states->item(0)->nodeValue = $newState; 
		$xmlDoc->save('../xml/users.xml');
		
		$response = $states->item(0)->nodeValue;
  	}
 }

// Stuur de gegevens door naar de client
echo $response;
?>