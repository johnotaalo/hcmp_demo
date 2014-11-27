<?php
class Hcmp_Stock_Status extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('ID', 'int',11);
		$this -> hasColumn('mflcode', 'int',11);
		$this -> hasColumn('test_type', 'int',11);
		$this -> hasColumn('beginningbal', 'int',11);
		$this -> hasColumn('recieved', 'int',11);
		$this -> hasColumn('dispenced', 'int',11);
		$this -> hasColumn('losses', 'int',11);
		$this -> hasColumn('adjustments', 'int',11);
		$this -> hasColumn('endbal', 'int',11);
		$this -> hasColumn('unittests', 'int',11);
		$this -> hasColumn('moc', 'int',11);
		$this -> hasColumn('district', 'int',11);
		$this -> hasColumn('county', 'int',11);	
	}

	public function setUp() {
		$this -> setTableName('hcmp_stock_status');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
		$this -> hasMany('facilities as Coder', array('local' => 'facility_code', 'foreign' => 'facility_code'));
	}
	
	
	public static function get_county_reporting_rate ($county_id){
		
		
		$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
select count(f.id) as total_facilities from facilities f, districts d where f.district=d.id and d.county='$county_id'");



		if(!isset($q[0]['total_facilities'])){
	$q[0]['total_facilities']=0;
}
		
		$q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT count(ID) as total_facilities from hcmp_stock_status  where county='$county_id'");

if(!isset($q_1[0]['reported'])){
	$q_1[0]['reported']=0;
}




$q_2=array(array('total_facilities'=>$q[0]['total_facilities'],'reported'=>$q_1[0]['total_facilities']));
return $q_2;

		
	}
	
		public static function get_facility_reporting_details($facility_code){
		
$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT facility_name, unittests, moc,test_name
FROM hcmp_stock_status hs, hcmp_test ht, facilities
WHERE hs.test_type = ht.testId
AND facilities.facility_code = hs.mflcode
AND hs.mflcode ='$facility_code'");

return $q;
		
	}
	
	
	
}
	?>