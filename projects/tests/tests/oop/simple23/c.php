<?php
	class MySQL_prog_pilot_test {

		private $mysqli_obj = null ; 
		public function __construct() {
			$this->mysqli_obj = new mysqli('localhost','root','','progpilottest'); 
		}

		public function query($sql) {
	mysql_query($sql);
			print $sql."\n";
			return $this->mysqli_obj->Query($sql);
		}

	}
?>

