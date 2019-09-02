<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title>Sign up</title>
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
			function deleteSignup(a,b){
				var del = confirm("確定取消報名?");
				var str = "signup_cancel.php?eid=" + a + "&tid=" + b ;
				if (del) { location.href = str;}
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
		<div class="container event-wrapper">
			<div class="signup-form">
				<?php 	
				include $_SERVER['DOCUMENT_ROOT'] . '/database/database.php';
				$userID = $_SESSION['username'];
				$dbhw = new Database();
				$linkid = $_GET['id'];
				$id = mysqli_fetch_array($id_get);

			//	echo $linkid;
				$result1 = $dbhw->qq("SELECT * FROM event WHERE event_id = '$linkid' LIMIT 1");
				//$user = $dbhw->qq("SELECT * FROM event WHERE event_id = '$linkid' LIMIT 1");
				$result_team = $dbhw->qq("SELECT * FROM Signup WHERE event_id = '$linkid'");
				$num_team = $result_team->num_rows;
			//	echo $result->num_rows;
				$row = $result1->fetch_object();
				//$result->close();
				?>
				<h3 class="text-center">活動報名：<?php echo $row->name ?></h3>
				<div class="description">
					<?php $mess = $_GET['status'];
						if ( $mess >= 0 ){
							switch($mess){
								case 6:
									echo "<p> 隊伍名稱錯誤</p>";
									break;
								case 1:
									echo "<p> 沒有隊員</p>";
								 	break;
								case 2:
									echo "<p> 超過隊伍人數上限 </p>";
									break;
								case 3:
									echo "<p> 報名隊伍已額滿 </p>";
									break;
								case 4:
									echo "<p> 有重複隊員 </p>";
									break;
								case 5:
									echo "<p> 成功報名 </p>";
								 	break;
								default:
									echo "";
							}
						}
					?>
					<p>每隊上限：<?php echo $row->people_limit ?></p>
					<p>隊伍上限：<?php echo $row->team_limit ?></p>
					<p>已報名隊伍：<?php echo intval($num_team)?> 隊</p>
					<p class="warning">尚可報名：<?php echo intval($row->team_limit)-intval($num_team)?> 隊</p>
				</div>
				
				<?php
					$result = $dbhw->qq("SELECT S.team_id AS teamID, T.team_name AS teamName, T.team_userid AS userID FROM Signup AS S, Team AS T WHERE S.event_id = '$linkid' AND T.team_userid = '$userID' AND T.team_ID = S.team_ID");
					$row = $result->fetch_object();
					//echo $row->teamID;
					//echo $result->num_rows;
					$myteamID = ($result->num_rows === 0) ? -1 : $row->teamID;
					//echo $myteamID;
				?>
				<?php if( $myteamID != -1 ){ ?>
					<?php 
						$result = $dbhw->qq("SELECT DISTINCT team_name FROM Team WHERE team_ID = '$myteamID'");
						$row = $result->fetch_object();
						$teamName = $row->team_name;
					?>
					<br><h3><td><?php echo $teamName; ?></h3></td>
					<?php 						
						$result = $dbhw->qq("SELECT T.team_name AS TN, U.user_id AS I, U.User_name AS N FROM Team AS T, User AS U WHERE T.team_ID = '$myteamID' AND T.team_userid = U.user_id");
						if($result){
							echo "<table class=\"table\" id=\"members\">\n";
							echo "<tr>\n<th class=\"student-id\">學號</th>\n";
							echo "<th>姓名</th>\n</tr>";
							while($row = $result->fetch_object()){
								echo "<tr>\n" ;
								echo "<td class=\"student-id\">";
								echo $row->I;
								echo "</td><td>";
								echo $row->N; 
								echo "</td>\n";
								echo "</tr>\n";
							}
							
							//$teamName=$row->TN;
							echo "</table>";
						}
					?>
					<br>
					<td class="text-right"><a href="#" onclick="deleteSignup(<?php echo $linkid;?>,<?php echo $myteamID;?>)"><button class="btn btn-danger" type="button">取消報名</button></a></td>
				<?php $result->close(); } else { ?>
				<form action="signup_submit.php?id=<?php echo $linkid; ?>" method="POST" id="MainForm">
					<br>
					<label class="text-center" for="team_name">隊伍名稱</label>
					<input type="text" id="team_name" name="team_name" class="form-control">
					<br>
					<label class="text-center" for="team_name">隊伍人員</label>
					<table class="table" id="members">
					<tbody>
						<tr>
							<th class="student-id">學號</th>
							<th>姓名</th>
							<th></th>
						</tr>
					<?php /*
						<tr>	
							<td class="student-id">0513579</td>
							<td id="tt">要堅強</td>
							<td class="text-right">
								<button class="btn btn-default" style="margin-right:30px" type="button" onclick="modRow(this)">修改</button>
								<button class="btn btn-danger" type="button" onclick="delRow(this)">取消</button></td>
						</tr>
					*/
					?>
					</tbody>
					</table>
				</form>
		
				<table class="table" id="addn">
						<tr>
						<td class="student-id"><input type="text" id="student_id" name="student_id" class="form-control" onchange="showname(this.value)"></td>
						<td id="na"></td>
						<td class="text-right"><button id="btn_addnew" class="btn btn-new" style="margin-right:30px" type="button" onclick="addRow()">新增隊員</button></td>
						</tr>
				</table>
				<div class="text-left form-bottom">
					<button class="btn btn-success" form="MainForm" type="submit">提交報名表</button>
				</div>
				<?php } ?>			
					<script>
						function showname(str){
							var xhttp;
							xhttp = new XMLHttpRequest();
							xhttp.onreadystatechange = function(){
								if (this.readyState == 4 && this.status == 200){
								document.getElementById("na").innerHTML = this.responseText;
								}
							}
							xhttp.open("GET", "getName.php?q="+str, true);
							xhttp.send();
						}
						function addRow(){
							
							var ID = document.getElementById("student_id");
							var Name = document.getElementById("na");
							var table = document.getElementById("members");
							var new_btn = document.getElementById("btn_addnew");
							new_btn.innerHTML = "新增隊員";
							if ( Name !== ""){
								var newRow = table.insertRow();
								var cell0 = newRow.insertCell(0);
								var cell1 = newRow.insertCell(1);
								var cell2 = newRow.insertCell(2);
								cell0.innerHTML = '<input class=\"student-id\" name=\"ids[]\" value=\"' + ID.value + '\" readonly />';
								
								cell1.innerHTML = Name.innerText;
								cell2.innerHTML = '<button class=\"btn btn-default\" style=\"margin-right:30px\" type=\"button\" onclick=\"modRow(this)\" >修改</button><button class=\"btn btn-danger\" type=\"button\" onclick=\"delRow(this)\">取消</button></td>';
								cell2.className = "text-right";
							}
							ID.value = "";
							Name.innerText = "";
						}
						function delRow(btn){
							var row = btn.parentNode.parentNode;
							row.parentNode.removeChild(row);
						}
						function modRow(btn){
							var row = btn.parentNode.parentNode;
							var old_ID = row.firstElementChild.firstElementChild;
							var old_name = row.firstElementChild.nextElementSibling.innerHTML;
							var val = old_ID.getAttribute("value");
	
							var new_ID = document.getElementById("student_id");// 新增row-ID
							var new_text = document.getElementById("na");// 新增row-Name
							var new_btn = document.getElementById("btn_addnew");// 新增row-btn
							
							new_btn.innerHTML = "更換隊員";
							new_ID.value = val;
							new_text.innerText = old_name;
							//new_text.innerText = val;
							row.parentNode.removeChild(row);
						}
					</script>
			</div>
		</div> 
	</body>
</html>
