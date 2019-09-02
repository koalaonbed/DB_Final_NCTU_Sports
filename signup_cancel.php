<?php
	
	$eventID = $_GET['eid'];
	$teamID = $_GET['tid'];
	
	session_start();
        include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
        $dbhw = new Database();
        $result = $dbhw->qq("SELECT * FROM Signup WHERE event_id = '$eventID' AND team_id = '$teamID'");
	if ($result){
		$result = $dbhw->qq("DELETE FROM Signup WHERE event_id = '$eventID' AND team_id = '$teamID'");
	}
	echo '<p> </p><p> </p><a href="../events.php">成功，將於三秒後跳轉(按此也可返回)</a>';
	echo '<meta http-equiv="refresh" content="3; url=../events.php">';
	exit();

?>
