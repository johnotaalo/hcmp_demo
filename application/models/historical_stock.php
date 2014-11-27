<?php
class Historical_Stock extends Doctrine_Record {

	public function setTableDefinition() {
		
				$this->hasColumn('id', 'int', 11);
				$this->hasColumn('facility_code', 'varchar',20);
				$this->hasColumn('drug_id', 'int', 11);
				$this->hasColumn('description', 'varchar',100);
				$this->hasColumn('unit_size', 'varchar',50);
				$this->hasColumn('consumption_level', 'varchar',50);
				$this->hasColumn('unit_count', 'varchar',40);
				$this->hasColumn('selected_option', 'varchar',20);
				
		
	}
	
	public function setUp() {
		$this->setTableName('historical_stock');	
	}	
	public function get_historical_stock($facility_code){
		
		$query = Doctrine_Query::create() -> select("*") -> from("historical_stock") -> where("facility_code=$facility_code");
		$stock = $query -> execute();
		return $stock;
	}
	public static function count_historical_stock($facility_code){
		$query = Doctrine_Query::create() -> select("drug_id, SUM(consumption_level) AS quantity1, (count(consumption_level)/163)*100 as percentage") -> from("historical_stock") -> where("facility_code=$facility_code")->groupby( "drug_id");
		$stocktake = $query ->execute();
		
		return $stocktake;
	}
	public static function historical_stock_rate($facility_code){
	
		
				$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT drug_id, 
SUM(consumption_level) AS quantity1, (count(consumption_level)/(select count(id) from drug))*100 as percentage,((select count(id) from drug)-count(consumption_level)) as balance
FROM historical_stock
WHERE facility_code=$facility_code");
		
		return $query;
	}
	public static function load_historical_stock($facility_code){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT d.unit_size, d.id, h.`drug_id` , d.kemsa_code, d_c.category_name, d.drug_name, h.`consumption_level` , h.`unit_count` , h.`selected_option` 
FROM drug_category d_c, drug d
LEFT JOIN  `historical_stock` h ON d.id = h.drug_id
AND h.facility_code =$facility_code
WHERE d.drug_category = d_c.id");
		
		
		return $query;
	}
	
	public static function get_facility_type($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		select count(f.facility_code) as total, f.owner 
		from facilities f, facility_evaluation f_e, districts d 
		where f.facility_code=f_e.facility_code and f.district=d.id 
		and d.county=$county_id group by f.owner");
		
		
		return $query;
		
	}
	public static function get_personel_trained($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select sum(f_e.fhead_no) as fhead, sum(f_e.fdep_no) as fdep, sum(f_e.nurse_no) as nurse, sum(f_e.sman_no) as sman, sum(f_e.ptech_no) as ptech
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id");
		
		
		return $query;
		
	}
	public static function get_training_satisfaction($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select count(f_e.satisfaction_lvl) as level, f_e.satisfaction_lvl
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id group by f_e.satisfaction_lvl
");	
		return $query;
		
	}
	public static function get_training_resource($county_id){
		$query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select  count(f_e.comp_avail) as comp
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comp_avail=1
and f.district=d.id and d.county=$county_id
 ");	
 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.modem_avail) as modem
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.modem_avail=1
and f.district=d.id and d.county=$county_id
 ");	
 $query_3 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.bundles_avail) as bundles
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.bundles_avail=1
and f.district=d.id and d.county=$county_id
 ");	
 $query_4 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.manuals_avail) as manual
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.manuals_avail=1
and f.district=d.id and d.county=$county_id
 ");	
  $query_5 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select COUNT( f_e.id ) AS total
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id
 ");	
		return array(0=>array('total'=>$query_5[0]['total'],'comp'=>$query_1[0]['comp'],'modem'=>$query_2[0]['modem'],'bundles'=>$query_3[0]['bundles'],'manual'=>$query_4[0]['manual']));
		
	}
	
	public static function get_sheduled_training($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`agreed_time`) as actual, agreed_time from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `agreed_time`
");	
		return $query;
		
	}
	
	public static function get_feedback_training($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`feedback`) as actual, feedback from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `feedback`
");	
		return $query;
		
	}
	public static function get_pharm_supervision($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`pharm_supervision`) as actual, pharm_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `pharm_supervision`
");	
		return $query;
		
	}
		public static function get_coord_supervision($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `coord_supervision`
");	
		return $query;
		
	}
	public static function get_req_id($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`req_id`) as actual, req_id from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `req_id`
");	
		return $query;
		
	}
		public static function get_req_addr($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`req_addr`) as actual, req_addr from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `req_addr`
");	
		return $query;
		
	}

			public static function get_train_useful($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`train_useful`) as actual, train_useful from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `train_useful`
");	
		return $query;
		
	}
				public static function get_use_freq($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`use_freq`) as level, use_freq from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `use_freq`
");	
		return $query;
		
	}
					public static function get_improvement($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`improvement`) as actual, improvement from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `improvement`
");	
		return $query;
		
	}
						public static function get_ease_of_use($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`ease_of_use`) as actual, ease_of_use from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `ease_of_use`
");	
		return $query;
		
	}
	public static function get_meet_expect($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`meet_expect`) as actual, meet_expect from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `meet_expect`
");	
		return $query;
		
	}
		public static function get_retrain($county_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id ) as total, count(`retrain`) as actual, retrain from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id  group by `retrain`
");	
		return $query;
		
	}
		public static function level_of_comfort($county_id){
			$query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select  count(f_e.comf_issue) as comp
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_issue=1
and f.district=d.id and d.county=$county_id
 ");	
 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comf_order) as modem
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_order=1
and f.district=d.id and d.county=$county_id
 ");	
 $query_3 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comf_update) as bundles
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_update=1
and f.district=d.id and d.county=$county_id
 ");	
 $query_4 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comf_gen) as manual
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_gen=1
and f.district=d.id and d.county=$county_id
 ");	
  $query_5 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select COUNT( f_e.id ) AS total
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.county=$county_id
 ");	
		return array(0=>array('total'=>$query_5[0]['total'],'comp'=>$query_1[0]['comp'],'modem'=>$query_2[0]['modem'],'bundles'=>$query_3[0]['bundles'],'manual'=>$query_4[0]['manual']));
	
		
	}


   public static function get_county_coverage_data($county_id){
   	 $query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( f.id ) AS total
FROM facilities f, districts d
WHERE f.district = d.id
AND d.county ='$county_id'
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");
 
   	 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( h_s.id ) AS total
FROM facilities f, districts d, facility_evaluation h_s
WHERE f.district = d.id
AND d.county ='$county_id'
AND h_s.facility_code=f.facility_code

 ");
 
 
   return array("total_facilities"=>$query_1[0]['total'],'total_evaluation'=>$query_2[0]['total']);
   }
	}