<?php
/**
 * @author Collins
 */
class commodity_division_details extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('division_name ', 'varchar', 255);
		$this -> hasColumn('status', 'int');
		
	}

	public function setUp() {
		$this -> setTableName('commodity_division_details');
		//$this -> hasMany('commodities as commodities_for_this_category', array('local' => 'id', 'commodity_sub_category_id' => 'id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_division_details");
		$commodities = $query -> execute();
		return $commodities;
	}
	public static function get_all_divisions($division_id) 
	{
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_division_details")->where("status=1 and id !=1 and id=$division_id");
		$commodities = $query -> execute();
		return $commodities;
	}
	

}
?>