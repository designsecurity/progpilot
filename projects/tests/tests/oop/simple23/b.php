<?php

	class MySQL_prog_pilot_test {

		public $mysqli_obj = null ; 
		
		public function __construct() {
			
			$this->mysqli_obj = new mysqli('localhost','root','','progpilottest'); 
		}

		public function query($sql) {

			 $this->mysqli_obj->query($sql);
		}
	}
	
	class DbModel {

		public $db = null ; 
		
		public function __construct() {
			
			$this->db = new MySQL_prog_pilot_test(); 
		}
		
		public function func2($sql) {
		
            $this->db->query($sql);
		}
	}
	
	$queueId = $_GET["p"];
	$sql = "select * from mytable where id = " .$queueId;
	$model = new DbModel(); 
	$model->func2($sql);
	

?>
