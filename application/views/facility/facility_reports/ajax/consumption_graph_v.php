<script>
		$(document).ready(function() {
	$(function () {
		
$('#graphcontainer').highcharts({ chart: { zoomType:'x', type: 'column' }, credits: { enabled:false}, title: {text: 'Facility Expired Commodities'}, yAxis: { min: 0, title: {text: 'Total Expired Commodities (values in packs)' }}, xAxis: { categories: ["Acyclovir Tablets 400mg "] }, tooltip: { crosshairs: [true,true] }, series: [{ name: 'Current Balance', data:[100]},] })
    });
    
	 });
	
</script>
<div id="graphcontainer" style="margin: 0 auto; height: 40em;"></div>

