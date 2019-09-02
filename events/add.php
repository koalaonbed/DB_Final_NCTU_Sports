<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>New Event</title>
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

			?>
			<form action="insert.php" method="POST">

				<h3 class="title">新增活動</h3>
				<div class="form-group">
				  <label for="topic">活動名稱</label>
				  <input type="text" class="form-control" id="name" name="name" >
				</div>
				<div class="form-group">
				  <label for="topic">活動日期</label>
				  <input type="text" class="form-control" id="_date" name="_date" >
				</div>
				<div class="form-group">
				  <label for="topic">規則</label>
				  <input type="text" class="form-control" id="rule" name="rule" >
				</div>
				<div class="form-group">
				  <label for="topic">隊伍限制</label>
				  <input type="text" class="form-control" id="team_limit" name="team_limit" >
				</div>
				<div class="form-group">
				  <label for="topic">每隊人數限制</label>
				  <input type="text" class="form-control" id="people_limit" name="people_limit" >
				</div>
				<a href="http://150.95.172.154:8080/events.php"  class="btn btn-default btn-removed" role="button">取消</a><tr>
				<tr>
				<button class="btn btn-default btn-new" type="submit">發佈</button>
			</form>

			<?php $result->close(); ?>
		</div>
	</body>
</html>
