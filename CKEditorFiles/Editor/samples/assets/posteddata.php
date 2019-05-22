
<?php

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
	<?php 
	include_once '../../../includes/head.php'
	?>


</head>

<body>	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	
	<link rel="stylesheet" type="text/css" href="../../../CSS/MainStyles.css">
	<link rel="stylesheet" type="text/css" href="../../../CSS/bootstrap.css">
	
	<?php
	$_SESSION['ADMINPAGEYN'] = "NO";
	$_SESSION['MEMBERPAGEYN'] = "YES";

	$_SESSION['Page_Purpose'] = "journal";

			include_once("../../../includes/header.php");
			include_once("../../../includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
			include_once("../../../includes/variables.php"); //new pagepurpose.php to identify the purpose
			?>	


			<?php


		function stripheadandtail($stringtostrip)  //Receives a string that comprises of a page. 1 is the start <html> and <body> tags
												   //2. is the main body of text, which is needed later to display and 3. is the ending tags. 
		{
			$temp = "";
			$temp = substr($stringtostrip, 96); //Strips the content that we are not intrested in. 
			$temp = substr($temp, 0, strlen($temp) - 42);  
			return $temp;
		}

		?>

		<div class="Container">		
			<!-- header -->	
			<div class="container-fluid">
				<div class="row">
					<?php 
					include_once '../../../includes/leftside.php'
					?>

					<div id="wrapper" class="col-md-8 text-left">

						<div class="PagePurpose">			

							<table border="0" width="100%">
								<tr>										
									<td align="left">
										<div class="alert alert-info" role="alert">											
											<?php echo $Title_Text;	?> 	
										</div>
									</td>	
								</tr>
							</table>
						</div>

						<div class="StyledTable1 alert"> <?php // Main block inside of wrap. Duplicate if required ?>
						<div class="Container">

							<?php

							if (isset($_SESSION['logged_in']) == true)
							{
								if($_SESSION['logged_in_as_member'] == FALSE && $_SESSION['logged_in_as_a_user'] == TRUE)
								{
									?>
									<div class="container">

										<table width="500" class="tableindexroundedtopandbottom"> 
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
												if (get_magic_quotes_gpc())													
												{	
													$value = htmlspecialchars( stripslashes((string)$value) );	
												}
												else																		
												{	
													$value = htmlspecialchars((string)$value);					
												}

		/*	
			The following variables marry to the following database fields
			1....	(variable)	$articletext 		= 		article_title 			(database)
			2....	(variable)	$journalnumber 		= 		journal_reference 		(database)
			3....	(variable)	$abstracttext		=		article_abstract		(database)
			4....	(variable)	$filenameandpath	=		article_reference		(database)
			5....	(variable)	$authornumber		=		article_author			(database)
			6....	(variable)	$datenumber			=		article_published_date	(database)	format	1234567890  */

			if ($loopcount == 1)		{	$articlename = htmlspecialchars((string)$key);		$articletext = $value;							}	
			elseif ($loopcount == 2)	{	$journalname = htmlspecialchars((string)$key);		$journalnumber = $value;						}	
			elseif ($loopcount == 3)	{	$abstractname = htmlspecialchars((string)$key);		$lvalue = $value;
				
				
																
													$lvalue = stripheadandtail($value);	
													$abstracttext = $lvalue;		
																
													$text = $abstracttext;
													$textwithbr = "";
																
												for($x = 0; $x <= strlen($text); $x++)
													{
													if (substr($text, $x, 1) 		== "&" 	&& 
																		substr($text, $x + 1, 1) 	== "l"	&&  
																		substr($text, $x + 2, 1) 	== "t"	&& 
																		substr($text, $x + 3, 1) 	== ";" 	&& 
																		substr($text, $x + 4, 1) 	== "/"	&& 	
																		substr($text, $x + 5, 1) 	== "p"	&&		
																		substr($text, $x + 6, 1) 	== "&"	&& 
																		substr($text, $x + 7, 1) 	== "g"	&& 	
																		substr($text, $x + 8, 1) 	== "t" 	&& 
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
																			$x = $x + 8;
																		}
																		else
																		{
																			$text = $text . substr($textwithbr, $x, 1);
																			
																		}
																	}

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
							<br><a href = "../../../../CMS/admin/adminpage.php" class="trendinglink">Return to the administrative panel</a>
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
			
		</div>

	</div>

</div>
<div class="sidenav col-md-2 sidenav navbar-light"> <!-- Side bar! -->
	Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies vestibulum luctus. Aenean tincidunt eget felis vel maximus. Nunc id sapien elementum, sagittis quam luctus, dictum nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas, augue non cursus sodales, felis tortor dictum elit, fringilla rutrum turpis ex ac libero. Nullam at ipsum laoreet dui blandit finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent auctor iaculis elit eu interdum. Maecenas at libero id ante placerat imperdiet. Quisque vitae cursus ligula. Cras ac scelerisque dui.
</div>

<br style="clear: left;" />
</div>
</div>
</div>
</div>


<!-- END of MAIN BODY div -->								

<!-- END of PAGE CONTAINER div -->								

</body>

</html>