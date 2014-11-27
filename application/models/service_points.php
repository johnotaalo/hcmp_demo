<?php
/**
 * @author Kariuki
 */
class service_points extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('facility_code', 'int');
				$this->hasColumn('service_point_name', 'varchar',100);
				$this->hasColumn('for_all_facilities', 'int');
				$this->hasColumn('date_added', 'date');
				$this->hasColumn('date_modified', 'date');
				$this->hasColumn('added_by', 'int');
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('service_points');		
		$this -> hasMany('facilities as facility_details', array('local' => 'facility_code', 'foreign' => 'facility_code'));
		$this -> hasMany('users as system_users', array('local' => 'added_by', 'foreign' => 'id'));
	}
   public static function get_all_active($facility_code,$request=null) {
   	$status=($request=='all')? null : 'status=1 and '; 
		$query = Doctrine_Query::create() 
		-> select("*") -> from("service_points")->where("$status (for_all_facilities=1 or facility_code=$facility_code )");
		$service_points = $query -> execute();
		return $service_points;
	}//save the data on to the table 
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("service_points");
		$service_points = $query -> execute();
		return $service_points;
	}//save the data on to the table 
   public static function update_service_points($data_array){
		$o = new service_points();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}//edit a service point
	public static function edit_service_point($id,$service_point_name,$for_all_facilities,$added_by,$status){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
update service_points set `service_point_name`='$service_point_name',
`for_all_facilities`='$for_all_facilities',`added_by`='$added_by',
`status`='$status'
where `id`='$id' 
");		
	}
	
	
}
