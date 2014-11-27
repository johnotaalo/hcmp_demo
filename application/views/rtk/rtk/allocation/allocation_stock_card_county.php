 <style type="text/css">
 #stock_card{
  min-height: 350px;
  height: auto;
  border: 1px ridge;
  width: 96%;
  margin-top: 2%;
  float: left;
  margin-left: 0px;
 }
 #stock_status{
  min-height: 150px;
  height:auto;
  border: 1px ridge;
  width: 96%;
  margin-top: 2%;
  float: left;
  margin-left: 0px;
 }
 #stock_card_table{
  font-size: 12px;
 }
 #th-banner{
  text-align: center;
 }
 #top-menu{
  margin-top: 2%;
  width: 96%;
  height: 30px;  
   border: 1px ridge;
  padding: 2px; 
 }
 #top-menu a{
  text-decoration: none; 

 }
 #top-menu a:hover{
  text-decoration:underline;
  color: #009933;
 }
 #counties{
  margin-left: 1%;
 }
 #go_county{
  background-color: #009933;
  color: #fff;
 }
 #download_pdf{
  text-decoration: underline;  
  margin-left: 3%;
 }
 #download_excel{
  text-decoration: underline;  
  margin-left: 1%;
 }
 #or{
  margin-left: 1%;
  text-decoration: none;
 }
 </style>



<?php include('allocation_links.php');?>
<div class="row" style="width:100%; margin-top:2%;margin-left:2%;">  
<div id="top-menu">
  <label>View :</label><a href="<?php echo base_url().'rtk_management/allocation_stock_card'; ?>"> All Counties</a>
  <label>&nbsp; or Select County :</label>
  <select id="counties">
    <?php echo $option_counties;?>
  </select>
  <button id="go_county">Go</button>
  <a id="download_pdf" href="<?php echo base_url().'rtk_management/download_county_mos/'.$county_id.'/pdf'; ?>" target="_blank">
    Download Facilities List as PDF
  </a><a href="" id="or">or 
  <a id="download_excel" href="<?php echo base_url().'rtk_management/download_county_mos/'.$county_id.'/excel'; ?>" target="_blank">
    Download Facilities List as Excel
  </a>
  (<i>The Links open in a new Tab</i>)
</div>
  <div id="stock_card">    
    <table id="stock_card_table" class="data-table">
      <thead>
        <tr>
          <th>Commodity Name</th>
          <th>AMC</th>
          <th>Stock on Hand at Facility</th>
          <th>MOS Central</th>
        </tr>
        <tr>
          <th colspan="4" id="th-banner">HIV Rapid Test Kit Stock Status as at end of <?php echo "$month_text";?></th>
        </tr>
      </thead>
      <tbody style="border-top: solid 1px #828274;">
        
        <?php 
          foreach ($stock_details as $key => $value) { ?>
            <tr>
              <td><?php echo $value['commodity_name'];?></td>
              <td><?php echo $value['amc'];?></td>
              <td><?php echo $value['endbal'];?></td>
              <td><?php echo $value['ratio'];?></td>
            </tr>
        <?php }
        ?>
               
      </tbody>
    </table>
  </div>
  <div id="stock_status">
    
  </div>
</div>

<script type="text/javascript">
  $('#trend_tab').removeClass('active_tab');    
  $('#stocks_tab').addClass('active_tab');  
  $('#allocations_tab').removeClass('active_tab');
</script>

<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablesorter.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.metadata.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>assets/tablecloth/assets/js/jquery.tablecloth.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo base_url();?>assets/datatable/jquery.dataTables.js"></script>
<script type="text/javascript">
$(document).ready(function() {

 $('#stock_card_table').dataTable({
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
  $("#stock_card_table").tablecloth({theme: "paper",         
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
