<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Raw_data extends MY_Controller {
		function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
		
		
	}

	public function index() {
		$this -> listing();
	}
	public function reports_Home()
	{
		
		$data['title'] = "Reports Home";
		$data['quick_link'] = "Reports";
		$data['content_view'] = "reportsmain";
		$data['link'] = "raw_data";   
		$data['banner_text'] = "Reports Home";
		$data['link'] = "Reports";
		$this -> load -> view("template", $data);
	}
	
	public function stockchtml()
{
		$from=$_POST['from'];
		$to=$_POST['to'];
		$desc=$_POST['desc'];
		$drugname=$_POST['drugname'];
		$id=$this -> session -> userdata('identity');
		$req_data = array('from'=>$from,'to'=>$to,'desc'=>$desc,'drugname'=>$drugname);
		$this -> session -> set_userdata($req_data);
		$data['report'] = Facility_Issues::getAll();
		$mycount= count(Facility_Issues::getAll());
		
		if ($mycount>0) {
		
			$this -> load -> view("stockchtml", $data);
			
		} else {
			echo '<div class="norecord"></div>';
		}

}
public function commoditieshtml()
{
		$from=$_POST['fromcommodity'];
		$to=$_POST['tocommodity'];
		$facility_Code=$_POST['facilitycode'];
		$id=$this -> session -> userdata('identity');
		//echo "$from";
	
		$req_data = array('from'=>$from,'to'=>$to);
		$this -> session -> set_userdata($req_data);
		//$data['title'] = "Commodity Issues Summary";
				
		$mycount= count(Facility_Issues::getcissues());
		if ($mycount>0) {
			$data['reports'] = Facility_Issues::getcissues();
			$data['names'] = User::getsome($id);
			$data['drugs'] = Drug::getAll();
			$this -> load -> view("commodityIssues", $data);
			
		} else {
			echo '<div class="norecord"></div>';
		}
		
		
		
}
public function get_stockcontrolpdf(){
	
		$from=$_POST['datefromStockC'];
		$to=$_POST['datetoStockC'];
		$desc=$_POST['desc'];
		$drugname=$_POST['drugname'];
		$facility_Code=$_POST['facilitycode'];
		$facility=$this -> session -> userdata('news');
		$id=$this -> session -> userdata('identity');
		$report_name='Stock Control Card from '.$from.' to '.$to.' '.($drugname);
		$report = Facility_Issues::getAll();
		$names= User::getsome($id);
		
		$title='test';
		
			
											/**************************************set the style for the table****************************************/

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';


		$html_data1 ='';	
		
		/*****************************setting up the report*******************************************/

$html_data1 .='<table class="data-table"><thead>

			<tr > <th ><strong>Date</strong></th>
			<th><strong>Reference/S11 No</strong></th>
			<th><strong>Batch No</strong></th>
			<th><strong>Expiry Date</strong></th>
			<th><strong>Receipts/Opening Bal.</strong></th>
			<th><strong>Issues</strong></th>
			<th><strong>Closing Bal.</strong></th>
			<th><strong>Issuing/Receiving Officer</strong></th>
			<th ><strong><b>Service Point</b></strong></th>
			

</tr> </thead><tbody>';

/*******************************begin adding data to the report*****************************************/

	foreach($report as $user){
			
				foreach($user->Code as $d){
								$fname=$d->fname;
					            $lname=$d->lname; 
								$thedate=$user->date_issued;
								$thedate1=$user->expiry_date;
								$formatme = new DateTime($thedate);
								$formatme1 = new DateTime($thedate1);
       							 $myvalue= $formatme->format('d M Y');
       							 $myvalue1= $formatme1->format('d M Y');					    
							    }
							
		 $html_data1 .='<tr><td>'.$myvalue.'</td>
							<td>'.$user->s11_No.'</td>
							<td>'.$user->batch_no.'</td>
							<td>'.$myvalue1.'</td>
							<td>'.$user->balanceAsof+$user->qty_issued.'</td>
							<td >'.$user->qty_issued.'</td>
							<td >'.$user->balanceAsof.'</td>
							<td>'.$lname.'  '.$fname.'</td>
							<td >'.$user->issued_to.'</td>
							
							</tr>';

/***********************************************************************************************/
					
		  }
		$html_data1 .='</tbody></table>';

		
			$html_data .= $html_data1;
		
		
         
	  	$this->generatescc_pdf($report_name,$title,$html_data,$to,$from,$drugname);
		
				
			}
public function generatescc_pdf($report_name,$title,$data,$to,$from,$drugname)
{
		/********************************************setting the report title*********************/
			
		$html_title="<img src='".base_url()."Images/coat_of_arms.png' style='position:absolute;  width:130px; width:130px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;'></img></br>
		<span style=' margin-left:100px; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;'></br>
     Ministry of Public Health and Sanitation/Ministry of Medical Services</span></br>
       <span style='display: block; font-size: 12px; margin-left:100px;'>Health Commodities Management Platform</span><span style='text-align:center;' >
       <h2 style='text-align:center; font-size: 20px;'>Stock Control Card</h2>
       <h2 style='text-align:center; font-size: 12px;'>".$drugname."</h2>
       <h2 style='text-align:center; font-size: 12px;'>Between ".$from." & ".$to."</h2>
       <hr /> 
        
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

public function get_commodityIpdf(){
	
		$from=$_POST['datefromB'];
		$to=$_POST['datetoB'];
		$facility_Name=$_POST['facilitycode1'];
		$report_name='Commodity Issues Summary Between '.$from.' & '.$to;
		$report = Facility_Issues::getcissues();
		//$names= User::getsome($id);
		
		$title='test';
		
			
											/**************************************set the style for the table****************************************/

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';


		$html_data1 ='';	
		
		/*****************************setting up the report*******************************************/

$html_data1 .='<table class="data-table"><thead>

			<tr > 
			<th ><strong>Kemsa Code</strong></th>
			<th ><strong>Description</strong></th>
			<th ><strong>Date</strong></th>
			<th><strong>Reference/S11 No</strong></th>
			<th><strong>Batch No</strong></th>
			<th><strong>Expiry Date</strong></th>
			<th><strong>Receipts/Opening Bal.</strong></th>
			<th><strong>Issues</strong></th>
			<th><strong>Closing Bal.</strong></th>
			<th><strong>Issuing/Receiving Officer</strong></th>
			<th ><strong><b>Service Point</b></strong></th>
			

</tr> </thead><tbody>';

/*******************************begin adding data to the report*****************************************/

	foreach($report as $user){
			
				foreach($user->Code as $d){
					foreach ($user->stock_Drugs as $value) {
								
							$drugsname=$value->Drug_Name;
							$code=$value->Kemsa_Code;
								$fname=$d->fname;
					            $lname=$d->lname; 
								$thedate=$user->date_issued;
								$thedate1=$user->expiry_date;
								$formatme = new DateTime($thedate);
								$formatme1 = new DateTime($thedate1);
       							 $myvalue= $formatme->format('d M Y');
       							 $myvalue1= $formatme1->format('d M Y');					    
							    
							
		 $html_data1 .='<tr>
		 
		 					<td>'.$code.'</td>
		 					<td>'.$drugsname.'</td>
		 					<td>'.$myvalue.'</td>
							<td>'.$user->s11_No.'</td>
							<td>'.$user->batch_no.'</td>
							<td>'.$myvalue1.'</td>
							<td>'.$user->balanceAsof+$user->qty_issued.'</td>
							<td >'.$user->qty_issued.'</td>
							<td >'.$user->balanceAsof.'</td>
							<td>'.$lname.'  '.$fname.'</td>
							<td >'.$user->issued_to.'</td>
							
							</tr>';

/***********************************************************************************************/
					
		  }
				}
					}
		$html_data1 .='</tbody></table>';

		
			$html_data .= $html_data1;
		
		
         
	  	$this->generatecommodityI_pdf($report_name,$title,$html_data,$to,$from,$facility_Name);
		
				
			
			}
public function generatecommodityI_pdf($report_name,$title,$data,$to,$from,$facility_Name)
{
		/********************************************setting the report title*********************/
			
		$html_title="<img src='".base_url()."Images/coat_of_arms.png' style='position:absolute;  width:130px; width:130px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;'></img></br>
		<span style=' margin-left:100px; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;'></br>
     Ministry of Public Health and Sanitation/Ministry of Medical Services</span></br>
       <span style='display: block; font-size: 12px; margin-left:100px;'>Health Commodities Management Platform</span><span style='text-align:center;' >
       <h2 style='text-align:center; font-size: 20px;'>Commodity Issues Summary</h2>
       <h2 style='text-align:center; font-size: 12px;'>Between ".$facility_Name."</h2>
       <h2 style='text-align:center; font-size: 12px;'>Between ".$from." & ".$to."</h2>
       <hr /> 
        
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

public function gen_pdf(){
	$timeinterval=$_POST['timer'];
	$facility_c=$this -> session -> userdata('news');
	$report=Facility_Stock::expiries($facility_c,$timeinterval);
	
	$report_name='Potential Expiries '.$facility_c.' Next '.$timeinterval.'Months';
	$title='test';
										/**************************************set the style for the table****************************************/

$html_data='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;background-color: #F5F5F5;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
.col5{background:#C9C299;}</style>';


		$html_data1 ='';	
		
		/*****************************setting up the report*******************************************/

$html_data1 .='<table class="data-table"><thead>

			<tr > 
			<th><strong>Kemsa Code</strong></th>
		<th><strong>Description</strong></th>
		<th><strong>Unit size</strong></th>
		<th><strong>Unit Cost</strong></th>
		<th><strong>Batch No</strong></th>
		<th><strong>Expiry Date</strong></th>
		<th><strong><b>Units</b></strong></th>
		<th><strong><b>Stock Worth(Ksh)</b></strong></th>
	</tr><tbody>';

/*******************************begin adding data to the report*****************************************/

	foreach($report as $drug){
			
				
					foreach($drug->Code as $d){ 
								$name=$d->Drug_Name;
								$code=$d->Kemsa_Code;
					            $unitS=$d->Unit_Size; 
								$unitC=$d->Unit_Cost;
								$calc=$drug->balance;
								$thedate=$drug->expiry_date;
								$formatme = new DateTime($thedate);
								 $myvalue= $formatme->format('d M Y');					    
							    
							
		 $html_data1 .='<tr>
		 
		 					<td>'.$code.'</td>
		 					<td>'.$name.'</td>
		 					<td>'.$unitS.'</td>
							<td>'.$unitC.'</td>
							<td>'.$drug->batch_no.'</td>
							<td>'.$myvalue.'</td>
							<td>'.$drug->balance.'</td>
							<td >'.$calc*$unitC.'</td>
							
							
							</tr>';

/***********************************************************************************************/
					
		  }
				
					}
		$html_data1 .='</tbody></table>';

		
			$html_data .= $html_data1;
			
			$date = new DateTime();
		$interval = new DateInterval('P'.$timeinterval.'M');

		$date->add($interval);
		$formateddate= $date->format('M-d-Y') . "\n";

				
	  	$this->generatePE_pdf($report_name,$title,$html_data,$facility_c,$timeinterval,$formateddate);
		
	
}

public function generatePE_pdf($report_name,$title,$html_data,$facility_c,$timeinterval,$formateddate)
{
		/********************************************setting the report title*********************/
		
		$date = new DateTime();	
		$date=$date->format('M-d-Y');
		$html_title="<img src='".base_url()."Images/coat_of_arms.png' style='position:absolute;  width:130px; width:130px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;'></img></br>
		<span style=' margin-left:100px; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;'></br>
     Ministry Health </span></br>
       <span style='display: block; font-size: 12px; margin-left:100px;'>Health Commodities Management Platform</span><span style='text-align:center;' >
       <h2 style='text-align:center; font-size: 20px;'>Potential Expiries Summary</h2>
       <h2 style='text-align:center; font-size: 12px;'>In The Next ".$timeinterval." Months (".$date." to ".$formateddate.")</h2>
       <hr /> ";
		
		///**********************************initializing the report **********************/
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



	}
	
	
	
	
	
	
	
	
	
	
