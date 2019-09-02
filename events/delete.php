<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	$_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	$dbhw = new Database();

	$delID = $_GET['id'];
	$result = $dbhw->qq("SELECT * FROM event WHERE event_id = '$delID'");
	if($result){
		$dbhw->qq("DELETE FROM event WHERE event_id = '$delID'");
		$result->close();
		echo '<p> </p><p> </p><a href="../home.php">delete 成功，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../home.php">';
		exit();
	}
?>
