<?php
	class High_stock extends Doctrine_Record{
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

		public static function get_sheduled_training($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id) as total, count(`agreed_time`) as actual, agreed_time from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$distict_id group by `agreed_time`
");	
		return $query;	
	}

		public static function get_feedback_training($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id) as total, count(`feedback`) as actual, feedback from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id group by `feedback`
");	
		return $query;
	}

		public static function get_pharm_supervision($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`pharm_supervision`) as actual, pharm_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `pharm_supervision`
");	
		return $query;
		
	}
		public static function get_coord_supervision($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}

		public static function get_req_id($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_req_addr($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_retrain($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_improvement($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_ease_of_use($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_meet_expect($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_train_useful($district_id){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select (select count(*) from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id ) as total, count(`coord_supervision`) as actual, coord_supervision from facilities f, facility_evaluation f_e, districts d 
where f.facility_code=f_e.facility_code 
and f.district=d.id and d.id=$district_id  group by `coord_supervision`
");	
		return $query;
	}


	public static function get_district_coverage_data($district_id){
   	 $query_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( f.id ) AS total
FROM facilities f, districts d
WHERE f.district = d.id
AND d.id ='$district_id'
AND UNIX_TIMESTAMP( f.`date_of_activation` ) >0
 ");
 
   	 $query_2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT COUNT( h_s.id ) AS total
FROM facilities f, districts d, facility_evaluation h_s
WHERE f.district = d.id
AND d.id ='$district_id'
AND h_s.facility_code=f.facility_code

 ");
 
 
   return array("total_facilities"=>$query_1[0]['total'],'total_evaluation'=>$query_2[0]['total']);
   }
	}


	
?>