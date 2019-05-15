<?php
	require_once ($_SERVER['DOCUMENT_ROOT']."/system/config.php");

	$login = $_POST['login'];
	$password = $_POST['password'];
	$email = $_POST['email'];
	$regdate = date("Y-m-d H:i:s");
	$lastlogin = $regdate;
	$lastip = $_SERVER['REMOTE_ADDR'];


	$sql = "SELECT login FROM accounts WHERE login = '$login'";
	if($result=mysqli_query($conn,$sql))
	{
		$rowcount = mysqli_num_rows($result);
		echo $rowcount;
	}




	if($rowcount >= 1) // Ok for now, but should be reworked in future.
	{
		echo "There is already an user with this username.";	
	}
	else
	{
		$sql = "INSERT INTO accounts (login, password, email, regdate, lastlogin, lastip)
		VALUES ('$login', SHA1('$password'), '$email', '$regdate', '$lastlogin', '$lastip')";

		if($conn->query($sql) === TRUE) {
			echo "Account has been added succesfully.";
		}
		else
		{
			echo "Error: ".$sql."<br/>".$conn->error;
		}
	}
?>