<?php
class Facilities extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('facility_code', 'varchar',30);
		$this -> hasColumn('targetted', 'int');
		$this -> hasColumn('facility_name', 'varchar',30);
		$this -> hasColumn('district', 'varchar',30);
		$this -> hasColumn('partner', 'int',11);
		$this -> hasColumn('owner', 'varchar',30);
		$this -> hasColumn('level', 'varchar',30);
		$this->hasColumn('drawing_rights','text');
		$this->hasColumn('using_hcmp','int');//
		$this->hasColumn('date_of_activation','date');
	}

	public function setUp() {
		$this -> setTableName('facilities');
		$this -> hasOne('facility_code as Code', array('local' => 'facility_code', 'foreign' => 'facilityCode'));
		$this -> hasOne('facility_code as Coder', array('local' => 'facility_code', 'foreign' => 'facility_code'));
		$this -> hasOne('facility_code as Codes', array('local' => 'facility_code', 'foreign' => 'facility'));
		$this -> hasMany('districts as facility_subcounty', array('local' => 'district', 'foreign' => 'id'));
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("facilities");
		$drugs = $query -> execute();
		return $drugs;
	}
	public static function getAll_json() {
		$query = Doctrine_Query::create() -> select("*") -> from("facilities");
		$drugs = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $drugs;
	}
	public static function getFacilities($district){
		
		$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("district='$district'")->OrderBy("facility_name asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	public static function getFacilities_json($district){
		
		$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("district='$district'")->OrderBy("facility_name asc");
		$drugs = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $drugs;
	}
	public static function getFacilities_for_email($district){
		
		$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("district='$district' AND using_hcmp=1")->OrderBy("facility_name asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	public static function get_Facilities_using_HCMP($county_id = null, $district_id = null)
	{
		$and_data =(isset($county_id)&& ($county_id>0)) ?" AND d.county = $county_id" : null;
	    $and_data .=(isset($district_id)&& ($district_id>0)) ?" AND f.district = $district_id" : null;

	    $and_data .= " AND using_hcmp = 1 ";
		
	   	$query = Doctrine_Query::create() ->select("*") ->from("facilities f, districts d")->where("f.district = d.id $and_data")->OrderBy("facility_name asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	
	//gets all the facilitites using HCMP in the system
	//For weekly email updates
	public static function get_all_using_HCMP($county_id)
	{
		$and_data = (isset($county_id)&&$county_id>0)?" AND d.county = $county_id" :null;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT DISTINCT
		    (f.district) as district, d.district as name
		from
		    facilities f,
		    districts d
		where
		    f.district = d.id 
		    $and_data
		    AND using_hcmp = 1");
			
		return $q;
	}
	public static function get_counties_all_using_HCMP()
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT DISTINCT
		    (d.county) as county, c.county as county_name
		from
		    facilities f,
		    districts d,
		    counties c
		where
		c.id = d.county
		AND f.district = d.id 
		AND using_hcmp = 1");
			
		return $q;
	}
	//In case the stock outs or expiries for Taita Taveta are not sent out
	public static function get_Taita()
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT DISTINCT
		    id as county, c.county as county_name
		from
		     counties c
		where
		c.id = 39");
			
		return $q;
	}
	//get the facility codes of facilities in a particular district
	public static function get_district_facilities($district)
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT DISTINCT (facility_code)
			FROM  `facilities` 
			WHERE district =$district");
		return $q;	
	}
	// getting facilities which are using the system
	public static function get_facilities_which_are_online($county_id)
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT facility_code, facility_name,f.district
		FROM facilities f, districts d
		WHERE f.district = d.id
		AND d.id =$county_id
		AND UNIX_TIMESTAMP(  `date_of_activation` ) >0
		ORDER BY  `facility_name` ASC ");
		return $q;	
	}
   public static function get_tragetted_rolled_out_facilities($facility_code=null,$district_id=null,$county_id=null,$identifier=null){
        switch ($identifier){
        	case county:
			 $where_clause= "d.county=$county_id " ;	
			break;	
			case district:
			 $where_clause= "d.id=$district_id" ;	
			break;	
			case facility:
			case facility_admin:
			 $where_clause= "f.facility_code=$facility_code " ;	
			break;	
           default:
			 $where_clause=isset($facility_code)? "f.facility_code=$facility_code ":
			  (isset($district_id) && !isset($county_id)? "d.id=$district_id ": "d.county=$county_id ") ;
			break;	
        }
        $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
        SELECT SUM( targetted ) AS targetted, SUM( using_hcmp ) AS using_hcmp, COUNT( facility_code ) AS total
        FROM districts d, facilities f
        WHERE f.district = d.id
        and $where_clause");
        return $q;    
   }
	public static function get_facility_name_($facility_code)
	{			
		if($facility_code!=NULL)
		{
			$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("facility_code='$facility_code'");
			$drugs = $query -> execute();
			return $drugs;	
		}	
		else{
			return NULL;
		}	
			
	}
	   public static function get_facilities_monitoring_data($facility_code=null,$district_id=null,$county_id=null,$identifier=null){
        switch ($identifier){
        	case county:
			 $where_clause= "d.county=$county_id " ;	
			break;	
			case district:
			 $where_clause= "d.id=$district_id" ;	
			break;	
			case facility:
			case facility_admin:
			 $where_clause= "f.facility_code=$facility_code " ;	
			break;	
           default:
			 $where_clause=isset($facility_code)? "f.facility_code=$facility_code ":
			  (isset($district_id) && !isset($county_id)? "d.id=$district_id ": "d.county=$county_id ") ;
			break;	
        }
    $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
    SELECT u.fname, u.lname,f.facility_name, f.facility_code,d.district,
    MAX( f_i.`created_at` ) AS last_issued, ifnull(DATEDIFF( NOW( ) , MAX( f_i.`created_at` ) ),0) AS days_last_issued, 
    MAX( l.end_time_of_event ) AS last_seen, ifnull(DATEDIFF( NOW( ) , MAX( l.end_time_of_event ) ),0) AS days_last_seen
    FROM user u, log l, facilities f, districts d, facility_issues f_i
    WHERE f_i.`issued_by` = u.id
    and l.user_id=u.id
    AND u.facility = f.facility_code
    AND f.district = d.id
    and $where_clause
    GROUP BY f.facility_code
 ");
return $q;  
    
}
	public static function get_facilities_online_per_district($county_id){
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select d.id, d.district,f.facility_name,f.type,f.facility_code,f.level,f.owner, DATE_FORMAT(`date_of_activation`,'%d %b %y') as date 
from facilities f, districts d 
where f.district=d.id and d.county='$county_id'
and unix_timestamp(f.`date_of_activation`) >0 
order by d.district asc,f.`date_of_activation` asc
 ");
return $q;	
	
}
public static function get_facilities_all_per_district($county_id,$option=null){
	$new=isset($option)  ? "and f.facility_code not in (select f.facility_code from facilities f, districts d 
where f.district=d.id and d.id=$county_id and using_hcmp=1)" : null;
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select d.id, d.district,f.facility_name,f.facility_code
from facilities f, districts d 
where f.district=d.id and d.id='$county_id'  $new
order by f.facility_name asc
 ");
return $q;	
	
}
	
	public static function get_d_facility($district){
		'SELECT unique facilities.facility_name, user.fname, user.lname, user.telephone
			FROM facilities, user
			WHERE facilities.district ='.$district.'
			AND user.district ='.$district.'
			AND user.facility = facilities.facility_code
			AND user.usertype_id =2';
		
		$q = Doctrine_Manager::getInstance()->getCurrentConnection();
		$result = $q-> execute(" 
		SELECT user.email, 
			facilities.facility_code, facilities.facility_name, user.fname, user.lname, 
			user.telephone
				FROM facilities, user
				WHERE facilities.district =  '$district'
				AND user.district =  '$district'
				AND user.facility = facilities.facility_code
				AND user.status =  '1'
				AND (
				user.usertype_id =5
				OR user.usertype_id =2
				)
				GROUP BY user.facility");

		return $result;
		
	}
	
	/*************************getting the facility name *******************/
	public static function get_facility_name($facility_code)
	{
		$query = Doctrine_Query::create()->select('*')->from('facilities')->where("facility_code='$facility_code'");
		$result = $query -> execute();
		return $result;
	}	
	public static function get_facility_name2($facility_code)
	{
	$query = Doctrine_Query::create()->select('facility_name')->from('facilities')->where("facility_code='$facility_code'");
	$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
	return $result[0];
	}
	/********************getting the facility owners  count*************/
	public static function get_owner_count() {
		$query = Doctrine_Query::create() -> select("COUNT(facility_code) as count , owner ") 
		-> from("facilities")->where("owner !=''")->groupby("owner")->ORDERBY ('count ASC' );
		$drugs = $query -> execute();
		return $drugs;
	}
	
public static function get_no_of_facilities($category){
		$district = $category;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT(f.facility_code) as total_facilities
FROM facilities f, counties c, districts d
WHERE f.`district` = d.id
AND d.county = c.id
AND c.id =  $district ");
return $q;

}


public static function get_total_facilities_in_district($county_id){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( f.facility_code ) as total_facilities
FROM facilities f, districts d
WHERE f.`district` = d.id
AND d.id =  '$county_id'
");
return $q;
}
public static function get_all_facilities_in_county($county_id){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT DISTINCT( f.facility_code ) as facilities
FROM facilities f, districts d
WHERE f.`district` = d.id
AND d.id =  '$county_id'
");
return $q;
}

public static function get_all_facilities_no(){
	$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT COUNT( f.id ) AS total_no_of_facilities
	FROM facilities f,districts d
	 where f.`district` = d.id
		");

	return $query;
}

public static function get_all_facilities_active_no(){
	$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT COUNT( f.id ) AS total_active_facilities
	FROM facilities f,districts d
	 where f.`district` = d.id AND f.using_hcmp = 1
		");

	return $query;
}

public static function get_total_facilities_district_ownership($county_id,$owner_type){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( f.facility_code ) AS ownership_count
FROM facilities f, counties c, districts d
WHERE rtk_enabled =1
AND f.`district` = d.id
AND d.county = c.id
AND d.id =  '$county_id'
AND f.owner like '%$owner_type%'
");
return $q;
}

public static function get_facility_details($category){
		$district = $category;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT DISTINCT f.id, f.facility_code, f.facility_name, f.district, f.owner, c.county, d.district as district_name
FROM facilities f, districts d, counties c
WHERE f.district = d.id
AND d.county=c.id
AND d.id= $district");
return $q;
}
////////////////////////////////////////////////
public static function get_one_facility_details($facility_c){
	$facility_code = $facility_c;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT DISTINCT f.id, f.facility_code, f.facility_name, f.district, f.owner, c.county, d.district as district_name
FROM facilities f, districts d, counties c
WHERE f.facility_code='$facility_code'
AND f.district=d.id
AND d.county=c.id");
return $q;

}
public static function get_drawingR_county_by_district(){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT * 
FROM (SELECT  `facility_code` ,  `facility_name` , facilities.`district` , SUM(  `drawing_rights` ) AS drawingR, districts.district AS districtName
FROM facilities, districts
WHERE facilities.district = districts.id
AND districts.county =1
GROUP BY facilities.`district`
) AS temp
WHERE temp.drawingR !=  'NULL'
");
return $q;
}

public static function get_county_drawing_rights($county_id){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT SUM( f.`drawing_rights` ) AS initial_drawing_rights, SUM( f.`drawing_rights_balance` ) AS drawing_rights_balance, d.`district` 
FROM facilities f, districts d, counties c
WHERE f.district = d.id
AND d.county = c.id
AND c.id =$county_id
GROUP BY d.id
order by d.district asc
");
return $q;	

}

public static function get_orders_made_in_district($district_id){
		$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT count( f.`id` ) AS total_no_of_facilities
FROM facilities f, districts d
WHERE f.district = d.id
AND d.id =$district_id
");


		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT COUNT( f.`id` ) AS orders_made_data
FROM facilities f, districts d,ordertbl o
WHERE f.district = d.id
AND d.id =$district_id
AND o.facilityCode=f.facility_code
");


return array('total_no_of_facilities'=>$q_1[0]['total_no_of_facilities'],'orders_made_data'=>$q[0]['orders_made_data']);	
}
public static function get_no_of_facilities_hcmp($county_id=NULL,$district_id=NULL)
{
	if($district_id!=NULL){
		$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	SELECT COUNT( f.id ) AS total_no_of_facilities
	FROM facilities f, districts d
	WHERE f.district = d.id
	AND d.id ='$district_id'
	");

		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT COUNT( DISTINCT u.`facility` ) AS total_no_of_facilities
		FROM facilities f, districts d, user u
		WHERE f.district = d.id
		AND u.facility = f.facility_code
		AND u.status =  '1'
		AND d.id= '$district_id'
		");
	
	}else{
		$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	SELECT count(f.`id`) AS total_no_of_facilities
	FROM facilities f, districts d, counties c
	WHERE f.district = d.id
	AND d.county =c.id
	AND c.id= '$county_id'
	");

	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	SELECT COUNT( DISTINCT u.`facility` ) AS total_no_of_facilities
	FROM facilities f, districts d, counties c, user u
	WHERE f.district = d.id
	AND u.facility = f.facility_code
	AND d.county = c.id
	AND u.status =  '1'
	AND c.id= '$county_id'
	");
}

return array('total_no_of_facilities'=>$q_1[0]['total_no_of_facilities'],'total_no_of_facilities_using_hcmp'=>$q[0]['total_no_of_facilities']);
}

public static function get_facility_status_no_users_status($facility_code){
$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll('
SELECT COUNT( DISTINCT u.id ) AS number_of_users, COUNT(DISTINCT l.user_id ) AS number_of_users_online, 
CASE 
WHEN EXISTS (
SELECT u.id 
FROM user
WHERE user.facility ="'.$facility_code.'")
THEN "Active"
ELSE "Inactive"
END AS 
status
 FROM user u
LEFT JOIN log l ON u.id = l.user_id AND l.action = "Logged In"
WHERE u.facility ="'.$facility_code.'"
');	

return $q;
}
public static function get_dates_facility_went_online($county_id, $district_id = null){
	$addition = (isset($district_id)&& ($district_id>0)) ?"AND f.district = $district_id" : null;
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT 
	DISTINCT DATE_FORMAT(  `date_of_activation` ,  '%M %Y' ) AS date_when_facility_went_online
	FROM facilities f, districts d
	WHERE f.district = d.id
	AND d.county =$county_id
	$addition
	AND UNIX_TIMESTAMP(  `date_of_activation` ) >0
	ORDER BY  `date_of_activation` ASC 
	");
	return $q;
		
}

public static function get_facilities_which_went_online_($district_id = null, $date_of_activation)
{
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	SELECT 
		(select count(targetted) from facilities f 	where f.district='$district_id' and f.targetted = 1) as total_facilities_targetted, 
		(select count(facility_name) from facilities f where f.district = $district_id and using_hcmp=1) as total_using_hcmp,
		count(facility_code) as total ,
		(select count(id) from facilities f where f.district='$district_id') as total_facilities 
	from 
		facilities f, 
		districts d 
	where 
		f.district = d.id 
		and d.id = $district_id 
		and DATE_FORMAT(  `date_of_activation` ,  '%M %Y' ) = '$date_of_activation' AND using_hcmp=1");
				
		return $q;		
}
public static function get_targetted_facilities($district_id = null)
{
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	SELECT 
    	count(targetted) as total_facilities_targetted
	from
	    facilities f
	where
	    f.district = '$district_id' and f.targetted = 1
		");
				
		return $q;		
}
public static function get_facilities_reg_on_($district_id,$date_of_activation){
	
		$query = Doctrine_Query::create() -> select("*") -> from("facilities f, districts d")->where("f.district=d.id and d.id ='$district_id'")
		
		->andwhere("date_format(`date_of_activation`, '%M %Y')='$date_of_activation' and unix_timestamp(`date_of_activation`) >0");
		
		$facilities = $query -> execute();
		
		return $facilities;
	}

// getting facilities which are using the system

public static function get_total_facilities_rtk_in_district($district_id){
	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT  f.facility_code , f.owner as facility_owner,f.facility_name
		FROM facilities f, districts d
		WHERE rtk_enabled =1
		AND d.id='$district_id'
		AND f.`district` = '$district_id'");
return $q;
}

	
}
