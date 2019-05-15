<?php

/*	########################################################################################################################################
	Start the session - this will enable the setting of the following $_SESSION variables
	
	$_SESSION['Page_Purpose'] = "index" - indicates that we are currently displaying the HOME page;
	
	##################################################################################################################################### */
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}

/*	########################################################################################################################################
	Include the Php libraries
	
	article.php		- contains all of the classes that are used throughout the solution
	connection.php	- connects to the DB

	##################################################################################################################################### */

	include_once ('./CMS/includes/article.php');
	include_once ('./CMS/includes/connection.php');
		
	$article = new Article;
	$articles = $article->fetch_all();					// load all articles into memory
	
	$journal = new Journal;
	$journals = $journal->fetch_journal_details();		// load all journals into memory
	$journalcount=0;
	
	foreach ($journals as $journal)							// cycle through the data (from the DB table) and put it into the appropriate arrays
	{
		$journalcount++;
	}
	
	$_SESSION['minnumberofjournals'] = 1;
	$_SESSION['maxnumberofjournals'] = $journalcount;
	
	
/*	########################################################################################################################################
	We want to load all of the used (staff members) into memory - just the title, first name and last name
	we want to do this to show who wrote the article in the news section.
	##################################################################################################################################### */
	
	$user_array_title = array();
	$user_array_first_name = array();
	$user_array_last_name = array();
	
	$usercount = 0;
	$user = new Users;
	$users = $user->fetch_researcher_details();			// load all users (staff) into memory
		
	foreach ($users as $user)							// cycle through the data (from the DB table) and put it into the appropriate arrays
	{
		$user_array_title[$usercount] = $user['user_name_title'];
		$user_array_first_name[$usercount] = $user['user_name_first'];
		$user_array_last_name[$usercount] = $user['user_name_last'];
		$usercount++;
	}
	
/*	########################################################################################################################################
	We want to see the current journal that is to be displayed. The first time round (when the page initialliy loads)
	this will be nothing - nothing is selected. However, when a journal is selected we load SELF again with an ID in the URL
	if this URL ID is set then we want to load that particulat journal, then show all the articles assoiated with that journal
	##################################################################################################################################### */	
	
	if (isset($_GET['prevnext']))
	{
		if ($_GET['prevnext'] == "1")
		{
			$_SESSION['big_journal_number'] = $_SESSION['minnumberofjournals'];
			$_SESSION['current_journal_number'] = $_SESSION['minnumberofjournals'];	
		}
		
		else if ($_GET['prevnext'] == "prev")
		{
			if(isset($_SESSION['current_journal_number']))
			{
				if ($_SESSION['current_journal_number'] > $_SESSION['minnumberofjournals'])		
					$_SESSION['current_journal_number'] = $_SESSION['current_journal_number'] - 1;
				else																			
					$_SESSION['current_journal_number'] = $_SESSION['minnumberofjournals'];
			}	
			
			else																				
				$_SESSION['current_journal_number'] = $_SESSION['minnumberofjournals'];

		}
		
		else if ($_GET['prevnext'] == "next")
		{
			if(isset($_SESSION['current_journal_number']))
			{
				if ($_SESSION['current_journal_number'] < $_SESSION['maxnumberofjournals'])					
					$_SESSION['current_journal_number'] = $_SESSION['current_journal_number'] + 1;
				else
					$_SESSION['current_journal_number'] = $_SESSION['maxnumberofjournals'];
			}	
			
			else			
				$_SESSION['current_journal_number'] = $_SESSION['maxnumberofjournals'];
			
		}
		
		if ($_GET['prevnext'] == "show")
		{
			if(isset($_SESSION['big_journal_number']))
			{
				$_SESSION['big_journal_number'] = $_SESSION['current_journal_number'];
			}	
			
			else			
				$_SESSION['big_journal_number'] = $_SESSION['minnumberofjournals'];
		}
	}
	
	else
	{
		$_SESSION['current_journal_number'] = 1;
		$_SESSION['big_journal_number'] = 1;
	}
	
?>	
	
	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">
			<link rel="stylesheet" type="text/css" href="./CSS/bootstrap.css">
			
			<?php	
				include_once('./SetupCKEditorScript1.php');	// this include allows us to use the CKEditor for displaying the text (abstract) - not sure why
			?>		
			
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "NO";
			$_SESSION['MEMBERPAGEYN'] = "YES";
			
			$_SESSION['Page_Purpose'] = "journal";
			include_once("./CommonPages/PagePurpose.php");
		?>	

			<div class="Container">
			<?php
				include_once("./CommonPages/JournalNavigation.php");
			?>	
			
			</div>
		
			<div class="Container">
				<div class="section-box">
				
				<?php
					foreach ($journals as $journal)
					{
						if ($journal['journal_id'] == $_SESSION['current_journal_number'])
						{
							if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
							else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
				?>
<?php	
	/*	-------------------------------------------------------------------------------------------------------------------------------------------------
		This table outputs the number of journals down the left-hand-side of the page - There are three parts to the loop
			(1)......The head part of the table. Rounded at the top corners (contains the title of the journal, volume & issue and date published)
			(2)......The image (thumbnail)
			(3)......The footer with the abstract of the journal and a looking glass to denot a link to view the article
	-------------------------------------------------------------------------------------------------------------------------------------------------	*/
?>

<?php
/*	########################################################################################################################################
	Firstly put out the details of the joiurnal, date published, title and valume/issue
	##################################################################################################################################### */	
?>
							<table class="JournalsTable"> 			

<?php	// (1) - The head part of the table. Rounded at the top corners (contains the title of the journal, volume & issue and date published) 	?>			

								<thead>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >		
												<?php 	$name_string = "<h12>" . 	"Vol: " . $journal['journal_volume'] . " " . 
																					"Iss: " . $journal['journal_issue'] . " " .
																					$journal['journal_name'] . "<br>" .
																					date('l jS F Y', $journal['journal_published_date']) . 
																		"</h12>";
														echo "&nbsp;<br>" . $name_string . "<br> &nbsp;";
												?>
										</th>	</tr>
								</thead>

<?php	// (2)......The image (thumbnale)	?>										

								<tbody>	
									<tr>		<td colspan="6" align="center"> 		
												<?php 	$imagestring = $journal['journal_image']; ?>
														<img border="0" <?php echo "src = $imagestring"; ?> align="center" width="124" height="190">	
												</td>	
									</tr>
								</tbody>
							
						<?php	$tablecount++;		?>
<?php
/*	########################################################################################################################################
	We are stripping out any last <p>'s so that we can just display the text from the DB field in a normal TD
	##################################################################################################################################### */	
?>

<?php	// (3)......The footer with the abstract of the journal and a looking glass to denote a link to view the article	?>																	

						<?php							
								$journalabstracttextwithps = $journal['journal_abstract'];
								$text = "";
															
								for($x = 0; $x <= strlen($journalabstracttextwithps); $x++)
								{
									if	( 	substr($journalabstracttextwithps, $x, 1) 		== "<" 	&& 
											substr($journalabstracttextwithps, $x + 1, 1) 	== "p"	&& 
											substr($journalabstracttextwithps, $x + 2, 1) 	== ">"	
										)	{	$x = $x + 4;															}
									else	{	$text = $text . substr($journalabstracttextwithps, $x, 1);				}
								}	
					
								$journalabstracttextstripped = $text;
					?>
								<tbody>											<?php // now show the stripped text in the TD ?>
									<tr>	<td colspan="6" >
												<div class="CenterContent">
												<?php 	
													echo "<h11><small><i>" . $journalabstracttextstripped . "</i></small></h11>";	
												?>
												</div>
											</td>
									</tr>
								</tbody>

								<tfoot>	
									<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >
												&nbsp <br><br>
											</th>    
									</tr>   
								</tfoot>
							</table>
							<br> <hr> <br>
			<?php	}
				}	
			?>
				
			</div>
			
			<div class="section-box2">	&nbsp; &nbsp; </div>
				
<?php	
	/*	-------------------------------------------------------------------------------------------------------------------------------------------------
		This table outputs the specific journals down the right-hand-side of the page - There are three parts to the loop
			(1)......The head part of the table. Rounded at the top corners (contains the title of the journal, volume & issue and date published)
			(2)......The image (large image)
			(3)......blank
	-------------------------------------------------------------------------------------------------------------------------------------------------	*/
?>				
				<div class="section-box3">		
				
				<?php

					$tablecolourbool = 0;
						
					foreach ($journals as $journal)					// start a loop to cycle through the journal list
					{
						
						if ($journal['journal_id'] == $_SESSION['big_journal_number'])		// if we have found the journal
						{
							
							$tablecolour = $TableColour1;
				?>

<?php	// (1)	?>										
							<table class="JournalsTable">												 
								<thead>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >		
												<?php 	$name_string = "<h11>" . 	"Vol: " . $journal['journal_volume'] . " " . 
																					"Iss: " . $journal['journal_issue'] . " " .
																					$journal['journal_name'] . "<br>" .
																					date('l jS F Y', $journal['journal_published_date']) . 
																		"</h11>";
														echo "&nbsp; <br>". $name_string . "<br>&nbsp;";
												?>
										</th>	</tr>
								</thead>
<?php	// (2)	?>																			
								<tbody>	
									<tr>	<td colspan="6" align="center"> 		
											<?php 	$imagestring = $journal['journal_image']; ?>
													<img border="0" <?php echo "src = $imagestring"; ?> align="center" width="324" height="390">	
											</td>	
									</tr>
								</tbody>
<?php	// (3)	?>																												
								<tfoot>	
									<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >
												&nbsp <br><br>
											</th>    
									</tr>   
								</tfoot>
							</table>		
				<?php
						}
					}
				?>
				<p>
<?php	
	/*	-------------------------------------------------------------------------------------------------------------------------------------------------
		This table outputs the specific journal articles underneath the journal image and consists of three parts
			(1)......a PDF icon
			(2)......a blank column
			(3)......the article - with the author and date
	-------------------------------------------------------------------------------------------------------------------------------------------------	*/
?>		
					<hr><br>
					<table class="ArticlesTable" colspan="5">
						<thead>	<tr>	<th colspan="6" bgcolor= <?php echo $TableColour1; ?>>
											
											<h12>
												&nbsp;<br>Current articles for this journal (<em>Note: visited links will dim</em>)<br>&nbsp;
											</h12>
										</th>    
								</tr>   
						</thead>
			
					<?php
					
						$tablecolourbool = 0;
						
						foreach ($articles as $article)
						{
							if($article['journal_reference'] == $_SESSION['big_journal_number'])		// get the journal reference from the current article 
							{
								if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
								else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
					?>
<?php	// (1)	?>																			
								<tr>	<th bgcolor = <?php echo "$tablecolour" ?> >
											<h12>	
												<img border="0" src = "./images/PDFIcon.png" align="center" width="45" height="45">	
											</h12>	
										</th>    
<?php	// (2)	?>																													
										<th width="2%" bgcolor = <?php echo "$tablecolour" ?>>
											<h12>	&nbsp;	</h12>	
										</th>    
<?php	// (3)	?>
										<th bgcolor = <?php echo "$tablecolour" ?> >
											<h12>
											<?php 	
												$linkstring = 	"<a href = displayarticle.php?id=" . 
																$article['article_id'] . " class='trendinglink'>" . 
																$article['article_title'] . 
																"</a>";
												echo $linkstring;
												
												$poster = $article['article_author'];
												echo "</i><br><br><i>";
												$article_written_by_string = 	$user_array_title[$poster] . " " .
																				$user_array_first_name[$poster] . " " . 
																				$user_array_last_name[$poster] . " " .
																				date('l jS F Y', $article['article_id']);
																				
												
																																
												if ($tablecolourbool == 1)
												{
													echo "<small><em>" . $article_written_by_string . "</em></small>";					
												}
												else 
												{
													echo "<small2><em>" . $article_written_by_string . "</em></small2>";					
												}
											?>
											<br><br>

											</h12>	
										</th>    
								</tr>
			<?php
							}
						}
			?>
						<tfoot>	
							<tr>	
								<th colspan="6" bgcolor= <?php echo $TableColour1; ?> >
									<h12>
										<br>&nbsp;<em>end of article list ...</em><br>&nbsp;
									</h12>
								</th>    
							</tr>   
						</tfoot>
					</table>
				</div>
				
														
				<br style="clear: left;" />
			</div>
			<p>
			
<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			

<!-- END of PAGE CONTAINER div -->								

		</body>

	</html>

				