<?php
class Lab_Commodities extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('commodity_name','varchar', 50);
		$this -> hasColumn('category','int');
		$this -> hasColumn('unit_of_issue','int');
 }
 public function setUp() {
		$this -> setTableName('lab_commodities');
		$this -> hasOne('lab_commodity_categories as commodity_category', array('local' => 'id', 'foreign' => 'category'));
	}
public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("lab_commodities") -> orderBy("id");
		$commodities = $query -> execute();
		return $commodities;
}
}