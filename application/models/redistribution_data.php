<?php

class redistribution_data extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('source_facility_code', 'int');
		$this -> hasColumn('receive_facility_code', 'int');
		$this -> hasColumn('commodity_id', 'int');
		$this -> hasColumn('quantity_sent',  'int');
		$this -> hasColumn('quantity_received',  'int');
		$this -> hasColumn('sender_id',  'int');
		$this -> hasColumn('receiver_id',  'int');
		$this -> hasColumn('manufacturer', 'varchar', 100);
		$this -> hasColumn('batch_no', 'varchar', 100);
		$this -> hasColumn('expiry_date', 'date');
		$this -> hasColumn('date_sent', 'date');
		$this -> hasColumn('date_received', 'date');
		$this -> hasColumn('facility_stock_ref_id', 'int');
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('redistribution_data');
		$this->hasMany('facility_stocks as stock_detail', array('local' => 'facility_stock_ref_id', 'foreign' => 'id'));
		$this->hasMany('facilities as facility_detail_source', array('local' => 'source_facility_code', 'foreign' => 'facility_code'));
		$this->hasMany('facilities as facility_detail_receive', array('local' => 'receive_facility_code', 'foreign' => 'facility_code'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("redistribution_data");
		$redistribution_data = $query -> execute();
		return $redistribution_data;
	}
	public static function get_all_active($facility_code,$option=null) {
		$and=($option=='to-me')? " receive_facility_code=$facility_code" : " source_facility_code=$facility_code";
	
		$query = Doctrine_Query::create() -> select("*") -> from("redistribution_data") -> where("$and and status=0");
		$redistribution_data = $query -> execute();
		return $redistribution_data;
	}

		public static function get_all_active_drug_store($district_id,$option=null) {
		$and=($option=='to-me')? " receive_facility_code=0":null;
		$query = Doctrine_Query::create() -> select("*") -> from("redistribution_data") -> where("$and and district_id = '$district_id' and status=0");
		$redistribution_data = $query -> execute();
		return $redistribution_data;
	}
	
	public static function get_redistribution_data($facility_code,$district_id,$county_id,$year){
	 $and_data .=(isset($district_id)&& ($district_id>0)) ?"AND d.id = '$district_id'" : null;
	 $and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND f.facility_code = '$facility_code'" : null;
     $and_data .=($county_id>0) ?" AND d.county='$county_id'" : null;
	 $and_data .=isset($year) ?" AND year(r_d.`date_sent`)='$year'" : null;
     $query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
     select temp1.fname as sender_name, temp1.fname as receiver_name, 
     r_d.`source_facility_code`, f.facility_name as source_facility_name,d.district as source_district, temp3.facility_name as receiver_facility_name, 
     temp3.facility_code as receiver_facility_code,temp4.district as receiver_district,  c.`id`, c.commodity_name,c.commodity_code, c.unit_size, c.unit_cost, 
     c.total_commodity_units, r_d.`quantity_sent`, r_d.`quantity_received`, r_d.`manufacturer`,
     r_d.`batch_no`, r_d.`expiry_date`, r_d.`status`, r_d.`date_sent`, r_d.`date_received` 
     from facilities f, commodities c, districts d, redistribution_data r_d  
     left join user  as temp1 on temp1.id=r_d.`sender_id` 
     left join user  as temp2 on temp2.id=r_d.`receiver_id` 
     left join facilities as temp3 on temp3.facility_code=r_d.`receive_facility_code`  
     left join districts as temp4 ON temp4.id = temp3.district
      where r_d.commodity_id=c.id and r_d.`source_facility_code`=f.facility_code and f.district=d.id $and_data ");	

	return $query;	
	}
	
}
?>
