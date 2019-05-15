	<div class="Container"> 																	<!-- overall page container div -->
		<div class="Header">		</div> 														<!-- shows the banner at the top of the page -->
	</div>

	<div class="CenterContent"> 																	<!-- overall page container div -->
	<?php	
		include_once("MemberLoginRegisterandAdminMap.php"); 
	?>		
	</div>
	
	<br style="clear: left;" / >				
		
<!-- START of PAGE TITLE - e.g. welcome, journal, aboutus, etc. -->			

	<div class="Container">
		<div class="PagePurpose">			
		
			<table border="0" cellpadding="5" cellspacing="0" width="800px">
			<?php
				if 		($_SESSION['Page_Purpose'] == "index")				{		$Title_Text = "Welcome to the Institute for Holistic Science...";	}
				else if ($_SESSION['Page_Purpose'] == "about")				{		$Title_Text = "Welcome to the about us page...";	}
				else if ($_SESSION['Page_Purpose'] == "news")				{		$Title_Text = "Welcome to our news page...";	}
				else if ($_SESSION['Page_Purpose'] == "journal")			{		$Title_Text = "Welcome to our journal...";	}
				else if ($_SESSION['Page_Purpose'] == "research")			{		$Title_Text = "Welcome to our research page...";	}
				else if ($_SESSION['Page_Purpose'] == "contactus")			{		$Title_Text = "Welcome to our contact-us page...";	}
				else if ($_SESSION['Page_Purpose'] == "events")				{		$Title_Text = "Welcome to our events page...";	}
				else if ($_SESSION['Page_Purpose'] == "adminpage")			{		$Title_Text = "Welcome to the administration area...";	}
				else if ($_SESSION['Page_Purpose'] == "updatearticles")		{		$Title_Text = "Welcome to the articles administration area...";	}
				
			?>			
				<tr>	
					<td align="left" colspan="6">	
						<h7>	<?php echo $Title_Text;	?>	</h7> 	
					</td>	
				</tr>
			</table>
		</div>
	</div>

<?php

	$tablecolourbool = 0;									// 	initialise variables for the trending table (controls the colour of the row on a bool switch)
	$tablecolour = 0;										//	holds the colour of the table
	$tablecount = 0;										//	holds the number of table rows
	
	$TableColour1 = "Lavender"; // "#002800"; // "#FFBF00"; // "#99BBFF";				// 	a dark grass green -> http://www.w3schools.com/tags/ref_colorpicker.asp?colorhex=006400
	$TableColour2 = "WhiteSmoke"; // "#006400"; // "#F4FA58"; // "#CCBBFF";				//	a dark green -> http://www.w3schools.com/tags/ref_colorpicker.asp?colorhex=006400 
?>	
	
<!-- END of PAGE TITLE - e.g. welcome, journal, aboutus, etc. -->							