<?php
//echo"<pre>";print_r($stock_status);die;

$reporting_percentage = $cumulative_result/$total_facilities*100;
if($reporting_percentage>100){
    $reporting_percentage = 100;
}
$reporting_percentage = number_format($reporting_percentage, $decimals = 0);
?>
<style type="text/css">
#inner_wrapper{font-size: 80%;}
.tab-pane{padding-left: 6px;}
#tab1 > ul > li > ul{font-size: 11px;}
#tab1 > ul > li.span4{background: rgba(204, 204, 204, 0.14);padding: 13px;border: solid 1px #ccc;color: #92A8B4; height: 300px;overflow-y: scroll;}
#chartdiv {width: 100%;height    : 500px;font-size : 11px;} 
#stock_table{width: 100%;}
table{
    font-size: 12px;
}
</style>
<div class="tabbable">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Activity</a></li>        
        <!--li><a href="#CountyProgess" data-toggle="tab">Counties Progress</a></li-->
    </ul>
      
     
                        
     
                   
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <ul class="thumbnails">
                <li class="col-md-11">
                     <?php include('rca_sidabar.php');?>
                    <div style="width:75%;height:450px;float:left;">
                      
                        <div id="container" style="min-width: 310px;width:100%;height: 360px;float:left; margin: 0 auto;border: ridge 1px;"></div>
                        
                        <div style="margin-top:10px;">
                        County Progress: <?php echo $reporting_percentage; ?>%
                        <div class="progress">
                            <div class="progress">
                              <div class="progress-bar" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $reporting_percentage; ?>%;">
                                <?php echo $reporting_percentage; ?>%
                            </div>
                        </div>

                    </div>
                </div>
                    </div>
                    
                  
                     
                      
                </li>
                
                </ul>

            

            </div>
            
            

               
            </div>
        </div>
        <script type="text/javascript">
        $(function() {
            

            $('#container').highcharts({
                chart: {
                    type: 'line'
                },
                title: {
                    text: 'Reporting Trends <?php echo $englishdate ?>'
                },
                subtitle: {
                    text: 'Live Data from reports'
                },
                xAxis: {
                    categories: <?php echo $jsony; ?>
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'F-CDRR Reports'
                    }
                },
                tooltip: {
                    headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                    pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                    '<td style="padding:0"><b>{point.y:.0f} Reports</b></td></tr>',
                    footerFormat: '</table>',
                    shared: true,
                    useHTML: true
                },
                plotOptions: {
                    column: {
                        pointPadding: 0.2,
                        borderWidth: 0
                    }
                },
                credits: false,
                series: [{
                    name: 'Culmulative Trend',
                    data: <?php echo $jsonx1; ?>
                },
                {
                    name: 'Trend',
                    data: <?php echo $jsonx; ?>
                }]
            });
});
</script>
<script type="text/javascript">
  
$(document).ready(function(){

    $('#switch_month').change(function() {
            var value = $('#switch_month').val();
            var path_full = 'rtk_management/switch_month/'+value+'/county_trend/';
            var path = "<?php echo base_url(); ?>" + path_full;
//              alert (path);
            window.location.href = path;
        });


   });
</script>

