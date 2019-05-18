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
	$data = new Member;
	$un = "";
	
	static $un = "";
	static $id = 0;
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
			
			$_SESSION['Page_Purpose'] = "members";

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
					
				if (isset($_SESSION['logged_in']) == TRUE)
				{
				
					if (isset($_SESSION['logged_in_as_member']))
					{
/* 	=================================================================================================================================================						
	DEBUGG CODE: Looks to see what has been set in the login logic below
	===============================================================================================================================================	*/
	
						//$_SESSION['logged_in_as_a_user'] = TRUE;	// DEBUGGING - forces the else, just for testing
						
						if($_SESSION['logged_in_as_member'] == TRUE && $_SESSION['logged_in_as_a_user'] == FALSE)
						{
							//	echo "loggedin as member << " . $_SESSION['logged_in_as_member'] . " >> ";
							//	echo "loggedin as a user << " . $_SESSION['logged_in_as_a_user'] . " >> ";
							//	echo "username << " . $_SESSION['username'] . " >> ";
							//	echo "member_id << " . $_SESSION['member_id'] . " >> ";
							
							$loopnum = 5;
							$optionpagearray = array		(	"searcharticles.php", 
																"searchauthor.php", 
																"searchdates.php", 
																"changememberdetails.php", 
																"logout.php"
															);
							
							$optionpagetextarray = array	(	"Search articles from a particular journal", 
																"Search articles from a particular author", 
																"Search articles between certain dates", 
																"Change your details on record", 
																"Logout"
															);

						}
						else	// This would cover is a user logged in, users (staff) cannot change member records..Also there would be no member details
						{
							$optionpagearray = array 		(	"searcharticles.php", 
																"searchauthor.php", 
																"searchdates.php", 
																"logout.php"
															);
							
							$optionpagetextarray = array	(	"Search articles from a particular journal", 
																"Search articles from a particular author", 
																"Search articles between certain dates", 
																"Logout"
															);
							$loopnum = 4;
						}
							
				?>
						<table border="0" cellspacing="0" cellpadding="0" align="center">
						<?php
							for ($x = 0; $x<$loopnum; $x++)
							{
							?>
								<tr>	<td width="15%">	<img border="0" src="./images/smallicon.png" width="26" height="26">	</td>	
										<td width="5%">		&nbsp;																	</td>	
										<td width="80%">
											<a href=<?php echo " $optionpagearray[$x] " ?> class = "memberlink">	
											<?php 
												echo " $optionpagetextarray[$x] "; 
											?>				
											</a>									
										</td>	
								</tr>
						<?php
						}
					}
						?>
					</table>	
					
					<p>
			<?php
				}
				
/* 	=================================================================================================================================================						
	ELSE: The member/user is not logged in and therefore we must present a log-in screen to capture the details
	===============================================================================================================================================	*/
				
				else
				{
					if (isset($_POST['username'], $_POST['password']))
					{
						$username = $_POST['username'];		
						$password = $_POST['password'];	
						
						if (empty($username) or empty($password))
							$error = 'Please supply data for all fields!';
														
						else
						{
							$num = $member->find_member_exist($username, $password);							
									
							if ($num == 1)	
							{	
								
								$data = $member->fetch_data($username);
								
								$_SESSION['logged_in'] 				= 	TRUE;	
								$_SESSION['logged_in_as_member'] 	= 	TRUE;
								$_SESSION['logged_in_as_a_user'] 	= 	FALSE;
								$_SESSION['username'] 				= 	$data['username'];
								$_SESSION['member_id'] 				= 	$data['member_id'];
								
								//$locationstring = "Location:./members.php?member_id=" . $id . "&username=" . $un; 
								$locationstring = "Location:#"; 
								header($locationstring);	
								exit();		
							}
							else			
							{	
								$error = "Sorry - incorrect details entered";	
								session_destroy();	
								$_SESSION['logged_in_as_member'] = FALSE;
							}
						}
					}
	
					if (isset($error))
					{										
				?>
						<div class="CenterContent">
							<small style="color:#aa0000;">
							<?php
								echo $error . "<br>";
							?>
							<br />
							</small>
						</div>
				<?php 
					}
				?>
								
					<div class="CenterContent">
						<form action="members.php" method="post" autocomplete="off">
							<h11>
								Please input your username and password 
							</h11>
						
							<small>** both fields must be completed </small>
							<p>
							<input type = "text" name = "username" placeholder = "Username" />
							<input type = "password" name = "password" placeholder = "Password" />
							<input type = "submit" value = "Login" />
						</form>					
					</div>
			<?php
				}
			?>								</div>

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
