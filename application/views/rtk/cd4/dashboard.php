<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<div class="coll-md-12">
    <ul class="pager">
        <li class="previous disabled"><a href="#">&larr; <?php echo $prev_englishdate; ?></a></li>
        <span id="pager-content" style="color: #E28B8B;font-size: 20px;text-decoration: overline;">
            <a id="sync-data" title="Refresh Data for <?php echo $englishdate; ?>"><span class="glyphicon glyphicon-refresh"> </span></a>  <?php echo $englishdate; ?>
        </span>
        <li class="next"><a href="#"><?php echo $next_englishdate; ?> &rarr;</a></li>
    </ul>
    <table class="table table-striped">
        <thead>
            <tr>
                <th rowspan="2">County</th>
                <th colspan="2">Facilities</th>
                <th rowspan="2">Reporting Rate</th>
            </tr>
        <th>Reported </th>
        <th>Total</th>
        </thead>
        <tbody>

            <?php
            foreach ($counties_rates as $key => $value) {
                $reporting_rate = ($value->particulars->reported) / ($value->particulars->total) * 100;
                $reporting_rate = number_format($reporting_rate, 0);
                ?>
                <tr>
                    <td><a href="<?php echo(base_url('cd4_management/county_allocation_details') . '/' . $value->county); ?>"><?php echo($value->name); ?></a></td>
                    <td><?php echo($value->particulars->reported); ?> </td>
                    <td><?php echo($value->particulars->total); ?> </td>
                    <td><?php echo $reporting_rate; ?>% </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

</div>

<script type="text/javascript">

    $(document).ready(function() {
        var url = "here";

        var year = <?php echo $year; ?>;
        var month = <?php echo $month; ?>;
        $('#sync-data').click(function() {
            $('#pager-content').html("<img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>' /> &nbsp;&nbsp; Fetching data for <?php echo $englishdate; ?>");
            $.post('<?php echo base_url("cd4_management"); ?>/sync_nascop/' + month + '/' + year, function(data) {
                $('#pager-content').html(data);
            }).done(function(){
                        //location.reload(true);

            });
            /*
             $.ajax({
             type: "POST",
             url: url,
             data: month,
             success: success
             });
             */
        });
        $("table").tablecloth({theme: "paper", sortable: true,
            clean: true});
//        $('#pager-content').html("<img src='<?php echo base_url('assets/img/ajax-loader.gif'); ?>' /> &nbsp;&nbsp; Fetching data for <?php echo $englishdate; ?>");
    });
</script>
