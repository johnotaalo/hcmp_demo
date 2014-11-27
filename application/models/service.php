<?php
class Service extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('facility_id', 'int',20);
		$this -> hasColumn('service_point', 'varchar',255);
		 
	}

	public function setUp() {
		$this -> setTableName('service');
			
	}
	public static function getall($facility){
		$query = Doctrine_Query::create() -> select("*") -> from("service")->where("facility_id=$facility");
		$level = $query -> execute();
		return $level;
	}
}