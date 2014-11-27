<?php
class Log extends Doctrine_Record {
	public function setTableDefinition() 
	{
		$this -> hasColumn('id', 'int',50);	
		$this -> hasColumn('user_id', 'int',50);	
		$this -> hasColumn('action', 'varchar',50);
		$this -> hasColumn('action_id', 'int',50);
		$this -> hasColumn('start_time_of_event', 'date');
		$this -> hasColumn('end_time_of_event', 'date');
	
	}

	public function setUp() 
	{
		$this -> setTableName('log');
		
	}
	
	public static function get_active_login($option,$option_id)
	{
		switch ($option) {
			case 'county':
				$q = Doctrine_Manager::getInstance()->getCurrentConnection();
				$result = $q->execute("SELECT DISTINCT  `user_id` , f.facility_name
				FROM log l, user u, facilities f, districts d, counties c
				WHERE l.user_id = u.id
				AND u.facility = f.facility_code
				AND f.district = d.id
				AND d.county = c.id
				AND c.id =$option_id");		
			break;
			
			default:
			break;
		}
		
	}
	
	public static function update_log_out_action($user_id)
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("update log set `end_time_of_event`=NOW(),action='Logged Out' where `user_id`='$user_id' and UNIX_TIMESTAMP( `end_time_of_event`) =0");	
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
		update  `log`  set  `action` =  'Logged Out' and `end_time_of_event`=NOW()
		WHERE  `action` =  'Logged In'
		AND  `start_time_of_event` < NOW( ) - INTERVAL 1  DAY 
		AND UNIX_TIMESTAMP( `end_time_of_event`) =0");	
	}
	
	public static function log_out_inactive_people()
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
		update  `log`  set  `action` =  'Logged Out' and `end_time_of_event`=NOW()
		WHERE  `action` =  'Logged In'
		AND  `start_time_of_event` < NOW( ) - INTERVAL 1  DAY 
		AND UNIX_TIMESTAMP( `end_time_of_event`) =0");		
	}
	public static function log_user_action($user_id, $user_action = NULL)
	{
		switch ($user_action):
			case 'issue':
				$action = 'issued = 1';
			break;
			case 'order':
				$action = 'ordered = 1';
			break;
			case 'decommission':
				$action = 'decommissioned = 1';
			break;	
			case 'redistribute':
				$action = 'redistribute = 1';
			break;
			case 'add_stock':
				$action = 'add_stock = 1';
			break;
			default:
			break;
			endswitch;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
			update log set $action  
			where `user_id`= $user_id 
			AND action = 'Logged In' 
			and UNIX_TIMESTAMP( `end_time_of_event`) = 0");	
		 
	}
	public static function get_log_data($facility_code = null,$district_id = null,$county_id = null, $year = null, $month = null)
	{
		
		$and_data =(isset($district_id)&& ($district_id>0)) ?"AND u.district = $district_id" : null;
		$and_data .=(isset($county_id)&& ($county_id>0)) ?" AND u.county_id = $county_id" : null;
		$and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND u.facility = $facility_code" : null;
		
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		select ifnull(sum(l.issued), 0) as total_issues,
		ifnull(sum(l.ordered), 0) as total_orders,
		ifnull(sum(l.decommissioned), 0) as total_decommisions,
		ifnull(sum(l.redistribute), 0) as total_redistributions,
		ifnull(sum(l.add_stock), 0) as total_stock_added,
		ifnull(sum(l.issued+l.ordered+l.decommissioned+l.redistribute+l.add_stock), 0) as user_log
		from log l, user u
		where l.user_id = u.id
		$and_data
		AND DATE_FORMAT( l.`start_time_of_event` ,'%Y') = '$year'
		AND DATE_FORMAT( l.`start_time_of_event` ,'%m') = '$month'
		");
		
	
		return $q;
	}
	public static function get_login_only($facility_code = null,$district_id = null,$county_id = null, $year = null, $month = null)
	{
		
		$and_data =(isset($district_id)&& ($district_id>0)) ?"AND u.district = $district_id" : null;
		$and_data .=(isset($county_id)&& ($county_id>0)) ?" AND u.county_id = $county_id" : null;
		$and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND u.facility = $facility_code" : null;
		
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		select count(l.id) as total
		from log l, user u
		where l.user_id = u.id
		and l.issued=0 
        and l.ordered=0 
        and l.decommissioned=0 
        and l.redistribute=0 
        and l.add_stock=0
		$and_data 
		AND DATE_FORMAT( l.`start_time_of_event` ,'%Y-%m') = '$year-$month'
		");
		
	
		return $q;
	}
	public static function get_user_activities_download($facility_code = null, $district_id = null,$county_id = null, $year = null, $month = null)
	{
		$and_data =(isset($district_id)&& ($district_id>0)) ?"AND u.district = $district_id" : null;
		$and_data .=(isset($county_id)&& ($county_id>0)) ?" AND u.county_id = $county_id" : null;
		$and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND u.facility = $facility_code" : null;
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		select 
		DISTINCT(l.user_id) as user,
		    start_time_of_event as time,
		    u.fname,
		    u.lname,
		    f.facility_name,
		    (CASE
		        WHEN l.issued = 1 THEN 'Yes'
		        ELSE 'No'
		    END) AS issued,
		    (CASE
		        WHEN l.ordered = 1 THEN 'Yes'
		        ELSE 'No'
		    END) AS ordered,
		    (CASE
		        WHEN l.decommissioned = 1 THEN 'Yes'
		        ELSE 'No'
		    END) AS decommissioned,
		    (CASE
		        WHEN l.redistribute = 1 THEN 'Yes'
		        ELSE 'No'
		    END) AS redistribute,
		    (CASE
		        WHEN l.add_stock = 1 THEN 'Yes'
		        ELSE 'No'
		    END) AS add_stock,
		    (CASE
		        WHEN
		            l.add_stock = 0 AND l.issued = 0
		                AND l.ordered = 0
		                AND l.decommissioned = 0
		                AND l.redistribute = 0
		        THEN
		            'Yes'
		        ELSE 'No'
		    END) as no_activity
		from
		    log l,
		    user u,
		    facilities f
		where
		    l.user_id = u.id 
		    AND u.facility = f.facility_code
		    $and_data
	        AND DATE_FORMAT(l.`start_time_of_event`, '%Y') = '$year'
	        AND DATE_FORMAT(l.`start_time_of_event`, '%m') = '$month'
		GROUP BY start_time_of_event
		");
		
		
		return $q;
	}
	public static function get_facility_log_data($facility_code)
	{
		
		$year = date("Y");
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		select ifnull(sum(l.issued), 0) as total_issues,
		ifnull(sum(l.ordered), 0) as total_orders,
		ifnull(sum(l.decommissioned), 0) as total_decommisions,
		ifnull(sum(l.redistribute), 0) as total_redistributions,
		ifnull(sum(l.add_stock), 0) as total_stock_added,
		ifnull(sum(l.issued+l.ordered+l.decommissioned+l.redistribute+l.add_stock), 0) as user_log
		from log l, user u
		where l.user_id = u.id
		AND u.facility = $facility_code
		AND DATE_FORMAT( l.`start_time_of_event` ,'%Y') = '$year'
		");
		
		return $q;
	}
	public static function get_subcounty_login_count($county_id = null,$district_id = null,$facility_code = null,$date)
	{
		 $and_data .=(isset($county_id)&& ($county_id>0)) ?"AND u.county_id = $county_id" : null;
	     $and_data .=(isset($district_id)&& ($district_id>0)) ?" AND u.district = $district_id" : null;
	     $and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND u.facility = $facility_code" : null;
	     
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT 
			ifnull(COUNT(DISTINCT u.facility ),0) AS total
			FROM log l, user u
			WHERE u.id = l.user_id
			$and_data
			AND DATE_FORMAT( l.start_time_of_event,'%Y-%m-%d') = '$date'
			");
			
		return $q;
	}
	public static function get_facility_login_count($facility_code, $date)
	{
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT 
			ifnull(COUNT(DISTINCT u.facility ),0) AS total
			FROM log l, user u
			WHERE u.id = l.user_id
			AND u.facility = $facility_code
			AND DATE_FORMAT( l.start_time_of_event,'%Y-%m-%d') = '$date'
			
			");
			
		return $q;
	}
	public static function get_county_login_count($county_id =null,$district_id =null,$date)
	{
		$and_data .=(isset($county_id)&& ($county_id>0)) ?"AND u.county_id = $county_id" : null;
     	$and_data .=(isset($district_id)&& ($district_id>0)) ?"AND u.district = $district_id" : null;
	     
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT ifnull(COUNT(DISTINCT u.facility ),0) AS total
			FROM log l, user u
			WHERE u.id = l.user_id
			$and_data
			AND DATE_FORMAT( l.start_time_of_event,'%Y-%m-%d') = '$date'
	
			");
			
			return $q;
	}

	public static function get_subcounty_login_monthly_count($county_id = null,$district_id = null,$facility_code = null, $date)
	{
		$and_data .=(isset($county_id)&& ($county_id>0)) ?"AND u.county_id = $county_id" : null;
     	$and_data .=(isset($district_id)&& ($district_id>0)) ?" AND u.district = $district_id" : null;
     	$and_data .=(isset($facility_code)&& ($facility_code>0)) ?" AND u.facility = $facility_code" : null;
	    
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT  IFNULL( COUNT(DISTINCT u.facility) , 0 ) AS total
		FROM log l, user u
		WHERE u.id = l.user_id
		$and_data
		AND DATE_FORMAT( l.`start_time_of_event` ,'%Y-%m') = '$date'");
		return $q;
	
	
	}
	public static function get_facility_login_monthly_count($facility_code,$date)
	{
		
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		SELECT  IFNULL( COUNT(DISTINCT u.facility) , 0 ) AS total
		FROM log l, user u
		WHERE u.id = l.user_id
		AND u.facility =$facility_code
		AND DATE_FORMAT( l.`start_time_of_event` ,'%Y-%m') = '$date'");
		return $q;
	
	
	}
	
	public static function get_county_login_monthly_count($county_id = null,$district_id = null,$date)
	{
		$and_data .=(isset($county_id)&& ($county_id>0)) ?"AND u.county_id = $county_id" : null;
     	$and_data .=(isset($district_id)&& ($district_id>0)) ?"AND u.district = $district_id" : null;
	    
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT  IFNULL( COUNT(DISTINCT u.facility) , 0 ) AS total
			FROM log l, user u
			WHERE u.id = l.user_id
			$and_data
			AND DATE_FORMAT( l.`start_time_of_event` ,'%Y-%m') = '$date'");
		return $q;
	
	
	}



}