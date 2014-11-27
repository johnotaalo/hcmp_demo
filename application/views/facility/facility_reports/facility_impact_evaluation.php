<?php 
     $attributes = array( 'name' => 'myform', 'id'=>'myform');
	
		foreach ($facilities as $facility) 
		{
			$facility_name = $facility['facility_name'];
			$district = $facility['district'];
			$county_id = Districts::get_county_id($district);
			$district_name = Districts::get_district_name($district);
			$county_name = Counties::get_county_name($county_id['county']);
			
		}
		$facility_code = $this -> session -> userdata('facility_id');
		
		$fname=   $this -> session -> userdata('fname');
		$lname=   $this -> session -> userdata('lname');
		$username=$fname.' '.$lname;
		
		?>
<div style="width: 65%; margin-left: auto; margin-right: auto; font-size: 14px;">
<div id="dialog-form" title="Enter the evaluation information here.">
	<?php
	 	$attributes = array('enctype' => 'multipart/form-data');
		echo form_open('reports/save_facility_impact_evaluation', $attributes);
	?>
		<table id="eval"  width="100%" class="table table-bordered">
		<tr class="info">
			<th colspan="5">Section A: COUNTY INFORMATION</th>
		</tr>
		<tr>
			<td colspan="2">County: <strong><?php echo $county_name['county'];?></strong></td>
			<td colspan="3">Sub County: <strong><?php echo $district_name[0]['district'];?> </strong> </td>
			
		</tr>
		<tr class="info">
			<th colspan="5">Section B: FACILITY INFORMATION</th>
		</tr>
		<tr>
			<td colspan="5">Health Facility Name: <strong><?php echo $facility_name;?></strong></td>
		</tr>
		<tr class="info">
			<th colspan="5">Section C: IMPACT ASSESSMENT</th>
		</tr>
		<tr>
			<td rowspan="5"><strong>Web Tool Usage</strong></td>
			<td colspan="2">No. of facility personnel trained on the use of the tool</td>
			<td colspan="2">
				<input type="text" name="personnel_no" id="personnel_no" onkeyup="checker('personnel_no', 'num')"value=""<?php 
			echo  isset($filled_report['no_of_personnel']) ?  $filled_report['no_of_personnel']: '' ?>"></td>
			
		</tr>
		<tr>
			<td colspan="2">Of the above trained, how many are still using the tool</td>
			<td colspan="2">
				<input type="text" name="no_still_using_tool" id="no_still_using_tool" onkeyup="checker('no_still_using_tool', 'num')"value=""<?php 
			echo  isset($filled_report['no_still_using_tool']) ?  $filled_report['no_still_using_tool']: '' ?>"></td>
			</td>
		</tr>
		<tr>
			<td colspan="4">Which cadres were above the trainees?</td>
		</tr>
		<tr>
			<td colspan="4">
				<textarea style="width:100%; height:100%:border-box;" name="trainee_cadre" id="trainee_cadre">
					<?php 
			echo  isset($filled_report['cadres_of_users']) ?  $filled_report['cadres_of_users']: '' ?>
				</textarea>
				
			</td>
		</tr>
		<tr>
			<td colspan="2">No. of times a week that the tool is accessed</td>
			<td colspan="2">
				<input type="text" name="weekly_no_of_times" id="weekly_no_of_times" onkeyup="checker('weekly_no_of_times', 'num')"value=""<?php 
			echo  isset($filled_report['no_of_times_a_week']) ?  $filled_report['no_of_times_a_week']: '' ?>"></td>
			
		</tr>
		<tr>
			<td rowspan="6"><strong>Commodity Management</strong></td>
			<td colspan="2">Does the physical count tally the recorded count on the HCMP tool?</td>
			<td>
				<input type="radio" class="uncheck" name="qstn_tally" id="tally_yes" value="1" >Yes
				</td>
			<td>
				<input type="radio" class="uncheck"  name="qstn_tally" id="tally_no" value="2" >No
				</td>
			
		</tr>
		
		</tr>
		<tr>
			<td colspan="2">No. of commodities that the facility is stocked out on</td>
			<td colspan="2">
				<input type="text" name="no_of_commodity_stock_out" id="no_of_commodity_stock_out" onkeyup="checker('no_of_commodity_stock_out', 'num')"
			value=""<?php 
			echo  isset($filled_report['amount_of_commodities_stocked']) ?  $filled_report['amount_of_commodities_stocked']: '' ?>"></td>
		</tr>
		<tr>
			<td colspan="2">Duration of stock out(days/month)</td>
			<td colspan="2">
				<input type="text" name="duration_of_stock_out" id="duration_of_stock_out"value=""<?php 
			echo  isset($filled_report['duration_of_stockout']) ?  $filled_report['duration_of_stockout']: '' ?>"></td>
		</tr>
		<tr>
			<td colspan="2">No. of commodities that have expired</td>
			<td colspan="2">
				<input type="text"  name="total_expired_commodities" id="total_expired_commodities" onkeyup="checker('total_expired_commodities', 'num')"value=""<?php 
			echo  isset($filled_report['amount_of_expired_commodities'])?  $filled_report['amount_of_expired_commodities']: '' ?>"></td>
		</tr>
		<tr>
			<td colspan="2">No. of commodities that are over stocked in the facility</td>
			<td colspan="2">
				<input type="text" name="total_overstocked_commodities" id="total_overstocked_commodities" onkeyup="checker('total_overstocked_commodities', 'num')"value=""<?php 
			echo  isset($filled_report['amount_of_overstocked_commodities']) ?  $filled_report['amount_of_overstocked_commodities']: '' ?>"></td>
		</tr>
		<tr>
			<td colspan="2">Does the facility have adequate storage space for the commodities</td>
			<td><input type="radio"  class="uncheck" name="adequate_storage" id="adequate_storage_yes" value="1" > Yes</td>
			<td><input type="radio" class="uncheck"  name="adequate_storage" id="adequate_storage_no" value="2" > No</td></tr>
		
		</tr>
		<tr>
			<td rowspan="6"><strong>Order Management</strong></td>
			<td colspan="2">When was the last order placed?</td>
			<td colspan="2">
				<input class='form-control input-small clone_datepicker_normal_limit_today' 
				type="text" name="date_of_last_order" id="date_of_last_order" required="required" value=""<?php 
			echo  isset($filled_report['date_of_last_order']) ?  $filled_report['date_of_last_order']: '' ?>"/></td>
			
		</tr>
		<tr>
			<td colspan="2">Which quarter was the above order to serve?</td>
			<td colspan="2">
				<select name="quarter_served" id="quarter_served" class="quarter_served">
					<option value="1">1st Quarter(Jan-Mar)</option>
					<option value="2">2nd Quarter(Apr-Jun)</option>
					<option value="3">3rd Quarter(Jul-Sep)</option>
					<option value="4">4th Quarter(Oct-Dec)</option>
				</select>
			</td>
		</tr>
		<tr>
			<td colspan="2">Are there discrepancies with the order that was placed?</td>
			<td><input type="radio"  class="uncheck" name="discrepancies" id="discrepancies_yes" value="1" > Yes</td>
			<td><input type="radio" class="uncheck"  name="discrepancies" id="discrepancies_no" value="2" > No</td></tr>
		
		</tr>
		
		<tr>
			<td colspan="4">Please elaborate the above discrepancies</td>
		</tr>
		<tr>
			<td colspan="4">
				<textarea style="width:100%; height:100%:border-box;" name="elaborated_discrepancies" id="elaborated_discrepancies">
				<?php 
			echo  isset($filled_report['reasons_for_discrepancies']) ?  $filled_report['reasons_for_discrepancies']: '' ?>
				</textarea>
			</td>
		</tr>
		<tr>
			<td colspan="2">When is the expected date/month of delivery for the order placed</td>
			<td colspan="2">
				<input class='form-control input-small clone_datepicker_normal_limit_today' 
				type="text" name="expected_date_of_delivery" id="expected_date_of_delivery" required="required" value=""<?php 
			echo  isset($filled_report['date_of_delivery']) ?  $filled_report['date_of_delivery']: '' ?>"/></td>
			</td>
		</tr>
		<tr>
			<td colspan="5">General challenges experienced</td>
		</tr>
		<tr>
			<td colspan="5">
				<textarea style="width:100%; height:100%:border-box;" name="general_challenges" id="general_challenges">
				<?php 
			echo  isset($filled_report['general_challenges']) ?  $filled_report['general_challenges']: '' ?>
				</textarea>
			</td>
		</tr>
		</table>
	
</div>
<input class="btn btn-primary" type="submit"   id="save1"  value="Save" style="margin-left: 0%; width=100px" >
<?php echo form_close();?>
</div>
<script>
function checker(inputvalue,chrtype)
	{
		//get from which row we are getting the data from which the user is adding data
		var name = inputvalue;
		var type = chrtype;
		//checking if the quantity is a number
		var num = document.getElementsByName(name)[0].value.replace(/\,/g,'');
		if(!isNaN(num))
		{
			if(num.indexOf('.') > -1) 
			{
				alert("Decimals are not allowed.");
				document.getElementsByName(name)[0].value = document.getElementsByName(name)[0].value.substring(0,document.getElementsByName(name)[0].value.length-1);
				document.getElementsByName(name)[0].select();
				return;
			}
		} else{
			alert('Enter only numbers');
			document.getElementsByName(name)[0].value= document.getElementsByName(name)[0].value.substring(0,document.getElementsByName(name)[0].value.length-1);
			document.getElementsByName(name)[0].select();	
			return;
		}
		if(num <0)
		{
			alert('Negatives are not allowed');
			document.getElementsByName(name)[0].value= document.getElementsByName(name)[0].value.substring(0,document.getElementsByName(name)[0].value.length-1);
			document.getElementsByName(name)[0].select();	
			return;	
		}
	}
function textchecker(inputvalue,chrtype)
	{
		//get from which row we are getting the data from which the user is adding data
		var name = inputvalue;
		var type = chrtype;
		var text = document.getElementsByName(name)[0].value.replace(/\,/g,'');
		var regex = /^([0-9]+)$/;
		if(regex.test(text))
		{
			alert('Only text allowed.');
			document.getElementsByName(name)[0].value= document.getElementsByName(name)[0].value.substring(0,document.getElementsByName(name)[0].value.length-1);
			document.getElementsByName(name)[0].select();
			return;	
		}
	}	
$(document).ready(function() {
	

});
</script>