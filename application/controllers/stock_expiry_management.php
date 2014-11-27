<?php
include_once 'auto_sms.php';
class Stock_Expiry_Management extends auto_sms {

	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
	}
	
	public function index() {
		$data['title'] = "Potential expiries";
		$data['content_view'] = "stockouts_v";
		$data['banner_text'] = "Potential expiries";
		$data['link'] = "Emergecy";
		$data['quick_link'] = "Emergecy";
		$this -> load -> view("template", $data);
	}
	public function default_expiries($facility_code=null){
		//////
		$facility_c=isset($facility_code)? $facility_code :$this -> session -> userdata('news');
		
		$facility_detail=Facilities::get_facility_name_($facility_c);
        $data['facility_data']=$facility_detail;
		$data['title'] = "Potential expiries";;
        $data['banner_text'] = "Potential expiries";
		$facility_data=Facility_Stock::expiries($facility_c);
		$data['report']=$facility_data;
		$data['facility_code']=$facility_c;
		
		$data['content_view'] = "facility/facility_reports/potential_expiries_v";
		
	    $mycount= count($facility_data);
		if ($mycount>0) {
			
			isset($facility_code)? $this -> load -> view("template", $data)  :$this -> load -> view("facility/facility_reports/potential_expiries_v", $data);
		
			
		} else {
			echo '<div class="norecord"></div>';
		}
	}
		public function default_expiries_notification(){
		
		$facility_c=$this -> session -> userdata('news');
		$data['report']=Facility_Stock::expiries($facility_c);
		$data['title'] = "Potential expiries";
		$data['content_view'] = "potential_expiries_v";
		$data['banner_text'] = "Potential expiries";
		$data['link'] = "Potential expiries";
		$data['quick_link'] = "Potential expiries";
	    $mycount= count(Facility_Stock::expiries($facility_c));
		if ($mycount>0) {
			$this -> load -> view("template", $data);
		} else {
			echo '<div class="norecord"></div>';
		}
				
	}
public function get_expiries($facility_code=null){
		$checker=$_POST['id'];
		//echo $checker;
		$facility=isset($facility_code)? $facility_code :$this -> session -> userdata('news');
		
		$facility_detail=Facilities::get_facility_name_($facility_c);
        $data['facility_data']=$facility_detail;
		
			switch ($checker)
			{
				case '6months':
					$date= date('Y-m-d', strtotime('+6 months'));
					$date1=date('Y-m-d');
					$data['report']=Facility_Stock::getStockouts($date,$facility,$date1);
					break;
					case '3months':
						$date= date('Y-m-d', strtotime('+3 month'));
						$date1=date('Y-m-d');
					    $data['report']=Facility_Stock::getStockouts($date,$facility,$date1);
					break;
						case '12months':
						$date= date('Y-m-d', strtotime('+12 month'));
						$date1=date('Y-m-d');
					    $data['report']=Facility_Stock::getStockouts($date,$facility,$date1);
						break;
								default :
								$data['report']=Facility_Stock::expiries($facility);			
			}
		
				$this -> load -> view("potential_expiries_v", $data);
	}

//function to generate report on potential expiries
public function get_expiry(){
	//$option=$this->uri->segment(3);
		$i=$_POST['interval'];
		$facility=$this -> session -> userdata('news');
		$drug_name=Drug::get_drug_name();
		$title='test';
		
			
			switch ($i)
			{
				case '6_months'://for 6 months
					$date= date('Y-m-d', strtotime('+6 months'));
					$date1=date('Y-m-d');
					$report=Facility_Stock::getStockouts($date,$facility,$date1);
					$report_name="Drugs Expiring in next 6 Months ";
					break;
					case '2_months'://for 3 months
						$date= date('Y-m-d', strtotime('+2 month'));
						$date1=date('Y-m-d');
					    $report=Facility_Stock::getStockouts($date,$facility,$date1);
					$report_name="Drugs Expiring in next 2 Months ";
					break;
						case '12_months'://for a year
						$date= date('Y-m-d', strtotime('+12 month'));
						$date1=date('Y-m-d');
					    $report=Facility_Stock::getStockouts($date,$facility,$date1);
					$report_name="Drugs Expiring in next 1 Year ";
						break;
								default :
								$data['stockouts']=Facility_Stock::expiries($facility);	
								$report_name="Drugs Expiring in next 1 Year ";
									
			}
									/**************************************set the style for the table****************************************/

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';


		$html_data1 ='';	
		
		/*****************************setting up the report*******************************************/

$html_data1 .='<table class="data-table"><thead>

			<tr > <th ><strong>Kemsa Code</strong></th>
			<th><strong>Description</strong></th>
			<th><strong>Unit size</strong></th>
			<th><strong>Unit Cost</strong></th>
			<th><strong>Batch No</strong></th>
			<th><strong>Expiry Date</strong></th>
			<th ><strong><b>Units</b></strong></th>
			<th ><strong><b>Stock Worth(Ksh)</b></strong></th>

</tr> </thead><tbody>';

/*******************************begin adding data to the report*****************************************/

	foreach($report as $drug){
			
				foreach($drug->Code as $d){
								$name=$d->Drug_Name;
								$code=$d->Kemsa_Code;
					            $unitS=$d->Unit_Size; 
								$unitC=$d->Unit_Cost;
							    
							    }
							$calc=$drug->balance;
		 $html_data1 .='<tr><td>'.$code.'</td>
							<td>'.$name.'</td>
							<td>'.$unitS.'</td>
							<td>'.$unitC.'</td>
							<td >'.$drug->batch_no.'</td>
							<td>'.$drug->expiry_date.'</td>
							<td >'.$drug->balance.'</td>
							<td >'.$calc*$unitC.'</td>
							</tr>';

/***********************************************************************************************/
					
		  }
		$html_data1 .='</tbody></table>';

		
			$html_data .= $html_data1;
		
		
         
	  	//$this->generate_pdf($report_name,$title,$html_data);
		$this->getpdf($report_name,$title,$html_data);
				
			}

public function generate_pdf($report_name,$title,$data){
		
		      	
        $html_title= '<link href="'.base_url().'CSS/style.css" type="text/css" rel="stylesheet"/> 
				<img src="'.base_url().'Images/coat_of_arms.png" style="position:absolute;  width:100px; width:100px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
		 <div id="system_title">
		<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Public Health and Sanitation/Ministry of Medical Services</span>
		<span style="display: block; font-size: 12px;">Health Commodities Management Platform</span>
		</div>
		</div>
		<span style="display: block; font-size: 24px; font-weight: bold; text-align:center; font-family:georgia,garamond,serif;">'.$report_name.'</span></br>
		<div align="center"> 
		<form action="'.base_url().'Stock_Expiry_Management/get" >
		<button class="btn1" ></button>
		 </form></div>
		<span style="text-align:center;" ></br><hr /> 
        ';
		
            echo $html_title.$data;

        }

public function getpdf($report_name,$title,$data)
{
		/********************************************setting the report title*********************/
			
		$html_title="<img src='".base_url()."Images/coat_of_arms.png' style='position:absolute;  width:160px; width:160px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;'></img>
       <h2 style='text-align:center;'>".$report_name."</h2><br><br>
       <span style=' margin-left:500px; text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
     Ministry of Public Health and Sanitation/Ministry of Medical Services</span><br>
       <span style='display: block; font-size: 12px;'>Health Commodities Management Platform</span><span style='text-align:center;' ><hr /> 
        <span><p style='font-weight: bold;'>Kemsa Code:</p><p style='font-weight: bold;'> Drug Description:</p>
         ";
		
		///**********************************initializing the report **********************/
            $this->load->library('mpdf');
           $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
           $this->mpdf->SetTitle($title);
           $this->mpdf->WriteHTML($html_title);
           $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML('<br/>');
            $this->mpdf->WriteHTML($data);
			$report_name = $report_name.".pdf";
           $this->mpdf->Output($report_name,'D');
			
		
		
}

public function Decommission1(){
	$date= date('Y-m-d');
		$facility=$this -> session -> userdata('news');
			$decom=Facility_Stock::getdecommissioned($date,$facility);
			echo $decom;	
}

public function expired($facility_code=NULL) {
		$date= date('Y-m-d');
		
		$facility= (!isset($facility_code))?		
		$this -> session -> userdata('news')
		:$facility_code;
		
		$district=$this -> session -> userdata('district1');

		$data['dpp_array']=User::get_dpp_details($district)->toArray();

		$data['title'] = "Expired Products";
		$data['content_view'] = "facility/facility_reports/expire_v";
		$data['banner_text'] = "Expired Products";
		$data['expired']=Facility_Stock::getexp($facility,'decommission');

		$this -> load -> view("template", $data);
	}

public function county_expiries() {
		$date= date('Y-m-d');
		$county=$this -> session -> userdata('county_id');
		$data['title'] = "Expired Products";
		$data['content_view'] = "county/county_stock_data/county_expiries_v";
		$data['banner_text'] = "Expired Products";
		$data['potential_expiries']=Counties::get_potential_expiry_summary($county);
		$data['expired2']=Counties::get_county_expiries($date,$county);		
		$data['link'] = "county_expiries_v";
		$data['quick_link'] = "county_expiries_v";

		$this -> load -> view("template", $data);
	}


	public function district_expiries($district=NULL) {
		
		$date= date('Y-m-d');
		$county=$this -> session -> userdata('county_id');
		$data['title'] = "Expired Products";
		$data['content_view'] = "county/district_expiries_v";
		$data['banner_text'] = "Expired Products";
		$data['expired']=Districts::get_district_expiries($date,$district);
		$data['potential_expiries']=Counties::get_potential_expiry_summary($county);
		$data['link'] = "district_expiries_v";
		$data['quick_link'] = "district_expiries_v";

		$this -> load -> view("county/district_expiries_v", $data);
	}

	public function county_potential_expiries($facility_code=NULL){
		if (!isset($facility_code)) {			
			$facility_c=$this -> session -> userdata('news');
		}else{
			$facility_c=$facility_code;
		}		
		$data['title'] = "Potential Expiries";
		$data['content_view'] = "county/county_potential_expiries_v";
		$data['banner_text'] = "Expired Products";
		$data['report']=Facility_Stock::expiries($facility_c);
	    $data['mycount']= count(Facility_Stock::expiries($facility_c));

		$data['expired']=Districts::get_district_expiries($date,$district);
		$data['potential_expiries']=Counties::get_potential_expiry_summary($county);
		
		$data['table_body2']="";
		if (count($data['expired'])) {
		foreach ($data['expired'] as $item) {
			$data['table_body2'].="<tr>
			<td>".$item['facility_code']."</td>
			<td>".$item['facility_name']."</td>
			<td>".$item['balance']."</td>
			<td><a href=".site_url('stock_expiry_management/expired/'.$item['facility_code'])." class='link'>View</a></td>
			</tr>";
			}
		}
			else{
			$data['table_body2']="<div id='notification'>No records found</div>";
		}

		$this -> load -> view("template", $data);
	}
	public function county_get_potential_expiries(){
		$checker=$_POST['id'];
		$county=$this -> session -> userdata('county_id');
				
			switch ($checker)
			{
				case '6months':
					$date= date('Y-m-d', strtotime('+6 months'));
					$date1=date('Y-m-d');
					$data['potential_expiries']=Counties::get_county_p_stockouts($date,$county,$date1);
					break;
					case '3months':
						$date= date('Y-m-d', strtotime('+3 month'));
						$date1=date('Y-m-d');
					    $data['potential_expiries']=Counties::get_county_p_stockouts($date,$county,$date1);
					break;
						case '12months':
						$date= date('Y-m-d', strtotime('+12 month'));
						$date1=date('Y-m-d');
					    $data['potential_expiries']=Counties::get_county_p_stockouts($date,$county,$date1);
						break;
								default :
								$data['potential_expiries']=Counties::get_potential_expiry_summary($county);			
			}
		
				$this -> load -> view("county/county_potential_expiries_v", $data);
	}


	public function district_potential_expiries($district=NULL) {
		$date= date('Y-m-d');
		$county=$this -> session -> userdata('county_id');
		$data['title'] = "Expired Products";
		$data['content_view'] = "county/district_potential_expiries_v";
		$data['banner_text'] = "Expired Products";
		$data['expired']=Districts::get_district_expiries($date,$district);
		$data['potential_expiries']=Counties::get_potential_expiry_summary($county);
		$data['link'] = "county/district_expiries_v";
		$data['quick_link'] = "county/district_expiries_v";
		$data['table_body']="";
		if (count($data['potential_expiries'])>0) {		
		foreach ($data['potential_expiries'] as $item) {
		$data['table_body'].="<tr><td>".$item['facility_code']."</td>
			<td>".$item['facility_name']."</td>
			<td>".$item['balance']."</td>
			<td><a href=".site_url('stock_expiry_management/county_potential_expiries/'.$item['facility_code'])." class='link'>View</a></td>
			</tr>}";
		}
		}else{
			$data['table_body']="<div id='notification'>No records found</div>";
		}
		$this -> load -> view("county/district_potential_expiries_v", $data);
	}
	
	public function county_deliveries() {
		//$date= date('Y-m-d');
		$county=$this -> session -> userdata('county_id');
		$data['title'] = "Deliveries";
		$data['content_view'] = "county/county_stock_data/county_deliveries_v";
		$data['banner_text'] = "Deliveries";
		$data['delivered']=Counties::get_county_received($county);
		$data['pending']=Counties::get_pending_county($county);
		$data['approved']=Counties::get_approved_county($county);
		$data['order_counts']=Counties::get_county_order_details($county);
		$data['rejected']=Counties::get_rejected_county($county);
		$data['link'] = "county/county_deliveries_v";
		$data['quick_link'] = "county/county_deliveries_v";

		$this -> load -> view("template", $data);
	}
public function district_deliveries($district=NULL) {
		
		$date= date('Y-m-d');
		$data['title'] = "Deliveries";
		$data['content_view'] = "county/district_deliveries_v";
		$data['banner_text'] = "Deliveries";
		$data['delivered']=Counties::get_district_received($district);
		$data['link'] = "county/district_expiries_v";
		$data['quick_link'] = "county/district_expiries_v";
		$data['table_body3']="";
		if (count($data['delivered']>0)) {
		foreach ($data['delivered'] as $item) {
		$data['table_body3'].="<tr>
		<td>".$item['facility_code']."</td>
		<td>".$item['facility_name']."</td>
		<td>".$item['orderTotal']."</td>
		<td><a href=".site_url('order_management/moh_order_details/'.$item['id'])." class='link'>View</a></td>
		</tr>";
		}
		}else{
			$data['table_body3']="<div id='notification'>No records found</div>";
		}
	
		$this -> load -> view("county/district_deliveries_v", $data);
	}
public function facility_report_expired($facility_code=null,$district_id=null) {
		$date= date('Y-m-d');
		
		$facility=isset($facility_code)? $facility_code :$this -> session -> userdata('news');
		$district=isset($district_id)? $facility_code :$this -> session -> userdata('district');
		
		$facility_detail=Facilities::get_facility_name_($facility);
        $data['facility_data']=$facility_detail;
		$data['dpp_array']=User::get_dpp_details($district);
		$data['title'] = "Expired Products";
		$data['content_view'] = "facility/facility_reports/facility_report_expired_v";
		$data['banner_text'] = "Expired Products";
		$data['expired']=Facility_Stock::getexp($facility);		
		$data['link'] = "facility/facility_reports/facility_report_expired_v";
		$data['quick_link'] = "facility_report_expired_v";		
		isset($facility_code)? $this -> load -> view("template", $data) :$this -> load -> view("facility/facility_reports/facility_report_expired_v", $data);
		
		
	}
	public function get_decommission_report_pdf() {
		$facilityCode= $this-> session-> userdata('news');
		$date= date('Y-m-d');
		$date2= date('d-M-Y');
		$facility=$this -> session -> userdata('news');
		$current_year = date('Y');
		$current_month = date('F');
		$current_monthdigit = date('m');
		$id=$this -> session -> userdata('identity');
		$report_name='Decommission Report for ' .$date2;
		$title='Expired Commodities as of ' .$date2;
		$expired=Facility_Stock::getexp($date,$facility);

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';

$html_data1 = '';

$html_data1 .='<table class="data-table"><thead>
	<tr>
		<th>KEMSA Code</th>
		<th>Description</th>
		<th>Batch No Affected</th>
		<th>Manufacturer</th>
		<th>Expiry Date</th>
		<th>Unit size</th>
		<th>Stock Expired(Unit Size)</th>
	
	</tr></thead><tbody>';
	
				foreach ($expired as $drug ) {
					foreach($drug->Code as $d){ 
								$name=$d->Drug_Name;
								$code=$d->Kemsa_Code;
					            $unitS=$d->Unit_Size; 
								$unitC=$d->Unit_Cost;
								$calc=$drug->balance;
								$thedate=$drug->expiry_date;
								$formatme = new DateTime($thedate);
								 $myvalue= $formatme->format('d M Y');
		
	$html_data1 .='		<tr>
							
							<td>'.$code.'</td>
							<td>'.$name.'</td>
							<td>'.$drug->batch_no.'</td>
							<td>'.$drug->manufacture.'</td>
							<td>'.$myvalue.'</td>
							<td>'.$unitS.'</td>
							<td>'.$drug->quantity.'</td>					
						</tr>';
					}
					}			
		$html_data1 .='</tbody></table>';
$html_data .=$html_data1;
$this->generate_decommission_report_pdf($report_name,$title,$html_data);
}
public function generate_decommission_report_pdf($report_name,$title,$html_data) {
	    $current_year = date('Y');
		$current_month = date('F');
		$facility_code=$this -> session -> userdata('news');
		$facility_name_array=Facilities::get_facility_name($facility_code)->toArray();
		$facility_name=$facility_name_array['facility_name'];
		$districtName = $this->session->userdata('full_name');
					
	/********************************************setting the report title*********************/
			
		$html_title="<div ALIGN=CENTER><img src='".base_url()."Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
      <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold;'>".$report_name."</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 14px; display: block; font-weight: bold; '>
       Ministry of Public Health and Sanitation/Ministry of Medical Services</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>".$districtName." District</h2>
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif; font-size: 12px; display: block; font-weight: bold;'>".$current_month." ".$current_year."</h2>
       <hr />   ";
		

		$css_path=base_url().'CSS/style.css';
		
		/**********************************initializing the report **********************/
            $this->load->library('mpdf');
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->SetTitle($title);
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML('<br/>');
            $this->mpdf->WriteHTML($html_data);
			$report_name = $report_name.".pdf";
            $this->mpdf->Output($report_name,'D');
}
public function Decommission() {
	//Change status of commodities to decommissioned

	   $date= date('Y-m-d');
	   $facility=$this -> session -> userdata('news');
	   $facility_code=$this -> session -> userdata('news');
	   $user_id=$this -> session -> userdata('user_id');
	
		$facility_name_array=Facilities::get_facility_name_($facility_code);
		$facility_name=$facility_name_array['facility_name'];
		$districtName = $this->session->userdata('full_name' );

		$myobj1 = Doctrine::getTable('Districts')->find($facility_name_array['district']);
		$disto_name=$myobj1->district;
		$county=$myobj1->county;
		$myobj2 = Doctrine::getTable('Counties')->find($county);
		$county_name=$myobj2->county;
		$myobj3 = Doctrine::getTable('user')->find($user_id);
		$creator_name1=$myobj3 ->fname;
		$creator_name2=$myobj3 ->lname;

			$total=0;
			//Create PDF of Expired Drugs that are to be decommisioned. check here 
			$decom=Facility_Stock::get_facility_expired_stuff($date,$facility);
			
			
			//create the report title
	$html_title="<div ALIGN=CENTER><img src='Images/coat_of_arms.png' height='70' width='70'style='vertical-align: top;' > </img></div>
    
       <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
       Ministry of Health</div>
        <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Health Commodities Management Platform</div>
         <div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>Expired Commodities Between ".date("F",
    strtotime("-1 month"))." - ".date("F")." ".date('Y')."</div><hr />   ";;
		
		/*****************************setting up the report*******************************************/
$html_body ='';		
$html_body.='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>'.
"<table class='data-table' width=100%>
<tr>
<td>MFL No: $facility_code</td> 
<td>Health Facility Name: $facility_name</td>
<td>County: $county_name</td> 
<td>Subcounty: $disto_name</td>
</tr>
</table>"
.'
<table class="data-table" width=100%>
<thead>

			<tr><th><strong>Source</strong></th>
			<th><strong>Description</strong></th>
			<th><strong>Unit Size</strong></th>
			<th><strong>Batch No Affected</strong></th>
			<th><strong>Manufacturer</strong></th>
			<th><strong>Expiry Date</strong></th>
			<th><strong># of Days From Expiry</strong></th>	
			<th><strong>Stock Expired(Unit Size)</strong></th>
			<th><strong>Unit Cost (Ksh)</strong></th>
			<th><strong>Cost of Expired (Ksh)</strong></th>
			
			

</tr> </thead><tbody>';

/*******************************begin adding data to the report*****************************************/

	foreach($decom as $drug){
		                        $drug_id=$drug['drug_id'];
		                        $batch=$drug['batch_no'];
								$mau=$drug['manufacture'];
								$name=$drug['drug_name'];
								$code=$drug['kemsa_code'];
								
								$code= isset($code) ? "KEMSA: code".$code  : '' ;

					            $unitS=$drug['unit_size'];
								$unitC=$drug['unit_cost'];
								$calc=($drug['balance']);
								$total_units=$drug['total_units'];
								$thedate=$drug['expiry_date'];
							    $balance=round(($calc/$total_units),1);
								$cost=$balance*$unitC;
								$formatme=new DateTime(	$thedate);
								$myvalue= $formatme->format('d M Y');	
								$total=$total+$cost;
								
			//get the current balance of the commodity					
			$facility_stock=Facility_Stock::get_facility_drug_total($facility,$drug_id)->toArray();					
											
			$mydata3 = array('facility_code'=>$facility,
			's11_No' => '(Loss) Expiry',
			'kemsa_code'=>$drug_id,
			'batch_no' => $batch,
			'expiry_date' => $thedate,
			'receipts' => ($calc*-1),
			'balanceAsof'=>$facility_stock[0]['balance'],
			'date_issued' => date('y-m-d'),
			'issued_to' => 'N/A',
			'issued_by' => $this -> session -> userdata('identity')
			);
			
			 $seconds_diff =strtotime(date("y-m-d"))-strtotime($myvalue);
			 $date_diff=floor($seconds_diff/3600/24);
			
			Facility_Issues::update_issues_table($mydata3);
			
			$inserttransaction_1 = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("select `losses` from `facility_transaction_table`
                                          WHERE `kemsa_code`= '$drug_id' and availability='1' and facility_code=$facility; ");

			$new_value=$inserttransaction_1[0]['losses']+$calc;
			
		   	$inserttransaction= Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction1 = Doctrine_Manager::getInstance()->getCurrentConnection();
			$inserttransaction2 = Doctrine_Manager::getInstance()->getCurrentConnection();
			
			     // update the transaction table with the loss
			$inserttransaction->execute("UPDATE `facility_transaction_table` SET losses =$new_value
                                          WHERE `kemsa_code`= '$drug_id' and availability='1' and facility_code=$facility; ");	
										  
              // update the transaction table with the new closing balance
                                          
            $inserttransaction1->execute("UPDATE `facility_transaction_table` SET closing_stock = (SELECT SUM(balance)
			 FROM facility_stock WHERE kemsa_code = '$drug_id' and status='1' and facility_code='$facility')
                                          WHERE `kemsa_code`= '$drug_id' and availability='1' and facility_code ='$facility'; ");  
                                           
             /// update the facility issues and set the commodity to expired                             
            $inserttransaction->execute("UPDATE `facility_stock` SET status =2
                                          WHERE `kemsa_code`= '$drug_id' and facility_code=$facility; ");	                            								    
				
		    $html_body .='<tr><td>'.$code.'</td>
							<td>'.$name.'</td>
							<td >'.$unitS.'</td>
							<td>'. $batch.'</td>
							<td>'.$mau.'</td>
							<td>'.$myvalue.'</td>
							<td>'.$date_diff.'</td>							
							<td >'.$calc.'</td>
							<td >'.$unitC.'</td>
							<td >'.number_format($cost, 2, '.', ',').'</td>	
							</tr>';

/***********************************************************************************************/
					
		  }
		$html_body .='
		<tr>
		<td colspan="10">
		<b style="float: right; margin-right:5.0em">TOTAL cost(Ksh) of Expiries: &nbsp; '.number_format($total, 2, '.', ',').'</b>
		</tr>
		</tbody>
		</table>'; 

			$this->load->library('mpdf');
			$this->load->helper('file');
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->defaultheaderline = 1;  
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML($html_body);
			$this->mpdf->SetFooter("{DATE d/m/Y }|{PAGENO}/{nb}|Prepared by: $creator_name1 $creator_name2");
			$report_name='Facility_Expired_Commodities_'.$facility."_".$date."_".$facility_name;
			
			
			
			if(!write_file( './pdf/'.$report_name.'.pdf',$this->mpdf->Output('$report_name','S')))
			{
    	 $this->session->set_flashdata('system_error_message', 'An error occured, when creating a PDF contact system ADMIN');
	     redirect("/");	
             }
                  else{
     
	
   if(!$this->send_stock_decommission_email($html_body,'Decommission Report For '.$facility,'./pdf/'.$report_name.'.pdf')){

   	delete_files('./pdf/'.$report_name.'.pdf');
   	$this->session->set_flashdata('system_success_message', 'Stocks Have Been Decommissioned');
	redirect("/");
	
   }
   else{
   		
    $this->session->set_flashdata('system_error_message', 'An error occured, the items were decommissioned but there was a problem in sending an email file:'.$report_name.'.pdf');
	redirect("/");	
	
   }
			
  }
			
			}
}

