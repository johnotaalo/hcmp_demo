<?php
class Rtk_Categories extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('category_name','varchar', 40);
 }
 	public function setUp() {
		$this -> setTableName('rtk_categories');
		$this -> hasMany('rtk_commodities as rtk_commodities', array('local' => 'id', 'foreign' => 'category'));
	}
	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("rtk_categories") -> orderBy("id");
		$categories = $query -> execute();
		return $categories;
}
public static function get_all_commodities() {
		$query = Doctrine_Query::create() -> select("*") -> from("rtk_commodities") -> orderBy("id");
		$commodities = $query -> execute();
		return $commodities;
}
}
?>