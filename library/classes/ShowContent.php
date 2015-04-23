<?php

//Class to display the users database stored passwords
class ShowContent
{

	function __construct()
	{
		$DBH =  new DBHandler();
		$result = $DBH->getUserContent();
				
		?>
		<script type="text/javascript">

		function hide(id) 
		{		
			document.getElementById(id).type = 'password';		
		}

		function unhide(id)
		{
			document.getElementById(id).type = 'text';
		}
		
		</script>
		<div class="center">
		<?php		
		$i = 0;
		while($record = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$this->showField($record['USER_FK'], $record['ID'], $record['DESCRIPTION'], $record['USERNAME'], $record['URL'], $i);
			$i++;
		}
		
		?></div><?php
	}
	
	function showField($email, $id, $description, $username, $url, $i)
	{
		$password = new Password();
		$password =  $password->genPass($description, $email);
		
		?>
		<table class='center'>
		<tr>
			<td>			
			<input type='checkbox' name='CHECK<?php echo $id ?>'>			
			</td>
			
						
			<?php
			
			if($url != "")
			{
				?>
				<td class='contentTableHighlight'>
				<?php
				echo '<a href ="'.$url.'" target="_blank">'.$description.'</a><br />';
				?>
				</td>
				<?php
			}
			else
			{
				?>
				<td class='contentTableHeader'>
				<?php
				echo $description, '<br />';
				?>
				</td>
				<?php
			}		
			?>			
			</td>
		</tr>
		
		<tr >
			<td>
			</td>
			
			<td class='contentTableBody'>
			<input id="username" name="username<?php echo $i ?>" readonly="true" value="<?php echo $username ?>" />
					
			<input 
				type="password"
				id="password<?php echo $i ?>"
				name="password<?php echo $i ?>"
				readonly="true"
				value="<?php echo $password ?>"
				onmouseover="unhide('password<?php echo $i ?>')"
				onmouseout="hide('password<?php echo $i ?>')"
			/>		
			</td>
		</tr>

		</table>
		
		<br />
		<br />
		<?php
	}
}

?>