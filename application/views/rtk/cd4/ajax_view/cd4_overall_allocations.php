<!--W
<script type="text/javascript" src="http://tablesorter.com/jquery-latest.js"></script> 
<script type="text/javascript" src="http://tablesorter.com/__jquery.tablesorter.min.js"></script>
<link rel="stylesheet" href="http://tablesorter.com/themes/blue/style.css" type="text/css" media="print, projection, screen" />
-->

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">

    @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
</style>
<script type="text/javascript" charset="utf-8">
    $(document).ready(function() {
        $('#example').dataTable({
            "aaSorting": [[2, "desc"]],
            "bStateSave": true
        });
    });
</script>

<style type="text/css" title="">

    #allocated{
        background: #D1F8D5;
    }
    .user2{
        width:70px;
        text-align: center;
    }
    #allocated{
        background: #D1F8D5;
    }

    .allocation-months-list{
        list-style: none;
        font-size: 9px;
        font-family: verdana;

    }
    .allocation-months-list a{
    }
    .allocation-months-list a:active{
        border-left: solid 4px rgb(71, 224, 71);
        background: #EEF1DF;
    }
    .allocation-months-list li{
        border-left: solid 4px darkgreen;
        padding-left: 7px;
        margin-bottom: 1px
    }
    .allocation-months-list li:hover{
        background: #EEF1DF;
    }
    #notif{

        width: 80%;float: right;
        font-size: 20px;
        color: #82DA71;
        background: #F7F5C8;
        padding-left: 9px;
        /* padding-right: 9px; */
        position: relative;
        padding-top: 7px;
        border: solid 1px #C5C5C5;
        height: 26px;
        margin-top: 3px;
        display:none;

    }
    #notif2{

        font-size: 20px;
        color: #82DA71;
        background: #F7F5C8;
        padding-left: 9px;
        /* padding-right: 9px; */
        position: relative;
        float: left;
        padding-top: 7px;
        width: 100%;
        border: solid 1px #C5C5C5;
        height: 26px;
        margin-top: 3px;



    }
</style>
<script type="text/javascript" charset="utf-8">
    function loadmonth(period) {
        $.ajax({
            type: "POST",
            url: 'loadmonth_alloc/' + period,
            success: function(result) {
                $(".dash_main").html(result);
            }
        });
    }
    function download(period){
        var pdfhtm = $('#table-area').html();

            $.ajax({
            type: "POST",
            data: pdfhtm,
            url: 'print_pdf/period',
            success: function(result) {
                $(".dash_main").html(result);
            }
        });

    }
    function send_mail(period) {
        url = 'send_mail';
        $.ajax({
            type: "POST",
            url: 'send_mail/' + period,
            success: function(result) {
                $("#notif").html(result);
                $("#notif").fadeIn(400);
                $("#notif").delay(4000).slideUp(400);
            }
        });
    }
</script>

<div style="float:left;bacground:#fff;">
    <h2>2013</h2>
    <ul class="allocation-months-list">
        <li><a href="#Oct" class="allocate" onclick="loadmonth(102013)">Oct</a></li>
        <li><a href="#Nov" class="allocate" onclick="loadmonth(112013)">Nov</a></li>
        <li><a href="#Dec" class="allocate" onclick="loadmonth(112013)">Dec</a></li>
    </ul>
    <h2>2014</h2>	
    <ul class="allocation-months-list">

        <li><a href="#Jan" class="allocate" onclick="loadmonth(12014)">Jan</a></li>
        <li><a href="#Feb" class="allocate" onclick="loadmonth(22014)">Feb</a></li>
        <li><a href="#Mar" class="allocate" onclick="loadmonth(32014)">March</a></li>
        <li><a href="#Apr" class="allocate" onclick="loadmonth(42014)">April</a></li>
        <li><a href="#May" class="allocate" onclick="loadmonth(52014)">May</a></li>
        
    </ul>

</div><span id="notif" style=""> </span>
<div class="dash_main" style="width: 80%;float: right;">
    <?php if (isset($_GET['allocationsuccess'])) { ?>
        <span id="notif2" style="">Allocation Succesful</span>
    <?php } ?>

    <h1>CD4 Allocations (Cumulative)</h1>
    <hr />
    <table id="example" class="data-tables" style="width: 100%;">
        <thead style="background:#fff; font-size: 12px; font-family: sans-serif; text-align: left;">
        <th>MFLCode</th>
        <th>Facility</th>
        <th>Reagent</th>
        <th>Quantity</th>
        <th>Allocation For</th>
        </thead>  <tbody>

            <?php
            foreach ($allocations as $key => $allocations_details) {
                date_default_timezone_set('EUROPE/Moscow');
                $alloc_period = $allocations_details['allocation_for'];
                $year = substr($alloc_period, -4);
                $month = substr_replace($alloc_period, "", -4);
                $monthyear = $year . '-' . $month . '-1';
                $date = date('F, Y', strtotime($monthyear));
                $sl = '<tr>
<td>' . $allocations_details['facilityname'] . '</td>
<td>' . $allocations_details['MFLCode'] . '</td>
<td>' . $allocations_details['reagentname'] . '</td>
<td>' . $allocations_details['qty'] . '</td>
<td>' . $date . '</td>
<tr/>';
                ?>
                <tr>
                    <td><?php echo $allocations_details['MFLCode']; ?></td>
                    <td><?php echo $allocations_details['facilityname']; ?></td>
                    <td><?php echo $allocations_details['reagentname']; ?></td>
                    <td><?php echo $allocations_details['qty']; ?></td>
                    <td><?php echo $date; ?></td>
                </tr>


            <?php } ?>

            </tr>
        </tbody>

    </table>

    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />
    <br />

</div>
