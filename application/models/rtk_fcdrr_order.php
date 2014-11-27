<?php
class Rtk_Fcdrr_Order extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('commodity_id','varchar', 40);
		$this -> hasColumn('beginning_balance','varchar', 40);
		$this -> hasColumn('warehouse_quantity_received','varchar', 40);
		$this -> hasColumn('warehouse_lot_no','varchar', 40);
		$this -> hasColumn('other_quantity_received','varchar', 40);
		$this -> hasColumn('other_lot_no','varchar', 40);
		$this -> hasColumn('quantity_used','varchar', 40);
		$this -> hasColumn('loss','varchar', 40);
		$this -> hasColumn('positive_adj','varchar', 40);
		$this -> hasColumn('negative_adj','varchar', 40);
		$this -> hasColumn('physical_count','varchar', 40);
		$this -> hasColumn('quantity_requested','varchar', 40);

 }
 public function setUp() {
		$this -> setTableName('rtk_fcdrr_order');
		//$this -> hasOne('rtk_categories as commodity_category', array('local' => 'category', 'foreign' => 'id'));
	}
		public static function save_rtk_order($data_array){
		$o = new Rtk_Fcdrr_Order ();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}

	
}