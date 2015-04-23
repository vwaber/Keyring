<h1 class='center'>Admin Page</h1>
<br />

<?php
	
if(isset($_POST['REMOVE']))
{	
	foreach($_POST as $field => $fieldContent)
	{
		$ID = str_replace('CHECK', '', $field);
		if($ID == 1)
		{
		?>
		<p class='warning'>Can not delete original admin!</p>
		<?php
		}	
		else if(is_numeric($ID))
		{ 
		$DBH->removeUser($ID);
		}
	}
}

if(isset($_POST['UPDATE']))
{
	foreach($_POST as $field => $fieldContent)
	{
		$ID = str_replace('CHECK', '', $field);
		
		if($ID === '1')
		{
		?>
		<p class='warning'>Cannot edit original admin!</p>
		<?php
		}	
		else if(is_numeric($ID))
		{ 
			if(array_key_exists('EMAIL'.$ID, $_POST))
			{
				$EMAIL = $_POST['EMAIL'.$ID];
				$DBH->changeUserEmail($ID, $EMAIL);
			}	
			if(array_key_exists('PASSWORD'.$ID, $_POST) && strlen($_POST['PASSWORD'.$ID]) < 32)
			{
				$PASSWORD = $_POST['PASSWORD'.$ID];
				$DBH->changeUserPasswordByID($ID, $PASSWORD);
			}
			if(array_key_exists('ADMIN'.$ID, $_POST))
			{
				$ADMIN = $_POST['ADMIN'.$ID];
				$DBH->changeUserAdminLvl($ID, $ADMIN);
			}	
		}	
	}
}

$result = $DBH->getUsers();

?>
<h2 class='center'>Edit Users</h2>

<div class='pageText center'>
<p align='left'>
Row(s) must be checked to be updated or removed.
Newly entered passwords are automatically converted to MD5.
Valid admin values are {0,1}.
</p>
</div>

<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table class='center'  cellpadding="5" border='0'>
<?php

$fields = mysql_fetch_assoc($result);
?>
<tr class='contentTableHeader'>
<td>X</td>
<?php
foreach($fields as $fieldName => $fieldContent)
{
	echo '<td>'.$fieldName.'</td>';
}
echo '</tr>';

mysql_data_seek($result, 0);

while($record = mysql_fetch_array($result, MYSQL_ASSOC))
{
	?>
	<tr class='contentTableBody'>
	<td>
	<input type='checkbox' name='CHECK<?php echo $record['ID'] ?>' />
	</td>
	<?php	
		
	foreach($record as $fieldName => $field)
		{
		?>
		<td>
		<?php
		
		if($fieldName == 'EMAIL')
		{
			?>
			<input type='text' value='<?php echo $field ?>' name='EMAIL<?php echo $record['ID'] ?>' />
			<?php
			
		}
		else if($fieldName == 'PASSWORD')
		{
			?>
			<input type='text' size='40' value='<?php echo $field ?>' name='PASSWORD<?php echo $record['ID'] ?>' />
			<?php
			
		}
		else if($fieldName == 'ADMIN')
		{
			?>
			<input type='text' size='5' value='<?php echo $field ?>' name='ADMIN<?php echo $record['ID'] ?>' />
			<?php
			
		}
		else
		{
			echo $field;
		}
		
		echo '</td>';
		}
		
	echo '</tr>';
}
	

?>
</table>

</br>
<div class='center'>
<input type="submit" name="UPDATE" value="Update"/>
<input type="submit" name="REMOVE" value="Remove"/>
</div>
</form>
