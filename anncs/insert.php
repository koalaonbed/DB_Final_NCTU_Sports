<?php
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	$dbhw = new Database();
	$top = $_POST['Topic'];
	echo $top;
	$con = $_POST['context'];
	echo $con;
	$time = date('Y-m-d');
	echo $time;
	$result = $dbhw->qq("INSERT INTO Annc ( annc_date, annc_topic, annc_context) VALUES ('$time', '$top', '$con' )");
	header('Location: ' . '/home.php');
?>
