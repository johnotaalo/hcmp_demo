<?php
class Update_stock_first_temp extends Doctrine_Record {

	public function setTableDefinition() {
		
				$this->hasColumn('id', 'int', 11);
				$this->hasColumn('drug_id', 'int', 11);
				$this->hasColumn('category', 'varchar',50);
				$this->hasColumn('kemsa_code', 'varchar',50);
				$this->hasColumn('description', 'varchar',100);
				$this->hasColumn('unit_size', 'varchar',50);
				$this->hasColumn('batch_no', 'varchar',50);
				$this->hasColumn('manu', 'varchar',50);
				$this->hasColumn('expiry_date', 'varchar',50);
				$this->hasColumn('stock_level', 'varchar',50);
				$this->hasColumn('unit_count', 'varchar',50);
				$this->hasColumn('facility_code', 'varchar',50);
				$this->hasColumn('unit_issue', 'varchar',50);
				
		
	}
	
	public function setUp() {
		$this->setTableName('update_stock_first_temp');
		//$this -> hasMany('User as user_types', array('local' => 'id', 'foreign' => 'usertype_id'));
		
		
	}

	public static function update_temp($data_array)
	{
		$o = new update_stock_first_temp();
	    $o->fromArray($data_array);
		$o->save();		
		return TRUE;
	}
	
	public static function get_facility_temp($facility_code){
		$query = Doctrine_Query::create() -> select("*") -> from("update_stock_first_temp") -> where("facility_code=$facility_code");
		$stocks= $query -> execute();
		return $stocks;
	}
	public static function get_temp_stock($facility_code){
		$query = Doctrine_Query::create() -> select("*") -> from("update_stock_first_temp") -> where("facility_code=$facility_code");
		$stocks= $query -> execute();
		return $stocks->toArray();
	}
	
	public static function get_facility_name($facility_code){
		$query = Doctrine_Query::create() -> select("facility_name ,district") -> from("facilities") -> where("facility_code=$facility_code");
		$facility_name= $query -> execute();
		return $facility_name;
	}
	public static function delete_facility_temp($drugid =null, $facilitycode,$batch_no=null){
		if($drugid !=''){
			$condition="AND drug_id=$drugid and `batch_no`='$batch_no'";
		}
		else{
			$condition="";
		}
		$query = Doctrine_Query::create() -> delete()-> from("update_stock_first_temp") -> where("facility_code=$facilitycode $condition");
		$stocks= $query -> execute();
		return $stocks;
		
	}
	public static function check_if_facility_has_drug_in_temp($drugid, $facilitycode,$batch_no){
		$query = Doctrine_Query::create() -> select("*")-> from("update_stock_first_temp") 
		-> where("facility_code=$facilitycode and drug_id=$drugid and `batch_no`='$batch_no'");
		$stocks= $query -> execute();
		return count($stocks);
		
	}
	public static function update_facility_temp_data($expiry_date,$batch_no,$manuf,$stock_level,$unit_count,$drug_id,$facility_code,$unit_issue){
	$q = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
update update_stock_first_temp set `expiry_date`='$expiry_date',`batch_no`='$batch_no',`manu`='$manuf',`stock_level`='$stock_level',`unit_count`='$unit_count'
,`unit_issue`='$unit_issue'
where `facility_code`='$facility_code' and `drug_id`='$drug_id'
");		
	}
}
