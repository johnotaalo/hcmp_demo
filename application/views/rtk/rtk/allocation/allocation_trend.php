 <style type="text/css">
 #trend-chart{
  min-height: 500px;
  height: auto;
  border: 1px solid green;
  width: 96%;
  margin-top: 2%;
  float: left;
  margin-left: 0px;
 }
 </style>



<?php include('allocation_links.php');?>
<div class="row" style="width:100%; margin-top:2%;margin-left:2%;">
  <div id="trend-chart">
    
  </div>
</div>

<script type="text/javascript">
  $('#trend_tab').addClass('active_tab');    
  $('#stocks_tab').removeClass('active_tab');  
  $('#allocations_tab').removeClass('active_tab');
</script>
      <script type="text/javascript">
        $(function() {            

            $('#trend-chart').highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'RTKs Reporting Rate from <?php echo $first_month; ?> to <?php echo $last_month; ?>',
                    x: -20 //center
                },
                subtitle: {
                    text: 'Live Data From RTK System',
                    x: -20
                },
                xAxis: {
                    categories: <?php echo $months_texts; ?>
                },
                  yAxis: {
                      title: {
                          text: 'Reports Submission (%)'
                      },
                      plotLines: [{
                          value: 0,
                          width: 1,
                          color: '#009933'
                      }]
                  },
                  tooltip: {
                      valueSuffix: '%'
                  },
                  legend: {
                      layout: 'horizontal',
                      align: 'right',
                      verticalAlign: 'middle',
                      borderWidth: 0
                  },
                  plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'middle',
                    borderWidth: 0
                },
                credits: false,
                series: [{
                    color: '#009933',
                    name: 'Reporting Rates',
                    data: <?php echo $percentages; ?>
                }]
            });
   
});
</script>
