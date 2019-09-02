<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Status</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="../css/home.css">
		<link rel="stylesheet" href="../css/announce.css">
		<?php session_start(); ?>
		<?php if($_SESSION['utype'] != "admin"){
			header('Location: ' . '/');
		}?>
		<script>
			function myFunction(){
					var logout = confirm("Are you sure to logout?");

					if(logout){
					     location.href = "../logout.php";
					}	
			}
		</script>
	</head>
	<body>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">N C T U &nbsp;&nbsp; S p o r t s</a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav navbar-link">
						<li><a href="../home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="../events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>

					<?php if($_SESSION['username'] != null){ ?>
                                        <ul class="nav navbar-nav navbar-link">
                                                <li><a href="#"><?php echo $_SESSION['username'] ?><span class="sr-only">(current)</span></a></li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-link">
                                                <li><a href="#" onclick="myFunction()">登出 <span class="sr-only">(current)</span></a></li>
                                                <?php echo '<script>myfunction()</script>'; ?>
                                        </ul>
                                        <?php }else{ ?>

                                        <ul class="nav navbar-nav navbar-link">
                                                <li><a href="../login.php">登入 <span class="sr-only">(current)</span></a></li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-link">
                                                <li><a href="../register.php">註冊 <span class="sr-only">(current)</span></a></li>
                                        </ul>
                                        <?php } ?>

				</div>
			</div>
		</nav>
		<div class="container announce-wrapper">
			<?php 	
				include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
				$dbhw = new Database();
				$event_id = $_GET['id'];
				$result = $dbhw->qq("SELECT * FROM event WHERE event_id = '$event_id'");
				$row = $result->fetch_object();
				$teams = $dbhw->qq("SELECT DISTINCT(team_id) FROM Signup WHERE event_id = '$event_id'");
			?>
			<h2 class="title">報名狀況</h2>
			<div class="form-group">
				<h3 for="topic"><?php echo $row->name; ?></h3>  
			</div>
			<table class="table text-center">
				<tr>
					<th class="text-left">隊伍名稱</th>
					<th class="text-left">隊伍成員</th>
				</tr>
				<tr>
				<?php

				while( $teams_id = $teams->fetch_object()){
					$team = $dbhw->qq("SELECT Team.team_name, Team.team_userid, User.User_name FROM Team INNER JOIN User ON Team.team_userid=User.user_id WHERE team_id = '$teams_id->team_id' ");
					$team_number = $dbhw->qq("SELECT COUNT(*) AS NOW FROM Team INNER JOIN User ON Team.team_userid=User.user_id WHERE team_id = '$teams_id->team_id' ");
					$number=$team_number->fetch_object();
					$num=$number-> NOW;
					$n=0;
					while( $team_row = $team->fetch_object()){
						?>
						<tr>
							<?php
							if($n == 0){
								?>
								<th rowspan=<?php echo $num; ?> class="text-left"><?php echo $team_row->team_name; ?></th>
								<?php
							}
							?>
							<th class="text-left"><?php echo "$team_row->team_userid $team_row->User_name"; ?></th>
							<?php
							if($n == 0){
								?>
								<th class="text-right"><a href="../signup_cancel.php?eid=<?php echo $event_id; ?>&tid=<?php echo $teams_id->team_id; ?>"><button class="btn btn-danger" type="button">取消報名</button></a></th>
								<?php
							}
							?>
						</tr>
						<?php
						$n=1;
					}
				}
				?>
				</tr>
			</table>
			<?php $result->close(); ?>
		</div>
	</body>
</html>
