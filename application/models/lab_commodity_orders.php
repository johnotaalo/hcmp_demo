<?php
class Lab_Commodity_Orders extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('facility_code','varchar', 50);
		$this -> hasColumn('district_id','int');
		$this -> hasColumn('order_date','date');
		$this -> hasColumn('vct','int');
		$this -> hasColumn('pitc','int');
		$this -> hasColumn('pmtct','int');
		$this -> hasColumn('b_screening','int');
		$this -> hasColumn('other','int');
		$this -> hasColumn('specification','varchar', 50);
		$this -> hasColumn('rdt_under_tests','int');
		$this -> hasColumn('rdt_under_pos','int');
		$this -> hasColumn('rdt_btwn_tests','int');
		$this -> hasColumn('rdt_btwn_pos','int');
		$this -> hasColumn('rdt_over_tests','int');
		$this -> hasColumn('rdt_over_pos','int');
		$this -> hasColumn('micro_under_tests','int');
		$this -> hasColumn('micro_under_pos','int');
		$this -> hasColumn('micro_btwn_tests','int');
		$this -> hasColumn('micro_btwn_pos','int');
		$this -> hasColumn('micro_over_tests','int');
		$this -> hasColumn('micro_over_pos','int');
		$this -> hasColumn('beg_date','date');
		$this -> hasColumn('end_date','date');
		$this -> hasColumn('explanation','int');
		$this -> hasColumn('moh_642','int');
		$this -> hasColumn('moh_643','int');
		$this -> hasColumn('compiled_by','int');
		$this -> hasColumn('report_for','varchar',15);
		$this -> hasColumn('created_at','timestamp');	
	}
	public function setUp() {
		$this -> setTableName('lab_commodity_orders');
		$this->hasMany('Facilities as facility', array(
            'local' => 'facility_code',
            'foreign' => 'facility_code'
        ));
		$this->hasMany('lab_commodity_details as order_details', array(
            'local' => 'id',
            'foreign' => 'order_id'
        ));
	}
	
	public static function save_lab_commodity_order($data_array){
		$o = new Lab_Commodity_Orders();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}
	//get the latest order id for a given facility
	public static function get_new_order($facility_code){
		$query = Doctrine_Query::create() -> 
		select("Max(id) as maxId")-> 
		from("lab_commodity_orders") ->
		where("facility_code='$facility_code'");
		$orderNumber = $query -> execute();	
		return $orderNumber[0];
	}
	//gets the orders that are associated with a given district
	public static function get_district_orders($district){
		
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT lab_commodity_orders.id, lab_commodity_orders.facility_code, facilities.facility_name, dist.id as district_id, dist.district as district_name, c.county, user.fname, user.lname, facilities.owner, lab_commodity_orders.order_date
		FROM lab_commodity_orders, facilities, user, districts dist, counties c
		WHERE district_id =$district
		AND lab_commodity_orders.district_id=dist.id
		AND dist.county=c.id
		AND lab_commodity_orders.facility_code = facilities.facility_code
		AND user.id = lab_commodity_orders.compiled_by
		ORDER BY lab_commodity_orders.id");
		return $query;
	}
	public static function get_recent_lab_orders($facility_code){
	date_default_timezone_set('EUROPE/moscow');
	$lastday = date('Y-m', time());
	$lastday = $lastday.'-1';

	$query = Doctrine_Query::create() -> select("facility_code, order_date") 
	-> from("Lab_Commodity_Orders")-> where(" order_date between '$lastday' AND NOW()")->andWhere("facility_code='$facility_code'");
	$stocktake = $query ->execute()->toArray();
	return $query->count();

}

public static function update_lab_commodity_orders($data_array){
$q = Doctrine_Query::create()
     ->update('lab_commodity_orders o')
     ->set('o.vct', 'Another value')
     ->set('o.pitc', 'Another value')
     ->set('o.pmtct', 'Another value')
     ->set('o.b_screening', 'Another value')
     ->set('o.other', 'Another value')
     ->set('o.specification', 'Another value')
     ->set('o.rdt_under_tests', 'Another value')
     ->set('o.rdt_under_pos', 'Another value')
     ->set('o.rdt_btwn_tests', 'Another value')
     ->set('o.rdt_btwn_pos', 'Another value')
     ->set('o.rdt_over_tests', 'Another value')
     ->set('o.rdt_over_pos', 'Another value')
     ->set('o.micro_under_tests', 'Another value')
     ->set('o.micro_under_pos', 'Another value')
     ->set('o.micro_btwn_tests', 'Another value')
     ->set('o.micro_btwn_pos', 'Another value')
     ->set('o.micro_over_tests', 'Another value')
     ->set('o.micro_over_pos', 'Another value')
     ->set('o.beg_date', 'Another value')
     ->set('o.end_date', 'Another value')
     ->set('o.explanation', 'Another value')
     ->set('o.moh_642', 'Another value')
     ->set('o.moh_643', 'Another value')
     ->where('l.id=?',1)
     ->andWhere('l.facility_code=?',1)
     ->execute();
	
}
public static function get_single_lab_order($order_id){
	$query=Doctrine_Manager::getInstance()->getCurrentConnection()
	->fetchAll("SELECT o.id, d.id as detail_id, f.facility_name, o.facility_code, o.district_id, dist.district as district_name, c.county as county_name, f.owner, cat.category_name, com.commodity_name, com.unit_of_issue, o.order_date as order_date, o.vct, o.pitc, o.pmtct, o.b_screening, o.other, o.specification, o.rdt_under_tests, o.rdt_under_pos, o.rdt_btwn_tests, o.rdt_btwn_pos, o.rdt_over_tests, o.rdt_over_pos, o.micro_under_tests, o.micro_under_pos, o.micro_btwn_tests, o.micro_btwn_pos, o.micro_over_tests, o.micro_over_pos, o.beg_date, o.end_date, o.explanation, o.moh_642, o.moh_643, o.compiled_by, u.fname, u.lname, u.telephone, d.order_id,d.facility_code,d.district_id,d.commodity_id,d.unit_of_issue,d.beginning_bal,d.q_received,d.q_used,d.no_of_tests_done,d.losses,d.positive_adj,d.negative_adj,d.closing_stock,d.q_expiring,d.days_out_of_stock,d.q_requested
		FROM lab_commodity_orders o, lab_commodity_details d,lab_commodity_categories cat, lab_commodities com, user u, facilities f, districts dist, counties c
		WHERE o.id=$order_id
		AND o.id=d.order_id
		AND o.district_id=dist.id
		AND dist.county=c.id
		AND o.facility_code=d.facility_code
		AND f.facility_code=o.facility_code
		AND u.id=o.compiled_by
		AND com.id=d.commodity_id
		AND cat.id=com.category
		ORDER BY d.commodity_id
		");
		return $query;
}
public static function getlastid(){
	$query = Doctrine_Manager::getInstance()->getCurrentConnection()
	->fetchAll("SELECT id FROM lab_commodity_orders ORDER by id");
	return $query;
}

}
?>