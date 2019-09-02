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
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/announce.css">
		<?php session_start(); ?>
		<script>
                        function deletePost(test){
                                var del = confirm("Are you sure to delete this post?");
                                var str = "anncs/delete.php?id=" + test;
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
						<li class="active"><a href="home.php">首頁 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
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
		
		<?php 	
			include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
			$dbhw = new Database();
			$linkid = $_GET['id'];
			$id = mysqli_fetch_array($id_get);
			$result = $dbhw->qq("SELECT * FROM Annc WHERE annc_id = '$linkid' LIMIT 1");
			$row = $result->fetch_object();
		?>
		<div class="container announce-wrapper">
			<?php if($_SESSION['utype']==="admin"){  ?> <a href=#><button class="btn btn-success">新增</button></a>
			<a href=# onclick="deletePost(<?php echo $row->annc_id; ?>)"><button class="btn btn-danger"> 刪除</button></a> <?php } ?>
			<!-- <h3 class="title">107學年度上學期 體育週開始報名啦！各系體幹看過來！</h3> -->
			<h3 class="title"><?php echo $row->annc_topic; ?></h3>
			<div class="row">
				<div class="col-md-12 date"><?php echo $row->annc_datetime ?></div>
				<div class="col-md-12 announce-content">
					<?php echo $row->annc_context; ?>
				</div>
			</div>
			<?php $result->close(); ?>
		</div>
	</body>
</html>
