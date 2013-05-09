<?php
header('Content-Type: text/xml');
header("Cache-Control: no-cache, must-revalidate");

// Haal de parameter op uit de url
$userId = $_GET["idSen"];

// Initialiseer de xml gegevens van het in te laden xml document
$xmlDocUsers = new DOMDocument();
$xmlDocUsers->load( '../xml/users.xml' );
$users = $xmlDocUsers->getElementsByTagName("user");

// Initialiseer de xml gegevens van het in te laden xml document
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/berichten.xml' );
$berichten = $xmlDoc->getElementsByTagName("bericht");

// Initialiseer de xml gegevens van het door te geven xml bestand
$doc = new DomDocument('1.0', 'UTF-8');
$r = $doc->createElement( "messages" );
$doc->appendChild( $r );

// Doorloop alle berichten uit xml document
foreach($berichten as $bericht) {
	// Haal de id van de ontvanger van het bericht op
	$idList = $bericht->getElementsByTagName("idOntvanger");
  	$id = $idList->item(0)->nodeValue;
  	
  	// Boodschap van het bericht ophalen
	$boodschappen = $bericht->getElementsByTagName("boodschap");
	$boodschap = $boodschappen->item(0)->nodeValue;
	
  	// Check of id van bericht overeenkomt met id van de gebruiker
	if ($userId == $id) {
		// Wanneer dit zo is, haal het bericht op en voeg het toe aan de xml string ($doc)
		// Tijdstip van het bericht ophalen
		$tijdstippen = $bericht->getElementsByTagName("tijdstip");
		$tijdstip = $tijdstippen->item(0)->nodeValue;
				
		// Verzender van het bericht ophalen
		$senderIds = $bericht->getElementsByTagName("idVerzender");
		$senderId = $senderIds->item(0)->nodeValue;

		// Doorloop alle gebruikers uit xml document
		foreach($users as $user) {
			// Haal de id van de gebruiker op
			$idUsers = $user->getElementsByTagName("id");
		  	$idUser = $idUsers->item(0)->nodeValue;
		  	
		  	// Check of id van gebruiker overeenkomt met doorgegeven parameter
			if ($senderId == $idUser) {
				// Wanneer dit zo is, haal de naam op
				$nameUser = $user->getElementsByTagName("name");
				$name = $nameUser->item(0)->nodeValue;
			}
		}
		
		// Maak een xml element bericht
		$b = $doc->createElement( "bericht" );
  			
		// Maak een xml element tijdstip dat aan $b hangt
  		$tijdstipXML = $doc->createElement( "tijdstip" );
  		$tijdstipXML->appendChild($doc->createTextNode( $tijdstip ));
  		$b->appendChild( $tijdstipXML );
  		
  		// Maak een xml element van dat aan $b hangt
  		$senderXML = $doc->createElement( "van" );
  		$senderXML->appendChild($doc->createTextNode( $name ));
  		$b->appendChild( $senderXML );
  		
  		// Maak een xml element boodschap dat aan $b hangt
  		$boodschapXML = $doc->createElement( "boodschap" );
  		$boodschapXML->appendChild($doc->createTextNode( $boodschap ));
  		$b->appendChild( $boodschapXML );
		
  		// Voeg het bericht $b aan de xml lijst toe
		$r->appendChild( $b );
  	} else {
  		
  	}
}
// Initialiseer tijdstip
$date = date("d-m-Y H:i:s");
$lastUpdateXML = $doc->createElement( "lastupdate" );
$lastUpdateXML->appendChild($doc->createTextNode( $date ));
$r->appendChild( $lastUpdateXML );

// Converteer de XML tree naar string
$doc = $doc->saveXML();

// Stuur xml string door naar client
echo $doc;
?>