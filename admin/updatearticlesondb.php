<?php

/*	########################################################################################################################################
	Start the session - this will enable the setting of the following $_SESSION variables
	
	$_SESSION['Page_Purpose'] = "index" - indicates that we are currently displaying the HOME page;
	
	##################################################################################################################################### */
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}

/*	########################################################################################################################################
	Include the Php libraries
	
	article.php		- contains all of the classes that are used throughout the solution
	connection.php	- connects to the DB

	##################################################################################################################################### */

	include_once ('../includes/connection.php');
	include_once ('../includes/article.php');

	$article = new Article;
	$articles = $article->fetch_all_date_descending();
		
	$user = new Users;
	$users = $user->fetch_researcher_details();
	$usercount = 0;
	$numberofarticles = 0;
	
	$user_array_title = array();
	$user_array_first_name = array();
	$user_array_last_name = array();
	
	foreach ($users as $user)
	{
		$user_array_title[$usercount] = $user['user_name_title'];
		$user_array_first_name[$usercount] = $user['user_name_first'];
		$user_array_last_name[$usercount] = $user['user_name_last'];
		$usercount++;
	}
	
	foreach ($articles as $article)
	{
		$numberofarticles++;
	}
	
	$tablecolourbool = 0;
	$tablecolour = 0;
	$tablecount = 0;
		
?>	
	
	<html>

		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="../CSS/MainStyles.css">
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "YES";
			$_SESSION['MEMBERPAGEYN'] = "NO";
			
			$_SESSION['Page_Purpose'] = "updatearticles";
			include_once("../includes/pagepurpose.php");
		?>	
			
			<div class="Container">
				<!-- <table border="0" width="100%" cellspacing="0" cellpadding="0" align=center class="tableindex"> -->
				
				<table class="tablewithroundedtopandbottom"> 
					<thead>	
						<tr>	
							<th colspan="6">
								<h12>
									&nbsp;<br>Our latest articles (<em>newest article first</em>)...<br>&nbsp;
								</h12>
							</th>   
						</tr>   
					</thead>
				</table>
				<br><br>
																	
				<?php
				
				foreach ($articles as $article)
				{
					if($tablecolourbool == 0)	{	$tablecolour = 'FFFFFF';		$tablecolourbool = 1;		}
					else						{	$tablecolour = 'FFFFFF';		$tablecolourbool = 0;		}
				
					$tablecolourexception = 'FFFFFF';
				?>
					
					<div class="Container">
					
					<?php
						include("../CommonPages/ArticleNavigation.php");		// use an include NOT an include_once as if include_once is used
																				// then the nave bar only shows once - use include in the 
																				// ArticleNavigation.php for the same reason
					?>	
					</div>
					
					<div class="Container">	
						<table class="ArticleTable"> 
								<thead>	<tr>	<th colspan="13" bgcolor= <?php echo " $tablecolour " ?> >	<h12>&nbsp;</h12>	</th>   </tr>   </thead>
						
								<tbody>	
									<tr>
										<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	ID				</h11>	</td>	
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >			&nbsp;					</td>
										<td width="43%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	Article title	</h11>	</td>	
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >			&nbsp;					</td>
										<td width="15%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	Author			</h11>	</td>	
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >			&nbsp;					</td>
										<td width="15%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	Published		</h11>	</td>		
									</tr>
								
									<tr>	
										<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<h11>	<?php 	$name_string = 	$article['article_id'];
															echo $name_string;
													?>
											</h11>
										</td>	
								
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >	&nbsp;	</td>
								
										<td width="43%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<h11>	<?php 	$name_string = 	$article['article_title'];
															echo $name_string;
													?>
											</h11>
										</td>	
									
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >	&nbsp;	</td>
			
										<td width="15%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<h11>
												<?php 
													$staffmember = $article['article_author'];
													$namestring = 	$user_array_title[$staffmember] . " " .
																	$user_array_first_name[$staffmember] . " " .
																	$user_array_last_name[$staffmember]; 
													echo $namestring; 
												?> 		
											</h11>
										</td>		
									
							
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >	&nbsp;	</td>
								
										<td width="24%" bgcolor= <?php echo " $tablecolour " ?> > 		
											<h11>
												<?php 
													echo date('l jS F Y', $article['article_published_date']);
												?> 		
											</h11>
										</td>		
									</tr>									
									
									<tr>
										<td colspan="8" bgcolor= <?php echo " $tablecolour " ?> > 
											<h12>
												<br>&nbsp;
											</h12>
										</td>
									</tr>
								</tbody>
												
								<tfoot>	
									<tr>	
										<th colspan="8" bgcolor=<?php echo " $tablecolour " ?> >
											<h12>	
												<?php 
													$reverse_tablecount = $numberofarticles - $tablecount;
													echo "Showing ($reverse_tablecount) of ($numberofarticles) Researchers"; 
													$tablecount++;
													
													
												?> 
											</h12>
										</th>   
									</tr>   
								</tfoot>
							</table>
						</div>
						<br>
					
					</div>
					<hr>
					<br>

			<?php	
				}
			?>
				<table class="tableindexroundedtopandbottom"> 
					<tfoot>	
						<tr>	
							<th colspan="6" bgcolor = <?php echo " $tablecolour " ?> >
								<h12>
									&nbsp;
								</h12>
							</th>    
						</tr>   
					</tfoot>
				</table>

			</div>
			<br style="clear: left;" />
			
			
<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			
		</div>	
<!-- END of PAGE CONTAINER div -->								

	</body>
</html>
