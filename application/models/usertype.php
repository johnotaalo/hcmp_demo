<?php
class Usertype extends Doctrine_Record {

	public function setTableDefinition() {
		$this->hasColumn('usertype', 'string', 50);
		
	}
	
	public function setUp() {
		$this->setTableName('usertype');
	//	$this -> hasMany('User as user_type', array('local' => 'id', 'foreign' => 'usertype_id'));
		
		
	}

	
}
