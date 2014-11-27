<?php
class Stocktake extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		$this -> hasColumn('facility_code', 'int',5); 
		$this -> hasColumn('kemsa_code', 'varchar',20); 
	    $this -> hasColumn('batch_No', 'varchar',10); 
		$this -> hasColumn('manufacturer', 'text'); 
		$this -> hasColumn('exp_Date', 'date'); 
		$this -> hasColumn('units_available', 'text');
		
	}

	public function setUp() {
		$this -> setTableName('stocktake');
		
		$this -> hasMany('drug as stock_Drugs', array('local' => 'kemsa_code', 'foreign' => 'Kemsa_Code'));
		
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("stocktake,drug") -> where("drug.kemsa_code=stocktake.kemsa_code 
          AND exp_Date BETWEEN CURDATE()AND DATE_ADD(CURDATE(), INTERVAL 6 MONTH)");
		
		$stocks= $query -> execute();
		return $stocks;
	}

}
