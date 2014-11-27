<?php
/**
 * @author Kariuki
 * Edited by Collins
 */
ob_start();
class sms extends MY_Controller {
	var $test_mode = true;
	function __construct() {
		parent::__construct();
		$this -> load -> helper(array('form', 'url', 'file', 'download'));
		$this -> load -> library(array('hcmp_functions', 'form_validation', 'email', 'mpdf/mpdf'));

	}

	/*
	 |--------------------------------------------------------------------------|
	 | SMS	SECTION																	|
	 |--------------------------------------------------------------------------|
	 */

	//Test for sending emails
	public function send_email_test() {
		$this -> hcmp_functions -> send_email();
	}

	//Checks if there are potential expiries in the system
	public function check_potential_expiries() {
		$year = date("Y");
		$potential_expiries = Facility_stocks::get_potential_expiries_sms();
		$total_potential = count($potential_expiries);

		if ($total_potential > 0) {
			$total_facilitites = count($potential_expiries);

			$total_commodities = "";

			foreach ($potential_expiries as $potential) {
				$facility_code = $potential['facility_code'];
				$data = Users::getUsers($facility_code) -> toArray();
				//Filter the array to remove empty sections of the array
				$data = array_filter($data);
				if (!empty($data)) {
					foreach ($data as $users) {
						$user_type = $users['usertype_id'];

						switch ($user_type) {
							//Facility Admin
							case 2 :
								$message = $potential['total'] . " commodities will expire within 3 months. HCMP";
								break;
							//Sub County Head
							case 3 :
								$message = $total_facilitites . " facilities have commodities that will expire within 3 months. HCMP";
								break;
							//County Head
							case 10 :
								$message = "There are " . $total_potential . " potential expiries in the county. HCMP";
								break;
							//For test purposes only
							case 5 :
								$message = "Test SMS. HCMP";
								break;
						}

						$phone = $this -> get_facility_phone_numbers($facility_code);
						$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
						$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
					}
				} else {
					//DO Nothing
					//Array is empty
				}

			}

		} else {
			//No Potential Expiries

		}

	}

	//Stock out SMSes
	//will be called once a week by the system automatically
	public function stock_out_sms() {
		$stock_outs = Facility_stocks::get_stock_outs_sms();
		$total_stock_outs = count($stock_outs);
		if ($total_stock_outs > 0) {
			$total_facilitites = count($stock_outs);
			$total_commodities = "";

			foreach ($stock_outs as $stock_outs_) {
				$facility_code = $stock_outs_['facility_code'];
				$data = Users::getUsers($facility_code) -> toArray();
				//Filter the array to remove empty sections of the array
				$data = array_filter($data);
				if (!empty($data)) {
					$total_subcounties = count($data['']);
					foreach ($data as $users) {
						$user_type = $users['usertype_id'];

						switch ($user_type) {
							//Facility Admin
							case 2 :
								$message = $stock_outs_['total'] . " commodities are out of stock.";
								break;
							//Sub County Head
							case 3 :
								$message = $total_facilitites . " facilities have a total number of " . $total_stock_outs . " stock outs.";
								break;
							//County Head
							case 10 :
								$message = "There are " . $total_stock_outs . " stock outs in the county";
								break;
							//For test purposes only
							case 5 :
								$message = "To Me";
								break;
						}

						$phone = $this -> get_facility_phone_numbers($facility_code);
						$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
						$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
					}
				} else {
					//DO Nothing
					//Array is empty
				}

			}

		} else {
			//No Stock Outs

		}
	}

	//For Orders
	//Called when an order is placed by a particular facility
	public function send_order_sms() {
		$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();
		foreach ($data as $users) {
			$user_type = $users['usertype_id'];

			switch ($user_type) {
				//Facility Admin
				case 2 :
					$message = "An  order has been placed by " . $facility_name;
					break;
				//Sub County Head
				case 3 :
					$message = $facility_name . " has placed an order";
					break;
				//County Head
				case 10 :
					$message = "An  order has been placed by " . $facility_name;
					break;
				//For test purposes only
				case 5 :
					$message = "Test order sms. Placed by " . $facility_name;
					break;
			}

			$phone = $this -> get_facility_phone_numbers($facility_code);
			$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
			$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
		}

	}

	//When stock is updated by a particular facility
	public function send_stock_update_sms() {
		$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();

		foreach ($data as $users) {
			$user_type = $users['usertype_id'];

			switch ($user_type) {
				//Facility Admin
				case 2 :
					$message = "Stock has been updated for " . $facility_name;
					break;
				//Sub County Head
				case 3 :
					$message = $facility_name . " has updated its stock";
					break;
				//County Head
				case 10 :
					$message = "Stock has been updated for " . $facility_name;
					break;
				//For test purposes only
				case 5 :
					$message = "Stock has been updated for " . $facility_name;
					break;
			}

			$phone = $this -> get_facility_phone_numbers($facility_code);
			$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
			$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);
		}

	}

	//Called when an order is rejected or approved bt the DPP
	//Accepts two parameters $facility code and status of the order
	public function send_order_approval_sms($facility_code, $status) {
		//$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();

		$message = ($status == 1) ? $facility_name . "'s order has been rejected. HCMP" : $facility_name . "'s order has been approved. HCMP";

		$data = Users::getUsers($facility_code) -> toArray();
		$phone = $this -> get_facility_phone_numbers($facility_code);
		$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);

		$this -> send_sms(substr($phone, 0, -1), $message);

	}

	public function order_update_sms($facility_code, $status) {
		//$facility_code = $this -> session -> userdata('facility_id');
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();
		$message = $facility_name . " has updated its order";

		$phone = $this -> get_facility_phone_numbers($facility_code);
		$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
		$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);

	}

	public function send_stock_donate_sms($facility_code, $facility_code2) {
		//Facility code the mfl code for the facility donating drugs
		//Facility code 2 is for the facility recieving the commodities
		$facility_name = Facilities::get_facility_name2($facility_code);
		$facility_name = $facility_name['facility_name'];
		$facility_name2 = Facilities::get_facility_name2($facility_code2);
		$facility_name2 = $facility_name2['facility_name'];
		$data = Users::getUsers($facility_code) -> toArray();
		$data2 = Users::getUsers($facility_code) -> toArray();

		$message = $facility_name . " has donated commodirties to " . $facility_name2;

		$phone = $this -> get_facility_phone_numbers($facility_code);
		$phone .= $this -> get_facility_phone_numbers($facility_code2);
		$phone .= $this -> get_ddp_phone_numbers($data[0]['district']);
		$phone .= $this -> get_ddp_phone_numbers($data2[0]['district']);

		$this -> hcmp_functions -> send_sms(substr($phone, 0, -1), $message);

	}

	/*public function update_stock_out_table()
	 {

	 $in = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
	 select stock_date,facility_code,
	 kemsa_code from facility_stock
	 where `balance`=0 and `status`=1 and quantity>0
	 group by kemsa_code,facility_code");

	 $jay = count($in);

	 for($i=0;$i<$jay;$i++)
	 {
	 Doctrine_Manager::getInstance()->getCurrentConnection()->execute("
	 insert into facility_stock_out_tracker
	 set facility_id='".$in[$i]['facility_code']."', drug_id='".$in[$i]['kemsa_code']."',
	 `start_date`='".$in[$i]['stock_date']."', status='stocked out' ");

	 }
	 }
	 */

	/*
	 |--------------------------------------------------------------------------|
	 | EMAIL SECTION															|
	 |--------------------------------------------------------------------------|
	 */

	//gets the emails of the respective DPPs in charge
	public function get_ddp_email($district_id) {
		$data = Users::get_dpp_emails($district_id);
		$user_email = "";
		foreach ($data as $info) {
			
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}
	public function get_ddp_email_county($county_id) {
		$data = Users::get_dpp_emails_county_level($county_id);
		$user_email = "";
		foreach ($data as $info) {
			
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}
	public function get_county_email($county_id) {
		$data = Users::get_county_emails($county_id);
		$user_email = "";
		foreach ($data as $info) {
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}
//Getting the bcc emails 
	public function get_bcc_notifications() {
		$bcc_emails = "collinsojenge@gmail.com,kelvinmwas@gmail.com,smutheu@clintonhealthaccess.org,
						jhungu@clintonhealthaccess.org,gmacharia@clintonhealthacces.org,tngugi@clintonhealthaccess.org,
						bwariari@clintonhealthaccess.org,amwaura@clintonhealthaccess.org,eongute@clintonhealthaccess.org,
						rkihoto@clintonhealthaccess.org,teddyodera@gmail.com,ericmurugami@yahoo.co.uk,
						raykiprono@gmail.com,margie.dora@gmail.com,amostum5@gmail.com,muirurisk@gmail.com,
						valwacu@gmail.com,odiwuorybrian@gmail.com,mwakiojoy@gmail.com,emgitar@yahoo.com,ronohb@gmail.com,
						kevgithuka@gmail.com,kiganyastephenthua@gmail.com,";
		
		return $bcc_emails;
	}

	//gets the emails of users in the facility
	public function get_facility_email($facility_code) {
		$data = Users::get_user_emails($facility_code);
		$user_email = "";
		foreach ($data as $info) {
			
			$user_email .= $info -> email . ',';

		}
		return $user_email;
	}

	public function send_stock_decommission_email($message, $subject, $attach_file) {
		$facility_code = $this -> session -> userdata('facility_id');
		$data = Users::getUsers($facility_code) -> toArray();
		$email_address = $this -> get_facility_email($facility_code);
		$email_address .= $this -> get_ddp_email($data[0]['district']);

		$this -> send_email(substr($email_address, 0, -1), $message, $subject, $attach_file);

	}
	public function expiries_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		$counties = Facilities::get_counties_all_using_HCMP();

		foreach ($counties as $counties) {
			//holds the dat for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//Used to store the total cost of all expiries
			$county_expiries_total = 0;
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the ddistricts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {
				
				//Used to store the total cost of all expiries
				$sub_county_expiries_total = 0;
				
				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get potential expiries in that particular facility
					$facility_expiries = Facility_stocks::All_expiries_email($facility_code);

					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_expiries)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_expiries)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility expiries monthly report ', 'file_name' => 'facility weekly report');
					$row_data = array();
					
					$column_data = array("Commodity Name","Unit Size", "Quantity (packs)","Quantity (units)","Unit Cost(KSH)","Total Expired(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
					
					$excel_data['column_data'] = $column_data;

					foreach ($facility_expiries as $facility_expiries) :
						array_push($row_data, array($facility_expiries["commodity_name"],$facility_expiries["unit_size"],$facility_expiries["packs"],$facility_expiries["units"],$facility_expiries["unit_cost"],$facility_expiries["total"],$facility_expiries["expiry_date"],$facility_expiries["source_name"],$facility_expiries["date_added"],$facility_expiries["manufacture"],$facility_expiries["facility_name"],$facility_expiries["facility_code"],$facility_expiries["subcounty"],$facility_expiries["county"]));
						$facility_potential_expiries_total = $facility_potential_expiries_total + $facility_expiries["total"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Expiries_Report";
						$excel_data['excel_title'] = "Expiries Report for ".$facility_name." for the month of ".date("F Y");

						$subject = "Expiries: " . $facility_name;
						
						$message = "Dear ".$facility_name." facility,</br>
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of Expiries.
								You may log onto health-cmp.or.ke to decommission them.</p>
								<p>----</p>
								<p>HCMP</p>
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
						//create the excel here
						$report_type = "expiries";
						//holds the total figure for the expiries
						$total_figure = $facility_potential_expiries_total;
						//excel is created by php excel here
						$this-> create_excel($excel_data,$report_type,$total_figure);
						//where the excel sheet is stored before being attached
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						//the email of the receipients
						$email_address = $this->get_facility_email($facility_code);
						//function for sending the actual email
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district expiries weekly report ', 'file_name' => 'district weekly report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size", "Quantity (packs)","Quantity (units)","Unit Cost(KSH)","Total Expired(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["packs"],$facility_total1["units"],$facility_total1["unit_cost"],$facility_total1["total"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
							$sub_county_expiries_total = $sub_county_expiries_total + $facility_total1["total"];
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_District_Expiries_Report";
					$excel_data['excel_title'] = "Expiries Report for ".$district_name." Sub County for the month of ".date("F Y");
					
					//tyoe of report created
					$report_type = "expiries";
					//holds the total cost
					$total_figure = $sub_county_expiries_total;
					//creates the excel sheet
					$this-> create_excel($excel_data,$report_type,$total_figure);
					//path of the excel sheet
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					//creating the email subject and message body
					$subject = "Expiries: " . $district_name . " Sub County (Next 3 Months)";
					$message = "Dear ".$district_name." Sub County,
								<p>Find attached an excel sheet with the ".$district_name." Sub County breakdown of Expiries.
								You may log onto health-cmp.or.ke to decommission them.</p>
								<p>----</p>
								<p>HCMP</p>
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
					
					//email address to receive
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
				}

			}

			//Building the excel sheet to be sent to the district admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'county expiries weekly report ', 'file_name' => 'district report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size", "Quantity (packs)","Quantity (units)","Unit Cost(KSH)","Total Expired(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["packs"],$facility_total1["units"],$facility_total1["unit_cost"],$facility_total1["total"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
								$county_expiries_total = $county_expiries_total + $facility_total1["total"];
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_Weekly_County_Expiries_Report";
				$excel_data['excel_title'] = "Expiries Report for ".$county_name." County for the month of ".date("F Y");
					
				//create the excel here
				$report_type = "expiries";
				$total_figure = $county_expiries_total;
				$this-> create_excel($excel_data,$report_type,$total_figure);
				//Where the excel sheet will be saved before being attached
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				
				//Start creating the email Subject and message body here
				$subject = "Expiries: " . $county_name . " County (Next 3 Months)";
				$message = "Dear ".$county_name." County,
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Expiries.
							You may log onto health-cmp.or.ke to decommission them.</p>
							<p>----</p>
							<p>HCMP</p>
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
					
				$email_address = $this -> get_ddp_email_county($county_id);
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler, $bcc, $cc);
			}

		}

	}
public function weekly_potential_expiries_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		//$counties = Facilities::get_Taita();
		$counties = Facilities::get_counties_all_using_HCMP();
		
		foreach ($counties as $counties) {
			//holds the data for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county name and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the districts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			//echo "<pre>";print_r($districts);exit;
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				
				$facility_total = array();
				
				foreach ($facilities as $facilities_) :
					
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get potential expiries in that particular facility
					$facility_potential_expiries = Facility_stocks::potential_expiries_email($facility_code);
					//echo "<pre>";print_r($facility_potential_expiries);exit;
					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_potential_expiries)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_potential_expiries)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility potential expiries weekly report ', 'file_name' => 'facility weekly report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_potential_expiries as $facility_potential_expiries) :
						array_push($row_data, array($facility_potential_expiries["commodity_name"],$facility_potential_expiries["unit_size"],$facility_potential_expiries["units"], $facility_potential_expiries["packs"],$facility_potential_expiries["unit_cost"],$facility_potential_expiries["total_ksh"],$facility_potential_expiries["expiry_date"],$facility_potential_expiries["source_name"],$facility_potential_expiries["date_added"],$facility_potential_expiries["manufacture"],$facility_potential_expiries["facility_name"],$facility_potential_expiries["facility_code"],$facility_potential_expiries["subcounty"],$facility_potential_expiries["county"]));
						$facility_potential_expiries_total += $facility_potential_expiries["total_ksh"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Potential_Expiries_Report";
						$excel_data['excel_title'] = "Potential Expiries Report for ".$facility_name." as at ".date("jS F Y");

						$subject = "Potential Expiries: " . $facility_name . " (Next 3 Months)";
						
						$message = "Dear ".$facility_name.",
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of the Potential Expiries.
								Kindly sensitize the need to re-distribute these short expiry commodities.</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
					
						$report_type = "potential_expiries";
						$this ->create_excel($excel_data,$report_type);
						
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						$email_address = $this->get_facility_email($facility_code);
						
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
						
					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district potential expiries weekly report ', 'file_name' => 'district weekly report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["units"], $facility_total1["packs"],$facility_total1["unit_cost"],$facility_total1["total_ksh"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
						
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_Sub_County_Potential_Expiries_Report";
					$excel_data['excel_title'] = "Potential Expiries Report for ".$district_name." Sub County as at ".date("jS F Y");
					
					//Create the excel file here
					$report_type = "potential_expiries";
					$this ->create_excel($excel_data,$report_type);
					
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					$subject = "Potential Expiries: " . $district_name . " Sub County (Next 3 Months)";
					
					$message = "<p>Dear ".$district_name." Sub County,</p>
								<p>Find attached an excel sheet with the ".$district_name." Sub County's breakdown of Potential Expiries.
								Kindly sensitize the need to re-distribute these short expiry commodities.</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
					
				}

			}

			//Building the excel sheet to be sent to the district admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district potential expiries weekly report ', 'file_name' => 'district weekly report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Date of Expiry","Supplier","Date Added","Manufacturer","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["units"], $facility_total1["packs"],$facility_total1["unit_cost"],$facility_total1["total_ksh"],$facility_total1["expiry_date"],$facility_total1["source_name"],$facility_total1["date_added"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["subcounty"],$facility_total1["county"]));
						
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_Weekly_County_Potential_Expiries_Report";
				$excel_data['excel_title'] = "Potential Expiries Report for ".$county_name." County as at ".date("jS F Y");
				
				//create the excel file
				$report_type = "potential_expiries";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				$subject = "Potential Expiries: " . $county_name . " County (Next 3 Months)";
				
				$message = "<p>Dear ".$county_name." County,</p>
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Potential Expiries.
							Kindly sensitize the need to re-distribute these short expiry commodities.</p>
							<p>You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				$email_address = $this -> get_ddp_email_county($county_id);
				
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler,$bcc,$cc);				
			}

		}

	}


	public function weekly_stockouts_report() {
		//Set the current year
		$year = date("Y");
		//get the facilities in the district
		//$counties = Facilities::get_Taita();
		$counties = Facilities::get_counties_all_using_HCMP();
		
		foreach ($counties as $counties) {
			//holds the dat for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the ddistricts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];
					
					$facility_potential_expiries = Facility_stocks::get_stock_outs_for_email($facility_code);
					
					//get potential expiries in that particular facility
					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_potential_expiries)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_potential_expiries)));
					//Start building the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility stokouts weekly report ', 'file_name' => 'facility weekly report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Unit Cost(KSH)","Quantity Available (Units)","Quantity Available (Packs)","Supplier","Manufacturer","Facility Name","Subcounty","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_potential_expiries as $facility_potential_expiries) :
						array_push($row_data, array($facility_potential_expiries["commodity_name"],$facility_potential_expiries["unit_size"],$facility_potential_expiries["unit_cost"],$facility_potential_expiries["current_balance"],$facility_potential_expiries["current_balance_packs"],$facility_potential_expiries["source_name"],$facility_potential_expiries["manufacture"],$facility_potential_expiries["facility_name"],$facility_potential_expiries["district"],$facility_potential_expiries["county"]));
						//$facility_potential_expiries_total = $facility_potential_expiries_total + $facility_potential_expiries[""]
					endforeach;
					if (empty($row_data)) {
						//do nothing
					} else {
						
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Stock_Outs_Report";
						$excel_data['excel_title'] = "Stock Outs Report for ".$facility_name." as at ".date("jS F Y");
						
						$message = "<p>Dear ".$facility_name.",</p>
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of commodities with Low Stock Levels.
								You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						//Create the excel here
						$report_type = "stockouts";
						$this ->create_excel($excel_data,$report_type);
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						$subject = "Stock Outs Report: " . $facility_name;
						
						$email_address = $this -> get_facility_email($facility_code);
						
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
						
					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'district stock outs weekly report ', 'file_name' => 'district weekly report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Unit Cost(KSH)","Quantity Available (Units)","Quantity Available (Packs)","Supplier","Manufacturer","Facility Name","Subcounty","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["unit_cost"],$facility_total1["current_balance"],$facility_total1["current_balance_packs"],$facility_total1["source_name"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["district"],$facility_total1["county"]));
							
						endforeach;
					endforeach;
				endforeach;
				if (empty($row_data)) {
					//do nothing
				} else {
					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_Sub_County_Stock_Outs_Report";
					$excel_data['excel_title'] = "Stock Outs Report for ".$district_name." Sub County as at ".date("jS F Y");
						
					$report_type = "stockouts";
					$this ->create_excel($excel_data,$report_type);
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					
					$subject = "Stock Outs: " . $district_name . " Sub County";
					
					$message = "Dear ".$district_name." Sub County,
								<p>Find attached an excel sheet with the ".$district_name." Sub County breakdown of Stock Outs in the Sub County.
								You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					$email_address = $this -> get_ddp_email($district_id);
					
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

				}

			}

			//Building the excel sheet to be sent to the district admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'county stock outs weekly report ', 'file_name' => 'district weekly report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Unit Cost(KSH)","Quantity Available (Units)","Quantity Available (Packs)","Supplier","Manufacturer","Facility Name","Subcounty","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["unit_cost"],$facility_total1["current_balance"],$facility_total1["current_balance_packs"],$facility_total1["source_name"],$facility_total1["manufacture"],$facility_total1["facility_name"],$facility_total1["district"],$facility_total1["county"]));
							
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;
			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_Weekly_County_Stock_Outs_Report";
				$excel_data['excel_title'] = "Stock Outs Report for ".$county_name." County as at ".date("jS F Y");
					
				$report_type = "stockouts";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				
				$subject = "Stock Outs: " . $county_name . " County";
				
				$message = "Dear ".$county_name." County,
							<p>Find attached an excel sheet with the ".$county_name." County breakdown of Stock Outs in the county.
							You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						
				$email_address = $this -> get_ddp_email_county($county_id);
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler,$bcc,$cc);
				
			}

		}

	}
	
	//Consumption Report
	public function consumption_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		$counties = Facilities::get_counties_all_using_HCMP();

		foreach ($counties as $counties) {
			//holds the data for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the districts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get potential expiries in that particular facility
					$facility_consumption = facility_issues::get_consumption_report_facility($facility_code);

					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_consumption)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_consumption)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility consumption report ', 'file_name' => 'facility consumption report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_consumption as $facility_consumption) :
						array_push($row_data, array($facility_consumption["commodity_name"],$facility_consumption["unit_size"],$facility_consumption["total_units"], $facility_consumption["total_packs"],$facility_consumption["unit_cost"],$facility_consumption["total_cost"],$facility_consumption["source_name"],$facility_consumption["facility_name"],$facility_consumption["facility_code"],$facility_consumption["district"],$facility_consumption["county"]));
						$facility_potential_expiries_total += $facility_consumption["total_cost"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Consumption_Report";
						$excel_data['excel_title'] = "Consumption Report for ".$facility_name." for the month of ".date("F Y");

						$subject = "Consumption: " . $facility_name;
						
						$message = "Dear ".$facility_name.",
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of the Consumption.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						$report_type = "consumption";
						$this ->create_excel($excel_data,$report_type);
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						$email_address = $this->get_facility_email($facility_code);
						$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'sub county consumption report ', 'file_name' => 'sub county consumption report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Weekly_Sub_County_Consumption_Report";
					$excel_data['excel_title'] = "Consumption Report for ".$district_name." Sub County for the month of ".date("F Y");
					
					//Create the excel file here
					$report_type = "consumption";
					$this ->create_excel($excel_data,$report_type);
					//exit;
					
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					$subject = "Consumption: " . $district_name . " Sub County";
					
					$message = "<p>Dear ".$district_name." Sub County,</p>
								<p>Find attached an excel sheet with the ".$district_name." Sub County's breakdown of Consumption.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					$email_address = $this -> get_ddp_email($district_id);
					$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
				}

			}

			//Building the excel sheet to be sent to the County Admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $county_name, 'doc_title' => 'county consumption report ', 'file_name' => 'county consumption report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_County_Consumption_Report";
				$excel_data['excel_title'] = "Consumption Report for ".$county_name." County for the month of ".date("F Y");
				
				//create the excel file
				$report_type = "consumption";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				$subject = "Consumption: " . $county_name . " County";
				//exit;
				$message = "<p>Dear ".$county_name." County,</p>
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Consumption.
							</p>
							<p>You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				$email_address = $this -> get_ddp_email_county($county_id);
				$bcc = $this -> get_bcc_notifications();
				$cc = $this -> get_county_email($county_id);
				
				$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler, $bcc, $cc);
			}

		}

	}
	
	//Stock Levels Report
	public function stock_levels_report() {
		//Set the current year
		$year = date("Y");
		$picurl = base_url() . 'assets/img/coat_of_arms-resized1.png';
		//get the facilities in the district
		$counties = Facilities::get_counties_all_using_HCMP();

		foreach ($counties as $counties) {
			//holds the data for the entire county
			//once it is done executing for one county it is reset to zero
			$county_total = array();
			//pick the county nae and county ID accordingly
			$county_id = $counties['county'];
			$county_name = $counties['county_name'];

			//Get all the districts in that  particular county
			$districts = Facilities::get_all_using_HCMP($county_id);
			//holds the data for all the districts in a particular county
			$district_total = array();

			foreach ($districts as $districts) {

				$district_id = $districts['district'];
				$district_name = $districts['name'];
				//get all facilities in that district
				$facilities = Facilities::getFacilities_for_email($district_id);
				//holds all the data for all facilities in a particular district
				$facility_total = array();

				foreach ($facilities as $facilities_) :
					//holds the total value of expiries for that particular facility in that district
					$facility_potential_expiries_total = 0;
					//$facility_potential_expiries = array();
					$facility_code = $facilities_ -> facility_code;
					$facility_name = Facilities::get_facility_name2($facility_code);
					$facility_name = $facility_name['facility_name'];

					//get the stocking levels in that particular facility
					
					$facility_consumption = facility_issues::get_consumption_report_facility($facility_code);

					//push the result into another array that will be used by the distrct
					(array_key_exists($facility_name, $facility_total)) ? $facility_total[$facility_name] = array_merge($facility_total[$facility_name], array($facility_consumption)) : $facility_total = array_merge($facility_total, array($facility_name => array($facility_consumption)));
					//Start buliding the excel file
					$excel_data = array();
					$excel_data = array('doc_creator' => $facility_name, 'doc_title' => 'facility stock level report ', 'file_name' => 'facility stock level report');
					$row_data = array();
					$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
					$excel_data['column_data'] = $column_data;

					foreach ($facility_consumption as $facility_consumption) :
						array_push($row_data, array($facility_consumption["commodity_name"],$facility_consumption["unit_size"],$facility_consumption["total_units"], $facility_consumption["total_packs"],$facility_consumption["unit_cost"],$facility_consumption["total_cost"],$facility_consumption["source_name"],$facility_consumption["facility_name"],$facility_consumption["facility_code"],$facility_consumption["district"],$facility_consumption["county"]));
						$facility_potential_expiries_total += $facility_consumption["total_cost"];
					endforeach;

					if (empty($row_data)) {
						//do nothing
					} else {
						$excel_data['row_data'] = $row_data;
						$excel_data['report_type'] = "download_file";
						$excel_data['file_name'] = $facility_name . "_Stock_Level_Report";
						$excel_data['excel_title'] = "Stock Levels Report for ".$facility_name." for the month as at ".date("jS F Y");

						$subject = "Stock Levels: " . $facility_name;
						
						$message = "Dear ".$facility_name.",
								<p>Find attached an excel sheet with the ".$facility_name." breakdown of Stock Levels.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
						$report_type = "stock_level";
						$this ->create_excel($excel_data,$report_type);
						$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
						
						//$email_address = $this->get_facility_email($facility_code);
						//$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);

					}

					//End foreach for facility
				endforeach;

				(array_key_exists($district_name, $district_total)) ? $district_total[$district_name] = array_merge($district_total[$district_name], array($facility_total)) : $district_total = array_merge($district_total, array($district_name => array($facility_total)));
				//Building the excel sheet to be sent to the district admin
				$excel_data = array();
				$excel_data = array('doc_creator' => $district_name, 'doc_title' => 'sub county stock level report ', 'file_name' => 'sub county stock level report');
				$row_data = array();
				$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
				$excel_data['column_data'] = $column_data;

				foreach ($facility_total as $facility_total_1) :
					foreach ($facility_total_1 as $facility_total_2) :
						foreach ($facility_total_2 as $facility_total1) :
							array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
						endforeach;
					endforeach;
				endforeach;

				if (empty($row_data)) {
					//do nothing
				} else {

					$excel_data['row_data'] = $row_data;
					$excel_data['report_type'] = "download_file";
					$excel_data['file_name'] = $district_name . "_Sub_County_Stock_Level_Report";
					$excel_data['excel_title'] = "Stock Levels Report for ".$district_name." Sub County as at ".date("jS F Y");
					
					//Create the excel file here
					$report_type = "stock_level";
					$this ->create_excel($excel_data,$report_type);
					//exit;
					
					$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
					$subject = "Stock Levels: " . $district_name . " Sub County";
					
					$message = "<p>Dear ".$district_name." Sub County,</p>
								<p>Find attached an excel sheet with the ".$district_name." Sub County's breakdown of Stock Levels.
								</p>
								<p>You may log onto health-cmp.or.ke for follow up.</p>
								
								<p>----</p>
								
								<p>HCMP</p>
								
								<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
					//$email_address = $this -> get_ddp_email($district_id);
					//$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
				}

			}

			//Building the excel sheet to be sent to the County Admin
			$excel_data = array();
			$excel_data = array('doc_creator' => $county_name, 'doc_title' => 'county stock levels report ', 'file_name' => 'county stock levels report');
			$row_data = array();
			$column_data = array("Commodity Name","Unit Size","Quantity (units)", "Quantity (packs)","Unit Cost(KSH)","Total Cost(KSH)","Supplier","Facility Name","MFL Code","Sub County","County");
			$excel_data['column_data'] = $column_data;

			foreach ($district_total as $facility_total_1) :
				foreach ($facility_total_1 as $facility_total_2) :
					foreach ($facility_total_2 as $facility_total_3) :
						foreach ($facility_total_3 as $facility_total_4) :
							foreach ($facility_total_4 as $facility_total1) :
								array_push($row_data, array($facility_total1["commodity_name"],$facility_total1["unit_size"],$facility_total1["total_units"], $facility_total1["total_packs"],$facility_total1["unit_cost"],$facility_total1["total_cost"],$facility_total1["source_name"],$facility_total1["facility_name"],$facility_total1["facility_code"],$facility_total1["district"],$facility_total1["county"]));
						
							endforeach;
						endforeach;
					endforeach;
				endforeach;
			endforeach;

			if (empty($row_data)) {
				//do nothing
			} else {
				$excel_data['row_data'] = $row_data;
				$excel_data['report_type'] = "download_file";
				$excel_data['file_name'] = $county_name . "_County_Stock_Level_Report";
				$excel_data['excel_title'] = "Stock Level Report for ".$county_name." County as at ".date("jS F Y");
				
				//create the excel file
				$report_type = "stock_level";
				$this ->create_excel($excel_data,$report_type);
				
				$handler = "./print_docs/excel/excel_files/" . $excel_data['file_name'] . ".xls";
				$subject = "Stock Level: " . $county_name . " County";
				//exit;
				$message = "<p>Dear ".$county_name." County,</p>
							<p>Find attached an excel sheet with the ".$county_name." County's breakdown of Stock Level.
							</p>
							<p>You may log onto health-cmp.or.ke for follow up.</p>
							
							<p>----</p>
							
							<p>HCMP</p>
							
							<p>This email was automatically generated. Please do not respond to this email address or it will be ignored.</p>";
				
				//$email_address = $this -> get_county_email($county_id);
				//$email_address = "smutheu@clintonhealthaccess.org,kelvinmwas@gmail.com,collinsojenge@gmail.com";
				$bcc = $this -> get_bcc_notifications();
				if ($county_id == 1):
					$cc_email = $this -> get_bcc_notifications();
					//$cc_email = "";
				else:
					$cc_email = "";
				endif;

			$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler, $bcc, $cc_email);
			}

		}

	}
	

public function create_excel($excel_data=NUll,$report_type = NULL, $total_figure =  NULL) 
{
	$styleArray = array('font' => array('bold' => true),'alignment'=>array('horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER));
	$styleArray2 = array('font' => array('bold' => true));
	
 	//check if the excel data has been set if not exit the excel generation    
     
	if(count($excel_data)>0):
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> getProperties() -> setCreator("HCMP");
		$objPHPExcel -> getProperties() -> setLastModifiedBy($excel_data['doc_creator']);
		$objPHPExcel -> getProperties() -> setTitle($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setSubject($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setDescription("");

		$objPHPExcel -> setActiveSheetIndex(0);
		
		if($report_type=="expiries"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			$cell_count = count($excel_data["row_data"]);
			$cell_count2 = $cell_count + 2;
			$cell_count3 = $cell_count + 3;
			$objPHPExcel->getActiveSheet()->setCellValue('F'.$cell_count3, "=SUM(F3:F".$cell_count2.")");
			$objPHPExcel->getActiveSheet()->setCellValue('A'.$cell_count3, "Total Cost of Expiries");
			$objPHPExcel->getActiveSheet()->getStyle('A'.$cell_count3)->applyFromArray($styleArray2);
			$objPHPExcel->getActiveSheet()->getStyle('F'.$cell_count3)->applyFromArray($styleArray2);
			
		elseif($report_type=="potential_expiries"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:N1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			
		elseif($report_type=="stockouts"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
			
		elseif($report_type=="order_costs"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:J1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		elseif($report_type=="consumption"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		elseif($report_type=="stock_level"):
			$objPHPExcel->getActiveSheet()->mergeCells('A1:G1');
			$objPHPExcel->getActiveSheet()->setCellValue('A1', $excel_data['excel_title']);
			$objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($styleArray);
		
		endif;
		
		$rowExec = 2;
		$column = 0;
		//Looping through the cells
		
		foreach ($excel_data['column_data'] as $column_data) 
		{
			$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $column_data);
			$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($column)) -> setAutoSize(true);
			//$objPHPExcel->getActiveSheet()->getStyle($column, $rowExec)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($column, $rowExec)->getFont()->setBold(true);
			$column++;
		}		
		
		$rowExec = 3;
				
		foreach ($excel_data['row_data'] as $row_data) 
		{
			$column = 0;
	        foreach($row_data as $cell)
	        {
	        	//Looping through the cells per facility
				$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
				$column++;	
			}
        	
        	$rowExec++;
		}

		$objPHPExcel -> getActiveSheet() -> setTitle('Simple');
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');

    	// We'll be outputting an excel file
		if(isset($excel_data['report_type']))
		{
			$objWriter->save("./print_docs/excel/excel_files/".$excel_data['file_name'].'.xls');
			//exit;
	   	} else{
	   		// We'll be outputting an excel file
			header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	        header("Cache-Control: no-store, no-cache, must-revalidate");
	        header("Cache-Control: post-check=0, pre-check=0", false);
	        header("Pragma: no-cache");
			// It will be called file.xls
			header("Content-Disposition: attachment; filename=".$excel_data['file_name'].'.xls');
			// Write file to the browser
	        $objWriter -> save('php://output');
	       $objPHPExcel -> disconnectWorksheets();
	       unset($objPHPExcel);
	   }
		
	endif;
}
 


	public function create_pdf($pdf_data = NULL, $district_id = NULL, $html_body = NULL) {
		//echo $district_id;
		//exit;
		if (count($pdf_data) > 0) :
			$url = base_url() . 'assets/img/coat_of_arms.png';
			$html_title = "<div align=center><img src='$url' height='70' width='70'style='vertical-align: top;'> </img></div>
		<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
		Ministry of Health</div>
		<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>
		Health Commodities Management Platform</div>
		<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>
		Weekly Reports</div><hr/>";

			$table_style = '<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
		table.data-table th {border: none;color: #036;text-align: center;border: 1px solid #DDD;border-top: none;max-width: 450px;}
		table.data-table td, table th {padding: 4px;}
		table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
		</style>';
			//$name=$this -> session -> userdata('full_name');

			$this -> mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
			$this -> mpdf -> ignore_invalid_utf8 = true;
			$this -> mpdf -> WriteHTML($html_title);
			$this -> mpdf -> defaultheaderline = 1;
			$this -> mpdf -> simpleTables = true;
			$this -> mpdf -> WriteHTML($table_style . $pdf_data);
			$this -> mpdf -> SetFooter("{DATE D j M Y }|{PAGENO}/{nb}|Prepared by: HCMP");
			//$this -> mpdf -> Output($report_name, 'I');
			//exit;
			$report_name = "Weekly Report.pdf";
			$path = $_SERVER["DOCUMENT_ROOT"];
			$handler = $path . "/HCMPv2/pdf/" . $report_name;
			write_file($handler, $this -> mpdf -> Output($report_name, 'S'));
			//$email_address = "collinsojenge@gmail.com";
			$message = $html_body;
			//echo $html_body;
			//exit;
			$subject = "Weekly Reports";
			//Get the email address of the dpp to whom the email is going to
			$email_address = $this -> get_ddp_email($district_id);
			//$email_address = "collinsojenge@gmail.com";
			$this -> hcmp_functions -> send_email($email_address, $message, $subject, $handler);
		endif;
	}

	function email_sender($report_name) {

		//setting the connection variables
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'ssl://smtp.googlemail.com';
		$config['smtp_port'] = 465;
		$config['smtp_user'] = stripslashes('hcmpkenya.test@gmail.com');
		$config['smtp_pass'] = stripslashes('verystrongpassword');
		ini_set("SMTP", "ssl://smtp.gmail.com");
		ini_set("smtp_port", "465");
		ini_set("max_execution_time", "50000");

		$emails = "collinsojenge@gmail.com";

		//pulling emails from the DB
		$this -> load -> library('email', $config);
		$path = $_SERVER["DOCUMENT_ROOT"];
		$file = $path . "/HCMPv2/application/assets/pdf/" . $report_name;
		//puts the path where the pdf's are stored

		foreach ($emails as $email) {
			$this -> email -> attach($file);
			$address = $email['email'];
			$this -> email -> set_newline("\r\n");
			$this -> email -> from('hcmpkenya.test@gmail.com', "HCMP Kenya");
			//user variable displays current user logged in from sessions
			$this -> email -> to("$address");
			$this -> email -> subject('Weekly HCMP Report ');
			$this -> email -> message('Please find the Report Attached');

			//success message else show the error
			if ($this -> email -> send()) {
				echo 'Your email was sent, successfully to ' . $address . '<br/>';
				//unlink($file);
				$this -> email -> clear(TRUE);

			} else {
				show_error($this -> email -> print_debugger());
			}

		}
		ob_end_flush();
		unlink($file);
		//delete the attachment after sending to avoid clog up of pdf'ss
	}
}