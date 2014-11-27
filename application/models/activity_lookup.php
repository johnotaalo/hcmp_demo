<?php
class Activity_lookup extends Doctrine_Record {
/////
	public function setTableDefinition() {
		$this->hasColumn('activity_name', 'varchar', 255);
		
		
		
	}
	
	public function setUp() {
		$this->setTableName('activity_lookup');
		
	}

	public static function getActivity() {
		
		$query = Doctrine_Query::create() -> select("*") -> from("Activity_lookup");
		$data = $query -> execute();
		return $data;
			
	}
	
	
}
