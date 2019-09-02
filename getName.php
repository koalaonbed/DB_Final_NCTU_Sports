<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
        $dbhw = new Database();
	$q = $_REQUEST['q'];
	$name = '';
	if( $q !== ""){
		$q = strtolower($q);
		$result = $dbhw->qq("SELECT * FROM User WHERE user_id = '$q'");
		$row = $result->fetch_object();
		$name = $row->User_name;
	}
	echo $name === "" ? "" : $name;
?>
