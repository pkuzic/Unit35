<?php
?>


	<table class = "InvisibleTableBorders">
		<tr>
			<td align="right">	
			<?php
				
				if ($_SESSION['ADMINPAGEYN'] == "YES" && $_SESSION['MEMBERPAGEYN'] = "NO")
				{
					$pathtoimage = "../../images/MenuBar.png";
					$pathtopages = "../../";
				}
				else
				{
					$pathtoimage = "./images/MenuBar.png";
					$pathtopages = "./";
				}
				
				echo '<img src=' . $pathtoimage . ' width="533" height="50" alt="member login or register" usemap="#membersmap">';
				
				echo '<map name="membersmap">';
		
					echo '<area shape="rect" coords="0,0,50,50" href=' . 	$pathtopages . 'index.php alt="Home" title="Home" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';	
					echo '<area shape="rect" coords="52,0,104,50" href=' . 	$pathtopages . 'aboutus.php alt="About us" title="Click here to read about the centre" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="106,0,158,50" href=' . $pathtopages . 'news.php alt="News" title="Click here to read the latest news from the centre" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="160,0,212,50" href=' . $pathtopages . 'researchers.php alt="Research and researchers" title="Click here to see our current research and our researcher profiles" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="214,0,268,50" href=' . $pathtopages . 'journal.php alt="Our journal" title="Click here to view our journal" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="270,0,322,50" href=' . $pathtopages . 'events.php alt="Events" title="Click here to see our schedule of events, seminars and symposiums" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="324,0,376,50" href=' . $pathtopages . 'contactus.php alt="Contact us" title="Click here to contact us" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="378,0,430,50" href=' . $pathtopages . 'register.php alt="FREE Registration " title="click here for FREE registration" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="432,0,484,50" href=' . $pathtopages . 'members.php alt="Members login page" title="Click here to log in" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="486,0,538,50" href=' . $pathtopages . 'CMS/admin/adminpage.php alt="Administration Login" title="Admin" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
			?>
a
			<?php
					//echo '<area shape="rect" coords="100,0,200,20" href="register.php" onmouseover = "this.src="bp.png"	onmouseout="HS.png" alt="Register as a new member">';
				echo '</map>';

			?>
		</table>

<!--	<a href="URL ADDRESS">
			<img src="URL OF THE FIRST IMAGE GOES HERE" 
					onmouseover="this.src='URL OF THE SECOND IMAGE GOES HERE'" 
					onmouseout="this.src='URL OF THE FIRST IMAGE GOES HERE'" />
		</a>
-->