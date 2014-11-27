<?php
//echo"<pre>";print_r($stock_status);die;
include_once 'ago_time.php';

$reporting_percentage = $cumulative_result/$total_facilities*100;
$reporting_percentage = number_format($reporting_percentage, $decimals = 0);
$current_month = date('mY', time());     
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
#switch_back{    
    font-size: 11px;
    font-weight: bold;
    color: green;   
}
</style>
<script type="text/javascript">
  
$(document).ready(function(){

    $('#switch_month').change(function() {
            var value = $('#switch_month').val();
            var path_full = 'rtk_management/switch_month/'+value+'/rtk_manager/';
            var path = "<?php echo base_url(); ?>" + path_full;
//              alert (path);
            window.location.href = path;
        });
    var active_month = '<?php echo $active_month ?>';
    var current_month = '<?php echo $current_month ?>';   
    if(active_month!=current_month){
        $("#switch_back").show();
        $('#switch').show();
    }else{        
        $('#switch_back').hide();
        $('#switch_back').hide();
    }
     $('#switch_back').click(function() {
            var value = current_month;
            var path_full = 'rtk_management/switch_month/'+value+'/rtk_manager/';
            var path = "<?php echo base_url(); ?>" + path_full;
            window.location.href = path;
        });


   });
</script>
<?php include_once('admin_links');?>
<div class="tabbable">
    <div>Select Month <button id="switch_back" class="form-control" style="max-width: 220px;">Switch to Current Month</button>    </div>
    <?php
        $month = $this->session->userdata('Month');
        if ($month==''){
         $month = date('mY',time());
        }
        $year= substr($month, -4);
        $month= substr_replace($month,"", -4);
        $monthyear = $year . '-' . $month . '-1';        
        $englishdate = date('F, Y', strtotime('+1 month'));
        $englishdate = date('F, Y', strtotime($monthyear));
    ?>
     <select id="switch_month" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">
       <option>-- <?php echo $englishdate;?> --</option>
        <?php 


            for ($i=1; $i <=12 ; $i++) { 
            $month = date('m', strtotime("-$i month")); 
            $year = date('Y', strtotime("-$i month")); 
            $month_value = $month.$year;
            $month_text =  date('F', strtotime("-$i month")); 
            $month_text = "-- ".$month_text." ".$year." --";
         ?>
        <option value="<?php echo $month_value ?>"><?php echo $month_text ?></option>;
    <?php } ?>
    </select>    
        
    </div>
    <br/>
    <ul class="nav nav-tabs">
        <li class="active"><a href="#tab1" data-toggle="tab">Activity</a></li>
        <li><a href="#StockStatus" data-toggle="tab">Stock Status</a></li>
        <!--li><a href="#CountyProgess" data-toggle="tab">Counties Progress</a></li-->
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="tab1">
            <ul class="thumbnails">
                <li class="col-md-11">
                        
                    <div style="width:100%;height:450px;">
                        <div id="container" style="min-width: 310px;width:70%;height: 360px;float:left; margin: 0 auto;border: ridge 1px;"></div>
                        <div style="width:30%;font-size:11px;height: 360px;margin-left:10px ;float:left; margin: 0 auto;border: ridge 1px;overflow:scroll;background:rgba(204, 204, 204, 0.14);" class="span4" >
                            <ul class="unstyled">
                        <?php
                        foreach ($user_logs as $logs) {
                            $action_clause = '';
                            $action_clause = ($logs['action'] == 'ADDFDR') ? 'Added a Report' : $action_clause;
                            $action_clause = ($logs['action'] == 'UPDFDR') ? 'Edited a Report' : $action_clause;
                            $action_clause = ($logs['action'] == 'ACTFCL') ? 'Activated a Facility' : $action_clause;
                            $action_clause = ($logs['action'] == 'DCTFCL') ? 'Deactivated a Facility' : $action_clause;
                            $action_clause = ($logs['action'] == 'UPDFCL') ? 'Edited a Facility' : $action_clause;
                            $action_clause = ($logs['action'] == 'ADDUSR') ? 'Added  a User' : $action_clause;
                            $action_clause = ($logs['action'] == 'UPDUSR') ? 'Edited a User' : $action_clause;
                            $link = "";
                            $date = date('H:m:s d F, Y', $logs['timestamp']);
                            ?>
                            <li>
                                <?php
                                echo
                                '<a href="' . $link . '" title="' . $date . '">'
                                . $logs['fname'] . ' '
                                . $logs['lname'] . ' '
                                . '</a>'
                                . $action_clause . ' '
                                . '<a href="' . $link . '" title="' . $date . '">'
                                . timeAgo($logs['timestamp'])
                                . '</a>';
                                ?>
                            </li>
                            <?php } ?>
                        </ul>

                        </div>
                        <div style="margin-top:10px;">
                        Countrywide Progress: <?php echo $reporting_percentage; ?>%
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
            $("table").tablecloth({theme: "paper"});
            var table = $('#stock_table').dataTable({
                "sDom": "T lfrtip",
                "bPaginate": false,
                "oLanguage": {
                    "sLengthMenu": "_MENU_ Records per page",
                    "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                },
                "oTableTools": {
                    "aButtons": [
                    "copy",
                    "print",
                    {
                        "sExtends": "collection",
                        "sButtonText": 'Save',
                        "aButtons": ["csv", "xls", "pdf"]
                    }
                    ],
                    "sSwfPath": "../assets/datatable/media/swf/copy_csv_xls_pdf.swf"
                }
            });

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

<link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">
<script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>

<!--Datatables==========================  --> 
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="../assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="../assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="../assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="../assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->

<link href="../assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="../assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>