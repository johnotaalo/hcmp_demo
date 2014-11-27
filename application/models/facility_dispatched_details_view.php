<?php
class Facility_Dispatched_Details_View extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('kemsa_code', 'varchar',20);	
		$this -> hasColumn('kemsa_order_no', 'varchar',20);	
		$this -> hasColumn('quantity', 'int');	
		$this -> hasColumn('quantityOrdered', 'int');
		$this -> hasColumn('batch_no', 'varchar',20);	
		$this -> hasColumn('expiry_date', 'date');	
		$this -> hasColumn('manufacture', 'varchar',20);	
	}

	public function setUp() {
		$this -> setTableName('facility_dispatched_details_view');
		 $this->hasMany('drug as Code', array(
            'local' => 'kemsa_code',
            'foreign' => 'Kemsa_Code'
        ));
		
	}
	public static function getAll($kemsa_order_no) {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_dispatched_details_view")->where("kemsa_order_no='$kemsa_order_no'");
		$details = $query -> execute();
		return $details;
	}

}
?>