<?php

class MainPage
{
	// ------------------------------------------------------------------------------------- variables
	private $_DatabaseLink;		// database link identifier
	private $_ActualSubPage;	// actual subpage view
	
	private $_HTMLCode;			// all page html code
	private $_HeadData;			// head html code
	private $_Content;			// body html code
	private $_Baner;			// baner
	private $_Menu;				// main menu
	private $_Loading;			// loading div
	private $_Modal;			// new account div
	private $_HiddenIFram;		// flaying IFrame
	
	// ------------------------------------------------------------------------------------- construct
	
	public function __construct() {
	
		$_SESSION['Page'] = 'home';
	
		try
		{
			if(!$this->MysqlConnect())
				throw new Exception;
			
			// Create head data
			$this->_HeadData = $this->CreateHeadData();
			// Create logo
			$this->_Baner = $this->CreateBanerData();
			// Create menu
			$this->_Menu = $this->CreateShortPanel();
			// Create content
			$this->_Content = $this->CreateContent();
			// set loading
			$this->_Loading = $this->CreateLoading();
			// create add new account div
			$this->_Modal = $this->CreateModalPanel();
			
			$this->MysqlClose();
			$body =  $this->_Loading.$this->_Baner."\r\n\t\t".$this->_Menu."\r\n\t\t".$this->_Content."\r\n\t\t".$this->_Modal;
		}
		catch(Exception $e)
		{
			$this->MysqlClose();
			$body = "Fatal error";
		}
		
		// Concat all data
		$this->_HTMLCode =
"<!DOCTYPE html>
<html>
	<head>
		$this->_HeadData
	</head>
	<body>
		$body
	</body>
</html>";
	}
	
	// ------------------------------------------------------------------------------------- methods
	
	// Connect to database
	public function MysqlConnect() 			{
		try
		{
			$host 		= "localhost"; 	//database location
			$user 		= "root"; 		//database username
			$pass 		= ""; 	//database password
			$db_name 	= "volley"; 	//database name

			//database connection
			$link = mysql_connect($host, $user, $pass);
			$this->_DatabaseLink = $link;
			if($link !== false)
			{
				mysql_select_db($db_name);
				mysql_query("SET NAMES utf8");
			}
			return true;
		}
		catch(Exception $Ex)
		{
			return false;
		}
	}
	// Close mysql connection
	public function MysqlClose() 			{
		if($this->_DatabaseLink !== false)
		{
			mysql_close($this->_DatabaseLink);
		}
	}
	// Create main index content
	public function CreateCode()			{
		return $this->_HTMLCode;		
	}
	// Create head data
	public function CreateHeadData()		{
		$result = "";
		$query = "Select headDataContent From headdata";
		$zap = mysql_query($query);
		if($zap)
		{
			while($res = mysql_fetch_array($zap))
				$result .= $res[0]."\r\n\t\t";
			$result = substr($result, 0, -4);
		}
		return $result;
	}
	// Create baner data
	public function CreateBanerData()		{
	
		if(isset($_SESSION['Id']))
		{
			$head = "<h3>Zalogowany jako:".$_SESSION['Login']."</h3>";
			$content = "<img src = 'users/".$_SESSION['Login']."/avatar.jpg' style = 'width: 75px; height:75px;'/>";
			$content .= "<a href = \"javascript:WyLog('".$_SESSION['Page']."')\">Wyloguj</a>";		
		}
		else
		{
			$head = "<h2>
						<form action = \"javascript:LogIn('".$_SESSION['Page']."');\" method = 'POST' name = 'Log'>
							L: <input class = 'InputText' type = 'text' name = 'nick'> P: <input class = 'InputText' type = 'password' name = 'pass'><input id = 'CoolButton' type = 'submit' value = 'Zaloguj'/>
						</form>
						</h2>";
			$content = "<a href = \"javascript:ShowAddNewAccountDiv()\">Załóż nowe konto</a>";
		}
	
		return
		"<div class = 'Baner'>
			<div id = 'LogPanel'>
				<br/>
				<div id = 'box'>
					<div class = 'header'>
						$head
					</div>
					<div class = 'content'>
						<div class = 'text'>
							$content
						</div>
					</div>
					<div class = 'footer'></div>
				</div>
			</div>
		</div>";		
	}
	// Create loading div
	public function CreateLoading()			{
		return
		"<div id = 'Ladowanie' align = 'center' style = 'visibility:hidden; position:absolute; width:100%; margin-top:150px;'>
			<div class = 'KomT'></div>
			<div class = 'KomM'><img src = 'images/load2.gif'></div>
			<div class = 'KomB'></div>
		</div>\r\n\t\t";	
	}
	// Create main content
	public function CreateContent()			{
	
		$home = new HomeSubPage();
		$content = $home->CreateContent();
	
		$result = 
		"<div class = 'ContentPage' id = 'Content'>
			<div id = 'MenuPanel'>
			<br/>
				<div id = 'box'>
					<div class = 'header'>
						<h2>Menu</h2>
					</div>
					<div class = 'content'>
						<div class = 'text'>
							<h3>&nbsp;&nbsp;Główne:</h3>
							<a href = \"javascript:GetPage('home');\">Strona główna</a><br/>
							<a href = \"javascript:GetPage('news');\">Aktualności</a><br/>
							<h3>&nbsp;&nbsp;Liga:</h3>
							<a href = \"javascript:GetPage('table');\">Tabela</a><br/>
							<a href = \"javascript:GetPage('time');\">Terminarz</a><br/>
								<a href = \"javascript:GetPage('pass');\">Było</a><br/>
								<a href = \"javascript:GetPage('future');\">Będzie</a><br/>
							<a href = \"javascript:GetPage('teams');\">Drużyny</a><br/>
							<a href = \"javascript:GetPage('regul');\">Regulamin</a><br/>
							<a href = \"javascript:GetPage('info');\">Inne info</a><br/>
							<h3>&nbsp;&nbsp;Media:</h3>
							<a href = \"javascript:GetPage('galery');\">Galeria</a><br/>
							<a href = \"javascript:GetPage('films');\">Filmy</a><br/>
							<h3>&nbsp;&nbsp;Inne:</h3>
							<a href = \"javascript:GetPage('spons');\">Sponsorzy</a><br/>
							<a href = \"javascript:GetPage('motyw');\">Motywacja</a><br/>
						</div>
					</div>
					<div class = 'footer'></div>
				</div>
			</div>
			<div id = 'MainPanel'>
				<br/>
				$content
			</div>
			<div id = 'PocketPanel'>
				<br/>
				<div id = 'box'>
					<div class = 'header'>
						<h2>Ostatnie wyniki</h2>
					</div>
					<div class = 'content'>
						<div class = 'text'>
							WYNIKI
						</div>
					</div>
					<div class = 'footer'></div>
				</div>
				<br/>
				<div id = 'box'>
					<div class = 'header'>
						<h2>Tabela</h2>
					</div>
					<div class = 'content'>
						<div class = 'text'>
							TABELA
						</div>
					</div>
					<div class = 'footer'></div>
				</div>
				<br/>
				<div id = 'box'>
					<div class = 'header'>
						<h2>Ostatnie zdjęcia</h2>
					</div>
					<div class = 'content'>
						<div class = 'text'>
							FOTECZKI
						</div>
					</div>
					<div class = 'footer'></div>
				</div>
			</div>
		</div>";
		
		return $result;
	}
	// Create new accout div
	public function CreateModalPanel()		{
	
		$result = 
		"<div id = 'ModalPanel'>
			<div id = 'box'>
				<div class = 'header'></div>
				<div class = 'content' id = 'ModalPanelContent'></div>
				<div class = 'footer'></div>
			</div>
		</div>";
		
		return $result;
	}
	// Create menu div
	public function CreateShortPanel()			{
	
		$result = "<div class = 'Menu' id = 'ShortPanel'></div>";
		
		return $result;
	}
}

?>