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

	$article = new Article;									//	a new instance of class article
	$articles = $article->fetch_all_date_descending();		// 	Get all of the articles in the database table (in descending order of date)

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
			
			$_SESSION['Page_Purpose'] = "contactus";

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
								<img border="0" src="./images/UnderConstruction.jpg" width="183" height="204">	
							</div>
						<table class="tablewithroundedtopandbottom"> 
							<thead>	
								<tr>	
									<th colspan="6" bgcolor=<?php echo $TableColour1; ?> >
										<h12>
											&nbsp;<br>Please enter the following details (<em>All fields with * needed</em>)...<br>&nbsp;
										</h12>
									</th>   
								</tr>   
							</thead>
						</table>
						<br>
					
						<?php
							$tablecolourbool = 0;
							if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
							else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
						?>
					
						<form name="htmlform" method="post" action="html_form_send.php">
							<table class="StyledTable1"> 
								<thead>	<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >	
													<h12>&nbsp;</h12>	
												</th>   
										</tr>   
								</thead>

								<tbody>	
									<tr>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<label for="first_name">	First Name *	</label>	</h11>	</td>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<input  type="text" name="first_name" maxlength="50" size="51">	</h11> </td>	
									</tr>
									
									<tr>	
										<td colspan="6" bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
									</tr>
									
									<tr>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<label for="last_name">	Last Name *	</label>	</h11>	</td>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<input  type="text" name="last_name" maxlength="50" size="51">	</h11> </td>	
									</tr>
									
									<tr>	
										<td colspan="6" bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
									</tr>
									
									<tr>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<label for="email">	Email Name *	</label>	</h11>	</td>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<input  type="text" name="email" maxlength="80" size="51">	</h11> </td>	
									</tr>
									
									<tr>	
										<td colspan="6" bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
									</tr>
									
									<tr>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<label for="telephone">	Telephone Number (may be a mobile) *	</label>	</h11>	</td>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<input  type="text" name="telephone" maxlength="30" size="51">	</h11> </td>	
									</tr>

									<tr>	
										<td colspan="6" bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
									</tr>
									
									<tr>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<label for="message">	What do you want to tell us? *	</label>	</h11>	</td>	
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
										<td bgcolor= <?php echo " $tablecolour " ?> > <h11>	<textarea  id="styled" name="message" maxlength="1000" cols="39" rows="6"></textarea>	</h11> </td>	
									</tr>
									
									<tr>	
										<td colspan="6" bgcolor= <?php echo " $tablecolour " ?> > <h11>	&nbsp;	</h11>	</td>
									</tr>

									<tr>	<td colspan="6" style="text-align:center" bgcolor= <?php echo " $tablecolour " ?>>
												<INPUT TYPE="image" value="submit" SRC="./images/GreenSubmitButton.png" WIDTH="175"  HEIGHT="75" BORDER="0" ALT="SUBMIT!">
											</td>
									</tr>
								</tbody>
							
								<tfoot>	
									<tr>	<th colspan="6" bgcolor= <?php echo " $tablecolour " ?> >
												<h11>	
													&nbsp; 
												</h11>
											</th>    
									</tr>   
								</tfoot>

							</table>
							
							<br>						

							<table class="tablewithroundedtopandbottom"> 
								<tfoot>	
									<tr>	<th colspan="6" bgcolor = <?php echo $TableColour1; ?> >
											<h12>
												<br>&nbsp;<br>
											</h12>
											</th>    
									</tr>   
								</tfoot>
								
							</table>
						</form>
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
