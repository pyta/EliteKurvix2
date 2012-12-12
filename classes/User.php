<?php

class User 
{
	private $_ID;
	private $_Nick;
	private $_Forname;
	private $_Surname;
	private $_BornDate;
	private $_AddDate;
	private $_Type;
	private $_About;
	private $_Avatar;
	
	public function __get($aim) 			{ return $this->$aim; }
	public function __set($aim, $value) 	{ $this->$aim = $value; }
	
	public function __construct($ID, $Nick, $Forname, $Surname, $BornDate, $AddDate, $Type, $About, $Avatar) 
	{
		$this->_ID 			= $ID;
		$this->_Nick 		= $Nick;
		$this->_Forname		= $Forname;
		$this->_Surname 	= $Surname;
		$this->_BornDate 	= $BornDate;
		$this->_AddDAte		= $AddDate;
		$this->_Type		= $Type;
		$this->_About		= $About;
		$this->_Avatar 		= $Avatar;
	}
}

?>