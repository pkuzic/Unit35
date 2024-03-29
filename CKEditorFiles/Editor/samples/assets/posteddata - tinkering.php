<!DOCTYPE html>
<?php
/*
Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.md or http://ckeditor.com/license
*/

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('../../../CMS/includes/article.php');
	include_once ('../../../CMS/includes/connection.php');
		
	$article = new Article;
	$articles = $article->fetch_all();

?>
	<html>
		<head>
			<meta charset="utf-8">
			<title>Sample &mdash; CKEditor</title>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	
			<link rel="stylesheet" type="text/css" href="../../../CSS/MainStyles.css">

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

		?>
		
	</head>

	<body>
	
		<div class="Container"> 																	<!-- overall page container div -->
			<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
		
			<div class="section-box">	<h12><?php echo "a"; ?></h12>		</div>
			<div class="section-box2">	<h12><?php echo "b"; ?></h12>		</div>
			<div class="section-box3" align="right">	<?php include_once("../../../memberloginimagemap.php"); ?>		</div>
			<br style="clear: left;" />				
				
		 	<div class = "Menu">		</div>

<!-- START of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->			

			<div class="PagePurpose">			
				<table border="0" cellpadding="5" cellspacing="0" width="800px">
					<tr>	<td align="left" colspan="6">	 	</td>	</tr>
					<tr>	<td align="left" colspan="6">	 	</td>	</tr>
					<tr>	<td align="left" colspan="6">	<h7>	Add article...</h7> 	</td>	</tr>
				</table>
			</div>
			
		</div>
<!-- END of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->							
	
	<?php
		
		if (isset($_SESSION['logged_in']) == true)
		{
			if($_SESSION['logged_in_as_member'] == FALSE && $_SESSION['logged_in_as_a_user'] == TRUE)
			{
	?>
				<div class="container">
		
					<table width="700" class="tableindexroundedtopandbottom"> 
						<thead>	
							<tr>	
								<th colspan="6" bgcolor="#99BBFF">
									<h12>
										Success... You have added the following data to the articles table...
									</h12>
								</th>   
							</tr>   
						</thead>
					</table>
					
					<br>
					
				<?php
					$tablecolour = "#99BBFF"; 
					$loopcount = 1;
				
					if (!empty($_POST))
					{		
						foreach ( $_POST as $key => $value )
						{
							if ( ( !is_string($value) && !is_numeric($value) ) || !is_string($key) )	{	continue;													}
							if (get_magic_quotes_gpc())													{	$value = htmlspecialchars( stripslashes((string)$value) );	}
							else																		{	$value = htmlspecialchars((string)$value);					}
											
		/*	-------------------------------------------------------------------------------------------------------------------------------------------------
			The following variables marry to the following database fields
			1....	(variable)	$articletext 		= 		article_title 			(database)
			2....	(variable)	$journalnumber 		= 		journal_reference 		(database)
			3....	(variable)	$abstracttext		=		article_abstract		(database)
			4....	(variable)	$filenameandpath	=		article_reference		(database)
			5....	(variable)	$authornumber		=		article_author			(database)
			6....	(variable)	$datenumber			=		article_published_date	(database)	format	1234567890

			--------------------------------------------------------------------------------------------------------------------------------------------	*/

							if ($loopcount == 1)		{	$articlename = htmlspecialchars((string)$key);		$articletext = $value;							}	
							elseif ($loopcount == 2)	{	$journalname = htmlspecialchars((string)$key);		$journalnumber = $value;						}	
							elseif ($loopcount == 3)	{	$abstractname = htmlspecialchars((string)$key);		$lvalue = $value;
															
															
															/* 	----------------------------------------------------------------------
																start to beautify the <HTML> output from the text area
																this is probably a workaround, but will do until something 
																better is developed or another editor is used
																
																-----------------------------------------------------------------	*/
															echo "Original abstract in the textarea <p>";
															echo $lvalue . "<p>";
															
															echo "Stripping the head and tail <p>";
															$lvalue = stripheadandtail($value);	
															$abstracttext = $lvalue;		
															echo $abstracttext . "<p>";
															
															$text = $lvalue;
															for($x = 0; $x <= strlen($text); $x++)
																echo substr($text, $x, 1) . " ";
															echo "<p>";

															echo "now using stripslashes<p>";
															$abstracttext = stripslashes( $abstracttext );
															echo $abstracttext . "<p>";
															
															$text = $abstracttext;
															for($x = 0; $x <= strlen($text); $x++)
																echo substr($text, $x, 1) . " ";
															echo "<p>";
															
															echo "now using str_replace<p>";
															$bodytag = str_replace("&lt;/p&gt;&lt;p&gt;", "&lt;/br&gt;", $abstracttext);
															echo $bodytag . "<p>";

															echo "<p><p><p><p><p><p>now starting the first loop - looping for slash p's <p><p><p><hr>";
															
															$text = $abstracttext;
															$textwithbr = "";
															
															for($x = 0; $x <= strlen($text); $x++)
															{
																if (	substr($text, $x, 1) 		== "&" 	&& substr($text, $x + 1, 1) 	== "l"	&&  substr($text, $x + 2, 1) 	== "t"	&& 
																		substr($text, $x + 3, 1) 	== ";" 	&& substr($text, $x + 4, 1) 	== "/"	&& 	substr($text, $x + 5, 1) 	== "p"	&&		
																		substr($text, $x + 6, 1) 	== "&"	&& substr($text, $x + 7, 1) 	== "g"	&& 	substr($text, $x + 8, 1) 	== "t" 	&& 
																		substr($text, $x + 9, 1) 	== ";"																		

																	)

																{	$x = $x + 10;
																	$textwithbr = $textwithbr . "<p>";
																}
																else
																{
																	$textwithbr = $textwithbr . substr($text, $x, 1);
																}
															}
															echo "<p>" . $textwithbr;
															
															echo "<p>end of first loop - looping for slash p's <p><hr>";
															
															echo "<p><p><p><p><p><p>now starting the second loop - looping for p's <p><p><p><hr>";
																														
															$textwithps = $textwithbr;
															$text = "";
															
															for($x = 0; $x <= strlen($textwithps); $x++)
															{
																if (	substr($textwithps, $x, 1) 		== "&" 	&& 
																		substr($textwithps, $x + 1, 1) 	== "l"	&& 
																		substr($textwithps, $x + 2, 1) 	== "t"	&& 
																		substr($textwithps, $x + 3, 1) 	== ";" 	&&
																		substr($textwithps, $x + 4, 1) 	== "p"	&&		
																		substr($textwithps, $x + 5, 1) 	== "&"	&& 
																		substr($textwithps, $x + 6, 1) 	== "g"	&& 
																		substr($textwithps, $x + 7, 1) 	== "t" 	&& 
																		substr($textwithps, $x + 8, 1) 	== ";"																		

																	)

																{	
																	echo "match found in second loop<p>";
																	$x = $x + 8;
																}
																else
																{
																	$text = $text . substr($textwithbr, $x, 1);
																	//$textwithbr = $textwithbr . substr($text, $x, 1);
																}
															}
															echo "text after trhe second loop <p> -- " . $text;
															echo "<p>";
															
//$phrase  = "You should eat fruits, vegetables, and fiber every day.";
															//$string = "An infinite number of</p><p> monkeys";
															//$newstring = str_replace("</p></p>", "<br>", $string);
															//echo $newstring;
															
															//exit();
															
															// look at http://php.net/str_replace
															// and htmlentites
															// and putting htmlspecialchars on the abstracttext
															
															$abstracttext = $text;
															//exit();
														}
							elseif ($loopcount == 4)	{	$filename = htmlspecialchars((string)$key);			$filenameandpath = "./articles/" . $value;		}
							elseif ($loopcount == 5)	{	$authorname = htmlspecialchars((string)$key);		$authornumber = $value;							}
							$loopcount++;
						}
						$datename = "article published on";				
						$datenumber = $_SESSION['time_date_raw'];		
						$datenumberformatted = $_SESSION['time_date_formatted'];			
					}
					?>
						
					<table class="tableindex"> 
						<thead>	
							<tr>	
								<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
									<h12>&nbsp;</h12>	
								</th>	
							</tr>	
						</thead>
									
						<tbody>
							<tr>
								<td width = "25%" bgcolor= <?php echo " $tablecolour " ?> > 		
									<h11>	<?php	echo $articlename;	?>	</h11>
								</td>	
													
								<td width = "25%" >	
									<h11>	<?php echo $articletext; ?>		</h11>
								</td>	
								
								<td width = "25%" bgcolor= <?php echo " $tablecolour " ?> > 		
									<h11>	<?php	echo $journalname;	?>	</h11>
								</td>	
													
								<td width = "25%" >	
									<h11>	<?php echo $journalnumber; ?>		</h11>
								</td>	
								
							</tr>
						</tbody>
						<tfoot>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	<h12>	&nbsp;	</h12>	</th>	</tr>	</tfoot>
					</table>
						
					<br>
						
					<table class="tableindex"> 
						<thead>	
							<tr>	
								<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
									<h12>&nbsp;</h12>	
								</th>	
							</tr>	
						</thead>
									
						<tbody>
							<tr>
								<td width = "25%" bgcolor= <?php echo " $tablecolour " ?> > 		
									<h11>	<?php	echo $filename;	?>	</h11>
								</td>	
													
								<td width = "25%" >	
									<h11>	<?php echo $filenameandpath; ?>		</h11>
								</td>	

							<?php
								$user = new Users;
								$users = $user->fetch_data_on_user_ID($authornumber);
							?>				
								
								<td width = "25%" bgcolor= <?php echo " $tablecolour " ?> > 		
									<h11>	<?php	echo $authorname;	?>	</h11>
								</td>	
													
								<td width = "25%" >	
									<h11>	<?php echo $users['user_name_title'] . " " . $users['user_name_first'] . " " . $users['user_name_last']; ?>		</h11>
								</td>	
								
							</tr>
						</tbody>
						<tfoot>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	<h12>	&nbsp;	</h12>	</th>	</tr>	</tfoot>
					
					</table>					
					
					<br>

					<table class="tableindex"> 
						<thead>	
							<tr>	
								<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
									<h12>&nbsp;</h12>	
								</th>	
							</tr>	
						</thead>
						
						<tbody>
							<tr>
								<td width = "25%" bgcolor= <?php echo " $tablecolour " ?> > 		
									<h11>	<?php	echo $abstractname;	?>	</h11>
								</td>	
													
								<td colspan=3>	
									<h11>	<?php echo htmlentities($abstracttext, $quote_style = null, $charset = "UTF-8", $double_encode = null); ?>		</h11>
								</td>	
							</tbody>
						</tbody>

						<tfoot>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	<h12>	&nbsp;	</h12>	</th>	</tr>	</tfoot>

					</table>			

					<table class="tableindex"> 
						<thead>	
							<tr>	
								<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
									<h12>&nbsp;</h12>	
								</th>	
							</tr>	
						</thead>
						
						<tbody>
							<tr>
								<td width = "25%" bgcolor= <?php echo " $tablecolour " ?> > 		
									<h11>	<?php	echo $datename;	?>	</h11>
								</td>	
													
								<td colspan=3>	
									<h11>	<?php echo $datenumberformatted; ?>		</h11>
								</td>	
							</tbody>
						</tbody>
					
						<tfoot>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	<h12>	&nbsp;	</h12>	</th>	</tr>	</tfoot>
						<br>
					
					</table>
					
					<br>
					
					<table width="700" class="tableindexroundedtopandbottom"> 
						<thead>	
							<tr>	
								<th colspan="6" bgcolor="#99BBFF">
									<h12>
										Your article has been added to the database...
									</h12>
								</th>   
							</tr>   
						</thead>
					
					</table>
					<br>
				</div>
				
			<?php

		/*	-------------------------------------------------------------------------------------------------------------------------------------------------
			The following variables marry to the following database fields
			1....	(variable)	$articletext 		= 		article_title 			(database)
			2....	(variable)	$journalnumber 		= 		journal_reference 		(database)
			3....	(variable)	$abstracttext		=		article_abstract		(database)
			4....	(variable)	$filenameandpath	=		article_reference		(database)
			5....	(variable)	$authornumber		=		article_author			(database)
			6....	(variable)	$datenumber			=		article_published_date	(database)	format	1234567890

			--------------------------------------------------------------------------------------------------------------------------------------------	*/

				$store_data_OK = FALSE;
			
				foreach($articles as $article)
				{
					if(	$article['article_title'] 			== $articletext 		AND
						$article['journal_reference']		==	$journalnumber		AND
						$article['article_abstract']		==	$abstracttext		AND
						$article['article_reference']		==	$filenameandpath	AND
						$article['article_author']			==	$authornumber		AND
						$article['article_published_date']	==	$datenumber)
							{	$store_data_OK = TRUE;		break;	}
					else	{	$store_data_OK = FALSE;				}
				}

				if ($store_data_OK == TRUE)
				{
			?>
					<div class = "Container">
						<div class="CenterContent">
							<h11>
								Sorry, it appears that you have already added this article. Please enter another article or choose another administrative task
								<br><a href = "../../../adminpage6.php" class="trendinglink">Return to the administrative panel</a>
							</h11>
						</div>	
					</div>
			<?php
				}
				else
				{
						
		/*	-------------------------------------------------------------------------------------------------------------------------------------------------
			The following variables marry to the following database fields
			1....	(variable)	$articletext 		= 		article_title 			(database)
			2....	(variable)	$journalnumber 		= 		journal_reference 		(database)
			3....	(variable)	$abstracttext		=		article_abstract		(database)
			4....	(variable)	$filenameandpath	=		article_reference		(database)
			5....	(variable)	$authornumber		=		article_author			(database)
			6....	(variable)	$datenumber			=		article_published_date	(database)	format	1234567890

			--------------------------------------------------------------------------------------------------------------------------------------------	*/				
						
					$article = new Article;				
					$article->store_record_on_DB($articletext, $journalnumber, $abstracttext, $filenameandpath, $authornumber, $datenumber);
					
				}
			}
			
			else
			{
				?>
				<div class = "CenterContent">
				<?php
					echo "<h11>Hello there. <br><br>It appears that you are not a member of staff. 
					<br><br>Members are not allowed in the administration section
					<br><br>Please logout out OR return to the members area<p>";
				?>
					<a href="../../../../logout.php" class = "memberlink">Logout<p>
					<a href="../../../../members.php" class = "memberlink">Return to the members area<p>
				</div>
			<?php
					
			}
		}
		else
		{
			?>
			<div class = "CenterContent">
			<?php
				echo "<h11>Hello there. <br><br>You must be logged into administer this site<p>";
			?>
				<a href="../../../../members.php" class = "memberlink">Return to the members area<p>
			</div>
		<?php
					
		}
			?>
			
		
<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

		<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			
			
<!-- END of PAGE CONTAINER div -->								

	</body>
</html>
