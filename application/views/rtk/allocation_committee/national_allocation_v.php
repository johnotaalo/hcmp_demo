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
 
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "100%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/national_allocation_chart"?>'; 
		chart.setDataURL(url);
		chart.render("chart5");

	 

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
 
	<div class="multiple_chart_content" style="width:100%; height:100%;" id="chart5"></div>
 
	</div>
 