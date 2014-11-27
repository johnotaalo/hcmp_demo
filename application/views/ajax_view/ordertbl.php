<?php
class Ordertbl extends Doctrine_Record {
	public function setTableDefinition() {
	$this -> hasColumn('id', 'int',11);
		$this -> hasColumn('orderDate', 'date');
		$this -> hasColumn('facilityCode', 'int',5);
		$this -> hasColumn('deliverDate', 'date');
		$this -> hasColumn('remarks', 'text');
		$this -> hasColumn('orderStatus', 'varchar',20);
		$this -> hasColumn('dispatchDate', 'date');
		$this -> hasColumn('approvalDate', 'date');
		$this -> hasColumn('kemsaOrderid', 'varchar',20);
		$this -> hasColumn('orderTotal', 'varchar',100);
		$this -> hasColumn('reciever_name', 'varchar',50);
		$this -> hasColumn('reciever_phone', 'varchar',20);
		$this -> hasColumn('drawing_rights', 'varchar',11);
		$this -> hasColumn('status', 'tinyint',4);
		$this -> hasColumn('orderby', 'varchar',255);
		$this -> hasColumn('approveby', 'varchar',255);
		$this -> hasColumn('dispatchby', 'varchar',255);
		$this -> hasColumn('warehouse', 'varchar',255);
	}

	public function setUp() {
		$this -> setTableName('Ordertbl');
		$this->hasMany('Facilities as Code', array(
            'local' => 'facilityCode',
            'foreign' => 'facility_code'
        ));
		$this->hasMany('orderdetails as Ord', array(
            'local' => 'id',
            'foreign' => 'orderNumber'
        ));
	}
	
	// gets the orders which have been Dispatched for the user to upadte their details
	public static function getAll1($delivery){
		$query=Doctrine_Query::create()-> select("*")->
		from("ordertbl")->where("facilityCode='$delivery' AND orderStatus='Dispatched' AND deliverDate IS NULL")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//getting the order details 
	public static function get_order($code,$id){
		
		
		$myobj = Doctrine::getTable('Ordertbl')->find($code);
        $myobj->approvalDate = date('y-m-d');
		 $myobj->orderStatus='approved';
		 $myobj->approveby=$id;
         $myobj->save();
		
	    $query=Doctrine_Query::create()-> select("*")->
		from("ordertbl")->where("id='$code'");
		$order=$query->execute();
		return $order;
	}
	//get the latest order id for a given facility
	public function getNeworder($facilityCode){
		$query = Doctrine_Query::create() -> 
		select("Max(id) as maxId")-> 
		from("Ordertbl") ->
		where("facilityCode='$facilityCode'");
		$orderNumber = $query -> execute();	
		return $orderNumber[0];
	}
	// gets the orders which have been Dispatched for the user to upadte their details
	public static function getAll($facility_c){
		$query=Doctrine_Query::create()-> select("*")->
		from("Ordertbl") ->where("facilityCode='$facility_c' AND orderStatus='Dispatched' AND deliverDate IS NULL")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//gets the orders that are associated with a given district
	public static function get_district_orders($d){
		
		$query=Doctrine_Query::create()-> 
select("orderDate, ordertbl.id, facilityCode, deliverDate, remarks, orderStatus, dispatchDate,kemsaOrderid, orderTotal, approvalDate, reciever_name, reciever_phone, reciever_pin, drawing_rights ")->
		from("ordertbl,facilities")->where("ordertbl.facilityCode=facilities.facility_code")
		->andWhere("facilities.district='$d'");
		$order=$query->execute();
		return $order;
	}
	//getting the dispatched orders
	public static function get_dispatched_orders(){
	$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus='dispatched'")->OrderBy('id desc');
	$order=$query->execute();
	return $order;	
	}
	//getting the pending orders
	public static function get_pending_orders(){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus='pending'")->OrderBy("id desc");
		$order=$query->execute();
		return $order;	
	}
	//getting the approved orders 
	public static function get_approved_orders(){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus='approved'")->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//getting the delivered orders
	public static function get_delivered_orders(){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus='delivered'")->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//get facility delivered orders
	public static function get_received($facility_code){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus='delivered' and facilityCode='$facility_code' ")->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//get all the facilities orders
	public static function get_facilitiy_orders($facility_code){
	$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("facilityCode='$facility_code'")->OrderBy('id desc');
	$orders=$query->execute();
	return $orders;
	}
	public static function getFacilityOrder($id){
		$query=Doctrine_Query::create()-> select("*")
		->from("ordertbl")
		->where("kemsaOrderid='$id'")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function getPending($facility_c){
		$query=Doctrine_Query::create()-> select("id,orderTotal,kemsaOrderid,facilityCode,orderDate")
		->from("ordertbl")
		->where("facilityCode='$facility_c' AND orderStatus='Pending' ")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function getPending_d($facility_c){
		$query=Doctrine_Query::create()-> select("id,orderTotal,kemsaOrderid,facilityCode,orderDate")
		->from("ordertbl")
		->where("facilityCode='$facility_c' AND orderStatus='Approved' ")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function get_pending_count($facility_c){
		$order =Doctrine_Query::create()-> select("*")->from("ordertbl")->where("facilityCode='$facility_c' AND orderStatus='Pending' ");
		return $order->count();
	}
	
	//changed, now picking from order table instead on kemsa 
	public static function get_dispatched_count($facility_c){
		$order =Doctrine_Query::create()-> select("*")->from("ordertbl")->where("facilityCode= '$facility_c' AND status=1");
		return $order->count();
	}
	public static function getPendingDEtails($facility_c){
		$query=Doctrine_Query::create()-> select("*")
		->from("ordertbl")
		->where("facilityCode='$facility_c' AND orderStatus='Pending' ")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function getDispatched($facility_c){
		$query=Doctrine_Query::create()-> select("*")
		->from("ordertbl")
		->where("facilityCode='$facility_c' AND orderStatus='Dispatched' AND deliverDate IS NULL  ")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function getUnconfirmed(){
		$query=Doctrine_Query::create()-> select("*")
		->from("ordertbl")
		->where("orderStatus='Dispatched' AND deliverDate IS NULL")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
public static function get_all_orders_moh(){
		$query=Doctrine_Query::create()-> select("*")
		->from("ordertbl")
		->limit(20)
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	 public function get_pending_o_count($d='')
	{
		$query=Doctrine_Query::create()-> 
        select("ordertbl.id")->
		from("ordertbl,facilities")->where("ordertbl.facilityCode=facilities.facility_code")
		->andWhere("approvalDate is NULL")
		->andWhere("orderStatus='Pending'")
		->andWhere("facilities.district='$d'");
		$order=$query->count();
		return ($order);
		
	}
	public function get_details($id){
		$query=Doctrine_Query::create()-> select("*")->from("ordertbl")->where("id='$id'");
		$order=$query->execute();
		return $order;
	}

}
