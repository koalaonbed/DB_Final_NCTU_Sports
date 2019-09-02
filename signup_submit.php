<?php
	$eventID = $_GET['id'];
	session_start();
	include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
	$dbhw = new Database();
	$result  = $dbhw->qq("SELECT team_limit AS Max, people_limit AS P FROM event where event_id = '$eventID'");
	$result1 = $dbhw->qq("SELECT count(*) AS Now FROM Signup where event_id = '$eventID'");
	$result2 = $dbhw->qq("SELECT MAX(team_id) AS D FROM Team");
	$row  = $result->fetch_object();
	$row2 = $result1->fetch_object();
	$row3 = $result2->fetch_object();
	
	$teamLimit = $row->Max;
	$peopleLimit = $row->P;	
	$teamLeft = $row->Max - $row2->Now;
	$teamMaxID = $row3->D;
	$userArray = $_POST['ids'];

	
	$teamName = $_POST['team_name'];
	echo " ---teamname = ";
	echo $teamName;
	echo " ---len = ";
	echo $teamName.length;
	if ( strpos($teamName, ' ') == $teamName.length) {
		echo " ---all spaces\n";
		header('Location: ' . '/signup.php?status=6&id='. $eventID);
		exit();
	}
	if( $_POST['team_name'] == '' ){
		echo " ---empty team name\n";
		header('Location: ' . '/signup.php?status=6&id='. $eventID);
 		exit();
		// return to last page
	}
	
	if( !isset($_POST['ids']) ){
		echo " ---idsがあります\n";
		header('Location: ' . '/signup.php?status=1&id='. $eventID);
		exit();
	}
	
	$teamID = ($teamMaxID > 0 ? $teamMaxID+1 : 1); 
	
	echo "\n\n";
	echo " ---teamLimit = $teamLimit\n";
	echo " ---peopleLimit = $peopleLimit\n";
	echo " ---NoWlEFT = teamLeft\n";
	echo " ---teamMaxID = $teamID\n";
	echo " ---count IDS = ";
	echo count($userArray);

	if( count($userArray) > $peopleLimit ){
		header('Location: ' . '/signup.php?status=2&id='. $eventID);
		exit();
	}
	if( $teamLeft <= 0 ){
                header('Location: ' . '/signup.php?status=3&id='. $eventID);
		exit();
	}
	if(count(array_unique($userArray)) < count($userArray)){
                header('Location: ' . '/signup.php?status=4&id='. $eventID);
        	exit();
	}
	
	// EXAMINE
		






	// INSERT
		
	for ($i = 0; $i < count($userArray); $i++ ){
		$q1 = $dbhw->qq("INSERT INTO Team (team_id, team_name, team_userid) VALUES ('$teamID','$teamName','$userArray[$i]')");
	}
	$q2 = $dbhw->qq("INSERT INTO Signup (event_id, team_id) VALUES ('$eventID', '$teamID')");
	header('Location:' . '/signup.php?status=5&id=' . $eventID);
	
?>
