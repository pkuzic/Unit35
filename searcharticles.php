<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('./CMS/includes/article.php');
	include_once ('./CMS/includes/connection.php');

	$journal = new Journal;
	$article = new Article;
	$articlecount = 0;
?>	

	<html>

		<head>
			<?php 
				include_once 'includes/head.php'
			?>
		</head>

		<body>

			<div class="Container"> 																	<!-- overall page container div -->
				<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
				<div class = "Menu">		</div>
				

	<!-- START of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->			

				<div class="PagePurpose">			
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	 <?php echo ""; ?>  	</td>	</tr>
						<tr>	<td align="left" colspan="6">	<h7>	Welcome to the centres archive: </h7> 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	 <?php echo ""; ?>  	</td>	</tr>
						<tr>	<td align="left" colspan="6">	<h9>	Search our archives from a particular journal </h9> 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	 <?php echo ""; ?>  	</td>	</tr>
					</table>
				</div>
									
				<div class="container">
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	<h8><i> <?php echo ""; ?> </i></h8> </td>	</tr>
						<tr>	<td align="left" colspan="6">	<h8><i> <?php echo ""; ?> </i></h8> </td>	</tr>
<!-- END of PAGE TITLE - e.g. welcome, journal, aboutus, etc. -->							
				
						<?php
						if (isset($_SESSION['logged_in']))	
						{			
						
							$journals = $journal->fetch_journal_details();
							$journals2 = $journal->fetch_journal_details();
?>							
							<div class="container">
															
								<tr>	
									<td align="left" colspan="6">	
										<div class = "CenterContent">
											<p>
											<form action = "searcharticles.php" method = "get">
												<select onchange="this.form.submit()" name="id">
										
													<option value = "0">	<?php	echo "Please select a journal" ;	?>	</option>
												<?php 
													foreach($journals as $journal)
													{	
												?>
														<option value = "<?php echo $journal['journal_id']; ?>">
												<?php
															echo $journal['journal_name'] . " :: published - " . date('l jS F Y', $journal['journal_published_date']);
												?>
														</option>
												<?php		
													}
												?>
												</select>
											</form>
									</div>
									</td>
								</tr>

							</div>

						<?php
							if (isset($_GET['id']))
							{
								$id = $_GET['id'];
								$articles = $article->fetch_all_particular_journal($id);
								
								foreach ($journals2 as $journal) 
								{
									if ($journal['journal_id'] == $id)
										$journaltitle = $journal['journal_name'];
								}
						?>				

						<?php		
									//<script>	alert("in the if");	</script>
									
									foreach ($articles as $article)
										$articlecount++;
						?>
										<tr>	<td align="left" colspan="6">	<h8><i> <?php echo "<h9>There were " . $articlecount . " articles found for journal........" . $journaltitle . ". </h9>"; ?> </i></h8> </td>	</tr>						
										<tr>	<td align="left" colspan="6">	<h8><i> <?php echo " "; ?> </i></h8> </td>	</tr>																
						<?php
									foreach ($articles as $article)
									{
						?>
										<tr>	<td width="55%">
													<div class = "container">
													
														<a href="displayarticle.php?id=<?php echo $article['article_id']; ?>" class="foundarticles">
															<img src="./images/PDFIcon.png" align = "left" alt="Click here to read this article" width="30" height="30">
															<br>
															Click here to read: <?php echo $article['article_title']; ?>
														</a>
													<?php 						
														//echo "<p><h10><i>Article Title: </i></h10><h11>" . $article['article_title'] . "</h11><hr>"; 
													?>
														<p>
														<img src="./images/redrightbutton.png" align = "left" alt="full article below " width="25" height="25">
														
													<?php
														echo "<h10><i>Article Abstract: </i></h10><h11>" . $article['article_abstract'] . "</h11>";
														echo "<p><h10><i>Article Published: </i></h10><h11>" . date('l jS F Y', $article['article_published_date']) . "</h11>";
													?>
													
													</div>
												</td>	
										</tr>									
						<?php
									}
						?>
								</div>
						<?php
							}
							else	
							{	
								/* <script>	alert("in the else");	</script> */	
							}
						}							
						else		
						{	// header('Location: members.php');	}			
?>							
							<tr>	<td align="left" colspan="6">	 	<hr> </td>	</tr>
							<tr>	<td align="left" colspan="6">		<h9> 	<?php echo "To search for journal articles please subscribe"; ?>	</h9>	</td>	</tr>
							<tr>	<td align="left" colspan="6">	 	<hr>    </td>	</tr>
							<tr>	<td align="left" colspan="6">		<h11> <a href = "members.php" class="loginink">Click here to login</a>	<h11>	</td>	</tr>
							<tr>	<td align="left" colspan="6">		<h11> <a href = "register.php" class="loginlink">Click here to register as a member<small> membership is FREE</small> </h11></a>	</td>	</tr>

<?php
						}
?>
						<tr>	<td align="left" colspan="6">		<h11> <a href = "members.php" class="loginink">Click here to return to the members area...</a>	<h11>	</td>	</tr>

					</table>
				</div>
			</div>
			<div class = "container">
				<H9>
			<p><p><p><p>
			
	<!-- END of MAIN BODY div -->								

	<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
				
	<!-- END of FOOTER -->			
		
		</div> 

	</body>
</html>

	

