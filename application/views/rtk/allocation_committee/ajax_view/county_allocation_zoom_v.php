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
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "70%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/facility_ownership_bar_chart/$bar_chart/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart");

		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Doughnut2D.swf"?>", "ChartId", "100%", "70%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/facility_ownership_doghnut/$doghnut/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart1");
		
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "70%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/get_reporting_rate_national_bar/$bar_chart/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart2");

		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Doughnut2D.swf"?>", "ChartId", "100%", "100%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/get_reporting_rate_national_doghnut/$doghnut/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart3");
		
		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/Charts/HLinearGauge.swf"?>", "ChartId", "100%", "15%", "0", "0");
		var url = '<?php echo base_url()."rtk_management/get_allocation_rate_national_hlineargauge/$doghnut/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart4");

		var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "100%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/rapid_kit_county_allocation/$county_id"?>'; 
		chart.setDataURL(url);
		chart.render("chart5");

	 

				/* Build the DataTable with third column using our custom sort functions */
				$('#example').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false} );
					
					
					$( "#allocate" )
			.button()
			.click(function() {
				  $('#myform').submit();
				
});	
								
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
	<div class="multiple_chart_content" style="width:24%;" id="chart"></div>
	<div class="multiple_chart_content" style="width:24%;" id="chart1"></div>
	<div class="multiple_chart_content" style="width:24%;" id="chart2"></div>
	<div class="multiple_chart_content" style="width:28%;" id="chart3"></div>
	</div>
	<div id="notification">Allocation Rate: <?php echo $county_name; ?></div>
	<div class="chart_content" style="width:100%; height: 20%;">
	<div class="multiple_chart_content" style="width:50%; height:70%;" id="chart4"></div>
	<div class="multiple_chart_content" style="width:50%;" id="chart5"></div>
	
	</div>
<?php $attributes = array( 'name' => 'myform', 'id'=>'myform');
	 echo form_open('rtk_management/rtk_allocation_form_data/'.$county_id,$attributes); ?>
		<table id="example" width="100%">
					<thead>
					<tr>
						<th><b>MFL</b></th>
						<th><b>Facility Name</b></th>
						<th><b>Owner</b></th>
						<th><b>Commodity</b></th>
						<th><b>Quantity Received</b></th>
						<th><b>Quantity Consumed</b></th>
						<th><b>End balance</b></th>
						<th><b>Quantity Requested</b></th>
						<th><b>Quantity Allocated</b></th>
						<th><b>Quantity Issued(From KEMSA)</b></th>
											    
					</tr>
					</thead>
					<tbody>
		<?php 
			echo $table_body;
			
		 ?>
							
				</tbody>
				</table>
				<input  class="button" id="allocate"  value="Allocate" >
		<?php  echo form_close();
		?>		