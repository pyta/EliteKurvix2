<?php

class NewsSubPage 
{
	// ------------------------------------------------------------------------------------- variables
	private $_HTMLCode;			// all page html code
	private $_DatabaseLink;		// database link identifier
	
	// ------------------------------------------------------------------------------------- encapsulation
	public function __get($aim) 			{ return $this->$aim; }
	public function __set($aim, $value) 	{ $this->$aim = $value; }
	
	// ------------------------------------------------------------------------------------- construct
	public function __construct($newsID) {
		
		$_SESSION['Page'] = 'news';
		
		try
		{
			if(!$this->MysqlConnect())
				throw new Exception;

			if(empty($newsID))
			{
				$query = "Select n.NewsID, u.UserLogin, n.NewsTitle, n.NewsContent, n.NewsAddDate From news As n Inner Join users As u On n.userID = u.UserID";
				$zap = mysql_query($query);
				if($zap)
				{
					$rowsCount = mysql_num_rows($zap);
					
					if($rowsCount == 0)
					{
						$this->_HTMLCode .= 
						"<div id = 'box'>
							<div class = 'header'>
								<h2>Newsy</h2>
							</div>
							<div class = 'content'>
								<div class = 'text'>
									Nie ma żadnych nowości!
								</div>
							</div>
							<div class = 'footer'></div>
						</div>";
					}
					else 
					{
						$res = mysql_fetch_array($zap);
						$News = new News($res[0], $res[1], $res[2], $res[3], $res[4]);
							
						while($res = mysql_fetch_array($zap)) 
						{
							$News->_archives .=  "<a href = \"javascript:GetSingleNews('".$res[0]."');\">".$res[2]."</a><br/>";
						}
						
						$this->_HTMLCode .= $News->Show();
					}
				}
				else
					throw new Exception();
			}
			else
			{
				$query = "Select n.NewsID, u.UserLogin, n.NewsTitle, n.NewsContent, n.NewsAddDate From news As n Inner Join users As u On n.userID = u.UserID Where n.NewsID = '$newsID'";
				$zap= mysql_query($query);
				if($zap)
				{
					while($res = mysql_fetch_array($zap))
					{
						$News = new News($res[0], $res[1], $res[2], $res[3], $res[4]);
						$this->_HTMLCode .= $News->Show();
					}
				}
			}
			
			$this->MysqlClose();
		}
		catch(Exception $e)
		{
			$this->MysqlClose();
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
}

?>