<h1 class='center'>Passwords</h1>
<br />
<?php
include('passwordEntryForm.php');


if(isset($_POST['REMOVE']))
{
	foreach($_POST as $field => $fieldContent)
	{
		$ID = str_replace('CHECK', '', $field);
		
		if(is_numeric($ID))
		{ 
		$DBH->removeUserContent($_SESSION['ID'], $ID);
		}	
	}
}

?>
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<?php
new ShowContent();
?>
<div class='center'>
<input type="submit" name="REMOVE" value="Remove"/>
</div>
</form>






