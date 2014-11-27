<?php

class Menu extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('menu_describe', 'varchar', 100);
		$this -> hasColumn('menu_text', 'varchar', 20);
		$this -> hasColumn('menu_url', 'varchar', 100);
		$this -> hasColumn('user_group', 'varchar', 100);
		$this -> hasColumn('parent_status', 'integer', 10);
	}

	public function setUp() {
		$this -> setTableName('menu');
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Menu");
		$menus = $query -> execute();
		return $menus;
	}
	public static function getByUsertype($user_typeid) {
		$and =((int)$user_typeid==2)? "(user_group=$user_typeid or user_group=5)" : "user_group=$user_typeid";
		$query = Doctrine_Query::create() -> select("*") -> from("Menu") -> where(" $and ");
		$menus = $query -> execute();
		return $menus;
	}
	
}
?>
