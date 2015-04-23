<?php

//Custom SessionHandler class to handle all session interactions
class SessionHandler_Custom
{

	//Initial page content to load
	var $START_PAGE = 'start.php';
	
	function __construct()
	{	
		if(!isset($_SESSION))			session_start();
		if(!isset($_SESSION['PAGE'])) 	$_SESSION['PAGE'] = $this->START_PAGE;
				
	}
	
	//Sets current page defined in session and redirects there
	function gotoPage($PAGE)
	{
		$_SESSION['PAGE'] = $PAGE;
		header('Location: ' . $_SERVER['PHP_SELF']);
	}
	
	//Checks user credentials, returns boolean
	function login($EMAIL, $PASSWORD)
	{
				
		$DBH =  new DBHandler();
		$row = $DBH->login($EMAIL, $PASSWORD);
				
		if($row)
		{
			$_SESSION['ID'] = $row['ID'];
			$_SESSION['EMAIL'] = $row['EMAIL'];
			$_SESSION['ADMIN'] = $row['ADMIN'];
			return(true);
		}
		
		return(false);
	
	}
	
	//Checks user admin privileges, returns boolean 
	function checkAdmin()
	{
		if($_SESSION['ADMIN'] != 0) return(true);
	}
	
	//Confirms user is currently logged in, returns boolean
	function checkLogin()
	{
		if(isset($_SESSION['EMAIL'])) return(true);
	}
	
	//Logs out the user, clears session, redirects to 
	function logout()
	{
		session_destroy();
		session_start();	
		$this->gotoPage($this->START_PAGE);
	}
			
}

?>