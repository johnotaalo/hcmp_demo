<div class="filter">
<h5>
<select name="year" id="year_filter" style="width: 7.8em;">
		<option value="NULL">Select Year</option>
		<option value="2014">2014</option>
		<option value="2013">2013</option>
</select>
<select name="month" id="month_filter" >
			<option value="NULL" selected="selected">Select month</option>
			<option value="01">Jan</option>
			<option value="02">Feb</option>
			<option value="03">Mar</option>
			<option value="04">Apr</option>
			<option value="05">May</option>
			<option value="06">Jun</option>
			<option value="07">Jul</option>
			<option value="08">Aug</option>
			<option value="09">Sep</option>
			<option value="10">Oct</option>
			<option value="11">Nov</option>
			<option value="12">Dec</option>
</select>
<select name="plot_value" id="plot_value_filter">
<option value="NULL" selected="selected">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<option value="ksh">KSH</option>

</select>
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	
</h5>
</div>

<div class='graph-section' id='graph-section'></div>
	
</div>
<script>
	$(document).ready(function() 
	{
	
			$("#filter").click(function() 
			{
				<?php $facility_code = $this -> session -> userdata('facility_id')?>
				var url = "reports/filter_facility_orders/<?php echo $facility_code?>"+
				        "/"+$("#year_filter").val()+
				        "/"+$("#month_filter").val()+
				        "/"+$("#plot_value_filter").val();

				 ajax_request_replace_div_content(url,'.graph-section');
				
          });

	
  });
</script>