<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	#sleep(5);
	$dbhw = new Database();
	$delID = $_GET['id'];
	echo $delID;
	$result = $dbhw->qq("SELECT * FROM Annc WHERE annc_id = '$delID'");
	if($result){
		echo "Start Delete\n";
		$dbhw->qq("DELETE FROM Annc WHERE annc_id = '$delID'");
	}
	$result->close();
	header('Location: ' . '/home.php' );
?>
