<?php
class Log_monitor extends Doctrine_Record {
/////
	public function setTableDefinition() {
		$this->hasColumn('user_id', 'integer', 11);
		$this->hasColumn('log_timestamp', 'timestamp');
		$this->hasColumn('log_activity', 'int', 11);
		$this->hasColumn('forgetpw_code', 'varchar', 255);
		$this->hasColumn('status', 'int', 10);
			
		
	}
	
	public function setUp() {
		$this->setTableName('Log_monitor');
		
	}

	public static function getlogactivity() {
		
		$query = Doctrine_Query::create() -> select("*") -> from("Log_monitor");
		$data = $query -> execute();
		return $data;
			
	}

	public static function check_code_exist($code,$user_id) {
		
		$query = Doctrine_Query::create() -> select("*") -> from("Log_monitor") -> where("user_id ='$user_id' AND forgetpw_code='$code' AND status=1");
		$data = $query -> getSQL(array(), Doctrine::HYDRATE_ARRAY);
		return $data;
			
	}

	public static function check_code_request($user_id) {
		
		$query = Doctrine_Query::create() -> select("*") -> from("Log_monitor") -> where("log_timestamp >= ( CURDATE() - INTERVAL 3 DAY ) AND user_id ='$user_id' AND status=1");
		$data = $query -> execute();
		return $data;
			
	}
	
	public static function deactivate_code($user_id){


			$update = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$update->execute("UPDATE log_monitor SET status=0  WHERE id='$user_id' ;");
	}
}
