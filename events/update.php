<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	$dbhw = new Database();
	$name = $_POST['name'];
	$_date = $_POST['_date'];
	$rule = $_POST['rule'];
	$team_limit = $_POST['team_limit'];
	$people_limit = $_POST['people_limit'];
	$updateID = $_GET['id'];
	if(empty($team_limit)){
		echo '<p> </p><p> </p><a href="../home.php">隊伍限制不得為空，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../home.php">';
		exit();
	}
	if(empty($people_limit)){
		echo '<p> </p><p> </p><a href="../home.php">每隊人數限制不得為空，將於三秒後跳轉(按此也可返回)</a>';
		echo '<meta http-equiv="refresh" content="3; url=../home.php">';
		exit();
	}
	$result = $dbhw->qq("UPDATE event SET name = '$name', _date = '$_date', rule = '$rule', team_limit = '$team_limit', people_limit = '$people_limit' WHERE event_id = '$updateID' ");
	//$result->close();
	echo '<p> </p><p> </p><a href="../home.php">修改成功，將於三秒後跳轉(按此也可返回)</a>';
	echo '<meta http-equiv="refresh" content="3; url=../home.php">';
	exit();
?>
