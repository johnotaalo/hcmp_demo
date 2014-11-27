

<?php
$month = $this->session->userdata('Month');
if ($month==''){
 $month = date('mY',time());
}
$year= substr($month, -4);
$month= substr_replace($month,"", -4);
$monthyear = $year . '-' . $month . '-1';        
$englishdate1 = date('F, Y', strtotime('next month'));
$englishdate = date('F, Y', strtotime($monthyear));
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

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>


<script type="text/javascript">

    
    var county = <?php echo $this->session->userdata('county_id'); ?>;


    $(function() {
        $("#grapharea").load("./rtk_management/county_reporting_percentages/" + county / +<?php echo $year . '/' . $month; ?>);

        $('#switch_month').change(function() {
            var value = $('#switch_month').val();
            var path = "<?php echo base_url() . 'rtk_management/switch_district/0/rtk_county_admin/'; ?>" + value + "/";
//              alert (path);
            window.location.href = path;
        });

        $('#switch_county').change(function() {
            var value = $('#switch_county').val();
            var path = "<?php echo base_url() . 'rtk_management/switch_district/0/rtk_county_admin/0/home_controller/'; ?>" + value + "";
//              alert (path);
            window.location.href = path;
        });
    });

    function loadPendingFacilities() {
        $(".dash_main").load("<?php echo base_url(); ?>rtk_management/rtk_reporting_by_county/<?php echo $this->session->userdata('county_id') . '/' . $year . '/' . $month; ?>");
            }
            function loadDistrict() {
                $(".dash_main").load("<?php echo base_url(); ?>rtk_management/reports_in_county/<?php echo $this->session->userdata('county_id') . '/' . $year . '/' . $month; ?>");
                    }
                    function loadSummary() {
                        $(".dash_main").load("<?php echo base_url(); ?>rtk_management/reports_in_county/<?php echo $this->session->userdata('county_id') . '/' . $year . '/' . $month; ?>");
                            }

</script>
<br />
<?php include('rca_sidabar.php');?>

<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: auto">

    <?php
//echo "<pre>";var_dump($reports);echo "</pre>";
    ?>
    <div id="graphs">
        
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
            <div id="fixed-topbar" style="position: fixed; top: 70px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
                <span class="lead" style="color: #ccc;">Switch back to RTK Manager</span>
                &nbsp;
                &nbsp;
                <a href="<?php echo base_url() . 'rtk_management/switch_district/0/rtk_manager/0/home_controller/0/'; ?>/" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
            </div>
<?php } ?>
       <?php 
        $county_id = $this->session->userdata('county_id');
         $sql1 = "select distinct rtk_alerts.*, rtk_alerts_reference.* from rtk_alerts,rtk_alerts_reference,counties,facilities,districts 
                where (facilities.Zone = rtk_alerts_reference.description or rtk_alerts_reference.description = 'All Counties')
                and facilities.district = districts.id
                and counties.id = districts.county
                and rtk_alerts.reference = rtk_alerts_reference.id                                    
                and rtk_alerts.status = 0
                ";
                $res_alerts = $this->db->query($sql1);                                    
                $notif_alerts = $res_alerts->result_array();
                foreach ($notif_alerts as $value) {
                    $notification = $value['message'];?>
                    <div class="alert notices alert-warning" style="margin-top:0px;"><?php echo '<p>'.$notification.'</p>';
                    ?> </div> <?php

                }
                ?>
        <div>
            <table class="table" style="font-size:13px;">
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
                    <?php
                        
                        for ($i=0; $i <count($county_summary) ; $i++) {?>
                            <tr>
                                <td><?php echo $county_summary[$i]['commodity_name']; ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_opening'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_received'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_used'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_tests'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_positive'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_negative'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_losses'], $decimals = 0); ?></td>
                                <td><?php echo number_format($county_summary[$i]['sum_closing_bal'], $decimals = 0); ?></td>
                            </tr>                                               
                            
                        <?php }
                    ?>
                    <!--tr>
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
                    </tr-->
                </tbody>
            </table>
        </div>

        <div id="container" style="min-width: 310px; height: auto; margin: 0 auto"></div>

    </div>

</div>
<script>
    $(document).ready(function() {

       /* $('.table').dataTable({
            "bJQueryUI": false,
            "bPaginate": true,
            "aaSorting": [[3, "desc"]]
        });*/
        $('.table').tablecloth({theme: "paper",         
              bordered: true,
              condensed: true,
              striped: true,
              sortable: true,             
            });
        });
</script>