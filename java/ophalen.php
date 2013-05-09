<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");

// Initialiseer variabelen
$userId = $_GET["id"];
$buddieIdArray = array();
$buddieIdArray [] = $userId;
$alleIdArray = array();
$bufferIdArray = array();

// Initialiseer de xml gegevens van het in te laden xml document
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/users.xml' );
$users = $xmlDoc->getElementsByTagName("user");

// Initialiseer de xml gegevens van het door te geven xml bestand
$doc = new DomDocument('1.0', 'UTF-8');
$r = $doc->createElement( "gebruikers" );
$doc->appendChild( $r );

// Doorloop alle gebruikers uit xml document
foreach($users as $user) {
	// Haal de id van de gebruiker op
	$idList = $user->getElementsByTagName("id");
  	$id = $idList->item(0)->nodeValue;
  	$alleIdArray [] = $id;
  	
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

//Doorloop de gebruikers uit xml doc nogmaals
foreach($users as $user2){
	// Haal het id op van de gebruiker
	$idList2 = $user2->getElementsByTagName("id");
	$id2 = $idList2->item(0)->nodeValue;
  				
	// Haal dan de naam op
  	$names = $user2->getElementsByTagName("name");
  	$name = $names->item(0)->nodeValue;
			  					
  	// stop buddie adhv xml DOM in xml string ($doc)
  	$b = $doc->createElement( "gebruiker" );
				  			
  	$idXML = $doc->createElement( "id" );
  	$idXML->appendChild($doc->createTextNode( $id2 ));
  	$b->appendChild( $idXML );
	
  	$checkedXML = $doc->createElement( "checked" );
	$checkedXML->appendChild($doc->createTextNode( "unchecked" ));
	  	
  	foreach($buddieIdArray as $buddieId){
  		if($buddieId==$id2){
  			$checkedXML = $doc->createElement( "checked" );
			$checkedXML->appendChild($doc->createTextNode( "checked" ));
  		}
  	}
  	
  	$b->appendChild( $checkedXML );
				  			
	$nameXML = $doc->createElement( "name" );
	$nameXML->appendChild($doc->createTextNode( $name ));
	$b->appendChild( $nameXML );
				
	$r->appendChild( $b );
}

// Converteer de XML tree naar string
$doc = $doc->saveXML();

// Stuur xml string door naar client
//echo $doc;
echo $doc;
?>