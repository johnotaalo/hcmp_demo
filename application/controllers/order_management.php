<?php
include_once 'auto_sms.php';
class Order_Management extends auto_sms {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url','file'));
		$this->load->library('mpdf');
	}

	public function index($tab=NULL,$status=null) {
		$this -> listing($tab,$status);
	}
	public function new_order($note=NULL) {

		if(isset($note)){
	    $facility_c=$this -> session -> userdata('news');
        $data['title'] = "New Order";
		$data['content_view'] = "facility/facility_data/facility_orders/new_order_v";
		$data['banner_text'] = "New Order";
		$data['link'] = "order_management";
		$data['drug_name']=Drug::getAll();				
		$data['facility_order'] = Facility_Transaction_Table::get_commodities_for_ordering($facility_c);
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
		}
		else{
			
			redirect("stock_management/stock_level/c0N123");
		}
	}
	//update the facility transaction table after a physical count.
	 public function update_facility_transaction($msg=NULL){
	 	        $option=$_POST['option'];
               //setting up the variables
               $id=$_POST['id'];

               $open=$_POST['open'];
               $recepits=$_POST['receipts'];
               $issues=$_POST['issues'];
               $adjustments=$_POST['adjustments'];
               $losses=$_POST['losses'];
               $closing=$_POST['closing'];
               $nodays=$_POST['days'];
               $drug_id=$_POST['drug_id'];
               
  
               $j=count($id);
               //updating the facility transaction table automatically
               $facility_c=$this -> session -> userdata('news');
			   $user_id=$this -> session -> userdata('user_id');
 
               if($option!="update stock levels"){
              for($i=0;$i<$j;$i++){
       $myobj = Doctrine::getTable('Facility_Transaction_Table')->find($id[$i]);
       $myobj->Opening_Balance =$open[$i];
       $myobj->Total_Receipts =$recepits[$i];
       $myobj->Total_Issues =$issues[$i];
       $myobj->Adj =$adjustments[$i];
       $myobj->Losses =$losses[$i];
       $myobj->Closing_Stock =$closing[$i];
       $myobj->Days_Out_Of_Stock =$nodays[$i];
       $myobj->save();
       }
               $note=TRUE;
      redirect("order_management/new_order/$note");
               }
               else{
               	            for($i=0;$i<$j;$i++){
       $myobj = Doctrine::getTable('Facility_Transaction_Table')->find($id[$i]);
       $myobj->Opening_Balance =$open[$i];
       $myobj->Total_Receipts =$recepits[$i];
       $myobj->Total_Issues =$issues[$i];
       $myobj->Adj =$adjustments[$i];
       $myobj->Losses =$losses[$i];
       $myobj->Closing_Stock =$closing[$i];
       $myobj->Days_Out_Of_Stock =$nodays[$i];
       $myobj->save();
               /*********************************************step one get the totals of the previous issues*************************/
	  $qty_issued=0;
	  
      $inserttransaction = Doctrine_Manager::getInstance()->
      getCurrentConnection()
      ->fetchAll("SELECT SUM( `qty_issued` ) AS qty_issued
                  FROM facility_issues
                  WHERE `facility_code` = '$facility_c'
                  AND `kemsa_code` = '$drug_id[$i]' AND availability='1' ");
				  
				  
	/**********************************totals of all the issues of that particular ordering window*****************************/ 			  
	 $qty_issued= $inserttransaction[0]['qty_issued'];	
	if(empty( $qty_issued)){
		 $qty_issued=0;
	}
//	echo "qty_issued    $qty_issued <br>";
	
	 /***********************************get the balances of the particular commodidty for that window********************************/
	 	
       $inserttransaction1 = Doctrine_Manager::getInstance()->
      getCurrentConnection()
      ->fetchAll("SELECT SUM( `balance` ) AS qty_balance
                  FROM facility_stock
                  WHERE `facility_code` = '$facility_c'
                  AND `kemsa_code` = '$drug_id[$i]' and status='1' ");
				  
	/**********************************totals of balances of the particular commodidty for that window*****************************/    
	
    $qty_bal= $inserttransaction1[0]['qty_balance'];
//	echo "qty bal    $qty_bal <br>";
//	 echo "number of issues $issues[$i]</br> ";
	
	
	 /**********************************check if there is any difference between what the user has inputed and the acutal issues*****************************/  
	 $slag_qty= $issues[$i]-$qty_issued;
	 
	//echo "slag $slag_qty <br>";
	 
	 
	 //$real_slag=$slag_qty;
	 //$real_b=0;
	 if($issues[$i]>$qty_issued && $qty_bal>=$slag_qty ){
	//echo "ok <br>";

	 	$query = Doctrine_Query::create() -> select("*") -> from("facility_stock")
	 	->where("Facility_Code='$facility_c' and status='1'") ->andwhere("kemsa_code='$drug_id[$i]'")->orderby('expiry_date asc');
        $drugs = $query -> execute();
        
        foreach ($drugs as  $data) {
        	$table_bal=$data->balance ; 
			
			
        	$real_b=0;
        	$update_value=0;
        	
        	if($table_bal>$slag_qty&&$slag_qty>0){
        		//echo "$table_bal>$slag_qty<br>";
                $real_b=$table_bal-$slag_qty;
				$update_value=$slag_qty;
				//echo "real_b $real_b  update_value $update_value <br>";
				//echo $update_value.'$update_value $table_bal>=$issues[$i]</br>';
				$inserttransactiona = Doctrine_Manager::getInstance()->
                getCurrentConnection()
                 ->execute("update facility_stock  set balance=$real_b where id=$data->id ");
      
				//echo  "update facility_stock  set qty_balance=$real_b where id=$data->id what to update  </br>";
				
                $mydata = array('facility_code' => $facility_c,	'kemsa_code' => $drug_id[$i], 's11_No'=>'N/A', 'batch_no' => $data->batch_no ,
				'expiry_date' => $data->expiry_date ,'qty_issued'=>$update_value  ,
				'issued_to'=>'PHARMACY','balanceAsof'=> $table_bal, 'date_issued'=>date('y-m-d'),'issued_by'=>$user_id);
				
				$u = new Facility_Issues();

    			$u->fromArray($mydata);

    			$u->save();
				
    			$slag_qty=0;
				//echo "new slag_qty $slag_qty <br>";
			}
			
			elseif ($table_bal<=$slag_qty &&$slag_qty>0) {
                // echo "$table_bal<=$slag_qty<br>";
				
				
				$update_value=$table_bal;
				$real_b=0;
				
				echo " real_b $real_b  update_value $update_value <br>";
				echo "new slag_qty $slag_qty <br>";
				$slag_qty=$slag_qty-$table_bal;
				$inserttransactiona = Doctrine_Manager::getInstance()->
                getCurrentConnection()
                ->execute("update facility_stock  set balance=$real_b where id=$data->id ");
      
				
				
                $mydata = array('facility_code' => $facility_c,	'kemsa_code' => $drug_id[$i], 's11_No'=>'N/A', 'batch_no' => $data->batch_no ,
				'expiry_date' => $data->expiry_date ,'qty_issued'=>$update_value  ,
				'issued_to'=>'PHARMACY','balanceAsof'=> $table_bal, 'date_issued'=>date('y-m-d'),'issued_by'=>$user_id);
				
				$u = new Facility_Issues();

    			$u->fromArray($mydata);

    			$u->save();
				
				
			}
			
        	 	//echo $table_bal.'drug balance G8</br> ';
				
				
				//echo $real_b.' slag after deduction  </br>';
				//exit;
	  /**/
    			}
			//exit;
		 
		 }
	 
	 }
$msg="Stock details have been updated";
redirect("stock_management/stock_level/$msg");
             
               }
                               
       }
	
	public function new_order2() {
		
		$data['title'] = "Place Order";
		$data['content_view'] = "new_order_v2";
		$data['banner_text'] = "New Order";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
	}
	
public function order_now(){
     	
		$data['title'] = "New Order";
		$data['content_view'] = "new_order_v2";
		$data['banner_text'] = "New Order";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
			    
}

//kemsa orders
public function kemsa_order_v(){
	    $checker=$this->uri->segment(3);
		
			switch ($checker)
			{
				case 'pending':
					$data['order_list']=Ordertbl::get_pending_orders();
					break;
					case 'approved':
						$data['order_list']=Ordertbl::get_approved_orders();
					break;
						case 'dispatched':
						$data['order_list']=Ordertbl::get_dispatched_orders();
						break;
							case 'delivered':
							$data['order_list']=Ordertbl::get_delivered_orders();
							break;
								default :
								$data['order_list']=Ordertbl::get_all_orders_moh();				
			}
					
		$data['title'] = "Order View";
     	$data['content_view'] = "kemsa/kemsa_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "kemsa_order_v";
		$this -> load -> view("template", $data);
		
	}
/***********************************8temp dispatch ***************************/
public function kemsa_approve_order(){

	$this->load->helper('string');
	$delivery=$this->uri->segment(3);
	
	$order_details_array=Orderdetails::get_order($delivery);
	$myobj = Doctrine::getTable('Ordertbl')->find($delivery);
    $o_total=$myobj->orderTotal;
	$f_code=$myobj->facilityCode;
	$o_date=$myobj->orderDate;
	$count=1;
	
	$code=random_string('alnum', 6);
	$code2=random_string('alnum', 6);
	$date=date("y-m-d");
	$kemsa_order_input=array("kemsa_order_no"=>$code,"local_order_no"=>$delivery,"order_batch_no"=>$code2,"order_total"=>$o_total,"facility_mfl_code"=>$f_code,"dispatch_date"=>date($date,strtotime('+2 weeks')),"recieve_date"=>date($date,strtotime('+1 weeks')),"order_date"=>$o_date);
	$myobj->dispatchDate=date($date,strtotime('+2 weeks'));
	$myobj->orderStatus='dispatched';
	$myobj->save();
	    $u1 = new Kemsa_Order();
    	$u1->fromArray($kemsa_order_input);
    	$u1->save();
	
	foreach($order_details_array as $data){
	$input_array=array("kemsa_code"=>$data->kemsa_code,"kemsa_order_no"=>$code,"batch_no"=>'AB'.$count,"quantity"=>$data->quantityOrdered,"expiry_date"=>'2013-10-15',"manufacture"=>'GlaxoSmithkline');
       
	    $u = new Kemsa_Order_Details();
    	$u->fromArray($input_array);
    	$u->save();
    	
         $count++;	
}
}
	public function listing($tab,$status) {
		 $facility_c=$this -> session -> userdata('news');
		// echo $facility_c;
		
        $data['order_counts']=Counties::get_county_order_details("","", $facility_c);
		$data['delivered']=Counties::get_county_received("","", $facility_c);
		$data['pending']=Counties::get_pending_county("","", $facility_c);
		$data['approved']=Counties::get_approved_county("","", $facility_c);
		$data['rejected']=Counties::get_rejected_county("","", $facility_c);
		$data['title'] = "Facility Orders";
		$data['content_view'] = "facility/facility_data/facility_orders/orders_listing_v";
		$data['banner_text'] = "Facility Orders";

		$this -> load -> view("template", $data);
	}
	public function get_delivered_orders_ajax(){
		 $facility_c=$this -> session -> userdata('news');
		$data['received']=Ordertbl::get_received($facility_c);
		$this -> load -> view("facility/ajax-view/orders_delivered_v", $data);
	
	}
	public function drug_issue(){
		$data['title'] = "New Drug Issue";
		$data['content_view'] = "new_issue_v";
		$data['banner_text'] = "New Drug Issue";
		$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();
		$data['quick_link'] = "drug_issue";
		$this -> load -> view("template", $data);
	}
	public function getDistrict(){
		//for ajax
		$county=$_POST['county'];
		$districts=Districts::getDistrict($county);
		$list="";
		foreach ($districts as $districts) {
			$list.=$districts->id;
			$list.="*";
			$list.=$districts->district;
			$list.="_";
		}
		echo $list;
	}
	public function getFacilities(){
		//for ajax
		$district=$_POST['district'];
		$facilities=Facilities::getFacilities($district);
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->facility_code;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
	}
	public function getHFacilities(){
		//for ajax
		$district=$_POST['district'];
		$facilities=Facilities::getFacilities($district);
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->facility_code;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
	}
	public function getAllFacilities(){
		$facilities=Facilities::getAll();
		$list="";
		foreach ($facilities as $facilities) {
			$list.=$facilities->id;
			$list.="*";
			$list.=$facilities->facility_name;
			$list.="_";
		}
		echo $list;
		
	}
	
	 public function getBatch(){
		//for ajax
		$desc=$_POST['desc'];
		$facility_c=$this -> session -> userdata('news');
		$describe=Facility_Stock::getAll($desc,$facility_c);
		
		$list="";
		
		foreach ($describe as $describe) {
			
			$list.=$describe['kemsa_code'];
			$list.="*";
			$list.=$describe['batch_no'];
			$list.="*";
			$list.=$describe['expiry_date'];
			$list.="*";
			$list.=$describe['balance'];
			$list.="*";
			$list.=$describe['status'];
			$list.="*";
			$list.=$describe['id'];
			$list.="*";
			$list.=$describe['total_balance'];
			$list.="_";
		}
		
		echo $list;
		
		exit;
	}
	public function potentialExpiries(){  //New
	 $facility_c=$this -> session -> userdata('news');
     $data['title'] = "Stock";
    $data['content_view'] = "potentialExp";
     $data['banner_text'] = "Potential Expiries";
     $data['link'] = "order_management";
$data['stocks']=Facility_Stock::expiries($facility_c);
//$data['tester']=Drug::getSome();
$data['quick_link'] = "stock_view";
$this -> load -> view("template", $data);
}
	public function unconfirmed(){
		$data['title'] = "Unconfirmed Orders";
     	$data['content_view'] = "moh/unconfirmed_orders_v";
		$data['banner_text'] = "Unconfirmed Orders";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "unconfirmed_orders";
		$data['order_list']=Ordertbl::getUnconfirmed();
		$this -> load -> view("template", $data);
	}
	
	public function update_facility_transaction_t(){
		$update_array=$_POST['data_array'];
		$facilityCode=$facility_c=$this -> session -> userdata('news');
		
		$facility_has_commodity=Facility_Transaction_Table::get_if_drug_is_in_table($facilityCode,$update_array);
			
			
		   
		   if($facility_has_commodity>0){

		   }
else{
	$data1=array('Facility_Code' => $facilityCode,'Kemsa_Code' => $update_array,'Cycle_date'=>'0000-00-11'); 
		$o = new Facility_Transaction_Table();
	    $o->fromArray($data1);
		$o->save();
	
}
		
		
		
		echo 'success';
	}
	public function update_facility_transaction_t2(){
		$data_array=$_POST['data_array'];
		$qty=explode("|", $data_array);
	    $code=$qty[0];
		$facilityCode=$facility_c=$this -> session -> userdata('news');
		
		
		$q = Doctrine_Query::create()
			->update('Facility_Transaction_Table')
				->set('qty,Comment','?',"$qty[1],$qty[2]")
					->set('Comment','?',"$qty[2]")
					->where("Facility_Code='$facilityCode' AND Kemsa_Code='$code'");
						$q->execute();
		
		echo 'success quantity= '.$qty[1].'Comment= '.$qty[2].'kemsa_code= '.$code;
	}
	
	public function delete_order($order_id){
		
		
		
		$reset_facility_order_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_order_table->execute("DELETE FROM `orderdetails` WHERE  orderNumber=$order_id; ");	

	
	    $reset_facility_order_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_order_table->execute("DELETE FROM `ordertbl` WHERE  id=$order_id; ");
		
		$this->session->set_flashdata('system_success_message', "Order Number $order_id has been deleted");
		
		redirect('/');
		
		
	}
	
	public function makeOrder(){
		$drawing_rights=0;
		$ids=$_POST['kemsaCode'];
		$price=$_POST['price'];
		$open=$_POST['open'];
		$recepits=$_POST['receipts'];
		$issues=$_POST['issues'];
		$adjustments=$_POST['adjustments'];
		$losses=$_POST['losses'];
		$closing=$_POST['closing'];
		$nodays=$_POST['days'];
		$quantity=$_POST['quantity'];
		$comment=$_POST['comment'];
		$s_quantity=$_POST['actual_quantity'];
		$workload=$_POST['workload'];
		$order_no=$_POST['order_no'];
		$bed_capacity=$_POST['bed_capacity'];
		$historical_consumption=$_POST['historical'];
		$orderDate=date('y-m-d'); 

		$facilityCode=$facility_c=$this -> session -> userdata('news');
		$user_id=$facility_c=$this -> session -> userdata('user_id');
		$drawing_rights = $this -> session -> userdata('drawing_rights');
		$j=count($ids);
		
		
		$total=0;
		$count=1;
		$data_array=NULL;
		
		for($i=0;$i<$j;$i++){
		if($count==1) 
			{
		 $data1=array('orderDate' => ''.$orderDate.'','facilityCode' => ''.$facilityCode.'','drawing_rights'=>''.$drawing_rights.'' ,'orderby'=>''.$user_id.'' ); 
		   $o = new Ordertbl();
	       $o->fromArray($data1);
	       $o->save();
		
		$lastId=Ordertbl::getNeworder($facilityCode);
		$newOrderid= $lastId->maxId;
		$count++;
		}
		if($quantity[$i]>=0){
			
		$data=array("kemsa_code"=>$ids[$i],
		"price"=>$price[$i],
		"quantityOrdered"=>$quantity[$i],
		"orderNumber"=>$newOrderid,
		't_receipts'=>$recepits[$i],
		't_issues'=>$issues[$i],
		'adjust'=>$adjustments[$i],
		'losses'=>$losses[$i],
		'days'=>$nodays[$i],
		'c_stock'=>$closing[$i],
		'comment'=>$comment[$i],
		's_quantity'=>$s_quantity[$i],
		'workload'=>$workload,
		'bed_capacity'=>$bed_capacity,
		'order_no'=>$order_no,
		'o_balance'=>$open[$i],
		'historical_consumption'=>$historical_consumption[$i]);
		$total=$quantity[$i]*$price[$i]+$total;
		$u = new Orderdetails();
		$u->fromArray($data);
		$u->save();
		
}
////////////////////////////////////////////////////////////////////////////////////////
}
		
	    
		$myobj = Doctrine::getTable('Ordertbl')->find($newOrderid);
        $myobj->orderTotal =$total;
		$myobj->orderby =$user_id;
		$myobj->workload =$workload;
		$myobj->bedcapacity =$bed_capacity;
		$myobj->order_no = $order_no;
        $myobj->save();
		
		
				
		$in = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT a.category_name, b.drug_name, b.kemsa_code, b.unit_size, b.unit_cost, 
		c.quantityOrdered, c.price, c.orderNumber, c.quantityRecieved,
		c.o_balance, c.t_receipts, c.t_issues, c.adjust, c.losses, c.days, c.comment, c.c_stock,c.s_quantity
FROM drug_category a, drug b, orderdetails c
WHERE c.orderNumber =$newOrderid
AND b.id = c.kemsa_code
AND a.id = b.drug_category
ORDER BY a.id ASC , b.drug_name ASC ");
		
		$jay=count($in);
		
		$from_ordertbl=Ordertbl::get_order($newOrderid);
		
		//create the report title
		$html_title="<div ALIGN=CENTER><img src='Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>Order Report</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Ministry of Health</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />   ";
		
		//get the facility name and MFL code 
		
		foreach($from_ordertbl as $order){
			
		$o_date=$order->orderDate;
		$a_date=$order->approvalDate;
		$o_total=$order->orderTotal;
		$d_rights=$order->drawing_rights;
		$bal=$d_rights-$o_total;
		$creator=$order->orderby;
		$approver=$order->approveby;
		
			foreach($order->Code as $f_name){ $fac_name=$f_name->facility_name; }
			$mfl=$order->facilityCode;
			$myobj = Doctrine::getTable('Facilities')->findOneByfacility_code($mfl);
            $diasto= $myobj->district;
            $myobj1 = Doctrine::getTable('Districts')->find($diasto);
			$disto_name=$myobj1->district;
			$county=$myobj1->county;
			$myobj2 = Doctrine::getTable('Counties')->find($county);
			$county_name=$myobj2->county;
			
			$myobj_order = Doctrine::getTable('User')->find($creator);
			$creator_name=$myobj_order->email;
			$creator_name1=$myobj_order->fname;
			$creator_name2=$myobj_order->lname;
			$creator_telephone=$myobj_order->telephone;
		   
        }
        //create the table for displaying the order details
$html_body="<table class='data-table' width=100%>
<tr>
<td>MFL No: $mfl</td> 
<td >Health Facility Name:<br/> $fac_name</td>
<td >Total OPD Visits & Revisits: </td>
<td >Level:</td>
<td>Dispensary</td>
<td >Health Centre</td>
</tr>
<tr>
<td>County: $county_name</td> 
<td > District: $disto_name</td>
<td >In-patient Bed Days : </td>
<td >Order Date:<br/> ".date('d M, Y',strtotime ($o_date))." </td>
<td>Order no.</td>
<td >Reporting Period <br/>
Start Date:  <br/>  End Date: ".date('d M, Y',strtotime ($o_date))."
</td>
</tr>
</table>";        
$html_body .="<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: 	#FFF380;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
</style>
<table class='data-table'>


<thead><tr><th><b>KEMSA Code</b></th><th><b>Description</b></th><th><b>Order Unit Size</b></th><th><b>Order Unit Cost</b></th><th ><b>Opening Balance</b></th>
<th ><b>Total Receipts</b></th><th><b>Total issues</b></th><th><b>Adjustments</b></th><th><b>Losses</b></th><th><b>Closing Stock</b></th><th><b>No days out of stock</b></th>
<th><b>Order Quantity (Packs)</b></th><th><b>Order Quantity (Actual Units)</b></th><th><b>Order cost(Ksh)</b></th><th><b>Comment</b></th></tr> </thead><tbody>";

       
	   $html_body .='<ol type="a">' ;
       for($i=0;$i<$jay;$i++){
       	
       			 
       		if ($i==0) {
				$html_body .='<tr style="background-color:#C6DEFF;"> <td colspan="15" >
				 <li> '.$in[$i]['category_name'].' </li> </td></tr>'; 
			   }
       	
else if( $in[$i]['category_name']!=$in[$i-1]['category_name']){
       	 	$html_body .='<tr style="background-color:#C6DEFF;"> <td  colspan="15"> 
       	 	<li> '.$in[$i]['category_name'].' </li> </td></tr>';
       	 }
         $adj=$in[$i]['adjust'];
		 $c_stock=$in[$i]['c_stock'];
		 $o_t=$in[$i]['quantityOrdered'];
		 $o_q=$in[$i]['price'];
		 $o_bal=$in[$i]['o_balance'];
		 $t_re=$in[$i]['t_receipts'];
		 $t_issues=$in[$i]['t_issues'];
		 $losses=$in[$i]['losses'];
		 
		 if($o_bal==0 && $t_re==0 && $t_issues>0){
		 	$adj=$t_issues;
		 }
		 $c_stock=$o_bal+$t_re+$adj-$losses-$t_issues;
		 
		 if($c_stock<0){
		 	$adj=$c_stock*-1;
		 }
		  $c_stock=$o_bal+$t_re+$adj-$losses-$t_issues;
		 $html_body .="<tr>";
		 $html_body .="<td>".$in[$i]['kemsa_code']."</td>"; 	
		 
		  $html_body .="<td>".$in[$i]['drug_name']."</td>";
		  $html_body .="<td>".$in[$i]['unit_size']."</td>";
		  $ot=number_format($o_t*$o_q, 2, '.', ',');
		  $order_total=$order_total+($o_t*$o_q);
		  $html_body .="<td>$o_q</td>";
		  $html_body .="<td>". $o_bal."</td>"; 
		  $html_body .="<td>".$t_re."</td>";
		  $html_body .="<td>".$t_issues."</td>";
		  $html_body .="<td>".$adj."</td>";
		  $html_body .="<td>".$losses."</td>";
		  $html_body .="<td>".$c_stock."</td>";
		  $html_body .="<td>".$in[$i]['days']."</td>"; 
		  $html_body .="<td>$o_t</td>";
		  $html_body .="<td>".$in[$i]['s_quantity']."</td>"; 
		  $html_body .="<td>$ot</td>"; 
		  $html_body .="<td>".$in[$i]['comment']."</td></tr>"; }

            
			
			$myobj_approve = Doctrine::getTable('User')->find($approver);
			$approve_name=$myobj_approve->email;
			$approve_name1=$myobj_approve->fname;
			$approve_name2=$myobj_approve->lname;
			$approve_telephone=$myobj_approve->telephone;

          $bal=$d_rights-$order_total;
		  $html_body .='</tbody></table></ol>'; 
		  $html_body1 ='<table class="data-table" width="100%" style="background-color: 	#FFF380;">
		  <tr style="background-color: 	#FFFFFF;" > <td colspan="4" ><div style="float: left" > Total Order Value:</div><div style="float: right" >KSH '.number_format($order_total, 2, '.', ',').'</div> </td></tr>
		   <tr style="background-color: 	#FFFFFF;"  > <td colspan="4" ><div style="float: left" > Drawing Rights Available Balance:</div><div style="float: right" >KSH		'.number_format($bal, 2, '.', ',').'</div> </td></tr>
		   <tr><td>FACILITY TEL NO:</td><td colspan="3">FACILITY EMAIL:</td>
		   </tr>
		   <tr><td >Prepared by (Name/Designation) '.$creator_name1.' '.$creator_name2.'
		   <br/>
		   <br/>Email: '.$creator_name.'</td><td>Tel: '.$creator_telephone.'</td><td>Date: '.date('d M, Y',strtotime ($o_date)).'</td><td>Signature</td>
		   </tr>
		   <tr><td>Checked by (Name/DPF/DPHN)
		   <br/>
		   <br/>Email</td><td>Tel</td><td>Date</td><td>Signature</td>
		   </tr>
		   <tr><td>Authorised by (Name/DMoH) Pending
		   <br/>
		   <br/>Email: Pending </td><td>Tel: Pending </td><td>Date: Pending </td><td>Signature</td>
		   
		   </tr>
		   </table>';
		   
		
		//now ganerate an order pdf from the generated report
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->defaultheaderline = 1;  
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML($html_body);
            $this->mpdf->AddPage();
			$this->mpdf->WriteHTML($html_body1);
			
			$report_name=$fac_name.'facility_order_no_'.$order_no."order_date".date('d-m-y');
		
		
		
		if(!write_file( './pdf/'.$report_name.'.pdf',$this->mpdf->Output('$report_name','S')))
			{
				
		$this->session->set_flashdata('system_error_message', 'An error occured but the order was placed contact support team');			
        redirect("order_approval/district_orders");
 
	
     //   $this->district_orders();
             }
		
else{
	 
		$message_1='<br>Please find the Order Made by '.$fac_name.' below for approval.
		<br>
		You may log in to the HCMP system to approve it.<a href="http://health-cmp.or.ke/" target="_blank">Click here</a>
		<br>
		<br>
		<br>';
	$subject='Pending Approval Order Report For '.$fac_name;
  
  $attach_file='./pdf/'.$report_name.'.pdf';
  

  
  $message=$message_1.$html_title.$html_body.$html_body1;
  
  $response= $this->send_order_submission_email($message,$subject,$attach_file,null);

 if($response){
 	delete_files('./pdf/'.$report_name.'.pdf');
 }
 else{
 	//do nothing 
 }
}
			
	$this->send_order_sms();	
	$this->session->set_flashdata('system_success_message', 'Your order has been saved');	
	redirect('Order_Management/#tabs-1');
	
	}

public function update_order($order_id_county=null){

		
		$new_value=@$_POST['quantity'];
		$price=@$_POST['price'];
		$order_id=@$_POST['order_id'];
		$value=count($new_value);
		$code=@$_POST['f_order_id'];
		$s_quantity=@$_POST['actual_quantity'];
		$order_total=0;
		$rejected_order=@$_POST['rejected_order'];
		$make_pdf=@$rejected_order;
				
		$make_pdf=isset($rejected_order)? true: (isset($order_id_county) && ($order_id_county>0)) ? true : false ;
		
		
		(!$make_pdf)?redirect("home_controller") : $blank_data;
		

		for($i=0;$i<$value;$i++){
				
		$myobj = Doctrine::getTable('Orderdetails')->find($order_id[$i]);
        $myobj->quantityOrdered = $new_value[$i];
		$myobj->s_quantity =$s_quantity[$i];
        $myobj->save();
		//$total=$total*($new_value[$i]*$price[$i]);
			//echo $new_value[$i];
		}
	
		if($rejected_order=='true' || $make_pdf){
			
		$code=isset($code)? $code: $order_id_county;
			
		$from_ordertbl=Ordertbl::get_order($code);
			
		$total=0;
		
		//update the order based on how the district pham has rationalized it
		$checker=1;

		$in = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT a.category_name, b.drug_name,b.total_units, b.kemsa_code, b.unit_size, b.unit_cost, 
		c.quantityOrdered, c.price, c.orderNumber, c.quantityRecieved,
		c.o_balance, c.t_receipts, c.t_issues, c.adjust, c.losses, c.days, c.comment, c.c_stock,c.s_quantity
FROM drug_category a, drug b, orderdetails c
WHERE c.orderNumber =$code
AND b.id = c.kemsa_code
AND a.id = b.drug_category
ORDER BY a.id ASC , b.drug_name ASC ");
		
		$jay=count($in);
		
		
		//create the report title
		$html_title="<div ALIGN=CENTER><img src='".base_url()."Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-size: 14px;display: block;font-weight: bold;'>Order Report</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Ministry of Health</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div><hr />   ";
		
		//get the facility name and MFL code 
		
		foreach($from_ordertbl as $order){
			
		$o_date=$order->orderDate;
		$a_date=$order->approvalDate;
		$o_total=$order->orderTotal;
		$d_rights=$order->drawing_rights;
		$bal=$d_rights-$o_total;
		$creator=$order->orderby;
		$approver=$order->approveby;
		
			foreach($order->Code as $f_name){ $fac_name=$f_name->facility_name; }
			$mfl=$order->facilityCode;
			$myobj = Doctrine::getTable('Facilities')->findOneByfacility_code($mfl);
            $diasto= $myobj->district;
            $myobj1 = Doctrine::getTable('Districts')->find($diasto);
			$disto_name=$myobj1->district;
			$county=$myobj1->county;
			$myobj2 = Doctrine::getTable('Counties')->find($county);
			$county_name=$myobj2->county;
			
			$myobj_order = Doctrine::getTable('User')->find($creator);
			$creator_name=$myobj_order->email;
			$creator_name1=$myobj_order->fname;
			$creator_name2=$myobj_order->lname;
			$creator_telephone=$myobj_order->telephone;
		   
        }
        //create the table for displaying the order details
$html_body="<table class='data-table' width=100%>
<tr>
<td>MFL No: $mfl</td> 
<td >Health Facility Name:<br/> $fac_name</td>
<td >Total OPD Visits & Revisits: </td>
<td >Level:</td>
<td>Dispensary</td>
<td >Health Centre</td>
</tr>
<tr>
<td>County: $county_name</td> 
<td > District: $disto_name</td>
<td >In-patient Bed Days : </td>
<td >Order Date:<br/> ".date('d M, Y',strtotime ($o_date))." </td>
<td>Order no.</td>
<td >Reporting Period <br/>
Start Date:  <br/>  End Date: ".date('d M, Y',strtotime ($o_date))."
</td>
</tr>
</table>";        
$html_body .="<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: 	#FFF380;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
</style>
<table class='data-table'>


<thead><tr><th><b>KEMSA Code</b></th><th><b>Description</b></th><th><b>Order Unit Size</b></th><th><b>Order Unit Cost</b></th><th ><b>Opening Balance</b></th>
<th ><b>Total Receipts</b></th><th><b>Total issues</b></th><th><b>Adjustments</b></th><th><b>Losses</b></th><th><b>Closing Stock</b></th><th><b>No days out of stock</b></th>
<th><b>Order Quantity (Packs)</b></th><th><b>Order Quantity (Actual Units)</b></th><th><b>Order cost(Ksh)</b></th><th><b>Comment</b></th></tr> </thead><tbody>";

       
	   $html_body .='<ol type="a">' ;
       for($i=0;$i<$jay;$i++){
       	
       			 
       		if ($i==0) {
				$html_body .='<tr style="background-color:#C6DEFF;"> <td colspan="15" >
				 <li> '.$in[$i]['category_name'].' </li> </td></tr>'; 
			   }
       	
else if( $in[$i]['category_name']!=$in[$i-1]['category_name']){
       	 	$html_body .='<tr style="background-color:#C6DEFF;"> <td  colspan="15"> 
       	 	<li> '.$in[$i]['category_name'].' </li> </td></tr>';
       	 }
         $adj=$in[$i]['adjust'];
		 $c_stock=$in[$i]['c_stock'];
		 $o_t=$in[$i]['quantityOrdered'];
		 $o_q=$in[$i]['price'];
		 $o_bal=$in[$i]['o_balance'];
		 $t_re=$in[$i]['t_receipts'];
		 $t_issues=$in[$i]['t_issues'];
		 $losses=$in[$i]['losses'];
		 $total=$o_t*$in[$i]['total_units'];
		 
		if($o_bal==0 && $t_re==0 && $t_issues>0){
		 	$adj=$t_issues;
		 }
		 $c_stock=$o_bal+$t_re+$adj-$losses-$t_issues;
		 
		 if($c_stock<0){
		 	$adj=$c_stock*-1;
		 }
		  $c_stock=$o_bal+$t_re+$adj-$losses-$t_issues;
		 $html_body .="<tr>";
		 $html_body .="<td>".$in[$i]['kemsa_code']."</td>"; 	
		 
		  $html_body .="<td>".$in[$i]['drug_name']."</td>";
		  $html_body .="<td>".$in[$i]['unit_size']."</td>";
		  $ot=number_format($o_t*$o_q, 2, '.', ',');
		  $order_total=$order_total+($o_t*$o_q);
		  $html_body .="<td>$o_q</td>";
		  $html_body .="<td>". $o_bal."</td>"; 
		  $html_body .="<td>".$t_re."</td>";
		  $html_body .="<td>".$t_issues."</td>";
		  $html_body .="<td>".$adj."</td>";
		  $html_body .="<td>".$losses."</td>";
		  $html_body .="<td>".$c_stock."</td>";
		  $html_body .="<td>".$in[$i]['days']."</td>"; 
		  $html_body .="<td>$o_t</td>";
		  $html_body .="<td>$total</td>"; 
		  $html_body .="<td>$ot</td>"; 
		  $html_body .="<td>".$in[$i]['comment']."</td></tr>"; }

            
			
			$myobj_approve = Doctrine::getTable('User')->find($approver);
			$approve_name=$myobj_approve->email;
			$approve_name1=$myobj_approve->fname;
			$approve_name2=$myobj_approve->lname;
			$approve_telephone=$myobj_approve->telephone;

           $bal=$d_rights-$order_total;
		   $html_body .='</tbody></table></ol>'; 
		   $html_body1 ='<table class="data-table" width="100%" style="background-color:#FFF380;">
		  <tr style="background-color: 	#FFFFFF;" > <td colspan="4" >
		  <div style="float: left" > Total Order Value:</div>
		  <div style="float: right" >KSH '.number_format($order_total, 2, '.', ',').'</div></td></tr>
		   <tr style="background-color: 	#FFFFFF;"  > 
		   <td colspan="4" ><div style="float: left" > Drawing Rights Available Balance:</div>
		   <div style="float: right" >KSH		'.number_format($bal, 2, '.', ',').'</div> </td></tr>
		   <tr><td>FACILITY TEL NO:</td><td colspan="3">FACILITY EMAIL:</td></tr>
		   <tr><td >Prepared by (Name/Designation) '.$creator_name1.' '.$creator_name2.'
		   <br/>
		   <br/>Email: '.$creator_name.'</td><td>Tel: '.$creator_telephone.'</td><td>Date: '.date('d M, Y',strtotime ($o_date)).'</td><td>Signature</td>
		   </tr>
		   <tr><td>Checked by (Name/DPF/DPHN)
		   <br/>
		   <br/>Email</td><td>Tel</td><td>Date</td><td>Signature</td>
		   </tr>
		   <tr><td>Authorised by (Name/DMoH) '.$approve_name1.' '.$approve_name2.'
		   <br/>
		   <br/>Email: '.$approve_name.'</td><td>Tel: '.$approve_telephone.'</td><td>Date: '.date('d M, Y',strtotime ($a_date)).'</td><td>Signature</td></tr>
		   </table>';
		   
		 
		

		
		//now ganerate an order pdf from the generated report
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->defaultheaderline = 1;  
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML($html_body);
            $this->mpdf->AddPage();
			$this->mpdf->WriteHTML($html_body1);
			
			$report_name='updated_facility_order_no_'.$code.'_'.date('d-m-y');
		
		   if(isset($order_id_county)){
		   	$this->mpdf->Output('facility_order_no_'.$code.'_date_'.date('d-m-y',strtotime ($o_date)).'.pdf','D');
			exit;
			
		   }
		   else{
		  $myobj = Doctrine::getTable('Ordertbl')->find($code);
          $myobj->orderTotal =$order_total;
		  $myobj->orderStatus ="pending";
          $myobj->save();
		   }
		   
           		  
			if(!write_file( './pdf/'.$report_name.'.pdf',$this->mpdf->Output('$report_name','S')))
			{
				
		$this->session->set_flashdata('system_error_message', 'An error occured');			
        redirect("order_approval/district_orders");
 
             }
                  else{
			  
			  $subject='Update Order Report For '.$fac_name.' Date'.date('d-m-y');
 
  
  $attach_file='./pdf/'.$report_name.'.pdf';
    
  $message=$html_title.$html_body;
  
	$message_1='<br>Please find the order for  '.$fac_name.' which has been updated for approval 
		<br>
		<br>';
		
  
  $response= $this->send_order_submission_email($message_1.$message.$html_body1,$subject,$attach_file,$mfl);
    $this->send_order_sms();	
 if($response){
 	delete_files('./pdf/'.$report_name.'.pdf');
 }
					
  }

    }
else{
	//do nothing just update the order
}
	$this->session->set_flashdata('system_success_message', 'Your order # '.$code.' has been updated');	
	redirect('Order_Management/#tabs-1');
 
	
}

	public function moh_order_v(){
		
		$checker=$this->uri->segment(3);
		
			switch ($checker)
			{
				case 'pending':
					$data['order_list']=Ordertbl::get_pending_orders();
					break;
					case 'approved':
						$data['order_list']=Ordertbl::get_approved_orders();
					break;
						case 'dispatched':
						$data['order_list']=Ordertbl::get_dispatched_orders();
						break;
							case 'delivered':
							$data['order_list']=Ordertbl::get_delivered_orders();
							break;
								default :
								$data['order_list']=Ordertbl::get_all_orders_moh();				
			}
		
		$data['title'] = "Order View";
     	$data['content_view'] = "moh/moh_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "moh_order_v";
		$this -> load -> view("template", $data);
		}
	public function moh_order_details(){
/*	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("Select id, total_receipts from
(SELECT  DISTINCT
a.id, a.total_receipts
FROM facility_transaction_table a, ordertbl b, orderdetails c
WHERE a.facility_code = b.facilityCode
AND b.id = c.orderNumber
AND a.kemsa_code = c.kemsa_code 
AND a.availability=1 )AS tmptable");	

$test1=$inserttransaction;

$inserttransaction2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("Select id from
(SELECT DISTINCT
 c.id FROM facility_transaction_table a, ordertbl b, orderdetails c
WHERE a.facility_code = b.facilityCode
AND b.id = c.orderNumber
AND a.kemsa_code = c.kemsa_code 
AND a.availability=1) AS tmptable");
$test2=$inserttransaction2;	


$j= count($inserttransaction) ;

for ($i=0;$i<$j;$i++){
	//echo "update orderdetails  set orderdetails.quantityRecieved = '".$test1[$i]['total_receipts']."' where orderdetails.id='".$test2[$i]['id']."'";
	        $inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction1->execute("update orderdetails  set orderdetails.quantityRecieved = '".$test1[$i]['total_receipts']."' where orderdetails.id='".$test2[$i]['id']."'");
	
}
			
		exit;	
		
		
		$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select kemsa_code, id from facility_transaction_table ");
		$inserttransaction2 = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("select kemsa_code,id from drug ");
		
		$jay=count($inserttransaction);
		for($i=0;$i<$jay;$i++){
			$inserttransaction2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select id 
			from drug where kemsa_code='".$inserttransaction[$i]['kemsa_code']."'");
			$checker=count($inserttransaction2);
			
			if(empty($checker)){
				
			}
			else{
			$insertt = Doctrine_Manager::getInstance()
			->getCurrentConnection()
			->execute("update facility_transaction_table set kemsa_code=".$inserttransaction2[0]['id']." 
			where id=".$inserttransaction[$i]['id']."" );	
			echo " success update facility_transaction_table set kemsa_code=".$inserttransaction2[0]['id']." 
			where id=".$inserttransaction[$i]['id']."".'<br>';
			}
			
		}
		exit;
  
 $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select kemsa_code, id from facility_stock ");
		$inserttransaction2 = Doctrine_Manager::getInstance()->getCurrentConnection()->execute("select kemsa_code,id from drug ");
		
		$jay=count($inserttransaction);
		for($i=0;$i<$jay;$i++){
			$inserttransaction2 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select id 
			from drug where kemsa_code='".$inserttransaction[$i]['kemsa_code']."'");
			$checker=count($inserttransaction2);
			
			if(empty($checker)){
				
			}
			else{
			$insertt = Doctrine_Manager::getInstance()
			->getCurrentConnection()
			->execute("update facility_stock set kemsa_code=".$inserttransaction2[0]['id']." 
			where id=".$inserttransaction[$i]['id']."" );	
			echo " success update facility_stock set kemsa_code=".$inserttransaction2[0]['id']." 
			where id=".$inserttransaction[$i]['id']."".'<br>';
			}
			
		}
		exit;

	*/		
		
		$delivery=$this->uri->segment(3);
		$data['title'] = "Order detail View";
     	$data['content_view'] = "moh/moh_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['quick_link'] = "moh_order_v";
		$data['dates']=Ordertbl::get_dates($delivery);
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
		
	}
public function kemsa_order_details(){
		
		$delivery=$this->uri->segment(3);
		$data['title'] = "Order detail View";
     	$data['content_view'] = "kemsa/moh_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['quick_link'] = "moh_order_v";
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
		
	}
public function facility_order_v(){
		
		$data['title'] = "Order View";
     	$data['content_view'] = "moh_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['myClass'] = $this;
		$data['order_list']=Ordertbl::getFacilityOrder($this->uri->segment(3));
		$this -> load -> view("template", $data);
		}
public function facility_order_v2(){
		$facility_c=$this -> session -> userdata('news');
		$data['title'] = "Order View";
     	$data['content_view'] = "moh_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['myClass'] = $this;
		$data['quick_link'] = "moh_order_v";
		$data['order_list']=Ordertbl::getPendingDEtails($facility_c);
		$this -> load -> view("template", $data);
		}
		
//displays orders for the user to update them
public function all_deliveries() {
		$delivery=$this->uri->segment(3);
		//echo $delivery;
        $data['title'] = "All Deliveries";
        $data['content_view'] = "dispatched_listing_v";
        $data['banner_text'] = "Dispatched Orders";
        $data['link'] = "dispatched_listing_v";
		$data['myClass'] = $this;
        $data['order_list']=Kemsa_Order::get_facility_order($delivery);
        $data['quick_link'] = "dispatched_listing_v";
        $this -> load -> view("template", $data);
    }
//fetches the order that a user wants to update
    public function update_delivery_status() {
       
        $delivery=$this->uri->segment(3);
        $data['order']=$delivery;
        $data['order_ord']=Kemsa_Order_Details::get_order($delivery);
        $data['batch_no']=Kemsa_Order::get_batch_no($delivery);
        $data['title'] = "Update Delivery Status";
        $data['content_view'] = "update_delivery_status_v";
        $data['banner_text'] = "Update Status";
        $data['link'] = "order_management";
        $data['quick_link'] = "all_deliveries";
        $this -> load -> view("template", $data);
    }
	
	//dispatched table code
	public function dispatch_order(){
		$delivery=$this->uri->segment(3);
		$kemsa_order_no=$this->uri->segment(4);
		$data['dispatch_ord']=Facility_Dispatched_Details_View::getAll($kemsa_order_no);
		$data['batch_no']=Kemsa_Order::get_batch_no($delivery);
		$data['title'] = "Update Delivery Status";
        $data['content_view'] = "update_delivery_status_v";
        $data['banner_text'] = "Update Status";
        $data['link'] = "order_management";
		$data['order_list']=Kemsa_Order::get_facility_order($delivery);
        $data['quick_link'] = "all_deliveries";
        $this -> load -> view("template", $data);
	}
        //takes care of any discrepancy that might have occured with the order
public function discrepancy() {
		$data['title'] = "Shipment Discrepancy Report";
		$data['content_view'] = "discrepancy_v";
		$data['banner_text'] = "Discrepancy Report";
		/*$data['link'] = "order_management";
		$data['drug_categories'] = Drug_Category::getAll();*/
		$data['quick_link'] = "discrepancy_form";
		$this -> load -> view("template", $data);
	}
    function getWorkingDays($startDate,$endDate,$holidays){
    //The total number of days between the two dates. We compute the no. of seconds and divide it to 60*60*24
    //We add one to inlude both dates in the interval.
    if($startDate!=NULL && $endDate!=NULL){
    $days = ($endDate->getTimestamp() - $startDate->getTimestamp()) / 86400 + 1;
    $no_full_weeks = floor($days / 7);
    $no_remaining_days = fmod($days, 7);
    //It will return 1 if it's Monday,.. ,7 for Sunday
    $the_first_day_of_week = date("N",$startDate->getTimestamp());
    $the_last_day_of_week = date("N",$endDate->getTimestamp());

    // echo              $the_last_day_of_week;

    //---->The two can be equal in leap years when february has 29 days, the equal sign is added here

    //In the first case the whole interval is within a week, in the second case the interval falls in two weeks.

    if ($the_first_day_of_week <= $the_last_day_of_week){

        if ($the_first_day_of_week <= 6 && 6 <= $the_last_day_of_week) $no_remaining_days--;

        if ($the_first_day_of_week <= 7 && 7 <= $the_last_day_of_week) $no_remaining_days--;

    }
    else{

        if ($the_first_day_of_week <= 6) {

        //In the case when the interval falls in two weeks, there will be a Sunday for sure

            $no_remaining_days--;

        }

    }
    //The no. of business days is: (number of weeks between the two dates) * (5 working days) + the remainder

//---->february in none leap years gave a remainder of 0 but still calculated weekends between first and last day, this is one way to fix it

   $workingDays = $no_full_weeks * 5;

    if ($no_remaining_days > 0 )

    {

      $workingDays += $no_remaining_days;

    }
    //We subtract the holidays

/*    foreach($holidays as $holiday){

        $time_stamp=strtotime($holiday);

        //If the holiday doesn't fall in weeken

        if (strtotime($startDate) <= $time_stamp && $time_stamp <= strtotime($endDate) && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)

            $workingDays--;

    }*/
    return round ($workingDays-1);
    }
return NULL;
}
// District Order
	public function dist_order(){
		$data['title'] = "Order View";
     	$data['content_view'] = "dist_order_v";
		$data['banner_text'] = "Order View";
		$data['link'] = "home";
		$data['counties'] = Counties::getAll();
		$data['myClass'] = $this;
		$data['quick_link'] = "moh_order_v";
		$data['order_list']=Ordertbl::get_all_orders_moh();
		$this -> load -> view("template", $data);
	}
	public function dist_order_details(){
		
		$delivery=$this->uri->segment(3);
		$data['title'] = "Order detail View";
     	$data['content_view'] = "dist_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['quick_link'] = "moh_order_v";
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
		
	}
	public function o_list($pop_out_msg=NULL){
		$facility_c=$this -> session -> userdata('news');
		$data['popout'] =$pop_out_msg;
		$data['myClass'] = $this;
		$data['pending'] = Ordertbl::getPending($facility_c);
		$data['dispatched'] = Ordertbl::getDispatched($facility_c);
		$data['received']=Ordertbl::get_received($facility_c);
		$data['title'] = "All Orders";
		$data['quick_link'] = "order_listing";
		$data['content_view'] = "order_list_v";
		$data['banner_text'] = "All Orders";
		$data['link'] = "order_management"; 
		$this -> load -> view("template", $data);
	}
}
