<?php

class HomeSubPage 
{
	// ------------------------------------------------------------------------------------- variables
	private $_HTMLCode;			// all page html code
	private $_DatabaseLink;		// database link identifier
	
	// ------------------------------------------------------------------------------------- encapsulation
	public function __get($aim) 			{ return $this->$aim; }
	public function __set($aim, $value) 	{ $this->$aim = $value; }
	
	// ------------------------------------------------------------------------------------- construct
	public function __construct() {
	
		$_SESSION['Page'] = 'home';
	
		try
		{
			$this->MysqlConnect();
		
			$title = "";
			$content = "";
		
			$query = "Select StartTitle, StartContent From start Where StartSelected = 1";
			if($zap = mysql_query($query))
			{
				if($result = mysql_fetch_array($zap))
				{
					$title = 	$result[0];
					$content = 	$result[1];
					
					$this->_HTMLCode .= 
					"<div id = 'box'>
						<div class = 'header'>
							<h2>$title</h2>
						</div>
						<div class = 'content'>
							<div class = 'text'>
								$content
							</div>
						</div>
						<div class = 'footer'></div>
					</div>";
				}
				else
					throw new Exception();
			}
			else
				throw new Exception();
		}
		catch(Exception $e)
		{
			$this->_HTMLCode = 
			"<div id = 'box'>
				<div class = 'header'>
					<h2>Błąd!</h2>
				</div>
				<div class = 'content'>
					<div class = 'text'>
						Wystąpił niespodziewany błąd na stronie. Przepraszamy.
					</div>
				</div>
				<div class = 'footer'></div>
			</div>";
		}
	}
	
	// ------------------------------------------------------------------------------------- methods
	// Create main index content
	public function CreateContent()			{
		return $this->_HTMLCode;		
	}
	// Connect to database
	public function MysqlConnect() 			{
		try
		{
			$host 		= "localhost"; 	//database location
			$user 		= "root"; 		//database username
			$pass 		= "vertrigo"; 	//database password
			$db_name 	= "vollserv"; 	//database name

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
}

?>