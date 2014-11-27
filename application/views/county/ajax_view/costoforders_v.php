<script type="text/javascript">
jQuery(document).ready(function() {
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId2", "100%", "85%", "0", "0");
		var url = '<?php echo base_url()."report_management/generate_costofordered_County_chart"?>'; 
		chart.setDataURL(url);
		chart.render("chart");
			});
</script>
			<div id="chart-area" style="width: 100%; height: 100%; margin-left: 0em;margin-top: 2px;">
	<div id="chart" style="width: 100%; height: 70%;" >
		
	</div>
</div>
      