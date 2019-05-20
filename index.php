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

//Article PHP
	$article = new Article;
	$articles = $article->fetch_all();					// load all articles into memory
	
	$journal = new Journal;
	$journals = $journal->fetch_journal_details();		// load all journals into memory
	$journalcount=0;
	
	foreach ($journals as $journal)							// cycle through the data (from the DB table) and put it into the appropriate arrays
	{
		$journalcount++;
	}
	
	$_SESSION['minnumberofjournals'] = 1;
	$_SESSION['maxnumberofjournals'] = $journalcount;

//Article PHP END


	$news = new News;
	$newss = $news->fetch_news_stories_decending();		// load all news articles into memory
	
	$number_of_articles = 0;
	foreach ($newss as $news)	
	{
		$number_of_articles++;		// calculate the number of articles to be shown (will be used in the footer of the tables)
	}
/*	########################################################################################################################################
	We want to load all of the used (staff members) into memory - just the title, first name and last name
	we want to do this to show who wrote the article in the news section.
	##################################################################################################################################### */
	
	$user_array_title = array();
	$user_array_first_name = array();
	$user_array_last_name = array();
	
	$usercount = 0;
	$user = new Users;
	$users = $user->fetch_researcher_details();			// load all users (staff) into memory
		
	foreach ($users as $user)							// cycle through the data (from the DB table) and put it into the appropriate arrays
	{
		$user_array_title[$usercount] = $user['user_name_title'];
		$user_array_first_name[$usercount] = $user['user_name_first'];
		$user_array_last_name[$usercount] = $user['user_name_last'];
		$usercount++;
	}
	

	$article = new Article;									//	a new instance of class article
	$articles = $article->fetch_all_date_descending();		// 	Get all of the articles in the database table (in descending order of date)
	

?>	


	
	<html>
		<head>
			<?php 
				include_once 'includes/head.php'
			?>

			<link rel="stylesheet" href="CSS/glider.css" type="text/css">
    		<link rel="stylesheet" href="CSS/carousel.css" type="text/css">
    		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

		</head>

		<body>
			<?php
				$_SESSION['ADMINPAGEYN'] = "NO";
				$_SESSION['MEMBERPAGEYN'] = "YES";
				
				$_SESSION['Page_Purpose'] = "index";
				
				include_once("includes/header.php");
				include_once("includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
				include_once("includes/variables.php"); //new pagepurpose.php to identify the purpose
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
							<div  class="col-md-8 text-left">
	
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

	<div class="StyledTable1 alert">
		<div class="glider-contain multiple">

		    <div class="glider">


				<?php
					foreach ($journals as $journal)
					{
					
						
				?>

								<?php 	$imagestring = $journal['journal_image'];
										$journalid = $journal['journal_id'];
									 ?>
									 <a href="journal.php?id=<?php echo $journalid ?>">
								<img border="0" class="journalLink" <?php echo "src = $imagestring"; ?> ></a>
							
									<?php	
					}
			?>
		
		    </div>

		  <button class="glider-prev">
		    <i class="fa fa-chevron-left"></i>
		  </button>

		  <button class="glider-next">
		    <i class="fa fa-chevron-right"></i>
		  </button>

		  <div id="dots" class="glider-dots"></div>
		</div>
	</div>
				<?php
				/*	########################################################################################################################################
					Now put all of the news articles out in a tabular format
					##################################################################################################################################### */
				?>	
							<?php
								foreach ($newss as $news)
								{
									if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
									else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
							?>


								<div class="StyledTable1 alert">

									<h4><?php 	
										$news_title_string = 	$news['news_title'] . " "; 
										echo $news_title_string;
										
									?></h4>
									<p><?php	echo $news['news_body'];	?></p>
									<?php
										$poster = $news['news_posted_by'];
										$poster_string = 	$user_array_title[$poster] .
															" " . 			$user_array_first_name[$poster] . 
															" " . 			$user_array_last_name[$poster] .
															" (" .	date('l jS F Y', $news['news_posted_date']) . ")";
										
										if ($tablecolourbool == 1)
										{
											echo "<small><em>" . $poster_string . "</em></small>";					
										}
										else 
										{	
											echo "<small><em>" . $poster_string . "</em></small>";					
										}			
									?>
								</div>
								<?php	
								}
								?>

							</div>
							<div class="sidenav col-md-2 sidenav navbar-light"> <?php //Right side bar ?>
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

<script src="Javascript/glider.js"></script> 

<script src="Javascript/carousel.js"></script> 


		</body>

	</html>
6