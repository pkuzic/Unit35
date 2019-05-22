
<?php

if (session_status() == PHP_SESSION_NONE) 
{
	session_start();
}

include_once ('CMS/includes/article.php');
include_once ('CMS/includes/connection.php');

$article = new Article;
$articles = $article->fetch_all();

?>	

<html>
<head>

	<?php 
	include_once 'includes/head.php'
	?>


</head>

<body>	<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
	
<link rel="stylesheet" type="text/css" href="CSS/MainStyles.css">
<link rel="stylesheet" type="text/css" href=" CSS/bootstrap.css">
	
	<?php
	$_SESSION['ADMINPAGEYN'] = "NO";
	$_SESSION['MEMBERPAGEYN'] = "YES";

	$_SESSION['Page_Purpose'] = "journal"; //Page purpose shows the title

		include_once("includes/header.php"); //Header of the website
		include_once("includes/pagepurpose.php"); //new pagepurpose.php to identify the purpose
		include_once("includes/variables.php"); //new pagepurpose.php to identify the purpose
		?>	




		<div class="Container">		
			<!-- header -->	
			<div class="container-fluid">
				<div class="row">
					<?php 
					include_once 'includes/leftside.php'
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

								Enter content here!

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