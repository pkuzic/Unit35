<?php
	if 		($_SESSION['Page_Purpose'] == "index")				{		$Title_Text = "Institute for Holistic Science";	}
	else if ($_SESSION['Page_Purpose'] == "about")				{		$Title_Text = "About Us";	}
	else if ($_SESSION['Page_Purpose'] == "news")				{		$Title_Text = "News";	}
	else if ($_SESSION['Page_Purpose'] == "journal")			{		$Title_Text = "Journal";	}
	else if ($_SESSION['Page_Purpose'] == "research")			{		$Title_Text = "Research";	}
	else if ($_SESSION['Page_Purpose'] == "contactus")			{		$Title_Text = "Contact Us";	}
	else if ($_SESSION['Page_Purpose'] == "events")				{		$Title_Text = "Events";	}
	else if ($_SESSION['Page_Purpose'] == "adminpage")			{		$Title_Text = "Admin Panel";	}
	else if ($_SESSION['Page_Purpose'] == "updatearticles")		{		$Title_Text = "Articles Moderation";	}
?>