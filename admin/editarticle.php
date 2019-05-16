<?php

/* IFHS INDEX */ 
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('../includes/article.php');
	include_once ('../includes/connection.php');

	$article = new Article;
	$articles = $article->fetch_all();
		
	$user = new Users;
	$users = $user->fetch_researcher_details();
	$usercount = 0;
	
	$user_array_title = array();
	$user_array_first_name = array();
	$user_array_last_name = array();
	
	foreach ($users as $user)
	{
		$user_array_title[$usercount] = $user['user_name_title'];
		$user_array_first_name[$usercount] = $user['user_name_first'];
		$user_array_last_name[$usercount] = $user['user_name_last'];
		$usercount++;
	}
	
	$tablecolourbool = 0;
	$tablecolour = 0;
	$tablecount = 0;
		
?>	
	
	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="../CSS/MainStyles.css">
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
						<tr>	<td align="left" colspan="6">	<h7>	Edit an article...</h7> 	</td>	</tr>
					</table>
				</div>
			
			</div>
<!-- END of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->							
			
			<div class="Container">
<?php
				if (isset($_SESSION['logged_in']))
				{
				
/* 	=================================================================================================================================================						
	Firstly, we want to see if the person issuing a delete instruction is a member of staff
	member = members of the public
	user = member of staff
	===============================================================================================================================================	*/
					
					if($_SESSION['logged_in_as_member'] == false && $_SESSION['logged_in_as_a_user'] == true)
					{
?>
						<div class="container">
							<br />
							<div class = "CenterContent">
<?php
/*	----------------------------------------------------------------------------------------------------------
	Find the longed article details in the box. To do this we want to cycle through all of the strings in the 
	databse (the articles) and find the length of the longest title. this will dictate how many ---- we use
	to separate each entry	(this will also include the poster and date details)
	-----------------------------------------------------------------------------------------------------	*/

								$longeststring = 0;		$currentstringlength = 0;	$numofarticles = 0;
										
								foreach($articles as $article)
								{
									$poster = $article['article_author'];
									$articlenumber = $article['article_id'];
										
									$poster_string = 	"Posted by " . 
														$user_array_title[$poster] . " " . 
														$user_array_first_name[$poster] . " " . 
														$user_array_last_name[$poster] .	
														" on the " .	
														date('l jS F Y', $article['article_published_date']);
															
									$articlestring = 	"[ " . $articlenumber . " ] " . 
														substr($article['article_title'], 0, 60) . 
														" ....[truncated...] - " . $poster_string;
															
									$currentstringlength = strlen($articlestring);
							
									if($currentstringlength > $longeststring)			
										$longeststring = $currentstringlength;
									$numofarticles++;
								}

								echo "<h11>Please select an article to delete <p><p><p>";			// the text above option box
?>
								
								<div class="styled-select" align="center">
									<select width="700" onchange="this.form.submit();" name="id">
<?php 
										$tablecolourbool == 0;	$numofarticles_secondround = 0;
											
										foreach($articles as $article)
										{
											$poster = $article['article_author'];
											$articlenumber = $article['article_id'];
												
											$poster_string = 	"Posted by " . 	
																$user_array_title[$poster] . " " . 
																$user_array_first_name[$poster] . " " . 
																$user_array_last_name[$poster] .	
																" on the " .	
																date('l jS F Y', $article['article_published_date']);
																
											$articlestring = "[ " . $articlenumber . " ] " . 
																	substr($article['article_title'], 0, 60) . 
																	" ....[truncated...] - " . $poster_string;

											if($tablecolourbool == 0)
											{
?>
												<optgroup style="color:SlateGrey;">
													<option value = "<?php echo $article['article_id']; ?>">
<?php 													
														echo 	"<a href = '../displayarticle.php?id=" . 
																$article['article_id'] . ">" . 
																$articlestring . 
																"</a>"; 
?> 
													</option>
												</optgroup>
<?php
												$tablecolourbool = 1;		
											}
												
											else
											{
?>
												<optgroup style="color:SlateGrey;">
													<option value = "<?php echo $article['article_id']; ?>">
														<?php echo $articlestring; ?> 
													</option>
												</optgroup>
<?php
												$tablecolourbool = 0;
											}
									
											$dashline = "";
											for ($x = 0; $x<($longeststring - 25); $x++)
												$dashline = $dashline . "_";
											
											$numofarticles_secondround++;		
									
											if ($numofarticles_secondround < $numofarticles)		// should eliminate the bottom line
											{
?>
												<optgroup style="color:RED;">
													<option class="select-dash" disabled="disabled">	<?php echo $dashline ?> </option>
												</optgroup>
<?php		
											}
										}
?>
									</select>
								</div>
								
					
					
								<div class = "CenterContent">
								<?php
									echo "<br><br><hr><h11>Not what you want to do? <br><br>Choose one of the following options <br><br>";
								?>
									<a href="../members.php" class = "memberlink">Visit the members area</a>
									.... [OR] ....
									<a href="adminpage.php" class = "memberlink">Return to the admin area</a><p>
								</div>
							</div>
						</div>
<?php				}
				}
					
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
						<a href="../members.php" class = "memberlink">Return to the members area<p>
					</div>
<?php
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
								<br><br>Or, please visit our registration page to become a member (registration is FREE)<p><p><p></h11>";
?>
						<a href="../members.php" class = "memberlink">Members area</a><p>
						<a href="../register.php" class = "memberlink">Register as a member <small>(this is free) </small></a><p>
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
