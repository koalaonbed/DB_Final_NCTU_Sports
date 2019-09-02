<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/auth.php';
	session_start(); 
	// Get values from login form
	$account = $_POST['account'];
	$password = $_POST['password'];
	$type = $_POST['utype'];
	// call the class
	echo "type";
	echo $type;
	$auth = new Auth();
	echo "debug1";
	$login = $auth->login($type, $account, $password);
	echo "debug2";
	#sleep(5);
	if ($login == 1){
		header('Location: ' . '/home.php');
	}elseif( $login == 2 ){
		header('Location: ' . '/login.php?status=2');
	}else{
		header('Location: ' . '/500.php');
	}
	// redirect to the login.php
	//	header('Location: ' . '/login.php');
?>
