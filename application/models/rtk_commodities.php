<?php
class Rtk_Commodities extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id','int');
		$this -> hasColumn('commodity_code','varchar', 40);
		$this -> hasColumn('commodity_name','varchar', 40);
		$this -> hasColumn('unit_of_issue','varchar', 40);
		$this -> hasColumn('category','varchar', 40);
 }
 public function setUp() {
		$this -> setTableName('rtk_commodities');
		$this -> hasOne('rtk_categories as commodity_category', array('local' => 'category', 'foreign' => 'id'));
	}
public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("rtk_commodities") -> orderBy("id");
		$commodities = $query -> execute();
		return $commodities;
}
}