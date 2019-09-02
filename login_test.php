<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';
	// Get values from login form

	$account = $_POST['account'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordc = $_POST['passwordc'];


	if(!strcmp($password,$passwordc))
		echo "<br>what a nice day";

	// call the class
	//$auth = new Auth();
	//$login = $auth->login($account, $password);
	// redirect to the login.php
	header('Location: ' . '/login.php');
?>
