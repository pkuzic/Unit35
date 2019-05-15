<?php
	function getPage()
	{
		if(isset($_GET['page']))
		{
			$page = $_GET['page'];
			if($page == "home")
			{
				require_once("pages/home.php");
			}
			elseif($page == "map")
			{
				require_once("pages/map.php");
			}
			elseif($page == "dynasty")
			{
				require_once("pages/dynasty.php");
			}
			elseif($page == "stats")
			{
				require_once("pages/stats.php");
			}
			elseif($page == "msg")
			{
				require_once("pages/msg.php");
			}
			elseif($page == "forum")
			{
				require_once("pages/forum.php");
			}
			elseif($page == "contact")
			{
				require_once("pages/contact.php");
			}

		}
		else
		{
			require_once("pages/home.php");
		}
	}
	function getNavBar()
	{
		require_once("navbar.php");
	}

	function getFooter()
	{
		require_once("footer.php");
	}

	function getRightSide()
	{
		require_once("rightside.php");
	}

	function getLeftSide()
	{
		require_once("leftside.php");
	}

	function maintenance()
	{
		require_once("maintenance.php");
	}
?>