<?php

if ( session_status() == PHP_SESSION_NONE ) {
	session_start();
}

include_once( '../CMS/includes/article.php' );
include_once( '../CMS/includes/connection.php' );

$member = new Members;
$members = $member->fetch_all_members()

if ( isset( $_SESSION[ 'logged_in' ] ) ) {
	if ( isset( $_GET[ 'id' ] ) ) {
		$id = $_GET[ 'id' ];
		$query = $pdo->prepare( 'DELETE FROM member WHERE member_id = ?' );
		$query->bindValue( 1, $id );
		$query->execute();



	} 

	?>
	<html>

	<head>

		<?php 
	include_once '../includes/head.php'
	?>


	</head>

	<body>
		<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">

		<link rel="stylesheet" type="text/css" href="../CSS/MainStyles.css">
		<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">

		<?php
		$_SESSION[ 'ADMINPAGEYN' ] = "NO";
		$_SESSION[ 'MEMBERPAGEYN' ] = "YES";

		$_SESSION[ 'Page_Purpose' ] = "adminpage"; //Page purpose shows the title

		include_once( "../includes/header.php" ); //Header of the website
		include_once( "../includes/pagepurpose.php" ); //new pagepurpose.php to identify the purpose
		include_once( "../includes/variables.php" ); //new pagepurpose.php to identify the purpose
		?>




		<div class="Container">
			<!-- header -->
			<div class="container-fluid">
				<div class="row">
					<?php 
					include_once '../includes/leftside.php'
					?>

					<div id="wrapper" class="col-md-8 text-left">

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

						<div class="alert">
							<!--// Main block inside of wrap. Duplicate if required -->
							<div class="Container">


								<form action="editstaffmember.php" method="get">
									<select name="id">
										<?php 
							foreach($users as $user)
							{
						?>
										<option value="<?php echo $user['user_id']; ?>">
											<?php
											echo $user[ 'user_name_first' ] ;
											echo " ";
											echo  $user[ 'user_name_last' ] ;	
											?>
										</option>
									<?php } ?>
									</select>
									<input class="form-control" type="submit" value="Submit">
								</form>

							</div>
							<!-- END Main -->

						</div>

					</div>
					
				</div>
			</div>
		</div>
		


		<!-- END of MAIN BODY div -->

		<!-- END of PAGE CONTAINER div -->

	</body>
	<?php
} else {
	header( 'Location: adminpage.php' );
}
?>
	</html>