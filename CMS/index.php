<?php
	include_once ('includes/article.php');
	include_once ('includes/connection.php');
		
	$article = new Article;
	$articles = $article->fetch_all();

?>
<html>

	<head>
		<title>CMS Tutorial</title>
		<link rel="stylesheet" href="assets/styles.css">
	</head>
	
	<body>
		<div class="container">
			<a href="index.php" id="logo">CMS</a>
			
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
							posted: <?php echo date('l jS F Y', $article['article_published_date']); ?> 
						</small>					
					</li>
			<?php
				}
			?>
			</ol>
			
			<small>
				<a href = "./admin/adminpage.php">admin</a>
			</small>
		</div>
	</body>

</html>