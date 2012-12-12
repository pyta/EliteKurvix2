<?php

include('classes.php');
include('function.php');

// sprawdzanie podstron
if(isset($_GET['page']))
{
	$page = $_GET['page'];
	switch($page)
	{
		case "home":
			$page = new HomeSubPage();
			echo $page->CreateContent();
		break;
		case "news":
			if(isset($_GET['newsID']))
				$page = new NewsSubPage($_GET['newsID']);
			else
				$page = new NewsSubPage('');
			echo $page->CreateContent();
		break;
		default:
			echo "Nie ma takiej strony!";
		break;
	}
}
// sprawdzanie okien modalnych
if(isset($_GET['div']))
{
	$div = $_GET['div'];
	switch($div)
	{
		case "newAccount":
			echo CreateNewAccountForm();
		break;
		case "AddNewAccountContent":
			echo CreateNewAccount();
		break;
		case "Log":
			if(isset($_POST['login']))
			{
				echo LogUser($_POST['login'], $_POST['pass']);
			}
		break;
		case "out":
			echo LogOut();
		break;
		case "refresh":
			echo RefreshLogPanel();
		break;
		case "comments":
			if(isset($_GET['id']))
				AddComment($_GET['id']);
		break;
	}
}

?>