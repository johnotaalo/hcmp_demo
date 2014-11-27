<?php
class Facilitystocklevel extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('Facility_Code', 'int',5);
		$this -> hasColumn('Kemsa_Code', 'varchar',20);
		$this -> hasColumn('Batch_No', 'varchar',10);
		$this -> hasColumn('Manufacturer', 'text');
		$this -> hasColumn('Exp_Date', 'date');
		$this -> hasColumn('Units_Available', 'text');
		
		
		
	}

	public function setUp() {
		$this -> setTableName('stocktake');
		//$this -> hasMany('Drug as Category_Drugs', array('local' => 'id', 'foreign' => 'Drug_Category'));
		
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("stocktake");
		$stocklevels = $query -> execute();
		return $stocklevels;
	}

}

