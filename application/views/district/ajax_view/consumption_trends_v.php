<script type="text/javascript">
jQuery(document).ready(function() {
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSLine.swf"?>", "ChartId5", "85%", "75%", "0", "0");
		var url = '<?php echo base_url()."report_management/consumption_trends"?>'; 
		chart.setDataURL(url);
		chart.render("chart3");
		
				$( "#filter-b" )
			.button()
			.click(function() {
				
				
});
		
			});
</script>
<div id="filter" align="center">
		<fieldset>
	<label>Select Facility</label>
	<select id="facilities">
		<option>--facilities--</option>
		<?php 
		foreach ($facilities as $counties) {
			$id=$counties->id;
			$county=$counties->facility_name;?>
			<option value="<?php echo $id;?>"><?php echo $county;?></option>
		<?php }
		?>
	</select>	
	<input style="margin-left: 10px" type="button" id="filter-b" value="filter" />
	</fieldset>
	</div>
<div id="chart-area" style="width: 100%; height: 100%; margin-left:5em;">
	<div id="chart3" style="width: 100%; height: 100%;">
		
	</div>
</div>