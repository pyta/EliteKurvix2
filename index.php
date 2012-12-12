<?php

session_start();

include('classes.php');

// Określenie czy użytkownik jest zalogowany (1), próbuje się zalogować (3), jest niezalogowany (2), czy próbuje się wylogować (4)
/*$Log = 2;
if(isset($_SESSION['UserID'])) 	$Log = 1;
if(isset($_GET['nick'])) 		$Log = 3;
if(isset($_GET['wylog']))		$Log = 4;

if(isset($_GET['page']))
	$MainSite = new MainSite($_GET['page'], $Log, true);
else
	$MainSite = new MainSite("index", $Log, false);

echo $MainSite->CreateContent();*/

// Create main page
$mainPage = new MainPage();
echo $mainPage->CreateCode();

?>