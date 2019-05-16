<?php

/* IFHS INDEX */ 
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('../includes/article.php');
	include_once ('../includes/connection.php');
		
	$journal = new Journal;
	$journals = $journal->fetch_journal_details();
	$journals2 = $journal->fetch_journal_details();
	
	$user = new Users;
	$users = $user->fetch_researcher_details();
	
	$article = new Article;
	$articles = $article->fetch_all();
	
	$tablecolourbool = 0;
	$tablecolour = 0;
	$tablecount = 0;
	
	$id = 4;
	$data = $article->fetch_data($id);	
	
?>	
	
	<html>

		<body>

			<?php $titletext = $data['article_title']; ?>
			<input 	type = "text" 
					name="new_article_title" 
					size=90 
					value = "<?php echo $titletext ?>" 
			/>
			<br><br>

		</body>
	</html>
