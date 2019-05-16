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
			<div id="page">
			<?php
				$_SESSION['ADMINPAGEYN'] = "NO";
				$_SESSION['MEMBERPAGEYN'] = "YES";
				
				$_SESSION['Page_Purpose'] = "index";
				include_once("./CommonPages/PagePurpose.php");
			?>	
				
	<?php
	/*	########################################################################################################################################
		This section holds new php includes
		##################################################################################################################################### */
		//require_once("includes/functions.php");

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
										if 		($_SESSION['Page_Purpose'] == "index")				{		$Title_Text = "Welcome to the Institute for Holistic Science...";	}
										else if ($_SESSION['Page_Purpose'] == "about")				{		$Title_Text = "Welcome to the about us page...";	}
										else if ($_SESSION['Page_Purpose'] == "news")				{		$Title_Text = "Welcome to our news page...";	}
										else if ($_SESSION['Page_Purpose'] == "journal")			{		$Title_Text = "Welcome to our journal...";	}
										else if ($_SESSION['Page_Purpose'] == "research")			{		$Title_Text = "Welcome to our research page...";	}
										else if ($_SESSION['Page_Purpose'] == "contactus")			{		$Title_Text = "Welcome to our contact-us page...";	}
										else if ($_SESSION['Page_Purpose'] == "events")				{		$Title_Text = "Welcome to our events page...";	}
										else if ($_SESSION['Page_Purpose'] == "adminpage")			{		$Title_Text = "Welcome to the administration area...";	}
										else if ($_SESSION['Page_Purpose'] == "updatearticles")		{		$Title_Text = "Welcome to the articles administration area...";	}
										
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
								Can we go to the very root of conflict and be free from it?
								<br><br>
								
								Can we go to the very root of illness and be free from it?
								<br><br>
								<h9>	
								
								Can we go to the very root of all things within our reality, and free ourselves from the inauthentic and 
								manufactured meanings which have been bestowed upon them for centuries? Instead, opening ourselves up to contemplate, 
								with the whole of our being and our authentic selves, the very essence of our True relationship with all phenomena.	
								<br><br>
									
								If you say; “Yes, there might be a different way of knowing and being in the world”, a safe and nurturing space 
								is allowed to gently emerge; providing us the opportunity to communicate with each other and hold a living enquiry, together.
								<br><br>
									
								If you choose to live in a world where anything and everything is possible, and where absence of evidence 
								is not evidence of absence, then we invite you to join us in this shared space of enquiry.	
								<br><br>
									
								As PhD researchers we are exploring the deeper implications of quantum physics from a philosophical 
								and spiritual perspective. Essentially, enquiring into how we can we move forward from a Newtonian 
								physical view of the universe as being either/or, black/white, binary and abstract, to a space of deep 
								interconnection and wholeness.	
								<br><br>
								
								We invite you to share this journey with us as we explore the ‘space between’ 
								different ways of knowing, enquiring into the possibility of bringing many worlds together.
								<br><br>
								</h9>
							</div>
							<div class="sidenav col-md-2 sidenav navbar-light">
								<table class="TrendingTable">
									
								<?php
									foreach ($articles as $article)
									{
								?>
										<tbody>
											<tr>	
												<td> 
													<a href="displayarticle.php?id=<?php echo $article['article_id']; ?> " class="trendinglink">
													</a>
												</td>	
												
												<td>
													<div class="alert article alert-secondary"><a href="displayarticle.php?id=<?php echo $article['article_id']; ?> " class="trendinglink">
												<?php 
														echo $article['article_title']; 
														echo "<br>";
														
													echo "</a></div>";	
													if ($tablecolourbool == 1)
													{
														echo "<small><em><b>posted:</b> " . date('l jS F Y', $article['article_published_date']) . "</em></small><br><br>";					
													}
													else 
													{
														echo "<small2><em><b>posted:</b> " . date('l jS F Y', $article['article_published_date']) . "</em></small2><br><br>";					
													}

													
												?>

												</td>	
											</tr>									
										</tbody>
								<?php
										$tablecount++;
										if ($tablecount >= 7)	
											break;
									}
								?>
								</table>
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
