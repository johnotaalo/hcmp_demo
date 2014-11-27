<?php
class Dispatch_Details extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('kemsa_code', 'varchar',20);
		$this -> hasColumn('quantity', 'int',11);
		$this -> hasColumn('batch_no', 'varchar',20);
		$this -> hasColumn('manufacture', 'varchar',20);
		$this -> hasColumn('local_order_no', 'int',11);
		$this -> hasColumn('quantityOrdered', 'varchar',100);
		$this -> hasColumn('quantityRecieved', 'varchar',100);
		$this -> hasColumn('order_date', 'date');
		$this -> hasColumn('order_total', 'varchar',20);
		$this -> hasColumn('recieve_date', 'date');
		$this -> hasColumn('order_batch_no', 'varchar',20);
		$this -> hasColumn('dispatch_date', 'date');
		$this -> hasColumn('expiry_date', 'date');
	}
	public function setUp() {
		$this -> setTableName('dispatch_details');
		//$this -> hasOne('facility_code as Code', array('local' => 'facility_code', 'foreign' => 'facilityCode'));
		 $this->hasMany('drug as Code', array('local' => 'Kemsa_Code','foreign' => 'Kemsa_Code'));
	}
	public static function getAll($delivery) {
		$query = Doctrine_Query::create() -> select("*") -> from("dispatch_details")->where("local_order_no='$delivery'");
		$details = $query -> execute();
		return $details;
	}
}