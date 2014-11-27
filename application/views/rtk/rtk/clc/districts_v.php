
<?php
$month = $this->session->userdata('Month');
if ($month == '') {
    $month = date('mY', strtotime('-1 month'));
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
    #pending td{
        font-size: 13px;
        font-family: calibri;
    }
</style>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>



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
        	 <table class="table" id="pending">
                <thead>
                    <th>Sub-County</th>
                    <th>No of Facilities</th>
                    <th>Action</th>
                </thead>
                <tbody>
                <?php  
                    $count_districts = count($districts_list);             

                    for ($i=0; $i <$count_districts ; $i++) {
                        $district = $districts_list[$i]['id'];
                        $action = base_url() . 'rtk_management/district_profile/' . $district;
                     ?> 
                        <tr>
                            <td><?php echo $districts_list[$i]['district'];?></td>
                            <td><?php echo $facilities_count[$i];?></td>
                            <td><a href="<?php echo $action;?>">View </a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

        </div>
        

    </div>

</div>
