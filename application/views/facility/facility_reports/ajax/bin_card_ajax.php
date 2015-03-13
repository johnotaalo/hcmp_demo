<style type="text/css">
.table-bordered{border: 1px solid #FFF !important;}
.table-bordered>thead>tr>th, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>tbody>tr>td, .table-bordered>tfoot>tr>td {
border: 1px solid #FFF !important;
}
</style>
<script>
    $(document).ready(function() {
	//datatables settings 
	$('#example').dataTable( {
	   "sDom": "T lfrtip",
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
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
});
</script>
<?php 
// echo "<pre>";print_r($facility_code);echo "</pre>";exit;
 ?>

<?php
   $link = base_url('reports/get_facility_bin_card_pdf/'.'/'.$facility_code.'/'.$commodity_id.'/'.$from.'/'.$to); 
   ?>
      <!--  <div class="button">
                <a href= <?php echo $link; ?> target="_blank">
                <button type="button" class="btn btn-default">
                Download PDF<span class="glyphicon glyphicon-download"></span>
                </button>
                </a>
      </div>-->
 <div style="min-height: 400px; background:#edc1d8">
  <img style="align-content: center;margin-left: 46%; border:0 none;" src="<?php echo base_url();?>assets/img/coat_of_arms-resized1.png" class="img-responsive " alt="Responsive image">
        <div id="" style="text-align: center; ">
          <span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
          <span style="font-size: 0.9em;">Health Commodities Management Platform (HCMP)</span> </br>
          <span style="font-size: 0.9em;">Bin Card For <strong><?php echo $commodity_name ;?></strong></span>
        </div>
    <table  class="row-fluid table table-bordered table-update"  id="example" style="text-transform:capitalize">
  <thead>
  <tr>
    <th>Date of Issue</th>
    <th>S11 No-Reference No-</th>
    <th>Batch No -Issued</th>
    <th>Expiry Date</th>
    <th>Opening Bal.</th>
    <th>+ADJ</th>
    <th style="white-space:nowrap;">-ADJ</th>
    <th>Receipts/Issues</th>
    <th>Closing Bal.</th>
    <th>Service Point</th>
    <th>Issuing/Receiving Officer</th>
  </tr>
  </thead>    
    <tbody>   
      <?php   
             foreach ($bin_card as $bin ) { 
                $bin['unit_size'];
                $formatdate = strtotime($bin['date_issued']) ? new DateTime($bin['date_issued']) : 'N/A';
                $formated_date= $formatdate->format('d M Y');
                $formatdate_exp =strtotime($bin['expiry_date']) ? new DateTime($bin['expiry_date']) : 'N/A';
                $formated_date_exp= strtotime($bin['expiry_date']) ? $formatdate_exp->format('d M Y') : 'N/A';
                $bin['batch_no'];
                $calculated=$bin['balance_as_of'];
                $bin['balance_as_of'];
                $negative_adj= $bin['adjustmentnve'];
                $positive_adj= $bin['adjustmentpve'];
                $bin['fname'];
                $bin['lname'];
                $bin['service_point_name']; 
              if ($positive_adj ==0 && $negative_adj == 0) {

                $closing_bal= ($bin['balance_as_of']-$bin['qty_issued']);
                $adj_value="-";
              
              }elseif ($negative_adj !=0) {

                 $closing_bal= ($bin['balance_as_of']+$negative_adj);
              
              }elseif ($positive_adj !=0) {

                 $closing_bal= ($bin['balance_as_of']+$positive_adj);
               
              }        
               if ($bin['qty_issued'] < 0) {
                 $qty_issued= (string)$bin['qty_issued'];
                 $qty_issued_text= trim($qty_issued, "-");
                 }else{
                   $qty_issued_text= $bin['qty_issued'];

                 }   

                  if ($bin['s11_No']=='initial stock update') {
                    $s_point=$bin['service_point_name'];
          $s_point='Store';
                $color="red";
                $formated_date_exp="N/A";
                 }elseif ($bin['s11_No']=='(+ve Adj) Stock Addition') {
                   $color="red";
           $s_point='Store';
                 }
                 else{
                  $color="black";
          $s_point=$bin['service_point_name'];
                 }
               ?>
        
           
                

                
            <tr style="color:<?php echo $color;?> ">             
              <td><?php echo $formated_date;?> </td>
             
              <td ><?php echo $bin['s11_No']; ;?> </td>
             
              <td><?php echo $bin['batch_no'];?> </td>
              <td style="white-space:nowrap;"l><?php echo $formated_date_exp;?> </td>
              <td><?php echo $bin['balance_as_of'];?> </td>
              <?php  if ($positive_adj ==0 && $negative_adj == 0) {
               ?>
               <td>-</td>
               <td>-</td>
               <?php
              }elseif ($negative_adj !=0) {
               
               ?>
               <td>-</td>
               <td><?php echo $negative_adj; ?></td>
               <?php
              }elseif ($positive_adj !=0) {
               ?>
               <td><?php echo $positive_adj; ?></td>
               <td>-</td>
               <?php
              } ?>
              <td><?php echo   $qty_issued_text;?> </td>
              <td><?php echo  $closing_bal;?> </td>
              <td><?php echo $s_point; ?> </td>
              <td><?php echo $bin['fname'].' '.$bin['lname'];?> </td>
            </tr>
          <?php
               }
              
             
               
          ?>  
     
     
     
   </tbody>
</table>
  </div>
  <script type="text/javascript">
$(document).ready(function() {


 $(".optioncheck").change(function() {
      
      var div="#reports_display";
      var url = "<?php echo base_url()."reports/stock_control_ajax"?>";
      var data= $(this).val();
     
      ajax_post_process_data (url,div,data);
   
     
    });

   function ajax_post_process_data (url,div,data){
    var url =url;
     var loading_icon="<?php echo base_url().'assets/img/loader.gif' ?>";
     $.ajax({
          type: "POST",
          data:{'option_selected': data},
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin:20% 0 20% 30%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
           $(div).html(msg);           
          }
        }); 
}
 

});


</script>