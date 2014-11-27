<?php
class Commodity_source extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int');
		$this -> hasColumn('source_name', 'varchar', 20);
		$this -> hasColumn('status', 'int');
	}

	public function setUp() {
		$this -> setTableName('commodity_source');
		$this -> hasMany('Commodities as supplier_name', array('local' => 'id', 'foreign' => 'commodity_source_id'));
	}

	public static function get_all() {
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_source");
		$commodity_source = $query -> execute();
		return $commodity_source;
	}
	public static function get_all_id($id) {
		$query = Doctrine_Query::create() -> select("*") -> from("commodity_source")->where("id=$id");
		$commodity_source = $query -> execute();
		return $commodity_source;
	}

}
?>