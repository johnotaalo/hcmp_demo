<?php

class Sub_menu extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('subm_text', 'varchar', 100);
		$this -> hasColumn('subm_url', 'varchar', 100);
		$this -> hasColumn('parent_id', 'integer', 10);
	}

	public function setUp() {
		$this -> setTableName('sub_menu');
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Sub_menu");
		$menus = $query -> execute();
		return $menus;
	}
	public static function getByparent($parentid) {
		$query = Doctrine_Query::create() -> select("*") -> from("Sub_menu") -> where("parent_id=$parentid");
		$menus = $query -> execute();
		return $menus;
	}
	
}
?>
