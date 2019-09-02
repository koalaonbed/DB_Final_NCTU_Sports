<?php
	class Database
	{
		protected $db; // db variable
		public function __construct() {
			/*
			 * Host information
			 */
			// define(host, 'Your-Host');
			// define(user, 'Your-Username');
			// define(password, 'Your-Password');
			// define(database, 'Your-Database');
			// define(port, 'Your-Port');
			
			define(host, 'localhost');
			define(user, 'dbuser');
			define(password, '74L3Mt4KGUjB4wXgwhJo');
			define(database, 'dbfinal');
			define(port, 3306);
			$mysqli = new mysqli(host, user, password, database, port);
			if ($mysqli->connect_error) {
  			 	 die("Connection failed: " . $mysqli->connect_error);
			}	 
			mysqli_set_charset($mysqli,"utf8");
			$this->db = $mysqli;
			//echo "Connected successfully";
		}
		public function qq($qq){
			return $this->db->query($qq);
		}
	}
?>
