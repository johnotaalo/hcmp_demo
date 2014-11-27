<?php
//echo"<pre>";print_r($stock_status);die;
include_once 'ago_time.php';

$reporting_percentage = $cumulative_result/$total_facilities*100;
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
<script type="text/javascript">
  
// $(document).ready(function(){

//     $('#switch_month').change(function() {
//             var value = $('#switch_month').val();
//             var path_full = 'rtk_management/switch_month/'+value+'/rtk_manager/';
//             var path = "<?php echo base_url(); ?>" + path_full;
// //              alert (path);
//             window.location.href = path;
//         });


//    });
</script>
<div class="tabbable">
   <!--  <div>Select Month
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
        
    </div>    -->
        
    <div class="tab-pane" id="StockStatus">
        <table id="stock_table">
            <thead>
                <th>County</th>
                <th>Commodity</th>
                <th>Beginning Balance</th>
                <th>Received Qty</th>
                <th>Used Qty</th>
                <th>Tests Done</th>
                <th>Closing Balance</th>
                <th>Requested Qty</th>
                <th>Out of Stock days</th>
                <th>Expiring Qty</th>
                <th>Allocated Qty</th>
            </thead>
            <tbody>
                <?php 
                $count = count($stock_status);
                for ($i=0; $i<$count; $i++){
                    foreach ($stock_status[$i] as $key => $value) { ?>
                    <tr>
                        <td><?php echo $value['county']; ?></td>
                        <td><?php echo $value['commodity_name']; ?></td>
                        <td><?php echo $value['sum_opening']; ?></td>
                        <td><?php echo $value['sum_received']; ?></td>
                        <td><?php echo $value['sum_used']; ?></td>
                        <td><?php echo $value['sum_tests']; ?></td>
                        <td><?php echo $value['sum_closing_bal']; ?></td>
                        <td><?php echo $value['sum_requested']; ?></td>
                        <td><?php echo $value['sum_days']; ?></td>
                        <td><?php echo $value['sum_expiring']; ?></td>
                        <td><?php echo $value['sum_allocated']; ?></td>
                    </tr>
                    <?php } }?>
                </tbody>
            </table>
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