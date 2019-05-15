<?php 

	// mp5 and blowfish
	// echo md5('password');
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('./CMS/includes/connection.php');
	include_once ('./CMS/includes/article.php');
	
	$x = 0;
	$member = new Member;
	$skip = 0;
	$fillboxes = 0;

?>	

	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">

	<!-- START of MEMBERSPAGE STYLES -->		
			
			<link rel="stylesheet" type="text/css" href="./CSS/MemberPageStyles.css">

			
	<!-- END of MEMBERSPAGE STYLES -->
		
		</head>

		<body>

			<div class="Container"> 																	<!-- overall page container div -->
				<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
			 	<div class = "Menu">		</div>
			

<!-- START of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->			

				<div class="PagePurpose">			
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">		
								<h7>	Register as a new members of this site...</h7> 	
								</td>	
						</tr>
					</table>
				</div>
			

<!-- END of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->							
			
			<?php				
				if (isset($_SESSION['logged_in']) == true)
				{
					//<script type="text/javascript">	alert("in the logged in if part");	</script>
			?>						
					<div class = "CenterContent">
						<a href="members.php" class="trendinglink">Click here to return to the members area</a>
					</div>
			<?php			
				}
			
				else
				{	?>   <!--<script type="text/javascript">	alert("Not logged in");	</script> -->   <?php
								
					if (isset($_POST['member_name_title'], $_POST['member_name_first'], $_POST['member_name_last'], $_POST['username'], $_POST['password'], $_POST['email']))
					{
						$member_name_title 	= $_POST['member_name_title'];		
						$member_name_first 	= $_POST['member_name_first'];
						$member_name_last 	= $_POST['member_name_last'];			
						$member_username 	= $_POST['username'];
						$member_password 	= $_POST['password'];					
						$member_email 		= $_POST['email'];				
						$member_username 	= strtolower($member_username);
						$member_email 		= strtolower($member_email);
						
						if (isset($_POST['newsletterY']))	$member_newsletter_YN 	= "Y";	// if we didn't select the newsletter then it won't be posted in the if above so that means NO
						else								$member_newsletter_YN	= "N";
												
						$time_now = time();
						$time_next_year = $time_now + ((7 * 24 * 60 * 60) * 52);
					
						//$query = $pdo->prepare("SELECT * FROM members WHERE username = ?");
						//$query->bindValue(1, $member_username);
						//$query->execute();
								
						//$num = $query->rowCount();
						
						$num = $member->find_member($member_username);			// returns the number of rows in the DB related to the query
						
						if ($num >= 1)	
						{	
						?>	
							<script type="text/javascript">	
								alert("\tThe username already exists...\n\n Please select a different username\n\n");
							</script>

						<?php
							$fillboxes = 1;
						}
						
						else
						{	?> <!--	<script type="text/javascript">	alert("No match on the database");	</script>	--> <?php																		
							// IMPORTANT -- http://php.net/manual/en/pdo.prepared-statements.php
													
							if ($member_newsletter_YN == "Y")
								$members = $member->store_member_data(	$member_name_title, $member_name_first, $member_name_last,
																		$member_username, $member_password, $time_now, $time_next_year, $member_email, "Y");
							else 
								$members = $member->store_member_data(	$member_name_title, $member_name_first, $member_name_last,
																		$member_username, $member_password, $time_now, $time_next_year, $member_email, "N");
							
							if ($members == 0)				// everything not OK in storage						
							{
							?>		
								<script type="text/javascript">	
									alert("\t\t\t\tPlease check your details.\n\n" + "Username and passwords must be a minimum of 8 characters \n\n" + "\t\t\tand a valid email must be entered\n\n");	
								</script>	
							<?php
							}
							$skip = $members;
						}						
					}
					
					if ($skip == 0)				// whether we show the form or not
					{
					?>									
						<div class="CenterContent">
							<form action="register.php" method="post" autocomplete="off">
								<h11>	
									Please input your details	<small>** PLEASE NOTE - ALL fields must be completed </small>	
									<br><br>
									
									Please enter your title <small>(Mr. Miss. Ms. Mrs. Dr. Prof.) </small> <br>
									<input type = "text" 		name = 	"member_name_title"	size = 90 <?php if($fillboxes == 1)	echo "value = $member_name_title";	?>	/>	
									<br><br>
									
									Please enter your first name <br>
									<input type = "text" 		name = 	"member_name_first" size = 90 <?php if($fillboxes == 1)	echo "value = $member_name_first";	?>	/>	
									<br><br>
									
									Please enter your last name <br>
									<input type = "text" 		name = 	"member_name_last" 	size = 90 <?php if($fillboxes == 1)	echo "value = $member_name_last";	?>	/>	
									<br><br>
								
									Please enter a username <small>(8 or more characters - numbers, letters and symbols suggested) </small> <br>
									<input type = "text" 		name = 	"username" 			size = 90 <?php /* we want to blank out this box so don't fill it */	?>	/>	
									<br><br>
									
									Please enter a password  <small>(8 or more characters - numbers, letters and symbols suggested) </small> <br> 					
									<input type = "text" 		name = 	"password" 			size = 90 <?php /* we want to blank out this box so don't fill it */	?>	/>	
									<br><br>
									
									Please enter your email address  <small>(your_mail_address@your_domain  - e.g.info@yahoo.co.uk) </small> <br>					
									<input type = "text" 		name = 	"email" 			size = 90 <?php if($fillboxes == 1)	echo "value = $member_email";		?>	/>
									<br><br>
									
									<input type	= "checkbox" 	name=	"newsletterY" 
									<?php 	
										if($fillboxes == 1)	
										{ 
											if (isset($_POST['newsletterY']))	echo "checked";
										}
									?>	
									
									
									Would you like to subscribe to our newsletter - tick for Y <small>(4 newsletters per year - subscription is free)</small> <br><br>
								
									<input type = "image" src="./images/RegisterButton.png" WIDTH="99" HEIGHT="20" BORDER="0" ALT="SUBMIT DETAIL AND REGISTER" /> 
								</h11>
							</form>
						</div>
			<?php
					}
				}
			?>
					
			</div>
			
<!-- END of MAIN BODY div -->								

<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			
	
		</div> 
		
<!-- END of PAGE CONTAINER div -->								

	</body>
</html>
