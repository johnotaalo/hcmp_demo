<script>
	$(function() {
	var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>", "ChartId2", <?php echo "'$width','$height,'"; ?> "0", "1");
    var url = '<?php echo base_url()."report_management/get_stock_status/ajax-request_county"?>'; 
    chart.setDataURL(url);
    chart.render("chart3");
	});
	</script>

	<div id="chart_3" style="width: 100%; height: 100%;">
		
	</div>


