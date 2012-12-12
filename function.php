<?php

session_start();

/* Funkcja wyświetla okno z informacja przekazana przez argument */

function OknoInformacyjne($Tekst, $Temperament)
{
	/*
	Argumenty:
	
		- Tekst			- tekst do wyświetlenia
		- Temperament	- wartosc boolowska. Jeśli przyjmuje wartość false to okienko jest oknem błędu.
						  W przeciwnym wypadku okno sygnalizuje poprawność wykonania jakiejś operacji.	
	*/
	if($Temperament) echo "<div class = \"valid_box\"><br>", $Tekst, "<br>&nbsp;</div>"; 
	else echo "<div class=error_box>", $Tekst, "</div>"; 
}

// Connect to database
function MysqlConnect() 			
{
	try
		{
			$host 		= "localhost"; 	//database location
			$user 		= "root"; 		//database username
			$pass 		= "vertrigo"; 	//database password
			$db_name 	= "vollserv"; 	//database name

			//database connection
			$link = mysql_connect($host, $user, $pass);
			if($link !== false)
			{
				mysql_select_db($db_name);
				mysql_query("SET NAMES utf8");
			}
			return $link;
		}
		catch(Exception $Ex)
		{
			return false;
		}
	}	
	// Close mysql connection
function MysqlClose($link) 			
{
	if($link !== false)
	{
		mysql_close($link);
	}
}		

function CreateNewAccount()
{	
	if(isset($_POST['login']))
	{
		$result = "";
		try
		{
			$login = $_POST['login'];
			$pass = md5($_POST['pass']);
			$mail = $_POST['mail'];
			$bornDate = $_POST['bornDate'];
			$addDate = date('Y-m-d H:i:s');
			$type = 0;
			$surname = $_POST['surname'];
			$forname = $_POST['forname'];
			$about = $_POST['about'];
			$team = $_POST['team'];
			
			// Sprawdzanie wymaganych pól
			if(empty($login) || empty($pass) || empty($mail))
				throw new Exception("Nie podano wszystkich wymaganych wartości!");
				
			// TODO: Sprawdzić datę urodzenia
			
			
			// Dodawanie rekordu do bazy
			if(($link = MysqlConnect()) != false)
			{
				$query = "Insert Into users Set UserLogin = '$login', UserPass = '$pass', UserMail = '$mail', UserBornDate = '$bornDate', UserAddDate = '$addDate', ";
				$query .= "UserType = '$type', UserSurname = '$surname', UserForname = '$forname', UserAbout = '$about'";
					
				if($zap = mysql_query($query))
					$result = "<div class = 'HeaderModal'>Uwaga!</div><div class = 'Contenter'>Nowe konto zostało dodane poprawnie.</div><div class = 'Bottomer'><button id = 'CoolButton' onClick = \"javascript:CloseAddNewAccountDiv()\">Zamknij</button></div>";
				else
					$result = "<div class = 'HeaderModal'>Uwaga!</div><div class = 'Contenter'>Nie udało się dodać nowego konta.</div><div class = 'Bottomer'><button id = 'CoolButton' onClick = \"javascript:CloseAddNewAccountDiv()\">Zamknij</button></div>";
				
				MysqlClose($link);
			}
			else
				throw new Exception("Wsytąpił błąd podczas połączenia z bazą danych!");
		}
		catch(Exception $ex)
		{
			$result = "<div class = 'HeaderModal'>Uwaga!</div><div class = 'Contenter'>".$ex->getMessage()."</div><div class = 'Bottomer'><button id = 'CoolButton' onClick = \"javascript:CloseAddNewAccountDiv()\">Zamknij</button></div>";
		}
		return $result;
	}
	else return "gowno";
}

function CreateNewAccountForm()
{
	try
	{
		$select = "<select name = 'team' style = 'float: right; width: 200px;'><option value = 0'>brak</option>";
		
		if(($link = MysqlConnect()) != false)
		{
			$query = "Select TeamID, TeamName From teams";
			if($zap = mysql_query($query))
			{
				$select = "<select name = 'team' style = 'float: right; width: 200px;'><option value = '-1'>brak</option>";
				while($res = mysql_fetch_array($zap))
				{
					$select .= "<option value = '".$res[0]."'>".$res[1]."</option>"; 
				}
			}
			MysqlClose($link);
		}
		else
			throw new Exception("Wsytąpił błąd podczas połączenia z bazą danych!");
			
		$select .= "</select>";
	}
	catch(Exception $ex)
	{
		$select = "<select name = 'team' style = 'float: right; width: 200px;'><option value = '0'>brak</option></select>";
	}

	return
	"<center>
		<form id = 'AddNewAccountForm' name = 'AddNewAccount' action = \"javascript:GetDiv();\" method = 'post' enctype = 'multipart/form-data'>
		<div class = 'HeaderModal'>Dodawanie nowego konta: <a href = \"javascript:CloseAddNewAccountDiv()\"><img id = 'CoolExit' /></a></div>
		<div class = 'Contenter'>
			<table align = 'center' width = '500' border = '0'>
				<tr>
					<td><b>Login:</b></td><td><input type = 'text' name = 'login' /></td><td rowspan = '6'><a href = \"javascript:SetAvatar();\"><img class = 'AddAvatar' id = 'AddAvatar' /></a></td>
				</tr>
				<tr>
					<td><b>Hasło:</b></td><td><input type = 'password' name = 'pass' /></td>
				</tr>
				<tr>
					<td><b>E-mail:</b></td><td><input type = 'text' name = 'mail' /></td>
				</tr>
				<tr>
					<td>Imię:</td><td><input type = 'text' name = 'forname' /></td>
				</tr>
				<tr>
					<td>Nazwisko:</td><td><input type = 'text' name = 'surname' /></td>
				</tr>
				<tr>
					<td>Data urodzenia:</td><td><input type = 'text' name = 'bornDate' id = 'bornDate'  onchange = \"javascript:CheckDate()\" /></td>
				</tr>
				<tr>
					<td colspan = '3'>O sobie:</td>
				</tr>
				<tr>
					<td colspan = '3'><textarea id = 'about' name = 'about' style = 'width: 500px; max-width: 500px; min-width: 500px; height: 75px; max-height: 75px; min-height: 75px;'></textarea></td>
				</tr>
				<tr>
					<td colspan = '3'>Jeśli chcesz możesz powiązać konto z jakąś konkretną drużyną grajacą w lidze.<br/><br/><p id = 'Description'>Pozwoli to na zmodyfikowanie wyglądu strony w sposób ułatwiający dostęp do informacji o wybranej drużynie.</p></td>
				</tr>
				<tr>
					<td colspan = '3'>&nbsp;</td>
				</tr>
				<tr>
					<td>Wybór drużyny: </td><td colspan = '2'>$select</td>
				</tr>
			</table>
			<iframe style='border: 0pt none ; width: 1px; height: 1px;' src='' name='uploadPhotoIframe' id='uploadPhotoIframe'></iframe>
		</div>
		<div class = 'Bottomer'><button id = 'CoolButton'>Dodaj</button></div>
		</form>
		
		<form name = 'AddAvatar' target = 'uploadPhotoIframe' action = 'proba.php' method = 'post' enctype = 'multipart/form-data' style = 'visibility: hidden; height: 1px;'>
			<input type = 'text' name = 'UserDictionary' id = 'UserDictionary' />
			<input type = 'file' name = 'avatar' style = 'visibility: hidden; height:0px;' id = 'avatar' onchange = \"javascript:SetImg();\"/>
			<input type = 'submit' id = 'AddUserAvatar' />
		</form>
	</center>";
}

function LogUser($login, $pass)
{
	$head 		= "";
	$content 	= "";

	try
	{
		if(($link = MysqlConnect()) != false)
		{
			$pass = md5($pass);
			$query = "Select UserID, UserLogin, UserType, UserAvatar, TeamID From users Where UserLogin = '$login' And UserPass = '$pass'";
				
			if($zap = mysql_query($query))
			{
				if(mysql_num_rows($zap) == 0)
				{
					$head = "Niepoprawne login lub hasło!";
					$content = "<a href = \"javascript:ReLog()\">Spróbuj ponownie</a>";
				}
				else
				{
					$res = mysql_fetch_array($zap);
					
					$_SESSION['Id'] 	= $res[0];
					$_SESSION['Login'] 	= $res[1];
					$_SESSION['Type'] 	= $res[2];
					$_SESSION['Avatar'] = $res[3];
					$_SESSION['Team']	= $res[4];
					
					$head = "Zalogowany jako: $login";
					$content = "<table><tr><td><img src = 'users/".$_SESSION['Login']."/avatar.jpg' style = 'width: 75px; height:75px;'/></td>";
					$content .= "<td><a href = \"javascript:WyLog('".$_SESSION['Page']."')\">Wyloguj</a></td></tr></table>";
				}
			}
			else
			{
				$head = "Błąd wykonywania zapytania!";
				$content = "<a href = \"javascript:ReLog()\">Spróbuj ponownie</a>";
			}
			MysqlClose($link);		
		}
		else
			throw new Exception("Wsytąpił błąd podczas połączenia z bazą danych!");
	}
	catch(Exception $ex)
	{
		$head = "Niezidentyfikowany błąd!";
		$content = "<a href = \"javascript:ReLog()\">Spróbuj ponownie</a>";
	}
	
	return
	"<br/>
	<div id = 'box'>
		<div class = 'header'>
			<h3>$head</h3>
		</div>
		<div class = 'content'>
			<div class = 'text'>$content</div>
		</div>
		<div class = 'footer'></div>
	</div>";	
}

function LogOut()
{
	unset($_SESSION['Id']);
	unset($_SESSION['Login']);
	unset($_SESSION['Type']);
	unset($_SESSION['Avatar']);
	unset($_SESSION['Team']);
	
	$head = "Wylogowałeś się poprawenie!";
	$content = "<a href = \"javascript:ReLog('".$_SESSION['Page']."')\">Zaloguj ponownie</a>";
	
	return
	"<br/>
	<div id = 'box'>
		<div class = 'header'>
			<h3>$head</h3>
		</div>
		<div class = 'content'>
			<div class = 'text'>$content</div>
		</div>
		<div class = 'footer'></div>
	</div>";
}

function RefreshLogPanel()
{
	if(isset($_SESSION['Id']))
	{
		$head = "<h3>Zalogowany jako:".$_SESSION['Login']."</h3>";
		$content = "<img src = 'users/".$_SESSION['Login']."/avatar.jpg' style = 'width: 75px; height:75px;'/>";
		$content .= "<a href = \"javascript:WyLog('".$_SESSION['Page']."')\">Wyloguj</a>";		
	}
	else
	{
		$head = "<h2>
					<form action = \"javascript:LogIn('".$_SESSION['Page']."', true);\" method = 'POST' name = 'Log'>
						L: <input class = 'InputText' type = 'text' name = 'nick'> P: <input class = 'InputText' type = 'password' name = 'pass'><input id = 'CoolButton' type = 'submit' value = 'Zaloguj'/>
					</form>
					</h2>";
		$content = "<a href = \"javascript:ShowAddNewAccountDiv()\">Załóż nowe konto</a>";
	}

	return
	"<div id = 'box'>
		<div class = 'header'>
			$head
		</div>
		<div class = 'content'>
			<div class = 'text'>
				$content
			</div>
		</div>
		<div class = 'footer'></div>
	</div>";
}

function AddComment($ID)
{
	// TODO: Dodawanie komentarzy
}

?>