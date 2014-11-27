<?php
class Malaria_Drugs extends Doctrine_Record 
{
	public function setTableDefinition() 
	{
		$this -> hasColumn('kemsa_code', 'varchar',30);
		$this -> hasColumn('drug_name', 'text');
		$this -> hasColumn('unit_size', 'varchar',100);
		$this -> hasColumn('unit_cost', 'varchar',20);
		$this -> hasColumn('drug_category', 'varchar',10); 
		$this -> hasColumn('id', 'int',11);
	}

	public function setUp() 
	{
		$this -> setTableName('malaria_drugs');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
		//$this -> hasOne('kemsa_id as Code', array('local' => 'kemsa_code', 'foreign' => 'kemsa_code'));
				
	}
	
	public static function getAll() 
	{
		$query = Doctrine_Query::create() -> select("*") -> from("malaria_drugs")-> OrderBy("drug_name asc");
		$malaria = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $malaria;
	}
	
	public static function getName() 
	{
		$query = Doctrine_Query::create() -> select("drug_name, kemsa_code") -> from("malaria_drugs") -> orderBy("drug_name asc");
		$malaria = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		return $malaria;
	}
	public static function get_commodity_name($commodity_id)
	{
	$query = Doctrine_Query::create()->select("*")->from("malaria_drugs")->where("kemsa_code = $commodity_id");
	$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
	return $result[0];
	}
	
}