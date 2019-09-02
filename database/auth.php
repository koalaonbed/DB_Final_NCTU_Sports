<?php
	
	include __DIR__ . '/database.php';
	// extending the class database/Database makes sure your connection of DB.
	class Auth extends Database
	{
		public function login($type, $account, $password) {
			echo "f\n";
			if($type === "admin"){
				echo "Admin";
				$query = "SELECT * FROM Admin where admin_id = '$account'";
			}else{
				echo "User";
				$query = "SELECT * FROM User where user_id = '$account'";
			}
			$result = $this->db->query($query);
			echo "r1\n";
			$row = $result->fetch_row();
			echo "row1 = '$row[1]'\n";
			echo "row3 = '$row[3]'\n";
			if($account != null && $password != null && $row[1] == $account && $row[3] == $password){
				$_SESSION['username'] = $account;
				$_SESSION['utype'] = $type;
				echo '登入成功!';
			        echo '<meta http-equiv=REFRESH CONTENT=1;url=home.php>';
				//sleep(5);
				return 1;
			}else{
				echo '登入失敗!';
				echo '<meta http-equiv=REFRESH CONTENT=1;url=login.php?status=2>';
				//sleep(5);
				return 2;
			}
			// $query = 'Your-Query';
			// $result = $this->db->query($query);
			// return something you like
			return 3;
		}
	}
?>
