<?php 
    include('admin_links.php');         
?>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>
<script type="text/javascript">


    $(document).ready(function() {

        var table = $('#users').dataTable({
            "sDom": "T lfrtip",
            "sScrollY": "377px",
            "sScrollX": "100%",
            "bPaginate": false,
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
              "sSwfPath": "<?php echo base_url();?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
            }
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
        

        
        <table class="" id="users">
            <thead style="text-align:left; font-size:13px; font-style:bold;">
            <th>County</th>
            <th>MFL</th>
            <th>Facility Name</th>
            <th>Screening</th>
            <th>Confirmatory</th>
            <th>Tie Breaker</th>            
            </thead>
            <tbody style="border-top: solid 1px #828274;">
            <?php
                foreach ($facilities as $key => $value) {?>
                    <tr>
                        <td><?php echo $value['county'];?></td>
                        <td><?php echo $value['facility_code'];?></td>
                        <td><?php echo $value['facility_name'];?></td>
                        <td><?php echo "0"?></td>
                        <td><?php echo "0"?></td>
                        <td><?php echo "0"?></td>
                    </tr>
            <?php }
            ?>                      
                
           </tbody>
        </table>

    </div>
</div>

         
<script>
$('#settings_tab').removeClass('active_tab');
        $('#messaging_tab').removeClass('active_tab');
        $('#trend_tab').removeClass('active_tab');
        $('#users_tab').removeClass('active_tab');
        $('#facilities_tab').addClass('active_tab');
 </script>



