<?php
class Malaria_Data extends Doctrine_Record 
{
	public function setTableDefinition() 
	{
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('facility_id', 'int',11);
		$this -> hasColumn('user_id', 'int',11);
		$this -> hasColumn('Kemsa_Code', 'varchar',30);
		$this -> hasColumn('Beginning_Balance', 'varchar',30);
		$this -> hasColumn('Quantity_Received', 'varchar',30);
		$this -> hasColumn('Quantity_Dispensed', 'varchar',30);
		$this -> hasColumn('Losses_Excluding_Expiries', 'varchar',30);
		$this -> hasColumn('Positive_Adjustments', 'varchar',30);
		$this -> hasColumn('Negative_Adjustments', 'varchar',30);
		$this -> hasColumn('Physical_Count', 'varchar',30);
		$this -> hasColumn('Expired_Drugs', 'varchar',30);
		$this -> hasColumn('Days_Out_Stock', 'int',11);
		$this -> hasColumn('Report_Total', 'varchar',30);
		$this -> hasColumn('Report_Date', 'date');
		$this -> hasColumn('report_id', 'int',15);
		
			
	}

	public function setUp() 
	{
		$this -> setTableName('malaria_data');
				
	}
	public static function get_user_data($id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")->where("user_id='$id'");
		$userdata = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $userdata[0];
			
	}
	public static function getall($id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")-> where("user_id = '$id' ")->groupBy("Report_Date") ->orderBy("Report_Date desc");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function getall_facility($facility_id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")-> where("facility_id = '$facility_id' ")->groupBy("Report_Date") ->orderBy("Report_Date desc");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	//get the report details of a particular facility
	public static function get_facility_report_details($facility_id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select distinct(user_id) as user, 
   	 			date_format(Report_Date, '%M %Y')as report_date, 
   	 			report_date as report_timestamp, report_id, 
   	 			facility_id as facility_code 
   	 			from malaria_data 
   	 			where facility_id = $facility_id 
   	 			order by Report_Date desc"); 
		return $query;
			
	}
	//get the malaria report for a particular facility 
	public static function get_report_submitter($id)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
   	 	->fetchAll("select distinct(user_id) as user, facility_id from malaria_data where facility_id = $id order by user_id"); 
		return $query;
			
	}
	public static function getall_time($time)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")-> where("Report_Date = '$time' ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function get_facility_report($report_id, $facility_id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")-> where("report_id = '$report_id' AND facility_id = $facility_id ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function get_facilities()
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
    	->fetchAll("SELECT DISTINCT(facility_id) from malaria_data"); 
		return $query;
			
	}
	/*
	 * $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
    ->fetchAll("SELECT c.commodity_name, c.commodity_code, c.id as commodity_id, c.total_commodity_units,
              c.unit_size,c.unit_cost ,c_s.source_name, c_s_c.sub_category_name
               FROM commodities c,commodity_sub_category c_s_c, commodity_source c_s
               WHERE c.commodity_sub_category_id = c_s_c.id
               AND c.commodity_source_id=$supplier_id
               AND c.commodity_sub_category_id = c_s_c.id
               order by c_s_c.id asc,c.commodity_name asc "); 
return $inserttransaction;
	 * 
	 * public static function get_malariareport($id, $to_date, $from_date)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_data")-> where("facility_id = '$id' and to_date < = '$to_date' and from_date >= '$from_date' ");
		$all_data = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $all_data;
			
	}
	public static function getreports() 
	{
		
		$from = $_POST['frommalariareport'];
		$to = $_POST['tomalariareport'];
		$facility_Code = $_POST['facilitycode'];
		$convertfrom = date('y-m-d',strtotime($from ));
		$convertto = date('y-m-d',strtotime($to ));
		
		$query = Doctrine_Query::create() -> select("*") 
		-> from("malaria_data")-> where("from_date >='$convertfrom' AND to_date <='$convertto'");
		$stocktake = $query ->execute();
		return $stocktake;
	}
	 * */
	
	 
}