<?php

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('./CMS/includes/article.php');
	include_once ('./CMS/includes/connection.php');

	$journal = new Journal;
	$article = new Article;
	$user = new Users;
	$articlecount = 0;
?>	

	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">
			
			<script language="javascript" src="./xinpopcalendar/cal2.js">
			/*
				Xin's Popup calendar script-  Xin Yang (http://www.yxscripts.com/)
				Script featured on/available at http://www.dynamicdrive.com/
				This notice must stay intact for use
			*/
			</script>
			
			<script language="javascript" src="./xinpopcalendar/cal_conf2.js"></script>
			
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
						<tr>	<td align="left" colspan="6">	<h9>	Search for particular articles between a date range </h9> 	</td>	</tr>
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
						
							$articles = $article->fetch_all();
						//	$users = $user->fetch_researcher_details();
						//	$users2 = $user->fetch_researcher_details();			// this is used for the heading below
?>							
							<div class="container">
															
								<tr>	<td align="left" colspan="6">	
											<div class = "CenterContent">
												<table align="center">
													<tr>	<td>																								
																<form name="sampleform" action = "searchdates.php?firstinput&secondinput">
																	<input type="text" name="firstinput" size=20> 
																		<h13> <a href="javascript:showCal('Calendar1')" class="choosecalendardate">Select Date</a></h13>
																	<p>
																	<input type="text" name="secondinput" size=20> 
																		<h13> <a href="javascript:showCal('Calendar2')" class="choosecalendardate">Select Date</a></h13>
																	<p>
																	<input type="submit" value="Search between specified dates">
																</form>
															</td>
													</tr>
												</table>
											</div>
										</td>
								</tr>
							</div>
						
						<?php
							if (isset($_GET['firstinput']) AND isset($_GET['secondinput']))
							{
								$datefrom = $_GET['firstinput'];	$timestampfrom = strtotime($datefrom); /* e.g. 1072915200 */ $tendigitfrom = idate('U', $timestampfrom);
								$dateto = $_GET['secondinput'];	$timestampto = strtotime($dateto); 	   /* e.g. 1072915200 */ $tendigitto = idate('U', $timestampto);
								$articles = $article->fetch_range($timestampfrom, $timestampto);
								//echo $datefrom;
								
								if ($tendigitfrom > $tendigitto)
								{
									$temp = 0;
									$temp = $tendigitto;
									$tendigitto = $tendigitfrom;
									$tendigitfrom = $temp;
									
									$temp = 0;
									$temp = $dateto;
									$dateto = $datefrom;
									$datefrom = $temp;
								}
								
								$articles = $article->fetch_range($tendigitfrom, $tendigitto);
							
							//	<script>	alert("in the if");	</script>
							
									
								foreach ($articles as $article)		
									$articlecount++;
						?>
								
								<tr>	<td align="left" colspan="6">	<h8><i> <?php echo "<h9>There were " . $articlecount . " articles found for the dates between........" . $datefrom . " to " . $dateto . "</h9>"; ?> </i></h8> </td>	</tr>						
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
							else	{	/* <script>	alert("in the else");	</script> */	}
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

	

