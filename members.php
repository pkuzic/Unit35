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
	$data = new Member;
	$un = "";
	
	static $un = "";
	static $id = 0;
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
								<h7>	Member area...</h7> 	
								</td>	
						</tr>
					</table>
				</div>
			

<!-- END of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->							
			
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
