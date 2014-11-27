<script>

		$(document).ready(function() {
	$(function () {
		
        $('#graphcontainer').highcharts({
            chart: {
                type: 'line',
                marginRight: 130,
                marginBottom: 25
            },
            title: {
                text: 'Commodity Consumption for <?php echo $facilityname ?> ',
                x: -20 //center
            },
            subtitle: {
                text: 'Source: HCMP',
                x: -20
            },
            xAxis: {
                categories: <?php echo $montharray ?> 
            },
            yAxis: {
                title: {
                    text: 'Consumption in (<?php echo $plot_value_filter ?>)'
                },
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },credits: {
		enabled: false
		},
           
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -10,
                y: 100,
                borderWidth: 0
            },
            series: [{
                name: <?php echo $plot_value_filter ?>,
                data: <?php echo $arrayto_graph ?>
            }]
        });
    });
    
	 });
	
</script>


<div id="graphcontainer" style="margin: 0 auto; height: 40em;"></div>

