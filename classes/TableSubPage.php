<?php

class TableSubPage 
{
	// ------------------------------------------------------------------------------------- variables
	private $_HTMLCode;			// all page html code
	private $_DatabaseLink;		// database link identifier
	
	// ------------------------------------------------------------------------------------- encapsulation
	public function __get($aim) 			{ return $this->$aim; }
	public function __set($aim, $value) 	{ $this->$aim = $value; }
	
	// ------------------------------------------------------------------------------------- construct
	public function __construct() {
	
		$_SESSION['Page'] = 'table';
	
		try
		{
			$this->MysqlConnect();
		
			$title = "Tabela";
			$content = "";
		
			$query = "Select Sum(TeamASetWin), Sum(TeamASetWin), Sum(TeamASet1), Sum(TeamBSet1), Sum(TeamASet2), Sum(TeamBSet2), Sum(TeamASet3), Sum(TeamBSet3), ";
			$query .= "Sum(TeamASet4), Sum(TeamBSet4), Sum(TeamASet5), Sum(TeamBSet5) From matches Group By TeamID_A, TeamID_B";
			if($zap = mysql_query($query))
			{
				while($result = mysql_fetch_array($zap))
				{
					
				}
			}
		
			$query = "Select t.TeamName, r.PointsNumber From teams As t Inner Join ranktable As r Using(TeamID)";
			if($zap = mysql_query($query))
			{
				$content = 	
				"<table>
					<tr>
						<th>Poz.<th>
						<th>Dru¿yna<th>
						<th>Pkt.</th>
						<th>Mecz +</th>
						<th>Mecz -</th>
						<th>Set +</th>
						<th>Set -</th>
						<th>Punkty +</th>
						<th>Punkty -</th>
					</tr>";
					
					$position = 1;
					while($result = mysql_fetch_array($zap))
					{
						$content .=	
						"<tr>
							<td>$position</td>
							<td>$result[0]</td>
							<td>$result[1]</td>
							<td>$position</td>
							<td>$position</td>
							<td>$position</td>
							<td>$position</td>
							<td>$position</td>
							<td>$position</td>
						</tr>";
						++$position;
					}
					
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
		catch(Exception $e)
		{
			$this->_HTMLCode = 
			"<div id = 'box'>
				<div class = 'header'>
					<h2>B³¹d!</h2>
				</div>
				<div class = 'content'>
					<div class = 'text'>
						Wyst¹pi³ niespodziewany b³¹d na stronie. Przepraszamy.
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