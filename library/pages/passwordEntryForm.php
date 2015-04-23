<?php

$descriptionDefault ='Purpose of Password';
$urlDefault = 'domain.com/page';
$usernameDefault = 'Associated Username';

if(isset($_POST['ADDENTRY']))
{
	

	if($_POST['URL'] == $urlDefault)
	{
		$_POST['URL'] = "";
	}
	else
	{
		$_POST['URL'] = str_replace('http://', '', $_POST['URL']);
		$_POST['URL'] = str_replace('www.', '', $_POST['URL']);
		$_POST['URL'] = 'http://'.$_POST['URL'];
	}
	
	if($_POST['USERNAME'] == $usernameDefault) $_POST['USERNAME']="";
	if($_POST['DESCRIPTION'] == $descriptionDefault) $_POST['DESCRIPTION']="DEFAULT";
	
	$DBH->addUserContent($_SESSION['ID'], $_POST['DESCRIPTION'], $_POST['USERNAME'], $_POST['URL']);
}
?>

<script type="text/javascript">	
function ClearField(fieldName)
		{
		document.getElementsByName(fieldName)[0].value = "";
		}
</script>

<div class="center">
<form action="<?php echo $_SERVER['PHP_SELF']?>" method="post">
<table align="center">
	
	<tr>
		<td align="right">
		Description:
		</td>
		<td align="left">
		<input
			size="64"
			type="text"
			name="DESCRIPTION"
			value="<?php echo $descriptionDefault ?>"
			onclick="ClearField('DESCRIPTION')"
		/>
		Required
		</td>
	</tr>
	
	<tr>
		<td align="right">
		Username:
		</td>
		<td align="left">
		<input
			size="64"
			type="text"
			name="USERNAME"
			value="<?php echo $usernameDefault ?>"
			onclick="ClearField('USERNAME')" />
		Optional
		</td>
	</tr>
	
	<tr>
		<td align="right">
		URL:
		</td>
		<td align="left">
		<input
			size="64"
			type="text"
			name="URL"
			value="<?php echo $urlDefault ?>"
			onclick="ClearField('URL')"
		/>
		Optional
		</td>
	</tr>		
	
	<tr>
		<td colspan="2" align="center">
		<input type="submit" name="ADDENTRY" value="Add Entry"/>
		</td>
	</tr>
	
<table>
</form>
</div>
<hr />
<br />