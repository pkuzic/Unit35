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
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">
			<link rel="stylesheet" type="text/css" href="./CSS/bootstrap.css">
		</head>

				<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "NO";
			$_SESSION['MEMBERPAGEYN'] = "YES";
			
			$_SESSION['Page_Purpose'] = "research";
			include_once("./CommonPages/PagePurpose.php");
		?>	
			
<?php
/*	########################################################################################################################################
	This section holds the LHC of the welcome page. It holds a general greeting and general about us
	The <div class = "container"> is used to center the boxes (the section-box) on the screen	
	##################################################################################################################################### */
?>			
			<div class="Container">
				<!-- <table border="0" width="100%" cellspacing="0" cellpadding="0" align=center class="tableindex"> -->
				
				<table width="700" class="tablewithroundedtopandbottom"> 
					<thead>	
						<tr>	
							<th colspan="6" bgcolor= <?php echo $TableColour1; ?> >
								<h12>
									&nbsp;<br>Our team and our research, click on the researcher to access their personal research page......<br>&nbsp;
								</h12>
							</th>   
						</tr>   
					</thead>
				</table>
				<br>
																	
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
						<table class="StyledTable1"> 
							<thead>	
								<tr>	
									<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
										<h12>&nbsp;</h12>	
									</th>   
								</tr>   
							</thead>
							
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
						</table>
						<br>
				<?php	
						
					}
				}
				?>
				<table class="tableindexroundedtopandbottom"> 
					<tfoot>	
						<tr>	
							<th colspan="6" bgcolor = <?php echo $TableColour1; ?> >
								<h12>
									&nbsp;
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
