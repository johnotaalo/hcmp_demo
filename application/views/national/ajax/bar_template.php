 <script>
   $(function () {
   	
    $('#<?php echo $graph_id; ?>').highcharts({
        chart: {
            type: '<?php echo $graph_type; ?>'
        },
        
        title: {
            text: '<?php echo $graph_title; ?>'
        },
        subtitle: {
            text: 'Source: HCMP'
        },
        xAxis: {
        	
            categories: <?php echo $category_data ;?>,
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: '<?php echo $graph_yaxis_title; ?>',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' '
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: false
                }
            }
        },
         colors: <?php echo $colors; ?>,
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: '<?php echo $legend ;?>',
            data: <?php echo $series_data ;?>,
        }]
    });
});
</script>
<div id="<?php echo $graph_id; ?>"></div>


