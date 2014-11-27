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
       <tr>        
      <th align="">County</th>
      <th align="">Sub-County</th>
      <th align="">MFL</th>
      <th align="">Facility Name</th>     
      <th align="center" colspan="4">Screening KHB</th>      
      <th align="center" colspan="4">Confirmatory First Response</th>      
      <th align="center" colspan="4">TieBreaker - Unigold</th> 
    </tr>    
    <tr>
          
      <th align="center"></th>
      <th align="center"></th>
      <th align="center"></th>
      <th align="center"></th>      
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">MMOS</th>
      <th align="center">Quantity to Allocate</th>
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">MMOS</th>      
      <th align="center">Quantity to Allocate</th>
      <th align="center">Ending Balance</th>      
      <th align="center">AMC</th>
      <th align="center">MMOS</th>
      <th align="center">Quantity to Allocate</th>                
    </tr>
      
    </thead>

    <tbody>
      <?php
      if(count($facilities)>0){
       foreach ($facilities as $value) {
        //$zone = str_replace(' ', '-',$value['zone']);
        $facil = $value['facility_code'];

        $ending_bal_s =ceil(($amcs[$facil][2]['closing_stock'])/50); 
        $ending_bal_c =ceil(($amcs[$facil][3]['closing_stock'])/30); 
        $ending_bal_t =ceil(($amcs[$facil][4]['closing_stock'])/20);

        $amc_s = str_replace(',', '', $amcs[$facil][2]['amc']);
        $amc_c = str_replace(',', '',$amcs[$facil][3]['amc']);
        $amc_t = str_replace(',', '',$amcs[$facil][4]['amc']);

        if($amc_s==''){
          $amc_s = 0;
        }

        if($amc_c==''){
          $amc_c = 0;
        }

        if($amc_t==''){
          $amc_t = 0;
        }

        $mmos_s = ceil(($amc_s * 4)/50);
        $mmos_c = ceil(($amc_c * 4)/30);
        $mmos_t = ceil(($amc_t * 4)/20);

        if($mmos_s < $ending_bal_s){
          $qty_to_alloc_s = 0;
        }else{
          $qty_to_alloc_s = $mmos_s - $ending_bal_s;
        }

        if($mmos_c < $ending_bal_c){
          $qty_to_alloc_c = 0;
        }else{
          $qty_to_alloc_c = $mmos_c - $ending_bal_c;
        }

        if($mmos_t < $ending_bal_t){
          $qty_to_alloc_t = 0;
        }else{
          $qty_to_alloc_t = $mmos_t - $ending_bal_t;
        }

        
        ?> 
        <tr>   
          <td align=""><?php echo $value['county'];?></td>
          <td align=""><?php echo $value['district'];?></td>              
          <td align=""><?php echo $value['facility_code'];?></td>
          <td align=""><?php echo $value['facility_name'];?></td>

          <td align="center"><?php echo $ending_bal_s;?></td>     
          <td align="center"><?php echo $amc_s;?></td>     
          <td align="center"><?php echo $mmos_s;?></td>
          <td align="center"><?php echo $qty_to_alloc_s;?></td>

          <td align="center"><?php echo $ending_bal_c;?></td>     
          <td align="center"><?php echo $amc_c;?></td>     
          <td align="center"><?php echo $mmos_c;?></td>
          <td align="center"><?php echo $qty_to_alloc_c;?></td>

          <td align="center"><?php echo $ending_bal_t;?></td>     
          <td align="center"><?php echo $amc_t;?></td>     
          <td align="center"><?php echo $mmos_t;?></td>
          <td align="center"><?php echo $qty_to_alloc_t;?></td>
          
         
          
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
 
  $('#pending_facilities').dataTable({
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
  $("#pending_facilities").tablecloth({theme: "paper",         
    bordered: true,
    condensed: true,
    striped: true,
    sortable: true,
    clean: true,
    cleanElements: "th td",
    customClass: "data-table"
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
<script src="<?php echo base_url(); ?>assets/datatable/jquery.dataTables.min.js" type="text/javascript"></script>  
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/TableTools.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/ZeroClipboard.js" type="text/javascript"></script>
<script src="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrapPagination.js" type="text/javascript"></script>
<!-- validation ===================== -->
<script src="<?php echo base_url(); ?>assets/scripts/jquery.validate.min.js" type="text/javascript"></script>



<link href="<?php echo base_url(); ?>assets/boot-strap3/css/bootstrap-responsive.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/datatable/TableTools.css" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url(); ?>assets/datatable/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/tablecloth/assets/css/tablecloth.css">
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>