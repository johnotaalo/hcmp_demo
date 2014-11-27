<?php
class Kemsa_Order extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('kemsa_order_no', 'varchar',20);	
		$this -> hasColumn('local_order_no', 'int');	
		$this -> hasColumn('order_batch_no', 'varchar',20);	
		$this -> hasColumn('order_total', 'varchar',20);	
		$this -> hasColumn('dispatch_date', 'date');	
	    $this -> hasColumn('recieve_date', 'date');	
		$this -> hasColumn('order_date', 'date');
		$this -> hasColumn('facility_mfl_code ', 'int');
		$this -> hasColumn('update_flag', 'int');	
	}


	public function setUp() {
		$this -> setTableName('Kemsa_Order');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
		$this -> hasMany('Kemsa_Order_Details as code1',array('local'=>'kemsa_order_no','foreign'=>'kemsa_order_no'));
		$this -> hasMany('orderdetails as code1', array('local'=>'local_order_no','foreign'=>'orderNumber'));
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Kemsa_Order")-> OrderBy("id desc");
		$drugs = $query -> execute();
		return $drugs;
	}
	public static function get_batch_no($delivery){
		$myobj = Doctrine::getTable('Kemsa_Order')->find($delivery);
        $order_batch_no=$myobj->order_batch_no ;
		$kemsa_order_no=$myobj->kemsa_order_no ;
		$order_total=$myobj->order_total;
		$order_date=$myobj->order_date;
		$dispatch_date=$myobj->dispatch_date;
		
		$my_array =array('0'=>$order_batch_no,'1'=>$order_total, '2'=>$kemsa_order_no, '3'=>$order_date,'4'=>$dispatch_date);
		return  $my_array;
	}
	///////////////////////////////getting the facility orders from kemsa
	public static function get_facility_order($facility_code){
		$result_object=Doctrine_Query::create() -> select("*") -> from("Kemsa_Order")-> where("facility_mfl_code= '$facility_code' AND update_flag=0");
		$result=$result_object->execute();
		return $result;
	}
	
	

}
