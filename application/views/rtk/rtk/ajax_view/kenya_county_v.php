<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
		<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
		
		
		
		
		
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
		
		
		var chart = new FusionMaps("<?php echo base_url()."scripts/FusionMaps/FCMap_KenyaCounty.swf"?>","ChartId", "100%", "100%", "0", "1" );
		var url = '<?php echo base_url()."rtk_management/kenya_county_map"?>'; 
		chart.setDataURL(url);
		chart.render("chart");
		

	
		/*var chart = new FusionCharts("<?php //echo base_url()."scripts/FusionCharts/Doughnut2D.swf"?>", //"ChartId", "100%", "50%", "0", "0");
		var url = '<?php //echo base_url()."rtk_management/facility_ownership_doghnut/country_wide"?>'; 
		//chart.setDataURL(url);
		//chart.render("chart1");
		
		//var chart = new FusionCharts("<?php //echo base_url()."scripts/FusionCharts/MSStackedColumn2D.swf "?>", //"ChartId", "100%", "50%", "0", "0");
		//var url = '<?php //echo base_url()."rtk_management/facility_ownership_combined_bar_chart"?>'; 
		//chart.setDataURL(url);
		//chart.render("chart2");*/
	
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
	<div class="chart_content" style="width:100%;height: 130%">
		
	<div class="multiple_chart_content" style="width:100%; height: 100%"  id="chart"></div>
	
	</div>
	<div class="chart_content" style="width:100%;" id="chart2"></div>
	
 
 