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

                $("#facilities")
            .change(function() {   
            // alert($(this).val()); 
            var code= $("#facilities").val(); 
            var code_array=code.split("|");
             $('input:[name=facility_code]').val(code_array[1]);
             $('input:[name=facilityCode]').val(code_array[1]);
             $('input:[name=district_name]').val(code_array[3]);
             $('input:[name=county]').val(code_array[4]);
             switch (code_array[5]){             	
             	case 'GOK':
             	$('#GOK').attr('checked', 'checked');
             	break;
             	case 'Local Authority':
             	$('#local').attr('checked', 'checked');
             	break;
             	case 'FBO':
             	$('#FBO').attr('checked', 'checked');
             	break;
             	case 'NGO':
             	$('#NGO').attr('checked', 'checked');
             	break;
             	case 'Private':
             	$('#private').attr('checked', 'checked');
             	break;
             	default:
             	$('#others').attr('checked', 'checked');
             	break;
             }
               
              });

$("#begin_date").datepicker({
				defaultDate : "",
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				onClose : function(selectedDate) {
					$("#end_date").datepicker("option", "minDate", selectedDate);
				}
			});
        $("#end_date").datepicker({
				defaultDate : "+1w",
				changeMonth : true,
				changeYear : true,
				numberOfMonths : 1,
				onClose : function(selectedDate) {
					$("#begin_date").datepicker("option", "minDate", selectedDate);
				}
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

});


</script>

<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('rtk_management/save_lab_report_data',$attributes); ?>

<div id="dialog-form" title="Enter the lab commodity details here">
	
	<form>
	<table id="user_order" width="10%" class="data-table">
		
	<tr > 						
						<th colspan = "3" style = "text-align:left"><b>Name of Facility:</b></th>
						<td colspan = "2"></td>
						<th colspan = "2" style = "text-align:left"><b>Facility Code:</b></th>	
						<td colspan = "2"></td>
						<th colspan = "4"></th>	
						<th rowspan = "19" colspan = "1"></th>	
					</tr>
<tr>
	<td>
		<input class='user2'type="hidden" id="desc_hidden"  name="desc_hidden"/>
	
	<select id="facilities"  name="facilities" colspan = "3" class="dropdownsize">
		<option>--facilities--</option>
 		<?php 
		foreach ($facilities as $facility) {
			$id=$facility['id'];
			$facility_name=$facility['facility_name'];
			$facility_code=$facility['facility_code'];
			$district_id=$facility['district'];
			$district=$facility['district_name'];
			$county=$facility['county'];
			$owner=$facility['owner'];
			?>
			<option value="<?php echo $id.'|'.$facility_code.'|'.$facility_name.'|'.$district.'|'. $county.'|'. $owner;?>"><?php echo $facility_name;?></option>				
			<!-- <option value="<?php echo $id;?>"><?php echo $county;?></option> -->
 	<?php }
		?>
	</select>			

	</td>
						<td colspan = "2" style = "color:#000"><b></b></td>
						<td colspan = "2"><b></b></td>
						<td><input class='user2'name="facility_code" colspan = "2" style = "color:#000"></td>
						<td colspan = "3"><b></b></td>
						<th colspan = "2" style="text-align:center"><b>Type of Service</b></th>
						<th colspan = "2" style="text-align:center"><b>No. of Tests Done</b></th>
									    
					</tr>
<tr > 		
						<th colspan = "3" style = "text-align:left"><b>District:</b></th>
						<td colspan = "2"><b></b></td>
						<th colspan = "2" style = "text-align:left"><b>Province/County:</b></th>
						<td colspan = "2"></td>
						<th colspan = "4" style="text-align:center"><b>Applicable to HIV Test Kits Only</b></th>
						</tr>
<tr > 		
						<td><input class='user2'name="district_name" colspan = "3" style = "color:#000"></td>
						<td colspan = "2"><b></b></td>
						<td colspan = "2"><b></b></td>
						<td><input class='user2'name="county" colspan = "2"></td>
						<td rowspan = "2" colspan = "3"><b></b></td>
						<th colspan = "2"><b>VCT</b></th>
						<td><input class='user2'class='user2' id="vct" name="vct" colspan = "2" style = "color:#000"></td>
						</tr>
<tr > 		
						<td colspan = "9"><b></b></td>
						<th colspan = "2"><b>PITC</b></th>
						<td><input class='user2' id="pitc" name="pitc" colspan = "2" style = "color:#000"></td>
					</tr>
<tr > 					
	
						<th colspan = "2"><b>Affiliation:</b></th>
						<td colspan="1"><input class='user2'type="radio" id="GOK" name="owner" value="GOK"><b>Ministry&nbsp;of&nbsp;Health</b></td>
					    <td colspan="1"><input class='user2'type="radio" id="local" name="owner" value="Local Authority"><b>Local&nbsp;Authority</b></td>
					    <td colspan="1"><input class='user2'type="radio" id="FBO" name="owner" value="FBO"><b>FBO</b></td>
						<td colspan = "4"><b></b></td>				
						<th colspan = "2"><b>PMTCT</b></th>
						<td><input class='user2' id="pmtct" name="pmtct" colspan = "2" style = "color:#000"></td>
						</tr>
<tr > 		
						<td colspan = "2"><b></b></td>
						<td colspan="1"><input class='user2'type="radio" id="NGO" name="owner" value="NGO"><b>NGO</b> </td>
						<td colspan="1"><input class='user2'type="radio" id="private" name="owner" value="Private"><b>Private</b></td>
						<td colspan="1"><input class='user2'type="radio" id="others" name="owner" value="Private"><b>Others</b></td>
						<td colspan = "4"><b></b></td>			
						<th colspan = "2"><b>Blood Screening</b></th>
						<td><input class='user2'id="blood_screening" name="blood_screening" colspan = "2" style = "color:#000"></td>
					</tr>
<tr > 		
						<td colspan = "9"><b></b></td>				
						<th colspan = "2"><b>Other (please specify)</b></th>
						<td><input class='user2'id="other2" name="other2" colspan = "2" style = "color:#000"></td>
					</tr>
<tr>
						<th colspan = "2">Report&nbsp;for&nbsp;Period:</th>
						<td colspan = "11"></td>
					</tr>
<tr > 		
						<th colspan = "2" style = "text-align:right"><b>Beginning:</b></th>	
						<td><input class='my_date'id="begin_date" name="begin_date" colspan = "2" size="10" type="text"/></td>
						<th colspan = "2" style = "text-align:right"><b>Ending:</b></th>
						<td><input class='my_date'id="end_date" name="end_date" colspan = "2" size="10" type="text"/></td>
						<td colspan = "3"><b></b></td>
						<th colspan = "4" style="text-align:center"><b>Applicable to Malaria Testing Only</b></th>
					</tr>
<tr > 		
						<td colspan = "2"><b></b></td>
						<th colspan = "2" style = "text-align:center"><i>dd/mm/yyyy</i></th>	
						<td colspan = "2"><b></b></td>			
						<th colspan = "2" style = "text-align:center"><i>dd/mm/yyyy</i></th>
						<td colspan = "1"><b></b></td>
						<th colspan = "1"><b>Test</b></th>
						<th colspan = "1"><b>Category</b></th>
						<th colspan = "1"><b>No. of Tests Performed</b></th>
						<th colspan = "1"><b>No. Positive</b></th>
					</tr>
<tr>
						<td rowspan = "4" colspan = "9"></td>
						<th rowspan = "4">RDT</th>
						<tr>
							<th style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</th>
							<td><input class='user2'id="rdt_under_tests" name="rdt_under_tests" size="10" type="text"/></td>
							<td><input class='user2'id="rdt_under_positive" name="rdt_under_positive" size="10" type="text"/></td>							
						</tr>
						<tr><th style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</th>
							<td><input class='user2'id="rdt_to_tests" name="rdt_to_tests" size="10" type="text"/></td>
							<td><input class='user2'id="rdt_to_positive" name="rdt_to_positive" size="10" type="text"/></td>
						</tr>
						<tr><th style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</th>
							<td><input class='user2'id="rdt_over_tests" name="rdt_over_tests" size="10" type="text"/></td>
							<td><input class='user2'id="rdt_over_positive" name="rdt_over_positive" size="10" type="text"/></td>
						</tr>
					</tr>
<tr>
						<td rowspan = "4" colspan = "9"></td>
						<th rowspan = "4">Microscopy</th>
						<tr>
							<th style = "text-align:left">Patients&nbsp;<u>under</u> 5&nbsp;years</th>
							<td><input class='user2'id="micro_under_tests" name="micro_under_tests" size="10" type="text"/></td>
							<td><input class='user2'id="micro_under_positive" name="micro_under_positive" size="10" type="text"/></td>							
						</tr>
						<tr><th style = "text-align:left">Patients&nbsp;aged 5-14&nbsp;yrs</th>
							<td><input class='user2'id="micro_to_tests" name="micro_to_tests" size="10" type="text"/></td>
							<td><input class='user2'id="micro_to_positive" name="micro_to_positive" size="10" type="text"/></td>
						</tr>
						<tr><th style = "text-align:left">Patients&nbsp;<u>over</u> 14&nbsp;years</th>
							<td><input class='user2'id="micro_over_tests" name="micro_over_tests" size="10" type="text"/></td>
							<td><input class='user2'id="micro_over_positive" name="micro_over_positive" size="10" type="text"/></td>
						</tr>
					</tr>

					<tr><th colspan = "14"></th></tr>
	<tr > 		
						<th rowspan = "2" colspan = "2"><b>Commodity Name</b></th>
						<th rowspan = "2"><b>Unit of Issue (e.g. Test)</b></th>
						<th rowspan = "2"><b>Beginning Balance</b></th>
						<th rowspan = "2"><b>Quantity Received</b></th>
						<th rowspan = "2"><b>Quantity Used</b></th>
						<th rowspan = "2"><b>Number of Tests Done</b></th>
						<th rowspan = "2"><b>Losses</b></th>
						<th colspan = "2"><b>Adjustments [indicate if (+) or (-)]</b></th>	
						<th rowspan = "2"><b>End of Month Physical Count</b></th>
						<th rowspan = "2"><b>Quantity Expriing in <u>less than</u> 6 Months</b></th>
						<th rowspan = "2"><b>Days out of Stock</b></th>	
						<th rowspan = "2"><b>Quantity Requested for&nbsp;Re-Supply</b></th>
					</tr>
					<tr>
							<th>Positive</th>
							<th>Negative</th>
						</tr>
					<?php $checker=0;
					foreach ($lab_categories as $lab_category) {
						?>
					<tr>
						<th colspan = "14" style = "text-align:left"><b><?php echo $lab_category->category_name; ?></b></th>		    
					</tr>

						<?php
						foreach ($lab_category->category_lab_commodities as $lab_commodities) {?>
					<tr><input type="hidden" id="commodity_id[<?php echo $checker?>]" name="commodity_id[<?php echo $checker?>]" value="<?php echo $lab_commodities['id']; ?>" >
						<input type="hidden" id="facilityCode" name="facilityCode">
						<input type="hidden" id="district" name="district" value="<?php echo $facility['district']; ?>">
						<th colspan = "2" style = "text-align:left"></b><?php echo $lab_commodities['commodity_name']; ?></th>
						<td><input id="unit_of_issue[<?php echo $checker?>]" name = "unit_of_issue[<?php echo $checker?>]" value="<?php echo $lab_commodities['unit_of_issue']; ?>" readonly="readonly"></td>
						<td><input id="b_balance[<?php echo $checker?>]" name = "b_balance[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="q_received[<?php echo $checker?>]" name = "q_received[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="q_used[<?php echo $checker?>]" name = "q_used[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="tests_done[<?php echo $checker?>]" name = "tests_done[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="losses[<?php echo $checker?>]" name = "losses[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="pos_adj[<?php echo $checker?>]" name = "pos_adj[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>	
						<td><input id="neg_adj[<?php echo $checker?>]" name = "neg_adj[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="physical_count[<?php echo $checker?>]"  name = "physical_count[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="q_expiring[<?php echo $checker?>]" name = "q_expiring[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>
						<td><input id="days_out_of_stock[<?php echo $checker?>]" name = "days_out_of_stock[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>	
						<td><input id="q_requested[<?php echo $checker?>]" name = "q_requested[<?php echo $checker?>]" class='user2' size="10" type="text" style = "text-align:center"/></td>				    
					</tr>
					<?php $checker++;}
					
				}?>
					<tr>
						<th colspan = "14"><br/></th>
					</tr>
<tr>					
						<th colspan = "14" style = "text-align:left">Explain Losses and Adjustments</th>
					</tr>
<tr>					
						<td><input class='user2'id="explanation" name="explanation" size="10" type="text"/></td>
					
					</tr>
					<tr></tr>
					

<tr>
						
						<th colspan = "3" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></th>
						<td><input class='user2'id="order_extra" name="order_extra" size="10" type="text"/></td>
						<th colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></th>
						<td><input class='user2'id="moh_642" name="moh_642" size="10" type="text"/></td>
						<th colspan = "3"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></th>
						<td><input class='user2'id="moh_643" name="moh_643" size="10" type="text"/></td>
					</tr>	


<tr>					<th colspan = "3" style = "text-align:left">Compiled by:</th>
						<th colspan = "2" style = "text-align:left">Tel:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Designation:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Sign:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Date:</th>
					</tr>
<tr>					<td><input class='user2'id="compiled_by" name="compiled_by" size="10" type="text" colspan = "2"/></td>
						<td colspan = "2"><br/></td>
						<td><input class='user2'id="compiled_tel" name="compiled_tel" size="10" type="text" colspan = "2"/></td>
						<td colspan = "1"><br/></td>
						<td colspan = "1"><br/></td>
						<td><input class='user2'id="compiled_des" name="compiled_des" size="10" type="text" colspan = "2"/></td>
						<td colspan = "1"><br/></td>
						<td colspan = "1"><br/></td>
						<td><input class='user2'id="compiled_sign" name="compiled_sign" size="10" type="text" colspan = "2"/></td>
						<td colspan = "1"><br/></td>
						<td colspan = "1"><br/></td>
						<td><input class='user2'id="compiled_date" name="compiled_date" size="10" type="text" colspan = "2"/></td>
					</tr>

					<tr></tr>

<tr>					<th colspan = "3" style = "text-align:left">Approved by:</th>
						<th colspan = "2" style = "text-align:left">Tel:</th>
						<th colspan = "1"><br/></th>
						<th colspan = "2" style = "text-align:left">Designation:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Sign:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Date:</th>
					</tr>
<tr>					<td><input class='user2'id="approved_by" name="approved_by" size="10" type="text" colspan = "2"/></td>
						<td colspan = "2"><br/></td>
						<td><input class='user2'id="approved_tel" name="approved_tel" size="10" type="text" colspan = "2"/></td>
						<td colspan = "1"><br/></td>
						<td colspan = "1"><br/></td>
						<td><input class='user2'id="approved_des" name="approved_des" size="10" type="text" colspan = "2"/></td>
						<td colspan = "1"><br/></td>
						<td colspan = "1"><br/></td>
						<td><input class='user2'id="approved_sign" name="approved_sign" size="10" type="text" colspan = "2"/></td>
						<td colspan = "1"><br/></td>
						<td colspan = "1"><br/></td>
						<td><input class='user2'id="approved_date" name="approved_date" size="10" type="text" colspan = "2"/></td>
					</tr>

</table></form>
</div>
<input class='user2' class="button" type="submit"   id="save1"  value="Save" >

<?php form_close();?>