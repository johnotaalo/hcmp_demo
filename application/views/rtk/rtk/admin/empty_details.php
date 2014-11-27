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
         "sDom": "T lfrtip",
         "aaSorting": [],
         "bJQueryUI": false,
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

    });
</script>
<style type="text/css">
    table{
        font-size: 13px;
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
            <th>Sub-County</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>                               
            <th>Telephone</th>                               
            </thead>
            <tbody style="border-top: solid 1px #828274;">
                <?php
                foreach ($users as $key=> $value) { ?>  

                    <tr>
                        <td><?php echo $value[0]['county'];?></td>
                        <td><?php echo $value[0]['district_name'];?></td>
                        <td><?php echo $value[0]['fname'];?></td>
                        <td><?php echo $value[0]['lname'];?></td>
                        <td><?php echo $value[0]['email'];?></td>
                        <td><?php echo $value[0]['telephone'];?></td>
                    </tr>
                <script type="text/javascript">
                    $(function() {
                            });
                </script>
            <?php } ?></tbody>
        </table>

    </div>
</div>
<script>
$('#settings_tab').removeClass('active_tab');
        $('#messaging_tab').removeClass('active_tab');
        $('#trend_tab').removeClass('active_tab');
        $('#users_tab').addClass('active_tab');
    </script>

