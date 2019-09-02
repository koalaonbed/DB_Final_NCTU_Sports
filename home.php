<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Home</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/announce.css">
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
		<div class="container announce-wrapper">
			<h3 class="title">最新公告</h3><?php if($_SESSION['utype']==="admin"){ ?> <div style="text-align:right;"><a href="/anncs/add.php"><button class="btn btn-success">新增</button></a></div><br><?php } ?>
			<div class="row">
				<table class="table">
					<?php
						include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
						$dbhw = new Database();
						$result = $dbhw->qq("SELECT * FROM Annc ORDER BY annc_datetime DESC");
						//echo $result->num_rows;

						echo "\n";
						if($result){
							while( $row = $result->fetch_object()){
								echo "\t\t\t\t\t<tr>\n\t\t\t\t\t\t<td class=\"td-date\">";
								echo $row->annc_date;
								echo "</td>\n\t\t\t\t\t\t<td><a href=\"anncs.php?id=";
								echo $row->annc_id;
								echo "\">";
								echo $row->annc_topic;
								if($_SESSION['utype']==="admin"){
							?> 
							<?php // <td><a href=#><button class="btn btn-success">修改</button></a></td> ?>
							<td><a href=# onclick="deletePost(<?php echo $row->annc_id; ?>)"><button class="btn btn-danger"> 刪除</button></a></td>
							<?php
								}
								echo "</a></td>\n\t\t\t\t\t</tr>\n";
							}
							//echo "bef closed\n";
							$result->close();
							//echo "closed\n";
						}
					?>
					<?php
					/*
					<tr>
						<td class="td-date">2018 / 09 / 06</td>
						<td><a href="anncs.php">107學年度上學期 體育週開始報名啦！各系體幹看過來！</a></td>
					</tr>
					<tr>
						<td class="td-date">2018 / 09 / 05</td>
						<td><a href="anncs.php">107學年度 各系體幹名單</a></td>
					</tr>
					<tr>
						<td class="td-date">2018 / 09 / 06</td>
						<td><a href="anncs.php">107學年度 班代注意事項</a></td>
					</tr>
					<tr>
						<td class="td-date">2017 / 09 / 06</td>
						<td><a href="anncs.php">106學年度 交換學生太多之取消名單</a></td>
					</tr>
					<tr>
						<td class="td-date">2017 / 09 / 05</td>
						<td><a href="anncs.php">106學年度 系學會徵才</a></td>
					</tr>
					<tr>
						<td class="td-date">2017 / 09 / 06</td>
						<td><a href="anncs.php">106學年度 沒導聚的學生不用擔心，系辦照顧你</a></td>
					</tr>
					*/
					?>
				</table>
			</div>
		</div>
	</body>
</html>
