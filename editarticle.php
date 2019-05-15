<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('./CMS/includes/article.php');
	include_once ('./CMS/includes/connection.php');

	$article = new Article;
	
	if (isset($_GET['id']))		{	$id = $_GET['id'];					$data = $article->fetch_data($id);	}
	else						{	header('location: index.php');		exit();								}
	
	$displayarticle = 0;
	
?>
	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">
			<link rel="stylesheet" type="text/css" href="./CSS/bootstrap.css">
			<link rel="stylesheet" type="text/css" href="./CSS/displayarticleCSS.css">

			<?php	include_once('./SetupCKEditorScript1.php');	?>
			
		</head>

		<body>

			<div class="Container"> 																	<!-- overall page container div -->
				<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
				<div class = "Menu">		</div>
				

	<!-- START of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->			

				<div class="PagePurpose">			
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	 	</td>	</tr>
						<tr>	<td align="left" colspan="6">		<h7>	Displaying article: <?php echo " $data[article_title] "; ?> </h7> 	</td>	</tr>
					</table>
				</div>
				<br style="clear: left;" />
				<div class = "container";
				
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	 	<hr>	</td>	</tr>
					</table>
				</div>
				<br style="clear: left;" />
				
				<?php $abstract = "<h11><i>Abscract: <br><br>" . $data['article_abstract'] . "</i></h11>"; ?>
									
				<div class="container">
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	<?php echo ""; ?>	</td>	</tr>
						<tr>	<td align="left" colspan="6">	<?php echo ""; ?>	</td>	</tr>
						
						<div class="Container"> 																	<!-- overall page container div -->
							<div class="CenterContent">
								<textarea cols="80" id="editor1" name="editor1" rows="10" class="textareastyles" disabled>	
									<?php  
										echo ($abstract);
									?>
								</textarea>
		
								<?php	
								include_once('./CKEditorReplaceScriptCustomToolbar.php');	
								?>
																				
							</div>
							<br style="clear: left;" />

						</td></tr>
										

						<tr>	<td align="left" colspan="6">	<?php echo ""; ?>	</td>	</tr>
												
<!-- END of PAGE TITLE - e.g. welcome, journal, aboutus, etc. -->							
				
<?php					if (isset($_SESSION['logged_in']))	
						{			
?>
							<tr>	<td align="left" colspan="6">	
									<img src="./images/PDFIcon.png" align = "left" alt="full article below " width="30" height="30">
									<img src="./images/reddownbutton.png" align = "left" alt="full article below " width="30" height="30">
									
									<h10>
									<?php
										// members are member of the public and users are staff
										if ($_SESSION['logged_in_as_member'] ==	FALSE && $_SESSION['logged_in_as_a_user'] 	==	TRUE)
										{
											echo "You are currently logged in as a staff member, full article follows"; 
										}
										else if ($_SESSION['logged_in_as_member'] == TRUE && $_SESSION['logged_in_as_a_user'] 	==	FALSE)
										{
											echo "You are currently logged in as a member of the public, full article follows";	
										}
									?>
									</h10>
										
								</td>	
							</tr>

							<div class="PDFDisplaybox">
							<tr>	
								<td align="left" colspan="6">	
									<embed src= <?php echo "$data[article_reference]"; ?> width="100%" height="600">  
								</td>
							</tr>
							<div>
<?php
						}
						else		
						{	// header('Location: members.php');	}			
?>
							<tr>	<td align="left" colspan="6">	 	</td>	</tr>
							<tr>	<td align="left" colspan="6">	 	</td>	</tr>
							<tr>	<td align="left" colspan="6">		<h9> 	<?php echo "To read the full article please subscribe"; ?>	</h9>	</td>	</tr>
							<tr>	<td align="left" colspan="6">	 	</td>	</tr>
							<tr>	<td align="left" colspan="6">		<h11> <a href = "members.php" class="loginink">Click here to login</a>	<h11>	</td>	</tr>
							<tr>	<td align="left" colspan="6">		<h11> <a href = "register.php" class="loginlink">Click here to register as a member<small> membership is FREE</small> </h11></a>	</td>	</tr>
<?php
						}
?>
					</table>
				</div>
			</div>

			<p><p><p><p>
			
	<!-- END of MAIN BODY div -->								

	<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
				
	<!-- END of FOOTER -->			
		
		</div> 

	</body>
</html>

	

