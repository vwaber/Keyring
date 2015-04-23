<h1 class='center'>Account Page</h1>
<br />
<h2 class='center'>Change Password</h2>
<br />

<?php

if(isset($_POST['CHANGEPASSWORD']))
{

	if($_SESSION['ID'] == 1)
	{
		?>
		<p class="warning">The password for the original admin may not be changed</p>
		<?php
	}
	else if(
			$DBH->checkPassword($_SESSION['ID'], $_POST['PASSWORD'])
			&&
			$_POST['NEWPASSWORD'] == $_POST['NEWPASSWORD2']
			&&
			strlen($_POST['NEWPASSWORD'])>=4
		)
	{	
		$DBH->changeUserPassword($_SESSION['ID'], $_POST['NEWPASSWORD']);
		
		?>
		<p class="success">Changes Successful!</p>
		<?php
	}
	else if(!($DBH->checkPassword($_SESSION['ID'], $_POST['PASSWORD'])))
	{
		?>
		<p class="warning">Incorrect password!</p>
		<?php
	}
	else if($_POST['NEWPASSWORD'] != $_POST['NEWPASSWORD2'])
	{
		?>
		<p class="warning">Passwords do not match!</p>
		<?php
	}
	else if(strlen($_POST['NEWPASSWORD'])<4)
	{
		?>
		<p class="warning">Password must consist of at least 4 characters!</p>
		<?php
	}
	
}



?>

<div class="center">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table align="center">
	
	<tr>
		<td align="right">
		Password:
		</td>
		<td align="left">
		<input
			size="32"
			type="password"
			name="PASSWORD"
		/>
		</td>
	</tr>
	
	<tr>
		<td align="right">
		New Password:
		</td>
		<td align="left">
		<input
			size="32"
			type="password"
			name="NEWPASSWORD"
		/>
		</td>
	</tr>
	
	<tr>
		<td align="right">
		Re-enter:
		</td>
		<td align="left">
		<input
			size="32"
			type="password"
			name="NEWPASSWORD2"
		/>
		</td>
	</tr>		
	
	<tr>
		<td colspan="2" align="center">
		<br />
		<input type="submit" name="CHANGEPASSWORD" value="Change Password"/>
		</td>
	</tr>
	
<table>
</form>
</div>