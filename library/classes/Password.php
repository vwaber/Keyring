<?php

//Class to generate (pseduo)random passwords
class Password 
{	
	function genPass($passphrase, $userName)
	{
		
		$totalString = $passphrase.$userName;
		$randval = strtoupper(md5($totalString));
		$password = "";
		
		for ($i = 0; $i < strlen($totalString) && $i < 8; $i ++)
		{	
			$password = $password.$randval[$i].$totalString[$i];
		}
		
		$password = str_replace(' ', ';', $password);
		$password = str_replace('a', '*', $password);
		$password = str_replace('g', '&', $password);
		$password = str_replace('j', '^', $password);
		$password = str_replace('m', '%', $password);
		$password = str_replace('p', '$', $password);
		$password = str_replace('s', '#', $password);
		$password = str_replace('v', '@', $password);
		$password = str_replace('y', '!', $password);
		return $password;
		
	}
}
 
?>

