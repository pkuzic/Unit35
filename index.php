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
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "NO";
			$_SESSION['MEMBERPAGEYN'] = "YES";
			
			$_SESSION['Page_Purpose'] = "index";
			include_once("./CommonPages/PagePurpose.php");
		?>	
			
<?php
/*	########################################################################################################################################
	This section holds the LHC of the welcome page. It holds a general greeting and general about us
	The <div class = "container"> is used to center the boxes (the section-box) on the screen	
	##################################################################################################################################### */
?>			
			<div class="Container">

				<div class="left-section-box">	<?php //this is the LHS of the contents box, uses a floating div stucture	?>							
				
					<h8>
						Can we go to the very root of conflict and be free from it?
						<br><br>
						Can we go to the very root of illness and be free from it?
					</h8>
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
<?php
/*	########################################################################################################################################
	This section holds the Middle of the welcome page. It is a general gap between the two columns	
	##################################################################################################################################### */
?>	
				<div class="middle-section-box">		<?php //	middle separating bar between floating divs	?>										
					&nbsp;		
				</div>	
<?php
/*	########################################################################################################################################
	This section holds the RHC of the index page.
	In this section we shall present a trending box, the trending box will show the 7 latest  articles. news etc
	The news and other table have not bee implements yet
	##################################################################################################################################### */
?>	
				<div class="right-section-box">		<?php //	The RHS Floating div - the trending box (table)	?>									

					<table class="TrendingTable">
					    <thead >	
							<tr>	
								<th colspan="2" bgcolor= <?php echo "$TableColour1" ?> >
									<h12>
										&nbsp;<br>Currently Trending (<em>Note: visited links will dim</em>)<br>&nbsp;
									</h12>
								</th>    
							</tr>   
						</thead>
						
					<?php
						foreach ($articles as $article)
						{
						/* the table uses 2 colours #CCCCFF - light pinky purple & #99CCFF - light blue */
							if($tablecolourbool == 0)	{	$tablecolour = $TableColour1;		$tablecolourbool = 1;		}
							else						{	$tablecolour = $TableColour2;		$tablecolourbool = 0;		}
					?>
							<tbody>
								<tr>	
									<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 
										<a href="displayarticle.php?id=<?php echo $article['article_id']; ?> " class="trendinglink">
											<img border="0" src="images/mg.png" width="26" height="26">	
										</a>
									</td>	
									
									<td width="95%" bgcolor= <?php echo " $tablecolour " ?> >
										<a href="displayarticle.php?id=<?php echo $article['article_id']; ?> " class="trendinglink">
									<?php 
											echo $article['article_title']; 
											echo "<br>";
											
										echo "</a>";	
										
										if ($tablecolourbool == 1)
										{
											echo "<small><em>posted: " . date('l jS F Y', $article['article_published_date']) . "</em></small>";					
										}
										else 
										{
											echo "<small2><em>posted: " . date('l jS F Y', $article['article_published_date']) . "</em></small2>";					
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

						<tfoot>	
							<tr>	
								<th colspan="2" bgcolor = <?php echo "$TableColour1" ?> >
									<h12>
										<br>&nbsp;<em>all trending shown in descending order</em><br>&nbsp;
									</h12>
								</th>    
							</tr>   
						</tfoot>
					</table>
				</div>
										
				<br style="clear: left;" />
			</div>
			
<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			

<!-- END of PAGE CONTAINER div -->								

		</body>

	</html>
