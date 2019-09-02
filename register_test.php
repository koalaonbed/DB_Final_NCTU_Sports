<!DOCTYPE html>
<html>
	<script>
        function refresh_code(){ 
            document.getElementById("imgcode").src="captcha.php"; 
        } 
    </script>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>登入</title>
		<meta name="description" content="">
		<meta name="keywords" content="">
		<link href="" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<link rel="stylesheet" href="css/home.css">
		<link rel="stylesheet" href="css/login.css">
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
						<li><a href="events.php">活動列表 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li><a href="login.php">登入 <span class="sr-only">(current)</span></a></li>
					</ul>
					<ul class="nav navbar-nav navbar-link">
						<li class="active"><a href="register.php">註冊 <span class="sr-only">(current)</span></a></li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container login-wrapper">
			<form action="auth/login.php" method="POST">
				<div class="row">
					<div class="col-md-9 col-md-offset-1">
						<br><br><br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>學號</label>
						<input type="text" name="account" class="form-control">
					</div>
					<div class="col-md-12">
						<br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>信箱</label>
						<input type="text" name="email" class="form-control">
					</div>
					<div class="col-md-12">
						<br>
					</div>
					<div class="col-md-5 col-md-offset-1">
                                                <label>密碼</label>
                                                <input type="password" name="password" class="form-control">
                                        </div>
					<div class="col-md-12">
						<br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>確認密碼</label>
						<input type="password" name="password_c" class="form-control">
					</div>
					<div class="col-md-12">
						<br>
					</div>
					<div class="col-md-5 col-md-offset-1">
						<label>驗證碼</label>
						<form name="form1" method="post" action="./checkcode.php">
							<p>請輸入下圖字樣：</p><p><img id="imgcode" src="./captcha.php" onclick="refresh_code()" /><br />
							點擊圖片可以更換驗證碼
							</p>
						</form>
						<input type="text" name="captcha" class="form-control">
						
					</div>
					<br><div class="col-md-12 col-md-offset-1">
						<tr><tr>
						<button class="btn btn-default btn-new" type="submit">註冊</button>
					</tr></tr></div>
					<div class="col-md-10 col-md-offset-1">
						<br>
						<a href="http://localhost/forgetpassword.php" class="text-notify">忘記密碼？</a>
					</div>
				</div>
			</form>
		</div>
	</body>
</html>
