<?php

	include_once ('includes/article.php');
	include_once ('includes/connection.php');

	$article = new Article;
	
	if (isset($_GET['id']))
	{
		$id = $_GET['id'];
		$data = $article->fetch_data($id);
	}
	
	else
	{
		header('location: index.php');
		exit();
	}
	
?>
	
	<html>

		<head>
			<title>CMS Tutorial</title>
			<link rel="stylesheet" href="assets/styles.css">
		</head>
	
		<body>
			<div class="container">
				<a href="index.php" id="logo">CMS</a>
				
				<h4>
				<?php	
					echo $data['article_title']; 
				?>
				
					<small>
						- posted: 
						<?php
						echo date('l jS F Y', $data['article_timestamp']); 
						?>
					</small>
				
				</h4>
				
				<p>
				<?php	
					echo $data['article_contents']; 
				?>
				</p>
				
				<small2>
					<a href = "index.php">&larr; Back</a>
				</small2>
			</div>
		</body>

	</html>
	