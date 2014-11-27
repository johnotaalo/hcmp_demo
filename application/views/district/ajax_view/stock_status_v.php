<script type="text/javascript">
		<?php $time=time();   ?>
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>", "ChartId", <?php echo "'$width','$height,'"; ?>,"0", "0");
		var url = '<?php echo base_url()."report_management/get_stock_status/$option/$facility_code/$year_selection"?>'; 
		chart.setXMLUrl(url);
		chart.render("<?php echo $time.$option; ?>");

	</script>
<div id="chart-area" style="width: 100%; height: 100%">
	<div id="<?php echo  $time.$option; ?>" style="width: 100%; height: 100%;">
		
	</div>
</div>

