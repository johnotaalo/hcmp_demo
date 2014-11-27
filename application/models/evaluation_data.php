<?php
	class Evaluation_data extends Doctrine_Record{
		
		public static function get_facility_type($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;

		$query1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
		select count(f.facility_code) as total, f.owner 
		from facilities f, facility_evaluation f_e, districts d 
		where f.facility_code=f_e.facility_code and f.district=d.id 
		$where
		 group by f.owner");
		
		
		return $query1;
		
	}


		public static function get_personel_trained($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		// echo "Query conditional: ".$where ;exit;
		$query2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select sum(f_e.fhead_no) as fhead, sum(f_e.fdep_no) as fdep, sum(f_e.nurse_no) as nurse, sum(f_e.sman_no) as sman, sum(f_e.ptech_no) as ptech
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
$where
");
		
		
		return $query2;
		
	}

		public static function get_training_satisfaction($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;

		$query3 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select count(f_e.satisfaction_lvl) as level, f_e.satisfaction_lvl
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where group by f_e.satisfaction_lvl
$where
");	
		return $query3;
		
	}
		public static function get_training_resource($county_id=null,$district_id=null){

		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
	
		$query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comp_avail) as comp
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comp_avail=1
and f.district=d.id 
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.modem_avail) as modem
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.modem_avail=1
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
 $query_3 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.bundles_avail) as bundles
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.bundles_avail=1
and f.district=d.id 
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
 $query_4 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.manuals_avail) as manual
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.manuals_avail=1
and f.district=d.id $where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
  $query_5 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select COUNT( f_e.id ) AS total
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
		return array(0=>array('total'=>$query_5[0]['total'],'comp'=>$query_1[0]['comp'],'modem'=>$query_2[0]['modem'],'bundles'=>$query_3[0]['bundles'],'manual'=>$query_4[0]['manual']));
		
	}


		public static function get_sheduled_training($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query4 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, districts d ,facility_evaluation f_e
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`agreed_time`) as actual, agreed_time from facilities f, districts d ,facility_evaluation f_e 
where f.facility_code=f_e.facility_code 
and f.district=d.id
$where
group by `agreed_time`
");	
		return $query4;	
	}

		public static function get_feedback_training($county_id=null,$district_id=null){
		
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		$query5 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`feedback`) as actual, feedback from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
group by `feedback`
");	
		return $query5;
	}

		public static function get_pharm_supervision($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query6 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`pharm_supervision`) as actual, pharm_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
group by `pharm_supervision`
");	
		return $query6;
		
	}
		public static function get_coord_supervision($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query7 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
group by `coord_supervision`
");	
		return $query7;
	}

		public static function get_req_id($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query8 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`req_id`) as actual, req_id from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
group by `req_id`
");	
		return $query8;
	}


	public static function get_req_addr($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query9 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`req_addr`) as actual, req_addr from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
group by `req_addr`
");	
		return $query9;
	}


	public static function get_train_useful($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query10 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`train_useful`) as actual, train_useful from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
group by `train_useful`
");	
		return $query11;
		
	}
				public static function get_use_freq($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		$query12 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code
and f.district=d.id $where) as total, count(`use_freq`) as level, use_freq from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
group by `use_freq`
");	
		return $query12;
		
	}

	public static function get_improvement($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query13 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`improvement`) as actual, improvement from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
$where
group by `improvement`
");	
		return $query13;
		
	}
						public static function get_ease_of_use($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;					
		
		$query14 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`ease_of_use`) as actual, ease_of_use from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
group by `ease_of_use`
");	
		return $query14;
		
	}


	public static function get_meet_expect($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query15 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`meet_expect`) as actual, meet_expect from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
$where
group by `meet_expect`
");	
		return $query15;
		
	}
		public static function get_retrain($county_id=null,$district_id=null){
		$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
		
		$query16 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where) as total, count(`retrain`) as actual, retrain from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id $where
group by `retrain`
");	
		return $query16;
		
	}
	public static function level_of_comfort($county_id=null,$district_id=null){
			$where=(isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id " ;
			
			$query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select  count(f_e.comf_issue) as comp
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_issue=1
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comf_order) as modem
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_order=1
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
 $query_3 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comf_update) as bundles
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_update=1
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
 $query_4 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f_e.comf_gen) as manual
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f_e.comf_gen=1
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
  $query_5 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select COUNT( f_e.id ) AS total
from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id
$where
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");	
		return array(0=>array('total'=>$query_5[0]['total'],'comp'=>$query_1[0]['comp'],'modem'=>$query_2[0]['modem'],'bundles'=>$query_3[0]['bundles'],'manual'=>$query_4[0]['manual']));
	
		
	}

	public static function get_district_coverage_data($county_id = null, $district_id = null){
	 $where = (isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id ";
   	 
   	 $query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( f.id ) AS total
FROM facilities f, districts d
WHERE f.district = d.id
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
$where
 ");
 
   	 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( h_s.id ) AS total
FROM facilities f, districts d, facility_evaluation h_s
WHERE f.district = d.id
AND h_s.facility_code=f.facility_code
$where
 ");
   return array("total_facilities"=>$query_1[0]['total'],'total_evaluation'=>$query_2[0]['total']);
   }

   	public static function show_req_id($county_id = null, $district_id = null){
		$where = (isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id ";
		
		$query17 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
SELECT facility_name, req_spec
FROM facilities f, districts d, facility_evaluation h_s
WHERE h_s.facility_code = f.facility_code
AND req_id =1
$where
 "); 
return $query17;

	}
	public static function show_meet_expect($county_id = null, $district_id = null){
		$where = (isset($county_id) && !isset($district_id)) ? " and d.county=$county_id " : " and d.id=$district_id ";
		
		$query17 = Doctrine_Manager::getInstance() -> getCurrentConnection() -> fetchAll("
		SELECT facility_name, expect_suggest
		FROM facilities f, districts d, facility_evaluation h_s
		WHERE h_s.facility_code = f.facility_code
		AND meet_expect =1
		$where
		 "); 
return $query17;

	}
}


	
?>