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

	include_once ('../includes/connection.php');
	include_once ('../includes/article.php');
	
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
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="../../CSS/MainStyles.css">
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "YES";
			$_SESSION['MEMBERPAGEYN'] = "NO";
			
			$_SESSION['Page_Purpose'] = "adminpage";
			include_once("../../CommonPages/PagePurpose.php");
		?>	

			<div class="container">
			
			<?php				
				if (isset($_SESSION['logged_in']) == true)
				{
					if($_SESSION['logged_in_as_member'] == FALSE && $_SESSION['logged_in_as_a_user'] == TRUE)
					{	
					
						//	echo "loggedin as member << " . $_SESSION['logged_in_as_member'] . " >> ";
						//	echo "loggedin as a user << " . $_SESSION['logged_in_as_a_user'] . " >> ";
						//	echo "username << " . $_SESSION['username'] . " >> ";
						//	echo "user_id << " . $_SESSION['user_id'] . " >> ";					
					
						$welcomestring = "Welcome " . $_SESSION['title'] . " " . $_SESSION['first_name'] . " " . $_SESSION['last_name'] . ".<br>What administration would you like to perform?";
			?>			
						<div class="PagePurpose">			
							<table border="0" cellpadding="5" cellspacing="0" width="800px">
								<tr>	<td align="left" colspan="6">		
										<h9>	<?php echo $welcomestring; ?> </h9> 	
										</td>	
								</tr>
							</table>
						</div>
			<?php
						$optioncount = 0;
				
						$optionpagearray = array	(	"updatearticlesondb.php",
														
						
						
														"adminuser.php?id=1", 	
														"adminuser.php?id=2", 		
														"adminuser.php?id=3", 
														"adminmember.php?id=1", 
														"adminnewsletter.php?id=1", 
														"adminnewsletter.php?id=2",
														"adminnews.php?id=1", 	
														"adminnews.php?id=2", 		
														"adminnews.php?id=3",
														"adminjournal.php?id=1", 
														"adminjournal.php?id=2", 	
														"adminjournal.php?id=3",
														"addarticle.php", 
														"editarticle.php?id=2", 	
														"adminarticle.php?id=3",
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
						<table border="0" cellspacing="0" cellpadding="0" align="center">
						<?php
							for ($x = 0; $x<16; $x++)
							{
						?>
								<tr>	<td width="15%">	<img border="0" src="../../images/smallicon.png" width="26" height="26">	</td>	
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
						?>
						</table>	
					<p>
						
				<?php
					}
				
					
					else
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
				else
				{
					if (isset($_POST['username'], $_POST['password']))
					{
						$username = $_POST['username'];		$password = $_POST['password'];	
						
						if (empty($username) or empty($password))
							$error = 'Please supply data for all fields!';
														
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
								$error = "Sorry - incorrect details entered";	
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
								echo $error . "<br>";
							?>
							<br />
							</small>
						</div>
				<?php 
					}
				?>
								
					<div class="CenterContent">
						<form action="adminpage.php" method="post" autocomplete="off">
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
