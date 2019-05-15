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

	include_once ('./CMS/includes/article.php');
	include_once ('./CMS/includes/connection.php');

	$article = new Article;									//	a new instance of class article
	$articles = $article->fetch_all_date_descending();		// 	Get all of the articles in the database table (in descending order of date)
	
?>	
	
	<html>
		<head>
			<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
			<link rel="stylesheet" type="text/css" href="./CSS/MainStyles.css">
			<link rel="stylesheet" type="text/css" href="./CSS/bootstrap.css">
		
<!-- START of CALENDAR includes and script -->

			<meta charset='utf-8' />
			<link href='./FullCalendar/fullcalendar.css' rel='stylesheet' />
			<link href='./FullCalendar/fullcalendar.print.css' rel='stylesheet' media='print' />
			<script src='./FullCalendar/lib/moment.min.js'></script>
			<script src='./FullCalendar/lib/jquery.min.js'></script>
			<script src='./FullCalendar/fullcalendar.min.js'></script>

			<script type="text/javascript">

				$(document).ready(function() {

					$('#calendar').fullCalendar({
						editable: true,
						eventLimit: true,
						eventSources:
						[
							{   // Render the events in the calendar
								url: './FullCalendar/demos/json/events.json', // Get the URL of the json feed
								error: function() 
								{
									alert('There was an error in fetching your calendar file. Please check your date file...');
								}
							}
						]
					});
				});

			</script>

<!-- END of CALENDAR includes and script -->
	
		</head>
	
	
		<body>
	
		<?php
			$_SESSION['Page_Purpose'] = "events";
			include_once("./CommonPages/PagePurpose.php");
		?>	
			
<?php
/*	########################################################################################################################################
	This section holds the LHC of the welcome page. It holds a general greeting and general about us
	The <div class = "container"> is used to center the boxes (the section-box) on the screen	
	##################################################################################################################################### */
?>			
			<div class="Container">
			
				<div id="IFHSContentAndTrendingWrapper">									<!-- div to contain 2 divs side by side -->

					<div id='calendar'></div>
								
				</div>
			</div>
			<br style="clear: left;" />
			
<!-- END of MAIN BODY div -->								
			
<!-- START of FOOTER -->

			<div class="Footer">		</div>					<!-- shows the banner at the bottom of the page -->
			
<!-- END of FOOTER -->			

<!-- END of PAGE CONTAINER div -->								

		</body>

	</html>
