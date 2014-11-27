<?php
/**
 * @author Kariuki
 */
class facility_issues extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('facility_code', 'int'); 
		$this -> hasColumn('s11_No', 'int'); 
		$this -> hasColumn('commodity_id', 'int'); 
	    $this -> hasColumn('batch_no', 'varchar',20); 
		$this -> hasColumn('expiry_date', 'date'); 
		$this -> hasColumn('qty_issued', 'int');
		$this -> hasColumn('balance_as_of', 'int'); 
		$this -> hasColumn('adjustmentpve', 'int');
		$this -> hasColumn('adjustmentnve', 'int');
		$this -> hasColumn('date_issued', 'date'); 
		$this -> hasColumn('issued_to', 'varchar', 200);
		$this -> hasColumn('issued_by', 'int', 12);
		$this -> hasColumn('status', 'int');
			
	}
	public function setUp() {
		$this -> setTableName('facility_issues');		
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
	
	}//get all the data from the db
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("facility_issues");
		$commodities = $query -> execute();
		return $commodities;
	}
	
   ////dumbing data into the issues table
	public static function update_issues_table($data_array){
		$o = new facility_issues();
	    $o->fromArray($data_array);
		$o->save();
		return TRUE;
	}
   public static function get_last_time_facility_issued($facility_code){
        $transaction = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
        SELECT 
		    u.fname,
		    u.lname,
		    max(f_i.`created_at`) as last_seen,
		    DATEDIFF(now(), max(f_i.`created_at`)) as days_
		from
		    user u,
		    facility_issues f_i
		where
		    f_i.`issued_by` = u.id
		        and f_i.facility_code = $facility_code"); 

    return $transaction[0];    
   }
   //The function gets the consumption for the email consumption report
   public static function get_consumption_report_facility($facility_code)
   {
   	$date_ = date("m Y");
   	  $consumption = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
   	  SELECT 
		    cms.commodity_name,
		    cms.total_commodity_units as unit_size,
		    cms.unit_cost,
		    cs.source_name,
		    f.facility_name,
		    f.facility_code,
		    di.district,
		    c.county,
		    MONTHNAME(fs.date_issued) as month,
		    fs.qty_issued AS total_units,
		    (fs.qty_issued * cms.unit_cost) as total_cost,
		    CEIL(fs.qty_issued / cms.total_commodity_units) AS total_packs
		FROM
		    facility_issues fs,
		    commodities cms,
		    facilities f,
		    districts di,
		    commodity_source cs,
		    counties c
		WHERE
		    fs.facility_code = f.facility_code
		        AND f.facility_code = $facility_code
		        AND fs.qty_issued > 0
		        AND f.district = di.id
		        AND di.county = c.id
		        AND cs.id = cms.commodity_source_id
		        AND fs.status = '1'
		        AND DATE_FORMAT(fs.date_issued, '%m %Y') = '$date_'
		        AND cms.id = fs.commodity_id
		GROUP BY cms.commodity_name asc"); 

    return $consumption; 
	   
   }
	public static function get_bin_card($facility_code,$commodity_id,$from,$to){

		$convertfrom=date('Y-m-d',strtotime($from ));
		$convertto=date('Y-m-d',strtotime($to ));

	$transaction = Doctrine_Manager::getInstance()->getCurrentConnection()

     ->fetchAll("SELECT f.date_issued,f.expiry_date,f.batch_no,c.unit_size,f.s11_No,f.balance_as_of,f.adjustmentnve,
		f.adjustmentpve,f.qty_issued,u.fname,u.lname, f. issued_to as service_point_name 
		FROM facility_issues f INNER JOIN commodities c 
		ON c.id=f.commodity_id  INNER JOIN user u 
		ON f.issued_by = u.id WHERE f.facility_code=$facility_code
		AND f.status =1 AND f.commodity_id=$commodity_id
		AND f.date_issued BETWEEN '$convertfrom' 
		AND '$convertto' 
		ORDER BY f.date_issued asc"); 
		


			return $transaction;	
	}
	public static function get_active_facilities_in_district($district)
	{
	 	$query = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT f.`facility_name` , count( fi.`facility_code` ) AS issue_count
			FROM facilities f, facility_issues fi
			WHERE fi.`facility_code` = f.`facility_code`
			AND fi.`availability` =1
			AND f.`district` = '$district'
			GROUP BY fi.`facility_code`
			ORDER BY issue_count DESC , f.`facility_name` ASC
			LIMIT 0 , 5 ");
        return $query ;
	}
	
	public static function get_inactive_facilities_in_district($district)
	{
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT f.`facility_name`
			FROM facilities f, user u
			WHERE u.`facility` != f.`facility_code`
			AND f.`district` = '$district'
			GROUP BY f.`facility_code`
			ORDER BY f.`facility_name` ASC");
		
		return $query ;
	}
}