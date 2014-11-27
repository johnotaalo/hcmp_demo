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
		
		
		var chart = new FusionMaps("<?php echo base_url()."scripts/FusionMaps/FCMap_KenyaCounty.swf"?>","ChartId", "100%", "50%", "0", "1" );
		var url = '<?php echo base_url()."cd4_management/map_chart"?>'; 
		chart.setDataURL(url);
		chart.render("chart");

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
	<div class="chart_content" style="width:100%;height: 100%">
		
	<div class="multiple_chart_content" style="width:100%; height: 100%"  id="chart"></div>
	
	</div>
	 
	
 
 