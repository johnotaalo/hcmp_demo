<?php

/**
 * @author Kariuki
 */
if (!defined('BASEPATH'))
exit('No direct script access allowed');
class Stock extends MY_Controller {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		$this->load->library(array('hcmp_functions','form_validation'));
		$this -> load -> database();
		ini_set("max_execution_time", "1000000");
		ini_set("memory_limit", '2048M');
	}
	public function index(){
		
	}	
	
/*
|--------------------------------------------------------------------------
| update facility stock 
|--------------------------------------------------------------------------
|0. Set up the facility stock
|1. load the view
|2. check if the user has any temp data
|3. auto save the data
|4. save the data in the facility stock, facility transaction , issues table
*/	
	public function import($facility_code=null){
		
		//redirect("stock/facility_stock_first_run/first_run");
		
		$facility_code=isset($facility_code)? $facility_code : $this -> session -> userdata('facility_id'); 

		$reset_facility_historical_stock_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_historical_stock_table->execute("DELETE FROM `facility_monthly_stock` WHERE  facility_code=$facility_code; ");
		$reset_facility_issues_table = Doctrine_Manager::getInstance()->getCurrentConnection();
	    $reset_facility_issues_table->execute("DELETE FROM `facility_issues` WHERE  facility_code=$facility_code;");

		$old_facility_stock=facility_stocks::import_stock_from_v1($facility_code);
		$old_facility_issues=facility_stocks::import_issues_from_v1($facility_code);
        $old_facility_orders=Doctrine_Manager::getInstance()->getCurrentConnection()
        ->fetchAll("select 
        *
        from
        kemsa2.ordertbl
        where ordertbl.facilityCode = $facility_code");;
		$in_to_stock=$in_to_amc=$in_to_issues=$amc_ids=$in_to_orders=array();

		if(count($old_facility_stock)>0){
			foreach($old_facility_stock as $old_facility_stock){
			if(isset($old_facility_stock['new_id'])):
			$temp=array('commodity_id'=>$old_facility_stock['new_id'],
			             'facility_code'=>$old_facility_stock['facility_code'],
						 'unit_size'=>$old_facility_stock['unit_size_'],
						 'batch_no'=>($old_facility_stock['batch_no']=='') ? 'N/A': $old_facility_stock['batch_no'],
						 'manu'=>($old_facility_stock['manufacture']=='') ? 'N/A': $old_facility_stock['manufacture'],
						 'expiry_date'=>date('d My',strtotime($old_facility_stock['expiry_date'])),
						 'stock_level'=>($old_facility_stock['balance']<0? 0: $old_facility_stock['balance']),
						 'total_unit_count'=>$old_facility_stock['new_total_units'],
						 'unit_issue'=>'Unit_Size',
						 'total_units'=>($old_facility_stock['balance']<0? 0: $old_facility_stock['balance']),
						 'source_of_item'=>1,
						 'supplier'=>'KEMSA');	
			array_push($in_to_stock,$temp);
			if(!array_key_exists('new_id'.$old_facility_stock['new_id'], $amc_ids)){
			$old_amc=facility_stocks::import_amc_from_v1($facility_code,$old_facility_stock['old_id']);

			$new_units=	($old_amc[0]['old_total_units']!=$old_amc[0]['new_total_units']) 
			? round(($old_amc[0]['consumption_level']*$old_amc[0]['old_total_units'])/$old_amc[0]['new_total_units']):$old_amc[0]['unit_count'] ;
				
			$temp=array('commodity_id'=>$old_facility_stock['new_id'],
			             'facility_code'=>$old_facility_stock['facility_code'],
			             'consumption_level'=>isset($old_amc[0]['consumption_level']) ?$old_amc[0]['consumption_level'] :0,
						 'selected_option'=>isset($old_amc[0]['selected_option'])? $old_amc[0]['selected_option']: "Pack_Size",
						 'total_units'=>isset($new_units) ? $new_units :0);		
			
			array_push($in_to_amc,$temp);
		    $amc_ids=	array_merge($amc_ids,array('new_id'.$old_facility_stock['new_id']=>'new_id'.$old_facility_stock['new_id']));
			}
			endif;
			}

       $this -> db -> insert_batch('facility_monthly_stock', $in_to_amc);
       $this -> db -> insert_batch('facility_stocks_temp', $in_to_stock);  
		}
  
		if(count($old_facility_issues)){
		foreach($old_facility_issues as $old_facility_issues){
			$temp=array('commodity_id'=>$old_facility_issues['new_id'],
						 's11_No'=>$old_facility_issues['s11_No'],
			             'facility_code'=>$old_facility_issues['facility_code'],
			             'batch_no'=>isset($old_facility_issues['batch_no']) ?$old_facility_issues['batch_no'] :'N/A',
						 'expiry_date'=>strtotime($old_facility_issues['expiry_date'])? $old_facility_issues['expiry_date']: "N/A",
						 'balance_as_of'=>$old_facility_issues['balanceAsof'],
						 'qty_issued'=>$old_facility_issues['qty_issued'],
						 'date_issued'=>$old_facility_issues['date_issued'],
						 'issued_to'=>$old_facility_issues['issued_to'],
						 'created_at'=>$old_facility_issues['created_at'],
						 'issued_by'=>$old_facility_issues['issued_by'],
						 'status'=>2
						 );	
		array_push($in_to_issues,$temp);
		}
	    $this -> db -> insert_batch('facility_issues', $in_to_issues);
		}
        if(count($old_facility_orders)>0){
         foreach($old_facility_orders as $old_facility_orders){
             $order_status=$old_facility_orders["orderStatus"];
             $name=$old_facility_orders["reciever_name"];
             $new_order_id=Doctrine_Manager::getInstance()->getCurrentConnection()
        ->fetchAll('select 
        *
        from
        hcmp_rtk.facility_order_status
        where facility_order_status.status_desc like "%'.$order_status.'%"');
         $new_name_id=Doctrine_Manager::getInstance()->getCurrentConnection()
        ->fetchAll('select 
        *
        from
        kemsa2.user
        where concat (user.fname," ",user.lname) like "%'.$name.'%"');
          $temp=array('order_date'=>$old_facility_orders['orderDate'],
                         'approval_date'=>$old_facility_orders['approvalDate'],
                         'dispatch_date'=>$old_facility_orders['dispatchDate'],
                         'deliver_date'=>$old_facility_orders['deliverDate'],
                         'dispatch_update_date'=>$old_facility_orders['dispatch_update_date'],
                         'facility_code'=>$old_facility_orders['facilityCode'],
                         'order_no'=>$old_facility_orders['order_no'],
                         'workload'=>$old_facility_orders['workload'],
                         'bed_capacity'=>$old_facility_orders['bedcapacity'],
                         'kemsa_order_id'=>$old_facility_orders['kemsaOrderid'],
                         'reciever_id'=>count($new_name_id)>0?$new_name_id[0]['id'] :NULL,
                         'drawing_rights'=>$old_facility_orders['drawing_rights'],
                         'ordered_by'=>$old_facility_orders['orderby'],
                         'approved_by'=>$old_facility_orders['approveby'],
                         'dispatch_by'=>$old_facility_orders['dispatchby'],
                         'warehouse'=>$old_facility_orders['warehouse'],
                         'source'=>1,
                         'deliver_total'=>$old_facility_orders['total_delivered'],
                         'status'=> $new_order_id[0]['id'],
                         'order_total'=>$old_facility_orders["orderTotal"]
                         ); 
         
                    $this -> db -> insert('facility_orders', $temp);
                    $new_order_no = $this -> db -> insert_id();
                    
              $order_details_match=Doctrine_Manager::getInstance()->getCurrentConnection()
        ->fetchAll("select 
         *
        from
         kemsa2.orderdetails
        left join
        hcmp_rtk.drug_commodity_map ON drug_commodity_map.old_id = orderdetails.kemsa_code
        where orderdetails.orderNumber =".$old_facility_orders['id']);
        
        foreach($order_details_match as $order_details_match){
          $temp_array = array("commodity_id" => $order_details_match['new_id'],
          'quantity_ordered_pack' => round($order_details_match['quantityOrdered']), 
          'quantity_ordered_unit' => $order_details_match['quantityOrdered']*$order_details_match['new_total_units'], 
          'quantity_recieved' => $order_details_match['quantityRecieved'], 'price' => $order_details_match['new_price'], 
          'o_balance' => $order_details_match['o_balance'], 't_receipts' => $order_details_match['t_receipts'],
          't_issues' => $order_details_match['t_issues'], 'adjustpve' => 0,
           'adjustnve' => 0, 'losses' => $order_details_match['losses'], 
           'days' => $order_details_match['days'], 'c_stock' => $order_details_match['c_stock'], 
           'comment' => $order_details_match['comment'], 's_quantity' => $order_details_match['s_quantity'], 
           'amc' => $order_details_match['historical_consumption'], 'order_number_id' => $new_order_no);
        array_push($in_to_orders,$temp_array);  
        }
      
         } 
       $this -> db -> insert_batch('facility_order_details', $in_to_orders); 
        }

		
        redirect("stock/facility_stock_first_run/first_run/import");
	}
/*
|--------------------------------------------------------------------------
| update facility stock 
|--------------------------------------------------------------------------
|0. Set up the facility stock
|1. load the view
|2. check if the user has any temp data
|3. auto save the data
|4. save the data in the facility stock, facility transaction , issues table
*/
     public function set_up_facility_stock(){
         $facility_code=$this -> session -> userdata('facility_id'); 
        $data['title'] = "Set up facility stock";
         $data['content_view'] = "facility/facility_stock_data/set_up_facility_stock_v";
        $data['banner_text'] = "Set up facility stock";
        $data['commodities']= commodities::set_facility_stock_data_amc($facility_code);
        $this -> load -> view("shared_files/template/template", $data);        
     }
     public function save_set_up_facility_stock($checker=null){
     //security check      
if($this->input->is_ajax_request()):
        $commodity_id=$this->input->post('commodity_id');
        $consumption_level=$this->input->post('consumption_level');
        $selected_option=$this->input->post('selected_option');
        $total_units=$this->input->post('total_units');
        $facility_code=$this -> session -> userdata('facility_id'); 
        if($checker=='delete'): // check if the user has uncheked an option
        $insert = Doctrine_Manager::getInstance()->getCurrentConnection();
        $insert->execute("delete from  facility_monthly_stock where facility_code='$facility_code' AND commodity_id='$commodity_id'");
        else:
        //check if this commodity exits in the db
        $query = Doctrine_Query::create() -> select("id") -> from("facility_monthly_stock")
        -> where("facility_code=$facility_code")->andwhere("commodity_id=$commodity_id");
        $stocktake = $query ->execute(); $count=count($stocktake);
        if ($count>0) {
        $update = Doctrine_Manager::getInstance()->getCurrentConnection();
          $q = Doctrine_Query::create()
            ->update('facility_monthly_stock')
                ->set('consumption_level','?',"$consumption_level")
                ->set('selected_option','?',"$selected_option")
                ->set('total_units','?',"$total_units")
                ->where("facility_code='$facility_code' AND commodity_id='$commodity_id'");
                 $q->execute();
        } else if ($count==0) {
        $insert = Doctrine_Manager::getInstance()->getCurrentConnection();
        $insert->execute("INSERT INTO facility_monthly_stock 
        (`facility_code`, `commodity_id`, `consumption_level`, `total_units`, `selected_option`) 
        VALUES ('$facility_code', $commodity_id,'$consumption_level', $total_units,'$selected_option')");
        }    
                  
endif;    
      echo 'success ';
endif;
     }

	 public function facility_stock_first_run($checker,$import=null){
	 	 $facility_code=$this -> session -> userdata('facility_id'); 
	 	$which_view_to_load=($checker=='first_run')?"facility/facility_stock_data/update_facility_stock_on_first_run_v" :
		"facility/facility_stock_data/update_facility_stock_v";
	    $data['title'] = "Update Stock Level";
     	$data['content_view'] = $which_view_to_load;
		$data['banner_text'] = "Update Stock Level";
		$data['commodities'] = Commodities::get_facility_commodities($facility_code);
		$data['commodity_source']=commodity_source::get_all();
        $data['import']=$import;
		$this -> load -> view("shared_files/template/template", $data);	
		
	}
    public function update_stock_via_excel(){
   
    if(isset($_FILES['file']) && $_FILES['file']['size'] > 0){ 
    $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
    $excel2=$objPHPExcel= $excel2->load($_FILES["file"]["tmp_name"]); // Empty Sheet
        
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
    
    $highestColumn = $sheet->getHighestColumn();
    $temp=array();
    //  Loop through each row of the worksheet in turn
    for ($row = 2; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);                            
    if($rowData[0][11]==0){
       $unit_of_issue="Pack_Size";
       $total_units=$rowData[0][11];
       $stock_level=$rowData[0][10];
    }elseif($rowData[0][10]>=1){
       $unit_of_issue="Unit_Size";
       $total_units=$rowData[0][10]*$rowData[0][6];
       $stock_level=$rowData[0][10]; 
    }
   
     $InvDate = date('t M Y', PHPExcel_Shared_Date::ExcelToPHP($rowData[0][9])); 
 
    array_push($temp,array('commodity_id'=>$rowData[0][0],
    'unit_size'=>$rowData[0][5],
    'batch_no'=>$rowData[0][7],
    'manu'=>$rowData[0][8],
    'expiry_date'=>$InvDate,
    'stock_level'=>$stock_level,
    'total_unit_count'=>$rowData[0][6],
    'unit_issue'=>$unit_of_issue,
    'total_units'=>$total_units,
    'source_of_item'=>$rowData[0][3],
    'supplier'=>$rowData[0][2],));
    }

     unset($objPHPExcel);
   
     $this->autosave_update_stock($temp,$this -> session -> userdata('facility_id'));
    
        }

    }	//auto save the data here
	 public function autosave_update_stock($excel_data=null,$facility_code=null){
        if(isset($excel_data)):
		foreach($excel_data as $row_data):
        //get the data
        $does_facility_have_this_drug_in_temp_table=
        $this->does_facility_have_this_drug_in_temp_table($row_data['commodity_id'], $excel_data['facility_code'], $row_data['batch_no']);
        if($does_facility_have_this_drug_in_temp_table>0):
        //send the data to the db
        $this->update_batch_in_temp($row_data['expiry_date'], $row_data['batch_no'], $row_data['manu'], $row_data['stock_level'], 
        $row_data['total_unit_count'], $row_data['commodity_id'], $facility_code,
        $row_data['unit_issue'], $row_data['total_units'], $row_data['source_of_item'], $row_data['supplier']);                   
        
        else:
        //save the data
        $mydata=array('facility_code'=>$facility_code,
        'commodity_id'=>$row_data['commodity_id'],
        'batch_no'=>$row_data['batch_no'],
        'manu'=>$row_data['manu'],
        'expiry_date'=> $row_data['expiry_date'],
        'stock_level'=>$row_data['stock_level'],
        'total_unit_count'=>$row_data['total_unit_count'],
        'unit_size'=> $row_data['unit_size'],
        'unit_issue'=>  $row_data['unit_issue'],
        'total_units'=>$row_data['total_units'],
        'source_of_item'=>$row_data['source_of_item'],
        'supplier'=>$row_data['supplier']);
        $this->save_batch_in_temp($mydata);     
        endif;
        endforeach;
        redirect('stock/facility_stock_first_run/first_run');
        elseif(!isset($excel_data)):
        $facility_code=$this -> session -> userdata('facility_id'); 
        $commodity_id=$this->input->post('commodity_id');
        $unit_size=$this->input->post('unit_size');
        $expiry_date=$this->input->post('expiry_date');
        $batch_no=$this->input->post('batch_no');
        $manu=$this->input->post('manuf');
        $stock_level=$this->input->post('stock_level');
        $total_unit_count=$this->input->post('total_units_count');      
        $unit_issue=$this->input->post('unit_issue');       
        $total_units=$this->input->post('total_units');
        $source_of_item=$this->input->post('source_of_item');
        $supplier=$this->input->post('supplier');
        
        $mydata=array('facility_code'=>$facility_code,
        'commodity_id'=>$commodity_id,
        'batch_no'=>$batch_no,
        'manu'=>$manu,
        'expiry_date'=> $expiry_date,
        'stock_level'=>$stock_level,
        'total_unit_count'=>$total_unit_count,
        'unit_size'=>$unit_size,
        'unit_issue'=> $unit_issue,
        'total_units'=>$total_units,
        'source_of_item'=>$source_of_item,
        'supplier'=>$supplier);
         //get the data
        $does_facility_have_this_drug_in_temp_table=$this->does_facility_have_this_drug_in_temp_table($commodity_id, $facility_code, $batch_no);
        if($does_facility_have_this_drug_in_temp_table>0):
        //send the data to the db
        $this->update_batch_in_temp($expiry_date, $batch_no, $manu, $stock_level, 
        $total_unit_count, $commodity_id, $facility_code, $unit_issue, $total_units, $source_of_item, $supplier);                   
        echo "UPDATE SUCCESS BATCH NO: $batch_no ";         
        else:
        //save the data
        $this->save_batch_in_temp($mydata);     
        echo "SUCCESS UPDATE BATCH NO: $batch_no";
        endif;
        endif;
 }
 public function does_facility_have_this_drug_in_temp_table($commodity_id, $facility_code,$batch_no){
     return facility_stocks_temp::check_if_facility_has_drug_in_temp($commodity_id, $facility_code,$batch_no);
     
 }
 public function update_batch_in_temp($expiry_date,$batch_no,$manu,
        $stock_level,$total_unit_count,$commodity_id,$facility_code,$unit_issue,$total_units,$source_of_item,$supplier){
        facility_stocks_temp::update_facility_temp_data($expiry_date,$batch_no,$manu,
        $stock_level,$total_unit_count,$commodity_id,$facility_code,$unit_issue,$total_units,$source_of_item,$supplier);
     
 }
  public function save_batch_in_temp($mydata){
       facility_stocks_temp::update_temp($mydata);
  }      
    // get the temp data load it up incase the user had autosaved the data
  public function get_temp_stock_data_json(){
//security check	
if($this->input->is_ajax_request()):
	   $facility_code=$this -> session -> userdata('facility_id'); 
		$result=facility_stocks_temp::get_temp_stock($facility_code);
		echo json_encode($result);
endif;
	}//delete the temp data here
 public  function delete_temp_autosave(){
 //security check	
 if($this->input->is_ajax_request()):
		    $facility_code=$this -> session -> userdata('facility_id');      
			$commodity_id=$this->input->post('commodity_id');			
			$commodity_batch_no=$this->input->post('commodity_batch_no');	
			//delete the record from the db
			facility_stocks_temp::delete_facility_temp($commodity_id, $commodity_batch_no,$facility_code);
			echo "SUCCESS DELETE BATCH NO: $commodity_batch_no";
 endif;
}// finally add the stock here, the final step to the first step of new facilities getting on board
    public function add_stock_level()
{ // $facility_code=$this -> session -> userdata('news');  //security check 
if($this->input->post('commodity_id')):
	     $facility_code=$this -> session -> userdata('facility_id'); 
         $form_type=$this->input->post('form_type'); 
	     $commodity_id=array_values($this->input->post('desc'));  //this rearranges the array such that the index starts at 0     
		 $expiry_date=array_values($this->input->post('clone_datepicker'));
		 $batch_no=array_values($this->input->post('commodity_batch_no'));
		 $manu=array_values($this->input->post('commodity_manufacture'));
		 $total_unit_count=array_values($this->input->post('commodity_total_units'));		
		 $source_of_item=array_values($this->input->post('source_of_item'));
		 $date_of_entry_=($form_type=='first_run') ? date('y-m-d H:i:s') : array_values($this->input->post('date_received'));
	
         $count=count($commodity_id);
		 $commodity_id_array=$data_array_facility_issues=$data_array_facility_transaction=array(); 

         //collect n set the data in the array
		for($i=0;$i<$count;$i++):
			$status=($total_unit_count[$i]>0)? true: false;
            $status=($status && strtotime(str_replace(",", " ",$expiry_date[$i]))>strtotime('now'))? 1:2;
            $date_of_entry=($form_type=='first_run') ? date('y-m-d H:i:s') :date('Y-m-d',strtotime($date_of_entry_[$i])) ;
			$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'initial_quantity'=>$total_unit_count[$i],
			'current_balance'=>$total_unit_count[$i],
			'source_of_commodity'=>$source_of_item[$i],
			'date_added'=>$date_of_entry,
			'status' =>$status);
			
             //get the closing stock of the given item  
            $facility_stock_=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id[$i], $date_of_entry)->toArray();
			//update the facility stock table
			facility_stocks::update_facility_stock($mydata);			
			//check	
			$facility_has_commodity=facility_transaction_table::get_if_commodity_is_in_table($facility_code,$commodity_id[$i]);
     
			$total_unit_count_=$total_unit_count[$i]*-1;
	
          if($facility_has_commodity>0 && $status==1): //update the opening balance for the transaction table 
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =`opening_balance`+$total_unit_count[$i],
			`closing_stock` =`closing_stock`+$total_unit_count[$i]
            WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code=$facility_code");  
            $mydata_=array('facility_code'=>$facility_code,
            's11_No' =>  '(+ve Adj) Stock Addition',
            'commodity_id'=>$commodity_id[$i],
            'batch_no'=>(!isset($batch_no[$i])) ? "N/A" : $batch_no[$i],
            'expiry_date'=>  date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
            'balance_as_of'=>isset($facility_stock_[0]['commodity_balance']) ? $facility_stock_[0]['commodity_balance']: 0,
            'qty_issued' => $total_unit_count_,
            'date_issued' => date('y-m-d'),
            'issued_to' => 'N/A',
            'issued_by' =>$this -> session -> userdata('user_id') ); 
             //create the array to push to the db
            array_push($data_array_facility_issues, $mydata_);                                                  		   
else:       //get the data to send to the facility_transaction_table
		    if($status==1):
		    $mydata2=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'opening_balance'=>$total_unit_count[$i],
			'total_issues'=>0,
			'total_receipts'=>0,
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$total_unit_count[$i],
			'status'=>1);	//send the data to the facility_transaction_table		
            $this -> db -> insert('facility_transaction_table', $mydata2);
            $mydata_=array('facility_code'=>$facility_code,
            's11_No' =>  ($form_type=='first_run') ? 'initial stock update' : '(+ve Adj) Stock Addition',
            'commodity_id'=>$commodity_id[$i],
            'batch_no'=>($form_type=='first_run') ? "N/A" : $batch_no[$i],
            'expiry_date'=>  ($form_type=='first_run') ? 'N/A' : date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
            'balance_as_of'=>isset($facility_stock_[0]['commodity_balance']) ? $facility_stock_[0]['commodity_balance']: 0,
            'qty_issued' => $total_unit_count_,
            'date_issued' => date('y-m-d'),
            'issued_to' => 'N/A',
            'issued_by' =>$this -> session -> userdata('user_id') ); 
             //create the array to push to the db
            array_push($data_array_facility_issues, $mydata_); 
endif; 	
endif;			
endfor;		 

            $this -> db -> insert_batch('facility_issues', $data_array_facility_issues); 	
            //delete the record from the db
		    facility_stocks_temp::delete_facility_temp(null, null,$facility_code);
          //set the notifications
		  //$this->hcmp_functions->send_stock_update_sms();
        $updateCase = Doctrine_Manager::getInstance()->getCurrentConnection();
        $updateCase->execute("UPDATE facility_stocks SET 
        manufacture=CONCAT(UCASE(SUBSTRING(`manufacture`, 1, 1)),LOWER(SUBSTRING(`manufacture`, 2)))");      //
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  redirect('reports/facility_stock_data');			  
endif;

}
/*
|------------------------------------------------------------------------
| End of update facility stock on first run and  more_stock_level
|-------------------------------------------------------------------------
 Next section ADDING MORE FACILITY STOCK Inter-facility donation
*/
        public function add_more_stock_level_external(){
	    if($this->input->post('facility_stock_id')):	
		 $facility_stock_id=$this->input->post('facility_stock_id');
	     $facility_code=$this -> session -> userdata('facility_id'); 
	     $commodity_id=array_values($this->input->post('commodity_id'));
		 $expiry_date=array_values($this->input->post('clone_datepicker'));
		 $batch_no=array_values($this->input->post('commodity_batch_no'));
		 $manu=array_values($this->input->post('commodity_manufacture'));
		 $total_unit_count=array_values($this->input->post('actual_quantity'));				 
		 $service_point=array_values($this->input->post('service_point'));
		 $source_of_item=array_values($this->input->post('source_of_item'));
         $count=count($commodity_id);
		 $date_of_entry=date('y-m-d H:i:s');
         //collect n set the data in the array
		for($i=0;$i<$count;$i++):

		   if($total_unit_count[$i]>0)://check if the balance is more than 0 ie they recieved something
           if($this -> session -> userdata('user_indicator')=='district'):	
           //check if the user is district if so the facility which was given the item is not using HCMP		
		   else:				   
			$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'initial_quantity'=>$total_unit_count[$i],
			'current_balance'=>$total_unit_count[$i],
			'source_of_commodity'=>$source_of_item[$i],
			'date_added'=>$date_of_entry );
			 //get the closing stock of the given item           
            $facility_stock=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id[$i])->toArray();	
			//update the facility stock table
			facility_stocks::update_facility_stock($mydata);
            // save this infor in the issues table
            $facility_name=isset($service_point[$i]) ? Facilities::get_facility_name2($service_point[$i]) : null;
	 $facility_name=isset($facility_name)? $facility_name['facility_name']: 'N/A';
            $total_unit_count_=$total_unit_count[$i]*-1;
			$mydata=array('facility_code'=>$facility_code,
			's11_No' => '(+ve Adj) Stock Addition',
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'date_issued' => date('y-m-d'),
			'issued_to'=>"inter-facility donation: ".$facility_name,
			'qty_issued' => $total_unit_count_,
			'issued_by' =>$this -> session -> userdata('user_id') ); //$this -> session -> userdata('identity')
			 // update the issues table 
			facility_issues::update_issues_table($mydata);			 
			 //check	
			$facility_has_commodity=facility_transaction_table::get_if_commodity_is_in_table($facility_code,$commodity_id[$i]);
					
          if($facility_has_commodity>0): //update the opening balance for the transaction table 
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =`opening_balance`+$total_unit_count[$i]
                                          WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code=$facility_code");                                                 		   
else:       //get the data to send to the facility_transaction_table
		   	$mydata2=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'opening_balance'=>$total_unit_count[$i],
			'total_issues'=>0,
			'total_receipts'=>0,
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$total_unit_count[$i],
			'status'=>1);	//send the data to the facility_transaction_table		
			facility_transaction_table::update_facility_table($mydata2);			
endif;		

	//update the redistribution data
	$myobj = Doctrine::getTable('redistribution_data')->find($facility_stock_id[$i]);
    $myobj->quantity_received=$total_unit_count[$i];
    $myobj->receiver_id=$this -> session -> userdata('user_id');
    $myobj->date_received=date('y-m-d');
    $myobj->status=1;
    $myobj->save();
    endif;	
    endif;						
endfor;	     
          //set the notifications
		  //$this->hcmp_functions->send_stock_update_sms();
		  $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
		  redirect('reports/facility_stock_data');			  
endif;	
}

public function add_more_stock_level_store_external(){
    //seth
        if($this->input->post('facility_stock_id')):
        $district_id = $this -> session -> userdata('district_id');
         $commodity_id=array_values($this->input->post('commodity_id'));
         $expiry_date=array_values($this->input->post('clone_datepicker'));
         $batch_no=array_values($this->input->post('commodity_batch_no'));
         $manu=array_values($this->input->post('commodity_manufacture'));
         $total_unit_count=array_values($this->input->post('actual_quantity'));              
         $service_point=array_values($this->input->post('service_point'));
         $source_of_item=array_values($this->input->post('source_of_item'));
         $count=count($commodity_id);
         $date_of_entry=date('y-m-d H:i:s');
         //collect n set the data in the array
        for($i=0;$i<$count;$i++):

           if($total_unit_count[$i]>0)://check if the balance is more than 0 ie they recieved something
           if($this -> session -> userdata('user_indicator')=='district'):  
           //check if the user is district if so the facility which was given the item is not using HCMP        
           else:                   
            $mydata=array('facility_code'=>$facility_code,
            'commodity_id'=>$commodity_id[$i],
            'batch_no'=>$batch_no[$i],
            'manufacture'=>$manu[$i],
            'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
            'initial_quantity'=>$total_unit_count[$i],
            'current_balance'=>$total_unit_count[$i],
            'source_of_commodity'=>$source_of_item[$i],
            'date_added'=>$date_of_entry );
             //get the closing stock of the given item           
            $district_stock=drug_store_issues::get_store_commodity_total($district_id,$commodity_id[$i]);
            //update the facility stock table
            drug_store_issues::update_drug_store_issues_table($mydata);
            // save this infor in the issues table
            
            $total_unit_count_=$total_unit_count[$i]*-1;
            $mydata=array('facility_code'=>$facility_code,
            'district_id'=>$district_id,
            's11_No' => '(+ve Adj) Stock Addition',
            'commodity_id'=>$commodity_id[$i],
            'batch_no'=>$batch_no[$i],
            'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
            'balance_as_of'=>$district_stock['commodity_balance'],
            'date_issued' => date('y-m-d'),
            'issued_to'=>"inter-facility donation: ".$facility_name,
            'qty_issued' => $total_unit_count_,
            'issued_by' =>$this -> session -> userdata('user_id') ); //$this -> session -> userdata('identity')
             // update the issues table 
            drug_store_issues::update_drug_store_issues_table($mydata);           
             //check    
            $facility_has_commodity=facility_transaction_table::get_if_commodity_is_in_table($facility_code,$commodity_id[$i]);
                    
          if($facility_has_commodity>0): //update the opening balance for the transaction table 
            $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
            $inserttransaction->execute("UPDATE `facility_transaction_table` SET `opening_balance` =`opening_balance`+$total_unit_count[$i]
                                          WHERE `commodity_id`= '$commodity_id[$i]' and status='1' and facility_code=$facility_code");                                                         
else:       //get the data to send to the facility_transaction_table
            $mydata2=array('facility_code'=>$facility_code,
            'commodity_id'=>$commodity_id[$i],
            'opening_balance'=>$total_unit_count[$i],
            'total_issues'=>0,
            'total_receipts'=>0,
            'adjustmentpve'=>0,
            'adjustmentnve'=>0,
            'date_added'=>$date_of_entry,
            'closing_stock'=>$total_unit_count[$i],
            'status'=>1);   //send the data to the facility_transaction_table       
            facility_transaction_table::update_facility_table($mydata2);            
endif;      

    //update the redistribution data
    $myobj = Doctrine::getTable('redistribution_data')->find($facility_stock_id[$i]);
    $myobj->quantity_received=$total_unit_count[$i];
    $myobj->receiver_id=$this -> session -> userdata('user_id');
    $myobj->date_received=date('y-m-d');
    $myobj->status=1;
    $myobj->save();
    endif;  
    endif;                      
endfor;      
          //set the notifications
          //$this->hcmp_functions->send_stock_update_sms();
          $this->session->set_flashdata('system_success_message', "Stock Levels Have Been Updated");
          redirect('issues/store_home');            
endif;  
}//district store

 /*
|--------------------------------------------------------------------------
| End of ADDING MORE FACILITY STOCK Inter-facility donation
|--------------------------------------------------------------------------
 Next section update_facility_stock_from_kemsa_order
*/
  public function update_facility_stock_from_kemsa_order(){	
	$facility_code=$this -> session -> userdata('facility_id');
	$date_of_entry = date("y-m-d h:i:s");
	$facility_stock_array=$facility_transaction_array=
	$facility_order_details_push_array=$facility_order_details_array=
	$facility_issues_array=array();
	if($this->input->post('commodity_id')):
	//products
	$commodity_id=$this->input->post('commodity_id');
	$commodity_code=$this->input->post('commodity_code');
	$batch_no=$this->input->post('batch_no');
	$expiry_date=$this->input->post('expiry_date');
	$actual_quantity=$this->input->post('actual_quantity');
	$manu=$this->input->post('manu');
	$cost=$this->input->post('cost');
	$price=$this->input->post('price_bought');
	$order_details_id=$this->input->post('order_details_id');
	//delivery details $order
	$hcmp_order_id=$this->input->post('hcmp_order_id');
	$warehouse=$this->input->post('warehouse');
	$dispatch_date=date('y-m-d',strtotime($this->input->post('dispatch_date')));
	$deliver_date=date('y-m-d',strtotime($this->input->post('deliver_date')));
	$dnote=$this->input->post('dno');
	$kemsa_order_no=$this->input->post('kemsa_order_no');
    $actual_order_total=$this->input->post('actual_order_total');
	$j=count($commodity_id);		
	for($i=0;$i<$j;$i++){
	$mydata=array('facility_code'=>$facility_code,
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manu[$i],
			'expiry_date'=> date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'initial_quantity'=>$actual_quantity[$i],
			'current_balance'=>$actual_quantity[$i],
			'source_of_commodity'=>1,
			'date_added'=>$date_of_entry );
	        array_push($facility_stock_array,$mydata);	//insert batch for facility_stocks 
	        $facility_stock=facility_stocks::get_facility_commodity_total($facility_code,$commodity_id[$i])->toArray();	
			$stocks=$actual_quantity[$i]*-1;			
			$mydata_2=array('facility_code'=>$facility_code,
			's11_No' => 'Delivery From KEMSA',
			'commodity_id'=>$commodity_id[$i],
			'batch_no'=>$batch_no[$i],
			'expiry_date'=>date('y-m-d', strtotime(str_replace(",", " ",$expiry_date[$i]))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'date_issued' => date('y-m-d'),
			'qty_issued' => $stocks,
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('user_id'));  
			 array_push($facility_issues_array,$mydata_2);	//insert batch for facility_issues	
	}
   	$this -> db -> insert_batch('facility_stocks', $facility_stock_array);
	$this -> db -> insert_batch('facility_issues', $facility_issues_array);
/*step one move all the closing stock of existing stock to be the new opening balance and compute the total items from kemsa***/
$get_delivered_items =Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("select f_t_t.`closing_stock`,ifnull(f_s.`current_balance`,0) as current_balance ,f_s.commodity_id
from facility_transaction_table f_t_t 
left join  facility_stocks f_s on f_s.facility_code= f_t_t.facility_code 
and f_s.commodity_id=f_t_t.commodity_id and f_s.date_added='$date_of_entry'  
and f_s.status=1
where  f_t_t.facility_code=$facility_code and f_t_t.status=1   
group by f_s.commodity_id");
$step_1_size=count($get_delivered_items);
/******************* step two get items that the facility does not have the in the transaction table ideally pushed items**/
$get_pushed_items=Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT ifnull(f_s.`current_balance`,0) AS current_balance, f_s.commodity_id
FROM facility_stocks f_s
WHERE f_s.current_balance >0
AND f_s.status =  '1'
AND f_s.facility_code ='$facility_code'
AND f_s.commodity_id NOT 
IN (SELECT commodity_id
FROM facility_transaction_table
WHERE facility_code ='$facility_code'
AND status ='1')
GROUP BY f_s.commodity_id");
$step_2_size=count($get_pushed_items);	  
//setting previous cycle's values to 0 then updating a fresh
		$q=Doctrine_Manager::getInstance()->getCurrentConnection()->execute("UPDATE `facility_transaction_table` SET status=0 WHERE `facility_code`= '$facility_code'");  
//package all the items which existed into one array and save for step one
			for($i=0;$i<$step_1_size;$i++){
            $closing_stock=(int)$get_delivered_items[$i]['closing_stock']+(int)$get_delivered_items[$i]['current_balance'];
			$order_details_table_id='';
			$mydata_3=array('facility_code'=>$facility_code,
			'commodity_id'=>$get_delivered_items[$i]['commodity_id'],
			'opening_balance'=>$get_delivered_items[$i]['closing_stock'],
			'total_issues'=>0,
			'total_receipts'=>$get_delivered_items[$i]['current_balance'],
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$closing_stock,
			'status'=>1);
			$order_details_table_id=@$order_details_id[array_search($get_delivered_items[$i]['commodity_id'], $commodity_id)];
			if($order_details_table_id>0){
			$mydata_4=array('id'=>$order_details_table_id,
			'quantity_recieved'=>$get_delivered_items[$i]['current_balance']);	
			array_push($facility_order_details_array,$mydata_4);	
			}		
            array_push($facility_transaction_array,$mydata_3);	
			}
//package all the items which did not exist into one array and save for step two
			for($i=0;$i<$step_2_size;$i++){
            $closing_stock=$get_pushed_items[$i]['current_balance'];
			$order_details_table_id='';
			$mydata_5=array('facility_code'=>$facility_code,
			'commodity_id'=>$get_pushed_items[$i]['commodity_id'],
			'opening_balance'=>0,
			'total_issues'=>0,
			'total_receipts'=> $closing_stock,
			'adjustmentpve'=>0,
			'adjustmentnve'=>0,
			'date_added'=>$date_of_entry,
			'closing_stock'=>$closing_stock,
			'status'=>1);
			$index=array_search($get_pushed_items[$i]['commodity_id'], $commodity_id);
			if($order_details_table_id>0){
			$mydata_6= array("commodity_id" =>$get_pushed_items[$i]['commodity_id'], 'quantity_ordered_pack' =>0, 
			'quantity_ordered_unit' =>0, 'quantity_recieved' => $closing_stock, 'price' => $price[$index], 
			'o_balance' =>0, 't_receipts' => 0, 't_issues' => 0, 'adjustpve' =>0,
			 'adjustnve' =>0, 'losses' =>0, 'days' => 0, 'c_stock' =>0, 
			 'comment' =>'N/A', 's_quantity' =>0, 'amc' => 0, 'order_number_id' =>$hcmp_order_id);
			array_push($facility_order_details_push_array,$mydata_6);	
			}		
            array_push($facility_transaction_array,$mydata_5);	
			}
   
	    $this -> db -> insert_batch('facility_transaction_table', $facility_transaction_array);
		$this -> db -> update_batch('facility_order_details', $facility_order_details_array,'id');
		if(count($facility_order_details_push_array)>0){
		$this -> db -> insert_batch('facility_order_details', $facility_order_details_push_array);	
		}//update the order table here	    
		$state=Doctrine::getTable('facility_orders')->findOneById($hcmp_order_id);
		$state->deliver_date=$deliver_date;
		$state->reciever_id=$this -> session -> userdata('user_id');
		$state->dispatch_update_date=date('y-m-d');
		$state->dispatch_date=$dispatch_date;
		$state->deliver_total=$actual_order_total;
		$state->warehouse=$warehouse;
		$state->status=4;
		$state->save();//get the color coded table
        $order_details=$this -> hcmp_functions -> create_order_delivery_color_coded_table($hcmp_order_id);
		$message_1="<br>The Order Made for $order_details[facility_name] on  $order_details[date_ordered] has been received at the facility on. $order_details[date_received].
		<br>
		Total ordered value(ksh) =$order_details[order_total].
		<br>
		Total received order value(ksh)=$order_details[actual_order_total].
		<br>
		Order Lead Time (from placement – receipt) = $order_details[lead_time]  days.
		<br>
		<br>
		<br>".$order_details['table'];				
		$subject='Order Report For '.$order_details['facility_name'];
        echo $message_1;exit;
		$this->hcmp_functions ->send_order_delivery_email($message_1,$subject,null);
		$this->session->set_flashdata('system_success_message', 'Stock details have been Updated');
endif;
		redirect('reports/facility_stock_data');	
  	
  }
/*
|--------------------------------------------------------------------------
| End of update_facility_stock_from_kemsa_order
|--------------------------------------------------------------------------
 Next section Decommission
*/
public function decommission(){
	//Change status of commodities to decommissioned
	   $date= date('y-m-d');
	   $facility_code=$this -> session -> userdata('facility_id');
	   $user_id=$this -> session -> userdata('user_id');	
	   $facility_name_array=Facilities::get_facility_name_($facility_code)->toArray();
	   $facility_name=$facility_name_array[0]['facility_name'];
	   $myobj1 = Doctrine::getTable('Districts')->find($facility_name_array[0]['district']);
	   $disto_name=$myobj1->district;
		$county=$myobj1->county;
		$myobj2 = Doctrine::getTable('Counties')->find($county);
		$county_name=$myobj2->county;
        $total=0;
		//Create PDF of Expired Drugs that are to be decommisioned. check here 
		$decom=Facility_stocks::get_facility_expired_stuff($facility_code);
		/*****************************setting up the report*******************************************/
		if(count($decom)>0):
$body ='';	
			$body.="<style> table {
    border-collapse: collapse; 
}td,th{
	padding: 12px;
	text-align:center;
}

*{margin:0;padding:0}*{font-family:'Helvetica Neue',Helvetica,Helvetica,Arial,sans-serif}img{max-width:100%}.collapse{padding:0}body{-webkit-font-smoothing:antialiased;-webkit-text-size-adjust:none;width:100%!important;height:100%}a{color:#2BA6CB}.btn{text-decoration:none;color:#FFF;background-color:#666;padding:10px 16px;font-weight:700;margin-right:10px;text-align:center;cursor:pointer;display:inline-block}p.callout{padding:15px;background-color:#ECF8FF;margin-bottom:15px}.callout a{font-weight:700;color:#2BA6CB}table.social{background-color:#ebebeb}.social .soc-btn{padding:3px 7px;font-size:12px;margin-bottom:10px;text-decoration:none;color:#FFF;font-weight:700;display:block;text-align:center}a.fb{background-color:#3B5998!important}a.tw{background-color:#1daced!important}a.gp{background-color:#DB4A39!important}a.ms{background-color:#000!important}.sidebar .soc-btn{display:block;width:100%}table.head-wrap{width:100%}.header.container table td.logo{padding:15px}.header.container table td.label{padding:15px 15px 15px 0}table.body-wrap{width:100%}table.footer-wrap{width:100%;clear:both!important}.footer-wrap .container td.content p{border-top:1px solid #d7d7d7;padding-top:15px;font-size:9px;font-weight:500}h1,h2,h3,h4,h5,h6{font-family:HelveticaNeue-Light,'Helvetica Neue Light','Helvetica Neue',Helvetica,Arial,'Lucida Grande',sans-serif;line-height:1.1;margin-bottom:15px;color:#000}h1 small,h2 small,h3 small,h4 small,h5 small,h6 small{font-size:60%;color:#6f6f6f;line-height:0;text-transform:none}h1{font-weight:200;font-size:44px}h2{font-weight:200;font-size:37px}h3{font-weight:500;font-size:27px}h4{font-weight:500;font-size:23px}h5{font-weight:900;font-size:17px}h6{font-weight:900;font-size:14px;text-transform:uppercase;color:#444}.collapse{margin:0!important}p,ul{margin-bottom:10px;font-weight:400;font-size:14px;line-height:1.6}p.lead{font-size:17px}p.last{margin-bottom:0}ul li{margin-left:5px;list-style-position:inside}ul.sidebar{background:#ebebeb;display:block;list-style-type:none}ul.sidebar li{display:block;margin:0}ul.sidebar li a{text-decoration:none;color:#666;padding:10px 16px;cursor:pointer;border-bottom:1px solid #777;border-top:1px solid #FFF;display:block;margin:0}ul.sidebar li a.last{border-bottom-width:0}ul.sidebar li a h1,ul.sidebar li a h2,ul.sidebar li a h3,ul.sidebar li a h4,ul.sidebar li a h5,ul.sidebar li a h6,ul.sidebar li a p{margin-bottom:0!important}.container{display:block!important;max-width:100%!important;margin:0 auto!important;clear:both!important}.content{padding:15px;max-width:80%px;margin:0 auto;display:block}.content table{width:100%}.column{width:300px;float:left}.column tr td{padding:15px}.column-wrap{padding:0!important;margin:0 auto;max-width:600px!important}.column table{width:100%}.social .column{width:280px;min-width:279px;float:left}.clear{display:block;clear:both}@media only screen and (max-width:600px){a[class=btn]{display:block!important;margin-bottom:10px!important;background-image:none!important;margin-right:0!important}div[class=column]{width:auto!important;float:none!important}table.social div[class=column]{width:auto!important}}</style>";
			
			$body.=
"<table class='' style='background-color: #ECF8FF;' >
<tr>
<td>MFL No: <strong>$facility_code</strong> </td> 
<td>Health Facility Name: <strong>$facility_name</strong></td>
<td>County: <strong>$county_name</strong></td> 
<td>Subcounty: <strong>$disto_name</strong></td>
</tr>
</table>"
.'
<table class="" style="margin:8px;word-wrap: break-word;">
<thead style="font-size:12px">
			<tr><th><strong>Source</strong></th>
			<th><strong>Description</strong></th>
			<th><strong>Commodity Code</strong></th>
			
			<th><strong>Unit Cost(Ksh)</strong></th>
			<th><strong>Batch Affected</strong></th>
			<th><strong>Manufacturer</strong></th>
			<th><strong>Expiry Date</strong></th>
			<th><strong>Expiry Days</strong></th>
			<th><strong>Expired(Pack Size)</strong></th>	
			<th><strong>Expired(Unit Size)</strong></th>
			<th><strong>Cost of Expired (Ksh)</strong></th>
</tr> </thead><tbody>';
/*******************************begin adding data to the report*****************************************/
	foreach($decom as $drug){
		                        $commodity_id=$drug['commodity_id'];
		                        $batch=$drug['batch_no'];
								$mau=$drug['manufacture'];
								$commodity_name=$drug['commodity_name'];
								$commodity_code=$drug['commodity_code'];								
					            $unit_size=$drug['unit_size'];
								$unit_cost=str_replace(",", '',$drug['unit_cost']);								
								$current_balance=($drug['current_balance']);
								$total_commodity_units=$drug['total_commodity_units'];
								$expiry_date=$drug['expiry_date'];
							    $current_balance_pack=round(($current_balance/$total_commodity_units),1);
								$cost=$current_balance_pack*$unit_cost;
								$formatme=new DateTime($expiry_date);
								$newdate= $formatme->format('d M Y');
								$facility_stock_id=$drug['facility_stock_id'];	
								$total=$total+$cost;
								$source=$drug['source_name'];								
			//get the current balance of the commodity					
			$facility_stock=Facility_Stocks::get_facility_commodity_total($facility,$commodity_id)->toArray();					
			$mydata3=array('facility_code'=>$facility_code,
			's11_No' => '(Loss) Expiry',
			'commodity_id'=>$commodity_id,
			'batch_no'=>$batch,
			'expiry_date'=>date('y-m-d', strtotime(str_replace(",", " ",$expiry_date))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'date_issued' => date('y-m-d'),
			'qty_issued' => 0,
			'adjustmentnve'=>($current_balance*-1),
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('user_id'));			
			 $seconds_diff =strtotime(date("y-m-d"))-strtotime($expiry_date);
			 $date_diff=floor($seconds_diff/3600/24);			
			Facility_Issues::update_issues_table($mydata3);
		   	$inserttransaction= Doctrine_Manager::getInstance()->getCurrentConnection()
			->execute("UPDATE `facility_transaction_table` SET losses =losses+$current_balance, closing_stock=closing_stock-$current_balance
              WHERE `commodity_id`= '$commodity_id' and status='1' and facility_code=$facility_code ");	                                           
             /// update the facility issues and set the commodity to expired                             
            $inserttransaction=Doctrine_Manager::getInstance()->getCurrentConnection()
            ->execute("UPDATE `facility_stocks` SET status =2 WHERE `id`= '$facility_stock_id'");
            if($current_balance_pack>0):                           								    
		    $body .='<tr style="font-size:12px;padding:4px"><td>'.$source.'</td>
							<td>'.$commodity_name.'</td>
							<td>'.$commodity_code.'</td>
							
							<td>'.$unit_cost.'('.$unit_size.')'.'</td>
							<td>'. $batch.'</td>
							<td>'.$mau.'</td>
							<td>'.$newdate.'</td>
							<td>'.$date_diff.'</td>	
							<td>'.$current_balance_pack.'</td>						
							<td>'.$current_balance.'</td>
							<td>'.number_format($cost, 2, '.', ',').'</td>	
							</tr>';
			endif;		
		  }
		$body .='
		<tr>
		<td colspan="12">
		<b style="float: right; margin:1.0em;font-size:14px">TOTAL cost(Ksh) of Expiries: &nbsp; '.number_format($total, 2, '.', ',').'</b>
		</tr>
		</tbody>
		</table>'; 
			$html_body.="<!-- BODY -->
<table class='body-wrap'>
	<tr>
		<td></td>
		<td class='container' bgcolor='#FFFFFF'>

			<div class='content'>
			<table>
				<tr>
					<td>
						<h3>Hello,</h3>
						<p class='lead'>Find attached decommissioned commodities for $facility_name ($facility_code).</p>
						<p>$body</p>
						<!-- Callout Panel -->
						<p class='callout'>
							<a href='health-cmp.or.ke'>Click here! &raquo;</a> to follow up. 
						</p><!-- /Callout Panel -->					
												
						<!-- social & contact -->
						<table class='social' width='100%'>
							<tr>
								<td>
									
									<!-- column 1 -->
									<table align='left' class='column'>
										
									</table><!-- /column 1 -->	
									
									<!-- column 2 -->
									<table align='left' class='column'>
										<tr>
											<td>				
																			
												<h5 class=''>Contact Info:</h5>												
												<p>Phone: <strong>+254720167245</strong><br/>
                Email: <strong><a href='emailto:hcmpkenya@gmail.com'>hcmpkenya@gmail.com</a></strong></p>
                
											</td>
										</tr>
									</table><!-- /column 2 -->
									
									<span class='clear'></span>	
									
								</td>
							</tr>
						</table><!-- /social & contact -->
						
					</td>
				</tr>
			</table>
			</div><!-- /content -->
									
		</td>
		<td></td>
	</tr>
</table><!-- /BODY -->";	

   	$file_name ='Facility_Expired_Commodities_'.$facility_name."_".$facility_code."_".$date;
	$pdf_data = array("pdf_title" => "Facility Expired Commodities For $facility_name", 
	'pdf_html_body' => $body, 'pdf_view_option' => 'save_file', 'file_name' => $file_name);
	$this -> hcmp_functions -> create_pdf($pdf_data);
   if($this->hcmp_functions->send_stock_decommission_email($html_body,'Decommission Report For '.$facility_name,'./pdf/'.$file_name.'.pdf')){
   	delete_files('./pdf/'.$file_name.'.pdf');
   	$this->session->set_flashdata('system_success_message', 'Stocks Have Been Decommissioned');		
     }
//echo $body;exit;
$user = $this -> session -> userdata('user_id');
$user_action = "decommission";
Log::log_user_action($user, $user_action);
endif;
redirect('reports/facility_stock_data');	
  }
			
 /*
|--------------------------------------------------------------------------
| End of Decommission
|--------------------------------------------------------------------------
 Next section Edit facility stock
*/
public function edit_facility_stock_data(){
//security check
if($this->input->post('id')):
$facility_code=$this -> session -> userdata('facility_id');
$stock_id=$this->input->post('id');
$expiry_date=$this->input->post('expiry_date');
$batch_no=$this->input->post('batch_no');
$delete=$this->input->post('edit');
$manufacturer=$this->input->post('manufacturer');
$commodity_id=$this->input->post('commodity_id');
$commodity_balance_units=$this->input->post('commodity_balance_units');
for($key=0;$key<count($stock_id);$key++):
	if($delete[$key]==2):
		//check the total stock balance of the commodity
		$facility_stock=facility_stocks::get_facility_commodity_total($facility_code, $commodity_id[$key]);
		$commodity_balance=($commodity_balance_units[$key]*-1);
	    $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->execute("update facility_transaction_table t 
		 set  t. `closing_stock`=`closing_stock`-$commodity_balance_units[$key],`adjustmentnve`=$commodity_balance 
		 where t.facility_code='$facility_code' and t.commodity_id=$commodity_id[$key] and t.status=1");
		 // prepare the data to save
		 $commodity_balance=($commodity_balance_units[$key]*-1);
		 	$mydata=array('facility_code'=>$facility_code,
			's11_No' => 'Deleted Commodity',
			'commodity_id'=>$commodity_id[$key],
			'batch_no'=>$batch_no[$key],
			'expiry_date'=>date('y-m-d',strtotime(str_replace(",", " ",$expiry_date[$key]))),
			'balance_as_of'=>$facility_stock[0]['commodity_balance'],
			'adjustmentnve'=> $commodity_balance,
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' =>$this -> session -> userdata('user_id') );
			 // update the issues table 
			 facility_issues::update_issues_table($mydata); 
		 //delete the record
          $inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection()
		->execute("delete from facility_stocks where id=$stock_id[$key]"); 
	 else:
		 $myobj = Doctrine::getTable('facility_stocks')->find($stock_id[$key]);
         $myobj->batch_no=$batch_no[$key] ;
		 $myobj->manufacture=$manufacturer[$key];
		 $myobj->expiry_date=date('y-m-d',strtotime(str_replace(",", " ",$expiry_date[$key])));
         $myobj->save(); 	
	 endif;
endfor;
//$this-> hcmp_functions ->send_stock_update_sms();
$this->session->set_flashdata('system_success_message', "Facility Stock data has Been Updated"); 
redirect('reports/facility_stock_data');	
endif;	
redirect();
}
public function amc(){
    $this->session->set_flashdata('system_success_message', "AMC Details Have Been Saved");
    redirect('home');
}
public function fix(){
   // get the facility_codes 
   $facility_codes=Doctrine_Manager::getInstance()->getCurrentConnection()
   ->fetchAll("select distinct `facility_code` from `facility_issues` WHERE status=1");
   foreach( $facility_codes as $key=> $facility_code){
   //step one reset refrence table
   $facility_code=$facility_code['facility_code'];
   $min_date= Doctrine_Manager::getInstance()->getCurrentConnection()
   ->fetchAll("select min(date_issued) as min_date,issued_by from `facility_issues` WHERE  facility_code=$facility_code and status=1");
   $reset_facility_transaction_table = Doctrine_Manager::getInstance()->getCurrentConnection();
   $reset_facility_transaction_table->execute("DELETE FROM `facility_transaction_table` WHERE  facility_code=$facility_code; "); 
   $reset_facility_transaction_table->execute("DELETE FROM `facility_issues` WHERE  facility_code=$facility_code and s11_No='initial stock update'
   and status=1");
   //step two get the facility stocks 
   $facility_stocks=facility_stocks::get_facility_commodity_total($facility_code);
   $data_array_facility_transaction=$data_array_facility_issues=array();
   foreach($facility_stocks as $facility_stock){
   $commodity_id=   $facility_stock['commodity_id'];
   if($commodity_id>0):
   $total= Doctrine_Manager::getInstance()->getCurrentConnection()
   ->fetchAll("select ifnull(sum(qty_issued),0) as total from `facility_issues` WHERE  facility_code=$facility_code and status=1 and commodity_id=$commodity_id");
            $mydata2=array('facility_code'=>$facility_code,
            'commodity_id'=>$facility_stock['commodity_id'],
            'opening_balance'=>$facility_stock['commodity_balance'],
            'total_issues'=>$total[0]['total'],
            'total_receipts'=>0,
            'adjustmentpve'=>0,
            'adjustmentnve'=>0,
            'date_added'=>$min_date[0]['min_date'],
            'closing_stock'=>$facility_stock['commodity_balance'],
            'status'=>1);   //send the data to the facility_transaction_table 
                  
            array_push($data_array_facility_transaction, $mydata2); 
            $total_unit_count_=$facility_stock['commodity_balance']*-1;
            $mydata_=array('facility_code'=>$facility_code,
            's11_No' =>'initial stock update',
            'commodity_id'=>$facility_stock['commodity_id'],
            'batch_no'=> "N/A",
            'expiry_date'=>"N/A",
            'balance_as_of'=>0,
            'qty_issued' => $total_unit_count_,
            'date_issued' => $min_date[0]['min_date'],
            'issued_to' => 'N/A',
            'issued_by' => $min_date[0]['issued_by']); 
             //create the array to push to the db
            array_push($data_array_facility_issues, $mydata_);
            
endif; 
   }  
            $this -> db -> insert_batch('facility_transaction_table', $data_array_facility_transaction);
            $this -> db -> insert_batch('facility_issues', $data_array_facility_issues); 
            echo "<br>$key fixed facility code ".$facility_code; 
   }

}
            public function upload_new_list(){
            if(isset($_FILES['file']) && $_FILES['file']['size'] > 0):
            $item_details = Commodities::get_all_from_supllier(1);
            
            $excel2 = PHPExcel_IOFactory::createReader('Excel2007');
            $excel2=$objPHPExcel= $excel2->load($_FILES["file"]["tmp_name"]); // Empty Sheet
            
            $sheet = $objPHPExcel->getSheet(0); 
            $highestRow = $sheet->getHighestRow(); 
            
            $highestColumn = $sheet->getHighestColumn();
            $temp=$super_cat=$sub_cat=array();
            $temp['Updated commodity']=array();;
            $temp['Added New commodity_category']=array();;
            $temp['Added New commodity_sub_category']=array();;
            $temp['Added New commodities']=array();;
            $row_has_no_commodities=false;
           //  Loop through each row of the worksheet in turn
        for ($row = 15; $row <= $highestRow; $row++){ 
            //  Read a row of data into an array
            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);                                    
           if(isset($rowData[0][1]) && $rowData[0][1]!='' ){
           $cell = $sheet->getCell('C'.$row);// super category
           // Check if cell is merged super category
           foreach ($sheet->getMergeCells() as $cells) {
           if ($cell->isInRange($cells)) {// check for the super cat name 

           $data_new=$rowData[0][2];
           
           $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
           select * from commodity_category where category_name like '%$data_new%'");
           $does_it_exits=count($q);
          
           if($does_it_exits==0){//set the super cat id here
           $this -> db -> insert('commodity_category', array('category_name'=>$rowData[0][2],'status'=>1));
           $super_cat=array_merge($super_cat,array($rowData[0][2]=>$this -> db -> insert_id()));

           array_push($temp['Added New commodity_category'],$rowData[0][2]);

           }else{
           $super_cat=array_merge($super_cat,array($rowData[0][2]=>$q[0]['id']));   
           }
          
           }
           else{
           $row_has_no_commodities=false;
           } 
           }

           if ($rowData[0][4] && $rowData[0][4]!='' ) {// check for the sub cat name 
           
           $data_new=$rowData[0][4];
           
           $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
           select * from commodity_sub_category where sub_category_name like '%$data_new%'");
           $does_it_exits=count($q);
          
           if($does_it_exits==0){//set the sub cat id here
          
           $ar_k=array_keys($super_cat);
           $lastindex=$ar_k[count($ar_k)-1];
           $new_word=ucwords(strtolower($data_new));// captialize the first word of each letter 
           $this -> db -> insert('commodity_sub_category', array('sub_category_name'=>$new_word,
           'status'=>1,'commodity_category_id'=>$super_cat[$lastindex]));

           array_push($temp['Added New commodity_sub_category'],$rowData[0][4]);

           $sub_cat= array_merge($sub_cat,array($data_new=>$this -> db -> insert_id()));
           
           }else{
           $sub_cat=array_merge($sub_cat,array($data_new=>$q[0]['id']));  
           //print_r($sub_cat); exit; 
           }
           
           } 
           // now for the commodities
           if($rowData[0][5] && $rowData[0][5]!='' ){
           $data_new=preg_replace('/[^A-Za-z0-9\-]/', ' ', $rowData[0][2]); $unit_size=$rowData[0][5];$unit_cost=$rowData[0][6];$total_commodity_units=$rowData[0][7];
           $new_unit_size=mysql_escape_string($unit_size);
           $q = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
           select * from commodities where commodity_code like '%$data_new%' and unit_size like  '%$new_unit_size%' ");
           $does_it_exits=count($q);
           
           if($does_it_exits==0){//set the sub cat id here
          // echo "  $does_it_exits
           //select * from commodities where commodity_code like \'%$data_new%\' and unit_size like  \'%$new_unit_size%\' "; exit;
           $new_word=$data_new;// captialize the first word of each letter 
           $this -> db -> insert('commodities', array('commodity_name'=>$rowData[0][3],'unit_size'=>$unit_size,'unit_cost'=>$unit_cost,
           'commodity_code'=>$data_new,'commodity_sub_category_id'=>$sub_cat[$rowData[0][4]],'total_commodity_units'=>$total_commodity_units,
           'commodity_source_id'=>1,'tracer_item'=>0,'status'=>1));
           array_push($temp['Added New commodities'],$rowData[0][3]);
           }else{
           $array_update = array('commodity_name'=>$rowData[0][3],
                          'unit_size'=>$unit_size, 
                          'unit_cost'=>$unit_cost,
                          'commodity_code'=>$data_new,
                          'commodity_sub_category_id'=>$sub_cat[$rowData[0][4]],
                          'total_commodity_units'=>$total_commodity_units,
                          'commodity_source_id'=>1,
                          );
           $array_where = array(
                          'unit_size'=>$unit_size, 
                          'commodity_code'=>$data_new,
                          );
                          
           $this->db->where($array_where);
           $this->db->update("commodities", $array_update);
          
          if( $this->db->affected_rows() > 0){

             array_push($temp['Updated commodity'],$rowData[0][3]." unit price ".$sub_cat[$rowData[0][4]]);
 
            } 
           }
               
           }
           
           }// end if
           }// end for loop
          echo "<pre>";;print_r($temp);echo "</pre>";;
           unset($objPHPExcel);
           endif;   
               }

}

?>