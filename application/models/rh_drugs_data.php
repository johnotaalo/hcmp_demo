<?php
class RH_Drugs_Data extends Doctrine_Record 
{
	public function setTableDefinition() 
	{
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('facility_id', 'int',11);
		$this -> hasColumn('user_id', 'int',11);
		$this -> hasColumn('Report_Date', 'date');
		$this -> hasColumn('Beginning_Balance', 'varchar',30);
		$this -> hasColumn('Received_This_Month', 'varchar',30);
		$this -> hasColumn('Dispensed', 'varchar',30);
		$this -> hasColumn('Losses', 'varchar',30);
		$this -> hasColumn('Adjustments', 'varchar',30);
		$this -> hasColumn('Ending_Balance', 'varchar',30);
		$this -> hasColumn('Quantity_Requested', 'varchar',30);
		$this -> hasColumn('report_id', 'int',15);
			
	}

	public function setUp() 
	{
		
		$this -> setTableName('rh_drugs_data');
				
	}
	public static function get_user_data($id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")->where("user_id='$id'");
		$userdata = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $userdata[0];
			
	}
	public static function getall($id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")-> where("user_id = '$id' ")->groupBy("Report_Date");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function getall_time($time)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")-> where("Report_Date = '$time' ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function get_facility_report_details($facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select distinct(user_id) as user, 
   	 	date_format(Report_Date, '%M %Y')as report_date, 
   	 	report_date as report_timestamp, report_id, 
   	 	facility_id as facility_code 
   	 	from rh_drugs_data 
   	 	where facility_id = $facility_id 
   	 	order by Report_Date desc"); 
		return $query;
			
	}
	public static function get_facility_report($report_id, $facility_id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("rh_drugs_data")-> where("report_id = '$report_id' AND facility_id = $facility_id ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	
	
	 
}