<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';

	// Get values from login form

	$account = $_POST['account'];
	$_name = $_POST['_name'];
	$password = $_POST['password'];
	$passwordc = $_POST['passwordc'];
	$email = $_POST['email'];

	if(!isset($_SESSION)){
    session_start();
    }  //判斷session是否已啟動
	if(empty($account) || empty($_name) || empty($password) || empty($passwordc) || empty($email)){
		echo '<p> </p><p> </p><a href="../register.php">Error欄位不得為空，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../register.php">';
		exit();
	}else if(strcmp($password,$passwordc)){
		echo "Not the same password";	
		echo '<meta http-equiv="refresh" content="3; url=../register.php">';
		exit();
	}
	if($_SESSION['check_word'] == $_POST['checkword']){

		$_SESSION['check_word'] = ''; //比對正確後，清空將check_word值

		header('content-Type: text/html; charset=utf-8');
			
		//echo '<p> </p><p> </p><a href="../register.php">Ok完成註冊，將於三秒後跳轉(按此也可返回)</a>';
		//echo '<meta http-equiv="refresh" content="3; url=../register.php">'; 
        
	}else if(empty($_POST['checkword'])){
		echo '<p> </p><p> </p><a href="../register.php">Error驗證碼輸入空白，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../register.php">';
		exit();
	}else{
		echo '<p> </p><p> </p><a href="../register.php">Error驗證碼輸入錯誤，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../register.php">';
		exit();
	}
	
#	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	

    	$dbhw = new Database();
	$exist_account = $dbhw->qq("SELECT * FROM User where user_id = '$account'");
	if($exist_account->num_rows>=1){
		echo '<p> </p><p> </p><a href="../register.php">Error該帳號已被註冊，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../register.php">';
		exit();
	}
	$result = $dbhw->qq("INSERT INTO User (user_id, user_email, user_pw, User_name) VALUES('$account', '$email', '$password', '$_name')");
	echo '<p> </p><p> </p><a href="../register.php">Ok完成註冊，將於三秒後跳轉(按此也可返回)</a>';
	echo '<meta http-equiv="refresh" content="3; url=../register.php">';
?>
