<?php 
    include('admin_links.php');       
?>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
    <script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>

    <style>

    .dataTables_filter{
      float: right;
    }
    #commodities-table_length{
      float: left;
    }
    #users{
      width: 100%; 
    }

    #commodities-table_paginate{
      font-size: 11px;
      float: right;
      padding:4px;
    }
    #commodities-table_info{
      font-size: 11px; 
      float: left;
    }
    table td{
      font-size: 13px;
    }
    table th{
      font-size: 14px;
    }
    #commodities-table_filter{
      float: right;
    }
    #content{
     margin-top: 20px;   
     width: 96%;
     margin-left: 2%;
     background-color: #F9F9F9;
     padding: 20px;
     float: left;
   }




   </style>

   <script type="text/javascript">
   $(document).ready(function() {   


     
      //$('#all_deads').hide();
      $('#all_alerts').hide();
      $('#all_comms').hide();
      $('.toggleSpan').addClass('glyphicon-chevron-up');
      $('.toggleSpan1').addClass('glyphicon-chevron-down');
      $('.toggleSpan2').addClass('glyphicon-chevron-down');
      

     $("#add_deadline_table").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    });    
     $("#edit_deadline_table").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    }); 
     $("#add_commodity_table").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    });   
     $("#add_alert_table").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    });    
     $("#edit_alert_table").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    }); 
     $("#edit_commodity_table").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    });        

     $('#ddl').click(function(){
        $('#all_deads').toggle('slow');
        $('.toggleSpan').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
     });
     $('#alts').click(function(){
      $('#all_alerts').toggle('slow');
      $('.toggleSpan1').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
     });

     $('#cmms').click(function(){
      $('#all_comms').toggle('slow');
      $('.toggleSpan2').toggleClass('glyphicon-chevron-down glyphicon-chevron-up');
     });
      //$('#commodities-table').dataTable();  */     


    });
    </script>


    <!--div class="tabbable tabs-left" style="font-size:147%;">
      <ul class="nav nav-tabs">
       <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin'; ?>">Users</a></li>
       <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_admin_messages'; ?>">Messages</a></li>
       <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_settings'; ?>">Settings</a></li>
       <li class="active"><a href="<?php echo base_url().'rtk_management/rtk_manager_logs'; ?>">Activity Logs</a></li>
     </ul>
   </div-->
   <div id="content">  
    <h5 id="ddl"><b>DEADLINES | <span id="iddl" class="glyphicon toggleSpan"></b></h5>    
    <div id="all_deads">
    <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Add_Deadline">Add Deadline</button>      
    <hr/>
    <div id="deadlines">  
      <table class="data-table" id="deadlines-table">
        <thead>             
          <th>Reporting Deadline (Date of every Month)</th>
          <th>Reporting Status</th>
          <th>5 Days Alert</th>
          <th>Report Day Alert</th>
          <th>Report Overdue Alert</th>
          <th>Applicable To</th>
          <th>Modified By</th>
          <th>Action</th>          
        </thead>
        <tbody>
          <?php foreach ($deadline_data as $row) {
            $id = $row['id'];
            if($row['status']==0){
              $status = "Active";
            }else{
              $status = "Not Active";
            }
            ?>   

            <tr>                  
              <td><?php echo $row['deadline'] ?></td>
              <td><?php echo $status ?></td>
              <td><?php echo $row['5_day_alert'] ?></td>
              <td><?php echo $row['report_day_alert'] ?></td>
              <td><?php echo $row['overdue_alert'] ?></td>
              <td><?php echo $row['zone'] ?></td>
              <td><?php echo $row['fname']." ".$row['lname'] ?></td>
              <td><button data-target="#Edit_Deadline" class="edit_deadline_row_btn" data-toggle="modal" id="<?php echo $id;?>" value="<?php echo $id;?>">Edit</button></td>
            </tr> 
            <?php }?>
          </tbody>    
        </table>
      </div> 
      </div>

      <hr/>
      <h5 id="alts"><b>ALERTS | <span class="glyphicon toggleSpan1"></b></h5>
      <div id="all_alerts">
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Add_Alert">Add Alert</button>      
      <hr/>
      <div id="alerts">         
       <table class="data-table" id="alerts-table">
        <thead>      
          <th>Alert Message</th>
          <th>Alert Type</th>
          <th>State</th>            
          <th>Alert To</th>
          <th>Action</th>
          <th>Delete</th>
        </thead> 
        <tbody>
          <?php foreach ($alerts_data as $value) { 
            $id = $value['id'];
            if($value['status']==0){
              $status = "Active";
            }else if($value['status']==1){
              $status = "Not Active";
            }

            ?>
            <tr>
              <td><?php echo $value['message'] ?></td>
              <td><?php echo $value['type'] ?></td>
              <td><?php echo $status ?></td>
              <td><?php echo $value['description'] ?></td>              
              <td><button data-target="#Edit_Alert" class="edit_alert_row_btn" data-toggle="modal" id="<?php echo $id;?>" value="<?php echo $id;?>">Edit</button></td>                           
              <td><button class="del_alert_row_btn" id="<?php echo $id;?>" value="<?php echo $id;?>">Delete</button></td>                           
            </tr>
            <?php }?>
          </tbody>

        </table>
      </div>
      </div>

      <hr/>
      <h5 id="cmms"><b>COMMODITIES</b> | <span class="glyphicon toggleSpan2"></h5>
      <div id="all_comms">
      <button type="button" class="btn btn-default" data-toggle="modal" data-target="#Add_Commodity">Add Commodity</button>      
      <hr/>
      <div id="commodities">          
        <table class="data-table" id="commodities-table">
          <thead>      
            <th>Commodity Name</th>
            <th>Commodity Category</th>
            <th>Unit of Issue</th>
            <th>Action</th>
          </thead> 
          <tbody>
            <?php 
            $i = 1;
            foreach ($commodities_data as $row) {

              $id = $row['id'];

              ?>  

              <tr>      
                <td><?php echo $row['commodity_name'] ?></td>
                <td><?php echo $row['category_name'] ?></td>
                <td><?php echo $row['unit_of_issue'] ?></td>
                <td><button data-target="#Edit_Commodity" class="edit_commodity_row_btn" data-toggle="modal" id="<?php echo $row['id']?>" value="<?php echo $row['id']?>">Edit</button></td>
              </tr> 
              <?php 
              $i++;
            }?>
          </tbody>  
        </table>  
        </div>
        </div>  


        <!--Start of the Modals -->
        <!-- Add Commodity -->
        <div class="modal fade" id="Add_Commodity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Commodity</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="add_commodity_form">       
                    <table id="add_commodity_table">
                      <tr>    
                        <td>Commodity Name</td>
                        <td><input id="name" type="text" name="name" style="width:96%"/></td>
                      </tr>   
                      <tr>
                        <td>Unit of Issue</td>
                        <td><input id="unit" type="text" name="unit" style="width:96%"/></td>
                      </tr>             
                      <tr>
                        <td>Category</td>
                        <td><select id="commodity_category" style="width:100%">
                          <option value="0"> -- Select Category --</option>                            
                          <?php foreach ($commodity_categories as $categ) { ?>
                          <option value="<?php echo $categ['id']; ?>"><?php echo $categ['category_name']; ?></option>
                          <?php } ?>
                        </select>                 
                      </tr>                
                    </table>
                  </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="add_commodity_btn" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Edit Commodity -->
        <div class="modal fade" id="Edit_Commodity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Commodity</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="edit_commodity_form">       
            <table id="edit_commodity_table">
              <tr>    
                <td>Commodity Name</td>
                <td><input id="u_name" type="text" name="u_name" style="width:96%" value=""/></td>
              </tr>   
              <tr>
                <td>Unit of Issue</td>
                <td><input id="u_unit" type="text" name="u_unit" style="width:96%" value=""/></td>
              </tr>             
              <tr>
                <td>Category</td>
                <td><select id="u_commodity_category" style="width:100%">              
                  <?php foreach ($commodity_categories as $categ) { ?>
                  <option style="width:96%" value="<?php echo $categ['id']; ?>"><?php echo $categ['category_name']; ?></option>
                  <?php } ?>
                </select>                 
              </tr>  
              <input id="u_commodity_id" type="hidden"  value=""/>               
            </table>
          </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="edit_commodity_btn" class="btn btn-primary edit_commodity_btn">Save Changes</button>
              </div>
            </div>
          </div>
        </div>
        

        <!--Add Alerts-->
        <div class="modal fade" id="Add_Alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Alert</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="add_alert_form">       
                  <table id="add_alert_table">
                    <tr>    
                      <td>Alert Message</td>
                      <td ><textarea id="a_message" type="text" name="a_message"rows="4" style="width:415px"></textarea></td>
                    </tr>   
                    <tr>
                      <td>Alert Type</td>
                      <td>
                        <select id="a_type" style="width:100%">
                          <option >--Select Type--</option>                         
                          <option value="Information">Information</option>
                          <option value="Notice">Notice</option>
                        </select>
                      </td>
                    </tr>             
                    <tr>
                      <td>Alert Status</td>
                      <td>
                        <select id="a_status" style="width:100%">                          
                          <option value="0">Active</option>
                          <option value="1">Not Active</option>
                        </select>
                      </td>
                    </tr>   
                    <tr>
                      <td>Alert To</td>
                      <td>
                        <select id="a_to" style="width:100%">
                          <option >--Select Receipient--</option>                         
                          <?php 
                          foreach ($alerts_to_data as $value) { ?>
                          <option value="<?php echo $value['id'] ?>"><?php echo $value['description'] ?></option>                         
                          <?php } ?>
                        </select>
                      </td>
                    </tr>                
                  </table>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="add_alert_btn" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>
        

        <!--Edit Alerts -->
        <div class="modal fade" id="Edit_Alert" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Alert</h4>
              </div>
              <div class="modal-body">        
                <p></p>
                <form id="edit_alert_form">       
                  <table id="edit_alert_table">
                    <tr>    
                      <td>Alert Message</td>
                      <td ><textarea id="edit_message" type="text" name="edit_message" rows="4" style="width:415px"></textarea></td>
                    </tr>   
                    <tr>
                      <td>Alert Type</td>
                      <td>
                        <select id="edit_type" style="width:100%">                
                          <option value="Information">Information</option>
                          <option value="Notice">Notice</option>
                        </select>
                      </td>
                    </tr>             
                    <tr>
                      <td>Alert Status</td>
                      <td>
                        <select id="edit_status" style="width:100%">                          
                          <option value="0">Active</option>
                          <option value="1">Not Active</option>
                        </select>
                      </td>
                    </tr>   
                    <tr>
                      <td>Alert To</td>
                      <td>
                        <select id="edit_to" style="width:100%">                
                          <?php 
                          foreach ($alerts_to_data as $value1) { ?>
                          <option value="<?php echo $value1['id'] ?>"><?php echo $value1['description'] ?></option>                         
                          <?php } ?>
                        </select>
                      </td>
                    </tr>   
                    <input type="hidden"  id="edit_id" value="" />              
                  </table>
                </form>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
                <button type="button" id="edit_alert_btn" class="btn btn-primary edit_alert_btn">Save Changes</button>
              </div>
            </div>
          </div>
        </div>



        <!--Add Deadline-->
        <div class="modal fade" id="Add_Deadline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Add Deadline</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="add_deadline_form">       
                  <table id="add_deadline_table">
                    <tr>    
                      <td>Reporting Deadline(Every Month)</td>
                      <td><input id="add_deadline" style="width:96%" type="text" name="add_deadline" value=""/></td>
                    </tr>   
                    <tr>
                      <td>5 Day Alert</td>
                      <td><textarea id="add_five_day_alert" style="width:96%" type="text" name="add_five_day_alert" ></textarea></td>
                    </tr>             
                    <tr>
                      <td>Report Day Alert</td>
                      <td><textarea id="add_day_alert" type="text" style="width:96%" name="add_day_alert"></textarea></td>
                    </tr>
                    <tr>
                      <td>Report Overdue Alert</td>
                      <td><textarea id="add_overdue_alert" type="text" style="width:96%" name="add_overdue_alert" ></textarea></td>
                    </tr>
                    <tr>
                      <td>Applicable To:</td>
                      <td>
                        <input type="checkbox" name="add_zone" value="Zone A">Zone A
                        <input type="checkbox" name="add_zone" value="Zone B">Zone B<br>
                        <input type="checkbox" name="add_zone" value="Zone C">Zone C
                        <input type="checkbox" name="add_zone" value="Zone D">Zone D<br>
                      </td>
                    </tr>                
                  </table>
                </form>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" id="add_deadline_btn" class="btn btn-primary">Save</button>
              </div>
            </div>
          </div>
        </div>

        <!--Edit Deadline -->
        <div class="modal fade" id="Edit_Deadline" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Deadline</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="edit_deadline_form">       
                  <table id="edit_deadline_table">
                    <tr>    
                      <td>Reporting Deadline (Date of Every Month)</td>
                      <td><input id="edit_deadline" style="width:96%" type="text" name="edit_deadline" value=""/></td>
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

          <!--Add Commodity -->
           <div class="modal fade" id="Add_Commodity" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Deadline</h4>
              </div>
              <div class="modal-body">
                <p></p>
                <form id="edit_deadline_form">       
                  <table id="edit_deadline_table">
                    <tr>    
                      <td>Reporting Deadline (Date of Every Month)</td>
                      <td><input id="edit_deadline" style="width:96%" type="text" name="edit_deadline" value=""/></td>
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
          <script type="text/javascript"> 
          $(document).ready(function(){

            $('table').tablecloth({theme: "paper",         
              bordered: true,
              condensed: true,
              striped: true,
              sortable: true,
              clean: true,
              cleanElements: "th td",
              customClass: "my-table"
            });


        //Edit Alerts 
        $('.edit_alert_row_btn').click(function(){        
          var id = $(this).attr('id');
          var name =  $('td:first', $(this).parents('tr')).text();        
          $('#edit_message').val(name);
          $('#edit_id').val(id);
        });
        $('.del_alert_row_btn').click(function(){        
          var id = $(this).attr('id');                  
          $.post("<?php echo base_url() . 'rtk_management/delete_alert'; ?>", {
            id: id,                        
          }).done(function(data) {
            alert("Data Loaded: " + data);            
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
          });
        });

        $('.edit_deadline_row_btn').click(function(){
          $('input[name="edit_zone"]').prop("checked", false);             
          var id = $(this).attr('id');      
          var deadline =  $('td:first', $(this).parents('tr')).text();        
          var status =  $('td:nth-child(2)', $(this).parents('tr')).text();        
          var five_day_alert =  $('td:nth-child(3)', $(this).parents('tr')).text();
          var report_day_alert =  $('td:nth-child(4)', $(this).parents('tr')).text();
          var overdue_alert =  $('td:nth-child(5)', $(this).parents('tr')).text();                        
          var zone_text =  $('td:nth-child(6)', $(this).parents('tr')).text();        
          $('#edit_deadline').val(deadline);
          $('#edit_five_day_alert').val(five_day_alert);
          $('#edit_day_alert').val(report_day_alert);
          $('#edit_overdue_alert').val(overdue_alert);
          $('input[name="edit_zone"][value="' + zone_text + '"]').prop("checked", true);     
          $('#edit_deadline_id').val(id);


        });

    $('.edit_deadline_btn').click(function(){
      var id = $('#edit_deadline_id').val();
      var deadline = $('#edit_deadline').val();
      var five_day_alert = $('#edit_five_day_alert').val();
      var report_day_alert = $('#edit_day_alert').val();
      var overdue_alert = $('#edit_overdue_alert').val();
      var zones = new Array();
      $('input[name="edit_zone"]:checked').each(function() {
        zones.push(this.value);
      });

      var edit_zones = JSON.stringify(zones);
      $.post("<?php echo base_url() . 'rtk_management/update_Deadline'; ?>", {
        id: id,
        deadline: deadline,            
        five_day_alert: five_day_alert,
        report_day_alert:report_day_alert,
        overdue_alert :overdue_alert,
        edit_zones :edit_zones,            
      }).done(function(data) {
        alert("Data Loaded: " + data);
        $('Edit_Deadline'.id).modal('hide');
        window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
      });

    });

    $('#add_deadline_btn').click(function(){      
      var deadline = $('#add_deadline').val();
      var five_day_alert = $('#add_five_day_alert').val();
      var report_day_alert = $('#add_day_alert').val();
      var overdue_alert = $('#add_overdue_alert').val();
      var zones = new Array();
      $('input[name="add_zone"]:checked').each(function() {
        zones.push(this.value);
      });
      var add_zones = JSON.stringify(zones);       
      $.post("<?php echo base_url() . 'rtk_management/create_Deadline'; ?>", {       
        deadline: deadline,            
        five_day_alert: five_day_alert,
        report_day_alert:report_day_alert,
        overdue_alert :overdue_alert,
        add_zones :add_zones,            
      }).done(function(data) {
        alert("Data Loaded: " + data);
        $('Add_Deadline').modal('hide');
        window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
      });

    });



        /*$('.edit_alert_btn').click(function() {         
          var edit_message = $('#edit_message').val();
          var edit_alert_type = $('#edit_type').val();
          var edit_alert_status = $('#edit_status').val();
          var edit_alert_to = $('#edit_to').val(); 
          var edit_id = $('#edit_id').val();       

          $.post("<?php echo base_url() . 'rtk_management/update_Alert'; ?>", {
            message: edit_message,
            type: edit_alert_type,            
            status: edit_alert_status,
            alert_to:edit_alert_to,
            c_id :edit_id,            
          }).done(function(data) {
            alert("Data Loaded: " + data);
            $('Edit_Alert'.c_id).modal('hide');
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_admin_settings'; ?>";
          });
  }); */

        //Edit Commodity
        $('.edit_commodity_row_btn').click(function(){    
          var id = $(this).attr('id');
          var name =  $('td:first', $(this).parents('tr')).text();        
          var unit =  $('td:nth-child(3)', $(this).parents('tr')).text();        
          $('#u_name').val(name);
          $('#u_unit').val(unit);
          $('#u_commodity_id').val(id);      
        });

        $('.edit_alert_btn').click(function() {         
          var edit_message = $('#edit_message').val();
          var edit_alert_type = $('#edit_type').val();
          var edit_alert_status = $('#edit_status').val();
          var edit_alert_to = $('#edit_to').val(); 
          var edit_id = $('#edit_id').val();       

          $.post("<?php echo base_url() . 'rtk_management/update_Alert'; ?>", {
            message: edit_message,
            type: edit_alert_type,            
            status: edit_alert_status,
            alert_to:edit_alert_to,
            c_id :edit_id,            
          }).done(function(data) {
            alert("Data Loaded: " + data);
            $('Edit_Alert'.c_id).modal('hide');
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
          });
        }); 
        $('#add_alert_btn').click(function() {         
          var message = $('#a_message').val();
          var type = $('#a_type').val();
          var status = $('#a_status').val(); 
          var reference = $('#a_to').val(); 

          $.post("<?php echo base_url() . 'rtk_management/create_Alert'; ?>", {
            message: message,
            type: type,
            status: status,
            reference: reference,            
          }).done(function(data) {
            alert("Data Loaded: " + data);
            $('Add_Alert').modal('hide');
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
          });
        }); 


        $('#add_commodity_btn').click(function() {         
          var name = $('#name').val();
          var unit = $('#unit').val();
          var category = $('#commodity_category').val();             
          $.post("<?php echo base_url() . 'rtk_management/create_Commodity'; ?>", {
            name: name,
            unit: unit,            
            category: category,            
          }).done(function(data) {
            alert("Data Loaded: " + data);
            $('Add_Commodity').modal('hide');
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
          });
        }); 

        $('.edit_commodity_btn').click(function() {         
          var name = $('#u_name').val();
          var unit = $('#u_unit').val();
          var c_id = $('#u_commodity_id').val();
          var category = $('#u_commodity_category').val();     

          $.post("<?php echo base_url() . 'rtk_management/update_Commodity'; ?>", {
            name: name,
            unit: unit,            
            category: category,
            c_id :c_id,            
          }).done(function(data) {
            alert("Data Loaded: " + data);
            $('Edit_Commodity'.c_id).modal('hide');
            window.location = "<?php echo base_url() . 'rtk_management/rtk_manager_settings'; ?>";
          });
        }); 


        $('#add_deadline').focusout(function(){
         var deadline = $('#add_deadline').val();
         if((deadline<1)||(deadline>31)){
          alert("The Deadline Must Be Between 1 and 31");
          $('#add_deadline').focus();
          $('#add_deadline').val('10');
        }

        
      });
      });

    </script>
    <script>
    $('#settings_tab').addClass('active_tab');
        $('#messaging_tab').removeClass('active_tab');
        $('#trend_tab').removeClass('active_tab');
        $('#users_tab').removeClass('active_tab');
    </script>

