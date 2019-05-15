<?php
?>
	<table class = "InvisibleTableBorders">
		<tr>
			<td align="right">	
			<?php
				echo '<img src="./images/JournalToolbar.png" width="223" height="50" alt="Navigate our journal" usemap="#journalmap">';
				
				echo '<map name="journalmap">';
		
					echo '<area shape="rect" coords="0,0,50,50" href="./journal.php?prevnext=1" alt="Prev" title="Go back to the first journal" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';	
					echo '<area shape="rect" coords="52,0,104,50" href="./journal.php?prevnext=prev" alt="Next" title="Click here to view the previous journal" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="106,0,158,50" href="./journal.php?prevnext=next" alt="Show" title="Click here to view the next journal" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
					echo '<area shape="rect" coords="175,0,227,50" href="./journal.php?prevnext=show" alt="Show" title="Click here to view the current journal" style="background-color:#FFFFFF;color:#000000;text-decoration:none">';
							
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