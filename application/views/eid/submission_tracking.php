
<div id="chartdiv_req" align="center">FusionGadgets</div>
<script type="text/javascript">
	if  ( FusionCharts( "myChartId" ) )  FusionCharts( "myChartId" ).dispose();	
	var myChart = new FusionCharts("<?php echo base_url() ?>assets/FusionWidgets/HLinearGauge.swf", "myChartId", "850", "350", "0", "0");
	myChart.setDataURL("<?php echo base_url();?>eid_management/submission_tracking");
	myChart.render("chartdiv_req");
</script>