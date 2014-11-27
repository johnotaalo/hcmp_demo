<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>				
				
				
				<script type="text/javascript" charset="utf-8">
			$(function() {
				
				/* Build the DataTable with third column using our custom sort functions */
				$('#example_allocation_distribution').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
		
			
			$('#example_allocation_distribution_1').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
				
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSStackedColumn2D.swf"?>","ChartId", "100%", "60%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/get_rtk_distribution_allocation/1"?>'; 
		chart.setDataURL(url);
		chart.render("chart_trk_allocation_distribution");
		

	
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSStackedColumn2D.swf"?>", "ChartId", "100%", "60%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/get_rtk_distribution_allocation/2"?>'; 
		chart.setDataURL(url);
		chart.render("chart_trk_allocation_distribution_1");
				
		
				
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
	<div class="multiple_chart_content" style="width:50%;" id="chart_trk_allocation_distribution"></div>
	<div class="multiple_chart_content" style="width:50%;" id="chart_trk_allocation_distribution_1"></div>
	</div>	
	<div class="chart_content" style="width:100%;">
		<div class="multiple_chart_content" style="width:50%;">
		<table  id="example_allocation_distribution" width="100%">
					<thead>
					<tr>
						<th><b>County</b></th>
						<th><b>Requested Quantities</b></th>
						<th><b>Distributed Quantities</b></th>
						<th><b>Allocated Quantities</b></th>

										    
					</tr>
					</thead>
					<tbody>		
						<?php echo $table_body; ?>
				</tbody>
				</table>
				</div>
				<div class="multiple_chart_content" style="width:50%;">
				<table id="example_allocation_distribution_1" width="100%">
					<thead>
					<tr>
						<th><b>County</b></th>
						<th><b>Requested Quantities</b></th>
						<th><b>Distributed Quantities</b></th>
						<th><b>Allocated Quantities</b></th>

										    
					</tr>
					</thead>
					<tbody>	
						<?php echo $table_body_1; ?>	
				</tbody>
				</table>
				<div>
				</div>