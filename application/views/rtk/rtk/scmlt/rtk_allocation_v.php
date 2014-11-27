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
        font-size: 13px;
    }
</style>
<style type="text/css">
    body > div.container-fluid > div > h1{margin-left: 230px;}
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
        $id = $this->session->userdata('user_id');
        $q = 'SELECT * from dmlt_districts,districts 
        where dmlt_districts.district=districts.id
        and dmlt_districts.dmlt=' . $id;
        $res = $this->db->query($q);
        foreach ($res->result_array() as $key => $value) {
            $option .= '<option value = "' . $value['id'] . '">' . $value['district'] . '</option>';
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
                <div class="panel panel-default " id="orders">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a href="<?php echo site_url('rtk_management/scmlt_orders'); ?>" href="#collapseTwo" id="stocking_levels"><span class="glyphicon glyphicon-shopping-cart">
                            </span>Orders</a>
                        </h4>
                    </div>
                </div>
                <div class="panel panel-default active-panel" id="allocations">
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
<div class="dash_main" id = "dash_main">     
    <div id="notification" style="font-weight:bold;font-size:14px;">View all Allocations for <?php echo $d_name; ?> Sub-County Below</div><br>
    <?php  ?>
    <table width="100%" id="allocation_table" class="data-table">
        <thead>
            <th><b>Month</b></th>
            <th><b>MFL Code</b></th>
            <th><b>Facility Name</b></th>
            <th><b>Commodity</b></th>
            <th><b>(AMC)</b></th>             
            <th><b>Quantity Requested</b></th>
            <th><b>Quantity Allocated</b></th>
        </tr>
    </thead>
    <tbody>
        <?php
        $count = 0;
        foreach ($lab_order_list as $order) {
         $month_text = $order['order_date'];
         $month_text = substr($month_text, 0,7);
         $month = date('F-Y', strtotime($month_text));
         ?>
         <tr>
            <td><?php echo $month;?></td>
            <td><?php echo $order['facility_code'];?></td>
            <td><?php echo $order['facility_name'];?></td>
            <td><?php echo $order['commodity_name'];?></td>
            <td><?php echo $order['amc'];?></td>           
            <td><?php echo $order['q_requested'];?></td>
            <td><?php echo $order['allocated'];?></td>
        </tr>
        
        <?php
        $count++;}
        ?>
    </tbody>
</table>
</div>
</div>

<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
         $('#allocation_table').dataTable({
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
        $("#allocation_table").tablecloth({theme: "paper",
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,                   
          customClass: "my-table"
        });
      //   $("table").tablecloth({theme: "paper",
      //     bordered: true,
      //     condensed: false,
      //     striped: true,
      //     sortable: true,
      //     clean: true,
      //     cleanElements: "th td",
      //     customClass: "my-table"
      // });
      $.fn.slideFadeToggle = function(speed, easing, callback) {
            return this.animate({
                opacity: 'toggle',
                height: 'toggle'
            }, speed, easing, callback);
        };
        $(".notif").delay(20000).slideUp(1000);
        $("#tablediv").delay(15000).css( "height", '450px');
        $(".dataTables_filter").delay(15000).css( "color", '#ccc');

         $("#dpp_stats").click(function(event) {
            $(".dataTables_wrapper").load("<?php echo base_url(); ?>rtk_management/summary_tab_display/" + <?php echo $countyid; ?> + "/<?php echo $year; ?>/<?php echo $month; ?>/");
            $('#allocations').removeClass('active-panel');
            $('#stats').addClass('active-panel');
        });
        $('#switch_district').change(function() {
            var value = $('#switch_district').val();
            var path = "<?php echo base_url() . 'rtk_management/switch_district/'; ?>" + value + "/dpp";

            window.location.href = path;
        });
    });

</script>


