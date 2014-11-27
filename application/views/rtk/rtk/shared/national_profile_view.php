<style type="text/css">
    .row{
        font-size: 13px;
        font-family: calibri;
    }
</style>
<link rel="stylesheet" type="text/css" href="http://tableclothjs.com/assets/css/tablecloth.css">
<script src="http://tableclothjs.com/assets/js/jquery.tablesorter.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.metadata.js"></script>
<script src="http://tableclothjs.com/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
//        $("table").tablecloth({theme: "paper"});
    });
</script>
<div class="width:100%;margin-left: 10px;">
    <table class="table" style="font-size: 139%; width="100%" ">
        <thead>
            <tr>
                <th>Kit</th>
                <th>Beginning Balance</th>
                <th>Received Quantity</th>
                <th>Used Total</th>
                <th>Total Tests</th>
                <th>Positive Adjustments</th>
                <th>Negative Adjustments</th>
                <th>Losses</th>
                <th>Closing Balance</th>
                <th>Requested</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Determine</td>
                <td><?php echo $national[0]['sum_opening'] ?></td>
                <td><?php echo $national[0]['sum_received'] ?></td>
                <td><?php echo $national[0]['sum_used'] ?></td>
                <td><?php echo $national[0]['sum_tests'] ?></td>
                <td><?php echo $national[0]['sum_positive'] ?></td>
                <td><?php echo $national[0]['sum_negative'] ?></td>
                <td><?php echo $national[0]['sum_losses'] ?></td>
                <td><?php echo $national[0]['sum_closing_bal'] ?></td>
                <td><?php echo $national[0]['sum_requested'] ?></td>                               
            </tr>
            <tr>
                <td>Unigold</td>
                <td><?php echo $national[1]['sum_opening'] ?></td>
                <td><?php echo $national[1]['sum_received'] ?></td>
                <td><?php echo $national[1]['sum_used'] ?></td>
                <td><?php echo $national[1]['sum_tests'] ?></td>
                <td><?php echo $national[1]['sum_positive'] ?></td>
                <td><?php echo $national[1]['sum_negative'] ?></td>
                <td><?php echo $national[1]['sum_losses'] ?></td>
                <td><?php echo $national[1]['sum_closing_bal'] ?></td>
                <td><?php echo $national[1]['sum_requested'] ?></td>
            </tr>
        </tbody>
    </table>
    <div  class="row">
        <div class="span12">

        </div>
    </div>