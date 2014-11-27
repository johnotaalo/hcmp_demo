 <script>
   $(function () {
    $('#roll_out').highcharts({
        chart: {
            type: 'pie',
            options3d: {
                enabled: true,
                alpha: 45
            }
        },
        title: {
            text: 'Roll Out Summary'
        },
        subtitle: {
            text: 'Source:HCMP'
        },
        plotOptions: {
            pie: {
                innerSize: 65,
                depth: 50
            }
        },
        series: [{
            name: 'Roll Out',
            data: [
                
                ['Using HCMP', <?php echo $using ;?>],
                ['Targeted', <?php echo $targetted ;?>]
               
            ]
        }]
    });
});
</script>


