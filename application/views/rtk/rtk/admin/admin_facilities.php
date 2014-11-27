<?php 
    include('admin_links.php');         
?>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>
<script type="text/javascript">


    $(document).ready(function() {

        $('#users').dataTable({
            "bJQueryUI": false,
            "bPaginate": true
        });
        $('#add_user').click(function() {
            //$('#user_add_form').submit();
        });
        $('#add_rca_county').click(function() {
            $(this).parent().submit();
        });
        $("#users").tablecloth({theme: "paper",         
          bordered: true,
          condensed: true,
          striped: true,
          sortable: true,
          clean: true,
          cleanElements: "th td",
          customClass: "data-table"
        }); 
        // $('#add_user').click(function(e) {         
        //       e.preventDefault();                       
        //       var fname = $("#firstname").val();
        //       var lname = $("#lastname").val();
        //       var email = $("#email").val();
        //       var region = $("#region").val();
        //       var level = $("#level").val();
        //       var county = $("#county").val();
        //       var district = $("#district").val();             
         
        //       $.post("<?php echo base_url() . 'rtk_management/add_user'; ?>", {
        //           fname: fname,
        //           lname: lname,
        //           email: email,
        //           region:region,
        //           level:level,
        //           county :county,
        //           district: district,                  
        //           }).done(function(data) {
        //               alert("Data Loaded: " + data);                      
        //               window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_users'; ?>";
        //           });
        //        });  

    });
</script>
<style type="text/css">
    table{
        font-size: 11px;
    }

    .dataTables_wrapper{
        margin-left: 16px;
        font-size: 11.5px;
        background: #F9F9F9;
        padding: 12px;
    }
    .dataTables_filter,.dataTables_length{
        float: right;
    }
    #users_length{
        float: left;
    }
    #users{
        width: 100%; 
        float: left;
        margin-left: -10px;
    }
    #users_paginate{
        float: right;
    }
    #Add_DMLT{
        float: left;  
        margin-left: 2%;      
    }
    #lA{
        margin-top: 20px;
    }
    div.dataTables_paginate ul.pagination {
        margin: 2px;
        margin-top: 30px;
}
</style>

<div class="tab-content">
    <div class="tab-pane active" id="lA" style="margin-top:50px;">
    
       
        <button data-target="#Add_Facil" class="btn btn-default" data-toggle="modal" style="margin-left:10px;">Add Facility</button>

        
        <table class="" id="users">
            <thead style="text-align:left; font-size:13px; font-style:bold;">
            <th>Facility Code</th>
            <th>Facility Name</th>
            <th>Sub-County</th>
            <th>County</th>
            <th>Partner</th>
            <th>Owner</th>
            <th>RTK Status</th>
            <th>RTK Action</th>
            <th>Action</th>
            <th>Delete Action</th>
            </thead>
            <tbody style="border-top: solid 1px #828274;">
            <?php 
                
                foreach ($facilities as $key => $value) {
                    $rtk_state = $value['rtk_enabled'];
                    if($rtk_state==0){
                        $rtk_action = 'Not Reporting';
                        $rtk_action_link = '<a href="'.base_url().'/rtk_management/enable_rtk">Enable</a>';
                    }else{
                        $rtk_action = 'Reporting';
                        $rtk_action_link = '<a href="'.base_url().'/rtk_management/disable_rtk">Disable</a>';
                    }
                    $rtk_partner = $value['partner'];                    
                    if($rtk_partner==0){
                        $partner = 'N/A';                        
                    }else{
                        $partner = $partners_array[$rtk_partner];
                        //$partner =  $rtk_partner;// = $value['partner'];                    
                    }
                    ?>
                <tr id="<?php $value['facility_code'];?>" class="rows">
                    <td><?php echo $value['facility_code'];?></td>
                    <td><?php echo $value['facility_name'];?></td>
                    <td><?php echo $value['facil_district'];?></td>
                    <td><?php echo $value['county'];?></td>
                    <td><?php echo $partner;?></td>
                    <td><?php echo $value['owner'];?></td>
                    <td><?php echo $rtk_action;?></td>
                    <td><?php echo $rtk_action_link;?></td>
                    <td><button data-target="#Edit_Facility" class="edit_facility_row_btn" data-toggle="modal" id="<?php echo $value['facility_code'];?>" value="<?php echo $value['facility_code'];?>">Edit</button></td>
                    <td>DELETE</td>                    
                </tr>
            <?php }
            ?>
                
                
           </tbody>
        </table>

    </div>
</div>
 <!--Edit Deadline -->
        <div class="modal fade" id="Edit_Facility" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Facility</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="edit_facility_form">       
                  <table id="edit_facility_table">
                    <tr>    
                      <td>MFL</td>
                      <td><input id="edit_mfl" style="width:96%" type="text" name="edit_deadline" value=""/></td>
                    </tr>   
                    <tr>
                      <td>5 Day Alert</td>
                      <td><textarea id="edit_five_day_alert" style="width:96%" type="text" name="edit_five_day_alert" ></textarea></td>
                    </tr>             
                    <tr>
                      <td>Report Day Alert</td>
                      <td><textarea id="edit_day_alert" type="text" style="width:96%" name="edit_day_alert"></textarea></td>
                    </tr>
                    <tr>
                      <td>Report Overdue Alert</td>
                      <td><textarea id="edit_overdue_alert" type="text" style="width:96%" name="edit_overdue_alert" ></textarea></td>
                    </tr>
                    <tr>
                      <td>Applicable To:</td>
                      <td>
                        <input type="checkbox" name="edit_zone" value="Zone A" disabled>Zone A
                        <input type="checkbox" name="edit_zone" value="Zone B" disabled>Zone B<br>
                        <input type="checkbox" name="edit_zone" value="Zone C" disabled>Zone C
                        <input type="checkbox" name="edit_zone" value="Zone D" disabled>Zone D<br>
                      </td>
                      <input type="hidden" value="" id="edit_deadline_id" name="edit_deadline_id"> 
                    </tr>                
                  </table>
                </form>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
                <button id="edit_deadline_btn" class="btn edit_deadline_btn btn-default">Save Changes</button>
              </div>
            </div>      
          </div>
         
<script>
$('#settings_tab').removeClass('active_tab');
        $('#messaging_tab').removeClass('active_tab');
        $('#trend_tab').removeClass('active_tab');
        $('#users_tab').removeClass('active_tab');
        $('#facilities_tab').addClass('active_tab');
 </script>


