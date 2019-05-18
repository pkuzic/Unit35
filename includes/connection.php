<?php

	try
	{
		$pdo = new PDO('mysql:host=localhost;dbname=cdk', 'root', '');
	}
	
	catch (PDOException $e)
	{
		exit ('Database error.');
	}
	



?>