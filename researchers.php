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

	$user = new Users;
	$users = $user->fetch_researcher_details();		// load all researchers in to memory

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
			
			$_SESSION['Page_Purpose'] = "research";

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
												<?php echo $Title_Text;	?><br>
												<small>Our team and our research, click on the researcher to access their personal research page.</small>													
											</div>
										</td>	
									</tr>
								</table>
							</div>
							<?php
							$number_of_researchers = 0;
							foreach ($users as $user)	
							{
								if($user['user_research_area'] != "NA")						$number_of_researchers++;
							}
							
							foreach ($users as $user)
							{
								if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
								else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
								
								if($user['user_research_area'] == "NA")						$show_researcher = FALSE;
								else														$show_researcher = TRUE;
							
								if ($show_researcher == TRUE)
								{
							?>
							<div class="StyledTable1 alert">
								<tbody>	
									<tr>	
										<td width="20%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<h11>	<?php 	$name_string = 	$user['user_name_title'] . " " .
																			$user['user_name_first'] . " " .
																			$user['user_name_last'] . " "; 
															echo $name_string;
													?>
											</h11>
										</td>	
										
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >	&nbsp;	</td>
									
										<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<?php $imagestring = $user['user_image']; ?>
											<img border="0" <?php echo "src = $imagestring"; ?> width="120" height="120">	
										</td>	
										
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> > 
											&nbsp;	
										</td>
								
										<td width="100%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<h11>
												<?php echo $user['user_research_area']; ?> 		
											</h11>
										</td>		
									</tr>									
								</tbody>
								
						<?php	$tablecount++;		?>
								
								<tfoot>	
									<tr>	
										<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >
											<h12>	
												<?php echo "Showing ($tablecount) of ($number_of_researchers) Researchers"; ?> 
											</h12>
										</th>    
									</tr>   
								</tfoot>
							</div>
							<?php	
						
					}
				}
				?>
						</div>
						<div class="sidenav col-md-2 sidenav navbar-light">
							 Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies vestibulum luctus. Aenean tincidunt eget felis vel maximus. Nunc id sapien elementum, sagittis quam luctus, dictum nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas, augue non cursus sodales, felis tortor dictum elit, fringilla rutrum turpis ex ac libero. Nullam at ipsum laoreet dui blandit finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent auctor iaculis elit eu interdum. Maecenas at libero id ante placerat imperdiet. Quisque vitae cursus ligula. Cras ac scelerisque dui.
						</div>
												
						<br style="clear: left;" />
					</div>
				</div>
			</div>
<!-- END of MAIN BODY div -->								

<!-- END of PAGE CONTAINER div -->								

		</body>

	</html>
