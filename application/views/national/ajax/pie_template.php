<!--<script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>

<script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>-->
 <script>
    $(function () {

    $(document).ready(function () {
    	
    
        // Build the chart
        $('#pie').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Health Facilities Statistics'
            },
            colors: <?php echo $colors; ?>,
            plotOptions: {
                pie: {
                    allowPointSelect: true,
                    cursor: 'pointer',
                    dataLabels: {
                        enabled: true,
                        format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                    },
                    showInLegend: true
                }
            },
            credits: {
            enabled: false
        },
            series: [{
                type: 'pie',
                name: 'No of Facilities',
                data:  <?php echo $temp; ?>
                
                 
                
            }]
        });
    });

});
</script>
<!--<div id="pie"></div>__>


