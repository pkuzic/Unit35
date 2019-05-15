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

	$news = new News;
	$newss = $news->fetch_news_stories_decending();		// load all news articles into memory
	
	$number_of_articles = 0;
	foreach ($newss as $news)	
	{
		$number_of_articles++;		// calculate the number of articles to be shown (will be used in the footer of the tables)
	}

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

?>	
	
	<html>

		<head>
			<?php 
				include_once 'includes/head.php'
			?>
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "NO";
			$_SESSION['MEMBERPAGEYN'] = "YES";
			
			$_SESSION['Page_Purpose'] = "news";
			include_once("./CommonPages/PagePurpose.php");
		?>	
<?php
/*	########################################################################################################################################
	Start a table that will simple output all of the news articles on the DB	
	The first table we output is a general round-corner tablethat hold a sort
	of heading for the table that follows
	##################################################################################################################################### */
?>			
			<div class="Container">
				<table width="700" class="tablewithroundedtopandbottom"> 
					<thead>	
						<tr>	
							<th colspan="6" bgcolor=<?php echo $TableColour1; ?> >
								<h12>
									&nbsp;<br>Our latest news (<em>newest story first</em>)...<br>&nbsp;
								</h12>
							</th>   
						</tr>   
					</thead>
				</table>
				<br>

<?php
/*	########################################################################################################################################
	Now put all of the news articles out in a tabular format
	##################################################################################################################################### */
?>	
			<?php
				foreach ($newss as $news)
				{
					if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
					else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
			?>

<?php
/*	########################################################################################################################################
	Show a table with collapsed border - a solid table
	##################################################################################################################################### */
?>				
					<table class="StyledTable1"> 
						<thead>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
											<h12>&nbsp;</h12>	
										</th>   
								</tr>   
						</thead>

						<tbody>	
							<tr>	
								<td bgcolor= <?php echo " $tablecolour " ?> > 		
									<h10>
									<?php 	
										$news_title_string = 	$news['news_title'] . " "; 
										echo $news_title_string;
									?>
									</h10>
								</td>	
								
								<td bgcolor= <?php echo " $tablecolour " ?> > 		
									<h10>	&nbsp;	</h10>
								</td>
							
																 		
							<?php
								$poster = $news['news_posted_by'];
								$poster_string = 	"Posted by " . 	$user_array_title[$poster] .
													" " . 			$user_array_first_name[$poster] . 
													" " . 			$user_array_last_name[$poster] .
													"<br> on the " .	date('l jS F Y', $news['news_posted_date']);
								
								if ($tablecolourbool == 1)
								{
									echo "<td bgcolor= '$tablecolour' align='right' width ='30%'><small><em>" . $poster_string . "</em></small></td>";					
								}
								else 
								{	
									echo "<td bgcolor= '$tablecolour' width ='30%'><small2><em>" . $poster_string . "</em></small2></td>";					
								}			
							?>
							</tr>

							<tr>	<td bgcolor= <?php echo " $tablecolour " ?> colspan="6"> 		
										<h11>
										<?php	echo $news['news_body'];	?>
										</h11>	
									</td>	
							</tr>
														
							<tr>	
								<td bgcolor = <?php echo " $tablecolour " ?> colspan="6"> 		
									&nbsp;	
								</td>		
							</tr>															
						</tbody>
						
				<?php	$tablecount++;		?>
							
						<tfoot>	
							<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >
										<h12>	
										<?php	echo "Showing ($tablecount) of ($number_of_articles) news articles"; ?> 
										</h12>
									</th>    
							</tr>   
						</tfoot>
					</table>
					
					<br>						
				<?php	
				}
				?>
				
				<table class="tablewithroundedtopandbottom"> 
					<tfoot>	
						<tr>	<th colspan="6" bgcolor = <?php echo $TableColour1; ?> >
								<h12>
									&nbsp;<br>End of current news<br>&nbsp;
								</h12>
								</th>    
						</tr>   
					</tfoot>
				</table>
			</div>
			<br style="clear: left;" />

<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			
		
<!-- END of PAGE CONTAINER div -->								

		</body>
	</html>
