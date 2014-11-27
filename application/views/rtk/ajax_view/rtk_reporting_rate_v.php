<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>	
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>		
				<script type="text/javascript" charset="utf-8">

			$(function() {				
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "40%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/get_reporting_rate_national_bar/national"?>'; 
		chart.setDataURL(url);
		chart.render("chart_rtk_reporting_county");

		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Doughnut2D.swf"?>", "ChartId", "100%", "40%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/get_reporting_rate_national_doghnut/national"?>'; 
		chart.setDataURL(url);
		chart.render("chart_rtk_reporting_county_1");
		
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSStackedColumn2D.swf "?>", "ChartId", "100%", "50%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/facility_reporting_combined_bar_chart"?>'; 
		chart.setDataURL(url);
		chart.render("chart2");
		
		
				
					$('#example_reporting_county').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
				
				
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
	<div class="multiple_chart_content" style="width:50%;" id="chart_rtk_reporting_county"></div>
	<div class="multiple_chart_content" style="width:50%;" id="chart_rtk_reporting_county_1"></div>
	</div>	
	
	<div class="chart_content" style="width:100%;" id="chart2"></div>
		<table  id="example_reporting_county" width="100%">
					<thead>
					<tr>
						<th><b>County Name</b></th>
						<th><b>No. Facilities</b></th>
						<th><b>No. of Facilities reporting</b></th>
										    
					</tr>
					</thead>
					<tbody>
		      <?php echo $table_body; ?>							
				</tbody>
				</table>