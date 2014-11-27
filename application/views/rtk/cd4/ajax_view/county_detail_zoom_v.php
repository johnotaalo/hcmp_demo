<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
		<style>

			.warning2 {
	background: #FEFFC8 url('<?php echo base_url()?>Images/excel-icon.jpg') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	}
		</style>

		<script type="text/javascript" charset="utf-8">
					

$(document).ready(function() {

$( "#counties" ).change(function() {
//	var value = $("#county").selected.val();
	var value  = $('#counties').attr("value");
//	alert(value);

	var url = '<?php echo base_url();?>cd4_management/loaddistricts/'

	$.ajax({
			  type: "POST",
			  url: url+value,
			  success: function(msg){	


					$('#dist').html(msg);
					
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			})
});	

$('#dist').change(function(){

//	var value = $("#county").selected.val();
	var value  = $('#dist').attr("value");
//	alert(value);

	var url = '<?php echo base_url();?>cd4_management/loadfacilities/'

	$.ajax({
			  type: "POST",
			  url: url+value,
			  success: function(msg){	


					$('#facil').html(msg);
					
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			})
});

$('#facil').change(function(){

//	var value = $("#county").selected.val();
	var value  = $('#facil').attr("value");
//	alert(value);

	var url = '<?php echo base_url();?>cd4_management/loaddevices/'

	$.ajax({
			  type: "POST",
			  url: url+value,
			  success: function(msg){	


					$('#devices').html(msg);
					
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			})
});

	});
 

	</script>
	<style>
	#devices{margin: 20px;}
	#select-menu{
	position: relative; background: #FAFAFA; width: 95%; -webkit-box-shadow: 0 0px 1px 0px #000; padding: 12px; margin-top: 0px; z-index: 1;margin-left: 22px;	
	}

</style>


<div id="select-menu">	

Select County:	
<select id="counties" name="county">
<option>--Select County--</option>
<?php foreach ($counties as $countynames) {
echo '<option value="'.$countynames.'">'.$countynames.'</option>';	
} ?></select>
Select District:	
<select id="dist">
 <option>-------------------------</option>
</select>
Select Facility:	
<select id="facil">
 <option>-------------------------</option>
</select>
</div>

<div id="devices">

<fieldset style="
    position: absolute;
    margin-top: 112px;
    font-size: 2em;
    border: solid 1px #DDE2BB;
    padding: 79px;
    color: rgb(221, 154, 154);
    background: snow;
    /* margin-left: 80px; */
"> <h1>Select Facility to allocate</h1></fieldset>
</div>

 

 <fieldset style="font-size: 14px;background: #FCF8F8;padding: 10px;">
<span><b>DEVICE :</b> BD FACS CALIBUR</span><br />
<span><b>FACILITY :</b> ['=facility selected']</span><br />
<span><b>MFL : 11290</b></span><br />
<span><b>OWNER: GOK</b></span><br />
</fieldset>

				<table  style="margin-left: 0;" id="example_main" width="100%" class="data-table">
				<thead>
				<th>&nbsp; </th>
				<th>Quantity Received(3 months av)</th>
				<th>Quantity Consumed</th>
				<th>End Balance(June)</th>
				<th>Requested</th>
				<th>Allocated</th>
			 
					</thead>
					<tr>
						<td>Reagent 1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 2</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 3</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 4</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tbody>
			<?php 
			//foreach($facility as $facility_detail){
			//echo "<tr><td><a class='ajax_call_1' id='county_facility' name='".base_url()."cd4_management/get_cd4_facility_detail/$facility_detail[facility_code]' href='#'>$facility_detail[facility_code]</a></td><td>$facility_detail[facility_name]</td><td>$facility_detail[facility_owner]</td>";
			//} ?>
			 
			</tbody>
			</table>
<!--			 <input type="submit" value="allocate" />-->
			 <input class="button ui-button ui-widget ui-state-default ui-corner-all" id="allocate" value="Allocate" role="button" aria-disabled="false">

			 <fieldset style="font-size: 14px;background: #FCF8F8;padding: 10px;">
<span><b>DEVICE :</b> BD FACS CALIBUR</span><br />
<span><b>FACILITY :</b> ['=facility selected']</span><br />
<span><b>MFL : 11290</b></span><br />
<span><b>OWNER: GOK</b></span><br />
</fieldset>

				<table  style="margin-left: 0;" id="example_main" width="100%" class="data-table">
				<thead>
				<th>&nbsp; </th>
				<th>Quantity Received(3 months av)</th>
				<th>Quantity Consumed</th>
				<th>End Balance(June)</th>
				<th>Requested</th>
				<th>Allocated</th>
			 
					</thead>
					<tr>
						<td>Reagent 1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 2</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 3</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 4</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tbody>
			<?php 
			//foreach($facility as $facility_detail){
			//echo "<tr><td><a class='ajax_call_1' id='county_facility' name='".base_url()."cd4_management/get_cd4_facility_detail/$facility_detail[facility_code]' href='#'>$facility_detail[facility_code]</a></td><td>$facility_detail[facility_name]</td><td>$facility_detail[facility_owner]</td>";
			//} ?>
			 
			</tbody>
			</table>
<!--			 <input type="submit" value="allocate" />-->
			 <input class="button ui-button ui-widget ui-state-default ui-corner-all" id="allocate" value="Allocate" role="button" aria-disabled="false">


<fieldset style="font-size: 14px;background: #FCF8F8;padding: 10px;">
<span><b>DEVICE :</b> BD FACS Count</span><br />
<span><b>FACILITY :</b> ['=facility selected']</span><br />
<span><b>MFL : 11290</b></span><br />
<span><b>OWNER: GOK</b></span><br />
</fieldset>
<form>
				<table  style="margin-left: 0;" id="example_main" width="100%" class="data-table">
				<thead>
				<th>&nbsp; </th>
				<th>Quantity Received(3 months av)</th>
				<th>Quantity Consumed</th>
				<th>End Balance(June)</th>
				<th>Requested</th>
				<th>Allocated</th>
			 
					</thead>
					<tr>
						<td>Reagent 1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 2</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 3</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tr>
						<td>Reagent 4</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td>1</td>
						<td><input type="text"/></td>
					</tr>
					<tbody>
			<?php 
			//foreach($facility as $facility_detail){
			//echo "<tr><td><a class='ajax_call_1' id='county_facility' name='".base_url()."cd4_management/get_cd4_facility_detail/$facility_detail[facility_code]' href='#'>$facility_detail[facility_code]</a></td><td>$facility_detail[facility_name]</td><td>$facility_detail[facility_owner]</td>";
			//} ?>
			 
			</tbody>
			</table>
<!--			 <input type="submit" value="allocate" />-->
			 <input class="button ui-button ui-widget ui-state-default ui-corner-all" id="allocate" value="Allocate" role="button" aria-disabled="false">

</form>