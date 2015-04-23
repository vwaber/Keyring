<?php

class HtmlUtil
{	
	function createHeader($title)
	{		
		include('htmlHeader.html');
		
		?>
		<head>
			<link rel="stylesheet" type="text/css" href="./style.css" />
			<title><?php echo $title; ?></title>		
		</head>
		<body>
		<?php
	}
	
	function createFooter()
	{				
		?>
		</body>
		</html>
		<?php 
	}	
}

?> 