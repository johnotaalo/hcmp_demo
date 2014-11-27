<?php
class Access_level extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int',15);
		$this -> hasColumn('level', 'varchar',255);	
		$this -> hasColumn('user_indicator', 'varchar',255);	
		$this -> hasColumn('moh_permissions', 'int',255);
		$this -> hasColumn('district_permissions', 'int',255);
		$this -> hasColumn('county_permissions', 'int',255);
		$this -> hasColumn('facilityadmin_permissions', 'int',255);
		$this -> hasColumn('facility_permissions', 'int',255);
		$this -> hasColumn('super_permissions', 'int',255);
	}

	public function setUp() {
		$this -> setTableName('access_level');
	//	$this -> hasMany('user as u_type1', array('local' => 'id', 'foreign' => 'usertype_id'));
		
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("access_level");
		$level = $query -> execute();
		return $level;
	}
	
	public static function get_access_level_name($access_typeid) {
		$query = Doctrine_Query::create() -> select("*") -> from("access_level")-> where("id=$access_typeid");
		$level = $query -> execute();
		$level=$level->toArray();
		return $level[0];
	}

	public static function get_access_levels($permissions) {
		$query = Doctrine_Query::create() -> select("id,level,user_indicator") -> from("access_level")->
		 where("$permissions=1");
		$level = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
		
		return $level;
	}
	

}