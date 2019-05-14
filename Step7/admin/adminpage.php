<?php 

	// mp5 and blowfish
	// echo md5('password');
	
	session_start();
	
	include_once ('../includes/connection.php');
	
	if (isset($_SESSION['logged_in']) == true)
	{
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
					<ol>
						<li>	
							<a href="add.php">Add an article</a>	
						</li>
					
						<li>	
							<a href="delete.php">Delete an article</a>		
						</li>
					
						<li>
							<a href="logout.php">Logout of admin</a>
						</li>
					</ol>
				</div>
			</body>

		</html>
<?php	
	}
// only for resetting the $_SESSION
// if you are logged in no matter what happens then
// comment to else out and uncomment the if
// this forces the login screen to be activated. then
// you can set reverse the comments and everything is 
// tickerty-boo

//	if ($_SESSION['logged_in']);
	else
	{
		if (isset($_POST['username'], $_POST['password']))
		{
			$username = $_POST['username'];
			$password = $_POST['password'];	

			if (empty($username) or empty($password))
			{
				$error = 'All fields are required!';
			}
				
			else
			{
				$query = $pdo->prepare("SELECT * FROM users WHERE user_name = ? AND user_password = ?");
				$query->bindValue(1, $username);
				$query->bindValue(2, $password);
				$query->execute();
					
				$num = $query->rowCount();
					
				if ($num == 1)
				{
					$_SESSION['logged_in'] = true;
					header('Location: adminpage.php');
					exit();
				}
					
				else
				{
					$error = "Sorry - incorrect details entered";
					session_destroy();
				}
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
				<br /> <br />
				
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
			
					
				<form action="adminpage.php" method="post" autocomplete="off">
					<input type = "text" name = "username" placeholder = "Username" />
					<input type = "password" name = "password" placeholder = "Password" />
					<input type = "submit" value = "Login" />
				</form>
			</div>
		</body>

	</html>
	
	<?php
	}
?>
