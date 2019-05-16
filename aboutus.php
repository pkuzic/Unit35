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
			
			$_SESSION['Page_Purpose'] = "about";
			include_once("./CommonPages/PagePurpose.php");
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
								
									<table border="0" cellpadding="5" cellspacing="0" width="800px">
									<?php
										if 		($_SESSION['Page_Purpose'] == "index")				{		$Title_Text = "Institute for Holistic Science...";	}
										else if ($_SESSION['Page_Purpose'] == "about")				{		$Title_Text = "About Us...";	}
										else if ($_SESSION['Page_Purpose'] == "news")				{		$Title_Text = "News";	}
										else if ($_SESSION['Page_Purpose'] == "journal")			{		$Title_Text = "Journal";	}
										else if ($_SESSION['Page_Purpose'] == "research")			{		$Title_Text = "Research";	}
										else if ($_SESSION['Page_Purpose'] == "contactus")			{		$Title_Text = "Contact Us";	}
										else if ($_SESSION['Page_Purpose'] == "events")				{		$Title_Text = "Events";	}
										else if ($_SESSION['Page_Purpose'] == "adminpage")			{		$Title_Text = "Admin Panel";	}
										else if ($_SESSION['Page_Purpose'] == "updatearticles")		{		$Title_Text = "Articles Moderation";	}
										
									?>
										<tr>										
											<td align="left">
												<div class="alert alert-info" role="alert">											
													<?php echo $Title_Text;	?> 	
												</div>
											</td>	
										</tr>
									</table>
								</div>
								<img border="0" src="./images/UnderConstruction.jpg" width="183" height="204">	
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
