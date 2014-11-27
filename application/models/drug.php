<?php
class Drug extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('Kemsa_Code', 'varchar',20);
		$this -> hasColumn('Drug_Name', 'text');
		$this -> hasColumn('Unit_Size', 'varchar',100);
		$this -> hasColumn('Unit_Cost', 'varchar',20);
		$this -> hasColumn('Drug_Category', 'varchar',10); 
		$this -> hasColumn('total_units', 'int',11);
		$this -> hasColumn('source', 'int',11);
	}

	public function setUp() {
		$this -> setTableName('drug');
		$this -> hasMany('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));		
		$this -> hasOne('id as Code', array('local' => 'id', 'foreign' => 'kemsa_code'));
		$this -> hasMany('commodity_source as CommoditySourceName', array('local' => 'source','foreign' => 'id'));		
		$this -> hasOne('Facility_Stock as facility', array('local' => 'id', 'foreign' => 'kemsa_code'));
		
		
	}
	public static function getAll_2() {
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select * from drug order by drug_name asc");	
		return $query;
	}
	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Drug")-> OrderBy("Drug_Name asc");
		$drugs = $query -> execute();
		return $drugs;
	}
	public static function getChartData(){
	$query = Doctrine_Query::create() -> select("*") -> from("Drug d, Drug");
		$drugs = $query -> execute();
		return $drugs;	
	}
	public static function get_drug_name(){
		$query = Doctrine_Query::create() -> select("Unit_Cost,Kemsa_Code,Drug_Name") -> from("Drug")->OrderBy('Drug_Name asc');
		$drugs = $query -> execute();
		return $drugs;
	}
	public static function get_drug_name_by_category($drug_category){
		$query = Doctrine_Query::create() -> select("Kemsa_Code,Drug_Name") -> from("Drug")->where("Drug_Category='$drug_category'")->OrderBy('Drug_Name asc');
		$drugs = $query -> execute();
		return $drugs;
	}
	
	
}
