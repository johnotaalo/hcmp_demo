<?php
/**
 * @author Kariuki
 */
class Hcmp_functions extends MY_Controller {
	
	var $test_mode=true;
	
		function __construct() {
		parent::__construct();
		$this -> load -> helper(array('url','file','download'));
		$this -> load -> library(array('PHPExcel/PHPExcel','mpdf/mpdf'));
	}
public function send_stock_update_sms(){
       $facility_name = $this -> session -> userdata('full_name');
	   $facility_code=$this -> session -> userdata('facility_id');;
	   $data=Users::getUsers($facility_code)->toArray();

	   $message= "Stock level for ".$facility_name." have been updated. HCMP";
       
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);

	   $this->send_sms(substr($phone,0,-1),$message);

	}
public function send_stock_donate_sms(){
		
       $facility_name = $this -> session -> userdata('full_name');
	   $facility_code=$this -> session -> userdata('facility_id');;
	   $data=Users::getUsers($facility_code)->toArray();

	   //$message= "Stock level for ".$facility_name." has been updated. HCMP";
       
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);
	   $message= $facility_name." have been donated commodities. HCMP";		
	   $this->send_sms(substr($phone,0,-1),$message);

	}




public function send_order_sms(){
	

       $facility_name = $this -> session -> userdata('full_name');
	   $facility_code=$this -> session -> userdata('facility_id');;
	   $data=Users::getUsers($facility_code)->toArray();

	   $message= $facility_name." has submitted an order. HCMP";
       
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);

	   $this->send_sms(substr($phone,0,-1),$message);

	}
public function send_order_approval_sms($facility_code,$status){

       $message=($status==1)?$facility_name." order has been rejected. HCMP":
       $facility_name." order has been approved. HCMP";
 
       $data=Users::getUsers($facility_code)->toArray();
	   $phone=$this->get_facility_phone_numbers($facility_code);
	   $phone .=$this->get_ddp_phone_numbers($data[0]['district']);

	   $this->send_sms(substr($phone,0,-1),$message);

	}


public function get_facility_phone_numbers($facility_code){
	$data=Users::get_user_info($facility_code);
	$phone=""; 
	foreach ($data as $info) {

			$telephone =preg_replace('(^0+)', "254",$info->telephone);

		    $phone .=$telephone.'+';	
		}
	return $phone;
}
public function get_facility_email($facility_code){
	$data=Users::get_user_info($facility_code);
	$user_email=""; 
	foreach ($data as $info) {

			$user_email .=$info->email.',';

		   	
		}
	$facility_code=='' ?  exit : null;
	return $user_email;
}

public function get_ddp_phone_numbers($district_id){
	$data=Users::get_dpp_details($district_id);
	$phone=""; 
	
	foreach ($data as $info) {
			$telephone =preg_replace('(^0+)', "254",$info->telephone);
		    $phone .=$telephone.'+';	
		}
	return $phone;
}
public function get_ddp_email($district_id){
	$data=Users::get_dpp_details($district_id);
	$user_email=""; 
	foreach ($data as $info) {

			$user_email .=$info->email.',';
		}
	$district_id=='' ?  exit : null;
	return $user_email;
}
public function get_county_email($county_id){
     !isset($county_id) ?  exit : null; 
	// added function on user
	$county=Districts::get_county_id($county_id);
	$county_email=Users::get_county_details($county[0]['county']);
	if($this->test_mode) return null; //check to ensure the demo site wount start looking for county admin
	if($county[0]['county']==1){
	return 'kariuki.jackson@outlook.com,';	
	}else{
		if(count($county_email)>0){
		return $county_email[0]['email'].',';	
		}else{

		return "";
		}
		
	}
	
}
public function send_stock_decommission_email($message,$subject,$attach_file){
	
	   $facility_code=$this -> session -> userdata('facility_id');;
	   
	   $data=Users::getUsers($facility_code)->toArray();
	   
	   $email_address=$this->get_facility_email($facility_code);
	 
	   $email_address .=$this->get_ddp_email($data[0]['district']);
        
       $email_address .= $this->get_county_email($data[0]['district']);
        
	   $this->send_email(substr($email_address,0,-1),$message,$subject,$attach_file);
	   
	 
	}
public function send_order_submission_email($message,$subject,$attach_file){

	   $facility_code=$this -> session -> userdata('facility_id');
	   $data=Users::getUsers($facility_code)->toArray();
	   $email_address=$this->get_facility_email($facility_code);
	    
	   $email_address .=$this->get_ddp_email($data[0]['district']);	   
	   $cc_email=($this->test_mode)?'kariukijackson@gmail.com,': $this->get_county_email($data[0]['district']) ;

	  return $this->send_email(substr($email_address,0,-1),$message, $subject,$attach_file,null,substr( $cc_email,0,-1));
	
}
public function send_order_approval_email($message,$subject,$attach_file,$facility_code,$reject_order=null){
	  
 $cc_email="";
 $data=facilities::get_facility_name_($facility_code)->toArray();
 $data=$data[0];

  if($reject_order=="Rejected" || $reject_order=="Updated"):
	  $email_address=$this->get_facility_email($facility_code);
	  $cc_email .=$this->get_ddp_email($data['district']);	  
	  else:		  
		  $email_address=($this->test_mode)?'kariuki.jackson@outlook.com,': 'kariuki.jackson@outlook.com,'; 
       
	  $cc_email .=$this->get_ddp_email($data['district']);
	   $cc_email .=$this->get_facility_email($facility_code);


	   $cc_email .=$this->get_county_email($data['district']) ;


  endif;
 
		return $this->send_email(substr($email_address,0,-1),$message, $subject,$attach_file,null,substr($cc_email,0,-1));
	
}
public function send_order_delivery_email($message,$subject,$attach_file=null){

       $cc_email='';
      // echo 'test'; exit;
	   $facility_code=$this -> session -> userdata('facility_id');;	   
	   $data=Users::getUsers($facility_code)->toArray();	   
	   $cc_email .=$this->get_facility_email($facility_code);
	   $cc_email .=$this->get_county_email($data[0]['district']) ;
		
		
	return $this->send_email(substr($this->get_ddp_email($data[0]['district']),0,-1),$message,$subject,null,null,substr($cc_email,0,-1));
	
}
public function send_sms($phones,$message) {
	
   $message=urlencode($message);
   //$spam_sms='254726534272+254720167245';	
   $spam_sms='254720167245+254726534272+254726416795+254725227833+'.$phones;
//  $spam_sms='254726534272';
 	# code...
 	
 	$phone_numbers=explode("+", $spam_sms);
	
	//foreach($phone_numbers as $key=>$user_no):
  //  break;
	//file("http://41.57.109.242:13000/cgi-bin/sendsms?username=clinton&password=ch41sms&to=$user_no&text=$message");
		
	//endforeach;
 		
	}
/*****************************************Email function for HCMP, all the deafult email addresses and email content have been set ***************/

public function send_email($email_address,$message,$subject,$attach_file=NULL,$bcc_email=NULL,$cc_email=NULL){
      
		$mail_list=($this->test_mode)?'kariukijackson@ymail.com,': 'kariukijackson@gmail.com,';
			
		$fromm='info-noreply@health-cmp.or.ke';
		$messages=$message;
  		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://host05.safaricombusiness.co.ke';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = 'info-noreply@health-cmp.or.ke';
        $config['smtp_pass']    = 'hcmp@#2012';//healthkenya //hcmpkenya@gmail.com
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'html'; // or html
        $config['validation'] = TRUE; // bool whether to validate email or not  
		$this->load->library('email', $config);
        $mail_header='<html>
				<style>
#outlook a{padding:0}body{width:100%!important;min-width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%}.ExternalClass{width:100%}.ExternalClass,.ExternalClass div,.ExternalClass font,.ExternalClass p,.ExternalClass span,.ExternalClass td{line-height:100%}#backgroundTable{margin:0;padding:0;width:100%!important;line-height:100%!important}img{outline:0;text-decoration:none;-ms-interpolation-mode:bicubic;width:auto;max-width:100%;float:left;clear:both;display:block}center{width:100%;min-width:580px}a img{border:none}table{border-spacing:0;border-collapse:collapse}td{word-break:break-word;-webkit-hyphens:auto;-moz-hyphens:auto;hyphens:auto;border-collapse:collapse!important}table,td,tr{padding:0;vertical-align:top;text-align:left}hr{color:#d9d9d9;background-color:#d9d9d9;height:1px;border:none}table.body{height:100%;width:100%}table.container{width:580px;margin:0 auto;text-align:inherit}table.row{padding:0;width:100%;position:relative}table.container table.row{display:block}td.wrapper{padding:10px 20px 0 0;position:relative}table.column,table.columns{margin:0 auto}table.column td,table.columns td{padding:0 0 10px}table.column td.sub-column,table.column td.sub-columns,table.columns td.sub-column,table.columns td.sub-columns{padding-right:10px}td.sub-column,td.sub-columns{min-width:0}table.container td.last,table.row td.last{padding-right:0}table.one{width:30px}table.two{width:80px}table.three{width:130px}table.four{width:180px}table.five{width:230px}table.six{width:280px}table.seven{width:330px}table.eight{width:380px}table.nine{width:430px}table.ten{width:480px}table.eleven{width:530px}table.twelve{width:580px}table.one center{min-width:30px}table.two center{min-width:80px}table.three center{min-width:130px}table.four center{min-width:180px}table.five center{min-width:230px}table.six center{min-width:280px}table.seven center{min-width:330px}table.eight center{min-width:380px}table.nine center{min-width:430px}table.ten center{min-width:480px}table.eleven center{min-width:530px}table.twelve center{min-width:580px}table.one .panel center{min-width:10px}table.two .panel center{min-width:60px}table.three .panel center{min-width:110px}table.four .panel center{min-width:160px}table.five .panel center{min-width:210px}table.six .panel center{min-width:260px}table.seven .panel center{min-width:310px}table.eight .panel center{min-width:360px}table.nine .panel center{min-width:410px}table.ten .panel center{min-width:460px}table.eleven .panel center{min-width:510px}table.twelve .panel center{min-width:560px}.body .column td.one,.body .columns td.one{width:8.333333%}.body .column td.two,.body .columns td.two{width:16.666666%}.body .column td.three,.body .columns td.three{width:25%}.body .column td.four,.body .columns td.four{width:33.333333%}.body .column td.five,.body .columns td.five{width:41.666666%}.body .column td.six,.body .columns td.six{width:50%}.body .column td.seven,.body .columns td.seven{width:58.333333%}.body .column td.eight,.body .columns td.eight{width:66.666666%}.body .column td.nine,.body .columns td.nine{width:75%}.body .column td.ten,.body .columns td.ten{width:83.333333%}.body .column td.eleven,.body .columns td.eleven{width:91.666666%}.body .column td.twelve,.body .columns td.twelve{width:100%}td.offset-by-one{padding-left:50px}td.offset-by-two{padding-left:100px}td.offset-by-three{padding-left:150px}td.offset-by-four{padding-left:200px}td.offset-by-five{padding-left:250px}td.offset-by-six{padding-left:300px}td.offset-by-seven{padding-left:350px}td.offset-by-eight{padding-left:400px}td.offset-by-nine{padding-left:450px}td.offset-by-ten{padding-left:500px}td.offset-by-eleven{padding-left:550px}td.expander{visibility:hidden;width:0;padding:0!important}table.column .text-pad,table.columns .text-pad{padding-left:10px;padding-right:10px}table.column .left-text-pad,table.column .text-pad-left,table.columns .left-text-pad,table.columns .text-pad-left{padding-left:10px}table.column .right-text-pad,table.column .text-pad-right,table.columns .right-text-pad,table.columns .text-pad-right{padding-right:10px}.block-grid{width:100%;max-width:580px}.block-grid td{display:inline-block;padding:10px}.two-up td{width:270px}.three-up td{width:173px}.four-up td{width:125px}.five-up td{width:96px}.six-up td{width:76px}.seven-up td{width:62px}.eight-up td{width:52px}h1.center,h2.center,h3.center,h4.center,h5.center,h6.center,table.center,td.center{text-align:center}span.center{display:block;width:100%;text-align:center}img.center{margin:0 auto;float:none}.hide-for-desktop,.show-for-small{display:none}body,h1,h2,h3,h4,h5,h6,p,table.body,td{color:#222;font-family:Helvetica,Arial,sans-serif;font-weight:400;padding:0;margin:0;text-align:left;line-height:1.3}h1,h2,h3,h4,h5,h6{word-break:normal}h1{font-size:40px}h2{font-size:36px}h3{font-size:32px}h4{font-size:28px}h5{font-size:24px}h6{font-size:20px}body,p,table.body,td{font-size:14px;line-height:19px}p.lead,p.lede,p.leed{font-size:18px;line-height:21px}p{margin-bottom:10px}small{font-size:10px}a{color:#2ba6cb;text-decoration:none}a:active,a:hover{color:#2795b6!important}a:visited{color:#2ba6cb!important}h1 a,h2 a,h3 a,h4 a,h5 a,h6 a{color:#2ba6cb}h1 a:active,h1 a:visited,h2 a:active,h2 a:visited,h3 a:active,h3 a:visited,h4 a:active,h4 a:visited,h5 a:active,h5 a:visited,h6 a:active,h6 a:visited{color:#2ba6cb!important}.panel{background:#f2f2f2;border:1px solid #d9d9d9;padding:10px!important}.sub-grid table{width:100%}.sub-grid td.sub-columns{padding-bottom:0}table.button,table.large-button,table.medium-button,table.small-button,table.tiny-button{width:100%;overflow:hidden}table.button td,table.large-button td,table.medium-button td,table.small-button td,table.tiny-button td{display:block;width:auto!important;text-align:center;background:#2ba6cb;border:1px solid #2284a1;color:#fff;padding:8px 0}table.tiny-button td{padding:5px 0 4px}table.small-button td{padding:8px 0 7px}table.medium-button td{padding:12px 0 10px}table.large-button td{padding:21px 0 18px}table.button td a,table.large-button td a,table.medium-button td a,table.small-button td a,table.tiny-button td a{font-weight:700;text-decoration:none;font-family:Helvetica,Arial,sans-serif;color:#fff;font-size:16px}table.tiny-button td a{font-size:12px;font-weight:400}table.small-button td a{font-size:16px}table.medium-button td a{font-size:20px}table.large-button td a{font-size:24px}table.button:active td,table.button:hover td,table.button:visited td{background:#2795b6!important}table.button:active td a,table.button:hover td a,table.button:visited td a{color:#fff!important}table.button:hover td,table.large-button:hover td,table.medium-button:hover td,table.small-button:hover td,table.tiny-button:hover td{background:#2795b6!important}table.button td a:visited,table.button:active td a,table.button:hover td a,table.large-button td a:visited,table.large-button:active td a,table.large-button:hover td a,table.medium-button td a:visited,table.medium-button:active td a,table.medium-button:hover td a,table.small-button td a:visited,table.small-button:active td a,table.small-button:hover td a,table.tiny-button td a:visited,table.tiny-button:active td a,table.tiny-button:hover td a{color:#fff!important}table.secondary td{background:#e9e9e9;border-color:#d0d0d0;color:#555}table.secondary td a{color:#555}table.secondary:hover td{background:#d0d0d0!important;color:#555}table.secondary td a:visited,table.secondary:active td a,table.secondary:hover td a{color:#555!important}table.success td{background:#5da423;border-color:#457a1a}table.success:hover td{background:#457a1a!important}table.alert td{background:#c60f13;border-color:#970b0e}table.alert:hover td{background:#970b0e!important}table.radius td{-webkit-border-radius:3px;-moz-border-radius:3px;border-radius:3px}table.round td{-webkit-border-radius:500px;-moz-border-radius:500px;border-radius:500px}body.outlook p{display:inline!important}@media only screen and (max-width:600px){table[class=body] img{width:auto!important;height:auto!important}table[class=body] center{min-width:0!important}table[class=body] .container{width:95%!important}table[class=body] .row{width:100%!important;display:block!important}table[class=body] .wrapper{display:block!important;padding-right:0!important}table[class=body] .column,table[class=body] .columns{table-layout:fixed!important;float:none!important;width:100%!important;padding-right:0!important;padding-left:0!important;display:block!important}table[class=body] .wrapper.first .column,table[class=body] .wrapper.first .columns{display:table!important}table[class=body] table.column td,table[class=body] table.columns td{width:100%!important}table[class=body] .column td.one,table[class=body] .columns td.one{width:8.333333%!important}table[class=body] .column td.two,table[class=body] .columns td.two{width:16.666666%!important}table[class=body] .column td.three,table[class=body] .columns td.three{width:25%!important}table[class=body] .column td.four,table[class=body] .columns td.four{width:33.333333%!important}table[class=body] .column td.five,table[class=body] .columns td.five{width:41.666666%!important}table[class=body] .column td.six,table[class=body] .columns td.six{width:50%!important}table[class=body] .column td.seven,table[class=body] .columns td.seven{width:58.333333%!important}table[class=body] .column td.eight,table[class=body] .columns td.eight{width:66.666666%!important}table[class=body] .column td.nine,table[class=body] .columns td.nine{width:75%!important}table[class=body] .column td.ten,table[class=body] .columns td.ten{width:83.333333%!important}table[class=body] .column td.eleven,table[class=body] .columns td.eleven{width:91.666666%!important}table[class=body] .column td.twelve,table[class=body] .columns td.twelve{width:100%!important}table[class=body] td.offset-by-eight,table[class=body] td.offset-by-eleven,table[class=body] td.offset-by-five,table[class=body] td.offset-by-four,table[class=body] td.offset-by-nine,table[class=body] td.offset-by-one,table[class=body] td.offset-by-seven,table[class=body] td.offset-by-six,table[class=body] td.offset-by-ten,table[class=body] td.offset-by-three,table[class=body] td.offset-by-two{padding-left:0!important}table[class=body] table.columns td.expander{width:1px!important}table[class=body] .right-text-pad,table[class=body] .text-pad-right{padding-left:10px!important}table[class=body] .left-text-pad,table[class=body] .text-pad-left{padding-right:10px!important}table[class=body] .hide-for-small,table[class=body] .show-for-desktop{display:none!important}table[class=body] .hide-for-desktop,table[class=body] .show-for-small{display:inherit!important}}table.facebook td{background:#3b5998;border-color:#2d4473}table.facebook:hover td{background:#2d4473!important}table.twitter td{background:#00acee;border-color:#0087bb}table.twitter:hover td{background:#0087bb!important}table.google-plus td{background-color:#DB4A39;border-color:#C00}table.google-plus:hover td{background:#C00!important}.template-label{color:#000;font-weight:700;font-size:11px}.callout .wrapper{padding-bottom:20px}.callout .panel{background:#ECF8FF;border-color:#b9e5ff}.header{background:#F0F2F3}.footer .wrapper{background:#ebebeb}.footer h5{padding-bottom:10px}table.columns .text-pad{padding-left:10px;padding-right:10px}table.columns .left-text-pad{padding-left:10px}table.columns .right-text-pad{padding-right:10px}@media only screen and (max-width:600px){table[class=body] .right-text-pad{padding-left:10px!important}table[class=body] .left-text-pad{padding-right:10px!important}}

  </style><body>';
        $mail_tail='
                        <table class="row footer">
                  <tr>
                    <td class="wrapper">

                    </td>
                    <td class="wrapper last">

                      <table class="six columns">
                        <tr>
                          <td class="last right-text-pad">
                            <h5>Contact Info:</h5>
                            <p>Phone: </p>
                            <p>Email: <a href="mailto:hcmpkenya@gmail.com">hcmpkenya@gmail.com</a></p>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>


                <table class="row">
                  <tr>
                    <td class="wrapper last">

                      <table class="twelve columns">
                        <tr>
                          <td align="center">
                            <center>
                              <p style="text-align:center;"><a href="#">Terms</a> | <a href="#">Privacy</a> | <a href="#">Unsubscribe</a></p>
                            </center>
                          </td>
                          <td class="expander"></td>
                        </tr>
                      </table>

                    </td>
                  </tr>
                </table>

              <!-- container end below -->
              </td>
            </tr>
          </table>

        </center>
			</td>
		</tr>
	</table>
		</body></html>';
        $this->email->initialize($config);
		
  		$this->email->set_newline("\r\n");
  		$this->email->from($fromm,'Health Commodities Management Platform'); // change it to yours
  		$this->email->to($email_address); // change it to yours
  		
  		isset($cc_email)? $this->email->cc($cc_email): //
  		
  		(isset($bcc_email))?
  		$this->email->bcc($mail_list.$bcc_email)
  		
  		:
  		$this->email->bcc(substr($mail_list,0,-1))

		;
  		
		if (isset($attach_file)): 
		$files=explode("(more)", $attach_file.'(more)');
		$items=count($files)-1;
		foreach($files as $key=>$files){
		if($key!=$items){
		$this->email->attach($files);
		}	
		}

		endif;
			
  		$this->email->subject($subject);
 		$this->email->message($mail_header.$message.$mail_tail);
 
  if($this->email->send())
 {
return TRUE;
 }
 else
{
echo $this->email->print_debugger(); exit;

 
}

}
/**************************************** creating excel sheet for the system *************************/
	public function create_excel($excel_data=NUll) {
		
 //check if the excel data has been set if not exit the excel generation    
     
if(count($excel_data)>0):
		
		$objPHPExcel = new PHPExcel();
		$objPHPExcel -> getProperties() -> setCreator("HCMP");
		$objPHPExcel -> getProperties() -> setLastModifiedBy($excel_data['doc_creator']);
		$objPHPExcel -> getProperties() -> setTitle($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setSubject($excel_data['doc_title']);
		$objPHPExcel -> getProperties() -> setDescription("");

		$objPHPExcel -> setActiveSheetIndex(0);

		$rowExec = 1;

		//Looping through the cells
		$column = 0;

		foreach ($excel_data['column_data'] as $column_data) {
			$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $column_data);
			$objPHPExcel -> getActiveSheet() -> getColumnDimension(PHPExcel_Cell::stringFromColumnIndex($column)) -> setAutoSize(true);
			//$objPHPExcel->getActiveSheet()->getStyle($column, $rowExec)->getFont()->setBold(true);
			$objPHPExcel->getActiveSheet()->getStyleByColumnAndRow($column, $rowExec)->getFont()->setBold(true);
			$column++;
		}		
		$rowExec = 2;
				
		foreach ($excel_data['row_data'] as $row_data) {
		$column = 0;
        foreach($row_data as $cell){
         //Looping through the cells per facility
		$objPHPExcel -> getActiveSheet() -> setCellValueByColumnAndRow($column, $rowExec, $cell);
				
		$column++;	
         }
        $rowExec++;
		}

		$objPHPExcel -> getActiveSheet() -> setTitle('Simple');

		// Save Excel 2007 file
		//echo date('H:i:s') . " Write to Excel2007 format\n";
		$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);

		// We'll be outputting an excel file
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
		// It will be called file.xls
		header("Content-Disposition: attachment; filename=".$excel_data['file_name'].".xlsx");

		// Write file to the browser
        $objWriter -> save('php://output');
       $objPHPExcel -> disconnectWorksheets();
       unset($objPHPExcel);
		// Echo done
endif;
}
 public function clone_excel_order_template($order_id,$report_type,$file_name=null){
    $inputFileName = 'print_docs/excel/excel_template/KEMSA Customer Order Form.xlsx';
    $facility_details = facility_orders::get_facility_order_details($order_id);
	if(count($facility_details)==1):
	$facility_stock_data_item = facility_order_details::get_order_details($order_id);

    $file_name =isset($file_name) ? $file_name.'.xlsx' : time().'.xlsx';
	
	$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
    $excel2=$objPHPExcel= $excel2->load($inputFileName); // Empty Sheet
    
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
	
    $highestColumn = $sheet->getHighestColumn();
	
    $excel2->setActiveSheetIndex(0);
	
    $excel2->getActiveSheet()
    ->setCellValue('H4', $facility_details[0]['facility_code'])
    ->setCellValue('H5', $facility_details[0]['facility_name'])
    ->setCellValue('H6', '')       
    ->setCellValue('H7', $facility_details[0]['county'])
	->setCellValue('H8', $facility_details[0]['order_date']);
   //  Loop through each row of the worksheet in turn
for ($row = 17; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);							  
   if(isset($rowData[0][2])){
   	foreach($facility_stock_data_item as $facility_stock_data_item_){
   	if(in_array($rowData[0][2], $facility_stock_data_item_)){
   	$key = array_search($rowData[0][2], $facility_stock_data_item_);
	$excel2->getActiveSheet()->setCellValue("H$row", $facility_stock_data_item_['quantity_ordered_pack']);	
   	}	
   	} 	
   }
}

   $objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
   if($report_type=='download_file'){
   	// We'll be outputting an excel file
		header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
        header("Cache-Control: no-store, no-cache, must-revalidate");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
		// It will be called file.xls
		header("Content-Disposition: attachment; filename=$file_name");
		// Write file to the browser
        $objWriter -> save('php://output');
       $objPHPExcel -> disconnectWorksheets();
       unset($objPHPExcel);
   } elseif($report_type=='save_file'){
   	 $objWriter->save("./print_docs/excel/excel_files/".$file_name);
   }
   endif;

 }
/*********KEMSA UPLOADER**********/
 public function kemsa_excel_order_uploader($inputFileName){
   // $inputFileName = 'print_docs/excel/excel_template/KEMSA Customer Order Form.xlsx';

	if(isset($inputFileName)):
	$item_details = Commodities::get_all_from_supllier(1);

	$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
    $excel2=$objPHPExcel= $excel2->load($inputFileName); // Empty Sheet
    
    $sheet = $objPHPExcel->getSheet(0); 
    $highestRow = $sheet->getHighestRow(); 
	
    $highestColumn = $sheet->getHighestColumn();
	$temp=array();
    $facility_code= $sheet->getCell('H4')->getValue();
	
   //  Loop through each row of the worksheet in turn
for ($row = 1; $row <= $highestRow; $row++){ 
    //  Read a row of data into an array
    $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,NULL,TRUE,FALSE);							  
   if(isset($rowData[0][2]) && $rowData[0][2]!='Product Code'){
   	foreach($item_details as $key=> $data){
   	if(in_array($rowData[0][2], $data)){
array_push($temp,array('sub_category_name'=>$data['sub_category_name'],'commodity_name'=>$data['commodity_name']
	,'unit_size'=>$data['unit_size'],'unit_cost'=>$data['unit_cost'],'commodity_code'=>$data['commodity_code'],'commodity_id'=>$data['commodity_id'],
	'total_commodity_units'=>$data['total_commodity_units'],'opening_balance'=>0,
	'total_receipts'=>0,
	'total_issues'=>0,
	'quantity_ordered'=>$rowData[0][7],
	'comment'=>'',
	'closing_stock_'=>0,
	'closing_stock'=>0,
	'days_out_of_stock'=>0,
	'date_added'=>'',
	'losses'=>0,
	'status'=>0,
	'adjustmentpve'=>0,
	'adjustmentnve'=>0,
	'historical'=>0));
	unset($item_details[$key]);
   	}	
   	} 	
   }
}

   unset($objPHPExcel);
  return(array('row_data'=>$temp,'facility_code'=>$facility_code));
   endif;

 }
/*************/	
/* HCMP file downloader 
/********/	
public function download_file($path){
$data = file_get_contents($path); // Read the file's contents
force_download(basename($path), $data);
}
/*************/	
/* HCMP PDF creator
/********/	

public function create_pdf($pdf_data=NULL){

if(count($pdf_data)>0):	
$url=base_url().'assets/img/coat_of_arms.png';
$html_title="<div align=center><img src='$url' height='70' width='70'style='vertical-align: top;'> </img></div>
<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>$pdf_data[pdf_title]</div>
<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 14px;'>
Ministry of Health</div>
<div style='text-align:center; font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold;display: block; font-size: 13px;'>
Health Commodities Management Platform</div><hr/>";

$table_style='<style>table.data-table {border: 1px solid #DDD;margin: 10px auto;border-spacing: 0px;}
table.data-table th {border: none;color: #036;text-align: center;border: 1px solid #DDD;border-top: none;max-width: 450px;}
table.data-table td, table th {padding: 4px;}
table.data-table td {border: none;border-left: 1px solid #DDD;border-right: 1px solid #DDD;height: 30px;margin: 0px;border-bottom: 1px solid #DDD;}
</style>';
            $name=$this -> session -> userdata('full_name');
	        $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
			$this->mpdf->ignore_invalid_utf8 = true;
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->defaultheaderline = 1;  
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML($table_style.$pdf_data['pdf_html_body']);
            $this->mpdf->SetFooter("{DATE D j M Y }|{PAGENO}/{nb}|Prepared by: $name, source HCMP");

			
	if($pdf_data['pdf_view_option']=='save_file'):
		 //change the pdf to a binary file then use codeigniter write function to write the file as pdf in a specific folder 
		 
		 // $this->mpdf->Output(realpath($path).'arif.pdf','F'); 
		    if(write_file( './pdf/'.$pdf_data['file_name'].'.pdf',$this->mpdf->Output($pdf_data['file_name'],'S'))):return true; else: return false; endif;
	        else:
			//show the pdf on the bowser let the user determine where to save it;
	        $this->mpdf->Output($pdf_data['file_name'],'I');
			exit;
	endif;		

	
endif;
}
/****************************END************************/
 //// /////HCMP Create high chart graph
  public function create_high_chart_graph($graph_data=null)
  {
  	$high_chart='';
  	if(isset($graph_data)):
		$graph_id=$graph_data['graph_id'];
		$graph_title=$graph_data['graph_title'];
		$graph_type=$graph_data['graph_type'];
        $stacking=isset($graph_data['stacking']) ? $graph_data['stacking'] : null;
		$graph_categories=json_encode(array_map('utf8_encode',$graph_data['graph_categories'])); 
		//echo json_encode($graph_data['graph_categories']);
		$graph_yaxis_title=$graph_data['graph_yaxis_title'];
		$graph_series_data=$graph_data['series_data'];
		$array_size=sizeof($graph_data['series_data'][key($graph_data['series_data'])]);			
		$height=$array_size<12? null :$array_size*30;
		$height=isset($height) ? ", height:$height" : null;
		//set up the graph here
		if($graph_type=="bar"){
		$data_=" series: {
                    stacking: '$stacking',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }";	
		}else{
			$data_="column: {
                    stacking: '$stacking',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }";	
		}
		$high_chart .="
		$('#$graph_id').highcharts({
		    chart: { zoomType:'x', type: '$graph_type' $height },
            credits: { enabled:false},
            title: {text: '$graph_title'},
            yAxis: { min: 0, title: {text: '$graph_yaxis_title' }},
            subtitle: {text: 'Source: HCMP', x: -20 },
            xAxis: { categories: $graph_categories },
            tooltip: { crosshairs: [true,true] },
                scrollbar: {
               enabled: true
               },
               plotOptions: {
                 series: {
                    stacking: '$stacking',
                    dataLabels: {
                        enabled: true,
                        color: (Highcharts.theme && Highcharts.theme.dataLabelsColor) || 'white'
                    }
                }
            },
            series: [";			 
		    foreach($graph_series_data as $key=>$raw_data):
					$temp_array=array();
					$high_chart .="{ name: '$key', data:";					 
					  foreach($raw_data as $key_data):
						is_int($key_data)? $temp_array=array_merge($temp_array,array((int)$key_data)) :
						$temp_array=array_merge($temp_array,array($key_data));						
						endforeach;					
					  $high_chart .= json_encode($temp_array)."},";				  
				   endforeach;
	     $high_chart .="]  })";

	endif;

	return $high_chart; 	
  }
//// /////HCMP Create high chart graph
  public function create_high_chart_graph_multistep($graph_data=null)
  {
  	$high_chart='';
  	if(isset($graph_data)):
		$graph_id=$graph_data['graph_id'];
		$graph_title=$graph_data['graph_title'];
		$graph_type=$graph_data['graph_type'];
		$graph_categories=json_encode($graph_data['graph_categories']);
		//echo json_encode($graph_data['graph_categories']);
		$graph_yaxis_title=$graph_data['graph_yaxis_title'];
		$graph_series_data=$graph_data['series_data'];
		//$new_array=$graph_series_data;
		//return ($graph_series_data[0]); key		
		//$size_of_graph=sizeof($graph_series_data[key($graph_series_data)])*200;
		//set up the graph here
		$high_chart .="
		$('#$graph_id').highcharts({
		    chart: { zoomType:'x', type: '$graph_type'},
            credits: { enabled:false},
            title: {text: '$graph_title'},
            yAxis: { min: 0, title: {text: '$graph_yaxis_title' }},
            subtitle: {text: 'Source: HCMP', x: -20 },
            xAxis: { categories: $graph_categories },
            tooltip: { crosshairs: [true,true] },
            series: [";			 
		    foreach($graph_series_data as $key=>$raw_data):
					$temp_array=array();
					$high_chart .="{ name: '$key', data:";					 
					  foreach($raw_data as $key_data):
						$temp_array=array_merge($temp_array,array($key_data));
						endforeach;
					  $high_chart .= "[]".json_encode($temp_array)."},";				  
				   endforeach;
	     $high_chart .="]  })";

	endif;
	return $high_chart; 	
  }
/****************************END************************/
  public function create_data_table($table_data=null){
  	$table_data_html='';
  	if(isset($table_data)):
		$table_id=$table_data['table_id'];
		$table_header=$table_data['table_header'];
		$table_body=$table_data['table_body'];
		$table_data_html .="<table width='100%' style='margin-top:1em;'  
		class='row-fluid table table-hover table-bordered table-update'  id='$table_id'>
	    <thead><tr>";
		foreach($table_header as $key=> $header_data):
		foreach($header_data as $header):
		$table_data_html .="<th>$header</th>";
		endforeach;	
		endforeach;
		$table_data_html .="</tr></thead><tbody>";
		foreach($table_body as $key=> $row):
			$table_data_html .="<tr>";
			foreach($row as $body_data):
				$table_data_html .="<td>$body_data</td>";
			endforeach;	
			$table_data_html .="</tr>";	
		endforeach;
       $table_data_html .="</tbody></table>";
	endif;
	return $table_data_html; 	
  }
/****************************END************************/
 public function create_order_delivery_color_coded_table($order_id){
// get the order and order details here
$detail_list=facility_order_details::get_order_details($order_id,true);
$dates=facility_orders::get_order_($order_id)->toArray();
$facility_name=Facilities::get_facility_name_($dates[0]['facility_code'])->toArray();
$facility_name=$facility_name[0]['facility_name'];
//set up the details		
$table_body="";
$total_fill_rate=0;
$order_value =0;
//get the lead time
$ts1 = strtotime(date($dates[0]["order_date"]));
$ts2 = strtotime(date($dates[0]["deliver_date"]));
$seconds_diff = $ts2 - $ts1; //strtotime($a_date) ? date('d M, Y', strtotime($a_date)) : "N/A";
$date_diff=strtotime($dates[0]["deliver_date"]) ? floor($seconds_diff/3600/24) : "N/A";
$order_date=strtotime($dates[0]["order_date"]) ? date('D j M, Y', $ts1) : "N/A";
$deliver_date=strtotime($dates[0]["deliver_date"]) ? date('D j M, Y', $ts2) : "N/A";
$kemsa_order_no=$dates[0]['kemsa_order_id'];
$order_total=number_format($dates[0]['order_total'], 2, '.', ','); 
$actual_order_total=number_format($date[0]['deliver_total'], 2, '.', ',');
$tester= count($detail_list);
      if($tester==0){ }
	  else{
		foreach($detail_list as $rows){
			//setting the values to display
			 $received=$rows['quantity_recieved'];
			 $price=$rows['unit_cost'];
			 $ordered=$rows['quantity_ordered_unit'];
			 $code=$rows['commodity_id'];	 	
			 $drug_name=$rows['commodity_name'];
			 $kemsa_code=$rows['commodity_code'];
			 $unit_size=$rows['unit_size'];
			 $total_units=$rows['total_commodity_units'];
			 $cat_name=$rows['sub_category_name'];		
		     $received=round(@$received/$total_units);
		     $fill_rate=round(@($received/$ordered)*100);
			 $total=$price* $ordered;	
			 $total_=$price* $received;	
	         $total_fill_rate=$total_fill_rate+$fill_rate;			
		switch (true) {
		case $fill_rate==0:
		 $table_body .="<tr style='background-color: #FBBBB9;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
         $table_body .='<td>'.number_format($total_, 2, '.', ',').'</td>';
         $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
		 break;  					 
		 case $fill_rate<=60:
		 $table_body .="<tr style=' background-color: #FAF8CC;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
         $table_body .='<td>'.number_format($total_, 2, '.', ',').'</td>';
         $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
		 break; 
         case $fill_rate>100.01: 
		 case $fill_rate==100.01:
		 $table_body .="<tr style='background-color: #ea1e17'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
         $table_body .='<td>'.number_format($total_, 2, '.', ',').'</td>';
         $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
		 break;		  
		 case $fill_rate==100:
		 $table_body .="<tr style=' background-color: #C3FDB8;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
         $table_body .='<td>'.number_format($total_, 2, '.', ',').'</td>';
        $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
		 break;				 
		 default :
		 $table_body .="<tr>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
         $table_body .='<td>'.number_format($total_, 2, '.', ',').'</td>';
        $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
		 break;			
		 }
		} 
	$order_value  = round(($total_fill_rate/count($detail_list)),0,PHP_ROUND_HALF_UP);
	}	
	$message=<<<HTML_DATA
	<table>
			<tr>
		<th colspan='11'>
		<p>$facility_name</p>
		<p>Fill rate(Quantity Ordered/Quantity Received)</p>
         <p style="letter-spacing: 1px;font-weight: bold;text-shadow: 0 1px rgba(0, 0, 0, 0.1);">
Facility Order No $order_id| KEMSA Order No $kemsa_order_no | Total ordered value(ksh) $order_total | Total recieved order value(ksh) $actual_order_total |Date Ordered $order_date| Date Delivered $deliver_date| Order lead Time $date_diff; day(s)</p>
		</th>
		</tr>
		<tr>
		<th width="50px" style="background-color: #C3FDB8; "></th>
		<th>Full Delivery 100%</th>
		<th width="50px" style="background-color:#FFFFFF"></th>
		<th>Ok Delivery 60%-less than 100%</th>
		<th width="50px" style="background-color:#FAF8CC;"></th> 
		<th>Partial Delivery less than 60% </th>
		<th width="50px" style="background-color:#FBBBB9;"></th>
		<th>Problematic Delivery 0% </th>
		<th width="50px" style="background-color:#ea1e17;"></th>
		<th>Problematic Delivery over 100%</th>
		</tr></table> </br></n>
<table id="main1" width="100%" class="row-fluid table table-bordered">
	<thead>
		<tr>
		<th><strong>Category</strong></th>
		<th><strong>Description</strong></th>
		<th><strong>Commodity Code</strong></th>
		<th><strong>Unit Size</strong></th>
		<th><strong>Unit Cost Ksh</strong></th>
		<th><strong>Quantity Ordered</strong></th>
		<th><strong>Total Cost</strong></th>
		<th><strong>Quantity Received</strong></th>
		<th><strong>Total Cost</strong></th>
		<th><strong>Fill rate</strong></th>	
		</tr>
	</thead>
	<tbody>	
		 $table_body	
	</tbody>
</table>
<br></n>
HTML_DATA;
return array('table'=>$message,'date_ordered'=>$order_date,'date_received'=>$deliver_date,'order_total'=>$order_total,'actual_order_total'=>$actual_order_total,'lead_time'=>$date_diff,'facility_name'=>$facility_name);
 }
}
