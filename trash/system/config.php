<?php 
	session_start();

	if (!isset($_SESSION['lang']))
		$_SESSION['lang'] = "en";
	else if (isset($_GET['lang']) && $_SESSION['lang'] != $_GET['lang'] && !empty($_GET['lang'])) {
		if ($_GET['lang'] == "en")
			$_SESSION['lang'] = "en";
		else 
			$_SESSION['lang'] = "ru";
	}

	require_once ($_SERVER['DOCUMENT_ROOT']."/languages/" . $_SESSION['lang'] . ".php");
	$dbserver = "localhost";
	$dbusername = "root";
	$dbpassword = "";
	$db = "overlords";

	$conn = new mysqli($dbserver, $dbusername, $dbpassword, $db);

	if ($conn->connect_error)
	{
		die("Connection failed: ".$conn->connect_error);
	}
	else
	{
		$query = "SELECT title, maintenance FROM configuration";
		$result = mysqli_query($conn, $query);	
		$row = mysqli_fetch_assoc($result);

		$title = $row['title'];
		$maintenance = $row['maintenance'];
	}
?>
