<?php

if(isset($_POST['LOGIN']))
{
	if($SH->login($_POST['LOGIN_EMAIL'], $_POST['LOGIN_PASSWORD']))
	{
	$SH->gotoPage('home.php');
	}
}

if(isset($_POST['SIGNUP']))
{
	if(
		$_POST['SIGNUP_PASSWORD'] == $_POST['SIGNUP_PASSWORD2']
		&&
		strlen($_POST['SIGNUP_PASSWORD'])>=4
		&&
		strlen($_POST['SIGNUP_EMAIL'])>=4
		&&
		$_POST['SIGNUP_EMAIL'] != str_replace('@', '', $_POST['SIGNUP_EMAIL'])
		&&
		$_POST['SIGNUP_EMAIL'] != str_replace('.', '', $_POST['SIGNUP_EMAIL'])
		)
	{	
	
		if($DBH->registerUser($_POST['SIGNUP_EMAIL'], $_POST['SIGNUP_PASSWORD']))
		{		
			if($SH->login($_POST['SIGNUP_EMAIL'], $_POST['SIGNUP_PASSWORD']))
			{
				$SH->gotoPage('home.php');
			}
		}
	}
}

?>

<script type="text/javascript">		
	
	document.getElementById("blackOut").style.display = "block";

 	function ShowSignupWindow()
		{	 
		document.getElementById("signupWindow").style.display = "block";
		document.getElementById("startWindow").style.display = "none";	
		}
		
	function ShowStartWindow()
		{	 
		document.getElementById("startWindow").style.display = "block";
		document.getElementById("signupWindow").style.display = "none";	
		}
		
	function ClearField(fieldName)
		{
		document.getElementsByName(fieldName)[0].value = "";
		}
		
</script>


<div id="startWindow" class="contentHolder">
	<h1 class="center">KeyRing</h1>
	<hr />
<table class="center" cellpadding="2">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">

	<?php
	if(isset($_POST['LOGIN']))
	{
		?>
		<p class="warning">Incorrect Email and/or Password!</p>
		<?php
		
	}
	?>
		
	<tr>
		<td align='right'>
		Email:
		</td>
		<td aligh='left'>
		<input type="text" name="LOGIN_EMAIL" size="32"
			<?php
			if(isset($_POST['LOGIN_EMAIL']))
			{
				echo 'value="'.$_POST['LOGIN_EMAIL'].'"';
			}
			else
			{
				echo 'value=""';
			}
			?>
			/>
		</td>
	</tr>
	
	<tr>
		<td align='right'>
		Password:
		</td>
		<td aligh='left'>
		<input type="password" name="LOGIN_PASSWORD" value ="" size="32" />
		</td>
	</tr>
		
	<tr>
		<td colspan="2">
		<input type="submit" name="LOGIN" value=" Log-In "/>
		</td>	
	</tr>
	
	<tr>
		<td colspan="2">
		<b>-or-</b>
		</td>	
	</tr>
	
	<tr>
		<td colspan="2">
		<button class="button" type="button" onclick="ShowSignupWindow()">Sign-Up</button>
		</td>	
	</tr>	
	
</form>
</table>
</div>


<div id="signupWindow" class="contentHolder hidden">
	<h1 class="center">KeyRing</h1>
	<hr />
<table class="center" cellpadding="2">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
		
	<?php
	if(isset($_POST['SIGNUP']))
	{
		?>
		<script type="text/javascript">
			ShowSignupWindow();
		</script>
		<?php
		
		if(
				$_POST['SIGNUP_EMAIL'] == str_replace('@', '', $_POST['SIGNUP_EMAIL'])
				||
				$_POST['SIGNUP_EMAIL'] == str_replace('.', '', $_POST['SIGNUP_EMAIL'])
			)
		{
		?>
		<p class="warning">Email address is invalid.</p>
		<?php
		}
		else if($_POST['SIGNUP_PASSWORD'] != $_POST['SIGNUP_PASSWORD2'])
		{
		?>
		<p class="warning">Passwords do not match!</p>
		<?php
		}
		else if(strlen($_POST['SIGNUP_PASSWORD'])<4 || strlen($_POST['SIGNUP_EMAIL'])<4)
		{
		?>
		<p class="warning">All fields must consist of at least 4 characters!</p>
		<?php
		}		
		else
		{
		?>
		<p class="warning">Sign-Up Failed!<br />Email may already be registered</p>
		<?php
		}
	}
	?>
	
	<tr>
		<td align='right'>
		Email:
		</td>
		<td align='left'>
			<input type="text" name="SIGNUP_EMAIL" size="32"
			<?php
			if(isset($_POST['SIGNUP_EMAIL']))
			{
				echo 'value="'.$_POST['SIGNUP_EMAIL'].'"';
			}
			else
			{
				echo 'value=""';
			}
			?>
			/>
		</td>
	</tr>
		
	<tr>
		<td align='right'>
		Password:
		</td>
		<td aligh='left'>
			<input type="password" name="SIGNUP_PASSWORD" value ="" size="32" />
		</td>
	</tr>
	
	<tr>		
		<td align='right'>
		Re-enter:
		</td>
		<td aligh='left'>
			<input type="password" name="SIGNUP_PASSWORD2" value ="" size="32" />
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<input type="submit" name="SIGNUP" value="Sign-Up" />
		</td>	
	</tr>
	
	<tr>
		<td colspan="2">
			<b>-or-</b>
		</td>
	</tr>
	
	<tr>
		<td colspan="2">
			<button class="button" type="button" onclick="ShowStartWindow()">&nbsp;Log-In&nbsp; </button>
		</td>	
	</tr>	
	
</form>
</table>
</div>
