
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
<style type="text/css">
    #pending_facilities td{
        font-size: 13px;
        font-family: calibri;
    }
    #top{
        position: fixed;
        margin-top: -45px;
        font-size: 13px;
        font-family: calibri;
    }
    #pending_facilities_length{        
        margin-left: 3%;
        float: left;
    }
    #pending_facilities_filter{
        float: right;
    }
    .pagination{
        margin-top: 10px;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">


<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>

<script type="text/javascript">
           
    $(document).ready(function() {
        $("table").tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,
          clean: true,
          cleanElements: "th td",
          customClass: "my-table"
        });
         $('#pending_facilities').dataTable({
            "bJQueryUI": false,
            "bPaginate": true,
            "aaSorting": [[3, "desc"]]
        });
        
    });
    var county = <?php echo $this->session->userdata('county_id'); ?>;


    $(function() {        
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

    
</script>
<br />
<?php include('rca_sidabar.php');?>

<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: 400px">
<div style="margin-left:140px">
    <p>
        <?php echo $header; ?>
    </p>
</div>

<?php if (($this->session->userdata('switched_from') == 'rtk_manager')) { ?>
            <div id="fixed-topbar" style="position: fixed; top: 104px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
                <span class="lead" style="color: #ccc;">Switch back to RTK Manager</span>
                &nbsp;
                &nbsp;
                <a href="<?php echo base_url() . 'rtk_management/switch_district/0/rtk_manager/0/home_controller/0/'; ?>/" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
            </div>
<?php }?>	
		<?php $date = date('F-Y', mktime(0, 0, 0, $month, 1, $year));		                  
              $counter = 0;
        ?>     

        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto">
        	 <table id="pending_facilities" class="data-table"> 
                    <thead>                   
                        <th>MFL</th>
                        <th>Facility Name</th>
                        <th>Sub-County</th>
                        <th>County</th>
                        <th>Zone</th>
                        <th>Report For:</th>
                    </thead>
                    <tbody>
                        <?php
                  if(count($pending_facility)>0){
                   foreach ($pending_facility as $value) {
                    $zone = str_replace(' ', '-',$value['zone']);
                    $facil = $value['facility_code'];
                    ?> 
                    <tr>                             
                      <td><?php echo $value['facility_code'];?></td>
                      <td><?php echo $value['facility_name'];?></td>
                      <td><?php echo $value['district'];?></td>
                      <td><?php echo $value['county'];?></td>
                      <td><?php echo $zone;?></td>
                      <td><?php echo $value['report_for'];?></td>
                    </tr>
                    <?php   }
                  }else{ ?>
                  <tr>There are No Facilities which did not Report</tr>
                  <?php }
                  ?>            

                </tbody>
              </table>

        </div>
        

    </div>

</div>
