<?php
/**
 * @author Kariuki
 */
class  facility_order_details_rejects extends Doctrine_Record {	
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('facility_order_details_id', 'int');
				$this->hasColumn('reason', 'varchar',100);
				$this->hasColumn('status', 'int');	
	}
	public function setUp() {
		$this -> setTableName('facility_order_details_rejects');		
		
	}

	
	
	
}
