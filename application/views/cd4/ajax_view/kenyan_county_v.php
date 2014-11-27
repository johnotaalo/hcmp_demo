<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
		<script type="text/javascript" charset="utf-8">
 
		var chart = new FusionMaps("<?php echo base_url()."scripts/FusionMaps/FCMap_KenyaCounty.swf"?>","ChartId", "100%", "100%", "0", "1" );
		var url = '<?php echo base_url()."cd4_management/cd4_allocation_kenyan_map"?>'; 
		chart.setDataURL(url);
		chart.render("chart");
 
	
			$( "#filter-b" )
			.button()
			.click(function() {
				
});	

	});
	</script>
  

 <div class="dash_main" id="dash_main">
<div id="test_a" style="overflow: scroll; height: 51em; min-height:100%; margin: 0; width: 100%">
		
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
	<div class="multiple_chart_content" style="width:100%; height: 100%;"  id="chart"></div>	
	</div>
 
	
 
 </div>
</div>