
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
    #reports td{
        font-size: 13px;
        font-family: calibri;
    }
    #top{
    	position: fixed;
    	margin-top: -45px;
    	font-size: 13px;
        font-family: calibri;
    }
    #reports_length{        
        margin-left: 3%;
        float: left;
    }
    #reports_filter{
        float: right;
    }
</style>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">


<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>

<script src="<?php echo base_url(); ?>assets/tagsinput/bootstrap-typeahead.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>


<script type="text/javascript">

           
    $(document).ready(function() {


        $('#reports').dataTable({
            "bJQueryUI": false,
            "bPaginate": true,
            "aaSorting": [[3, "desc"]]
        });


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
<div id="top" style="margin-left:150px">
    <p>
        <!--h4>Available Reports for <?php echo $county; ?> County</h4-->
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
        <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto; margin-top:20px;">
        	 <table class="table" id="reports">
                <thead>
                	<th>Report for</th>
                	<th>MFL Code</td>
                	<th>Facility Name</th>
                	<th>District</th>
                	<th>Reported on</th>
                	<th>Compiled by</th>
                	<th> Action</th>
                </thead>
                <tbody id="">
                	<?php 

                	  
                			foreach ($reports as $value) {
                				$order_date = date('F-Y', strtotime($value['order_date']));
                				$mfl = $value['facility_code'];
	                			$facility = $value['facility_name'];	                			
	                			$district = $value['district'];
	                			$reported_on = date('l d F', strtotime($value['order_date']));
	                			$compiled_by = $value['compiled_by'];
	                			$action = base_url() . 'rtk_management/lab_order_details/' . $value['id'];	                			
	                		?>
	                			<tr>
	                				<td><?php echo $order_date; ?></td>
	                				<td><?php echo $mfl; ?></td>	                				
	                				<td><?php echo $facility; ?></td>	                				
	                				<td><?php echo $district; ?></td>	                				
	                				<td><?php echo $reported_on; ?></td>	                				
	                				<td><?php echo $compiled_by; ?></td>	                				
	                				<td><a href="<?php echo $action; ?>">View</a></td>	                				                				
                				</tr>
	                		
	                		<?php }
	                 
	                ?>

                		
                </tbody>
            </table>

        </div>
        

    </div>

</div>
