<?php 

	session_start();
	
	include_once ('../includes/connection.php');
	
	if (isset($_SESSION['logged_in']))
	{
		if (isset($_POST['title'], $_POST['content']))
		{
			$title = $_POST['title'];
			$content = nl2br($_POST['content']);	
			
			if (empty($title) or empty($content))
			{
				$error = 'All fields are required...please enter a title and some content';
			}
			else
			{
				$ts = time();
				$sql = "INSERT INTO articles (article_title, article_contents, article_timestamp) VALUES (?,?,?)"; 
				$q = $pdo->prepare($sql);
				$q->bindValue(1, $title);
				$q->bindValue(2, $content);
				$q->bindValue(3, $ts);
				$q->execute(); 									
 				header('Location: adminpage.php');
			}
		}
	?>
	
		<html>

			<head>
				<title>CMS Tutorial</title>
				<link rel="stylesheet" href="../assets/styles.css">
			</head>
		
			<body>
				<div class="container">
					<a href="../index.php" id="logo">CMS</a>
					<br />
					
					<h4>Add an article</h4>
					
					<?php
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
					
					<form action="add.php" method="post" autocomplete="off">
						<input type = "text" name="title" placeholder="Title"/>
						<br/><br/>
						<textarea rows = "15" cols="50" name="content" placeholder="Content">
						</textarea>
						<br/><br/>
						<input type="submit" value="Add article" />
					</form>				
				</div>
			</body>

		</html>
		
	<?php
	}
	else
	{
		header('Location: adminpage.php');
	}

?>