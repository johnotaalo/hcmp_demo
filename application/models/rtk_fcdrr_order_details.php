<?php
class Rtk_Fcdrr_Order_Details extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('facility_code','varchar', 40);
		$this -> hasColumn('order_date','date');
		$this -> hasColumn('begin_date','date');
		$this -> hasColumn('end_date','date');
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
		$this -> setTableName('rtk_fcdrr_order_details');
		//$this -> hasOne('rtk_categories as commodity_category', array('local' => 'category', 'foreign' => 'id'));
	}
		public static function save_rtk_commodities($data_array){
		$o = new Rtk_Fcdrr_Order_Details ();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}


		/*public static function update_rtk_commodities($data_array){
		$o = new Rtk_Fcdrr_Order_Details ();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}*/


	public static function update_rtk_commodities($mydata){
				$q = Doctrine_Query::create()
			->update('rtk_fcdrr_order_details')
			->fromArray($mydata);
			//->where("Facility_Code='$facility_code'");
						$q->execute();
		
		echo 'successifully updated';
	}
public static function get_All(){
		$query = Doctrine_Query::create() -> select("*") -> from("rtk_fcdrr_order_details")->where("facility_code ='17401'")->OrderBy("id asc");
		$comm = $query -> execute();
		return $comm;
	}


 public static function get_facility_order_count($fqcility_code){
 		$last_month=date('m');
	$month_ago=date('Y-'.$last_month.'-d');
	// $facility_code=12889;
	
	$query = Doctrine_Query::create() -> select("facility_code, order_date") 
	-> from("rtk_fcdrr_order_details")-> where("month(order_date)=$last_month")->andWhere("facility_code='$fqcility_code'");
	$stocktake = $query ->execute()->toArray();
	return $query->count();
 }
}