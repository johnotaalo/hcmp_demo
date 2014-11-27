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

<style>  
#switch_district{font-size: 17px;margin: 8px 0px 13px 0px;}
body > div.container-fluid > div > div > div.leftpanel > div > span{font-size: 18px;text-transform: uppercase;font-style: oblique;font-family: calibri;padding: 0px 6px 5px 17px;border-bottom: solid 1px #ccc;background: #D6CA00;width: 100%;font-style: normal;}
.label {font-size: 11px;padding: 3px;}
body > div.container-fluid > div > h1{margin-left: 235px;}
table {
    font-size: 12px;
}
.leftpanel{
    width: 17%;
    height:auto;
    float: left;
}
.alerts{
    width:95%;
    height:auto;
    background: #E3E4FA;  
    padding-bottom: 2px;
    padding-left: 2px;
    margin-left:0.5em;
    -webkit-box-shadow: 0 8px 6px -6px black;
    -moz-box-shadow: 0 8px 6px -6px black;
    box-shadow: 0 8px 6px -6px black;

}
.notify{
    width:95%;
    height:auto;
    background: #E3E4FA;  
    padding-bottom: 2px;
    padding-left: 2px;
    margin-left:0.5em;
    -webkit-box-shadow: 0 8px 6px -6px black;
    -moz-box-shadow: 0 8px 6px -6px black;
    box-shadow: 0 8px 6px -6px black;

}
.dash_menu{
    width: 100%;
    float: left;
    height:auto; 
    -webkit-box-shadow: 2px 3px 5px#888;
    box-shadow: 2px 3px 5px #888; 
    margin-bottom:3.2em; 
}
.dash_main{
    width: 94%;       
    height:520px;   
    margin-left:90px;
    margin-bottom:0em;
    font-size: 14px;
}
.dash_notify{
    width: 15.85%;
    float: left;
    padding-left: 2px;
    height:450px;
    margin-left:8px;
    -webkit-box-shadow: 2px 2px 6px #888;
    box-shadow: 2px 2px 6px #888;

}
div.container {
    width:auto;
    height:auto;
    padding:0;
    margin:0;}
    div.content {
        background:#f0f0f0;
        margin: 0;
        padding:10px;
        font-size:.9em;
        line-height:1.5em;
        font-family:"Helvetica Neue", Arial, Helvetica, Geneva, sans-serif; }
        div.content ul, div.content p {
            padding:0;
            margin:0;
            padding:3px; }
            div.content ul li {
                list-style-position:inside;
                line-height:25px; }
                div.content ul li a {
                    color:#555555; }
                    code {
                        overflow:auto; }

</style>

   
    <?php 
    if ($this->session->userdata('switched_as') == 'dpp') {
      ?>
      <div id="fixed-topbar" style="position: fixed; top: 104px;background: #708BA5; width: 100%;padding: 7px 1px 0px 13px;border-bottom: 1px solid #ccc;border-bottom: 1px solid #ccc;border-radius: 4px 0px 0px 4px;">
        <span class="lead" style="color: #ccc;">Switch back to RTK Manager</span>&nbsp;&nbsp;
        <a href="<?php echo base_url(); ?>rtk_management/switch_district/0/rtk_manager/0/home_controller/0//" class="btn btn-primary" id="switch_idenity" style="margin-top: -10px;">Go</a>
    </div>
    <?php }?>

    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2">
      <div class="leftpanel">
        <div class="sidebar">
            <?php
            $option = '';
            $date = date('d', time());
            $id = $this->session->userdata('user_id');
            $q = 'SELECT * from dmlt_districts,districts 
            where dmlt_districts.district=districts.id
            and dmlt_districts.dmlt=' . $id;
            $res = $this->db->query($q);
            foreach ($res->result_array() as $key => $value) {
                $option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
            }
            $sql = "select distinct rtk_settings.* 
            from rtk_settings, facilities 
            where facilities.zone = rtk_settings.zone 
            and facilities.rtk_enabled = 1";
            $res_ddl = $this->db->query($sql);
            $deadline_date = null;
            $settings = $res_ddl->result_array();
            foreach ($settings as $key => $value) {
                $deadline_date = $value['deadline'];
                $five_day_alert = $value['5_day_alert'];
                $report_day_alert = $value['report_day_alert'];
                $overdue_alert = $value['overdue_alert'];
            }
            ?>
            <span style="" class="label label-info">Switch Sub-Counties</span>
            <br />
            <br />
            <select id="switch_district">
                <option>-- Select Sub-County --</option>
                <?php echo $option; ?>
            </select>
            <br />
            <div class="panel-group " id="accordion" style="padding: 0;">
                <div class="panel panel-default" id="home">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo base_url('Home'); ?>" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-home">
                            </span>Home</a>
                        </h4>
                    </div>
                </div>
                <div class="panel panel-default" id="stats">
                    <div class="panel-heading">
                        <h4 class="panel-title" id="dpp_stats">                        
                            <a href="#" href="#collapseOne" id="notifications"><span class="glyphicon glyphicon-stats">
                            </span>Statistics</a>
                        </h4>
                    </div>
                </div>
                <div class="panel panel-default active-panel" id="orders">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo site_url('rtk_management/scmlt_orders'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
                            </span>Orders</a>
                        </h4>
                    </div>
                </div>
                <div class="panel panel-default" id="allocations">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo site_url('rtk_management/scmlt_allocations'); ?>" href="#collapseThree" id="expiries"><span class="glyphicon glyphicon-transfer">
                            </span>Allocation</a>
                        </h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
<?php
$district = $this->session->userdata('district1');
$district_name = Districts::get_district_name($district)->toArray();
?>

    <div class="dash_main" id="dash_main">        
        <div id="tablediv" style="margin-left:190px;">
            <div id="notification" style="margin-left:280px;font-size:14px;font-weight:bold" >View all orders for <?php echo $d_name; ?> Sub-County Below</div>  
            <?php if (count($lab_order_list) > 0) : ?>
                <table width="100%" id="orders_table">
                  <thead>
                    <tr>
                      <th>Reports for</th>
                      <th>MFL&nbsp;Code</th>
                      <th>Facility Name</th>
                      <th>Compiled By</th>                      
                      <th>Order&nbsp;Date</th>
                      <th>Action</th>
                  </tr>
              </thead>
              <tbody>
                <?php
                foreach ($lab_order_list as $order) {
                  $english_date = date('D dS M Y',strtotime($order['order_date']));
                  $reportmonth = date('F Y',strtotime('-1 month',strtotime($order['order_date'])));

                  ?>
                  <tr>
                    <td><?php echo $reportmonth; ?></td>        
                    <td><?php echo $order['facility_code']; ?></td>
                    <td><?php echo $order['facility_name']; ?></td>
                    <td><?php echo $order['compiled_by']; ?></td>
                    <!--td><?php echo "Lab Commodities"; ?></td-->
                    <td><?php echo $english_date; ?></td>
                    <td><a href="<?php echo site_url('rtk_management/lab_order_details/' . $order['id']); ?>"class="link">View</a>
                        <a href="<?php echo site_url('rtk_management/edit_lab_order_details/' . $order['id']); ?>"class="link report">| Edit</a></td>
                    </tr> 
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
        else :
          echo '<p id="notification">No Records Found</p>';
      endif;
      ?>
  </div>
</div>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">


<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.js"></script>





<script type="text/javascript">

    $(document).ready(function() {        
        var deadline = '<?php echo $deadline_date;?>';
        var date = '<?php echo $date;?>';
        if(date>deadline){
            $('.report').hide();
        }
        $('#switch_district').change(function() {
            var value = $('#switch_district').val();
            var path = "<?php echo base_url() . 'rtk_management/switch_district/'; ?>" + value + "/dpp";       
            window.location.href = path;
        });
         $('#orders_table').dataTable({
            "sDom": "T lfrtip",
            "aaSorting": [[0, 'desc']],
            "bPaginate": true,            
            "sScrollY": "377px",
            "sScrollX": "100%",
            "sPaginationType": "bootstrap",
            "oLanguage": {
                "sLengthMenu": "_MENU_ Records per page",
                "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
            },
            "oTableTools": {
                "aButtons": [
                "copy",
                "print",
                {
                    "sExtends": "collection",
                    "sButtonText": 'Save',
                    "aButtons": ["csv", "xls", "pdf"]
                }
                ],
                "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
            }
        });
        $("#orders_table").tablecloth({theme: "paper",
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,                   
          customClass: "my-table"
        });
        $(".notif").delay(20000).slideUp(1000);
        $("#tablediv").delay(15000).css( "height", '450px');
        $(".dataTables_filter").delay(15000).css( "color", '#ccc');

         $("#dpp_stats").click(function(event) {
            $(".dataTables_wrapper").load("<?php echo base_url(); ?>rtk_management/summary_tab_display/" + <?php echo $countyid; ?> + "/<?php echo $year; ?>/<?php echo $month; ?>/");
            $('#orders').removeClass('active-panel');
            $('#stats').addClass('active-panel');
        });;
    
});
</script>

