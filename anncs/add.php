<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Announce</title>
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
						<li class="active"><a href="http://150.95.172.154:8080/home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://150.95.172.154:8080/events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://150.95.172.154:8080/login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
			
					<ul class="nav navbar-nav navbar-link">
						<li><a href="http://150.95.172.154:8080/register.php">註冊 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container announce-wrapper">
			<?php 	
				include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
				$dbhw = new Database();

			?>
			<form action="insert.php" method="POST">
				<h3 class="title">新增公告</h3>
					
					<div class="form-group">
						<label class="control-label col-sm-2" for="email">標題</label>
						<div class="col-sm-10">
					      		<input type="text" class="form-control" id="Topic" name="Topic" placeholder="輸入標題">
					    	</div>
					</div>
					<div class="form-group">
						<label for="exampleFormControlTextarea1">公告內文</label>
						<textarea class="form-control" id="context" name="context" rows="25"></textarea>
					</div>
				<a href="http://150.95.172.154:8080/home.php"  class="btn btn-default btn-removed" role="button">取消</a><tr>
				<button class="btn btn-default btn-new" type="submit">新增</button>
			</form>
			<?php $result->close(); ?>
		</div>
	</body>
</html>
