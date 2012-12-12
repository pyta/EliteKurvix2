<?php

class Comment
{
	private $_id;
	private $_text;
	private $_login;
	private $_newsId;
	private $_addDate;
	private $_usersAvatar;
	private $_day;
	private $_hour;
	
	function __construct($id, $text, $login, $newsId, $addDate)
	{
		$this->_id 			= $id;
		$this->_text 		= nl2br($text);
		$this->_login 		= $login;
		$this->_newsId 		= $newsId;
		$this->_addDate 	= $addDate;
		
		$query = "Select UserAvatar From users Where UserLogin = '$this->_login'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			if(empty($wynik[0])) $this->_usersAvatar = "_def.jpg";
			else $this->_usersAvatar = $wynik[0];
		}
		
		$ardat = explode(' ', $this->_addDate);
		$this->_day = $ardat[0];
		$this->_hour = $ardat[1];
	}
	
	function __get($name) {return $this->$nazwa;}
	function __set($name, $value) {$this->$name = $value;}
	
	function Show()
	{
		echo 
		"<table style = 'width: 100%; border-spacing: 0px;'>",
			"<tr>",
				"<td rowspan = '2' style = 'text-align: center; vertical-align: middle; width: 150px;'><img src = 'images/avatars/$this->_usersAvatar' style = 'width: 50px; height: 50px;'><br/><a href = 'subpage.php?page=users&login=$this->_login'>$this->_login</a></td>",
				"<td style = 'text-align: left; vertical-align: top; padding-left: 5px; padding-right: 5px;'>$this->_text</td>",
			"</tr><tr>",
				"<td style = 'text-align: right; font-size: 10px; height: 15px;'>dodano: <b>", ChangeDate($this->_day), "</b> o godzinie: <b>$this->_hour</b></td>",
			"</tr><tr>",
		"</table>";
	}
}

class Comments
{
	private $_commentsCount;
	private $_newsId;

	function __construct($newsId)
	{
		$query = "Select Count(*) From comments Where SpecyficID = '$newsId'";
		$zapytanie = @mysql_query($query);
		if($zapytanie) {
			$wynik = mysql_fetch_array($zapytanie);
			$this->_commentsCount = $wynik[0];
		}
		$this->_newsId = $newsId;
	}
	
	function Show()
	{	
		echo "<p id = 'inf' style = 'text-align: center;'><h5>Komentarze:</h5></p><br/>";
			
		if($this->_commentsCount == 0) 
		{
			echo OknoInformacyjne("Nie ma żadnych komentarzy!", false);
			$Pop = '&nbsp;';
			$Nas = '&nbsp;';
		}
		else 
		{
			/* Dodawanie nowych komentarzy do bazy */
			AddComment($this->_newsId);
		
			/* Określanie liczby komentarzy na stronie */
			if(isset($_GET['site'])) {
				$LimitDown 	= ($_GET['site'] - 1) * 4;
				$LimitUp 	= $LimitDown + 4;
			} else {
				$LimitDown 	= 0;
				$LimitUp 	= 4;
			}
		
			$query = "Select c.CommentID, c.CommentsContent, u.UserLogin, c.SpecyficID, c.CommentAddDate From comments As c Inner Join users As u On c.UserID = u.UserID Where SpecyficID = '$this->_newsId' Order By c.CommentAddDate ASC Limit $LimitDown, $LimitUp";
			$zapytanie = @mysql_query($query);
			if($zapytanie)
			{
				$Licznik = 1;
				while($wynik = mysql_fetch_array($zapytanie))
				{
					echo "<br/>";
					$Comment = new Comment($wynik[0], $wynik[1], $wynik[2], $wynik[3], $wynik[4]);
					$Comment->Show();
					echo "<br/>";
					if($Licznik != mysql_num_rows($zapytanie)) echo "<hr>";
					$Licznik += 1;
				}
				
				/* Wyświetlenie odnośników do przechodzenia między stronami */
				if(isset($_GET['site'])) 
					$AktualnaStrona = $_GET['site'];
				else 
					$AktualnaStrona = 1;
					
				$Nastepna = $AktualnaStrona + 1;
				$Poprzednia = $AktualnaStrona - 1;
					
				$query = "Select Count(*) From comments Where SpecyficID = '$this->_newsId'";
				$zapytanie = @mysql_query($query);
				if($zapytanie)
				{
					$wynik = mysql_fetch_array($zapytanie);
					$CommentsCount = $wynik[0];
				}
				else $CommentsCount = 0;
					
				if(($CommentsCount - ($AktualnaStrona * 4)) > 0) {
					$Nas = "<a href = 'subpage.php?page=news&id=$this->_newsId&site=$Nastepna'><img src = 'images/next.png' style = 'width: 50px; height: 50px;'></a>";
				} else $Nas = '&nbsp;';
				if(($AktualnaStrona * 4) > $CommentsCount && $AktualnaStrona != 1) {
					$Pop = "<a href = 'subpage.php?page=news&id=$this->_newsId&site=$Poprzednia'><img src = 'images/prev.png' style = 'width: 50px; height: 50px;'></a>";
				} else $Pop = '&nbsp;';
			}
		}
		
		// ***************************************** wyświetlanie guzika 'dodaj komantarz' dla zalogowanych użytkowników
		
		if(isset($_SESSION['Id'])) 
		{
			echo "<br><p name = 'ShowCommentFormButton' class = \"button\" style = \"text-align:center; width:100px; float:right; margin-right:20px; margin-top:0px;\" onclick = \"ShowCommentsForm($this->_newsId);\">Dodaj komentarz</p>";
			echo "<br><br>";
			
			// ***************************************** div na formularz
			echo "<form name = 'CommentsFormNo$this->_newsId' action = 'subpage.php?div=comments&id=$this->_newsId' method = 'POST'>";
			echo "<br><div id = '$this->_newsId'>";
			echo "</div>"; 
			echo "</form>";
		}
		
		//echo "<img src = 'images/musicbreak.png' style = 'width: 550px; height: 25px;'>";
		
		echo 
		"<table style = 'width: 100%; border-spacing: 0px;'>",
			"<tr>",
				"<td colspan = '3'>&nbsp;</td>",
			"</tr>",
			"<tr>",
				"<td style = 'width: 30%; text-align: lefr;'>$Pop</td>",
				"<td style = 'width: 40%; text-align: center;'>&nbsp;</td>",
				"<td style = 'width: 30%; text-align: right;'>$Nas</td>",
			"</tr>",
		"</table>";
		
		//<p class = 'button' onclick = \"location.href = 'index.php';\">Strona główna</p>
	}
}

?>