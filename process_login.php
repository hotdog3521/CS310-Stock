<?php
	if (!session_id())@session_start();

	//the user didn't enter a email or password
	if (empty($_POST['email']) || empty($_POST['password']))
	{
		$_SESSION['errors'] = "Email and Password cannot be empty";
		header('Location: login.php');
		exit();
	}

	require_once("php_classes/DBManager.php");

	//check if there is a user with that login info
	$db = new DBManager();
	$user = $db->loginUser($_POST['email'], $_POST['password']);

	//the user entered incorrect login info
	if (empty($user))
	{
		$_SESSION['errors'] = "Email or Password was incorrect.  Please try again.";
		header('Location: login.php');
		exit();
	}

	//enter the user's dashboard
	header('Location: dashboard.php');
	exit();

?>