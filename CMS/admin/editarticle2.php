<?php

/* IFHS INDEX */ 

	if (session_status() == PHP_SESSION_NONE) 
	{
		session_start();
	}
	
	include_once ('../includes/article.php');
	include_once ('../includes/connection.php');

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
			<link rel="stylesheet" type="text/css" href="../../CSS/MainStyles.css">
		</head>

		<body>

			<div class="Container"> 																	<!-- overall page container div -->
				<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
		
				<div class="section-box">	<h12><?php echo "a"; ?></h12>		</div>
				<div class="section-box2">	<h12><?php echo "b"; ?></h12>		</div>
				<div class="section-box3" align="right">	<?php //include_once("memberloginimagemap.php"); ?>		</div>
				<br style="clear: left;" />				
				
			 	<div class = "Menu">		</div>
				
					

<!-- START of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->			

				<div class="PagePurpose">			
					<table border="0" cellpadding="5" cellspacing="0" width="800px">
						<tr>	<td align="left" colspan="6">	 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	 	</td>	</tr>
						<tr>	<td align="left" colspan="6">	<h7>	Edit and article...</h7> 	</td>	</tr>
					</table>
				</div>
			
			</div>
<!-- END of PAGE TITIEL - e.g. welcome, journal, aboutus, etc. -->							
			
			<div class="Container">
				<!-- <table border="0" width="100%" cellspacing="0" cellpadding="0" align=center class="tableindex"> -->
				
				<table width="700" class="tableindexroundedtopandbottom"> 
					<thead>	
						<tr>	
							<th colspan="6" bgcolor="#99BBFF">
								<h12>
									Current articles...
								</h12>
							</th>   
						</tr>   
					</thead>
				</table>
				<br>
																	
				<?php
				
				foreach ($articles as $article)
				{
					if($tablecolourbool == 0)	{	$tablecolour = "#99BBFF";		$tablecolourbool = 1;		}
					else						{	$tablecolour = "#CCBBFF";		$tablecolourbool = 0;		}
				?>
					<table class="tableindex"> 
						<thead>	<tr>	<th colspan="11" bgcolor= <?php echo " $tablecolour " ?> >	<h12>&nbsp;</h12>	</th>   </tr>   </thead>
							
						<tbody>	
							<tr>
								<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	ID				</h11>	</td>	
								<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >			&nbsp;					</td>
								<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	View			</h11>	</td>	
								<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >			&nbsp;					</td>
								<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 	<h11>	Edit			</h11>	</td>	
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
								
								
								<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 
									<?php
										echo "<a href = ../../displayarticle.php?id=" . $article['article_id'] . ">"; 
									?>
											<img border="0" src="../../images/mg.png" width="26" height="26">	
									<?php
										echo "</a>"; 
									?>
									
								</td>	
							
								<td width="2%" bgcolor= <?php echo " $tablecolour " ?> >	&nbsp;	</td>
								
								<td width="5%" bgcolor= <?php echo " $tablecolour " ?> > 
									<?php
										echo "<a href = ../../displayarticle.php?id=" . $article['article_id'] . ">"; 
									?>
											<img border="0" src="../../images/bp.png" width="26" height="26">	
									<?php
										echo "</a>"; 
									?>
									
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
						</tbody>
							
						<tfoot>	
							<tr>	
								<th colspan="11" bgcolor= <?php echo " $tablecolour " ?> >
									<h12>	
										<?php 
											$tablecount++;
											echo "Showing ($tablecount) of ($numberofarticles) Researchers"; 
										?> 
									</h12>
								</th>    
							</tr>   
						</tfoot>
					</table>
					<br>
			<?php	
				}
			?>
				<table class="tableindexroundedtopandbottom"> 
					<tfoot>	
						<tr>	
							<th colspan="6" bgcolor = <?php echo "#99BBFF" ?> >
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
