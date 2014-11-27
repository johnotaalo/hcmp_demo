
<?php
$month = $this->session->userdata('Month');
if ($month == '') {
    $month = date('mY', time());
}

$year = substr($month, -4);
$month = substr_replace($month, "", -4);
$monthyear = $year . '-' . $month . '-1';
$englishdate = date('F, Y', strtotime($monthyear));
?> 


<?php
$option = '';
$id = $this->session->userdata('user_id');
$q = 'SELECT counties.id AS countyid, counties.county
            FROM rca_county, counties
            WHERE rca_county.county = counties.id
            AND rca_county.rca =' . $id;
$res = $this->db->query($q);
foreach ($res->result_array() as $key => $value) {
    $option .= '<option value = "' . $value['countyid'] . '">' . $value['county'] . '</option>';
}
?>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        $('#example_mainw').dataTable({
            "bJQueryUI": true,
            "bPaginate": true,
            "aaSorting": [[3, "desc"]]
        });
    });
    var county = <?php echo $this->session->userdata('county_id'); ?>;


    

</script>
<br />
<?php include('rca_sidabar.php');?>


<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: 500px">

    <?php
//echo "<pre>";var_dump($reports);echo "</pre>";
    ?>
    <div id="graphs">
        <script src="http://code.highcharts.com/highcharts.js"></script>
        <script src="http://code.highcharts.com/modules/exporting.js"></script>
        <script type="text/javascript">

            $(function() {
                $('#container').highcharts({
                    chart: {
                        type: 'bar'
                    },
                    title: {
                        text: '<?php echo $county . ' County Reporting Rates ' . $englishdate; ?>'
                    }, subtitle: {
                        text: 'Live data reports on RTK'
                    },
                    xAxis: {
                        categories: <?php echo $graphdata['districts']; ?>
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
                            data: <?php echo $graphdata['nonreported']; ?>
                        }, {
                            name: 'Reported',
                            data: <?php echo $graphdata['reported']; ?>
                        }]
                });
            });
        </script>
<?php if (($this->session->userdata('switched_from') == 'rtk_manager')) { ?>
            <div id="fixed-topbar" style="position: fixed; top: 104px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
                <span class="lead" style="color: #ccc;">Switch back to RTK Manager</span>
                &nbsp;
                &nbsp;
                <a href="<?php echo base_url() . 'rtk_management/switch_district/0/rtk_manager/0/home_controller/0/'; ?>/" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
            </div>
<?php } ?>
        <div>
            <table class="table" style="font-size: 139%;">
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
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Determine</td>
                        <td><?php echo number_format($county_summary[0]['sum_opening'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_received'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_used'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_tests'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_positive'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_negative'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_losses'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[0]['sum_closing_bal'], $decimals = 0); ?></td>
                    </tr>
                               <tr>
                        <td>Unigold</td>
                        <td><?php echo number_format($county_summary[1]['sum_opening'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_received'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_used'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_tests'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_positive'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_negative'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_losses'], $decimals = 0); ?></td>
                        <td><?php echo number_format($county_summary[1]['sum_closing_bal'], $decimals = 0); ?></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

    </div>

</div>
