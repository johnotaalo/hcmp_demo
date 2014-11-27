<?php
class Facility_Order_View extends Doctrine_Record {
		
	public function setTableDefinition()
	{
		$this -> hasColumn('Kemsa_Code', 'varchar',20);
		$this -> hasColumn('Drug_Name', 'text');
		$this -> hasColumn('Unit_Size', 'varchar',100);
		$this -> hasColumn('Unit_Cost', 'varchar',20);
		$this -> hasColumn('Drug_Category', 'varchar',10); 
		$this -> hasColumn('Facility_Code', 'int',5); 
		$this -> hasColumn('Closing_Stock', 'decimal'); 
		$this -> hasColumn('Total_Issues', 'decimal'); 
			
	}

	public function setUp() {
		$this -> setTableName('Facility_Order_View');		
		$this -> hasMany('Drug_Category as Category1', array('local' => 'Drug_Category', 'foreign' => 'id'));
		
	}
	public static function create_facility_order($delivery){
		$query = Doctrine_Query::create() -> select("*") -> from("Facility_Order_View")->where("Facility_Code=$delivery");
		$drugs = $query -> execute();
		return $drugs;
	}
}
?>