<?php
class Orderdetails extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('kemsa_code', 'varchar',20);
		$this -> hasColumn('quantityOrdered', 'varchar',100);
		$this -> hasColumn('price', 'varchar',20);
		$this -> hasColumn('orderNumber', 'int',11);
		$this -> hasColumn('quantityRecieved', 'varchar',100);
		$this -> hasColumn('t_receipts', 'int',11);
		$this -> hasColumn('t_issues', 'int',11);
		$this -> hasColumn('adjust', 'int',11);
		$this -> hasColumn('losses', 'int',11);
		$this -> hasColumn('days', 'int',11);
		$this -> hasColumn('c_stock', 'int',11);
		$this -> hasColumn('o_balance', 'int',11);
		$this -> hasColumn('s_quantity', 'int',11);
		$this -> hasColumn('historical_consumption', 'int',11);
		$this -> hasColumn('comment', 'varchar',50);
		
		
	}

	public function setUp() {
		$this -> setTableName('orderdetails');
		 $this->hasMany('drug as Code', array(
            'local' => 'kemsa_code',
            'foreign' => 'id'
        ));
		 $this->hasOne('ordertbl as Ord', array(
            'local' => 'orderNumber',
            'foreign' => 'id'
        ));
	}
	//get the order details associate with a given order number
  public static function get_order($delivery){
  	
		$query=Doctrine_Query::create()-> select(" kemsa_code, quantityOrdered, price,quantityRecieved, ROUND( (quantityRecieved /quantityOrdered) *100 ) AS fill_rate")->from("orderdetails")-> where("orderNumber=$delivery")->OrderBy("fill_rate ASC ");
		$order=$query->execute();
		return $order;
	}
	public static function get_date($delivery){
        $query=Doctrine_Query::create()-> select("*")->from("ordertbl")-> where("id=$delivery")->OrderBy("id");
        $date=$query->execute();
        return $date;
    }
	
	public static function get_order_details($order_id){
		$query=Doctrine_Query::create()-> select("*")->from("orderdetails")-> where("orderNumber=$order_id")->OrderBy("id");
        $order_details=$query->execute();
        return $order_details;
	}

}
