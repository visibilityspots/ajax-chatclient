<?php 
	// Sessiebuffer clearen;
	ob_start();
	// Sessie starten;
	session_start();
	session_register('title');

	$titel = strtolower($_GET['title']);
	if ($titel == ""){$titel = "home"; }
	
	$head = "Interactive chatclient";
	
	include("layers/head.php");
	include("layers/topmenu.php");
	include ("content/$titel.php");
	include("layers/footer.php")
?>