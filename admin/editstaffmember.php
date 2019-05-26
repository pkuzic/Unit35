
<?php

if (session_status() == PHP_SESSION_NONE) 
{
	session_start();
}

include_once ('../CMS/includes/article.php');
include_once ('../CMS/includes/connection.php');

$Member = new Member;
$members = $Member->fetch_all_members();



?>	

<html>
<head>

	<?php 
	include_once '../includes/head.php'
	?>


</head>

<body>	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	
<link rel="stylesheet" type="text/css" href="../CSS/MainStyles.css">
<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">
	
	<?php
		$_SESSION['ADMINPAGEYN'] = "NO";
		$_SESSION['MEMBERPAGEYN'] = "YES";

		$_SESSION['Page_Purpose'] = "editmember"; //Page purpose shows the title

		include_once("../includes/header.php"); //Header of the website
		include_once("../includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
		include_once("../includes/variables.php");
		include_once('./SetupCKEditorScript2.php');	
		include_once('CKEditorReplaceScript.php');
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
						
						<div class="alert"> <!--// Main block inside of wrap. Duplicate if required -->
						<div class="Container">

				<?php
		if ( isset( $_SESSION[ 'logged_in' ] ) ) {



			if ( $_SESSION[ 'logged_in_as_member' ] == false && $_SESSION[ 'logged_in_as_a_user' ] == true ) {
				?>
		<div class="CenterContent">



			<!-- This form is sent to the posted data page -->



			<form action="../CKEditorFiles/Editor/samples/sample_posteddata.php" method="post">

				<h11>
					Please input the <strong>NEW details</strong> for the<strong> current </strong>member
					<small>** PLEASE NOTE - ALL fields must be completed </small>
					<br>
					<hr><br> Original title for this article: <br><br>
					<?php echo "<h11>' <i> $data[member_name_first] </i>'</h11>" ; ?><br><br>

					<!-- Grab new title -->

					Please enter the <strong>NEW</strong> first name for this user <br>

					<?php $membernamefirst = $data['member_name_first']; ?>
					<input type="text" name="new_article_title" size=90 value="<?php echo $membernamefirst; ?>"/>
					<br><br>
					<hr><br> Original journal entry for this article: <br><br>
					<?php 
									foreach($members as $Member)
									{
										if ($journal['journal_id'] == $data['journal_reference'])
										{
											echo "' <i>" . $journal['journal_name'] . " :: published - " . date('l jS F Y', $journal['journal_published_date']) . "</i> '";
											break;
										}
									}
								?>
					<br><br> Please update the journal reference<br> What journal does this article belong to?<br>
					<select name="journal_number" style="width: 72% !important; min-width: 72%; max-width: 72%;">
						<?php 
										foreach($journals as $journal)
										{	
									?>
						<option value="<?php echo $journal['journal_id']; ?>">
							<?php
							echo $journal[ 'journal_name' ] . " :: published - " . date( 'l jS F Y', $journal[ 'journal_published_date' ] );
							?>
						</option>
						<?php
						}
						?>
					</select>
					<br><br>
					<hr><br>
					<?php
					/*	------------------------------------------------------------------------------------------------------------------------------------------
					We want to allow the user to enter an abstract. This is done via CKEditor
					--------------------------------------------------------------------------------------------------------------------------------------	*/
					?>
					<?php
					echo "<i>" . "Full article abstract shown below. Please make your desired changes <br><br></i>";
					?> Please enter the <strong>NEW</strong> abstract for this article<br>

					<textarea cols="80" id="editor1" name="editor1" rows="10">
						<?php 
										$abstract = "<h11><i>Abstract: </i><br><br>" . $data['article_abstract'] . "</h11>"; 
										echo $abstract;
									?>


					</textarea>

					<?php include_once ('CKEditorReplaceScript.php');	?>

					<br><br>
					<hr><br>
					<?php
					/*	------------------------------------------------------------------------------------------------------------------------------------------
					We now want to get the user to enter the file name (from the server). We will eventually involve an FTP upload feature 
					to allow the user to upload the file from the particular folder on the localdisk to the server
					--------------------------------------------------------------------------------------------------------------------------------------	*/
					?> Original file entry (file associated with) for this article: <br><br>
					<?php
					echo "' <i>" . $data[ 'article_reference' ] . "</i> '";
					?>
					<br><br> Please enter the <strong>NEW</strong> path to the full article (PDF) &emsp;&emsp;
					<input type="file" name="New_article_path" value="<?php $data['article_reference'] ?>">
					<br><br>
					<hr><br>

					<?php
					/*	------------------------------------------------------------------------------------------------------------------------------------------
					We want to allow the user to select a person from the user list - only users (Prof, Dr, and Mr - researchers) are allowed to 
					enter articles onto the databases. This is done through a list box
					--------------------------------------------------------------------------------------------------------------------------------------	*/
					?> Original publisher for this article: <br><br>
					<?php 
									foreach($users as $user)
									{	
										if ($user['user_id'] == $data['article_author']) 
										{

											echo 	" ' <i>" . 	$user['user_name_title'] . " " . 
																$user['user_name_first'] . " " . 
																$user['user_name_last'] . " </i> '";
											break;
										}
									}
								?>
					<br><br> Please enter the <strong>NEW</strong> publisher of this article <br>
					<select name="article_author" style="width: 72% !important; min-width: 72%; max-width: 72%;">
						<?php 
										foreach($users as $user)
										{	
											if ($user['user_research_area'] != "NA") 
											{
							?>
						<option value="<?php echo $user['user_id']; ?>">
							<?php
							echo $user[ 'user_name_title' ] . " " .
							$user[ 'user_name_first' ] . " " .
							$user[ 'user_name_last' ] . " ";
							?>
						</option>
						<?php
						}
						}
						?>
					</select>
					<br><br>
					<hr><br>
					<?php
					/*	------------------------------------------------------------------------------------------------------------------------------------------
					We will ge the date from a javascript calendar control
					--------------------------------------------------------------------------------------------------------------------------------------	*/
					?> Please be aware. editing an article will <strong>ALWAYS</strong> automatically update its timestamp<br><br> This article will be now be published with the following datestamp &emsp;&emsp;

					<?php
					$ts = time();
					$datestring = date( 'l jS F Y', $ts );
					$_SESSION[ 'time_date_raw' ] = $ts;
					$_SESSION[ 'time_date_formatted' ] = $datestring;
					echo "    " . $datestring;
					?>
					<p>

						<input type="submit" value="Submit">
			</form>

		</div>

		<br style="clear: left;"/>
		<?php
		} elseif ( $_SESSION[ 'logged_in_as_member' ] == TRUE && $_SESSION[ 'logged_in_as_a_user' ] == FALSE ) {
				?>
		<div class="CenterContent">
			<?php
			echo "	<h11>Hello there. <br><br>It appears that you are not a member of staff. 
									<br><br>Members are not allowed in the administration section
									<br><br>Please logout out OR return to the members area<p>";
			?>
			<a href="logout.php" class="memberlink">Logout<p>
							<a href="../members.php" class = "memberlink">Return to the members area<p>
						</div>
					<?php
					}
				}
				
				else				// not logged in
				{
?>
					<div class = "CenterContent">
<?php
						echo "	<h11>Hello there. <br><br>It appears that you are not a logged in. 
									<br><br>You must log into the system to use administration features
									<br><br>Please visit the to the administration page...
									<br><br>If you are a not an employee of the centre, please visit our members section to login;
									<br><br>Or, please visit our registration page to become a member (registration is FREE)<p><p><p>";
?>
						<a href="../members.php" class = "memberlink">Members area</a>
			<p>
				<a href="../registration.php" class="memberlink">Registeration</a>
				<p>
					<a href="adminpage.php" class="memberlink">Return to the admin area</a>
					<p>

		</div>

		<?php
		}
		?>

						</div> <!-- END Main -->

					</div>

				</div>
				<div class="sidenav col-md-2 sidenav navbar-light"> <!-- Side bar! -->
					Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies vestibulum luctus. Aenean tincidunt eget felis vel maximus. Nunc id sapien elementum, sagittis quam luctus, dictum nisi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc egestas, augue non cursus sodales, felis tortor dictum elit, fringilla rutrum turpis ex ac libero. Nullam at ipsum laoreet dui blandit finibus. Interdum et malesuada fames ac ante ipsum primis in faucibus. Praesent auctor iaculis elit eu interdum. Maecenas at libero id ante placerat imperdiet. Quisque vitae cursus ligula. Cras ac scelerisque dui.
				</div>

				<br style="clear: left;" />
			</div>
		</div>
	</div>
</div>


<!-- END of MAIN BODY div -->								

<!-- END of PAGE CONTAINER div -->								

</body>

</html>