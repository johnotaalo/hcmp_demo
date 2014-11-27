    <div id="graphs">
        <script src="http://code.highcharts.com/highcharts.js"></script>
<script src="http://code.highcharts.com/modules/exporting.js"></script>
<script type="text/javascript">
    
    $(function () {
        $('#container').highcharts({
            chart: {
                type: 'bar'
            },
            title: {
                text: 'Nakuru County Reporting Rates'
            },subtitle: {
                text: 'Live data reports on RTK'
            },
            xAxis: {
                categories: ['Gilgil', 'Kuresoi', 'Molo', 'Naivasha', 'Nakuru']
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Percentage Complete (%)'
                }
            },
            legend: {
                backgroundColor: '#FFFFFF',
                reversed: true
            },
            plotOptions: {
                series: {
                    stacking: 'normal'
                }
            },
                series: [{
                name: 'Not reported',
                data: [5, 3, 4, 7, 2]
            }, {
                name: 'Reported',
                data: [4, 6, 5, 2, 7]
            }]
        });
    });
    


    

    </script>

<div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>
