<?php

//Class to handle all database interaction
class DBHandler
{

	var $HOST = 'localhost';
	var $DBUser = 'keyring_user';
	var $DBPass = 'vdhGzyYyH6Bzj3zA';
	var $DB = 'keyring';
	
	function connect()
	{
	return(mysql_connect($this->HOST, $this->DBUser, $this->DBPass));
	}
	
	function registerUser($EMAIL, $PASSWORD)
	{	
		$EMAIL = strtolower($this->sanitize($EMAIL));
		$PASSWORD = md5($PASSWORD);
		
		$connection = $this->connect();
		if(!$connection) return(false);
		
		mysql_select_db('keyring', $connection);
		
		$queryStr = "select * from USER_TABLE where EMAIL ='".$EMAIL."'";
		$result = mysql_query($queryStr, $connection);
		if(mysql_num_rows($result) != 0) return(false);
		
		$queryStr = ("insert into USER_TABLE (EMAIL, PASSWORD, ADMIN) value('".$EMAIL."', '".$PASSWORD."', false);");
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	}
		
	function login($EMAIL, $PASSWORD)
	{
		$EMAIL = strtolower($this->sanitize($EMAIL));
		$PASSWORD = md5($PASSWORD);
		
		$connection = $this->connect();
		if(!$connection) return(false);
		
		mysql_select_db($this->DB, $connection);
		$queryStr = ('select * from USER_TABLE ');
		$queryStr .= ("where EMAIL = '".$EMAIL."' and PASSWORD = '".$PASSWORD."'");
		$result = mysql_query($queryStr, $connection);
								
		mysql_close ($connection);
		
		if(mysql_num_rows($result) == 1)
		{
			$row = mysql_fetch_array($result);			
			return($row);
		}
		
		return(false);
	
	}
		
	function addUserContent($ID, $DESCRIPTION, $USERNAME = "", $URL = "")
	{
		$ID = $this->sanitize($ID);
		$DESCRIPTION = $this->sanitize($DESCRIPTION);
		$URL = $this->sanitize($URL);
		$USERNAME = $this->sanitize($USERNAME);
		
		$connection = $this->connect();
		if(!$connection) return(false);
		
		mysql_select_db($this->DB, $connection);
		$queryStr = ("insert into USER_CONTENT (USER_FK, DESCRIPTION, USERNAME, URL) value ('".$ID."', '".$DESCRIPTION."', '".$USERNAME."', '".$URL."')");
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
	
	function removeUserContent($ID, $CID)
	{
		$ID = $this->sanitize($ID);
		$CID = $this->sanitize($CID);
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = "delete from USER_CONTENT where ID = ".$CID." and USER_FK = '".$ID."'";
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	}
	
	function getUserContent()
	{
		$ID = $_SESSION['ID'];
		
		$connection = $this->connect();
		if(!$connection) return(false);
		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = ("select * from USER_CONTENT where USER_FK ='".$ID."'");
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
	
	function getUsers()
	{
		$ID = $_SESSION['ID'];
		
		$connection = $this->connect();
		if(!$connection) return(false);
		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = ('select * from USER_TABLE ');
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
	
	function removeUser($ID)
	{
	
		$ID = $this->sanitize($ID);
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = 'delete from USER_TABLE where ID = '.$ID.';';
		$result = mysql_query($queryStr, $connection);
		if($result == false) return(false);
		$queryStr = 'delete from USER_CONTENT where USER_FK = '.$ID.';';
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	}
	
	function changeUserAdminLvl($ID, $ADMIN)
	{
	
		$ID = $this->sanitize($ID);
		$ADMIN = $this->sanitize($ADMIN);
		
		if($ADMIN == 0)
		{
			$ADMIN = 'false';
		}
		elseif($ADMIN == 1)
		{
			$ADMIN = 'true';
		}
		else
		{
			return(false);
		}
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = 'update USER_TABLE set ADMIN = '.$ADMIN.' where ID = '.$ID;
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
	
	function changeUserEmail($ID, $EMAIL)
	{
	
		$ID = $this->sanitize($ID);
		$EMAIL = $this->sanitize($EMAIL);
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = "update USER_TABLE set EMAIL = '".$EMAIL."' where ID = ".$ID;
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
	
	function changeUserPasswordByID($ID, $PASSWORD)
	{
	
		$ID = $this->sanitize($ID);
		$PASSWORD = md5($this->sanitize($PASSWORD));
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = "update USER_TABLE set PASSWORD = '".$PASSWORD."' where ID = ".$ID;
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
	
	function changeUserPassword($ID, $PASSWORD)
	{
	
		$ID = $this->sanitize($ID);
		$PASSWORD = md5($this->sanitize($PASSWORD));
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = "update USER_TABLE set PASSWORD = '".$PASSWORD."' where ID = '".$ID."'";
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		return($result);
	
	}
		
	function checkPassword($ID, $PASSWORD)
	{
		$ID = $this->sanitize($ID);
		$PASSWORD = md5($this->sanitize($PASSWORD));
		
		$connection = $this->connect();
		if(!$connection) return(false);		
		mysql_select_db($this->DB, $connection);
		
		$queryStr = "select * from USER_TABLE where PASSWORD = '".$PASSWORD."' and ID = '".$ID."'";
		$result = mysql_query($queryStr, $connection);
		
		mysql_close ($connection);
		
		if(mysql_num_rows($result) == 1)
		{
			$row = mysql_fetch_array($result);
			return($row);
		}
		
		return(false);
	}
	
	function sanitize($input) 
	{ 
		$strip = array(',',';','"','\'','\\','\\r','\\n'); 
		$string = str_replace($strip,'',$input); 
		return $string; 
	} 
		
}

?>