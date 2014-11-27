
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>


<style>

.dataTables_filter{
  float: right;
}
#pending_facilities_length{
  float: left;  
}
table{
  font-size: 13px;
}


#pending_facilities_paginate{
  font-size: 13px;
  float: right;
  padding:4px;
}
#pending_facilities_info{
  font-size: 15px; 
  float: left;
}

#pending_facilities_filter{
  float: right;
}
.nav li{
  float: left;
  margin-left: 20px;
}
 .DTTT_container{margin-top: 1em;}
    #banner_text{width: auto;}
    .divide{height: 2em;}



</style>
<div style="width:100%;font-size: 12px;height:20px;padding: 10px 10px 10px 10px;margin-bottom:10px;">
  <ul class="nav top-navigation" style="margin-top:0px;float:left;">   
    <li class="" style="margin-left:10px;"><a href="<?php echo base_url() .'rtk_management/new_non_reported_facilities/A';?>">Zone A</a></li>
    <li class=""><a href="<?php echo base_url() .'rtk_management/new_non_reported_facilities/B';?>">Zone B</a></li>
    <li class=""><a href="<?php echo base_url() .'rtk_management/new_non_reported_facilities/C';?>">Zone C</a></li>
    <li class=""><a href="<?php echo base_url() .'rtk_management/new_non_reported_facilities/D';?>">Zone D</a></li>
  </ul>
</div>

<div class="main-container" style="width: 100%;float: right;">

  <table id="pending_facilities" class="data-table"> 
  
    <thead>
    <tr>        
      <th>County</th>
      <th>Sub-County</th>
      <th>MFL</th>
      <th>Facility Name</th>          
      <th>Zone</th>          
      <th><?php echo $month_texts[0];?></th>    
      <th><?php echo $month_texts[1];?></th>    
      <th><?php echo $month_texts[2];?></th>    
      <th><?php echo $month_texts[3];?></th>    
      <th><?php echo $month_texts[4];?></th>    
    </tr> 
      
    </thead>

    <tbody>
      <?php
      if(count($facilities)>0){
       foreach ($facilities as $value) {        
        $facil = $value['facility_code'];
        $m1 =$months[0];
        $m2 =$months[1];
        $m3 =$months[2];
        $m4 =$months[3];
        $m5 =$months[4];
        ?> 
        <tr> 
          <td><?php echo $value['county'];?></td>
          <td><?php echo $value['district'];?></td>
          <td><?php echo $facil;?></td>
          <td><?php echo $value['facility_name'];?></td>          
          <td><?php echo $value['zone'];?></td>
          <td><?php echo $final_array[$m1][0][$facil][0];?></td>
          <td><?php echo $final_array[$m2][0][$facil][0];?></td>
          <td><?php echo $final_array[$m3][0][$facil][0];?></td>
          <td><?php echo $final_array[$m4][0][$facil][0];?></td>
          <td><?php echo $final_array[$m5][0][$facil][0];?></td>
        </tr>
        <?php }
      }else{ ?>
      <tr>There are No Facilities which did not Report</tr><tr> 
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
          <td>N/A</td>
        </tr>
      <?php }
      ?>      

    </tbody>
  </table>
</div>
<script>
$(document).ready(function() {
 
  var table = $('#pending_facilities').dataTable({
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

  $("#pending_facilities tfoot th").each(function(i) {
    var select = $('<select><option value=""></option></select>')
    .appendTo($(this).empty())
    .on('change', function() {
      table.column(i)
      .search('^' + $(this).val() + '$', true, false)
      .draw();
    });

    table.column(i).data().unique().sort().each(function(d, j) {
      select.append('<option value="' + d + '">' + d + '</option>')
    });
  });
  $('.navtbl li a').click(function(e) {
    var $this = $(this);
    var thistext = $(this).text();
    $('.navtbl li').removeClass('active');
    $this.parent().addClass('active');
    $(".dataTables_filter label input").focus();
    $('.dataTables_filter label input').val(thistext).trigger($.Event("keyup", {keyCode: 13}));

    e.preventDefault();
  });
  $("#pending_facilities").tablecloth({theme: "paper",         
      bordered: true,
      condensed: true,
      striped: false,
      sortable: true,
      clean: true,
      cleanElements: "th td",
      customClass: "data-table"
    });    

});
</script>

<!--Datatables==========================  --> 
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url();?>assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="<?php echo base_url();?>assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="<?php echo base_url();?>assets/scripts/jquery.validate.min.js" type="text/javascript"></script>



<link href="<?php echo base_url();?>assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url();?>assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>


