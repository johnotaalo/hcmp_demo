

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
$my_month = json_decode($graphdata['month']);
$count = count($my_month);
$from_date = $my_month[0];
$to_date = $my_month[$count-1]; 
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
$comm = "SELECT lab_commodities.id,lab_commodities.commodity_name FROM lab_commodities,lab_commodity_categories WHERE lab_commodities.category = lab_commodity_categories.id AND lab_commodity_categories.active = '1'";
$commodities = $this->db->query($comm);
// s
$option_comm = '';
foreach ($commodities->result_array() as $key => $value) {
    $option_comm .= '<option value = "' . $value['id'] . '">' . $value['commodity_name'] . '</option>';
}

?>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>


<script type="text/javascript">

    
    var county = <?php echo $this->session->userdata('county_id'); ?>;


    $(function() {
        $("#grapharea").load("./rtk_management/county_reporting_percentages/" + county / +<?php echo $year . '/' . $month; ?>);

        $('#switch_commodity').change(function() {
            var value = $('#switch_commodity').val();

            var path = "<?php echo base_url() . 'rtk_management/switch_commodity/0/partner_commodity_usage/'; ?>" + value + "/";
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
<?php include('side_menu.php');?>
<select id="switch_commodity" class="form-control" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;">
        <option>-- Select Commodity</option>
        <?php echo $option_comm; ?>
    </select>


<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: auto">

    <?php
//echo "<pre>";var_dump($reports);echo "</pre>";
    ?>
    <div id="graphs">
        
      
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
  <script type="text/javascript">

            $(function() {
                $('#container').highcharts({
                    chart: {
                        type: 'line'
                    },
                    title: {
                        text: '<?php echo ' Yearly Commodity Usage:  ' . $commodity_name.' from '. $from_date.' to '. $to_date; ?>'
                    }, subtitle: {
                        text: 'Live data reports on RTK'
                    },
                    xAxis: {
                        categories: <?php echo $graphdata['month']; ?>
                    },
                    yAxis: {
                        min: 0,
                        title: {
                            text: 'Commodity Percentage (%)'
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
                            name: 'Beginning Balance',
                            data: <?php echo $graphdata['beginning_bal']; ?>
                        },
                        {
                            name: 'Quantity Received',
                            data: <?php echo $graphdata['qty_received']; ?>
                        },
                        {
                            name: 'Total Tests',
                            data: <?php echo $graphdata['total_tests']; ?>
                        },
                        {
                            name: 'Losses',
                            data: <?php echo $graphdata['losses']; ?>
                        },
                        {
                            name: 'Ending Balance',
                            data: <?php echo $graphdata['ending_bal']; ?>
                        },
                        {
                            name: 'Quantity Requested',
                            data: <?php echo $graphdata['qty_requested']; ?>
                        }]

                });
            });
        </script>