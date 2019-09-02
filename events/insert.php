<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	$dbhw = new Database();
	$name = $_POST['name'];
	$_date = $_POST['_date'];
	$rule = $_POST['rule'];
	$team_limit = $_POST['team_limit'];
	$people_limit = $_POST['people_limit'];
	$result = $dbhw->qq("INSERT INTO event ( name, rule, _date, team_limit, people_limit) VALUES ('$name', '$rule', '$_date', '$team_limit', '$people_limit' )");
	//$result->close();
	echo '<p> </p><p> </p><a href="../home.php">成功，將於三秒後跳轉(按此也可返回)</a>';
	echo '<meta http-equiv="refresh" content="3; url=../home.php">';
	exit();
?>
