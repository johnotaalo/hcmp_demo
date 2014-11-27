<?php
class Stockcontrol extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('facility_code', 'varchar',30);
		$this -> hasColumn('kemsa_code', 'varchar','20');
		$this -> hasColumn('s11_no', 'varchar','20');
		$this -> hasColumn('batch_No', 'varchar','20');
		$this -> hasColumn('exp_Date', 'date');
		$this -> hasColumn('qtty_issued', 'int',5);
		$this -> hasColumn('pdate', 'date');
	}

	public function setUp() {
		$this -> setTableName('stockcontrolc');
		//$this -> hasMany('drug as stock_Drugs', array('local' => 'kemsa_code', 'foreign' => 'Kemsa_Code'));
	}

	

}

