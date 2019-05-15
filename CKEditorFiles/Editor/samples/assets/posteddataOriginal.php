<!DOCTYPE html>
<?php
/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
*/
?>
<html>
	<head>
		<meta charset="utf-8">
		<title>Sample &mdash; CKEditor</title>
		<link rel="stylesheet" href="sample.css">

		<?php
/* 	===================================================================================================================================
	This functionality receives a string - this is comprised of
		1. <html><head><title></title></head><body><p> - with varying amount of spaces between the >< pairs
		2. the main body of the text - this is what we are interested in and shall ripp out of the string
		3. </p></body></html> - with varying amount of spaces between the >< pairs
		
		We are not interested in 1 & 3 and will use the substr to o
		btain 2. This will then be returned to the call to display 
		(and storage on DB)
	===================================================================================================================================	*/		
		function stripheadandtail($stringtostrip)
		{
			$temp = "";
			$temp = substr($stringtostrip, 96);
			$temp = substr($temp, 0, strlen($temp) - 42);
			return $temp;
		}
				
/* 	===================================================================================================================================
	This functionality receives a string - trimed from stripheadandtail() and stores this on the DB
		Put the steps in here
	===================================================================================================================================	*/		
		function storetextonDB($stringtostore)
		{
			printf(" - stored");
		}
		
		?>
		
	</head>

	<body>

	<?php
		
		<table border="1" cellspacing="0" id="outputSample">
			
			<colgroup>
				<col width="120">
			</colgroup>
		
			<thead>
			
				<tr>
					<th>Field&nbsp;Name</th>
					<th>Value</th>
				</tr>
			</thead>

		<?php
	
			if (!empty($_POST))
			{		
				foreach ( $_POST as $key => $value )
				{
					if ( ( !is_string($value) && !is_numeric($value) ) || !is_string($key) )	
						continue;
					if (get_magic_quotes_gpc())												
						$value = htmlspecialchars( stripslashes((string)$value) );
					else
						$value = htmlspecialchars((string)$value);
		?>
					<tr>
						<th style="vertical-align: top">
						<?php 
							echo htmlspecialchars((string)$key); 
						?>
						</th>
						
						<td>
							<pre class="samples">
							<?php 
								echo $value; 
							?>
							</pre>
						</td>
					</tr>
		
				<?php

/* 	===================================================================================================================================
	This functionality calls a function to strip the HTML formatting of the page from the main textdomain
	===================================================================================================================================	*/
	
					$lvalue = "";
					$lvalue = stripheadandtail($value);	
					echo "You typed = " . $lvalue;	

/* 	===================================================================================================================================
	This functionality stores the text entered in the editor to the DB
	===================================================================================================================================	*/
					
					storetextonDB($lvalue);
					
				}
			}
				?>
		</table>
	</body>
</html>
