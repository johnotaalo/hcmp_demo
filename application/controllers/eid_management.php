<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
 
include_once ('home_controller.php');

class Eid_Management extends Home_controller {

    function __construct() {
        parent::__construct();
		$this -> load -> library(array('PHPExcel/PHPExcel','mpdf/mpdf'));
		$this -> load -> helper(array("file","download"));
    }
	
	function addEmails(){
		$labs = $this ->getLabs();
		foreach ($labs as $key => $value) {
			$lab = $value['id'];
			
			 if ($lab == 1)//..NRB
	       {
	                      $email = 'matilu.mwau@gmail.com';
	                      $ContactEmailaddressa = 'kithinjilucy@gmail.com';                                                           
	                      $ContactEmailaddressb = 'stellavihenda@gmail.com';
	       }
	       else if ($lab == 2)//..KSM
	       {
	                      $email = 'cbz2@cdc.gov';
	                      $ContactEmailaddressa = 'LKingwara@kemricdc.org';                                                      
	                      $ContactEmailaddressb = 'AMorwabe@kemricdc.org';
	       }
	       else if ($lab == 3)//..ALUPE
	       {
	                      $email = 'matilu.mwau@gmail.com';
	                      $ContactEmailaddressa = 'jy_ndunda@yahoo.com';                                                           
	                      $ContactEmailaddressb = 'kasyne@gmail.com';   
	       }
	       else if ($lab == 4)//..KERICHO
	       {
	                      $email = 'argwings.miruka@usamru-k.org';           
	                      $ContactEmailaddressa = 'Sharon.Koech@usamru-k.org';                                               
	                      $ContactEmailaddressb = 'Anthony.Naibei@usamru-k.org';  
	       }
	       else if ($lab == 5)//..AMPATH
	       {
	                      $email = 'weinjera@yahoo.com';              
	                      $ContactEmailaddressa = 'skimaiyo@yahoo.com';                                                           
	                      $ContactEmailaddressb = 'mowlemp@yahoo.com';
	       }
	       else if ($lab == 6)//..COAST
	       {
	                      $email = 'mlangidd@yahoo.co.uk';
	                      $ContactEmailaddressa = 'kenga.dickson@yahoo.com';                                                  
	                      $ContactEmailaddressb = 'raphaeldume@yahoo.com';
	       }
	       else if ($lab == 7)//..nhrl
	       {
	                      $email = 'thomasgachuki@yahoo.com';
	                      $ContactEmailaddressa = 'joseombayo@yahoo.com';                                                      
	                      $ContactEmailaddressb = 'jescaratsyaya@yahoo.com';
	       }

			$data = array(
							"email"	=>$email,
							"lab"	=>$lab,
							"right"	=>"main"
							);
			$this ->db ->insert("eid_useremails",$data);
			$data = array(
							"email"	=>$ContactEmailaddressa,
							"lab"	=>$lab,
							"right"	=>"cca"
							);
			$this ->db ->insert("eid_useremails",$data);
			$data = array(
							"email"	=>$ContactEmailaddressb,
							"lab"	=>$lab,
							"right"	=>"ccb"
							);
			$this ->db ->insert("eid_useremails",$data);
		}
		        
		
	}
	
	function index(){
		$data = array();
		$data['labs'] = $this ->getLabs();
		$last_period =strtoupper(date('M  Y',strtotime("-1 month")));
		$data['last_period'] = $last_period;
		$labSubmissions = $this ->getLabSubmissions();
		$data['lab_submissions'] = $labSubmissions['submission_details'];
		$data['submission_rate'] = $labSubmissions['submission_rate'];
		$extras = $this ->getSubmissionYears("submission_report");
		$data['years'] = $extras['years'];
		$data['labs'] =  $extras['labs'];
		$data['banner_text'] = 'EID / VL Home';
        $data['content_view'] = 'eid/home_v';
        $data['title'] = 'EID/VL';
        $this->load->view("eid/template", $data);
		

	}
	function home(){
		$data = array();
		$data['labs'] = $this ->getLabs();
		$last_period =strtoupper(date('M  Y',strtotime("-1 month")));
		$data['last_period'] = $last_period;
		$labSubmissions = $this ->getLabSubmissions();
		$data['lab_submissions'] = $labSubmissions['submission_details'];
		$data['submission_rate'] = $labSubmissions['submission_rate'];
		$this ->load ->view('eid/home_v',$data);
	}
	
	function getLabs(){
		$query = $this ->db ->query("SELECT id,labname, name FROM `eid_labs`");
		$results = $query ->result_array();
		return $results;
	}
	
	function GetLab($lab){
		$labquery=$this ->db ->query("SELECT name FROM `eid_labs` where ID='$lab' "); 
		$dd=$labquery ->result_array();
		$labname=$dd[0]['name'];
		return $labname;
	}
	
	function getSubmissionYears(){
		$data = array();
		//Max year 
		$sql = "SELECT MAX(t.yearofrecordset) as max_year
			FROM
			(SELECT yearofrecordset FROM `eid_abbottprocurement` 
					UNION SELECT yearofrecordset FROM `eid_taqmanprocurement` 
			) AS t";
		$query = $this ->db ->query($sql);
		$result = $query ->result_array();
		$max_year = $result[0]['max_year'];
		//Min year
		$sql = "SELECT MIN(t.yearofrecordset) as min_year
			FROM
			(SELECT yearofrecordset FROM `eid_abbottprocurement` 
					UNION SELECT yearofrecordset FROM `eid_taqmanprocurement` 
			) AS t";
			$query = $this ->db ->query($sql);
		$result = $query ->result_array();
		$min_year = $result[0]['min_year'];
		
		$years = range ($max_year, $min_year); 
		
		//List of labs
		$sql = "SELECT id,name FROM `eid_labs`";
		$query = $this ->db ->query($sql);
		$result = $query ->result_array();
		$data["labs"] = $result;
		$data['years'] = $years;
		return $data;
	}
	
	function getApprovedLabs(){//Get approved labs for a certain period
		$month 	= $this ->input ->post("month");
		$year 	= $this ->input ->post("year");
		$result = $this ->getApprovedReportlabs($month,$year);
		
		if(count($result)==0){
			echo '<div class="alert alert-warning">
					<span class="label label-warning">NOTE!</span>
					<span> No data available for download for this period </span>
				  </div>';
		}
		$data = '<table class="table table-bordered table-striped table-hover">';
		foreach ($result as $key => $value) {
			if($value['total_test']<2){//Only get labs that have both EID and VL  approved
				continue;
			}
			$data .= '<tr><td>'.strtoupper($value['name']).'</td><td><a href="'.base_url().'eid_management/downloadreportbylab/'.$value['lab_id'].'/'.$month.'/'.$year.'/"><i class="fa fa-download"></i> Download</a></td></tr>';
		}
		$data .= '</table>';
		echo $data;
	}
	function getApprovedReportlabs($month,$year){//Get list of labs that have approved reports
		$sql = "SELECT COUNT(taq.id) as total_test, taq.received,l.name,l.id as lab_id FROM `eid_taqmanprocurement` taq
				LEFT JOIN eid_labs l ON l.id = taq.lab
				WHERE 
				taq.monthofrecordset='$month' and taq.yearofrecordset='$year' 
				AND received = 1
				GROUP BY taq.lab";	
		$query = $this ->db ->query($sql);
		$result = $query ->result_array();
		return $result;
	}
	function menus($type ="submission_tracking"){
		$data = array();
		
		if($type=="submission_report"){
			$data['content'] ="eid/".$type;
			//Max year 
			$sql = "SELECT MAX(t.yearofrecordset) as max_year
				FROM
				(SELECT yearofrecordset FROM `eid_abbottprocurement` 
						UNION SELECT yearofrecordset FROM `eid_taqmanprocurement` 
				) AS t";
			$query = $this ->db ->query($sql);
			$result = $query ->result_array();
			$max_year = $result[0]['max_year'];
			//Min year
			$sql = "SELECT MIN(t.yearofrecordset) as min_year
				FROM
				(SELECT yearofrecordset FROM `eid_abbottprocurement` 
						UNION SELECT yearofrecordset FROM `eid_taqmanprocurement` 
				) AS t";
				$query = $this ->db ->query($sql);
			$result = $query ->result_array();
			$min_year = $result[0]['min_year'];
			
			$years = range ($max_year, $min_year); 
			
			//List of labs
			$sql = "SELECT id,name FROM `eid_labs`";
			$query = $this ->db ->query($sql);
			$result = $query ->result_array();
			$data["labs"] = $result;
			$data['years'] = $years;
		}
		else if($type=="submission_tracking"){
			//$data = $this ->submission_tracking($type);
		}
		$this ->load ->view("eid/".$type,$data);
		
	}
	
	function submission_tracking(){
		$data = array();
		$color = array(
           'low' => 'FF654F', //red
           'moderate' =>'F6BD0F', //orange
           'done' => '8BBA00' //Green
      	);
		
		$color_submission = '';
        $color_approval = '';
        $color_distribution = '';
        $percentDone_submission = 7;
		$percentDone_approval = 0;
		$percentDone_Distribution = 0;
		
		for($i=1;$i<8;$i++){
    	    $lab_submitted = $this->lab_submission($i);
		    if($lab_submitted['kisumu_kit_imgtype'] === 'red'){
		     $percentDone_submission --;
		    }else{
		        if($lab_submitted['approved'] === '1'){
		            $percentDone_approval++;
		        }
		    }
		}
		
		$percentDone_submission = ceil($percentDone_submission*100/7);
		
		if ($percentDone_submission < 70 ){
    		$color_submission = $color['low'];
		}elseif ($percentDone_submission > 70  && $percentDone_submission < 99 ) {
		     $color_submission = $color['moderate'];
		}else {
		     $color_submission = $color['done'];
		}
		
		
		
		$percentDone_approval = ceil($percentDone_approval*100/7);

		if ($percentDone_approval < 70 ){
		    $color_approval = $color['low'];
		}elseif ($percentDone_approval > 70  && $percentDone_approval < 99 ) {
		     $color_approval = $color['moderate'];
		}else {
		     $color_approval = $color['done'];
		}
		
		$data['color_submission'] = $color_submission;
		$data['color_approval'] = $color_approval;
		$data['color_distribution'] = $color_distribution;
		$data['max_submission'] = '10';
		$data['max_approval'] = '18';
       	$data['percentage_submission'] = 'Report Submission ('.$percentDone_submission."% )";
       	$data['percentage_approval'] = 'Report Approval ('.$percentDone_approval."%)";
       	$data['percentage_distribution'] = 'Report Distribution ('. ceil($percentDone_Distribution/7)."% )";
		$this ->load ->view("eid/submission_tracking_chart",$data);
	}

	function consumption_trend($table="eid_taqmanprocurement",$testtype="1"){
		$data = array();
		$currentyear = date('Y');
		$data['currentyear'] = $currentyear;
		$result = $this ->db ->query("select id,name,labname from `eid_labs`");
		$results  = $result ->result_array();
		$dataset = "";
		foreach ($results as $key => $value) {
			$id = $value['id'];
			$labname = $value['labname'];
			$name = $value['name'];
			$dataset .= "<dataset seriesName='$labname'>";
			$startmonth =  1; 
			$endmonth =  12; 
			$testsdone = 0;
			for ( $startmonth;  $startmonth<=$endmonth;  $startmonth++){ 	
				//select the tests done values from the procurement table
				$openingquery= $this ->db ->query("SELECT testsdone as total_test from `$table` where monthofrecordset = '$startmonth' and testtype = '$testtype' and lab='$id' and yearofrecordset='$currentyear'"); 
				$opening = $openingquery ->result_array();
				$testsdone = '';
				foreach ($opening as $key => $value) {
					$testsdone= $value['total_test'];
					
				}
				
				$dataset .="<set value='$testsdone'/>";
				
			}//end for
			$dataset .="</dataset>";
		}
		
		$data['dataset'] = $dataset;
		$this ->load ->view("eid/consumptiontrend",$data);
		
	}
	
	
	function lab_submission ($lab_id){
		$month = date('m');
		$lab_name = $this ->GetLab($lab_id);
		$lastmonth = $month - 1;
		if ($lastmonth == '0'){
			$lastmonth = 12;
			$year = date('Y') - 1;
		}else if ($lastmonth != '0'){
			$year = date('Y');
		}
		
		
		if 		($month == 1) 	{ $monthname = 'JAN'; $lastmonthname = 'DEC';}
		else if ($month == 2) 	{ $monthname = 'FEB'; $lastmonthname = 'JAN';}
		else if ($month == 3) 	{ $monthname = 'MAR'; $lastmonthname = 'FEB';}
		else if ($month == 4) 	{ $monthname = 'APR'; $lastmonthname = 'MAR';}
		else if ($month == 5) 	{ $monthname = 'MAY'; $lastmonthname = 'APR';}
		else if ($month == 6) 	{ $monthname = 'JUN'; $lastmonthname = 'MAY';}
		else if ($month == 7) 	{ $monthname = 'JUL'; $lastmonthname = 'JUN';}
		else if ($month == 8) 	{ $monthname = 'AUG'; $lastmonthname = 'JUL';}
		else if ($month == 9) 	{ $monthname = 'SEP'; $lastmonthname = 'AUG';}
		else if ($month == 10) 	{ $monthname = 'OCT'; $lastmonthname = 'SEP';}
		else if ($month == 11) 	{ $monthname = 'NOV'; $lastmonthname = 'OCT';}
		else if ($month == 12) 	{ $monthname = 'DEC'; $lastmonthname = 'NOV';}
		
		$lab_detail = $this -> lab_type($lab_id);
		$cpplatabb = $lab_detail['abb'];
		$cpplattaq = $lab_detail['taq'];
		$db = 'eid_abbottprocurement';
		$kisumu_showview = '';
		$approved = '';
		$kisumu_kit_imgtype = 'red';
		$need_approval = '';
		$has_submitted = 0;
			if ( ($cpplatabb > 0) && ($cpplattaq > 0) ){//..lab has both abbott and taqman
				//.taqman
				$lab_detail_submission = $this ->lab_both_taqman_abbot_report_submission($lab_id, $year, $lastmonth);
                $ctchecktaq = $lab_detail_submission['taq'];
                $ctcheckabb = $lab_detail_submission['abb'];
                $ctkit = $lab_detail_submission['ctkit'];
		                
				if ($ctkit){//..both have been submitted then show green
					$kisumu_kit_imgtype = 'green';
					
					if ( ($ctchecktaq == 0) and ($ctcheckabb == 0) ){ //..if both taqman & abbott have been received at SCMS / KEMSA
					    $kisumu_showview = '<span class="badge badge-warning badge-report-action approve-lab faa-flash animated" data-labname="'.$lab_name.'" data-ref="2/'.$lab_id.'/'.$lastmonth.'/'.$year.'>Approve</span>';
						$approved = '0';
						$has_submitted = 1;
						//$need_approval = 'faa-flash animated';
					}else if ( ($ctchecktaq > 0) and ($ctcheckabb > 0) ){ //..if both taqman & abbott have been received at SCMS / KEMSA
						$approved = '1';
						$has_submitted = 1;
                        $kisumu_showview = '<span class="badge badge-info badge-report-action">Approved</span>';
                    }         
				}else{//..show red
					$kisumu_showview = '<span class="badge badge-danger badge-report-action">Not submitted</span>';
					$kisumu_kit_imgtype = 'red';
					$has_submitted = 0;
				}
			
			}else {
				if(($cpplatabb == 0) && ($cpplattaq > 0)){
					$db = "eid_taqmanprocurement";
				}else{
					$db = "eid_abbottprocurement";
				}
			}
		        
			
			//.taqman or abbot
            $sql = "SELECT COUNT(taq.ID) as 'ctaqsubmission',taq.received as taqr  from `$db` taq where
			taq.monthofrecordset='$lastmonth' and taq.yearofrecordset='$year' and taq.lab='$lab_id'";
			
            $ctquery= $this -> db -> query($sql); 
			$ctss = $ctquery ->result_array();
	             
			$ctkit = $ctss[0]['ctaqsubmission'];
			$ctchecktaq = $ctss[0]['taqr'];
	                
				
			if ($ctkit > 0){//..both have been submitted then show green
				
				$kisumu_kit_imgtype = 'green';
				
				if  ($ctchecktaq == 0){ //..if both taqman & abbott have been received at SCMS / KEMSA
				    $kisumu_showview = '<span class="badge badge-warning badge-report-action approve-lab faa-flash animated" data-labname="'.$lab_name.'" data-ref="2/'.$lab_id.'/'.$lastmonth.'/'.$year.'">Approve</span>';
					$approved = '0';
					$has_submitted = 1;
					//$need_approval = 'faa-flash animated';
				}else if ($ctchecktaq > 0){  //..if both taqman & abbott have been received at SCMS / KEMSA     
					$kisumu_showview = '<span class="badge badge-info badge-report-action">Approved</span>';
	                $approved = '1';
	                $has_submitted = 1;
				}else{//..show red
					$kisumu_kit_imgtype = 'red';
					$kisumu_showview = '<span class="badge badge-danger badge-report-action">Not submitted</span>';
					$has_submitted = 0;
	            }
	        }
	        
	        // echo $kisumu_showview;
	        $display = array(
	            'show_view' => $kisumu_showview,
	            'kisumu_kit_imgtype' => $kisumu_kit_imgtype,
	            'approved' => $approved,
	            'has_submitted' =>$has_submitted,
	            'need_approval' =>$need_approval
	        );
	        
	        //print_r($display);
	        return $display;
	}
	
	function consumption($left='',$lab='',$lastmonth='',$year='',$approve_plat=''){
		$data = array();
		$approve_left		= $left; 
		$approve_lab		= $lab;
		$labname 			= $this->GetLab($approve_lab);
		$approve_lastmonth	= $lastmonth;
		$approve_year		= $year;
		$formaction = "";
		
		if 		($approve_lastmonth == 1) 	{ $monthname = 'JAN'; $lastmonthname = 'DEC';}
		else if ($approve_lastmonth == 2) 	{ $monthname = 'FEB'; $lastmonthname = 'JAN';}
		else if ($approve_lastmonth == 3) 	{ $monthname = 'MAR'; $lastmonthname = 'FEB';}
		else if ($approve_lastmonth == 4) 	{ $monthname = 'APR'; $lastmonthname = 'MAR';}
		else if ($approve_lastmonth == 5) 	{ $monthname = 'MAY'; $lastmonthname = 'APR';}
		else if ($approve_lastmonth == 6) 	{ $monthname = 'JUN'; $lastmonthname = 'MAY';}
		else if ($approve_lastmonth == 7) 	{ $monthname = 'JUL'; $lastmonthname = 'JUN';}
		else if ($approve_lastmonth == 8) 	{ $monthname = 'AUG'; $lastmonthname = 'JUL';}
		else if ($approve_lastmonth == 9) 	{ $monthname = 'SEP'; $lastmonthname = 'AUG';}
		else if ($approve_lastmonth == 10) 	{ $monthname = 'OCT'; $lastmonthname = 'SEP';}
		else if ($approve_lastmonth == 11) 	{ $monthname = 'NOV'; $lastmonthname = 'OCT';}
		else if ($approve_lastmonth == 12) 	{ $monthname = 'DEC'; $lastmonthname = 'NOV';}
		
		if 		($approve_left == 2) 						   {$plat = 1; $left = 'TAQMAN & ABBOTT'; $formaction = 'eid_management/approve/approvetaqmanreport';}
		else if (($approve_left == 1) and (@$approve_plat = 1)) {$plat = 1; $left = 'TAQMAN';  $formaction = 'eid_management/approve/approvetaqmanreport';}
		else if (($approve_left == 1) and (@$approve_plat = 2)) {$plat = 2; $left = 'ABBOTT';  $formaction = 'eid_management/approve/approveabbottreport';}
		
		$data['formaction'] = $formaction;
		$data['approve_left'] = $approve_left;
		$data['labname'] = $labname;
		$data['left'] = $plat;
		$data['monthname'] = $monthname;
		$data['approve_lab'] = $approve_lab;
		$data['approve_year'] = $approve_year;
		$data['approve_lastmonth'] = $approve_lastmonth;
		
		
		$this ->load ->view("eid/approval_form",$data);
	}
	
	function getLabSubmissions(){
		$labs = $this ->getLabs();
		$data = '';
		$data['total_submissions'] = 0;
		$total_submitted = 0;
		foreach ($labs as $key => $value) {
			$id = $value['id'];
			$lab = $this ->lab_submission($id);
			$total_submitted = $total_submitted + $lab['has_submitted'];
			
			$data['submission_details'] .='
					<a href="">
						<span class="title"><i class="fa fa-arrow-right '.$lab['need_approval'].'"></i> '.strtoupper($value['labname']).' </span>
						'.$lab['show_view'].'
					</a>';
		}
		$data['submission_rate'] =$total_submitted .'/'.($key+1);
		return $data;
	}
			
			
	
	function displayconsumption($type="update",$d_lab_id="",$d_month="",$d_year="",$d_platform="1",$d_type="bylab"){
		$allocate_columns_taqman = "";	
		$allocate_columns_abbott = "";
		if($type=="download"){//If donwload reports
			$lab = $d_lab_id;
			$lastmonth = $d_month;
			$year = $d_year;
			$platform = $d_platform;
			$data['labname'] = $this ->GetLab($lab);
			$data['plat'] = $d_platform;
			$monthname = date("M", mktime(0, 0, 0, $lastmonth));
			$data['monthname'] = $monthname;
			$data['year'] = $year;
			$data['lastmonth'] = $lastmonth;
			
			$allocate_columns_taqman = " ,allocatequalkit ,allocatespexagent,allocateampinput,allocateampflapless,allocateampwash,allocateampktips,allocatektubes";
			$allocate_columns_abbott = " ,allocatequalkit,allocatecalibration,allocatecontrol,allocatebuffer,allocatepreparation,allocateadhesive,allocatedeepplate,allocatemixtube,allocatereactionvessels,allocatereagent,allocatereactionplate,allocate1000disposable,allocate200disposable";
			
		}elseif($type="update"){//If viewing consumption for approval
			$data = array();
			$lab  = $this ->input ->post("testinglab");
			$data['labname'] = $this ->input ->post("lab_name");
			$platform 	= $this ->input ->post("platform");
			$lastmonth = $this ->input ->post("month");
			$monthname = date("M", mktime(0, 0, 0, $lastmonth));
			
			$year = $this ->input ->post("monthyear");
			$report_text = $this ->input ->post("report_text");
			$data['report_text'] = $report_text;
			$data['monthname'] = $monthname;
			$data['year'] = $year;
			$data['lastmonth'] = $lastmonth;
			$data['lab'] = $lab;
			
			$qualkitused = 0;
			$vqualkitused = 0;
					
			
			$data['approval'] = @$this ->input ->post("approval");//Check if load page for approval
			//echo $data['approval'].' '.$platform;die();
		}
		$previousmonth = date('n', strtotime(date($year.'-'.$lastmonth, mktime()) . " - 1 months"));//..eg if current month = May; submission should be for Apr; opening balance Apr should be end bal Mar
		$pyear = date('Y', strtotime(date($year.'-'.$lastmonth, mktime()) . " - 1 months"));
		
			
		//TAQMAN
		if($platform==1){
			$openingqualkit		=0;
			$openingspexagent	=0;
			$openingampinput	=0;
			$openingampflapless	=0;
			$openingampktips	=0;
			$openingampwash		=0;
			$openingktubes		=0;
			$openingconsumables	=0;
			 
			$openingquery=$this -> db ->query("SELECT endingqualkit, endingspexagent, endingampinput, endingampflapless, endingampktips, endingampwash, endingktubes, endingconsumables from `eid_taqmanprocurement` where monthofrecordset = '$previousmonth' and testtype = 1 and lab='$lab' and yearofrecordset='$pyear'") ; //EID
			$opening = $openingquery ->result_array(); 
			
			if(count($opening)>0){
				$openingqualkit=$opening[0]['endingqualkit'];
				$openingspexagent=$opening[0]['endingspexagent'];
				$openingampinput=$opening[0]['endingampinput'];
				$openingampflapless=$opening[0]['endingampflapless'];
				$openingampktips=$opening[0]['endingampktips'];
				$openingampwash=$opening[0]['endingampwash'];
				$openingktubes=$opening[0]['endingktubes'];
				$openingconsumables=$opening[0]['endingconsumables'];
			}
			
			
			$vopeningqualkit	=0;
			$vopeningspexagent	=0;
			$vopeningampinput	=0;
			$vopeningampflapless=0;
			$vopeningampktips	=0;
			$vopeningampwash	=0;
			$vopeningktubes		=0;
			$vopeningconsumables=0;
			
			//..VIRAL LOAD
			$openingquery=$this -> db ->query("SELECT endingqualkit as a, endingspexagent as b, endingampinput as c, endingampflapless as d, endingampktips as e, endingampwash as f, endingktubes as g, endingconsumables as h from `eid_taqmanprocurement` where monthofrecordset = '$previousmonth' and testtype = 2 and lab='$lab' and yearofrecordset='$pyear'"); 
			$opening = $openingquery ->result_array();
			
			if(count($opening)>0){
				$vopeningqualkit=$opening[0]['a'];
				$vopeningspexagent=$opening[0]['b'];
				$vopeningampinput=$opening[0]['c'];
				$vopeningampflapless=$opening[0]['d'];
				$vopeningampktips=$opening[0]['e'];
				$vopeningampwash=$opening[0]['f'];
				$vopeningktubes=$opening[0]['g'];
				$vopeningconsumables=$opening[0]['h'];
			}
			
			
			
			
			//..end -> get the opening balances to display
	
			//..get the actual items for the tables
			//..EID ITEMS
			$taqman_info_a			=$this -> db ->query("select testsdone, endingqualkit, endingspexagent, endingampinput, endingampflapless, endingampktips, endingampwash, endingktubes, endingconsumables, wastedqualkit, wastedspexagent, wastedampinput, wastedampflapless, wastedampktips, wastedampwash, wastedktubes, wastedconsumables, issuedqualkit, issuedspexagent, issuedampinput, issuedampflapless, issuedampktips, issuedampwash, issuedktubes, issuedconsumables, requestqualkit, requestspexagent, requestampinput, requestampflapless, requestampktips, requestampwash, requestktubes, requestconsumables, monthofrecordset, yearofrecordset, datesubmitted, submittedby, comments, issuedcomments, approve,approved_date $allocate_columns_taqman  from `eid_taqmanprocurement` where monthofrecordset = '$lastmonth' and yearofrecordset = '$year' and testtype ='1' and lab='$lab'");
			$taqman_info_result_a	=$taqman_info_a ->result_array();
			
			//Initialize variables
			$testsdone 		= $equalkit	=$espexagent = $eampinput = $eampflapless = $eampktips = $eampktips	= $eampwash	= $ektubes = $econsumables = 
			$wqualkit		= $wspexagent 	= $wampinput	= $wampflapless	= $wampktips= $wampwash	= $wktubes	= $wconsumables	= $iqualkit		= $ispexagent 	= 
			$iampinput		= $iampflapless	= $iampktips	= $iampwash	= $iktubes	= $iconsumables	= $icomments	= $rqualkit= $rspexagent = $rampinput= 
			$rampflapless	= $rampktips	= $rampwash	= $rktubes	= $rconsumables	= $comments	= $submittedby	= $datesubmitted= $approve	= 0;
			if(count($taqman_info_result_a)>0){
				$testsdone		= $taqman_info_result_a[0]['testsdone'];	
				//..used [calculate by the ratios]				
				$uqualkit		= ($testsdone / 44); 
				$uspexagent 	= $uqualkit 		* 0.15; 
				$uampinput 		= $uqualkit			* 0.2; 
				$uampflapless	= $uqualkit 		* 0.2; 
				$uampktips 		= $uqualkit 		* 0.15; 
				$uampwash		= $uqualkit 		* 0.5; 
				$uktubes		= $uqualkit 		* 0.05; 
				$uconsumables	= $uqualkit 		* 0.05; 
				//..end balance
				$equalkit		= $taqman_info_result_a[0]['endingqualkit'];
				$espexagent 	= $taqman_info_result_a[0]['endingspexagent'];
				$eampinput		= $taqman_info_result_a[0]['endingampinput'];
				$eampflapless	= $taqman_info_result_a[0]['endingampflapless'];
				$eampktips		= $taqman_info_result_a[0]['endingampktips'];
				$eampwash		= $taqman_info_result_a[0]['endingampwash'];
				$ektubes		= $taqman_info_result_a[0]['endingktubes'];
				$econsumables	= $taqman_info_result_a[0]['endingconsumables'];
				//..wasted
				$wqualkit		= $taqman_info_result_a[0]['wastedqualkit'];
				$wspexagent 	= $taqman_info_result_a[0]['wastedspexagent'];
				$wampinput		= $taqman_info_result_a[0]['wastedampinput'];
				$wampflapless	= $taqman_info_result_a[0]['wastedampflapless'];
				$wampktips		= $taqman_info_result_a[0]['wastedampktips'];
				$wampwash		= $taqman_info_result_a[0]['wastedampwash'];
				$wktubes		= $taqman_info_result_a[0]['wastedktubes'];
				$wconsumables	= $taqman_info_result_a[0]['wastedconsumables'];
				//..issued
				$iqualkit		= $taqman_info_result_a[0]['issuedqualkit'];
				$ispexagent 	= $taqman_info_result_a[0]['issuedspexagent'];
				$iampinput		= $taqman_info_result_a[0]['issuedampinput'];
				$iampflapless	= $taqman_info_result_a[0]['issuedampflapless'];
				$iampktips		= $taqman_info_result_a[0]['issuedampktips'];
				$iampwash		= $taqman_info_result_a[0]['issuedampwash'];
				$iktubes		= $taqman_info_result_a[0]['issuedktubes'];
				$iconsumables	= $taqman_info_result_a[0]['issuedconsumables'];
				$icomments		= $taqman_info_result_a[0]['issuedcomments'];
				//..requests
				$rqualkit		= $taqman_info_result_a[0]['requestqualkit'];
				$rspexagent 	= $taqman_info_result_a[0]['requestspexagent'];
				$rampinput		= $taqman_info_result_a[0]['requestampinput'];
				$rampflapless	= $taqman_info_result_a[0]['requestampflapless'];
				$rampktips		= $taqman_info_result_a[0]['requestampktips'];
				$rampwash		= $taqman_info_result_a[0]['requestampwash'];
				$rktubes		= $taqman_info_result_a[0]['requestktubes'];
				$rconsumables	= $taqman_info_result_a[0]['requestconsumables'];
				
				$comments		= $taqman_info_result_a[0]['comments'];
				$submittedby	= $taqman_info_result_a[0]['submittedby'];
				$datesubmitted	= $taqman_info_result_a[0]['datesubmitted'];
				$datesubmitted	= date("d-M-Y",strtotime($datesubmitted));
				$approve		= $taqman_info_result_a[0]['approve'];
				$approved_date	= $taqman_info_result_a[0]['approved_date'];
				//if(date("Y",strtotime($approved_date))=="0000"){
					
				//}
				
				//Allocate
				if($type=="download" || $type=="view"){
					$data['aqualkit'] 		= $taqman_info_result_a[0]['allocatequalkit'];
					$data['aspexagent'] 	= $taqman_info_result_a[0]['allocatespexagent'];
					$data['aampinput']		= $taqman_info_result_a[0]['allocateampinput'];
					$data['aampflapless']	= $taqman_info_result_a[0]['allocateampflapless'];
					$data['aampktips']		= $taqman_info_result_a[0]['allocateampktips'];
					$data['aampwash']		= $taqman_info_result_a[0]['allocateampwash'];
					$data['aktubes']		= $taqman_info_result_a[0]['allocatektubes'];
					$data['aconsumables']	= $taqman_info_result_a[0]['allocateconsumables'];
					$data['approved_date']	= $approved_date;
				}
			}

			
						
							
			$vtestsdone 		= $vequalkit	=$vespexagent = $veampinput = $veampflapless = $veampktips = $veampktips	= $veampwash	= $vektubes = $veconsumables = 
			$vwqualkit		= $vwspexagent 	= $vwampinput	= $vwampflapless	= $vwampktips= $vwampwash	= $vwktubes	= $vwconsumables	= $viqualkit		= $vispexagent 	= 
			$viampinput		= $viampflapless	= $viampktips	= $viampwash	= $viktubes	= $viconsumables	= $vicomments	= $vrqualkit= $vrspexagent = $vrampinput= 
			$vrampflapless	= $vrampktips	= $vrampwash	= $vrktubes	= $vrconsumables	= $vcomments	= $vsubmittedby	= $vdatesubmitted= $vapprove	= 0;				
									
			//..VIRAL LOAD ITEMS
			
			$taqman_info_b			= $this -> db ->query("select testsdone, endingqualkit, endingspexagent, endingampinput, endingampflapless, endingampktips, endingampwash, endingktubes, endingconsumables, wastedqualkit, wastedspexagent, wastedampinput, wastedampflapless, wastedampktips, wastedampwash, wastedktubes, wastedconsumables, issuedqualkit, issuedspexagent, issuedampinput, issuedampflapless, issuedampktips, issuedampwash, issuedktubes, issuedconsumables, requestqualkit, requestspexagent, requestampinput, requestampflapless, requestampktips, requestampwash, requestktubes, requestconsumables, monthofrecordset, yearofrecordset, datesubmitted, submittedby, comments, issuedcomments $allocate_columns_taqman  from `eid_taqmanprocurement` where monthofrecordset = '$lastmonth' and yearofrecordset = '$year' and testtype ='2' and lab='$lab'") ;
			$taqman_info_result_b	= $taqman_info_b ->result_array();
			if(count($taqman_info_result_b)>0){
				$vtestsdone		= $taqman_info_result_b[0]['testsdone'];
			
				//..used [calculate by the ratios]				
				$vuqualkit		= ($vtestsdone / 42); 
				$vuspexagent 	= $vuqualkit 		* 0.15; 
				$vuampinput 	= $vuqualkit		* 0.2; 
				$vuampflapless	= $vuqualkit 		* 0.2; 
				$vuampktips 	= $vuqualkit 		* 0.15; 
				$vuampwash		= $vuqualkit 		* 0.5; 
				$vuktubes		= $vuqualkit 		* 0.05; 
				$vuconsumables	= $vuqualkit 		* 0.05; 
				//..end balance
				$vequalkit		= $taqman_info_result_b[0]['endingqualkit'];
				$vespexagent 	= $taqman_info_result_b[0]['endingspexagent'];
				$veampinput		= $taqman_info_result_b[0]['endingampinput'];
				$veampflapless	= $taqman_info_result_b[0]['endingampflapless'];
				$veampktips		= $taqman_info_result_b[0]['endingampktips'];
				$veampwash		= $taqman_info_result_b[0]['endingampwash'];
				$vektubes		= $taqman_info_result_b[0]['endingktubes'];
				$veconsumables	= $taqman_info_result_b[0]['endingconsumables'];
				//..wasted
				$vwqualkit		= $taqman_info_result_b[0]['wastedqualkit'];
				$vwspexagent 	= $taqman_info_result_b[0]['wastedspexagent'];
				$vwampinput		= $taqman_info_result_b[0]['wastedampinput'];
				$vwampflapless	= $taqman_info_result_b[0]['wastedampflapless'];
				$vwampktips		= $taqman_info_result_b[0]['wastedampktips'];
				$vwampwash		= $taqman_info_result_b[0]['wastedampwash'];
				$vwktubes		= $taqman_info_result_b[0]['wastedktubes'];
				$vwconsumables	= $taqman_info_result_b[0]['wastedconsumables'];
				//..issued
				$viqualkit		= $taqman_info_result_b[0]['issuedqualkit'];
				$vispexagent 	= $taqman_info_result_b[0]['issuedspexagent'];
				$viampinput		= $taqman_info_result_b[0]['issuedampinput'];
				$viampflapless	= $taqman_info_result_b[0]['issuedampflapless'];
				$viampktips		= $taqman_info_result_b[0]['issuedampktips'];
				$viampwash		= $taqman_info_result_b[0]['issuedampwash'];
				$viktubes		= $taqman_info_result_b[0]['issuedktubes'];
				$viconsumables	= $taqman_info_result_b[0]['issuedconsumables'];
				$vicomments		= $taqman_info_result_b[0]['issuedcomments'];
				//..requests
				$vrqualkit		= $taqman_info_result_b[0]['requestqualkit'];
				$vrspexagent 	= $taqman_info_result_b[0]['requestspexagent'];
				$vrampinput		= $taqman_info_result_b[0]['requestampinput'];
				$vrampflapless	= $taqman_info_result_b[0]['requestampflapless'];
				$vrampktips		= $taqman_info_result_b[0]['requestampktips'];
				$vrampwash		= $taqman_info_result_b[0]['requestampwash'];
				$vrktubes		= $taqman_info_result_b[0]['requestktubes'];
				$vrconsumables	= $taqman_info_result_b[0]['requestconsumables'];
				
				//Allocate
				if($type=="download" || $type=="view"){
					$data['vaqualkit'] 		= $taqman_info_result_b[0]['allocatequalkit'];
					$data['vaspexagent'] 	= $taqman_info_result_b[0]['allocatespexagent'];
					$data['vaampinput']		= $taqman_info_result_b[0]['allocateampinput'];
					$data['vaampflapless']	= $taqman_info_result_b[0]['allocateampflapless'];
					$data['vaampktips']		= $taqman_info_result_b[0]['allocateampktips'];
					$data['vaampwash']		= $taqman_info_result_b[0]['allocateampwash'];
					$data['vaktubes']		= $taqman_info_result_b[0]['allocatektubes'];
					$data['vaconsumables']	= $taqman_info_result_b[0]['allocateconsumables'];
				}
				
				$vcomments		= $taqman_info_result_b[0]['comments'];
				$vsubmittedby	= $taqman_info_result_b[0]['submittedby'];
				$vdatesubmitted	= $taqman_info_result_b[0]['datesubmitted'];
				$vdatesubmitted	= date("d-M-Y",strtotime($vdatesubmitted));
				//..END -> get the actual items for the tables
			}

			//VIRAL LOAD
			$data['vtestsdone'] 		= $vtestsdone;
			$data['vopeningqualkit'] 	= $vopeningqualkit;
			$data['vdatesubmitted'] 	= $vdatesubmitted;
			$data['vuqualkit'] 			= ceil($vuqualkit);
			$data['vwqualkit']			= $vwqualkit;
			$data['viqualkit'] 			= $viqualkit;
			$data['vequalkit'] 			= $vequalkit;
			$data['vrqualkit'] 			= $vrqualkit;
			$data['vopeningspexagent'] 	= $vopeningspexagent;
			$data['vuspexagent'] 		= ceil($vuspexagent);
			$data['vwspexagent'] 		= $vwspexagent;
			$data['vispexagent'] 		= $vispexagent;
			$data['vespexagent'] 		= $vespexagent;
			$data['vrspexagent'] 		= $vrspexagent;
			$data['vopeningampinput'] 	= $vopeningampinput;
			$data['vuampinput'] 		= $vuampinput;
			$data['vwampinput'] 		= $vwampinput;
			$data['viampinput'] 		= $viampinput;
			$data['veampinput'] 	 	= $veampinput;
			$data['vrampinput'] 		= $vrampinput;
			$data['vopeningampflapless'] = $vopeningampflapless;
			$data['vuampflapless'] 		= ceil($vuampflapless);
			$data['vwampflapless'] 		= $vwampflapless;
			$data['viampflapless'] 		= $viampflapless;
			$data['veampflapless'] 		= $veampflapless;
			$data['vrampflapless'] 		= $vrampflapless;
			$data['vopeningampwash'] 	= $vopeningampwash;
			$data['vuampwash'] 			= ceil($vuampwash);
			$data['vwampwash'] 			= $vwampwash;
			$data['viampwash'] 			= $viampwash;
			$data['veampwash'] 			= $veampwash;
			$data['vrampwash'] 			= $vrampwash;
			$data['vopeningampktips'] 	= $vopeningampktips;
			$data['vuampktips'] 		= ceil($vuampktips);
			$data['vwampktips'] 		= $vwampktips;
			$data['viampktips'] 		= $viampktips;
			$data['veampktips'] 		= $veampktips;
			$data['vrampktips'] 		= $vrampktips;
			$data['vopeningktubes'] 	= $vopeningktubes;
			$data['vuktubes'] 			= $vuktubes;
			$data['vwktubes'] 			= $vwktubes;
			$data['viktubes'] 			= $viktubes;
			$data['vektubes'] 			= $vektubes;
			$data['vicomments'] 		= $vicomments;
			$data['vrktubes'] 			= $vrktubes;
			$data['vrktubes'] 			= $vrktubes;
			$data['vrktubes'] 			= $vrktubes;
			
			
			//EID
			$data['testsdone'] 			= $testsdone;
			$data['openingqualkit'] 	= $openingqualkit;
			$data['datesubmitted'] 		= $datesubmitted;
			$data['uqualkit'] 			= ceil($uqualkit);
			$data['wqualkit']			= $wqualkit;
			$data['iqualkit'] 			= $iqualkit;
			$data['equalkit'] 			= $equalkit;
			$data['rqualkit'] 			= $rqualkit;
			$data['openingspexagent'] 	= $openingspexagent;
			$data['uspexagent'] 		= ceil($uspexagent);
			$data['wspexagent'] 		= $wspexagent;
			$data['ispexagent'] 		= $ispexagent;
			$data['espexagent'] 		= $espexagent;
			$data['rspexagent'] 		= $rspexagent;
			$data['openingampinput'] 	= $openingampinput;
			$data['uampinput'] 			= $uampinput;
			$data['wampinput'] 			= $wampinput;
			$data['iampinput'] 			= $iampinput;
			$data['eampinput'] 	 		= $eampinput;
			$data['rampinput'] 			= $rampinput;
			$data['openingampflapless'] = $openingampflapless;
			$data['uampflapless'] 		= ceil($uampflapless);
			$data['wampflapless'] 		= $wampflapless;
			$data['iampflapless'] 		= $iampflapless;
			$data['eampflapless'] 		= $eampflapless;
			$data['rampflapless'] 		= $rampflapless;
			$data['openingampwash'] 	= $openingampwash;
			$data['uampwash'] 			= ceil($uampwash);
			$data['wampwash'] 			= $wampwash;
			$data['iampwash'] 			= $iampwash;
			$data['eampwash'] 			= $eampwash;
			$data['rampwash'] 			= $rampwash;
			$data['openingampktips'] 	= $openingampktips;
			$data['uampktips'] 			= ceil($uampktips);
			$data['wampktips'] 			= $wampktips;
			$data['iampktips'] 			= $iampktips;
			$data['eampktips'] 			= $eampktips;
			$data['rampktips'] 			= $rampktips;
			$data['openingktubes'] 		= $openingktubes;
			$data['uktubes'] 			= $uktubes;
			$data['wktubes'] 			= $wktubes;
			$data['iktubes'] 			= $iktubes;
			$data['ektubes'] 			= $ektubes;
			$data['icomments'] 			= $icomments;
			$data['rktubes'] 			= $rktubes;
			$data['rktubes'] 			= $rktubes;
			$data['rktubes'] 			= $rktubes;
			
			
			$data["platform"] = "TAQMAN";
		
		}elseif($platform==2){//ABOTT CONSUMPTION REPORT
			//echo $data['approval'].' '.$platform;die();
			//Initialize
			$openingqualkit 		= 0;
			$openingcalibration  	= 0;
			$openingcontrol  		= 0;
			$openingbuffer 	 		= 0;
			$openingpreparation  	= 0;
			$openingadhesive  		= 0;
			$openingdeepplate  		= 0;
			$openingmixtube  		= 0;
			$openingreactionvessels = 0;
			$openingreagent  		= 0;
			$openingreactionplate 	= 0;
			$opening1000disposable  = 0;
			$opening200disposable  	= 0;
			
			$openingquery=$this -> db ->query("SELECT testsdone as tottest, endingqualkit as a, endingcalibration as b, endingcontrol as c, endingbuffer as d, endingpreparation as e, endingadhesive as f, endingdeepplate as g, endingmixtube as h, endingreactionvessels as i, endingreagent as j, endingreactionplate as k, ending1000disposable as l, ending200disposable as m from eid_abbottprocurement where monthofrecordset = '$previousmonth' and testtype = 1 and lab='$lab' and yearofrecordset='$pyear'") ; 
			$opening = $openingquery ->result_array(); 
			
			if(count($opening)>0){
				$data['openingtotaltest']		=$opening[0]['tottest'];
				$data['openingqualkit']			=$opening[0]['a'];
				$data['openingcalibration']		=$opening[0]['b'];
				$data['openingcontrol']			=$opening[0]['c'];
				$data['openingbuffer']			=$opening[0]['d'];
				$data['openingpreparation']		=$opening[0]['e'];
				$data['openingadhesive']		=$opening[0]['f'];
				$data['openingdeepplate']		=$opening[0]['g'];
				$data['openingmixtube']			=$opening[0]['h'];
				$data['openingreactionvessels'] =$opening[0]['i'];
				$data['openingreagent'] 		=$opening[0]['j'];
				$data['openingreactionplate'] 	=$opening[0]['k'];
				$data['opening1000disposable'] 	=$opening[0]['l'];
				$data['opening200disposable'] 	=$opening[0]['m'];
			}
			//..END -> GET THE OPENING BALANCES (EID)
			
			//..GET THE OPENING BALANCES (VIRAL LOAD)
			
			//..sanitize the empty records
			$vopeningqualkit 		= 0;
			$vopeningcalibration 	= 0;
			$vopeningcontrol  		= 0;
			$vopeningbuffer  		= 0;
			$vopeningpreparation  	= 0;
			$vopeningadhesive  		= 0;
			$vopeningdeepplate  	= 0;
			$vopeningmixtube  		= 0;
			$vopeningreactionvessels= 0;
			$vopeningreagent  		= 0;
			$vopeningreactionplate  = 0;
			$vopening1000disposable = 0;
			$vopening200disposable  = 0;
			
			$vopeningquery		=$this -> db ->query("SELECT testsdone as vtottest, endingqualkit as va, endingcalibration as vb, endingcontrol as vc, endingbuffer as vd, endingpreparation as ve, endingadhesive as vf, endingdeepplate as vg, endingmixtube as vh, endingreactionvessels as vi, endingreagent as vj, endingreactionplate as vk, ending1000disposable as vl, ending200disposable as vm from `eid_abbottprocurement` where monthofrecordset = '$previousmonth' and testtype = 2 and lab='$lab' and yearofrecordset='$pyear'"); 
			$vopening 			=$vopeningquery ->result_array(); 
			if(count($opening)>0){
				$data['vopeningtotaltest']		=$vopening[0]['vtottest'];
				$data['vopeningqualkit']		=$vopening[0]['va'];
				$data['vopeningcalibration']	=$vopening[0]['vb'];
				$data['vopeningcontrol']		=$vopening[0]['vc'];
				$data['vopeningbuffer']			=$vopening[0]['vd'];
				$data['vopeningpreparation']	=$vopening[0]['ve'];
				$data['vopeningadhesive']		=$vopening[0]['vf'];
				$data['vopeningdeepplate']		=$vopening[0]['vg'];
				$data['vopeningmixtube']		=$vopening[0]['vh'];
				$data['vopeningreactionvessels']=$vopening[0]['vi'];
				$data['vopeningreagent'] 		= $vopening[0]['vj'];
				$data['vopeningreactionplate'] 	= $vopening[0]['vk'];
				$data['vopening1000disposable'] = $vopening[0]['vl'];
				$data['vopening200disposable'] 	= $vopening[0]['vm'];
			}
			//echo $vopeningqualkit;die();
			//..END -> GET THE OPENING BALANCES (VIRAL LOAD)
			
			//..get the other items for abbott
			//..EID
			$abbott_info_a			= $this -> db ->query("select testsdone, endingqualkit, endingcalibration, endingcontrol, endingbuffer, endingpreparation, endingadhesive, endingdeepplate, endingmixtube, endingreactionvessels, endingreagent, endingreactionplate, ending1000disposable, ending200disposable, wastedqualkit, wastedcalibration, wastedcontrol, wastedbuffer, wastedpreparation, wastedadhesive, wasteddeepplate, wastedmixtube, wastedreactionvessels, wastedreagent, wastedreactionplate, wasted1000disposable, wasted200disposable, issuedqualkit, issuedcalibration, issuedcontrol, issuedbuffer, issuedpreparation, issuedadhesive, issueddeepplate, issuedmixtube, issuedreactionvessels, issuedreagent, issuedreactionplate, issued1000disposable, issued200disposable, requestqualkit, requestcalibration, requestcontrol, requestbuffer, requestpreparation, requestadhesive, requestdeepplate, requestmixtube, requestreactionvessels, requestreagent, requestreactionplate, request1000disposable, request200disposable, monthofrecordset, yearofrecordset, datesubmitted, submittedby, comments, issuedcomments, approve,approved_date $allocate_columns_abbott from `eid_abbottprocurement` where monthofrecordset = '$lastmonth' and yearofrecordset = '$year' and testtype ='1' and lab='$lab'") or die(mysql_error());
			$abbott_info_result_a	= $abbott_info_a ->result_array();
			if(count($abbott_info_result_a)>0){
				$data['testsdone']		= $abbott_info_result_a[0]['testsdone']; 
				//..used
				$uqualkit			=	($testsdone / 94);
				//..if TESTTYPE == VIRAL LOAD
				//..$uqualkit		=	($testsdone / 93);
				$data['uqualkit']			= $uqualkit;
				$data['ucontrol'] 			= ($uqualkit * 2) * (2/24);
				$data['ubuffer'] 			= $uqualkit * 1;
				$data['upreparation'] 		= $uqualkit * 1;
				$data['uadhesive'] 			= ($uqualkit * 2)/100;
				$data['udeepplate'] 		= ($uqualkit * 2)*(2/4);
				$data['umixtube'] 			= ($uqualkit * 2)*(1/25);
				$data['ureactionvessels'] 	= ($uqualkit * 192)/500;
				$data['ureagent'] 			= ($uqualkit * 2)*(5/6);
				$data['ureactionplate'] 	= ($uqualkit * 192)/500;
				$data['u1000disposable']	= ($uqualkit * 2)*(421/192);
				$data['u200disposable'] 	= ($uqualkit * 2)*(48/192);
				
				//..wasted
				$data['wqualkit']			= $abbott_info_result_a[0]['wastedqualkit'];
				$data['wcalibration']		= $abbott_info_result_a[0]['wastedcalibration'];
				$data['wcontrol']			= $abbott_info_result_a[0]['wastedcontrol'];
				$data['wbuffer']			= $abbott_info_result_a[0]['wastedbuffer'];
				$data['wpreparation']		= $abbott_info_result_a[0]['wastedpreparation'];
				$data['wadhesive']			= $abbott_info_result_a[0]['wastedadhesive'];
				$data['wdeepplate']			= $abbott_info_result_a[0]['wasteddeepplate'];
				$data['wmixtube']			= $abbott_info_result_a[0]['wastedmixtube'];
				$data['wreactionvessels']	= $abbott_info_result_a[0]['wastedreactionvessels'];
				$data['wreagent']			= $abbott_info_result_a[0]['wastedreagent'];
				$data['wreactionplate']		= $abbott_info_result_a[0]['wastedreactionplate'];
				$data['w1000disposable']	= $abbott_info_result_a[0]['wasted1000disposable'];
				$data['w200disposable']		= $abbott_info_result_a[0]['wasted200disposable'];
				
				//..issued
				$data['iqualkit']			= $abbott_info_result_a[0]['issuedqualkit'];
				$data['icalibration']		= $abbott_info_result_a[0]['issuedcalibration'];
				$data['icontrol']			= $abbott_info_result_a[0]['issuedcontrol'];
				$data['ibuffer']			= $abbott_info_result_a[0]['issuedbuffer'];
				$data['ipreparation']		= $abbott_info_result_a[0]['issuedpreparation'];
				$data['iadhesive']			= $abbott_info_result_a[0]['issuedadhesive'];
				$data['ideepplate']			= $abbott_info_result_a[0]['issueddeepplate'];
				$data['imixtube']			= $abbott_info_result_a[0]['issuedmixtube'];
				$data['ireactionvessels']	= $abbott_info_result_a[0]['issuedreactionvessels'];
				$data['ireagent']			= $abbott_info_result_a[0]['issuedreagent'];
				$data['ireactionplate']		= $abbott_info_result_a[0]['issuedreactionplate'];
				$data['i1000disposable']	= $abbott_info_result_a[0]['issued1000disposable'];
				$data['i200disposable']		= $abbott_info_result_a[0]['issued200disposable'];
				
				$data['icomments']			= $abbott_info_result_a[0]['issuedcomments'];
				
				//..end balance
				$data['equalkit']			= $abbott_info_result_a[0]['endingqualkit'];
				$data['ecalibration']		= $abbott_info_result_a[0]['endingcalibration'];
				$data['econtrol']			= $abbott_info_result_a[0]['endingcontrol'];
				$data['ebuffer']			= $abbott_info_result_a[0]['endingbuffer'];
				$data['epreparation']		= $abbott_info_result_a[0]['endingpreparation'];
				$data['eadhesive']			= $abbott_info_result_a[0]['endingadhesive'];
				$data['edeepplate']			= $abbott_info_result_a[0]['endingdeepplate'];
				$data['emixtube']			= $abbott_info_result_a[0]['endingmixtube'];
				$data['ereactionvessels']	= $abbott_info_result_a[0]['endingreactionvessels'];
				$data['ereagent']			= $abbott_info_result_a[0]['endingreagent'];
				$data['ereactionplate']		= $abbott_info_result_a[0]['endingreactionplate'];
				$data['e1000disposable']	= $abbott_info_result_a[0]['ending1000disposable'];
				$data['e200disposable']		= $abbott_info_result_a[0]['ending200disposable'];
				
				//..request
				$data['rqualkit']			= $abbott_info_result_a[0]['requestqualkit'];
				$data['rcalibration']		= $abbott_info_result_a[0]['requestcalibration'];
				$data['rcontrol']			= $abbott_info_result_a[0]['requestcontrol'];
				$data['rbuffer']			= $abbott_info_result_a[0]['requestbuffer'];
				$data['rpreparation']		= $abbott_info_result_a[0]['requestpreparation'];
				$data['radhesive']			= $abbott_info_result_a[0]['requestadhesive'];
				$data['rdeepplate']			= $abbott_info_result_a[0]['requestdeepplate'];
				$data['rmixtube']			= $abbott_info_result_a[0]['requestmixtube'];
				$data['rreactionvessels']	= $abbott_info_result_a[0]['requestreactionvessels'];
				$data['rreagent']			= $abbott_info_result_a[0]['requestreagent'];
				$data['rreactionplate']		= $abbott_info_result_a[0]['requestreactionplate'];
				$data['r1000disposable']	= $abbott_info_result_a[0]['request1000disposable'];
				$data['r200disposable']		= $abbott_info_result_a[0]['request200disposable'];
				//Allocate
				if($type=="download" || $type=="view"){
					$data['aqualkit']			= $abbott_info_result_a[0]['allocatequalkit'];
					$data['acalibration']		= $abbott_info_result_a[0]['allocatecalibration'];
					$data['acontrol']			= $abbott_info_result_a[0]['allocatecontrol'];
					$data['abuffer']			= $abbott_info_result_a[0]['allocatebuffer'];
					$data['apreparation']		= $abbott_info_result_a[0]['allocatepreparation'];
					$data['aadhesive']			= $abbott_info_result_a[0]['allocateadhesive'];
					$data['adeepplate']			= $abbott_info_result_a[0]['allocatedeepplate'];
					$data['amixtube']			= $abbott_info_result_a[0]['allocatemixtube'];
					$data['areactionvessels']	= $abbott_info_result_a[0]['allocatereactionvessels'];
					$data['areagent']			= $abbott_info_result_a[0]['allocatereagent'];
					$data['areactionplate']		= $abbott_info_result_a[0]['allocatereactionplate'];
					$data['a1000disposable']	= $abbott_info_result_a[0]['allocate1000disposable'];
					$data['a200disposable']		= $abbott_info_result_a[0]['allocate200disposable'];
				}	
				
				$data['comments']			= $abbott_info_result_a[0]['comments'];
				$data['submittedby']		= $abbott_info_result_a[0]['submittedby'];
				$datesubmitted				= $abbott_info_result_a[0]['datesubmitted'];
				$data['datesubmitted']		= date("d-M-Y",strtotime($datesubmitted));
				$data['approve']			= $abbott_info_result_a[0]['approve'];
				$data['approved_date']		= $abbott_info_result_a[0]['approved_date'];
			}
			//..END -> EID
			
			//..VIRAL LOAD
			$abbott_info_b			= $this -> db ->query("select testsdone, endingqualkit, endingcalibration, endingcontrol, endingbuffer, endingpreparation, endingadhesive, endingdeepplate, endingmixtube, endingreactionvessels, endingreagent, endingreactionplate, ending1000disposable, ending200disposable, wastedqualkit, wastedcalibration, wastedcontrol, wastedbuffer, wastedpreparation, wastedadhesive, wasteddeepplate, wastedmixtube, wastedreactionvessels, wastedreagent, wastedreactionplate, wasted1000disposable, wasted200disposable, issuedqualkit, issuedcalibration, issuedcontrol, issuedbuffer, issuedpreparation, issuedadhesive, issueddeepplate, issuedmixtube, issuedreactionvessels, issuedreagent, issuedreactionplate, issued1000disposable, issued200disposable, requestqualkit, requestcalibration, requestcontrol, requestbuffer, requestpreparation, requestadhesive, requestdeepplate, requestmixtube, requestreactionvessels, requestreagent, requestreactionplate, request1000disposable, request200disposable, monthofrecordset, yearofrecordset, datesubmitted, submittedby, comments, issuedcomments $allocate_columns_abbott from `eid_abbottprocurement` where monthofrecordset = '$lastmonth' and yearofrecordset = '$year' and testtype ='2' and lab='$lab'");
			//echo "select testsdone, endingqualkit, endingcalibration, endingcontrol, endingbuffer, endingpreparation, endingadhesive, endingdeepplate, endingmixtube, endingreactionvessels, endingreagent, endingreactionplate, ending1000disposable, ending200disposable, wastedqualkit, wastedcalibration, wastedcontrol, wastedbuffer, wastedpreparation, wastedadhesive, wasteddeepplate, wastedmixtube, wastedreactionvessels, wastedreagent, wastedreactionplate, wasted1000disposable, wasted200disposable, issuedqualkit, issuedcalibration, issuedcontrol, issuedbuffer, issuedpreparation, issuedadhesive, issueddeepplate, issuedmixtube, issuedreactionvessels, issuedreagent, issuedreactionplate, issued1000disposable, issued200disposable, requestqualkit, requestcalibration, requestcontrol, requestbuffer, requestpreparation, requestadhesive, requestdeepplate, requestmixtube, requestreactionvessels, requestreagent, requestreactionplate, request1000disposable, request200disposable, monthofrecordset, yearofrecordset, datesubmitted, submittedby, comments, issuedcomments from `eid_abbottprocurement` where monthofrecordset = '$lastmonth' and yearofrecordset = '$year' and testtype ='2' and lab='$lab'";die();
			$abbott_info_result_b	= $abbott_info_b ->result_array();
			if(count($abbott_info_result_b)>0){
				$data['vtestsdone']		= $vtestsdone = $abbott_info_result_b[0]['testsdone']; 
			
				//..used
				$vuqualkit				=($vtestsdone / 93);
				$data['vuqualkit'] 		= $vuqualkit;
				$data['vucontrol'] 		= ($vuqualkit * 3)/24;
				$data['vubuffer'] 		= $vuqualkit * 1;
				$data['vupreparation'] 	= $vuqualkit * 1;
				$data['vuadhesive'] 	= ($vuqualkit * 1)/100;
				$data['vudeepplate'] 	= ($vuqualkit * 3)/4;
				$data['vumixtube'] 		= ($vuqualkit * 1)/25;
				$data['vureactionvessels']= ($vuqualkit * 192)/500;
				$data['vureagent'] 		= ($vuqualkit * 6)/6;
				$data['vureactionplate']= ($vuqualkit * 1)/20;
				$data['vu1000disposable']= ($vuqualkit * 1)*(841/192);
				$data['vu200disposable'] = ($vuqualkit * 1)*(96/192);
				
				//..wasted
				$data['vwqualkit']			= $abbott_info_result_b[0]['wastedqualkit'];
				$data['vwcalibration']		= $abbott_info_result_b[0]['wastedcalibration'];
				$data['vwcontrol']			= $abbott_info_result_b[0]['wastedcontrol'];
				$data['vwbuffer']			= $abbott_info_result_b[0]['wastedbuffer'];
				$data['vwpreparation']		= $abbott_info_result_b[0]['wastedpreparation'];
				$data['vwadhesive']			= $abbott_info_result_b[0]['wastedadhesive'];
				$data['vwdeepplate']		= $abbott_info_result_b[0]['wasteddeepplate'];
				$data['vwmixtube']			= $abbott_info_result_b[0]['wastedmixtube'];
				$data['vwreactionvessels']	= $abbott_info_result_b[0]['wastedreactionvessels'];
				$data['vwreagent']			= $abbott_info_result_b[0]['wastedreagent'];
				$data['vwreactionplate']	= $abbott_info_result_b[0]['wastedreactionplate'];
				$data['vw1000disposable']	= $abbott_info_result_b[0]['wasted1000disposable'];
				$data['vw200disposable']	= $abbott_info_result_b[0]['wasted200disposable'];
				
				//..issued
				$data['viqualkit']			= $abbott_info_result_b[0]['issuedqualkit'];
				$data['vicalibration']		= $abbott_info_result_b[0]['issuedcalibration'];
				$data['vicontrol']			= $abbott_info_result_b[0]['issuedcontrol'];
				$data['vibuffer']			= $abbott_info_result_b[0]['issuedbuffer'];
				$data['vipreparation']		= $abbott_info_result_b[0]['issuedpreparation'];
				$data['viadhesive']			= $abbott_info_result_b[0]['issuedadhesive'];
				$data['videepplate']		= $abbott_info_result_b[0]['issueddeepplate'];
				$data['vimixtube']			= $abbott_info_result_b[0]['issuedmixtube'];
				$data['vireactionvessels']	= $abbott_info_result_b[0]['issuedreactionvessels'];
				$data['vireagent']			= $abbott_info_result_b[0]['issuedreagent'];
				$data['vireactionplate']	= $abbott_info_result_b[0]['issuedreactionplate'];
				$data['vi1000disposable']	= $abbott_info_result_b[0]['issued1000disposable'];
				$data['vi200disposable']	= $abbott_info_result_b[0]['issued200disposable'];
				
				$data['vicomments']			= $abbott_info_result_b[0]['issuedcomments'];
				
				//..end balance
				$data['vequalkit']			= $abbott_info_result_b[0]['endingqualkit'];
				$data['vecalibration']		= $abbott_info_result_b[0]['endingcalibration'];
				$data['vecontrol']			= $abbott_info_result_b[0]['endingcontrol'];
				$data['vebuffer']			= $abbott_info_result_b[0]['endingbuffer'];
				$data['vepreparation']		= $abbott_info_result_b[0]['endingpreparation'];
				$data['veadhesive']			= $abbott_info_result_b[0]['endingadhesive'];
				$data['vedeepplate']		= $abbott_info_result_b[0]['endingdeepplate'];
				$data['vemixtube']			= $abbott_info_result_b[0]['endingmixtube'];
				$data['vereactionvessels']	= $abbott_info_result_b[0]['endingreactionvessels'];
				$data['vereagent']			= $abbott_info_result_b[0]['endingreagent'];
				$data['vereactionplate']	= $abbott_info_result_b[0]['endingreactionplate'];
				$data['ve1000disposable']	= $abbott_info_result_b[0]['ending1000disposable'];
				$data['ve200disposable']	= $abbott_info_result_b[0]['ending200disposable'];
				
				//..request
				$data['vrqualkit']			= $abbott_info_result_b[0]['requestqualkit'];
				$data['vrcalibration']		= $abbott_info_result_b[0]['requestcalibration'];
				$data['vrcontrol']			= $abbott_info_result_b[0]['requestcontrol'];
				$data['vrbuffer']			= $abbott_info_result_b[0]['requestbuffer'];
				$data['vrpreparation']		= $abbott_info_result_b[0]['requestpreparation'];
				$data['vradhesive']			= $abbott_info_result_b[0]['requestadhesive'];
				$data['vrdeepplate']		= $abbott_info_result_b[0]['requestdeepplate'];
				$data['vrmixtube']			= $abbott_info_result_b[0]['requestmixtube'];
				$data['vrreactionvessels']	= $abbott_info_result_b[0]['requestreactionvessels'];
				$data['vrreagent']			= $abbott_info_result_b[0]['requestreagent'];
				$data['vrreactionplate']	= $abbott_info_result_b[0]['requestreactionplate'];
				$data['vr1000disposable']	= $abbott_info_result_b[0]['request1000disposable'];
				$data['vr200disposable']	= $abbott_info_result_b[0]['request200disposable'];
				//Allocate
				if($type=="download" || $type=="view"){
					$data['vaqualkit']			= $abbott_info_result_b[0]['allocatequalkit'];
					$data['vacalibration']		= $abbott_info_result_b[0]['allocatecalibration'];
					$data['vacontrol']			= $abbott_info_result_b[0]['allocatecontrol'];
					$data['vabuffer']			= $abbott_info_result_b[0]['allocatebuffer'];
					$data['vapreparation']		= $abbott_info_result_b[0]['allocatepreparation'];
					$data['vaadhesive']			= $abbott_info_result_b[0]['allocateadhesive'];
					$data['vadeepplate']		= $abbott_info_result_b[0]['allocatedeepplate'];
					$data['vamixtube']			= $abbott_info_result_b[0]['allocatemixtube'];
					$data['vareactionvessels']	= $abbott_info_result_b[0]['allocatereactionvessels'];
					$data['vareagent']			= $abbott_info_result_b[0]['allocatereagent'];
					$data['vareactionplate']	= $abbott_info_result_b[0]['allocatereactionplate'];
					$data['va1000disposable']	= $abbott_info_result_b[0]['allocate1000disposable'];
					$data['va200disposable']	= $abbott_info_result_b[0]['allocate200disposable'];
				}	
			}
				
			//..END -> VIRAL LOAD
			$data["platform"] = "ABBOTT";
			
		}
		if($type=="download"){//If reports are being downloaded for TAQMAN
			$data["d_type"] = $d_type;//If downloading by plaftorm or by lab
			if($d_platform=="1"){
				$content['data'] = $this ->load ->view("eid/download/download_taqman",$data,TRUE);
			}elseif($d_platform=="2"){
				$content['data'] = $this ->load ->view("eid/download/download_abbott",$data,TRUE);
			}
			$content['datereceived'] =  $datesubmitted;
			$content['labname'] =  $this ->GetLab($lab);
			$content['monthname'] =  $monthname;
			$content['year'] =  $year;
			return $content;
		}
		if(@$this ->input ->post("approval")==1){//For approval
			$this ->load ->view("eid/submission_report_approval",$data);
		}else{
			$this ->load ->view("eid/submit_report_details",$data);
		}
		
		
	}
	
	function lab_type ($lab_id){
    
	    $cpquery= $this -> db ->query("select abbott as abb, taqman as taq from `eid_labs` where id = $lab_id "); 
		$cpss = $cpquery ->result_array();
		$data['abb'] =$cpss[0]['abb'];
		$data['taq'] =$cpss[0]['taq'];
		return $data;
	}
	
	function lab_both_taqman_abbot_report_submission($lab_id,$year,$lastmonth){
        $ctquery=$this -> db ->query("SELECT COUNT(taq.ID) as 'ctaqsubmission',taq.received as taqr from `eid_taqmanprocurement` taq where
		taq.monthofrecordset='$lastmonth' and taq.yearofrecordset='$year' and taq.lab='$lab_id' "); 
		
		$ctss = $ctquery ->result_array();
                
        $ctquery1=$this -> db ->query("SELECT COUNT(abb.ID) as 'ctaqsubmission', abb.received as abbr from `eid_abbottprocurement` abb where
		abb.monthofrecordset='$lastmonth' and abb.yearofrecordset='$year' and abb.lab='$lab_id' "); 
		
		$ctss1 = $ctquery1 ->result_array();
                
		$data['ctkit'] = $ctss[0]['ctaqsubmission'] + $ctss1[0]['ctaqsubmission'];
		$data['taq'] = $ctss[0]['taqr'];
		$data['abb'] = $ctss1[0]['abbr'];
        return $data;
	}
	
	//Approve
	function approve_reports(){
		
		//if($this ->input ->post("btn_approve_reports")){
			$platform = $this ->input ->post("platform");
			$table ="";
			$ssmonth 	= $_POST['lastmonth'];		
			$ssyear		= $_POST['year'];
			$mname		= $_POST['monthname'];
			$lab 		= $_POST['lab'];
			$labname 	= $_POST['labname'];
			$approved_date = date("Y-m-d H:i:s");
			
			//TAQMAN Submission
			if($platform=="TAQMAN"){
				$table 			= "eid_taqmanprocurement";
				$aqualkit 		= $this ->input ->post("rqualkit");
				$aspexagent 	= $this ->input ->post("rspexagent");
				$aampinput 		= $this ->input ->post("rampinput");
				$aampflapless 	= $this ->input ->post("rampflapless");
				$aampwash 		= $this ->input ->post("rampwash");
				$aampktips		= $this ->input ->post("rampktips");
				$aktubes 		= $this ->input ->post("rktubes");
				//$aconsumables 	= $this ->input ->post("rconsumables");
				$avqualkit 		= $this ->input ->post("rvqualkit");
				$avspexagent 	= $this ->input ->post("rvspexagent");
				$avampinput 	= $this ->input ->post("rvampinput");
				$avampflapless 	= $this ->input ->post("rvampflapless");
				$avampwash 		= $this ->input ->post("rvampwash");
				$avampktips		= $this ->input ->post("rvampktips");
				$avktubes 		= $this ->input ->post("rvktubes");
				//$avconsumables 	= $this ->input ->post("rvconsumables");
				$update_eid_procurement = $this ->db ->query("UPDATE $table SET received = 1,approved_date = '$approved_date',
															allocatequalkit='$aqualkit',allocatespexagent='$aspexagent',allocateampinput='$aampinput',allocateampflapless='$aampflapless',allocateampwash='$aampwash',
															allocateampktips='$aampktips',allocatektubes='$aktubes' WHERE monthofrecordset = '$ssmonth' AND yearofrecordset = '$ssyear' AND lab = '$lab' AND testtype='1'");
				$update_vl_procurement = $this ->db ->query("UPDATE $table SET received = 1,approved_date = '$approved_date',
															allocatequalkit='$avqualkit',allocatespexagent='$avspexagent',allocateampinput='$avampinput',allocateampflapless='$avampflapless',allocateampwash='$avampwash',
															allocateampktips='$avampktips',allocatektubes='$avktubes' WHERE monthofrecordset = '$ssmonth' AND yearofrecordset = '$ssyear' AND lab = '$lab' AND testtype='2'");
				
				$platformquery=$this ->db ->query("SELECT abbott as abb from eid_labs where ID = '$lab' "); 
				$platformavailable = $platformquery ->result_array(); 
				$platformresult=$platformavailable[0]['abb'];	
				
				$data  = array();
				$data['lab'] 			= $lab;
				$data['lab_name'] 		= $labname;
				$data['platform'] 		= $platform;//name
				$data['month'] 			= $ssmonth;
				$data['month_name'] 	= $mname;
				$data['year'] 			= $ssyear;
				$data['platformresult'] = $platformresult;
				echo json_encode($data);die();
			
			}else if($platform=="ABBOTT"){
				$table = "eid_abbottprocurement";
				$aqualkit = $this ->input ->post("rqualkit");
				$acalibration = $this ->input ->post("rcalibration");
				$acontrol = $this ->input ->post("rcontrol");
				$abuffer = $this ->input ->post("rbuffer");
				$apreparation = $this ->input ->post("rpreparation");
				$aadhesive = $this ->input ->post("radhesive");
				$adeepplate = $this ->input ->post("rdeepplate");
				$amixtube = $this ->input ->post("rmixtube");
				$areactionvessels = $this ->input ->post("rreactionvessels");
				$areagent = $this ->input ->post("rreagent");
				$areactionplate = $this ->input ->post("rreactionplate");
				$a1000disposable = $this ->input ->post("r1000disposable");
				$a200disposable =  $this ->input ->post("r200disposable");
				
				$avqualkit = $this ->input ->post("rvqualkit");
				$avcalibration = $this ->input ->post("rvcalibration");
				$avcontrol = $this ->input ->post("rvcontrol");
				$avbuffer = $this ->input ->post("rvbuffer");
				$avpreparation = $this ->input ->post("rvpreparation");
				$avadhesive = $this ->input ->post("rvadhesive");
				$avdeepplate = $this ->input ->post("rvdeepplate");
				$avmixtube = $this ->input ->post("rvmixtube");
				$avreactionvessels = $this ->input ->post("rvreactionvessels");
				$avreagent = $this ->input ->post("rvreagent");
				$avreactionplate = $this ->input ->post("rvreactionplate");
				$av1000disposable = $this ->input ->post("rv1000disposable");
				$av200disposable =  $this ->input ->post("rv200disposable");
				
				$update_eid_procurement = $this ->db ->query("UPDATE $table SET received = 1,approved_date = '$approved_date',
																allocatequalkit='$aqualkit',allocatecalibration='$acalibration',allocatecontrol='$acontrol',allocatebuffer='$abuffer',allocatepreparation='$apreparation',allocateadhesive='$aadhesive',
																allocatedeepplate='$adeepplate',allocatemixtube='$amixtube',allocatereactionvessels='$areactionvessels',allocatereagent='$areagent',allocatereactionplate='$areactionplate',allocate1000disposable='$a1000disposable',
																allocate200disposable='$a200disposable' WHERE monthofrecordset = '$ssmonth' AND yearofrecordset = '$ssyear' AND lab = '$lab' AND testtype='1'");
				$update_vl_procurement = $this ->db ->query("UPDATE $table SET received = 1,approved_date = '$approved_date',
																allocatequalkit='$avqualkit',allocatecalibration='$avcalibration',allocatecontrol='$avcontrol',allocatebuffer='$avbuffer',allocatepreparation='$avpreparation',allocateadhesive='$avadhesive',
																allocatedeepplate='$avdeepplate',allocatemixtube='$avmixtube',allocatereactionvessels='$avreactionvessels',allocatereagent='$avreagent',allocatereactionplate='$avreactionplate',allocate1000disposable='$av1000disposable',
																allocate200disposable='$av200disposable' WHERE monthofrecordset = '$ssmonth' AND yearofrecordset = '$ssyear' AND lab = '$lab' AND testtype='2'");
				echo json_encode("success");	
				die();
			}
			die();
			// ------ END OF APPROVAL --------------
			
		//}
	}
	
	function downloadreportbylab($lab='1',$month='8',$year='2014',$send_email=false){//Download approved reports
		//echo $this ->load ->view("eid/download/download_report",'',TRUE);die();
		$data = $this ->displayconsumption("download",$lab,$month,$year,"1");
		$html_data = $data['data'];
		$datereceived = $data['datereceived'];
		$labname = $data['labname'];
		$monthname = $data['monthname'];
		$year = $data['year'];
		$footer = "{DATE D j M Y }|{PAGENO}/{nb}| Date Received:$datereceived, source EID (c) 1987 -  ".date('Y');
		$header = "<div style='text-align: center'>
					<h3>MINISTRY OF PUBLIC HEALTH</h3>
					<h3>NATIONAL AIDS AND STD CONTROL PROGRAM</h3>
					<h3>TAQMAN & ABBOTT KIT CONSUMPTION REPORT FOR [ $labname $monthname $year ]</h3>
				   </div>";
		$filename = "Reports";
		$this->mpdf = new mPDF('C', 'A3-L', 0, '', 5, 5, 16, 16, 9, 9, '');
		$this->mpdf->ignore_invalid_utf8 = true;
        $this->mpdf->WriteHTML($header);
        $this->mpdf->defaultheaderline = 1;  
        $this->mpdf->WriteHTML($html_data);
        $this->mpdf->SetFooter($footer);
		//ABBOTT
		$this->mpdf->AddPage();
		$data = $this ->displayconsumption("download",$lab,$month,$year,"2");
		$html_data = $data['data'];
		$this->mpdf->WriteHTML($html_data);
		//$data = $this ->displayconsumption("download",$lab,$month,$year,"2");
		$html_data = $data['data'];
		$datereceived = $data['datereceived'];
		$footer = "{DATE D j M Y }|{PAGENO}/{nb}| Date Received:$datereceived, source EID (c) 1987 -  ".date('Y');
		$this->mpdf->SetFooter($footer);
        
		if($send_email==true){
			$filename = "Reports";
			$period = date('F Y',strtotime("-1 month"));//Period is previous month
			$name = "Approved $plat Reports for ".$period.".pdf";
			$this ->deleteAllFiles("./assets/css/eid/pdf/");//Delete all files in folder first
			write_file("./assets/css/eid/pdf/$name", $this->mpdf->Output($filename,'S'));
			return "./assets/css/eid/pdf/$name";
		}else{
			$this->mpdf->Output($filename,'D');
		}
		
	}

	function downloadreportbyplatform($month='',$year='',$platform='1',$check='1',$send_email=false){
		$table = "";
		$plat = "";
		if($this->input->post("month") && $this->input->post("year") && $this->input->post("check")){
			$month = $this->input->post("month");
			$year  = $this->input->post("year");
			$check = $this->input->post("check");
		}
		if($platform=="1"){
			$table = "eid_taqmanprocurement";
			$plat = "TAQMAN";
		}else if($platform=="2"){
			$table = "eid_abbottprocurement";
			$plat = "ABBOTT";
		}
		$sql = "SELECT COUNT(taq.id) as total_test, taq.received,l.name,l.id as lab_id FROM `$table` taq
				LEFT JOIN eid_labs l ON l.id = taq.lab
				WHERE 
				taq.monthofrecordset='$month' and taq.yearofrecordset='$year' 
				AND received = 1
				GROUP BY taq.lab";	
		$query = $this ->db ->query($sql);
		$result = $query ->result_array();
		if(count($result)>0){
			if($check=="1"){
				echo '1';
				die();
			}
			
			
			
			foreach ($result as $key => $value) {//Loop through each lab
				$lab = $value['lab_id'];
				$labname = $this ->GetLab($lab);;
				if($key>0){
					$this->mpdf->AddPage();
				}
				//echo $this ->load ->view("eid/download/download_report",'',TRUE);die();
				$data = $this ->displayconsumption("download",$lab,$month,$year,$platform,"byplatform");
				$html_data = $data['data'];
				if($key==0){
					$datereceived = $data['datereceived'];
					$monthname = $data['monthname'];
					$year = $data['year'];
					$header = "<div style='text-align: center; border-bottom:solid 1px #000'>
							<img src='".base_url()."assets/img/coat_of_arms1.png'>
							<h3 style='margin:8px;font-size:12px;'>MINISTRY OF PUBLIC HEALTH</h3>
							<h3 style='margin:8px;font-size:12px;'>NATIONAL AIDS AND STD CONTROL PROGRAM</h3>
							<h3 style='margin:8px;font-size:12px;'>$plat KIT CONSUMPTION REPORT FOR [ $monthname $year ]</h3>
						   </div>";
					$filename = "Reports";
					$this->mpdf = new mPDF('C', 'A3-L', 0, '', 5, 5, 5, 5, 7, 9, '');
					$this->mpdf->WriteHTML($header);
					$this->mpdf->ignore_invalid_utf8 = true;
				}
				//$this->mpdf->SetHeader($labname);
				$this->mpdf->WriteHTML("<h4 style='font-size:11.5px;margin:7px;'>".$labname."</h4>");
		        $this->mpdf->defaultheaderline = 1;  
				$this->mpdf->WriteHTML($html_data);
		        $this->mpdf->SetFooter($footer);
			}
			if($send_email==true){
				$period = date('F Y',strtotime("-1 month"));//Period is previous month
				$name = "Approved $plat Reports for ".$period.".pdf";
				$this ->deleteAllFiles("./assets/css/eid/pdf/");//Delete all files in folder first
				write_file("./assets/css/eid/pdf/$name", $this->mpdf->Output($filename,'S'));
				return "./assets/css/eid/pdf/$name";
			}else{
				$this->mpdf->Output($filename,'D');
			}
		}else{
			echo '<div class="alert alert-warning">
					<span class="label label-warning">NOTE!</span>
					<span> No data available for download for this period </span>
				  </div>';
		}
		
	}
	
	function send_lab_submissions($send_to="kemsa"){//Send approved lab submissions by email
		$month = date('n',strtotime("-1 month"));
		$year = date('Y',strtotime("-1 month"));
		$period = date('F Y',strtotime("-1 month"));
		$emails = "";
		
		//Send reports by platform
		if($send_to=="kemsa"){
			$platforms = array(
								"1"=>"TAQMAN",
								"2"=>"ABBOTT"
								);
			foreach ($platforms as $key => $value) {
				$platform = $key;
				$attachment = $this->downloadreportbyplatform($month,$year,$platform,"",true);
				if($attachment!=NULL){
					$config['protocol']    = 'smtp';
				    $config['smtp_host']    = 'ssl://smtp.gmail.com';
				    $config['smtp_port']    = '465';
				    $config['smtp_timeout'] = '7';
				    $config['smtp_user']    = 'labkitreporting@gmail.com';
				   	$config['smtp_pass']    = 'l@bk1t123456';//healthkenya //hcmpkenya@gmail.com
				 	$config['charset']    = 'utf-8';
				    $config['newline']    = "\r\n";
				    $config['mailtype'] = 'html'; // or html
				    $config['validation'] = TRUE; // bool whether to validate email or not  
					$this->load->library('email', $config);
					$mail_header='<html>
					<style>
						
				    </style>
				    <body>
				    
				    </body>';
				    $subject = "Approved $value Reports for ".$period;	
					$message = "<p>Dear all,<br>
								Please find attached the approved $value reports for $period .
								</p>
								<p style='font-family:sans-serif;font-weight:bold'>
									Regards,<br>
									NASCOP Team
								</p>";
				    $this->email->initialize($config);
				    $this->email->set_newline("\r\n");
			  		$this->email->from($from,'NASCOP'); // change it to yours
			  		$this->email->to("lab@kemsa.co.ke"); // change it to yours
			  		//$bcc_email = "skadima@clintonhealthaccess.org";
			  		//$cc_email="gauthierabdala@gmail.com";
			  		//echo $bcc_email;
			  		// exit;
			  		$emails = $this ->get_emails(0);
					foreach ($emails as $key => $value) {
						if($key==0){
							if($value["right"]=="bcc"){$bcc_email=$value["email"];}
							else{$cc_email=$value["email"];}
						}else{
							if($value["right"]=="bcc"){
								if(!$bcc_email){$bcc_email=$value["email"];}
								else{$bcc_email.=",".$value["email"];}
							}else{
								if(!$cc_email){$cc_email=$value["email"];}
								else{$cc_email.=",".$value["email"];}
							}
						}
						
					}
					
			  		if(isset($cc_email)){
			  			$this->email->cc("mamoumuro@gmail.com,njebungei@yahoo.com,nbowen@nphls.or.ke,jwamicwe@yahoo.co.uk,uys0@cdc.gov,lab@kemsa.co.ke,hoy4@cdc.gov,sgathua@msh-kenya.org,Kangethewamuti@yahoo.com,angoni@nascop.or.ke,omarabdi2@yahoo.com,cmuiva@msh-kenya.org");
			  		}
			  		if(isset($bcc_email)){
			  			$bcc_email.=",jbatuka@usaid.gov,head@nascop.or.ke,gauthierabdala@gmail.com";
			  			
					}else{
						$bcc_email="jbatuka@usaid.gov,head@nascop.or.ke,gauthierabdala@gmail.com";
					}
					$this->email->bcc("smutheu@clintonhealthaccess.org,tngugi@clintonhealthaccess.org,jhungu@clintonhealthaccess.org,jbatuka@usaid.gov,jlusike@clintonhealthaccess.org,onjathi@clintonhealthaccess.org,skadima@clintonhealthaccess.org,jbatuka@usaid.gov,head@nascop.or.ke,gauthierabdala@gmail.com");
			  		$this->email->attach($attachment);
						
			  		$this->email->subject($subject);
			 		$this->email->message($mail_header.$message);
					$this->email->reply_to("labkitreporting@gmail.com", "NASCOP");
			 
					 if($this->email->send()){
					 	$this->email->clear(TRUE);
						unlink($attachment);
					 }
					 else{
						//echo $this->email->print_debugger(); 
						$this -> load -> view('shared_files/404');
						exit;
					}
				}
			}
			$this ->send_lab_submissions("labs");//Send email to labs
			
		}else if($send_to=="labs"){
			$labs = $this->getApprovedReportlabs($month,$year);
			
			foreach ($labs as $key => $value) {
				$lab = $value['lab_id'];
				$lab_name = $value['name'];
				$attachment = $this->downloadreportbylab($lab,$month,$year,true);
				if($attachment!=NULL){
					$config['protocol']    = 'smtp';
				    $config['smtp_host']    = 'ssl://smtp.gmail.com';
				    $config['smtp_port']    = '465';
				    $config['smtp_timeout'] = '7';
				    $config['smtp_user']    = 'labkitreporting@gmail.com';
				   	$config['smtp_pass']    = 'l@bk1t123456';//healthkenya //hcmpkenya@gmail.com
				 	$config['charset']    = 'utf-8';
				    $config['newline']    = "\r\n";
				    $config['mailtype'] = 'html'; // or html
				    $config['validation'] = TRUE; // bool whether to validate email or not  
					$this->load->library('email', $config);
					$mail_header='<html>
					<style>
						
				    </style>
				    <body>
				    
				    </body>';
				    $subject = "Approved TAQMAN and ABBOTT Reports for $period [ $lab_name ]";	
					$message = "<p>Dear all,<br>
								Please find attached the approved TAQMAN AND ABBOTT reports for $period [ $lab_name ].
								</p>
								<p style='font-family:sans-serif;font-weight:bold'>
									Regards,<br>
									NASCOP Team
								</p>";
				    $this->email->initialize($config);
				    $this->email->set_newline("\r\n");
			  		$this->email->from($from,'NASCOP'); // change it to yours
			  		
			  		//$bcc_email = "kevomarete@gmail.com,collinsojenge@gmail.com";
			  		//$cc_email="gauthierabdala@gmail.com";
			  		//echo $bcc_email;
			  		// exit;
			  		
			  		$emails = $this ->get_emails($lab);
					$cc_email=null;
					$bcc_email=null;
					foreach ($emails as $key => $value) {
						if($key==0){
							if($value["right"]=="main"){$main_email=$value["email"];}
							else{$cc_email=$value["email"];}
						}else{
							if($value["right"]=="main"){
								if(!$main_email){$main_email=$value["email"];}
								else{$main_email.=",".$value["email"];}
							}else{
								if($cc_email==null){$cc_email=$value["email"];}
								else{$cc_email.=",".$value["email"];}
							}
						}
						
					}
					
					$this->email->to($main_email); // change it to yours
			  		if($cc_email!=null){
						$this->email->cc($cc_email);
					}
					
			  		if($bcc_email!=null){
			  			$bcc_email.=",smutheu@clintonhealthaccess.org,tngugi@clintonhealthaccess.org,jhungu@clintonhealthaccess.org,jlusike@clintonhealthaccess.org,onjathi@clintonhealthaccess.org,skadima@clintonhealthaccess.org,gauthierabdala@gmail.com";
			  			
					}else{
						$bcc_email="smutheu@clintonhealthaccess.org,tngugi@clintonhealthaccess.org,jhungu@clintonhealthaccess.org,jlusike@clintonhealthaccess.org,onjathi@clintonhealthaccess.org,skadima@clintonhealthaccess.org,gauthierabdala@gmail.com";
					}
			  		//echo "<br>".$lab_name."<br>";
					//echo $main_email."<br>";
					//echo $cc_email."<br>";
					//echo $bcc_email."<br>";
					//die();
					$this->email->bcc($bcc_email);
					$this->email->attach($attachment);
					
						
			  		$this->email->subject($subject);
			 		$this->email->message($mail_header.$message);
					$this->email->reply_to("labkitreporting@gmail.com", "NASCOP");
			 
					if($this->email->send()){
					 	$this->email->clear(TRUE);
						unlink($attachment);
					 }
					 else{
						//echo $this->email->print_debugger(); 
						$this -> load -> view('shared_files/404');
						exit;
					}
				}
			}
		}
		
	}
	
	function get_emails($lab_id=""){
		$sql = "SELECT id,email,`right` FROM eid_useremails WHERE lab='".$lab_id."'";
		$query = $this -> db ->query($sql);
		$result = $query ->result_array();
		return $result;
	}
	
	
	function deleteAllFiles($directory=""){
		if($directory!=""){
			foreach(glob("{$directory}/*") as $file)
		    {
		        if(is_dir($file)) { 
		            deleteAllFiles($file);
		        } else {
		            unlink($file);
		        }
		    }
		}
	}
   
}

?>