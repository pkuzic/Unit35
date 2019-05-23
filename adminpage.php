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
	$user = new Users;
	$data = new Users;
	$un = "";
	
	static $un = "";
	static $id = 0;
	static $pw = "";
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
			
			$_SESSION['Page_Purpose'] = "adminpage";

			include_once("includes/header.php");
			include_once("includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
			include_once("includes/variables.php"); 
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
					if($_SESSION['logged_in_as_member'] == FALSE && $_SESSION['logged_in_as_a_user'] == TRUE)
					{	
					
						//	echo "loggedin as member << " . $_SESSION['logged_in_as_member'] . " >> ";
						//	echo "loggedin as a user << " . $_SESSION['logged_in_as_a_user'] . " >> ";
						//	echo "username << " . $_SESSION['username'] . " >> ";
						//	echo "user_id << " . $_SESSION['user_id'] . " >> ";					
					
						//	$welcomestring = "Welcome to Admin Page, " . $_SESSION['title'] . " " . $_SESSION['last_name'] . ".<br>What administration action would you like to perform?";
			?>			
						<div class="PagePurpose">			
							<table border="0" cellpadding="5" cellspacing="0">
								<tr>	<td align="left" colspan="6">		
										</td>	
								</tr>
							</table>
						</div>
			<?php
						$optioncount = 0;
				
						$optionpagearray = array	(	"admin/updatearticlesondb.php", // Done
														"admin/editstaffmember.php", 	//Done
														"admin/adminuser.php?id=2", 		
														"admin/deleteuser", 
														"admin/adminmember.php?id=1", 
														"admin/adminnewsletter.php?id=1", 
														"admin/adminnewsletter.php?id=2",
														"admin/adminnews.php?id=1", 	
														"admin/adminnews.php?id=2", 		
														"admin/adminnews.php?id=3",
														"admin/adminjournal.php?id=1", 
														"admin/adminjournal.php?id=2", 	
														"admin/adminjournal.php?id=3",
														"admin/addarticle.php", 
														"admin/editarticle.php?id=2", 	
														"admin/delete.php",
														"logout.php"
													);

						$optionpagetextarray = array(	"Admin - Add, edit or delete articles",
														"Admin - Add a member of staff to the system", 
														"Admin - Edit details held on the system for a member of staff", 
														"Admin - Delete a member of staff from the system", 
														"Admin - Delete a member from the database", 
														"Admin - Create a newsletter", 
														"Admin - Dispatch newsletter", 
														"Admin - Add a news article", 
														"Admin - Edit a news article held on the system", 
														"Admin - Delete a news article",
														"Admin - Add a journal to the system", 
														"Admin - Edit details held on the system for a particular journal", 
														"Admin - Delete a particular journal", 
														"Admin - Add an article to the system", 
														"Admin - Edit details held on the system for an article", 
														"Admin - Delete an article from the system",
														"Logout of administration area"
													);
					?>
						<?php
							for ($x = 0; $x<16; $x++)
							{
						?>
											<div class="alert alert-light" role="alert">											
											<i class="fas fa-angle-right"></i><a href=<?php echo " $optionpagearray[$x] " ?>>	
											<?php 
												echo " $optionpagetextarray[$x] "; 
											?>				
											</a></div>							<?php
							}
						?>
					<p>
						
				<?php
					}
				
					
					else
					{
						?>
						<div class = "CenterContent">
						<?php
							echo "	Hello there! <br>It appears that you are not a member of staff. 
									<br>Members are not allowed in the administration section
									<br><Please logout out OR return to the members area<br><br>";
						?>
							<div class="alert alert-light" role="alert"><i class="fas fa-angle-right"></i><a href="logout.php">Logout</a></div>
							<div class="alert alert-light" role="alert"><i class="fas fa-angle-right"></i><a href="../../members.php">Return to the members area</a></div>
						</div>
					<?php
							
					}
				}
				else
				{
					if (isset($_POST['username'], $_POST['password']))
					{
						$username = $_POST['username'];		$password = $_POST['password'];	
						
						if (empty($username) or empty($password))
							$error = '<div class="alert alert-danger" role="alert">Please supply data for all fields!</div>';
														
						else
						{
							$num = $user->find_user_exist($username, $password);							
									
							if ($num == 1)	
							{	
								$data = $user->fetch_data($username);
								
								$_SESSION['logged_in'] 				= 	TRUE;	
								$_SESSION['logged_in_as_member'] 	= 	FALSE;
								$_SESSION['logged_in_as_a_user'] 	= 	TRUE;
								
								$_SESSION['user_id'] 				= 	$data['user_id'];
								$_SESSION['username'] 				= 	$data['username'];
								$_SESSION['title'] 					= 	$data['user_name_title'];								
								$_SESSION['first_name']		 		= 	$data['user_name_first'];
								$_SESSION['last_name'] 				= 	$data['user_name_last'];
								
																							
								//$locationstring = "Location:./adminpage.php?user_id=" . $id . "&username=" . $un . "&password=" . $pw; 
								$locationstring = "Location:#"; 
								header($locationstring);	
								exit();		
							}
							else			
							{	
								$error = '<div class="alert alert-danger" role="alert">Sorry - incorrect details entered</div>';	
								session_destroy();	
							}
								
						}
					}
	
					if (isset($error))
					{										
				?>
						<div class="CenterContent">
							<small style="color:#aa0000;">
							<?php
								echo $error;
							?>
							<br />
							</small>
						</div>
				<?php 
					}
				?>
								
					<div class="CenterContent">
						<form action="adminpage.php" method="post" autocomplete="off">						
								<div class="form-group">
									<input type = "text" class="form-control" name = "username" placeholder = "Username" />
								</div>
								<div class="form-group">
									<input type = "password" class="form-control" name = "password" placeholder = "Password" />
								</div>
							<button type="submit" class="btn btn-primary">Submit</button>
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
