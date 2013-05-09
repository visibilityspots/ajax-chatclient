<?php
// Haal de parameters op uit de url
$inputName = $_GET["name"];
$inputPass = $_GET["pass"];
// Initialiseer de terug te sturen parameter
$response = "";

// Initialiseer de xml gegevens
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/users.xml' );

$users = $xmlDoc->getElementsByTagName("user");

// Lus welke alle gebruikers uit xml doc doorloopt
foreach($users as $user) {
	// Haal de naam op van de gebruiker
	$name = $user->getElementsByTagName("name");
  	$name = $name->item(0)->nodeValue;
  		
  	// Controleer of de namen overeenkomen
  	if ($inputName == $name){
  		// Haal het wachtwoord van de gebruiker op
  		$pass = $user->getElementsByTagName("pass");
		$pass = $pass->item(0)->nodeValue;
  		
		// Controleer of de passwoorden overeenkomen
		if ($inputPass == $pass) {
  			// Haal de status van de gebruiker op
			$states = $user->getElementsByTagName("state");
			$state = $states->item(0)->nodeValue;
			
			// Wanneer de status offline is, verander hem naar online in xml doc		
			if ($state == "offline") {
				$states->item(0)->nodeValue = "online"; 
				$xmlDoc->save('../xml/users.xml'); 
			}
			$states = $user->getElementsByTagName("state");
			$status = $states->item(0)->nodeValue;
			
			// Haal de id van de gebruiker op
			$id = $user->getElementsByTagName("id")->item(0)->nodeValue;
  		} else {
  			// Wanneer het passwoord niet overeenkomt stuur terug wrong pass
  			$response = "wrong pass";
  		}
  		// Wanneer zowel het passwoord als de gebruikersnaam overeenkomen, stuur terug het id van de gebruiker
  		$response = $id;	
  	}
}
// Stuur de gegevens door naar de client
echo $response.";".$status;
?>