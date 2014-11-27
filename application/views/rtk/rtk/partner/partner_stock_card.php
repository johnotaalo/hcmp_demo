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
<style type="text/css">
	.nav li{
  float: left;
  margin-left: 20px;
}
table{
    font-size: 11px;
}
table thead{
    font-size: 12px;
}
table tr{
    font-size: 11px;
}
</style>
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

<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: auto">
  <?php include('top_nav.php');?>
  <div id="switch_tab" data-tab="1" class="tab_switch">
  <div style="float:right"><label style="float:left" >Select Month: &nbsp;</label><button id="switch_back" class="" style="max-width: 220px;">Switch to Current Month</button>    
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
     <select id="switch_month" class="" style="max-width: 220px;background-color: #ffffff;border: 1px solid #cccccc;float:right;">
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
    </div>
    <br/><br/><br/>

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
       
        <div style="width:100%;font-size: 12px;height:20px;padding: 10px 10px 10px 10px;margin-bottom:10px;">
          <!--table><tr><ul class="navtbl top-navigation nav" style="margin-top:0px;float:left;">        
            <td style="padding:4px;"><a href="<?php echo base_url().'rtk_management/partner_stock_status'; ?>">Losses  </a></td>
            <td style="padding:4px;"><a href="<?php echo base_url().'rtk_management/partner_stock_status_expiries'; ?>">Expiries  </a></td>
            <td style="padding:4px;"><a href="<?php echo base_url().'rtk_management/partner_stock_level'; ?>">Stock Levels  </a></td>
            <td style="padding:4px;"><a href="<?php echo base_url().'rtk_management/partner_stock_card'; ?>">Stock Card</a></td>

          </ul>
          </tr></table-->
        </div>
        <div class="table" style="font-size: 100%;padding-top:20px;" align="center">
        	<table>
        		<thead>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Kit</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Beginning Balance</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Quantity Received</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Used Total</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Total Tests done</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Losses</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Closing Balance</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Requested amount</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Expiring(6 months)</b></td>
        			<td align="center" style="padding:8px;font-size:13px" ><b>Days out of stock</b></td>
        		</thead>
        		<tbody>
        		<?php foreach ($result as $key => $val) {
        			if ($i ==0) {
					 echo "<tr>";
        		 }?>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['commodity_name']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['beg_bal']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['qty_received']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['qty_used']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['test_done']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['losses']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['closing_stock']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['qty_requested']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['qty_expiring']; ?></td>
        			<td align="center" style="padding:8px;font-size:13px;"><?php echo $val['days_out_of_stock']; ?></td> 
				<?php $i++; ?>

			</tr>

			<?php }; ?>
     			
        		</tbody>
        	</table>
        </div>

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
$('#losses').removeClass('active_tab');
$('#expiries').removeClass('active_tab');
$('#stock_level').removeClass('active_tab');
$('#stock_card').addClass('active_tab');
 $('#switch_month').change(function() {
            var value = $('#switch_month').val();
            var path_full = 'rtk_management/switch_month/'+value+'/partner_stock_card/';
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
            var path_full = 'rtk_management/switch_month/'+value+'/partner_stock_card/';
            var path = "<?php echo base_url(); ?>" + path_full;
            window.location.href = path;
        });


</script>