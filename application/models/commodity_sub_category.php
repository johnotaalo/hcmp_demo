<?php
/**
 * @author Kariuki
 */
class commodity_sub_category extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('commodity_category_id', 'varchar', 20);
		$this -> hasColumn('sub_category_name', 'text');
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('commodity_sub_category');
		$this -> hasMany('commodities as commodities_for_this_category', array('local' => 'id', 'commodity_sub_category_id' => 'id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_sub_category")->where("status=1");
		$commodities = $query -> execute();
		return $commodities;
	}
	public static function get_all_pharm() 
	{
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_sub_category")->where("status=1 and commodity_category_id !=2");
		$commodities = $query -> execute();
		return $commodities;
	}
	
	

}
?>