<?php
class Rtk_Stock_Status extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('facility_code', 'int',11);
		$this -> hasColumn('commodity', 'int',11);
		$this -> hasColumn('beginning_balance', 'int',11);
		$this -> hasColumn('qty_received', 'int',11);
		$this -> hasColumn('issued', 'int',11);
		$this -> hasColumn('qty_withdrawn', 'int',11);
		$this -> hasColumn('losses', 'int',11);
		$this -> hasColumn('adjustments', 'int',11);
		$this -> hasColumn('physical_count', 'int',11);
		$this -> hasColumn('calc_endbal', 'int',11);
		$this -> hasColumn('qty_requested', 'int',11);
		$this -> hasColumn('distributed', 'int',11);
		$this -> hasColumn('allocated', 'int',11);	
	}

	public function setUp() {
		$this -> setTableName('rtk_stock_status');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
		$this -> hasMany('facilities as Coder', array('local' => 'facility_code', 'foreign' => 'facility_code'));
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("rtk_stock_status")-> OrderBy("county asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	
	
	public static function get_rtk_alloaction_distribution($commodity){
$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT SUM(  `qty_requested` )  as qty_requested  , SUM(  `distributed` ) as distributed  , SUM(  `allocated` ) as allocated  , c.county
FROM rtk_stock_status r, facilities f, counties c, districts d
WHERE r.`facility_code` = f.`facility_code` 
AND f.`district` = d.`id` 
AND d.`county` = c.`id` 
AND r.`commodity` =  '$commodity'
AND r.allocated >0
GROUP BY c.id
ORDER BY c.id ASC ");
return $q;

	}

public static function get_reporting_county($county_id){
	$q[0]['total_facilities']=0;
	
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT total_facilities  from  rtk_facility_county_count where county_id='$county_id'");
if(!isset($q[0]['total_facilities'])){
	$q[0]['total_facilities']=0;
}
	$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT total_facilities from rtk_reporting_facilities where county_id='$county_id'");
if(!isset($q_1[0]['total_facilities'])){
	$q_1[0]['total_facilities']=0;
}

$q_2=array(array('total_facilities'=>$q[0]['total_facilities'],'reported'=>$q_1[0]['total_facilities']));
return $q_2;
	
}

public static function get_reporting_rate_national(){
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( DISTINCT r.facility_code ) AS reported, (
SELECT COUNT( facility_code ) 
FROM facilities
) AS total_facilities
FROM facilities f, rtk_stock_status r
WHERE r.facility_code = f.facility_code");
return $q;
	
}

public static function get_county_reporting_details($county_id){
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT r.facility_code, f.facility_name,r.qty_received, r.qty_requested, r.issued, r.physical_count, r.allocated, r.distributed, r.commodity, f.owner,ifnull( a.qty,0) as qty
FROM facilities f, counties c, districts d, rtk_stock_status r
LEFT JOIN rtk_allocation a ON a.facility_code = r.facility_code
AND YEAR( a.date_allocated ) = YEAR( 
CURRENT_TIMESTAMP ) AND a.commodity_id=r.commodity 
WHERE r.facility_code = f.facility_code
AND f.rtk_enabled =1
AND f.district = d.id
AND d.county = c.id
AND c.id =  '$county_id'
");
return $q;
	
}	

public static function get_facility_reporting_details($facility_code){
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT r.facility_code, f.facility_name, r.qty_requested, r.allocated, r.distributed, r.commodity,f.owner
FROM facilities f, rtk_stock_status r
WHERE r.facility_code = f.facility_code
AND f.facility_code ='$facility_code'");
return $q;
	}
	////////////////////////////////////////////////////////
	public static function get_rtk_commodities() {
		/*$query = Doctrine_Query::create() -> select("*") -> from("rtk_commodities")-> OrderBy("id asc");
		$commodities = $query -> execute();
		return $commodities;
WHERE id =1
		*/
		$commodities = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT id, commodity_code, commodity_name, unit_of_issue FROM `rtk_commodities` order by id");
		//$comm = array($commodities);
return $commodities;
	}
////////////////////////////////////////////////////////

public function get_allocation_rate_county($county_id){
	$allocation_rate=0;
	$total_facilities_allocated_in_county=0;
	$total_facilities_in_county=0;	
	
$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT count(distinct r.facility_code) as total_facilities_allocated_in_county
FROM facilities f, counties c, districts d, rtk_allocation r
WHERE r.facility_code = f.facility_code
AND f.rtk_enabled =1
AND f.district = d.id
AND d.county = c.id
AND year( r.date_allocated)=year(CURRENT_TIMESTAMP)
AND c.id =  '$county_id'
");


$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT count(f.facility_code) as total_facilities_in_county
FROM facilities f, counties c, districts d,rtk_stock_status r
WHERE f.facility_code = f.facility_code
AND r.facility_code = f.facility_code
AND f.rtk_enabled =1
AND f.district = d.id
AND d.county = c.id
AND c.id =  '$county_id'
");


$total_facilities_allocated_in_county=$q[0]['total_facilities_allocated_in_county'];
$total_facilities_in_county=$q_1[0]['total_facilities_in_county'];
@$allocation_rate=($total_facilities_allocated_in_county/$total_facilities_in_county)*100;



return array('allocation_rate'=>ceil($allocation_rate),'total_facilities_in_county'=>$total_facilities_in_county,'total_facilities_allocated_in_county'=>$total_facilities_allocated_in_county);
	
}

public function get_allocation_rate_national(){
	$allocation_rate=0;
	$total_facilities_allocated_in_country=0;
	$total_facilities_in_country=0;	
	
$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT count(distinct r.facility_code) as total_facilities_allocated_in_country
FROM facilities f, counties c, districts d, rtk_allocation r
WHERE r.facility_code = f.facility_code
AND f.rtk_enabled =1
AND year(r.date_allocated)=year(CURRENT_TIMESTAMP)
");


$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT count(distinct facility_code) as total_facilities_in_country
FROM rtk_stock_status

");

$total_facilities_allocated_in_country=$q[0]['total_facilities_allocated_in_country'];
$total_facilities_in_country=$q_1[0]['total_facilities_in_country'];

$allocation_rate=($total_facilities_allocated_in_country/$total_facilities_in_country)*100;


return ceil($allocation_rate);
	
	
}	



}

	






