<?php
class Delivery_Details extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('name', 'varchar',255);
		$this -> hasColumn('id_no', 'int',255);	
		$this -> hasColumn('phone', 'varchar',255);
		$this -> hasColumn('facility', 'int',11);	
		$this -> hasColumn('district', 'int',11);
		$this -> hasColumn('order_number', 'varchar',255);	
		$this -> hasColumn('user_level', 'varchar',255);
		$this -> hasColumn('delivery_no', 'varchar',255);	
	}

	public function setUp() {
		$this -> setTableName('delivery_details');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
	}
}