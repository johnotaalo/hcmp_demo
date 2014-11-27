<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
include_once 'auto_sms.php';
class Issues_main extends auto_sms {
		function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		
		
	}

	public function index($checker=NULL,$pop_up_msg=NULL){
		$facility=$this -> session -> userdata('news');
		//$facility=$this->uri->segment(4);

			switch ($checker)
			{
				case 'Internal':
					
					$data['content_view'] = "facility/facility_data/facility_issues/IssueInternal_v";
					$data['title'] = "Stock";
					$data['banner_text'] = "Issue";
					$data['link'] = "IssuesnReceipts";
					$data['quick_link'] = "IssueInternal_v";
					
					break;
					case 'External':
						
						$data['content_view'] = "facility/facility_data/facility_issues/IssueExternal_v";
						//$data['content_view'] = "IssueExternal_v";						
						$county=districts::get_county_id($this -> session -> userdata('district1'));
						$data['district']=districts::getAll();
						$data['banner_text'] = "Redistribute Commodities";
						$data['title'] = "Redistribute Commodities";
						$data['quick_link'] = "IssueExternal_v";
						
					break;
					
					case 'Donation':
										   
		        $data['title'] = "Update Stock Level: External source";
     	        $data['content_view'] = "facility/facility_data/facility_issues/update_stock_donation_v";
		        $data['banner_text'] = "Update Stock Level: External source";
		        $data['drug_categories'] = Drug::getAll();
		        $data['quick_link'] = "update_stock_level";
		
	   
						break;
					
					default;
						
						$data['content_view'] = "facility/facility_data/facility_issues/issuesnRecpt";
						$data['banner_text'] = "Issues Home";
						$data['title'] = "Stock";
						$data['quick_link'] = "issuenRecpt";
						$data['popout']=$pop_up_msg;
									
			}

		$data['service']=Service::getall($facility);		
		$data['drugs'] = Facility_Stock::getAllStock($facility);

     	$this -> load -> view("template", $data);

	}
	public function Insert_test()
	{

		$ids=$_POST['kemsaCode'];		
	    $Available=$_POST['AvStck'];
		$batchN=$_POST['batchNo'];
		
		
	
		$Expiry=$_POST['Exp'];
		//$sNo=$_POST['s11N'];
        $qty=$_POST['Qtyissued'];
		$thedate=$_POST['datepicker'];
		$serviceP=$_POST['Servicepoint'];
        $j=sizeof ($ids);
		
       $count=0;

        $facilityCode=$facility_c=$this -> session -> userdata('news');	
		$usernow=$this -> session -> userdata('identity');

		for($me=0;$me<$j;$me++){
        	        	
			if ($qty[$me]>0) {
				$count++;
				$mydata = array('facility_code' => $facilityCode,	'kemsa_code' => $ids[$me], 's11_No'=>"internal issue", 'batch_no' => $batchN[$me] ,
				'expiry_date' => $Expiry[$me] ,'qty_issued'=> $qty[$me] ,
				'issued_to'=>$serviceP,'balanceAsof'=>$Available[$me], 'date_issued'=>date('y-m-d',strtotime($thedate[$me])),'issued_by'=>$usernow);

				$u = new Facility_Issues();

    			$u->fromArray($mydata);

    			$u->save();
				//echo "$xraws records inserted";

			$q = Doctrine_Query::create()
			->update('Facility_Stock')
				->set('balance', '?', $Available[$me])
					->where("kemsa_code='$ids[$me]' AND batch_no='$batchN[$me]' and facility_code ='$facilityCode'");

			$q->execute();

			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();


			$inserttransaction->execute("UPDATE `facility_transaction_table` SET total_issues = (SELECT SUM(qty_issued) 
			FROM facility_issues WHERE kemsa_code = '$ids[$me]' and availability='1' and facility_code='$facilityCode')
                                          WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code='$facilityCode'; ");
			//echo "$numrows records updated";

			$inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();


			$inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(balance)
			 FROM facility_stock WHERE kemsa_code = '$ids[$me]' and availability='1' and facility_code='$facilityCode')
                                          WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code ='$facilityCode'; ");
			}
			$data['title'] = "Stock";
			$data['drugs'] = Drug::getAll();
			$data['popout'] = "You have issued $count item(s)";
			$data['content_view'] = "issuesnRecpt";
			$data['banner_text'] = "Stock Control Card";
			$data['link'] = "order_management";
     		$data['quick_link'] = "stockcontrol_c";
			$this -> load -> view("template", $data);

		}

	}
	
	public function Insert()
	{
		 
		#solves error code fac#35 changing issuing to use commodity id that batchno		
		$commodity_id=$_POST['commodity_id'];
		#///////////////////////////////////////
		$ids=$_POST['drug_id'];		
	    $Available=$_POST['commodity_balance'];
		$batchN=$_POST['batchNo'];
		$Expiry=$_POST['expiry_date'];
		$qty=$_POST['Qtyissued'];
		$thedate=$_POST['date_issue'];
		$serviceP=$_POST['Servicepoint'];
		
        $j=sizeof ($ids);
        $count=0;

        $facilityCode=$facility_c=$this -> session -> userdata('news');	
		$usernow=$this -> session -> userdata('identity');

		for($me=0;$me<$j;$me++){
        	        	
			if ($qty[$me]>0) {
				$count++;

				$mydata = array('facility_code' => $facilityCode,	'kemsa_code' => $ids[$me], 's11_No'=>'internal issue', 'batch_no' => $batchN[$me] ,
				'expiry_date' => date('y-m-d',strtotime($Expiry[$me])),'qty_issued'=> $qty[$me] ,
				'issued_to'=>$serviceP[$me],'balanceAsof'=>$Available[$me], 'date_issued'=>date('y-m-d',strtotime($thedate[$me])),'issued_by'=>$usernow);
				
				$u = new Facility_Issues();

    			$u->fromArray($mydata);

    			$u->save();
				
	
			$a = Doctrine_Manager::getInstance()->getCurrentConnection();
			$a->execute("UPDATE `Facility_Stock` SET `balance` = `balance`-$qty[$me] where id='$commodity_id[$me]'");

			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();

			$inserttransaction->execute("UPDATE `facility_transaction_table` SET total_issues = (SELECT SUM(qty_issued) 
			FROM facility_issues WHERE kemsa_code = '$ids[$me]' and availability='1' and facility_code='$facilityCode' and s11_No not like '%Donation%')
            WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code='$facilityCode'; ");
			
			$inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(balance)
			 FROM facility_stock WHERE kemsa_code = '$ids[$me]' and availability='1' and facility_code='$facilityCode')
             WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code ='$facilityCode';");
			}

		}
        
		 //$this->send_stock_donate_sms();
         $this->session->set_flashdata('system_success_message', "You have issued $count item(s)");
		 redirect('issues_main');

	}

public function InsertExt()
	{
		#solves error code fac#35 changing issuing to use commodity id that batchno		
		$commodity_id=$_POST['commodity_id'];
		#///////////////////////////////////////
        $Available=$_POST['commodity_balance'];
		$ids=$_POST['drug_id'];		
		$mfl=$_POST['mfl'];			
		$batchN=$_POST['batchNo'];
		$Expiry=$_POST['expiry_date'];
        $qty=$_POST['Qtyissued'];
		$thedate=$_POST['date_issue'];
        $j=sizeof ($ids);
	
       $count=0;
	   $facilityCode=$facility_c=$this -> session -> userdata('news');
       $usernow=$this -> session -> userdata('identity'); 
		
		//loop through all th donated commodities and process
		for($me=0;$me<$j;$me++){
        	        	
			if ($qty[$me]>0) {
				///update the donating facility details
				$facility_name=Facilities::get_facility_name($mfl[$me])->toArray();
		
				
				$facility_details="inter-facility donation: MFL NO ".$mfl[$me];
		        $sNo="(-ve Adj) Stock Deduction";
				$count++;
				
				$issues=$qty[$me]*-1;
				
				////checking if the facilility receiving the commodities is using HCMP
				$users_array=user::getUsers($mfl[$me]);
				$user_in_donated_facility=count($users_array);

				//inserting in the facility issues 
				$mydata = array('facility_code' => $facilityCode,
				'kemsa_code' => $ids[$me],
				 's11_No'=>$sNo, 'batch_no' => $batchN[$me] 
				 ,'expiry_date' => date('y-m-d',strtotime($Expiry[$me])) ,'qty_issued'=> $qty[$me] ,
				 'balanceAsof'=>$Available[$me],
				 'date_issued'=>date('y-m-d',strtotime($thedate[$me]))
				 ,'issued_to'=>$facility_details,'issued_by'=>$usernow,'receipts'=>$issues);
				
				$u = new Facility_Issues();

    			$u->fromArray($mydata);

    			$u->save();
				
				//updating the facility stock
		    $a = Doctrine_Manager::getInstance()->getCurrentConnection();
			$a->execute("UPDATE `Facility_Stock` SET `balance` = `balance`-$qty[$me] where id='$commodity_id[$me]'");
			///updating the trascation_table
			$inserttransaction_1 = 
			Doctrine_Manager::getInstance()->getCurrentConnection()
			->fetchAll("select  `adj` from `facility_transaction_table`WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code=$facility_c; ");
			
                                          
			$inserttransaction_2 = Doctrine_Manager::getInstance()
			->getCurrentConnection()
			->fetchAll("SELECT (SUM(qty_issued)*-1) as update_ FROM facility_issues 
			WHERE kemsa_code = '$ids[$me]' and issued_to='$facility_details' and availability='1'");;
									  
			
			 $new_value=$inserttransaction_1[0]['adj']+$inserttransaction_2[0]['update_'];
			 
		
			
			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET adj =$new_value 
                                          WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code=$facilityCode; ");
			
			
			$inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(balance) FROM facility_stock WHERE kemsa_code = '$ids[$me]'
			and availability='1' and facility_code='$facilityCode' and availability='1')
                                          WHERE`kemsa_code`= '$ids[$me]' and availability='1' and facility_code=$facilityCode; ; ");
					
						
			///updating the receiving facility records if they are using the system							  
			if($user_in_donated_facility>0){
				//getting the name of the mauf of the given drug
			$mauf=facility_stock::get_batch_details($batchN[$me],$ids[$me]);
				
			$mydata=array('facility_code'=>$mfl[$me],
			'kemsa_code'=>$ids[$me],
			'batch_no'=>$batchN[$me],
			'manufacture'=>$mauf['manufacture'],
			'expiry_date'=> date('y-m-d', strtotime($Expiry[$me])),
			'balance'=>$qty[$me] ,
			'quantity'=>$qty[$me] ,
			'stock_date'=>date('y-m-d'));
			
			Facility_Stock::update_facility_stock($mydata);	
			///checking if the receiving_facility_has_this_drug  //kemsa_code facility code
			$receiving_facility_has_this_drug=Facility_Transaction_Table::get_if_drug_is_in_table($mfl[$me],$ids[$me]);
			
			
			if(count($receiving_facility_has_this_drug)>0){//if yes update their records

			$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();

			$inserttransaction
			->execute("UPDATE `facility_transaction_table` SET 
			adj = (SELECT SUM(qty_issued) FROM facility_issues WHERE kemsa_code = '$ids[$me]' and issued_to='$facility_details' and availability='1')
            WHERE `kemsa_code`= '$ids[$me]' and availability='1' and facility_code=$mfl[$me]; ");
			
			
			$inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction1
			->execute("UPDATE `facility_transaction_table` 
			SET closing_stock = (SELECT SUM(qty_issued) FROM facility_issues WHERE kemsa_code = '$ids[$me]' and issued_to='$facility_details' and availability='1')
            WHERE`kemsa_code`= '$ids[$me]' and availability='1' and facility_code=$mfl[$me];");
			
			}
			
			else{
				//if no insert the record in the transaction table
				
			$mydata2=array('Facility_Code'=>$mfl[$me],
			'Kemsa_Code'=>$ids[$me],
			'Opening_Balance'=>0,
			'Total_Issues'=>0,
			'Total_Receipts'=>0,
			'Adj'=>$qty[$me],
			'Closing_Stock'=>$qty[$me],
			'availability'=>1);
			
			Facility_Transaction_Table::update_facility_table($mydata2);
			
			}
				
			}	else{
				//do nothing
			}						  
				
			}
       	
		}
         $this->send_stock_donate_sms();
         $this->session->set_flashdata('system_success_message', "You have Donated $count item(s)");
		 redirect('issues_main');

	}



public function donation()
	{
		
		$facility_c=$this -> session -> userdata('news');
		$usernow=$this -> session -> userdata('identity'); 
		
		$kemsa_code=$_POST['drug_id'];
		$expiry_date=$_POST['expiry_date'];
		$batch_no=$_POST['batchNo'];
		$manuf=$_POST['manuf'];
		$a_stock=$_POST['qreceived'];
		$source=$_POST['source'];
		$count=count($kemsa_code);
		
		$orderDate=date('y-m-d H:i:s');
				;
		
		for($i=0;$i<=$count;$i++){
			
			if(isset($kemsa_code[$i])&&$kemsa_code[$i]!=''){
				
			$mydata=array('facility_code'=>$facility_c,
			'kemsa_code'=>$kemsa_code[$i],
			'batch_no'=>$batch_no[$i],
			'manufacture'=>$manuf[$i],
			'expiry_date'=> date('y-m-d', strtotime($expiry_date[$i])),
			'balance'=>$a_stock[$i],
			'quantity'=>$a_stock[$i],
			'stock_date'=>$orderDate,
			'sheet_no'=>$source[$i],
			'source'=>$source[$i]
			);
			
			////get the current balance of the same commodity before adding new stock level
		   $current_bal=Facility_Stock::getAll($kemsa_code[$i],$facility_c);
			
			
			///updating the facility stock with the new data from the donation 
			Facility_Stock::update_facility_stock($mydata);
	
			//adding data to issues table
			
				$mydata = array('facility_code' => $facility_c,'kemsa_code' => $kemsa_code[$i], 's11_No'=>"(+ve Adj) Stock Addition", 
				'batch_no' => $batch_no[$i] ,'expiry_date' => date('y-m-d',strtotime($expiry_date[$i])) ,
				'qty_issued'=> 0,'balanceAsof'=>$current_bal[0]['total_balance'],'receipts'=>$a_stock[$i],
				 'date_issued'=>date('y-m-d'),
				 'issued_to'=>"Source :".$source[$i],'issued_by'=>$usernow);
				
				$u = new Facility_Issues();

    			$u->fromArray($mydata);

    			$u->save();

			}
		}

          //getting facility regarding the stocks added above ^
		$data=Facility_Stock::count_facility_stock($facility_c,$orderDate);

		foreach ($data as $infor) {
			$qty=$infor->quantity1;
			$kemsa_code_=$infor->kemsa_code;
		
			
		   $facility_has_commodity=Facility_Transaction_Table::get_if_drug_is_in_table($facility_c,$kemsa_code_);
		   
		   if($facility_has_commodity>0){
		   	$inserttransaction_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select  `adj` from `facility_transaction_table`
                                          WHERE `kemsa_code`= '$kemsa_code_' and availability='1' and facility_code=$facility_c; ");
		
			
			$new_value=$inserttransaction_1[0]['adj']+$qty;
			
		   	$inserttransaction = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET adj =$new_value
                                          WHERE `kemsa_code`= '$kemsa_code_' and availability='1' and facility_code=$facility_c; ");
                                          
           $inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			

			$inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(balance)
			 FROM facility_stock WHERE kemsa_code = '$kemsa_code_' and status='1' and facility_code='$facility_c')
                                          WHERE `kemsa_code`= '$kemsa_code_' and availability='1' and facility_code ='$facility_c'; ");   
                                          
                                                               
		   }
		   else{
		   	$mydata2=array('Facility_Code'=>$facility_c,
			'Kemsa_Code'=>$kemsa_code_,
			'Opening_Balance'=>0,
			'Total_Issues'=>0,
			'Total_Receipts'=>0,
			'Adj'=>$qty,
			'Closing_Stock'=>$qty,
			'availability'=>1);
			
			Facility_Transaction_Table::update_facility_table($mydata2);
		   }
		   
		
			}

			
         $this->send_stock_update_sms();
         $this->session->set_flashdata('system_success_message', "You have received $count item(s)");
		 redirect('issues_main');	
	}

	
	}