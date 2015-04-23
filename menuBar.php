<?php

//Check post information to see which page to load
if(isset($_POST['LOGOUT'])) 	$SH->logout();
if(isset($_POST['PASSWORDS'])) 	$SH->gotoPage('passwords.php');
if(isset($_POST['ACCOUNT'])) 	$SH->gotoPage('account.php');
if(isset($_POST['HOME'])) 		$SH->gotoPage('home.php');
if(isset($_POST['ADMIN'])) 		$SH->gotoPage('admin.php');

//Create site header and menu bar
?>
<h1 class="center">KeyRing</h1>
<hr />

<div class="center">

	<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

		<input type="submit" name="HOME" value="Home" />
		<input type="submit" name="PASSWORDS" value="Passwords" />
		<input type="submit" name="ACCOUNT" value="Account" />

		<?php
		//If user is admin show admin page link in menu bar
		if($SH->checkAdmin())
		{
			?>
			<input type="submit" name="ADMIN" value="Admin" />
			<?php
		}
		?>
		
		<input type="submit" name="LOGOUT" value="Log-Out" />
		
	</form>
</div>

<hr />
<br />