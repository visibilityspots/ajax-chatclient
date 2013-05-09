<?php
$message = $_GET["message"];
$senderId = $_GET["idSen"];
$recipientId = $_GET["idRec"];

// Initialiseer de huidige tijd
$date = date("d-m-Y H:i:s");

// Initialiseer de xml gegevens van het in te laden xml document
$xmlDoc = new DOMDocument();
$xmlDoc->load( '../xml/users.xml' );
$users = $xmlDoc->getElementsByTagName("user");

// Initialiseer de xml gegevens van het op te slaan xml bestand
$doc = new DomDocument();
$doc->load('../xml/berichten.xml');
$r = $doc->getElementsByTagName( "berichten" )->item(0);

// Stop bericht adhv xml DOM in xml string ($doc)
$b = $doc->createElement( "bericht" );
  			
$idXML = $doc->createElement( "tijdstip" );
$idXML->appendChild($doc->createTextNode( $date ));
$b->appendChild( $idXML );

$senderIdXML = $doc->createElement( "idVerzender" );
$senderIdXML->appendChild($doc->createTextNode( $senderId ));
$b->appendChild( $senderIdXML );

$idRecXML = $doc->createElement( "idOntvanger" );
$idRecXML->appendChild($doc->createTextNode( $recipientId ));
$b->appendChild( $idRecXML );

$berichtXML = $doc->createElement( "boodschap" );
$berichtXML->appendChild($doc->createTextNode( $message ));
$b->appendChild( $berichtXML );

$r->appendChild( $b );

$doc->save('../xml/berichten.xml'); 
echo "Done";
?>