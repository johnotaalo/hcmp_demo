<?php
class IssueModel extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('facility_code', 'int',5);
		$this -> hasColumn('kemsa_code', 'varchar','20');
		$this -> hasColumn('qtty_issued', 'int',5);
		$this -> hasColumn('date_issued', 'date');
	}

	public function setUp() {
		$this -> setTableName('drug_issue');
		$this -> hasMany('drug as stock_Drugs', array('local' => 'kemsa_code', 'foreign' => 'Kemsa_Code'));
	}

	public static function getAll() {
		
		$from=$_POST['from'];
        $to=$_POST['to'];
		$theyear=$_POST['year_from'];
		
		$query = Doctrine_Query::create() -> select("kemsa_code,SUM(qtty_issued) as total") -> from("IssueModel") -> where("YEAR(`date_issued`)=$theyear AND MONTH( `date_issued` )BETWEEN $from AND $to ")
		->groupby( "kemsa_code");
		$stocktake = $query ->execute();
		return $stocktake;
	}
	public static function getCounty() {	
		$month=date('n', time());
		$year=date('Y', time());
		$query = Doctrine_Query::create() -> select("kemsa_code,SUM(qtty_issued) as total") -> from("IssueModel") -> where("YEAR(`date_issued`)=$year AND MONTH( `date_issued` )BETWEEN $month AND $month ")
		->groupby( "kemsa_code");
		$stocktake = $query ->execute();
		
		return $stocktake;
	}

}

