<?php
class Kemsa_Order_Details extends Doctrine_Record {
	
	public function setTableDefinition() {
		$this -> hasColumn('kemsa_code', 'varchar',20);	
		$this -> hasColumn('kemsa_order_no', 'varchar',20);	
		$this -> hasColumn('quantity', 'int');	
		$this -> hasColumn('batch_no', 'varchar',20);	
		$this -> hasColumn('expiry_date', 'date');	
		$this -> hasColumn('manufacture', 'varchar',20);	
	}

	public function setUp() {
		$this -> setTableName('Kemsa_Order_Details');
		//$this -> hasOne('Drug_Category as Category', array('local' => 'Drug_Category', 'foreign' => 'id'));
		$this->hasMany('drug as Code', array(
            'local' => 'kemsa_code',
            'foreign' => 'Kemsa_Code'
        ));
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Kemsa_Order_Details")-> OrderBy("id desc");
		$drugs = $query -> execute();
		return $drugs;
	}
	//gets the order details from the kemsa side in order for the user to confirm
	public static function get_order($delivery){
		
		$myobj = Doctrine::getTable('Kemsa_Order')->findOneBylocal_order_no($delivery);
        $kemsa_order_no=$myobj->kemsa_order_no ;
		$query=Doctrine_Query::create()-> select("*")->from("Kemsa_Order_Details")-> where("kemsa_order_no='$kemsa_order_no'")->OrderBy("id");
		$order=$query->execute();
		return $order;
	}
//gets the commodities that have been approved in order to update the stock level
   
   public static function get_stock_to_update($kemsa_order_no){
   	$drugs = Doctrine::getTable('Kemsa_Order_Details')->findBykemsa_order_no($kemsa_order_no);
	return $drugs;
   }
//get the faclilities orders
   public static function get_facility_dispatched_orders($kemsa_order_no){
   	$query = Doctrine_Query::create()
     ->select('*')
     ->from('facility_dispatched_details_view')
	 ->where("kemsa_order_no = '$kemsa_order_no'")
;
	$drugs = $query -> execute();
	
/*	$q = Doctrine_Query::create()
	->select("ord.quantityOrdered,kem.kemsa_code, kem.batch_no, kem.quantity, kem.expiry_date, kem.manufacture")
  ->from('Kemsa_Order_Details kem')
  ->leftJoin('OrderDetails ord')
  ->where("kem.kemsa_order_no ='$kemsa_order_no'");
	$test=$q->getSQL();
	/*$PDO = Doctrine_Manager::getInstance()->connection()->getDbh();
$PDO->prepare('SELECT kemsa_code, batch_no, quantity, expiry_date, manufacture, `quantityOrdered`
FROM `orderdetails` , `kemsa_order_details`
WHERE orderdetails.kemsaCode = kemsa_order_details.kemsa_code
AND kemsa_order_details.kemsa_order_no = "p2pLKO"')->execute(); */
	//$query = $em->createQuery('');
    //$users = $query->getResult();
 return	$drugs;

   }
}
