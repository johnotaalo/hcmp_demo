<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/unit_size.js"></script>
<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
		</style>
<style>
.user{
	width:70px;
	background : none;
	border : none;
	text-align: center;
	}
	.user2{
	width:70px;
	
	text-align: center;
	}
	.col5{background:#D8D8D8;}
	</style>
	<script type="text/javascript">
	$(function() {
jQuery(document).ready(function() {

		$("#begin_date").datepicker({
				defaultDate : "",
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				// onClose : function(selectedDate) {
				// 	$("#end_date").datepicker("option", "minDate", selectedDate);
				// }
			});
        $("#end_date").datepicker({
				defaultDate : "",
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				// onClose : function(selectedDate) {
				// 	$("#begin_date").datepicker("option", "minDate", selectedDate);
				// }
			});
            });


					var $myDialog = $('<div></div>')
    .html('Please confirm the values before saving')
    .dialog({
        autoOpen: false,
        title: 'Confirmation',
        buttons: { "Cancel": function() {
                      $(this).dialog("close");
                      return false;
                },
                "OK": function() { 
                	// var checker=0;
                	// $("input[name^=expiry_date]").each(function() {
                	// 	checker=checker+1;
                		
                	// });
                	// //alert(checker);
                	// if(checker<2){
                	// 	alert("Cannot submit an empty form");
                	// 	$(this).dialog("close"); 
                	// }
                	// else{
                	$(this).dialog("close"); 
                      $('#myform').submit();
                      return true;	
                 }
        }
});

		$('#save1')
		.button()
			.click(function() {
				
			return $myDialog.dialog('open');
		});
			$( "#dialog" ).dialog({
			height: 140,
			modal: true
		});

});


</script>

<?php 
$orderid = $order_id;
 
foreach ($all_details as $detail) {
    $id = $detail['id'];
    $facility_name = $detail['facility_name'];
    $facility_code = $detail['facility_code'];
    $district_id = $detail['district_id'];
    $district = $detail['district'];
    $county = $detail['county'];
    $owner = $detail['owner'];
    $vct = $detail['vct'];
    $pitc = $detail['pitc'];
    $pmtct = $detail['pmtct'];
    $b_screening = $detail['b_screening'];
    $other = $detail['other'];
    $specification = $detail['specification'];
    $rdt_under_tests = $detail['rdt_under_tests'];
    $rdt_under_pos = $detail['rdt_under_pos'];
    $rdt_btwn_tests = $detail['rdt_btwn_tests'];
    $rdt_btwn_pos = $detail['rdt_btwn_pos'];
    $rdt_over_tests = $detail['rdt_over_tests'];
    $rdt_over_pos = $detail['rdt_over_pos'];
    $micro_under_tests = $detail['micro_under_tests'];
    $micro_under_pos = $detail['micro_under_pos'];
    $micro_btwn_tests = $detail['micro_btwn_tests'];
    $micro_btwn_pos = $detail['micro_btwn_pos'];
    $micro_over_tests = $detail['micro_over_tests'];
    $micro_over_pos = $detail['micro_over_pos'];
    $beg_date = $detail['beg_date'];
    $end_date = $detail['end_date'];
    $explanation = $detail['explanation'];
    $moh_642 = $detail['moh_642'];
    $moh_643 = $detail['moh_643'];
    $compiled_by = $detail['compiled_by'];
    $order_date = $detail['order_date'];
//    $phone_no = $detail['telephone'];
    $designation = $this->session->userdata('full_name');
}
	$attributes = array( 'name' => 'myform', 'id'=>'myform');
	echo form_open('rtk_management/update_lab_commodity_orders',$attributes); 
		?>
<div id="dialog-form" title="Lab Commodities Order Report">
	<form>
	<table id="user_order" width="90%" class="data-table">
		<input type="hidden" name="facility_name" colspan = "3" style = "color:#000; border:none" value="<?php echo $facility_name?>"></td>
		<input type="hidden" name="order_id" colspan = "3" style = "color:#000; border:none" value="<?php echo $order_id?>"></td>
		<input type="hidden" name="facility_code" colspan = "2" style = "color:#000; border:none" value="<?php echo $facility_code?>"></td>
		<input type="hidden" name="district_name" colspan = "2" style = "color:#000; border:none" value="<?php echo $district?>"></td>
		<input type="hidden" name="county" colspan = "3" style = "color:#000; border:none" value="<?php echo $county?>"></td>
		
					<tr><td style = "text-align:left"><b>Name of Facility:</b></td>
						<td colspan = "2"><?php echo $facility_name?></td>
						<td colspan = "3" rowspan = "8" style="background: #fff;"></td>
						<td colspan = "3"><b>Applicable to HIV Test Kits Only</b></td>
						<td colspan = "3" rowspan = "8" style="background: #fff;"></td>
						<td colspan = "4" style="text-align:center"><b>Applicable to Malaria Testing Only</b></td>

					</tr>
					<tr ><td colspan = "2" style = "text-align:left"><b>MFL Code:</b></td>
						<td><?php echo $facility_code?></td>
						<td colspan = "2" style="text-align:center"><b>Type of Service</b></td>
						<td colspan = "1" style="text-align:center"><b>No. of Tests Done</b></td>					
						<td colspan = "1"><b>Test</b></td>
						<td colspan = "1"><b>Category</b></td>
						<td colspan = "1"><b>No. of Tests Performed</b></td>
						<td colspan = "1"><b>No. Positive</b></td>							
					</tr>
					<tr><td colspan = "2" style = "text-align:left"><b>District:</b></td>
						<td><?php echo $district?></td>
						<td colspan = "2"><b>VCT</b></td>
						<td><input class='user2'class='user2' id="vct" name="vct" colspan = "2" style = "color:#000" value="<?php echo $vct?>"/></td>					
						<td rowspan = "3">RDT</td>
						<td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
						<td><input class='user2'id="rdt_under_tests" name="rdt_under_tests" size="10" type="text" value="<?php echo $rdt_under_tests?>"/></td>
						<td><input class='user2'id="rdt_under_positive" name="rdt_under_positive" size="10" type="text" value="<?php echo $rdt_under_pos?>"/></td>							
					
						</tr>
					<tr><td colspan = "2" style = "text-align:left"><b>County:</b></td>						
						<td><?php echo $county?></td>
						<td colspan = "2"><b>PITC</b></td>
						<td><input class='user2'class='user2' id="pitc" name="pitc" colspan = "2" style = "color:#000" value="<?php echo $pitc?>"/></td>					
						<td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
						<td><input class='user2'id="rdt_to_tests" name="rdt_to_tests" size="10" type="text" value="<?php echo $rdt_btwn_tests?>"/></td>
						<td><input class='user2'id="rdt_to_positive" name="rdt_to_positive" size="10" type="text" value="<?php echo $rdt_btwn_pos?>"/></td>
						</tr>
					<tr><td colspan = "2" style = "text-align:left"><b>Affiliation:</b></td>	
						<td><?php echo $owner?></td>
						<td colspan = "2"><b>PMTCT</b></td>
						<td><input class='user2'class='user2' id="pmtct" name="pmtct" colspan = "2" style = "color:#000" value="<?php echo $pmtct?>"/></td>					
						<td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
						<td><input class='user2'id="rdt_over_tests" name="rdt_over_tests" size="10" type="text" value="<?php echo $rdt_over_tests?>"/></td>
						<td><input class='user2'id="rdt_over_positive" name="rdt_over_positive" size="10" type="text" value="<?php echo $rdt_over_pos?>"/></td>
						
						</tr>
					<tr><td colspan = "2" style = "text-align:right"><b>Beginning:</b></td>	
						<td><input class='my_date'id="begin_date" name="begin_date" colspan = "2" size="10" type="text" value="<?php echo $beg_date?>"/></td>
						<td colspan = "2"><b>Blood&nbsp;Screening</b></td>
						<td><input class='user2'class='user2' id="blood_screening" name="blood_screening" colspan = "2" style = "color:#000" value="<?php echo $b_screening?>"/></td>					
						<td rowspan = "3">Microscopy</td>
						<td style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</td>
						<td><input class='user2'id="micro_under_tests" name="micro_under_tests" size="10" type="text" value="<?php echo $micro_under_tests?>"/></td>
						<td><input class='user2'id="micro_under_positive" name="micro_under_positive" size="10" type="text" value="<?php echo $micro_under_pos?>"/></td>							
					</tr>
					<tr><td colspan = "2" style = "text-align:right"><b>Ending:</b></td>
						<td><input class='my_date'id="end_date" name="end_date" colspan = "2" size="10" type="text" value="<?php echo $end_date?>"/></td>
						<td colspan = "2"><b>Other&nbsp;(Please&nbsp;Specify)</b></td>
						<td><input class='user2'class='user2' id="other2" name="other2" colspan = "2" style = "color:#000" value="<?php echo $other?>"/></td>						
						<td style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</td>
						<td><input class='user2'id="micro_to_tests" name="micro_to_tests" size="10" type="text" value="<?php echo $micro_btwn_tests?>"/></td>
						<td><input class='user2'id="micro_to_positive" name="micro_to_positive" size="10" type="text" value="<?php echo $micro_btwn_pos?>"/></td>
						</tr>
					<tr><td colspan = "3"></td>
							<td colspan = "2"><b>Specify&nbsp;Here:</b></td>
							<td><input class='user2'class='user2' id="specification" name="specification" colspan = "2" style = "color:#000" value="<?php echo $specification?>"/></td>							
							<td style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</td>
							<td><input class='user2'id="micro_over_tests" name="micro_over_tests" size="10" type="text" value="<?php echo $micro_over_tests?>"/></td>
							<td><input class='user2'id="micro_over_positive" name="micro_over_positive" size="10" type="text" value="<?php echo $micro_over_pos?>"/></td>
						</tr>
			
					<tr></tr>
	<tr > 				<th rowspan = "2" colspan = "2" style = "text-align:center;font-size:12"><b>Category Name</b></th>
						<th rowspan = "2" colspan = "2" style = "text-align:center;font-size:12"><b>Commodity Name</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Unit of Issue (e.g. Test)</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Beginning Balance</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Received</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Used</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Number of Tests Done</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Losses</b></th>
						<th colspan = "2" style = "text-align:center;font-size:12"><b>Adjustments [indicate if (+) or (-)]</b></th>	
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>End of Month Physical Count</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Expiring in <u>less than</u> 6 Months</b></th>
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Days out of Stock</b></th>	
						<th rowspan = "2" style = "text-align:center;font-size:12"><b>Quantity Requested for&nbsp;Re-Supply</b></th>
					</tr>
					<tr>
							<th style = "text-align:center">Positive</th>
							<th style = "text-align:center">Negative</th>
						</tr>
					<?php $checker=0;
					foreach ($all_details as $detail) {?>
					<tr><input type="hidden" id="commodity_id[<?php echo $checker?>]" name="commodity_id[<?php echo $checker?>]" value="<?php echo $detail['commodity_id']; ?>" >
						<input type="hidden" id="facilityCode" name="facilityCode">
						<input type="hidden" id="district" name="district" value="<?php echo $district_id; ?>">
						<input type="hidden" id="unit_of_issue[<?php echo $checker?>]" name = "unit_of_issue[<?php echo $checker?>]" value="<?php echo $detail['unit_of_issue']; ?>">
						<input type="hidden" id="detail_id[<?php echo $checker?>]" name = "detail_id[<?php echo $checker?>]" value="<?php echo $detail['id']; ?>">
						<td colspan = "2" style = "text-align:left"><b><?php echo $detail['category_name']; ?></b></td>		    
						<td colspan = "2" style = "text-align:left"></b><?php echo $detail['commodity_name']; ?></td>
						<td style = "text-align:center" readonly="readonly"><?php echo $detail['unit_of_issue']; ?></td>
						<td><input id="b_balance[<?php echo $checker?>]" name = "b_balance[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['beginning_bal']; ?>"/></td>
						<td><input id="q_received[<?php echo $checker?>]" name = "q_received[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_received']; ?>"/></td>
						<td><input id="q_used[<?php echo $checker?>]" name = "q_used[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_used']; ?>"/></td>
						<td><input id="tests_done[<?php echo $checker?>]" name = "tests_done[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['no_of_tests_done']; ?>"/></td>
						<td><input id="losses[<?php echo $checker?>]" name = "losses[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['losses']; ?>"/></td>
						<td><input id="pos_adj[<?php echo $checker?>]" name = "pos_adj[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['positive_adj']; ?>"/></td>
						<td><input id="neg_adj[<?php echo $checker?>]" name = "neg_adj[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['negative_adj']; ?>"/></td>
						<td><input id="physical_count[<?php echo $checker?>]"  name = "physical_count[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['closing_stock']; ?>"/></td>
						<td><input id="q_expiring[<?php echo $checker?>]" name = "q_expiring[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_expiring']; ?>"/></td>
						<td><input id="days_out_of_stock[<?php echo $checker?>]" name = "days_out_of_stock[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['days_out_of_stock']; ?>"/></td>	
						<td><input id="q_requested[<?php echo $checker?>]" name = "q_requested[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center" value="<?php echo $detail['q_requested']; ?>"/></td>
					</tr>
					<?php $checker++;
					
				}?>
					<tr>
						<td colspan = "16"><br/></td>
					</tr>
<tr>					
						<td colspan = "16" style = "text-align:left">Explain Losses and Adjustments:</td>
					</tr>
<tr>					
						<td colspan = "16"><input colspan = "16" id="explanation" name="explanation" size="210" type="text" value="<?php echo $explanation?>" style=" width: 90%;"/></td>
					
					</tr>
					<tr></tr>
<tr>
						
						<td colspan = "4" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></td>
						<td colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></td>
						<td colspan = "2"><input class='user2' id="moh_642" name="moh_642" size="10" type="text" value="<?php echo $moh_642?>"/></td>
						<td colspan = "4"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></td>
						<td colspan = "2"><input class='user2' id="moh_643" name="moh_643" size="10" type="text" value="<?php echo $moh_643?>"/></td>
					</tr>
<tr>					<td colspan = "4" style = "text-align:left">Compiled by: <?php echo $compiled_by?><input name="compiled_by" value ="<?php echo $compiled_by;?>" /></td>
						<td colspan = "3" style = "text-align:left">Tel: <?php //echo $phone_no?><input name="compiled_by" value ="<?php // cho $phone_no;?>" /></td>
						<td colspan = "3" style = "text-align:left">Designation: <?php //echo $full_name;?><input name="compiled_by" value ="<?php // echo $full_name;?>" /></td>
						<td colspan = "3" style = "text-align:left">Sign:</td>
						<td colspan = "3" style = "text-align:left">Date: <?php echo $order_date?></td>
					</tr>

<tr>					<td colspan = "4" style = "text-align:left">Approved by:</td>
						<td colspan = "3" style = "text-align:left">Tel:</td>
						<td colspan = "3" style = "text-align:left">Designation:</td>
						<td colspan = "3" style = "text-align:left">Sign:</td>
						<td colspan = "3" style = "text-align:left">Date:</td>
					</tr>


</table></form>
</div>
<input  class="btn btn-primary" id="save1" name="save1"  value="Update Order" >

<?php form_close();?>