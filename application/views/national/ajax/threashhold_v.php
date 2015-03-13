 <script>
   $(function () {
   	
    $('#<?php echo $graph_id; ?>').highcharts({
        
        chart: {
            type: '<?php echo $graph_type; ?>'
        },
        title: {
            text: '<?php echo $graph_title; ?>'
        },
        xAxis: {
            categories: <?php echo $category_data ;?>,
            labels: {
                rotation: -60,
                style: {
                    fontSize: '8px',
                    fontFamily: 'Verdana, sans-serif'
                }
            }
            
        },
        yAxis: [{
            min: 0,
            title: {
                text: '<?php echo $graph_yaxis_title; ?>'
            }
        }],
        legend: {
            shadow: false
        },
        tooltip: {
            shared: true
        },
        plotOptions: {
            column: {
                grouping: false,
                shadow: false,
                borderWidth: 0
            }
        },credits: {
            enabled: false
        },
        series: [{
            name: 'AMC',
            color: '#F7D358',
            data: <?php echo $series_data2 ;?>,
            pointPadding: 0.1,
            pointPlacement: -0.2
        }, {
            name: 'M.O.S',
            color: 'rgba(186,60,61,.9)',
            data: <?php echo $series_data ;?>,
            pointPadding: 0.4,
            pointPlacement: -0.2
        }]
    });
});
</script>
<div style="width: 600px;" id="<?php echo $graph_id; ?>"></div>


