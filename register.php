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
	
	$x = 0;
	$member = new Member;
	$skip = 0;
	$fillboxes = 0;

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
			
			$_SESSION['Page_Purpose'] = "register";

			include_once("includes/header.php");
			include_once("includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
			include_once("includes/variables.php"); //new pagepurpose.php to identify the purpose
		?>	
			
<?php
/*	########################################################################################################################################
	This section holds the LHC of the welcome page. It holds a general greeting and general about us
	The <div class = "container"> is used to center the boxes (the section-box) on the screen	
	##################################################################################################################################### */
?>													
			<div class="Container">		
			<!-- header -->	
					<div class="container-fluid">
						<div class="row">
							<?php 
								include_once 'includes/leftside.php'
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

						$numemail = $member->find_member($member_email);			// returns the number of rows in the DB related to the query

						if ($numemail >= 1) {	
						?>	
							<script type="text/javascript">	
								alert("\tUser with such email is already registered.\n\n Please, select different email.\n\n");
							</script>

						<?php
							$fillboxes = 1;
						}

						$numusername = $member->find_member($member_username);			// returns the number of rows in the DB related to the query
						
						if ($numusername >= 1)	{	
						?>	
							<script type="text/javascript">	
								alert("\tUser with such username is already registered.\n\n Please, select different username.\n\n");
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
									<div class="form-group">
										<label for="first_name">Title</label>
										<select id="inputState" class="form-control" name = "member_name_title">
											<option selected>Mr</option>
											<option selected>Miss</option>
											<option selected>Ms</option>
											<option selected>Mrs</option>
											<option selected>Dr</option>
											<option selected>Prof</option>
										</select>	
									</div>

									<div class="form-group">
										First name
										<input type = "text" class="form-control" placeholder="Enter your first name" 		name = 	"member_name_first" <?php if($fillboxes == 1)	echo "value = $member_name_first";	?>	/>	
									</div>

									<div class="form-group">
										Last name
										<input type = "text" class="form-control" placeholder="Enter your last name" 		name = 	"member_name_last"  <?php if($fillboxes == 1)	echo "value = $member_name_last";	?>	/>	
									</div>
								
									<div class="form-group">
										Username
										<input type = "text" class="form-control" placeholder="Enter your username"		name = 	"username"  <?php /* we want to blank out this box so don't fill it */	?>	/>	
									</div>

									<div class="form-group">
										Password			
										<input type = "password" class="form-control" placeholder="Enter your password"		name = 	"password" <?php /* we want to blank out this box so don't fill it */	?>	/>	
									</div>

									<div class="form-group">
										Email				
										<input type = "text" class="form-control" placeholder="Enter your email address"		name = 	"email" <?php if($fillboxes == 1)	echo "value = $member_email";		?>	/>
									</div>
									
									<div class="form-check">
										<input class="form-check-input" type	= "checkbox" 	name=	"newsletterY"> 
										<?php 	
											if($fillboxes == 1)	
											{ 
												if (isset($_POST['newsletterY']))	echo "checked";
											}
										?></input>	
									 <label class="form-check-label" for="newsletterY">Would you like to subscribe to our newsletter? <small>(4 newsletters per year - subscription is free)</small></label>
									</div>
									<br><button type="submit" class="btn btn-primary">Sign In</button>
							</form>
						</div>
			<?php
					}
				}
			?>							
			</div>
							</div>
							<div class="sidenav col-md-2 sidenav navbar-light">
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
