<?php

session_start();

include_once( '../CMS/includes/article.php' );
include_once( '../CMS/includes/connection.php' );

$user = new Users;
$users = $user->fetch_researcher_details();

if ( isset( $_SESSION[ 'logged_in' ] ) ) {
	if ( isset( $_GET[ 'id' ] ) ) {
		$id = $_GET[ 'id' ];
		$query = $pdo->prepare( 'DELETE FROM users WHERE user_id = ?' );
		$query->bindValue( 1, $id );
		$query->execute();

		header( 'Location: editstaffmember.php' );

	}

	?>
	<html>

	<head>
		<title>CMS Tutorial</title>
		<link rel="stylesheet" href="../assets/styles.css">
		<link rel="stylesheet" type="text/css" href="../CSS/MainStyles.css">
		<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">
	</head>

	<body>
		<div class="container">
			<a href="../index.php" id="logo">CMS</a>
			<br/>

			<h4>
						Select and article to delete
					</h4>
		

			<form action="editstaffmember.php" method="get">
				<select name="id">
					<?php 
							foreach($users as $user)
							{
						?>
					<option value="<?php echo $user['user_id']; ?>">
						<?php
						echo $user[ 'user_name_first' ];
						?>
					</option>
					<?php
					}
					?>
				</select>
				<input class="form-control" type="submit" value="Submit">
			</form>

		</div>
	</body>

	</html>
	<?php
} else {
	header( 'Location: adminpage.php' );
}

?>