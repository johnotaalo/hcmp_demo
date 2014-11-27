<?php

$url_swf=base_url()."scripts/FusionCharts/Line.swf";
$url_data=base_url()."report_management/get_stock_out_trends/".$county."/".$year;

echo <<<HTMLCHART
	<script type="text/javascript">
jQuery(document).ready(function() {
		var chart = new FusionCharts("$url_swf", "ChartId1", "90%", "100%", "0", "0");
		var url = '$url_data'; 
		chart.setDataURL(url);
		chart.render("chart_stock_out");

			});
			
</script>
	<div id="chart-area" style="width: 100%; height: 100%;">
	<div id="chart_stock_out" style="width: 100%; height: 100%;" >
		
	</div>
HTMLCHART;




?>