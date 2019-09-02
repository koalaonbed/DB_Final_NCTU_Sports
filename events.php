<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Events</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/event.css">
		<?php session_start(); ?>
		<script>
			function myFunction(){
					var logout = confirm("Are you sure to logout?");

					if(logout){
					     location.href = "logout.php";
					}	
			}
		</script>
		<script>
			function deletePost(test){
				var del = confirm("Are you sure to delete this post?");
				var str = "events/delete.php?id=" + test;
				if (del){ location.href = str; }
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
						<li><a href="home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
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
                                                <li><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
                                        </ul>
                                        <ul class="nav navbar-nav navbar-link">
                                                <li><a href="register.php">註冊 <span class="sr-only">(current)</span></a></li>
                                        </ul>
                                        <?php } ?>

				</div>
			</div>
		</nav>
		<div class="container event-wrapper event-list">
			<h3 class="title">活動列表
				<?php 
				if($_SESSION['utype']==="admin"){
					?>
					<br></br>
					<div style="text-align:right;"><a href=./events/add.php><button class="btn btn-primary">新增活動</button></a></div>
					<?php } 
				?>
			</h3>
			<br>
			<table class="table text-center">
				<tr>
					<th class="text-center">項目</th>
					<th class="text-center">規則</th>
					<th class="text-center">報名</th>
					<?php
					if($_SESSION['utype']==="admin"){
						?>
						<th class="text-center">操作</th>
						<th class="text-center"></th>
						<?php
					}
					?>
				</tr>
				<?php
					include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
					$dbhw = new Database();
					$result = $dbhw->qq("SELECT * FROM event");
						//echo $result->num_rows;

					echo "\n";
					if($result){
						while( $row = $result->fetch_object()){
							echo "<td>$row->name</td>";
							echo "<td>$row->rule</td>";
							?>
							<td><a href="signup.php?id=<?=$row->event_id?>"><button class="btn btn-default btn-event">報名</button></a></td>
							<?php
							if($_SESSION['utype']==="admin"){
								?>
									<td><a href=./events/edit.php?id=<?=$row->event_id?>><button class="btn btn-primary">修改</button></a>
									<a href=./events/status.php?id=<?=$row->event_id?>><button class="btn btn-success"> 報名狀況</button></a></td>
									<td><a href=# onclick="deletePost(<?php echo $row->event_id; ?>)"><button class="btn btn-danger"> 刪除</button></a></td>
								<?php
							}
							echo "</a></td>\n\t\t\t\t\t</tr>\n";
						}
						//echo "bef closed\n";
						$result->close();
						//echo "closed\n";
					}
				?>
				<tr>
					<td>泡泡足球</td>
					<td>像泡泡一樣的足球</td>
					<td><a href="signup.php"><button class="btn btn-default btn-event">報名</button></a></td>
				</tr>
				<tr>
					<td>足球小將</td>
					<td>來比比誰是大掛逼</td>
					<td><button class="btn btn-default btn-event">報名</button></td>
				</tr>
				<tr>
					<td>命運石之門 zero</td>
					<td>助手加油</td>
					<td><button class="btn btn-default btn-event">報名</button></td>
				</tr>
				<tr>
					<td>兩人十二腳</td>
					<td>試試看</td>
					<td><button class="btn btn-default btn-event">報名</button></td>
				</tr>
			</table>
		</div>
	</body>
</html>
