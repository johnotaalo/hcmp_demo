<?php
/**
 * @author Collins
 */
class meds_sub_category extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('category_id', 'int');
		$this -> hasColumn('sub_category_name', 'varchar', 100);
		$this -> hasColumn('status', 'int');
		
	}

	public function setUp() {
		$this -> setTableName('meds_sub_category');
		//$this -> hasMany('commodity_source as supplier_name', array('local' => 'commodity_source_id', 'foreign' => 'id'));
		//$this -> hasMany('commodity_sub_category as sub_category_data', array('local' => 'commodity_sub_category_id', 'foreign' => 'id'));
		//$this -> hasOne('Facility_stocks as facility', array('local' => 'id', 'foreign' => 'commodity_id'));
	}
	
	//gets all the sub categories in a particular category
	public static function get_all_in_category($category_id)
	{
		$query = Doctrine_Query::create() -> select("*") -> from("meds_sub_category")->where("category_id = '$category_id'")->OrderBy("sub_category_name asc");
		$sub_categories = $query -> execute();
		return $sub_categories;
	}
	
}