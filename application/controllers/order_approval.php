<?php if(!defined('BASEPATH')) exit('No direct script access allowed');
include_once('auto_sms.php');
 class Order_Approval  extends auto_sms {
 	
 	
	function __construct() {
		parent::__construct();
		$this->load->helper(array('form','url'));
	
	}
	
	public function district_approval(){
		$data['title'] = "District View";
		$data['content_view'] = "district/district_home_v";
		$data['banner_text'] = "District Home";
		$data['link'] = "order_appoval";
		$data['quick_link'] = "new_order";
		$this -> load -> view("template", $data);
	}
	
	public function district_orders($msg=NULL){
		//$district_id=$this -> session -> userdata('district');
		$district_id=$this -> session -> userdata('district1');
		
		$data['title'] = "Subcounty Orders";
		$data['content_view'] = "district/district_orders_v";
		$data['banner_text'] = "Subcounty Orders";
		$data['order_counts']=Counties::get_county_order_details(null,$district_id,null);
		$data['delivered']=Counties::get_county_received(null,$district_id,null);
		$data['pending']=Counties::get_pending_county(null,$district_id,null);
		$data['approved']=Counties::get_approved_county(null,$district_id,null);
		$data['rejected']=Counties::get_rejected_county(null,$district_id,null);

		$this -> load -> view("template", $data);
		
	}
	public function district_order_details($delivery,$facility_code=null,$for_facility=null,$rejected_order=null,$view=null){
	
		$data['title'] = "Order detail View";
     	$data['content_view'] = isset($for_facility)? "facility/facility_data/facility_orders/facility_update_order_v" :"district/moh_orderdetail_v";
		$data['banner_text'] = "Order detail View";
		$data['link'] = "home";
		$data['view']=$view;
		$data['rejected_order']=$rejected_order;
		$data['drug_name']=Drug::get_drug_name();
		$data['quick_link'] = "moh_order_v";
		$data['order_details']=ordertbl::get_details($delivery)->toArray();
		$data['detail_list']=Orderdetails::get_order($delivery);		
		$this -> load -> view("template", $data);
	}
	public function update_order(){
		
		$this->load->helper('file');
		$this->load->library('mpdf');
		
		$new_value=@$_POST['quantity'];
		$price=@$_POST['price'];
		$order_id=@$_POST['order_id'];
		$value=count($new_value);
		$code=@$_POST['f_order_id'];
		$s_quantity=@$_POST['actual_quantity'];
		$order_total=0;
		$reject_order=@$_POST['reject_order_status'];
		
		($value==0)?redirect("order_approval/district_orders") : $blank_data;
		
		$user_id=$facility_c=$this -> session -> userdata('user_id');
		
		
		if($reject_order==1){
			// do not update the order
		}
		else{
		for($i=0;$i<$value;$i++){
				
		$myobj = Doctrine::getTable('Orderdetails')->find($order_id[$i]);
        $myobj->quantityOrdered = $new_value[$i];
		$myobj->s_quantity =$s_quantity[$i];
        $myobj->save();
		//$total=$total*($new_value[$i]*$price[$i]);
			//echo $new_value[$i];
		}
			
		}
		
		$from_ordertbl=Ordertbl::get_order($code,$user_id);

		$from_order_details=Orderdetails::get_order($code);
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
		   <tr><td>Authorised by (Name/DMoH) '.$approve_name1.' '.$approve_name2.'
		   <br/>
		   <br/>Email: '.$approve_name.'</td><td>Tel: '.$approve_telephone.'</td><td>Date: '.date('d M, Y',strtotime ($a_date)).'</td><td>Signature</td>
		   
		   </tr>
		   </table>';
		   
		 $myobj = Doctrine::getTable('Ordertbl')->find($code);
        $myobj->orderTotal =$order_total;
        $myobj->save();
		//now ganerate an order pdf from the generated report
            $this->mpdf = new mPDF('', 'A4-L', 0, '', 15, 15, 16, 16, 9, 9, '');
            $this->mpdf->WriteHTML($html_title);
            $this->mpdf->defaultheaderline = 1;  
            $this->mpdf->simpleTables = true;
            $this->mpdf->WriteHTML($html_body);
            $this->mpdf->AddPage();
			$this->mpdf->WriteHTML($html_body1);
			
			if($reject_order==1){
			$status='rejected';
			}
			else{
			$status='approved';
			}
			
			
			$report_name=$status.'_facility_order_no_'.$code.'_date_'.date('d-m-y');
			//$this->mpdf->Output('$report_name','I');
			//exit;
           		  
			if(!write_file( './pdf/'.$report_name.'.pdf',$this->mpdf->Output('$report_name','S')))
			{
				
		$this->session->set_flashdata('system_error_message', 'An error occured');			
        redirect("order_approval/district_orders");
 
             }
                  else{
			  
			  $subject=($reject_order==1)?'Rejected Order Report For '.$fac_name: 'Approved Order Report For '.$fac_name;
 
  
  $attach_file='./pdf/'.$report_name.'.pdf';
    
  $message=$html_title.$html_body.$html_body1;
  
  ;	
	$message_1=($reject_order==0)?'<br>Please find the approved Order for  '.$fac_name.'
		<br>
		<br>': '<br>Please note the order for  '.$fac_name.' Has been rejected by '.$approve_name1.' '.$approve_name2.'.
		<br>
		Find the attached order, correct it
		<br>';
		
  
  $response= $this->send_order_approval_email($message_1.$message,$subject,$attach_file,$mfl,$reject_order);

 if($response){
 	delete_files('./pdf/'.$report_name.'.pdf');
 }
					
  }
				  

   if($reject_order==1):
        $myobj = Doctrine::getTable('Ordertbl')->find($code);
        $myobj->orderStatus ="rejected";
        $myobj->save();
   $this->send_order_approval_sms($mfl,$reject_order);
   $this->session->set_flashdata('system_success_message', "Order No $code has been rejected and the facility personel have been notified");	
   else:
   $this->send_order_approval_sms($mfl,$reject_order);
   $this->session->set_flashdata('system_success_message', "Order No $code has been approved");	 
   endif;
   redirect("order_approval/district_orders");
 
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

        //If the holiday doesn't fall in weekend

        if (strtotime($startDate) <= $time_stamp && $time_stamp <= strtotime($endDate) && date("N",$time_stamp) != 6 && date("N",$time_stamp) != 7)

            $workingDays--;

    }*/
    return round ($workingDays-1);
    }
return NULL;
}
 	
 }



?>