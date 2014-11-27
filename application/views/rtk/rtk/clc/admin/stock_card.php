<?php
$month = $this->session->userdata('Month');
if ($month==''){
   $month = date('mY', strtotime('-1 month'));
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
$current_month = date('mY', strtotime('-1 month'));    

?>
<style type="text/css">
    #switch_back{    
        font-size: 11px;
        font-weight: bold;
        color: green;   
    }
</style>


<br />

<?php include('rca_sidabar.php');?>


<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: auto">
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
                        $count = count($county_summary);
                        if($count==0){?>
                        <tr>
                            <td><?php echo "N/A" ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_opening'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_received'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_used'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_tests'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_positive'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_negative'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_losses'], $decimals = 0); ?></td>
                            <td><?php echo number_format($county_summary[$i]['sum_closing_bal'], $decimals = 0); ?></td>
                        </tr>                                               

                        <?php }else{
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

                        <?php }}
                        ?>                   
                </tbody>
            </table>
        </div>

        
</div>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>
<script>
    $(document).ready(function() {

        var active_month = '<?php echo $active_month ?>';
        var current_month = '<?php echo $current_month ?>';    
        if(active_month==current_month){
            $('#switch_back').hide();            
            $('#switch').hide();            
        }else{    
            $("#switch_back").show();  
            $('#switch').show();                      
        }
        $('#switch_back').click(function() {
            var value = current_month;
            var path_full = 'rtk_management/switch_month/'+value+'/county_home/';
            var path = "<?php echo base_url(); ?>" + path_full;
            window.location.href = path;
        });
        $('table').tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,             
      });
    });
</script>



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
