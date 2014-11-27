<?php 
include_once 'auto_sms.php';
class Stock_Management extends auto_sms {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
	}
	
	
	public function reset_facility_details(){
		$facility_code=$this -> session -> userdata('news');
		
		$reset_facility_transaction_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_transaction_table->execute("DELETE FROM `facility_transaction_table` WHERE  facility_code=$facility_code; ");
	    
		$reset_facility_stock_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_stock_table->execute("DELETE FROM `facility_stock` WHERE  facility_code=$facility_code");
	    
		$reset_facility_issues_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_issues_table->execute("DELETE FROM `facility_issues` WHERE  facility_code=$facility_code;");
		
		$facility_order_details_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $facility_order_details_table->fetchAll("select id from `ordertbl` WHERE  facilityCode=$facility_code;");
		
		foreach ( $facility_order_details_table as $key => $value) {
		$reset_facility_order_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_order_table->execute("DELETE FROM `orderdetails` WHERE  orderNumber=$value; ");	
		}
	
	    $reset_facility_order_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_order_table->execute("DELETE FROM `ordertbl` WHERE  facilityCode=$facility_code; ");
		
		$reset_facility_historical_stock_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_historical_stock_table->execute("DELETE FROM `historical_stock` WHERE  facility_code=$facility_code; ");
		
		$reset_facility_update_stock_first_temp = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_update_stock_first_temp->execute("DELETE FROM `update_stock_first_temp` WHERE  facility_code=$facility_code; ");
		
		
		$this->session->set_flashdata('system_success_message', 'Facility Stock Details Have Been Reset');
		redirect('Home_Controller');
	}
	
	public function getTempStock(){
		$facility_code=$this -> session -> userdata('news');
		$result=Update_stock_first_temp::get_temp_stock($facility_code);
		echo json_encode($result);
	}
	
	
	//the facility is meant to update their stock level when they first run the system
	public function facility_first_run(){

		$data['title'] = "Update Stock Level on First Run";
     	$data['content_view'] = "facility/facility_data/update_stock_first_run";
		$data['banner_text'] = "Update Stock Level on First Run";
		$data['drugs'] = Drug::getAll();
		$data['quick_link'] = "update_stock_level";
		$this -> load -> view("template", $data);
	}
	public function add_stock_first_run()
	{
		
		$facility_c=$this -> session -> userdata('news');
		
		$kemsa_code=$_POST['drug_id'];
		$expiry_date=$_POST['expiry_date'];
		$batch_no=$_POST['batchNo'];
		$manuf=$_POST['manuf'];
		$a_stock=$_POST['qreceived'];

		$count=count($kemsa_code);
		
		
		$orderDate=date('y-m-d H:i:s');
	
		Facility_Transaction_Table::disable_facility_transaction_table($facility_c);
		Facility_Stock::disable_facility_stock($facility_c);
		
		for($i=0;$i<=$count;$i++){			
			if(isset($kemsa_code[$i])&&$kemsa_code[$i]!=''){				
			$mydata=array('facility_code'=>$facility_c,
			'kemsa_code'=>$kemsa_code[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manuf[$i],
			'expiry_date'=> date('y-m-d', strtotime($expiry_date[$i])),
			'balance'=>$a_stock[$i],
			'quantity'=>$a_stock[$i],
			'stock_date'=>$orderDate);			
			Facility_Stock::update_facility_stock($mydata);			
			}
		}
		//updating the facility transaction table
		
		$data=Facility_Stock::count_facility_stock($facility_c,$orderDate);    
		foreach ($data as $infor) {
			$mydata2=array('Facility_Code'=>$facility_c,
			'Kemsa_Code'=>$infor->kemsa_code,
			'Opening_Balance'=>$infor->quantity1,
			'Total_Issues'=>0,
			'Total_Receipts'=>0,
			'Closing_Stock'=>$infor->quantity1,
			'availability'=>1,
			'Cycle_Date'=>$orderDate);

			$mydata3 = array('facility_code'=>$facility_c,
			's11_No' => 'Physical Stock Count',
			'kemsa_code'=>$infor->kemsa_code,
			'batch_no' => 'N/A',
			'expiry_date' => 'N/A',
			'qty_issued' => 0,
			'balanceAsof'=>$infor->quantity1,
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('identity')
			);
			Facility_Issues::update_issues_table($mydata3);
			Facility_Transaction_Table::update_facility_table($mydata2);
			}		
		Update_stock_first_temp::delete_facility_temp(NULL,$facility_c);
		
//////////////////////////////////////////////////////////////////////////////////////////		
          $this->send_stock_update_sms();
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  redirect('stock_management/stock_level');	
////////////////////////////////////////////////////////////////////////////////////////
}

    public function facility_add_stock_data(){
    			
		$data['title'] = "Update Facility Stock data";
     	$data['content_view'] = "facility/facility_data/facility_add_stock_data";
		$data['banner_text'] = "Update Facility Stock data";
		$data['drugs'] = Drug::getAll();
		$this -> load -> view("template", $data);	
    }
	public function add_stock_level()
	{
		
		$facility_c=$this -> session -> userdata('news');
		
		$kemsa_code=$_POST['drug_id'];
		$expiry_date=$_POST['expiry_date'];
		$batch_no=$_POST['batchNo'];
		$manuf=$_POST['manuf'];
		$a_stock=$_POST['qreceived'];
		$count=count($kemsa_code);
		$orderDate=date('y-m-d H:i:s');
        
		for($i=0;$i<=$count;$i++){
			
			if(isset($kemsa_code[$i])&&$kemsa_code[$i]!=''){
			$mydata=array('facility_code'=>$facility_c,
			'kemsa_code'=>$kemsa_code[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manuf[$i],
			'expiry_date'=> date('y-m-d', strtotime($expiry_date[$i])),
			'balance'=>$a_stock[$i],
			'quantity'=>$a_stock[$i],
			'stock_date'=>$orderDate);
			
			Facility_Stock::update_facility_stock($mydata);
			
			$kemsa_code_=$kemsa_code[$i];
				
			
			$facility_has_commodity=Facility_Transaction_Table::get_if_drug_is_in_table($facility_c,$kemsa_code_);
			
			
		   
		   if($facility_has_commodity>0){
		  	$inserttransaction_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select `opening_balance` from `facility_transaction_table`
                                          WHERE `kemsa_code`= '$kemsa_code_' and availability='1' and facility_code=$facility_c; ");
		
			
			$new_value=$inserttransaction_1[0]['opening_balance']+$a_stock[$i];
			
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =$new_value
                                          WHERE `kemsa_code`= '$kemsa_code_' and availability='1' and facility_code=$facility_c; ");
                                          
           $inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(balance)
			 FROM facility_stock WHERE kemsa_code = '$kemsa_code_' and availability='1' and facility_code='$facility_c')
             WHERE `kemsa_code`= '$kemsa_code_' and availability='1' and facility_code ='$facility_c'; "); 
                                          
     
            $facility_stock=Facility_Stock::get_facility_drug_total($facility_c,$kemsa_code_)->toArray();	
		    
			
			$mydata=array('facility_code'=>$facility_c,
			's11_No' => 'Update Stock Level',
			'kemsa_code'=>$kemsa_code[$i],
			'receipts'=>$a_stock[$i],
			'batch_no'=>$batch_no[$i],
			'expiry_date'=> date('y-m-d ,', strtotime($expiry_date[$i])),
			'balanceAsof'=>$facility_stock[0]['balance'],
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('identity'));   
			Facility_Issues::update_issues_table($mydata);                                                   
		   }
		   else{
		   	$mydata3 = array('facility_code'=>$facility_c,
			's11_No' => 'Physical Stock Count',
			'kemsa_code'=>$kemsa_code_,
			'batch_no' => $batch_no[$i],
			'expiry_date' => date('y-m-d ,', strtotime($expiry_date[$i])),
			'qty_issued' => 0,
			'balanceAsof'=>$a_stock[$i],
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('identity')
			);
			Facility_Issues::update_issues_table($mydata3);
		   		
		   	
		   	$mydata2=array('Facility_Code'=>$facility_c,
			'Kemsa_Code'=>$kemsa_code_,
			'Opening_Balance'=>$a_stock[$i],
			'Total_Issues'=>0,
			'Total_Receipts'=>0,
			'Adj'=>0,
			'Closing_Stock'=>$a_stock[$i],
			'availability'=>1);
			
			Facility_Transaction_Table::update_facility_table($mydata2);
		   }
			
			}
			
	
			
			
			
		}
		
		
		Update_stock_first_temp::delete_facility_temp(NULL,$facility_c);
		//test
//////////////////////////////////////////////////////////////////////////////////////////
		
          $this->send_stock_update_sms();
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  redirect('stock_management/stock_level');	
		  
////////////////////////////////////////////////////////////////////////////////////////
}
 		
public function autosave_update(){
	$facility_code=$this -> session -> userdata('news');
	
        $unit_size=$_POST['unit_size'];	
	    $kemsa_code=$_POST['kemsa_code'];	
		$expiry_date=$_POST['expiry_date'];
		$batch_no=$_POST['batch_no'];
		$manuf=$_POST['manu'];
		$stock_level=$_POST['stock_level'];				
		$unit_count=$_POST['unit_count'];
		$drug_id=$_POST['drug_id'];
        $unit_issue=$_POST['unit_issue'];
		$category="N/A";
		
		$does_facility_have_this_drug_in_temp_table=Update_stock_first_temp::check_if_facility_has_drug_in_temp($drug_id, $facility_code,$batch_no);
	    
		
		if($does_facility_have_this_drug_in_temp_table>0){
			
		Update_stock_first_temp::update_facility_temp_data($expiry_date,$batch_no,$manuf,$stock_level,$unit_count,$drug_id,$facility_code,$unit_issue);	
		 echo "UPDATE SUCCESS  BATCH NO: $batch_no ";	
			
		}else{
			$mydata=array('facility_code'=>$facility_code,
			'kemsa_code'=>$kemsa_code,
			'batch_no'=>$batch_no,
			'manu'=>$manuf,
			'expiry_date'=> $expiry_date,
			'stock_level'=>$stock_level,
			'unit_count'=>$unit_count,
			'unit_size'=>$unit_size,
			'category'=>$category,
			'drug_id'=>$drug_id,
			'description'=>"N/A",
			'unit_issue'=> $unit_issue);
			
			 Update_stock_first_temp::update_temp($mydata);
			
	        echo "SUCCESS  BATCH NO: $batch_no";	
		}
	
	
		
}
public  function delete_temp_autosave(){
		if (isset($_POST['drugid'])) {
			$facilitycode=$_POST['facilitycode'];
			$drugid=$_POST['drugid'];			
			$batchNo=$_POST['batchNo'];	
			$detail = Update_stock_first_temp::delete_facility_temp($drugid, $facilitycode,$batchNo);
			
			
	}
else{
	echo $_POST['drugid'];
}
}

	// moh offical is able to see the stock level balance
		function stock_level_moh(){
     	$data['title'] = "Stock level";
     	$data['content_view'] = "moh/stock";
		$data['banner_text'] = "Stock Level";
		$data['quick_link'] ="load_stock";
		$data['link'] = "home";
		$data['stock_count']=Facility_Stock::count_all_facility_stock();
		$data['counties'] = Counties::getAll();
		$data['quick_link'] = "load_stock";
		$this -> load -> view("template", $data);
	}
	function county_stock(){
		$data['title'] = "Stock level";
     	$data['content_view'] = "stock";
		$data['banner_text'] = "Stock Level";
		$data['quick_link'] ="load_stock";
		$data['link'] = "home";
		$data['stock_count']=Facility_Stock::count_all_county_stock($this->uri->segment(3));
		$data['countytest']=$this->uri->segment(4);
		$data['counties'] = Counties::getAll();
		$data['quick_link'] = "load_stock";
		$this -> load -> view("template", $data);
	}
	function get_facility_stock(){
		$data['title'] = "Stock level";
     	$data['content_view'] = "moh/stock";
		$data['banner_text'] = "Stock Level";
		$data['quick_link'] ="load_stock";
		$data['link'] = "home";
		$data['stock_count']=Facility_Stock::count_facility_stock($this->uri->segment(3));
		$data['facility']=$this->uri->segment(4);
		$data['counties'] = Counties::getAll();
		$data['quick_link'] = "load_stock";
		$this -> load -> view("template", $data);
	}
	// after the user confirms the order, the stock table should be updated static facility code!!
	function update_stock_level(){
		$order_dispatched=$_POST['order_dispatched'];
		$kemsa_order_no=$_POST['kemsa_order_no'];
		$r_name=$_POST['r_name'];
		$r_pin=$_POST['r_pin'];
		$r_phone=$_POST['r_phone'];
		$order_deliver=$_POST['deliver_date'];
		
		$drugs_stock=Kemsa_Order_Details::get_stock_to_update($kemsa_order_no);
		$count= $drugs_stock->Count();
		$data_array=$drugs_stock->toArray();
		for($i=0;$i<$count;$i++){
			$mydata=array_merge($data_array[$i],array('facility_code'=>17948));
			Facility_Stock::update_facility_stock($mydata);
		
		}
	    /*$count=1;
		$data_array=NULL;
		foreach($drugs_stock as $drug){
			if($count==1){ 
			 $data=array('facility_code'=>17948,
			 'kemsa_code'=>$drug->kemsa_code,
			 'batch_no'=>$drug->batch_no,
			 'manufacture'=>$drug->manufacture,
			 'expiry_date'=>$drug->expiry_date,
			 'quantity'=>$drug->quantity);
			
			 $data_array=array(); 
			 
			 $data_array=array_merge($data,$data_array);
			  
			 $count++;
			}
			else{
				
			$data=array('facility_code'=>17948,
			 'kemsa_code'=>$drug->kemsa_code,
			 'batch_no'=>$drug->batch_no,
			 'manufacture'=>$drug->manufacture,
			 'expiry_date'=>$drug->expiry_date,
			 'quantity'=>$drug->quantity);
			 $data_array=array_merge($data,$data_array);
            }
        
		}
		print_r($data_array);
		exit;
		    $status=*/
			
		     if($status==TRUE){     	
				 redirect('stock_management/stock_level');	
		     }
	}
public function stock_level($msg=Null){
	    $facility_c=$this -> session -> userdata('news');
		$checker=$this->uri->segment(3);
		$data['title'] = "Stock";
		$data['content_view'] = "facility/facility_data/stock_level_v";
		$data['banner_text'] = "Physical Stock";
		$data['link'] = "order_management";
		if(isset($msg)){
			$data['msg']=$msg;
			$data['update']='update stock levels';
		}
		if($msg==NULL){
		$data['update']=NULL;
		$data['msg']=" ";
		$data['checker']="no_order";	
		}
		 if($checker=="v"){
			$data['msg']="Verify that the system stock levels are the same as your physical stock count";
			$data['update']='update stock levels';
		}
		 if($msg=='c0N123'){
		 	$data['update']=NULL;
		 	$data['msg']="Please confirm your stock details before placing your order";
		 }
		$data['facility_order'] = Facility_Transaction_Table::get_all($facility_c);
		$data['max_date'] = Facility_Stock::get_max_date($facility_c)->toArray();
		$data['name_of_person'] = Facility_Issues::get_last_person_who_issues($facility_c);
	
		//$data['quick_link'] = "stock_level";
		$this -> load -> view("template", $data);

	}
public function allProducts(){
	
		$data['title'] = "Stock";
		$data['content_view'] = "all_products";
		$data['banner_text'] = "View Products";	
		$data['quick_link'] = "all_products";
		$data['drug_categories'] = Drug_Category::getAll();
		$this -> load -> view("template", $data);
}
public function new_update(){
		$id=$this->uri->segment(3);
		$data['title'] = "Update Deliveries";
		$data['content_view'] = "new_update";
		$data['banner_text'] = "Update Order Delivery";	
		$data['quick_link'] = "new_update";	
		$data['ord']=Ordertbl::get_details($id);
		$data['order_details']=Orderdetails::get_order_details($id);			
		$data['drugs'] = Drug::getAll();
		$this -> load -> view("template", $data);
}
//getting the socks of a facility
public function get_facility_stock_details($confirmation_message=NULL){
	    $facility_code=$this -> session -> userdata('news');
	    $data['title'] = "Edit Stock Details";
		$data['content_view'] = "facility/facility_reports/facility_stock_detail_v";
		$data['banner_text'] = "Edit Stock Details";	
		$data['confirmation_message']=$confirmation_message;
		$data['facility_stock_details']=facility_stock::get_facility_stock_detail($facility_code);			
		$this -> load -> view("template", $data);
}
public function update_facility_stock_details(){
	 $id=$_POST['id'];
	 $durg_id=$_POST['kemsa_code'];
	 $batch_no=$_POST['batch_no'];
	 $manufacturer=$_POST['manufacturer'];
	 $expiry_date=$_POST['expiry_date'];
	 $stock_level=$_POST['stock_level'];
	  $delete=$_POST['delete'] ;
	 
	 $access_level = $this -> session -> userdata('user_type_id');
	 $facility_code=$this -> session -> userdata('news');

	 foreach ( $id as $key => $value) {
	
	if($delete[$key]==1):
	

	    $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->execute("update facility_transaction_table t, 
		(select `opening_balance`,`closing_stock` from facility_transaction_table 
		where facility_code='$facility_code' and kemsa_code=$durg_id[$key] and availability=1) temp
		 set t. `opening_balance`=temp.`opening_balance`-$stock_level[$key] and t. `closing_stock`=temp.`closing_stock`-$stock_level[$key] 
		 where t.facility_code='$facility_code' and t.kemsa_code=$durg_id[$key] and t.availability=1");
		 
          $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->execute("delete from facility_stock where id=$id[$key]"); 

	
	 else:
	     $expiry_date[$key]=str_replace(",", " ", $expiry_date[$key]);
		 $myobj = Doctrine::getTable('Facility_Stock')->find($id[$key]);
         $myobj->batch_no=$batch_no[$key] ;
		 $myobj->manufacture=$manufacturer[$key];
		 $myobj->expiry_date=date('y-m-d',strtotime($expiry_date[$key]));
         $myobj->save(); 
		
	 endif;

	 }

	$this->session->set_flashdata('system_success_message', 'Stock Details Have Been Updated');
	redirect('stock_management/get_facility_stock_details');
	 
	//$this->get_facility_stock_details($confirmation_message="Stock Details Have Been Updated");
	
}
//////////
public function historical_stock_take(){
		$facility_code=$this -> session -> userdata('news');
		
		$data['title'] = "Provide Historical Stock Data";
     	$data['content_view'] = "facility/historical_stock_v";
		$data['banner_text'] = "Provide Historical Stock Data";
		$data['quick_link'] ="load_stock";
		$data['link'] = "home";
		$data['drugs'] = Drug::getAll();
		$data['drug_name']=Drug::get_drug_name();
		$data['drug_categories'] = Drug_Category::getAll();
		$data['historical_data'] = Historical_Stock::load_historical_stock($facility_code);
		
		$data['quick_link'] = "update_stock_level";
		$this -> load -> view("template", $data);

	}
	public function save_historical_stock(){
		$data_array=$_POST['data_array'];
		$h_stock=explode("|", $data_array);
	    $code=$h_stock[0];
		$facilityCode=$this -> session -> userdata('news');

		$query = Doctrine_Query::create() -> select("drug_id, consumption_level") -> from("historical_stock") -> where("facility_code=$facilityCode")->andwhere("drug_id=$h_stock[0]");
		$stocktake = $query ->execute();

		if (count($stocktake)>0) {
			$update = Doctrine_Manager::getInstance()->getCurrentConnection();
		//$update->execute("UPDATE historical_stock SET consumption_level=$h_stock[1], unit_count=$h_stock[3] where facility_code=$facility_code AND drug_id=$h_stock[0]");
      	$q = Doctrine_Query::create()
			->update('historical_stock')
				->set('consumption_level','?',"$h_stock[1]")
				->set('unit_count','?',"$h_stock[3]")
				->set('selected_option','?',"$h_stock[4]")
					->where("facility_code='$facilityCode' AND drug_id='$h_stock[0]'");
						$q->execute();

		} else if (count($stocktake)==0) {
			$data=$h_stock[2];
			
			$data='"'.$data.'"';
			$insert = Doctrine_Manager::getInstance()->getCurrentConnection();
		$insert->execute("INSERT INTO historical_stock (`facility_code`, `drug_id`, `unit_size`, `consumption_level`, `unit_count`, `selected_option`) 
		VALUES ('".$facilityCode."', '".$h_stock[0]."', ".$data.", '".$h_stock[1]."',".$h_stock[3].", '".$h_stock[4]."')");
		}
		
		echo 'success consumption_level= '.$h_stock[1].'unit_count= '.$h_stock[3].'drug_id= '.$h_stock[0].'selected_option= '.$h_stock[4];
	}
public function fake_historical_response(){
	$this->session->set_flashdata('system_success_message', "Historical Stock Details Have Been Saved");
	redirect('home_controller');
}

}
?>