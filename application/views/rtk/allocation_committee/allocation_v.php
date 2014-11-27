<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			.user2{
	width:70px;
	
	text-align: center;
	}
		</style>				
				<script type="text/javascript" charset="utf-8">
			
			$(function() {
var chart = new FusionCharts("http://localhost/HCMP/scripts/FusionCharts/StackedColumn3D.swf", "ChartId3", "100%", "65%", "0", "0");
		var url = 'http://localhost/HCMP/rtk_management/new_counties_alloc_chart'; 
		chart.setDataURL(url);
		chart.render("chart4");

	 

				/* Build the DataTable with third column using our custom sort functions */
 							
			} );
			
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
		<div id="dialog"></div> 
 
	<div class="multiple_chart_content" style="width:100%; height:100%;" id="chart4"></div>
 
	</div>
 