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
							<div class="alert alert-danger" role="alert">This form is currently unavailable!</div>				
								<form method="post">
									<div class="form-group">
										<label for="first_name">First name</label>
										<input type="text" class="form-control" name="first_name" placeholder="Enter your first name">
									</div>
									<div class="form-group">
										<label for="last_name">Last name</label>
										<input type="text" class="form-control" name="last_name" placeholder="Enter your first name">
									</div>
									<div class="form-group">
										<label for="email">Email Name</label>
										<input type="text" class="form-control" name="email" placeholder="Enter your email">
									</div>
									<div class="form-group">
										<label for="telephone">Contact Number</label>
										<input type="text" class="form-control" name="telephone" placeholder="Enter your contact number">
									</div>
									<div class="form-group">
										<label for="message">Contact Number</label>
										<textarea class="form-control" name="message" maxlength="1000" cols="39" rows="6"></textarea>
									</div>
									<button type="submit" id="btnSubmit" class="btn btn-primary">Submit</button>
								</form>
							</div>
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
