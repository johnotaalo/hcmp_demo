



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


<div class="main-container" style="width: 100%;float: right;">

  <table id="pending_facilities" class="data-table"> 
    <thead>
    <tr>        
      <th>County</th>
      <th>Sub-County</th>
      <th>MFL</th>
      <th>Facility Name</th>      
      <th>Comodity</th>      
      <th>Quantity Requested</th>      
      <th>AMC</th>      
          
    </tr>        
      
    </thead>

    <tbody>
      <?php
      if(count($facilities)>0){
       foreach ($facilities as $value) {
        //$zone = str_replace(' ', '-',$value['zone']);
        $facil = $value['facility_code'];
        ?> 
        <tr>   
          <td><?php echo $value['county'];?></td>
          <td><?php echo $value['district'];?></td>              
          <td><?php echo $value['facility_code'];?></td>
          <td><?php echo $value['facility_name'];?></td>     
          <td><?php echo $value['commodity_name'];?></td>     
          <td><?php echo $value['q_requested'];?></td>     
          <td><?php echo $value['amc'];?></td>     
          
          
        </tr>
        <?php }
      }else{ ?>
      <tr>There are No Facilities which did not Report</tr>
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
      "sSwfPath": "../../assets/datatable/media/swf/copy_csv_xls_pdf.swf"
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
  

});
</script>

<!--Datatables==========================  --> 
<script src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="../../assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="../../assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="../../assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="../../assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="../../assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="../../assets/scripts/jquery.validate.min.js" type="text/javascript"></script>



<link href="../../assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="../../assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="../../assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>


