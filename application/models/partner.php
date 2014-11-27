<?php
class Partners extends Doctrine_Record {
/////
public function setTableDefinition() {
	$this->hasColumn('name', 'varchar', 100);
	$this->hasColumn('flag', 'int', 45);		
}

public function setUp() {
	$this->setTableName('partners');	
}


public static function get_one_partner($id){
	$query = Doctrine_Query::create() -> select("*") -> from("Partners") -> where("ID = '" . $id . "' AND flag=1");
	$user = $query -> fetchOne();

	// $sql = "select name from partners where ID='$id' and flag='1'";	
	// $q_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->execute($sql);	
	return $user;	
}



}
