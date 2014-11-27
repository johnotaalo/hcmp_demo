<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
		<style>

			.warning2 {
	background: #FEFFC8 url('<?php echo base_url()?>Images/excel-icon.jpg') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	}
		</style>

		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
				/* Build the DataTable with third column using our custom sort functions */
				$('#example_main').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false
				} );
	
		
		
		
		
						$(".ajax_call_1").click(function(){
							var id  = $(this).attr("id"); 
							
							if(id=="county_facility"){
								
  	                         var url= $(this).attr("name"); 
  	
  	                     ajax_request_special (url);
  	                  return;
                        }
	
	});
		function ajax_request_special (url){
	var url =url;
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $("#pop_up").html("");
          },
          success: function(msg) {
  
        	
        	$('#dialog').html(msg);
         $( "#dialog" ).dialog({
			height: 650,
			width:900,
			modal: true
		});
          }
        }); 
}
		
		
		 var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId", "100%", "70%", "0", "0");
    var url = '<?php echo base_url()."report_management/orders_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart");

      var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId", "100%", "70%", "0", "0");
    var url = '<?php echo base_url()."report_management/cost_of_ordered_commodities_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart1");
		
	
	
			$( "#filter-b" )
			.button()
			.click(function() {
				
});	

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
		<div id="dialog"></div> 
	<div class="multiple_chart_content" style="width:50%;" id="chart"></div>
	<div class="multiple_chart_content" style="width:50%;" id="chart1"></div>
	</div>
	<div class="chart_content" style="width:100%;" id="chart2"></div>
	
						<table  style="margin-left: 0;" id="example_main" width="100%">
					<thead>
					<tr>
						<th><b>District</b></th>
						<th><b>No. of Facilities</b></th>
						<th><b>No of Orders to Date</b></th>
						<th><b>No of Orders Placed This Quarter</b></th>
						<th><b>No of Orders Pending Delivery This Quarter</b></th>
						<th><b>Orders Value</b></th>
						<th><b>Action</b></th>
													    
					</tr>

					</thead>
					<tbody>
		<?php echo $table_body; ?>
							
				</tbody>
						
						
				</table>
 
 