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
		$this -> hasColumn('workload', 'int',11);
		$this -> hasColumn('bedcapacity', 'int',11);
		$this -> hasColumn('order_no', 'int',11);
		/*compute this*/
		$this -> hasColumn('total_delivered', 'int',11);
		
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
	public static function get_order($code,$id=NULL){

if(isset($id)){
         $myobj = Doctrine::getTable('Ordertbl')->find($code);
         $myobj->approvalDate = date('y-m-d');
		 $myobj->orderStatus = 'approved';
		 $myobj->approveby=$id;
         $myobj->save();
	
}
		
	    $query=Doctrine_Query::create()-> select("*")->
		from("ordertbl")->where("id='$code'");
		$order=$query->execute();
		return $order;
	}
	//get the latest order id for a given facility
	public static function getNeworder($facilityCode){
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
	$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus like '%dispatched%'")->OrderBy('id desc');
	$order=$query->execute();
	return $order;	
	}
	//getting the pending orders
	public static function get_pending_orders(){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus like '%pending%'")->OrderBy("id desc");
		$order=$query->execute();
		return $order;	
	}
	//getting the approved orders 
	public static function get_approved_orders(){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus like '%approved%'")->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//getting the delivered orders
	public static function get_delivered_orders(){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus like '%delivered%'")->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//get facility delivered orders
	public static function get_received($facility_code){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus like '%delivered%' and facilityCode='$facility_code' ")->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	//get facility rejected orders
	public static function get_rejected($facility_code){
		$query=Doctrine_Query::create()->select("*")->from("ordertbl")->where("orderStatus like '%rejected%' and facilityCode='$facility_code' ")->OrderBy("id desc");
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
		->where("facilityCode='$facility_c' AND orderStatus like '%pending' ")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function getPending_d($facility_c){
		$query=Doctrine_Query::create()-> select("id,orderTotal,kemsaOrderid,facilityCode,orderDate")
		->from("ordertbl")
		->where("facilityCode='$facility_c' AND orderStatus like '%approved' ")
		->OrderBy("id desc");
		$order=$query->execute();
		return $order;
	}
	public static function get_pending_count($facility_c){
		$order =Doctrine_Query::create()-> select("*")->from("ordertbl")->where("facilityCode='$facility_c' AND orderStatus  like  '%pending%' ");
		return $order->count();
	}
	public static function get_rejected_count($facility_c){
		$order =Doctrine_Query::create()-> select("*")->from("ordertbl")->where("facilityCode='$facility_c' AND orderStatus like  '%rejected%'  ");
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
		->where("facilityCode='$facility_c' AND orderStatus like  '%pending%' ")
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
	 public static function get_pending_o_count($county_id=null,$district_id=null)
	{
		$addition=isset($district_id)?"facilities.district='$district_id'":"districts.county='$county_id'";
		$query=Doctrine_Query::create()-> 
        select("ordertbl.id")->
		from("ordertbl,facilities,districts")->where("ordertbl.facilityCode=facilities.facility_code")
		->andWhere("orderStatus like '%pending%' and facilities.district=districts.id and $addition");

		$order=$query->count();
		return ($order);
	

	}
	public static function get_details($id){
		$query=Doctrine_Query::create()-> select("*")->from("ordertbl")->where("id='$id'");
		$order=$query->execute();
		return $order;
	}
	//get the order date from a given date
	public static function get_dates($id){
		$query=Doctrine_Query::create()-> select("approvalDate,orderDate,deliverDate")->from("ordertbl")->where("id='$id'");
		$order=$query->execute()->toArray();
		return $order[0];
	}

		public static function get_county_orders($county){
		$query=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT
			(SELECT COUNT( o.facilityCode) FROM ordertbl o WHERE o.orderStatus like '%pending%' AND o.facilityCode=f.facility_code
            AND f.district=d.id
			AND d.county=c.id
			AND c.id=$county) as pending_count,
		(SELECT COUNT( o.facilityCode) FROM ordertbl o WHERE o.orderStatus like  '%approved%' AND o.facilityCode=f.facility_code
            AND f.district=d.id
			AND d.county=c.id
			AND c.id=$county) as approved_count,
		(SELECT COUNT( o.facilityCode) FROM ordertbl o WHERE o.orderStatus like  '%delivered%' AND o.facilityCode=f.facility_code
            AND f.district=d.id
			AND d.county=c.id
			AND c.id=$county) as delivered_count, o.orderDate,o.facilityCode,o.orderStatus,o.orderTotal,o.order_no
            FROM ordertbl o, facilities f, districts d, counties c
            WHERE o.facilityCode=f.facility_code
            AND f.district=d.id
			AND d.county=c.id
			AND c.id=$county
			ORDER BY o.orderStatus ASC");	
		return $query;
	}


	
	public static function get_county_order_turn_around_time($county_id){
			$q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
SELECT CEIL( AVG( DATEDIFF(  o.`approvalDate` ,o.`orderDate`) ) ) AS order_approval, CEIL( AVG( DATEDIFF( o.`deliverDate` , o.`approvalDate` ) ) ) AS approval_delivery, CEIL( AVG( DATEDIFF( o.`dispatch_update_date` , o.`deliverDate` ) ) ) AS delivery_update, CEIL( AVG( DATEDIFF( o.`dispatch_update_date` , o.`orderDate` ) ) ) AS t_a_t
FROM ordertbl o, facilities f, districts d, counties c
WHERE f.district = d.id
AND d.county = c.id
AND c.id = '$county_id'
");
return $q;

	}

public static function get_district_ordertotal($district){
     $year = date("Y");
$district_ordertotal = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT districts.county, ordertbl.`facilityCode` , SUM( ordertbl.`orderTotal` ) AS OrderTotal, MONTH( ordertbl.`approvalDate` ) as month
FROM ordertbl, facilities, districts
WHERE ordertbl.facilityCode = facilities.facility_code
AND (YEAR( ordertbl.`approvalDate` ) =$year
OR YEAR( ordertbl.`approvalDate` ) =$year-1)
AND districts.id =$district
AND facilities.district = districts.id
GROUP BY MONTH( ordertbl.`approvalDate` ) ");

        return $district_ordertotal ;
        }
        
        public static function get_county_fill_rate($county_id){
        	$district_ordertotal = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll(" SELECT IFNULL(avg( IFNULL( o_d.`quantityRecieved` , 0 ) / IFNULL( o_d.`quantityOrdered` , 0 ) ),0) as fill_rate
FROM  `ordertbl` o, facilities f, counties c, districts d, orderdetails o_d
WHERE f.facility_code = o.facilityCode
AND o.id = o_d.orderNumber
AND f.district = d.id
AND d.county = c.id
AND c.id ='$county_id'");

        return $district_ordertotal ;
 
        }

        

public static function get_county_ordertotal($county_id){
     $year = date("Y");
$county_ordertotal = Doctrine_Manager::getInstance()->getCurrentConnection()
		->fetchAll("SELECT districts.county, ordertbl.`facilityCode` , SUM( ordertbl.`orderTotal` ) AS OrderTotal, MONTH( ordertbl.`approvalDate` ) as month
FROM ordertbl, facilities, districts
WHERE ordertbl.facilityCode = facilities.facility_code
AND (YEAR( ordertbl.`approvalDate` ) =$year
OR YEAR( ordertbl.`approvalDate` ) =$year-1)
AND districts.county =$county_id
AND facilities.district = districts.id
GROUP BY MONTH( ordertbl.`approvalDate` ) ");

        return $county_ordertotal ;}
}
