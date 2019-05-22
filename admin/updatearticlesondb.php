<?php

/*	
	Start the session - this will enable the setting of the following $_SESSION variables
	
	$_SESSION['Page_Purpose'] = "index" - indicates that we are currently displaying the HOME page;
	
*/
	
	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}



	include_once ('../CMS/includes/article.php');
	include_once ('../CMS/includes/connection.php');

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
			<?php 
				include_once '../includes/head.php'
			?>
						<link rel="stylesheet" type="text/css" href="../CSS/MainStyles.css">
						<link rel="stylesheet" type="text/css" href="../CSS/bootstrap.css">
						<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
		</head>

		<body>
	
		<?php
			$_SESSION['ADMINPAGEYN'] = "NO";
			$_SESSION['MEMBERPAGEYN'] = "YES";
			
			$_SESSION['Page_Purpose'] = "updatearticles";

			include_once("../includes/header.php");
			include_once("../includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
			include_once("../includes/variables.php"); //new pagepurpose.php to identify the purpose
		?>	
			
<?php
/*	########################################################################################################################################
	This section holds the LHC of the welcome page. It holds a general greeting and general about us
	The <div class = "container"> is used to center the boxes (the section-box) on the screen	
	##################################################################################################################################### */
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
								<div class="StyledTable1 alert"> 
								
			<?php
				
				foreach ($articles as $article)
				{
					if($tablecolourbool == 0)	{	$tablecolour = 'FFFFFF';		$tablecolourbool = 1;		}
					else						{	$tablecolour = 'FFFFFF';		$tablecolourbool = 0;		}
				
					$tablecolourexception = 'FFFFFF';
				?>
					
					<div class="Container">
					
						<table class="articleUpdate"><tr>
							<td><i class="fas fa-plus"></i></td>
							<td><i class="fas fa-edit"></i></td>
							<td><i class="fas fa-trash-alt"></i></td>
							<td><i class="fas fa-eye"></i></td>
						</tr></table>
					</div>
					<div class="Container">	
						<table class="ArticleTable"> 
								<thead>	<tr>	<th colspan="13" bgcolor= <?php echo " $tablecolour " ?> >	<h12>&nbsp;</h12>	</th>   </tr>   </thead>
						
								<tbody>	
									<tr>
										<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	ID				</h11>	</td>	
										<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >			&nbsp;					</td>
										<td width="43%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	Article title	</h11>	</td>	
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
							</div>

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
