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
	<h4>Kindly provide information in all the fields indicated for proper analysis and assessment to be performed. This evaluation will take at least 15 minutes.</h4>
	<form>
		<table id="eval"  width="100%" class="table table-bordered">
		<input type="hidden" name="facility_name" colspan = "3" style = "color:#000; border:none" value="<?php echo $facility_name?>"></td>
		<input type="hidden" name="facility_code" colspan = "2" style = "color:#000; border:none" value="<?php echo $facility_code?>"></td>
		<input type="hidden" name="district_name" colspan = "2" style = "color:#000; border:none" value="<?php echo $district?>"></td>
		<input type="hidden" name="county" colspan = "3" style = "color:#000; border:none" value="<?php //echo $county?>"></td>
		
		<tr class="info"><td colspan="4">1. FACILITY INFORMATION</td></tr>
		<tr><td>Facility Name: <strong><?php echo $facility_name;?></strong></td>
			<td>Sub County: <strong><?php echo $district_name[0]['district'];?></strong> </td>
			<td colspan="2"></td>
		</tr>
		<tr>
			<td rowspan="6" style="">Number of persons trained</td>
			<td>Cadre</td>
			<td colspan="2">Number of persons</td>
			</tr>
			<tr>
				<td> Facility Head</td>
			<td colspan="2"><input type="text"  name="f_headno" id="f_headno" onkeyup="checker('f_headno', 'num')" value="<?php 
			echo  isset($evaluation_data[0]['fhead_no']) ?  $evaluation_data[0]['fhead_no'] : '' ?>"></td>
			</tr>
			<tr>
				<td>Facility Deputy Head</td>
			<td colspan="2">
				<input type="text"  name="f_depheadno" id="f_depheadno" onkeyup="checker('f_depheadno', 'num')" value="<?php 
			echo isset ($evaluation_data[0]['fdep_no']) ? $evaluation_data[0]['fdep_no'] : ''  ?>">
				</td>
				</tr>
			<tr>
				<td>Nurse</td>
			<td colspan="2"><input type="text"  name="nurse_no" id="nurse_no" onkeyup="checker('nurse_no', 'num')" value="<?php 
		    echo isset ($evaluation_data[0]['nurse_no']) ? $evaluation_data[0]['nurse_no'] :''  ?>">
				
			</td>
			</tr>
			<tr>
				<td>Store Manager</td>
			<td colspan="2"><input type="text"  name="store_mgrno" id="store_mgrno" onkeyup="checker('store_mgrno', 'num')" value="<?php 
		   echo isset ($evaluation_data[0]['sman_no']) ? $evaluation_data[0]['sman_no'] : ''  ?>">
			</td>
			</tr>
			<tr>
				<td>Pharmacy Technologist</td>
			<td colspan="2"><input type="text" name="p_techno" id="p_techno" onkeyup="checker('p_techno', 'num')" value="<?php 
		   echo isset ($evaluation_data[0]['fhead_no']) ? $evaluation_data[0]['ptech_no']: ''   ?>">
			</td>
			</tr>
			<tr>
				<td>Trainer's Name</td>
			<td colspan="3"><input type="text" name="trainer" id="trainer" onkeyup="textchecker('trainer', 'text')" value="<?php 
		   echo isset ($evaluation_data[0]['fhead_no']) ?  $evaluation_data[0]['trainer']: '' ?>">
			</td>
			</tr>
			<tr class="info"><td colspan="4">2. TRAINING EVALUATION</td>
			</tr>
			<tr>
				<td colspan="4">a) Were the below appropriate resources available during the training? (Please select the appropriate option)</td>
				</tr>
			<tr>
				<td><input type="checkbox"  name="qstn_acomp" id="computer" <?php echo  ($evaluation_data[0]['comp_avail']==1) ?  "checked='checked'": "''" ?>> Computer</td>
			    <td><input type="checkbox" name="qstn_amodem" id="modem" <?php echo  ($evaluation_data[0]['modem_avail']==1) ?  "checked='checked'": "''" ?>> Modem</td>
				<td><input type="checkbox" name="qstn_abundles" id="i_bundles"<?php echo  ($evaluation_data[0]['bundles_avail']==1) ?  "checked='checked'": "''" ?>> Internet Bundles</td>
				<td><input type="checkbox" name="qstn_amanuals" id="t_manuals" <?php echo  ($evaluation_data[0]['manuals_avail']==1) ?  "checked='checked'": "''" ?>> Training Manuals</td>
		</tr>
		<tr>
			<td colspan="4">b) Please rate the level of satisfaction that the training was done</td>
			</tr>
		<tr>
		<?php switch ($evaluation_data[0]['satisfaction_lvl']):
case 1:
echo <<<HTML_DATA
 	<td><input type="radio" class="uncheck"  name="qstn_b" id="v_satisfied" value="1"> Very satisfied</td>
	<td><input class="uncheck" checked="checked" type="radio"  class="uncheck" name="qstn_b" id="indifferent" value="2"> Indifferent</td>
	<td><input class="uncheck" type="radio"  class="uncheck" name="qstn_b" id="unsatisfied" value="3"> Unsatisfied</td>
	<td><input class="uncheck" type="radio"  class="uncheck" name="qstn_b" id="not_understand" value="4"> I did not understand</td>
HTML_DATA;
	
	break;
	
case 2:

echo <<<HTML_DATA
 <td><input type="radio" class="uncheck"  name="qstn_b" id="v_satisfied" value="1"> Very satisfied</td>
			<td><input checked="checked" type="radio"  class="uncheck" name="qstn_b" id="indifferent" value="2"> Indifferent</td>
			<td><input class="uncheck"  type="radio"  class="uncheck" name="qstn_b" id="unsatisfied" value="3"> Unsatisfied</td>
			<td><input class="uncheck"  type="radio"  class="uncheck" name="qstn_b" id="not_understand" value="4"> I did not understand</td>
HTML_DATA;
	
	break;
	
case 3:
	
	echo <<<HTML_DATA
 <td><input type="radio" class="uncheck"  name="qstn_b" id="v_satisfied" value="1"> Very satisfied</td>
			<td><input class="uncheck"  type="radio"  class="uncheck" name="qstn_b" id="indifferent" value="2"> Indifferent</td>
			<td><input class="uncheck"  checked="checked" type="radio"  class="uncheck" name="qstn_b" id="unsatisfied" value="3"> Unsatisfied</td>
			<td><input class="uncheck"  type="radio"  class="uncheck" name="qstn_b" id="not_understand" value="4"> I did not understand</td>
HTML_DATA;
	break;
	
case 4:

echo <<<HTML_DATA
 <td><input type="radio" class="uncheck"  name="qstn_b" id="v_satisfied" value="1"> Very satisfied</td>
			<td><input class="uncheck"  type="radio"  class="uncheck" name="qstn_b" id="indifferent" value="2"> Indifferent</td>
			<td><input class="uncheck"  type="radio"  class="uncheck" name="qstn_b" id="unsatisfied" value="3"> Unsatisfied</td>
			<td><input class="uncheck"  checked="checked" type="radio"  class="uncheck" name="qstn_b" id="not_understand" value="4"> I did not understand</td>
HTML_DATA;
	break;
		default:
	echo <<<HTML_DATA
 <td><input type="radio" class="uncheck" name="qstn_b" id="v_satisfied" value="1"> Very satisfied</td>
			<td><input type="radio" class="uncheck" name="qstn_b" id="indifferent" value="2"> Indifferent</td>
			<td><input type="radio" class="uncheck" name="qstn_b" id="unsatisfied" value="3"> Unsatisfied</td>
			<td><input type="radio" class="uncheck" name="qstn_b" id="not_understand" value="4"> I did not understand</td>
HTML_DATA;
	

			
endswitch; ?>
			
		</tr>
		<tr>
			<td colspan="2">c) Was the training carried out in agreement to the agreed date and time?</td>
			<td>	
				<input type="radio" class="uncheck"  name="qstn_c" id="c_yes" value="1" <?php echo  ($evaluation_data[0]['agreed_time']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio" class="uncheck"  name="qstn_c" id="c_no" value="2" <?php echo  ($evaluation_data[0]['agreed_time']==2) ?  "checked='checked'": "''" ?>> No</td>
			</tr>
		<tr>
			<td colspan="2">d) Were you given the appropriate feedback and encouragement during the training by the coordinator?</td>
			<td><input type="radio"  class="uncheck" name="qstn_d" id="d_yes" value="1" <?php echo  ($evaluation_data[0]['feedback']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio" class="uncheck"  name="qstn_d" id="d_no" value="2" <?php echo  ($evaluation_data[0]['feedback']==2) ?  "checked='checked'": "''" ?>> No</td></tr>
		<tr>
			<td colspan="4">e) Did the District Pharmacist or District Coordinator carry out further supervision visits to support you in the use of the tool?</td>
			</tr>
		<tr>
			<td>District Pharmacist </td>
			<td><input type="radio" class="uncheck"  name="qstn_ea" id="ea_yes" colspan="0.5" value="1" <?php echo  ($evaluation_data[0]['pharm_supervision']==1) ?  "checked='checked'": "''" ?>> Yes | 
				<input type="radio" class="uncheck"  name="qstn_ea" id="ea_no" value="2" <?php echo  (isset($evaluation_data[0]['pharm_supervision']) &&$evaluation_data[0]['pharm_supervision']==2) ?  "checked='checked'": "''" ?>> No </td>
				<td> District Coordinator </td>
			<td><input type="radio"  class="uncheck" name="qstn_eb" id="eb_yes" value="1" <?php echo  ($evaluation_data[0]['coord_supervision']==1) ?  "checked='checked'": "''" ?>> Yes | 
				<input type="radio"  class="uncheck" name="qstn_eb" id="eb_no" value="2" <?php echo  (isset($evaluation_data[0]['coord_supervision']) &&$evaluation_data[0]['coord_supervision']==2) ?  "checked='checked'": "''" ?>> No</td>
				</tr>
		<tr> 
			<td colspan="2">f) Did you identify any requirements during training that needed to be addressed?</td>
			<td><input type="radio"  class="uncheck" name="qstn_f" id="f_yes" value="1" <?php echo  ($evaluation_data[0]['req_id']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_f" id="f_no" value="2" <?php echo  (isset($evaluation_data[0]['req_id']) &&$evaluation_data[0]['req_id']==2) ?  "checked='checked'": "''" ?>> No</td></tr>
		<tr><td colspan="4">If yes, please specify below</td></tr>
		<tr>	
	<td colspan="4">
		<textarea style="width:95%; height:90%:border-box;​" name="f_specify" id="f_specify" ><?php 
		   echo isset ($evaluation_data[0]['req_spec']) ?  $evaluation_data[0]['req_spec']: '' ?></textarea></td>
		</tr>
		<tr></tr>
		<tr>
			<td colspan="2">Have the requirements been addressed?</td>
			<td><input type="radio"  class="uncheck" name="qstn_faddr" id="faddr_yes" value="1" <?php echo  ($evaluation_data[0]['req_addr']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_faddr" id="faddr_no" value="2" <?php echo  (isset($evaluation_data[0]['req_addr']) &&$evaluation_data[0]['req_addr']==2) ?  "checked='checked'": "''" ?>> No</td>
			</tr>
			<tr>
				<td colspan="4">g) Any remarks regarding how the training was done? (Please specify below)</td></tr>
			<tr><td colspan="4">
			
			<textarea style="width:95%; height:90%:border-box;​" name="g_specify" id="g_specify">
				<?php 
		   echo isset ($evaluation_data[0]['train_remarks']) ?  $evaluation_data[0]['train_remarks']: '' ?>
			</textarea>
			
			</td>
			</tr>
			<tr>
			</tr>
			<tr>
				<td colspan="2">h) Would you recommend the trainer to others?</td>
				<td><input type="radio"  class="uncheck" name="qstn_h" id="h_yes" value="1" <?php echo  ($evaluation_data[0]['train_recommend']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_h" id="h_no" value="2" <?php echo  (isset($evaluation_data[0]['train_recommend']) &&$evaluation_data[0]['train_recommend']==2) ?  "checked='checked'": "''" ?>> No</td></tr>
			<tr>
				<td colspan="2">i) Did you find the training useful?</td>
				<td><input type="radio"  class="uncheck" name="qstn_i" id="i_yes" value="1" <?php echo  ($evaluation_data[0]['train_useful']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_i" id="i_no" value="2" <?php echo  (isset($evaluation_data[0]['train_useful']) &&$evaluation_data[0]['train_useful']==2) ?  "checked='checked'": "''" ?>> No</td>
			</tr>
			<tr class="info"><td colspan="4">3. WEB TOOL EVALUATION</td>
				
			</tr>
			<tr>
				<td colspan="4">a) Please rate your comfort level in using the system for daily management of commodities following the below actions. (Please select one each)
					</td>
				</tr>
			<tr>
				<td colspan="2">Action</td><td colspan="2">Comfort Level</td>
				</tr>
			<tr>
				<td colspan="2">1. Issue commodities to Service Points</td>
				<td colspan="2"><input type="radio"  class="uncheck" name="qstn_3aone" id="aone_comfortable" value="1" <?php echo  ($evaluation_data[0]['comf_issue']==1) ?  "checked='checked'": "''" ?>> Comfortable
				<input type="radio"  class="uncheck" name="qstn_3aone" id="aone_retrain" style="align:right" value="2" <?php echo  (isset($evaluation_data[0]['comf_issue']) &&$evaluation_data[0]['comf_issue']==2) ?  "checked='checked'": "''" ?>> Need re-training</td>
					</tr>
			<tr>
				<td colspan="2">2. Order Commodities</td>
				<td colspan="2"><input type="radio"  class="uncheck" name="qstn_3atwo" id="atwo_comfortable" value="1" <?php echo  ($evaluation_data[0]['comf_order']==1) ?  "checked='checked'": "''" ?>> Comfortable
				<input type="radio"  class="uncheck" name="qstn_3atwo" id="atwo_retrain" style="align:right" value="2" <?php echo  (isset($evaluation_data[0]['comf_order']) &&$evaluation_data[0]['comf_order']==2) ?  "checked='checked'": "''" ?>> Need re-training</td>
				</tr>
			<tr>
				<td colspan="2">3. Update Received Order Delivery</td>
				<td colspan="2"><input type="radio"  class="uncheck" name="qstn_3athree" id="athree_comfortable" value="1" <?php echo  ($evaluation_data[0]['comf_update']==1) ?  "checked='checked'": "''" ?>> Comfortable
				<input type="radio"  class="uncheck" name="qstn_3athree" id="athree_retrain" style="align:right" value="2" <?php echo  (isset($evaluation_data[0]['comf_update']) &&$evaluation_data[0]['comf_update']==2) ?  "checked='checked'": "''" ?>> Need re-training
				</td></tr>
			<tr>
				<td colspan="2">4. Generate Facility Reports</td>
				<td colspan="2"><input type="radio"  class="uncheck" name="qstn_3afour" id="afour_comfortable" value="1" <?php echo  ($evaluation_data[0]['comf_gen']==1) ?  "checked='checked'": "''" ?>> Comfortable
				<input type="radio" class="uncheck" name="qstn_3afour" id="afour_retrain" style="align:right" value="2" <?php echo  (isset($evaluation_data[0]['comf_gen']) &&$evaluation_data[0]['comf_gen']==2) ?  "checked='checked'": "''" ?>> Need re-training</td></tr>
			<tr>
				<td colspan="4">b) How frequently do you use the system in commodity management?</td>
				</tr>
			<tr>
		<?php switch ($evaluation_data[0]['use_freq']):
case 1:
echo <<<HTML_DATA
		    <td><input type="radio" checked="checked" name="qstn_3b" id="b_daily" value="1"> Daily</td>
		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_oneweek" value="2"> Once a week</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_twoweeks" value="3"> Once every 2 weeks</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_never" value="4"> Never</td>
HTML_DATA;
	
	break;
	
case 2:

echo <<<HTML_DATA
 		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_daily" value="1"> Daily</td>
		    <td><input type="radio" checked="checked" name="qstn_3b" id="b_oneweek" value="2"> Once a week</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_twoweeks" value="3"> Once every 2 weeks</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_never" value="4"> Never</td>
HTML_DATA;
	
	break;
	
case 3:
	
	echo <<<HTML_DATA
 		    <td><input type="radio" class="uncheck" name="qstn_3b" id="b_daily" value="1"> Daily</td>
		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_oneweek" value="2"> Once a week</td>
			<td><input type="radio" checked="checked" name="qstn_3b" id="b_twoweeks" value="3"> Once every 2 weeks</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_never" value="4"> Never</td>
HTML_DATA;
	break;
	
case 4:

echo <<<HTML_DATA
		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_daily" value="1"> Daily</td>
		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_oneweek" value="2"> Once a week</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_twoweeks" value="3"> Once every 2 weeks</td>
			<td><input type="radio" checked="checked" name="qstn_3b" id="b_never" value="4"> Never</td>
			
HTML_DATA;
	break;
		default:
	echo <<<HTML_DATA
		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_daily" value="1"> Daily</td>
		    <td><input type="radio"  class="uncheck" name="qstn_3b" id="b_oneweek" value="2"> Once a week</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_twoweeks" value="3"> Once every 2 weeks</td>
			<td><input type="radio"  class="uncheck" name="qstn_3b" id="b_never" value="4"> Never</td>
HTML_DATA;
	

			
endswitch; ?>				
				

			</tr>
			<tr>
				<td colspan="4">If Never, please specify why</td>
				</tr>
			<tr>
				<td colspan="4">
					
				<textarea style="width:95%; height:90%:border-box;​" id="threeb_specify" name="threeb_specify">
					<?php 
		   echo isset ($evaluation_data[0]['freq_spec']) ?  $evaluation_data[0]['freq_spec']: '' ?>
				</textarea>
				
				</td></tr><tr></tr>
			<tr>
				<td colspan="2">c) Does the web tool improve commodity management in your facility?</td>
				<td><input type="radio"  class="uncheck" name="qstn_3c" id="c3_yes" value="1" <?php echo  ($evaluation_data[0]['improvement']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_3c" id="c3_no" value="2" <?php echo  (isset($evaluation_data[0]['improvement']) &&$evaluation_data[0]['improvement']==2) ?  "checked='checked'": "''" ?>> No
				</td></tr>
			<tr>
				<td colspan="2">d) Is the tool easy to use and understand?</td>
				<td><input type="radio"  class="uncheck" name="qstn_3d" id="d3_yes" value="1" <?php echo  ($evaluation_data[0]['ease_of_use']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_3d" id="d3_no" value="2" <?php echo  (isset($evaluation_data[0]['ease_of_use']) &&$evaluation_data[0]['ease_of_use']==2) ?  "checked='checked'": "''" ?>> No</td></tr>
			<tr>
				<td colspan="2">e) Does it meet your expectations in commodity management?</td>
				<td><input type="radio"  class="uncheck" name="qstn_3e" id="e3_yes" value="1" <?php echo  ($evaluation_data[0]['meet_expect']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_3e" id="e3_no" value="2" <?php echo  (isset($evaluation_data[0]['meet_expect']) &&$evaluation_data[0]['meet_expect']==2) ?  "checked='checked'": "''" ?>> No</td>
			</tr>
			<tr>
				<td colspan="4">If no, please suggest how we can improve it to meet your needs and expectations</td>
				</tr>
			<tr>
				<td colspan="4">
					
					
				<textarea style="width:95%; height:90%:border-box;​" id="3e_specify" name="e3_specify"
	><?php 
		   echo isset ($evaluation_data[0]['expect_suggest']) ?  $evaluation_data[0]['expect_suggest']: '' ?></textarea>
				</td></tr>
			<tr>
				<td colspan="2">e) Would you be willing to re-train facility staff on the use and importance of the tool?</td>
				<td><input type="radio"  class="uncheck" name="qstn_3f" id="f3_yes" value="1" <?php echo  ($evaluation_data[0]['retrain']==1) ?  "checked='checked'": "''" ?>> Yes</td>
			<td><input type="radio"  class="uncheck" name="qstn_3f" id="f3_no" value="2" <?php echo  (isset($evaluation_data[0]['retrain']) &&$evaluation_data[0]['retrain']==2) ?  "checked='checked'": "''" ?>> No</td>
			</tr>
			<tr>
				<td>The above assessment was done by: <?php echo $username; ?></td>
				<td colspan="2"></td><td>Date: <?php echo date('d M, Y'); ?></td>
				</tr>
		</table>
	</form>
</div>
<input class="btn btn-primary" type="submit"   id="save1"  value="Save" style="margin-left: 0%; width=100px" >
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
                	/***********creating the request that will update the facility transaction ******/
                	if ($('#computer').is('checked')) {
					    $('#computer').val('1');
					} else {
					    $('#computer').val('0');
					}
					if ($('#modem').is('checked')) {
					    $('#modem').val('1');
					} else {
					    $('#modem').val('0');
					}
					if ($('#i_bundles').is('checked')) {
					    $('#i_bundles').val('1');
					} else {
					    $('#i_bundles').val('0');
					}
					if ($('#t_manuals').is('checked')) {
					    $('#t_manuals').val('1');
					} else {
					    $('#t_manuals').val('0');
					}
					if ($('#f_headno').val()=='') {
					    $('#f_headno').val('N/A');
					}
					if ($('#f_depheadno').val()=='') {
					    $('#f_depheadno').val('0');
					}
					if ($('#nurse_no').val()=='') {
					    $('#nurse_no').val('0');
					}
					if ($('#store_mgrno').val()=='') {
					    $('#store_mgrno').val('0');
					}
					if ($('#p_techno').val()=='') {
					    $('#p_techno').val('0');
					}
					if ($('#trainer').val()=='') {
					    $('#trainer').val('0');
					}
				var f_headno = $('#f_headno').val();
				var f_depheadno = $('#f_depheadno').val();
				var nurse_no = $('#nurse_no').val();
				var store_mgrno = $('#store_mgrno').val();
				var p_techno = $('#p_techno').val();
				var trainer = $('#trainer').val();
				var comp_avail = $('#computer').val();
			
				var modem_avail = $('#modem').val();
				var bundles_avail = $('#i_bundles').val();
				var manuals_avail = $('#t_manuals').val();
				var satisfaction_lvl = $('[name=qstn_b]:checked').val();
				var agreed_time = $('[name=qstn_c]:checked').val();
				var feedback = $('[name=qstn_d]:checked').val();
				var pharm_supervision = $('[name=qstn_ea]:checked').val();
				var coord_supervision =$('[name=qstn_eb]:checked').val();
				var req_id =$('[name=qstn_f]:checked').val();
				if ($('#f_specify').val()=='') {
					    $('#f_specify').val('N/A');
					}
				var req_spec = $('#f_specify').val();
				var req_addr = $('[name=qstn_f]:checked').val();
				if ($('#g_specify').val()=='') {
					    $('#g_specify').val('N/A');
					}
				var train_remarks = $('#g_specify').val();
				var train_recommend = $('[name=qstn_h]:checked').val();
				var train_useful = $('[name=qstn_i]:checked').val();
				var comf_issue = $('[name=qstn_3aone]:checked').val();
				var comf_order = $('[name=qstn_3atwo]:checked').val();
				var comf_update = $('[name=qstn_3athree]:checked').val();
				var comf_gen = $('[name=qstn_3afour]:checked').val();
				var use_freq = $('[name=qstn_3b]:checked').val();
				if ($('#threeb_specify').val()=='') {
					    $('#threeb_specify').val('N/A');
					}
				var freq_spec = $('#threeb_specify').val();
				var improvement = $('[name=qstn_3c]:checked').val();
				var ease_of_use = $('[name=qstn_3d]:checked').val();
				var meet_expect = $('[name=qstn_3e]:checked').val();
				if ($('#3e_specify').val()=='') {
					    $('#3e_specify').val('N/A');
					}
				var expect_suggest = $('#3e_specify').val();
				var retrain = $('[name=qstn_3f]:checked').val();
				
				data_array=f_headno+"|"+f_depheadno+"|"+nurse_no+"|"+store_mgrno+"|"+p_techno+"|"+trainer+"|"+comp_avail+"|"+modem_avail+"|"+bundles_avail+"|"+manuals_avail+"|"+satisfaction_lvl+"|"+agreed_time+"|"+feedback+"|"+pharm_supervision+"|"+coord_supervision+"|"+req_id+"|"+req_spec+"|"+req_addr+"|"+train_remarks+"|"+train_recommend+"|"+train_useful+"|"+comf_issue+"|"+comf_order+"|"+comf_update+"|"+comf_gen+"|"+use_freq+"|"+freq_spec+"|"+improvement+"|"+ease_of_use+"|"+meet_expect+"|"+expect_suggest+"|"+retrain;
				json_obj={"url":"<?php echo site_url("reports/save_facility_evaluation/");?>",}
				var baseUrl=json_obj.url;

			$.ajax({
			  type: "POST",
			  url: baseUrl,
			  data: "data_array="+data_array,
			  info: function(msg){

			
				
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
				
				console.log(msg);
				
				window.location="<?php echo site_url('reports/facility_evaluation_');?>/"+msg;	
				
			});
                	
                	$(this).dialog("close");
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
