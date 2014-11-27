<?php
$month = $this->session->userdata('Month');
if ($month==''){$month = date('mY',time());}
$year= substr($month, -4);
$month= substr_replace($month,"", -4);
$monthyear = $year . '-' . $month . '-1';
$englishdate = date('F, Y', strtotime($monthyear));
?> 
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>


<script type="text/javascript">

    $(document).ready(function() {

        $('#example_mainw').dataTable({
            "bJQueryUI": true,
            "bPaginate": true,
            "aaSorting": [[3, "desc"]]
        });
    });
    var county = <?php echo $this->session  ->userdata('county_id'); ?>;     
               
    $(function () { 
        $("#grapharea").load("./rtk_management/county_reporting_percentages/" + county/ + <?php echo $year.'/'.$month;?>);

          $('#switch_month').change(function(){
                var value = $('#switch_month').val();
              var path = "<?php echo base_url().'rtk_management/switch_district/0/rtk_county_admin/';?>"+value + "/";
//              alert (path);
                 window.location.href=path;
            });
    });
    

    function loadPendingFacilities() {
        $(".dash_main").load("<?php echo base_url(); ?>rtk_management/rtk_reporting_by_county/<?php echo $this->session->userdata('county_id') .'/'. $year.'/'.$month;?>");
    }

</script>
<br />
<?php include('rca_sidabar.php');?>
<div class="dash_main" style="width: 80%;float: right; overflow: scroll; height: 550px">
        <?php
        if ($sk!==null && $sk !== 'none'){
         include 'admin/'.$sk.'.php';
        }
        ?>

 
    </div>

</div>
