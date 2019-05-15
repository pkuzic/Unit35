<?php

/* ----------------------------------------------------------------------------------------------------------------------------

	for trending from the current date (time) backwards we could use the following facts
	$number_of_days = 3;									// where this is the range of days we want we could change this to 4, 89, 365 etc.
	$todate = time();										// the end date is now
	$fromdate = $todate - (86400 * number_of_days);			// the start is now - number of days - above

	if we do this then there is an extra complication. If 20 articles were published (trending) between those dates
	and we only have room to display the first 6 (for instance). we need to execute the following in the foreach loop

		<ol>
		<?php
			foreach ($articles as $article)
			{
				if ($article_matches >= 6)
					break;								// this takes makes a mid-exit loop 
		?>
		
				<li>
					<a href="displayarticle.php?id=<?php echo $article['article_id']; ?> ">	<?php echo $article['article_title']; ?> </a>	
					-
					<small>	posted: <?php echo date('l jS F Y', $article['article_timestamp']); ?> 	</small>					
				</li>
		
			<?php
				$article_matches++;    
			}
			?>
		</ol>

   ---------------------------------------------------------------------------------------------------------------------------- */				
?>

<?php 

	include_once ('includes/article.php');
	include_once ('includes/connection.php');
	
	$article = new Article;
	$article_matches = 0;
	$fromdate = 0;
	$todate = 0;
?>

<html>

	<head>
		<title>CMS Tutorial</title>
		<link rel="stylesheet" href="./assets/styles.css">
	</head>
		
	<body>
				
		<div class="container">
		
			<a href="./index.php" id="logo">CMS</a>
			<br><br>
		
			<form action="trending.php" method="post" autocomplete="off">
				<input type = "text" name = "fromdate" placeholder = "Starting date" />
				<input type = "text" name = "todate" placeholder = "Ending date" />
				<input type = "submit" value = "Search for articles" />
			</form>
		</div>
		
		
		<div class="container">
			
		<?php
			if (isset($_POST['fromdate'], $_POST['todate']))
			{
				$fromdate = $_POST['fromdate'];
				$todate = $_POST['todate'];	

				if (empty($fromdate) or empty($todate))
				{
					$error = 'You must enter a date range to search for articles!';
				}
						
				else
				{
					if ($fromdate > $todate)	
						$error = 'You cannot have a starting date greater than the ending date!';
					else
					{
						$articles = $article->fetch_range($fromdate, $todate);
		?>
						<div class="container">
					
							<ol>
							<?php
								foreach ($articles as $article)
								{
							?>
									<li>
										<a href="displayarticle.php?id=<?php echo $article['article_id']; ?> ">
											<?php echo $article['article_title']; ?>
										</a>	
										-
										<small>
											posted: <?php echo date('l jS F Y', $article['article_timestamp']); ?> 
										</small>					
									</li>
							<?php
									$article_matches++;    
								}
							?>
							</ol>
								
							<small>
							<?php
								printf("There were %d articles that matched your criteria of", $article_matches);
								echo "<br>";
								echo date('l jS F Y', $fromdate);
								echo " To ";
								echo date('l jS F Y', $todate);
							?>	
				
						</div>
								
		<?php
					}
				}
			}
			
			if (isset($error))
			{
		?>
				<small style="color:#aa0000;">
		<?php
					echo $error;
		?>
				<br />
				</small>
		<?php 
			}
		?>

		</div>
	</body>
</html>
