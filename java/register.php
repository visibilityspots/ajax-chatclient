<?php
// Parameters uit url ophalen
$name = $_GET["name"];
$pass = $_GET["pass"];

// Initialiseer de xml gegevens van het in te laden xml document
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/users.xml' );
$users = $xmlDoc->getElementsByTagName("user");
$r = $xmlDoc->getElementsByTagName( "users" )->item(0);

// Doorloop alle gebruikers uit xml document
foreach($users as $user) {
	// Haal de id van de gebruiker op
	$idUsers = $user->getElementsByTagName("id");
	$id = $idUsers->item(0)->nodeValue;
}

$id = $id+1;
		
// Stop bericht adhv xml DOM in xml string ($doc)
$b = $xmlDoc->createElement( "user" );

$idXML = $xmlDoc->createElement( "id" );
$idXML->appendChild($xmlDoc->createTextNode( $id ));
$b->appendChild( $idXML );

$nameXML = $xmlDoc->createElement( "name" );
$nameXML->appendChild($xmlDoc->createTextNode( $name ));
$b->appendChild( $nameXML );

$passXML = $xmlDoc->createElement( "pass" );
$passXML->appendChild($xmlDoc->createTextNode( $pass ));
$b->appendChild( $passXML );

$stateXML = $xmlDoc->createElement( "state" );
$stateXML->appendChild($xmlDoc->createTextNode( "Offline" ));
$b->appendChild( $stateXML );

$buddiesXML = $xmlDoc->createElement( "buddies" );
$buddiesXML->appendChild($xmlDoc->createTextNode( "" ));
$b->appendChild( $buddiesXML );

$r->appendChild( $b );

$xmlDoc->save('../xml/users.xml'); 
echo "Done";
?>