<?php
/**
 * @author Kariuki
 */
class facility_order_status extends Doctrine_Record {	
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('status_desc', 'varchar',100);
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('facility_order_status');		
		
	}

	
	
	
}
