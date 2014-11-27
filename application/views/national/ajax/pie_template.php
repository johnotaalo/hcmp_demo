 <script>
    $(function () {

    $(document).ready(function () {
    	
    
        // Build the chart
        $('#facility_breakdown').highcharts({
            chart: {
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            title: {
                text: 'Health Facilities In Numbers'
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
                name: 'In Numbers',
                data: [ ['Public',   <?php echo $public ;?>], 
		                ['Private', <?php echo $private ;?>],
		                ['Faith-Based',  <?php echo $fbo ;?>], 
		                ['Others',    <?php echo $other;?>] 
                
                 ]
                
            }]
        });
    });

});
</script>


