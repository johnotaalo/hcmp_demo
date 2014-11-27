<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>				
				<script type="text/javascript" charset="utf-8">
			/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
			
			$(function() {
				
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "40%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/facility_ownership_bar_chart/$doghnut/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart_trk_county");
		

	
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Doughnut2D.swf"?>", "ChartId", "100%", "40%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/facility_ownership_doghnut/$bar_chart/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart_trk_county_1");
				
		
				/* Build the DataTable with third column using our custom sort functions */
				$('#example').dataTable( {
					"bJQueryUI": true,
					
					"aaSorting": [ [0,'asc'], [1,'asc'] ],
					"aoColumnDefs": [
						{ "sType": 'string-case', "aTargets": [ 2 ] }
					]
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
	<div class="multiple_chart_content" style="width:50%;" id="chart_trk_county"></div>
	<div class="multiple_chart_content" style="width:50%;" id="chart_trk_county_1"></div>
	</div>	
		<table  style="margin-left: 0;" id="example" width="100%">
					<thead>
					<tr>
						<th><b>MFL</b></th>
						<th><b>Facility Name</b></th>
						<th><b>Owner</b></th>

										    
					</tr>
					</thead>
					<tbody>
		<?php foreach($facility as $facility_detail){
			echo "<tr><td>$facility_detail[facility_code]</td><td>$facility_detail[facility_name]</td><td>$facility_detail[facility_owner]</td>";
			
		} ?>
							
				</tbody>