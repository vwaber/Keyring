<?php
/*
 *	Created by Vaan W. Waber
 *	Keyring website root page:
 *		New content is dynamically loaded based on POST contents.
 *		User always remains within this single page.
 * 	Passwords are generated upon request and never stored
 */

//Includes all class files in ./library/classes/*
foreach (glob('library/classes/*.php') as $filename) include($filename);

//Start SessionHandler;
$SH = new SessionHandler_Custom();
$DBH =  new DBHandler();
$HU = new HtmlUtil();

//Print HTML content common to all pages
$HU->createHeader('KeyRing');


?>
<div id="blackOut">
</div>

<div id="mainFrame">
	<?php

	//Check if user is logged in, if so display menu bar
	if( $SH->checkLogin() ) include('./menuBar.php');

	include('./library/pages/'.$_SESSION['PAGE']);

	?>
</div>
<?php

//Print HTML content common to all pages
$HU->createFooter();

?>