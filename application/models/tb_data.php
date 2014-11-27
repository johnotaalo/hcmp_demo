<?php 
class Tb_data extends Doctrine_Record 
{
		public function setTableDefinition() {
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('facility_code', 'int',11);	
		$this -> hasColumn('beginning_date', 'date');	
		$this -> hasColumn('currently_recieved', 'int',11);
		$this -> hasColumn('ending_date', 'date');
		$this -> hasColumn('beginning_balance', 'int',11);
		$this -> hasColumn('quantity_dispensed', 'int',11);
		$this -> hasColumn('positive_adjustment', 'int',11);
		$this -> hasColumn('negative_adjustment', 'int',11);
		$this -> hasColumn('losses', 'int',11);
		$this -> hasColumn('physical_count', 'int',11);
		$this -> hasColumn('quantity_needed', 'int',11);
		$this -> hasColumn('report_date', 'timestamp');
		$this -> hasColumn('user_id', 'int',11);
		$this -> hasColumn('report_id', 'int',11);
	}

	public function setUp() {
		$this -> setTableName('tuberculosis_data');
	//	$this -> hasMany('user as u_type1', array('local' => 'id', 'foreign' => 'usertype_id'));
		
	}

	public static function get_facility_name($facility_code)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("facility_code='$facility_code'");
		$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $result[0];
	}

	public static function getall($facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll(
   	 		"select * from tuberculosis_data where facility_code = $facility_id order by report_date"
   	 		);
		return $query;
			
	}

	public static function get_all_other_2($report_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll(
   	 		"select * from tuberculosis_report_info where report_id = $report_id order by report_date"
   	 		);
		return $query;
			
	}

	public static function get_all_other($report_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll(
   	 		"select * from tuberculosis_data where report_id = $report_id order by report_date"
   	 		);
		return $query;
			
	}	

	public static function get_tb_drug_names(){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll(
   	 		"select * from tuberculosis_drugs"
   	 		); 
		return $query;
	}

	public static function get_facility_report_details($facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select distinct(user_id) as user, 
   	 				date_format(report_date, '%M %Y')as report_date, 
   	 				report_date as report_timestamp,report_id, 
   	 				facility_code as facility_code 
   	 				from tuberculosis_data 
   	 				where facility_code = $facility_id 
   	 				order by Report_Date desc"); 
		return $query;
			
	}

		public static function get_facility_report_details_for_view($facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select distinct(user_id) as user, 
   	 				date_format(report_date, '%M %Y')as report_date, 
   	 				report_date as report_timestamp,id, 
   	 				facility_code as facility_code 
   	 				from tuberculosis_data 
   	 				where facility_code = $facility_id 
   	 				order by Report_Date desc"); 
		return $query;
			
	}

}

 ?>
