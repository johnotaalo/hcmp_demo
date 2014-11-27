<?php
class Dates extends Doctrine_Record {

	public function setTableDefinition() {
				$this->hasColumn('Quater', 'integer', 2);
				$this->hasColumn('facility_dl', 'date');
				$this->hasColumn('district_dl', 'date');
				
		
	}
	
	public function setUp() {
		$this->setTableName('important_dates');
		//$this -> hasMany('User as user_types', array('local' => 'id', 'foreign' => 'usertype_id'));
		
		
	}

	public static function getDates()
	{
		$query = Doctrine_Query::create() -> select("*") -> from("Dates");
		$dates = $query -> execute();
		return $dates[0];
	}
}
