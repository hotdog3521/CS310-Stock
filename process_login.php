<?php
	if (!session_id())@session_start();

	if (empty($_POST['email']) || empty($_POST['password']))
	{
		$_SESSION['errors'] = "Email and Password cannot be empty";
		header('Location: login.php');
		exit();
	}



?>