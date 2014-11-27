<?php
class Lab_Commodity_Details extends Doctrine_Record {
	public function setTableDefinition() {
		 $this -> hasColumn('id','int');
		 $this -> hasColumn('order_id','int');
		 $this -> hasColumn('facility_code', 'varchar', 10);
		 $this -> hasColumn('district_id','int');
		 $this -> hasColumn('commodity_id',	'int');
		 $this -> hasColumn('unit_of_issue','int');
		 $this -> hasColumn('beginning_bal','int');
		 $this -> hasColumn('q_received','int');
		 $this -> hasColumn('q_used','int');
		 $this -> hasColumn('no_of_tests_done',	'int');
		 $this -> hasColumn('losses','int');
		 $this -> hasColumn('positive_adj',	'int');
		 $this -> hasColumn('negative_adj',	'int');
		 $this -> hasColumn('closing_stock','int');
		 $this -> hasColumn('q_expiring','int');
		 $this -> hasColumn('days_out_of_stock','int');
		 $this -> hasColumn('q_requested','int');
	 }
	 public function setUp() {
		$this -> setTableName('lab_commodity_details');
		$this -> hasMany('facility_code as Code', array('local' => 'facility_code', 'foreign' => 'facilityCode'));
		$this->hasMany('lab_commodities as lab_commodities', array(
            'local' => 'commodity_id',
            'foreign' => 'id'
        ));
		 $this->hasOne('lab_commodity_orders as orders', array(
            'local' => 'order_id',
            'foreign' => 'id'
        ));
		// $this -> hasOne('facility_code as Coder', array('local' => 'facility_code', 'foreign' => 'facility_code'));
		// $this -> hasOne('facility_code as Codes', array('local' => 'facility_code', 'foreign' => 'facility'));
		// $this -> hasOne('district as facility_district', array('local' => 'district', 'foreign' => 'id'));
	}
	public static function save_lab_commodities($data_array){
		$o = new Lab_Commodity_Details ();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}
		//get the latest order id for a given facility
	public static function get_new_order($facilityCode){
		$query = Doctrine_Query::create() -> 
		select("Max(id) as maxId")-> 
		from("lab_commodity_orders") ->
		where("facility_code='$facilityCode'");
		$orderNumber = $query -> execute();	
		return $orderNumber[0];
	}
	//get the order details associated with a given order number
  public static function get_order($delivery){
  		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT cat.category_name, com.commodity_name, l.`order_id`, l.`facility_code`, l.`unit_of_issue`, l.`beginning_bal`, l.`q_received`, l.`q_used`, l.`no_of_tests_done`, l.`losses`, l.`positive_adj`, l.`negative_adj`, l.`closing_stock`, l.`q_expiring`, l.`days_out_of_stock`, l.`q_requested`
		FROM lab_commodity_details l, lab_commodity_categories cat, lab_commodities com
		WHERE order_id=$delivery
		AND com.id=l.`commodity_id`
		AND cat.id=com.category
		ORDER BY commodity_id ASC");
		  return $query;
  	}

}
	?>