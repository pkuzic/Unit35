<?php

/* IFHS INDEX */ 
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('../includes/article.php');
	include_once ('../includes/connection.php');
		
	$journal = new Journal;
	$journals = $journal->fetch_journal_details();
	$journals2 = $journal->fetch_journal_details();
	
	$user = new Users;
	$users = $user->fetch_researcher_details();
	
	$article = new Article;
	$articles = $article->fetch_all();
	
	$tablecolourbool = 0;
	$tablecolour = 0;
	$tablecount = 0;
		
?>	
	
	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="../../CSS/MainStyles.css">
			
			<?php	include_once('./SetupCKEditorScript2.php');	?>			
			
		</head>

		<body>

			<div class="Container"> 																	<!-- overall page container div -->
				<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
		
				<div class="section-box">	<h12><?php echo "a"; ?></h12>		</div>
				<div class="section-box2">	<h12><?php echo "b"; ?></h12>		</div>
				<div class="section-box3" align="right">	<?php //include_once("memberloginimagemap.php"); ?>		</div>
				<br style="clear: left;" />				
				
			 	<div class = "Menu">		</div>
				
					

<!-- START of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->			

				<div class="PagePurpose">			
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	<h7>	Add an article...</h7> 	</td>	</tr>
					</table>
				</div>
			
			</div>
<!-- END of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->							
			
			<div class="Container">

<?php
				if (isset($_SESSION['logged_in']))
				{
				
/* 	=================================================================================================================================================						
	DEBUGG CODE: Looks to see what has been set in the login logic below
	===============================================================================================================================================	*/
	
						//$_SESSION['logged_in_as_a_user'] = TRUE;	// DEBUGGING - forces the else, just for testing
						
					if($_SESSION['logged_in_as_member'] == false && $_SESSION['logged_in_as_a_user'] == true)
					{
?>			
						<div class="CenterContent">
							<h11> 
								List of centre publications that already exist	
								<small>
									** PLEASE NOTE - that your NEW article title must be unique! 
								</small>	
								<br><br>
					
								<select onchange="this.form.submit();" name="id" size="10" style = "width: 100% !important; min-width: 100%; max-width: 100%;">
							<?php 
									foreach($articles as $article)
									{
							?>
										<option value = "<?php echo $article['article_id']; ?>">
									<?php	echo $article['article_title'];	?>
										</option>
							<?php		
									}
							?>
								</select>
								<br><br>
								<hr>
							</h11>
<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
This form is sent to the posted data page
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>

							<form action="../../CKEditorFiles/Editor/samples/sample_posteddata.php" method="post">
			
								<h11>
									Please input the details for the new article 
									<small>** PLEASE NOTE - ALL fields must be completed </small>
									<br>
									<hr><br>	
<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
We want to get the NEW article title first of all. This will be eventually validated in the posteddata.php
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>							
									Please enter the title of the NEW article <br>	
									<input type = "text" name="new_article_title" size=90/>
									<br><br>
									<hr><br>							
<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
We want to get the the number of the journal that this article belongs too. 
This will involve loading the journals into a dropbox and allowing the user to pick a journal
When this is done, we will have the journal ID
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>									
									What journal does this article belong to?	<br> 
									<select name="journal_number" style = "width: 72% !important; min-width: 72%; max-width: 72%;">
									<?php 
										foreach($journals as $journal)
										{	
									?>
											<option value = "<?php echo $journal['journal_id']; ?>">
											<?php
												echo $journal['journal_name'] . " :: published - " . date('l jS F Y', $journal['journal_published_date']);
											?>
											</option>
									<?php		
										}
									?>
									</select> 
									<br><br>
									<hr><br>
<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
We want to allow the user to enter an abstract. This is done via CKEditor
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>									
									Please enter the NEW article abstract<br>
									<textarea cols="80" id="editor1" name="editor1" rows="10">	
									</textarea>
				
									<?php include_once ('CKEditorReplaceScript.php');	?>

									<br><br>
									<hr><br>
<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
We now want to get the user to enter the file name (from the server). We will eventually involve an FTP upload feature 
to allow the user to upload the file from the particular folder on the localdisk to the server
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>									
									Please enter the path to the full article (PDF) &emsp;&emsp; 
									<input type="file" name="New_article_path"> 
									<br><br>	
									<hr><br>

<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
We want to allow the user to select a person from the user list - only users (Prof, Dr, and Mr - researchers) are allowed to 
enter articles onto the databases. This is done through a list box
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>							
									Please enter the publisher of this article <br>
									<select name="article_author" style = "width: 72% !important; min-width: 72%; max-width: 72%;">
							<?php 
										foreach($users as $user)
										{	
											if ($user['user_research_area'] != "NA") 
											{
							?>
												<option value = "<?php echo $user['user_id']; ?>">
							<?php
													echo 	$user['user_name_title'] . " " . 
															$user['user_name_first'] . " " . 
															$user['user_name_last'] . " ";
							?>
												</option>
							<?php		
											}
										}
							?>
									</select> 
									<br><br>
									<hr><br>
<?php	
/*	------------------------------------------------------------------------------------------------------------------------------------------
We will ge the date from a javascript calendar control
--------------------------------------------------------------------------------------------------------------------------------------	*/
?>							
									This article will be published with the following datestamp &emsp;&emsp;
									
							<?php	$ts = time();					
									$datestring = date('l jS F Y', $ts);
									$_SESSION['time_date_raw'] = $ts;
									$_SESSION['time_date_formatted'] = $datestring;
									echo "    " . $datestring;
							?>
									<p>
									
									<input type="submit" value="Submit">	
							</form>
		
						</div>

						<br style="clear: left;" />
<?php				}
					
					elseif($_SESSION['logged_in_as_member'] == TRUE && $_SESSION['logged_in_as_a_user'] == FALSE)
					{
?>
						<div class = "CenterContent">
						<?php
							echo "	<h11>Hello there. <br><br>It appears that you are not a member of staff. 
									<br><br>Members are not allowed in the administration section
									<br><br>Please logout out OR return to the members area<p>";
						?>
							<a href="logout.php" class = "memberlink">Logout<p>
							<a href="../../members.php" class = "memberlink">Return to the members area<p>
						</div>
					<?php
					}
				}
				
				else				// not logged in
				{
?>
					<div class = "CenterContent">
<?php
						echo "	<h11>Hello there. <br><br>It appears that you are not a logged in. 
									<br><br>You must log into the system to use administration features
									<br><br>Please visit the to the administration page...
									<br><br>If you are a not an employee of the centre, please visit our members section to login;
									<br><br>Or, please visit our registration page to become a member (registration is FREE)<p><p><p>";
?>
						<a href="../../members.php" class = "memberlink">Members area</a><p>
						<a href="../../registration.php" class = "memberlink">Registeration</a><p>
						<a href="adminpage.php" class = "memberlink">Return to the admin area</a><p>
							
					</div>
							
<?php
				}
?>				
			</div>
<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			
		
<!-- END of PAGE CONTAINER div -->								

		</body>
	</html>
