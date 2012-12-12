<?php

class News 
{
	private $_id;
	private $_author;
	private $_title;
	private $_content;
	private $_archives;
	
	private $_day;
	private $_hour;
	
	public function __get($aim) 			{ return $this->$aim; }
	public function __set($aim, $value) 	{ $this->$aim = $value; }
	
	public function __construct($id, $author, $title, $content, $addDate) 
	{
		$this->_id 			= $id;
		$this->_author 		= $author;
		$this->_title		= $title;
		$this->_content 	= $content;
		$this->_archives	= "";
		
		try
		{
			$ardat = explode(' ', $addDate);
			$this->_day = $ardat[0];
			$this->_hour = $ardat[1];
		}
		catch(Exception $ex)
		{
			$this->_day = "brak";
			$this->_hour = "brak";
		}
	}
	
	public function Show()
	{
		echo
		"<div id = 'box'>
			<div class = 'header'>
				<h2>".$this->_title."</h2>
			</div>
			<div class = 'content'>
				<div class = 'text'>
					$this->_content
				<p id = 'inf' style = 'text-align: right;'>
					dodano: <b>".$this->_day."</b> o godzinie: <b>".$this->_hour."</b> przez <b>".$this->_author."</b>
				</p>";
		
		// Wyświetlanie komantarzy		
		/*if($type == true)
		{
			$Comments = new Comments($this->_id);
			$Comments->Show();
		}
		else
		{
			echo
			"<p id = 'inf'>
				<p name = 'ShowCommentsButton' id = 'ShowCommentsButton$this->_id' class = 'button' style = 'text-align:center; width:150px; float:left; margin-left:20px; margin-top:0px;' onclick = \"location.href = 'subpage.php?page=news&id=$this->_id';\">Czytaj komentarze</p>
			</p>";
		}*/
		if(!empty($this->_archives))
		{
			echo 
			"<p id = 'inf' style = 'text-align: center;'><h5>Archiwum:</h5></p><br/>
			$this->_archives";
		}
		else
		{
			echo 
			"<script type = 'text/javascript'>
				HideCommentButton($this->_id);
			</script>";
					
			$Comments = new Comments($this->_id);
			$Comments->Show();
		}
		
			echo
				"</div>
			</div>
			<div class = 'footer'></div>
		</div>
		";
	}
}

?>