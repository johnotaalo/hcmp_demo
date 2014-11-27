<?php
/**
 * @author Collins
 */
class meds_order_note_details extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('description', 'varchar', 250);
		$this -> hasColumn('name', 'varchar', 45);
		$this -> hasColumn('status', 'int');
		
	}

	public function setUp() {
		$this -> setTableName('meds_order_note_details');
		//$this -> hasMany('commodity_source as supplier_name', array('local' => 'commodity_source_id', 'foreign' => 'id'));
		//$this -> hasMany('commodity_sub_category as sub_category_data', array('local' => 'commodity_sub_category_id', 'foreign' => 'id'));
		//$this -> hasOne('Facility_stocks as facility', array('local' => 'id', 'foreign' => 'commodity_id'));
	}
	
}