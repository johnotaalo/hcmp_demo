<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
		<script type="text/javascript" charset="utf-8">
 	$(document).ready(function() {
		var chart = new FusionMaps("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "100%", "0", "1" );
		var url = '<?php echo base_url()."analyses_management/drh"?>'; 
		chart.setDataURL(url);
		chart.render("chart1");
 
	});
	</script>
 
		
	<style>
	.chart_content{
		margin:0 auto;
		margin-left: 0px;
	}
	.multiple_chart_content{
		float:left; 
	}
</style>
	<div class="chart_content" style="width:100%;">
	<div class="multiple_chart_content" style="width:100%; height: 100%;" id="chart1"></div>	
	</div>
