<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<style type="text/css" title="currentStyle">
	@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
</style>
<style>

			.warning2 {
	background: #FEFFC8 url('<?php echo base_url()?>Images/pdf-icon.jpg') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	}
		</style>
<script>
/******************************************data-table set up*********************/
/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};

	   $(document).ready(function() {
//[ [0,'asc'], [1,'asc'] ]
    	$('#main1').dataTable( {
    		"bSort": false,
					"bJQueryUI": true,
                   "bPaginate": false
				} );
    
});
</script>
<div id="notification">Order Details</div>
 <?php 
 $this->load->helper('MY');
 $table_body='';
 foreach ($detail_list as $detail) {
					$table_body.='<tr><td>'.$detail['category_name'].'</td>';
					$table_body.='<td>'.$detail['commodity_name'].'</td>';
					$table_body.='<td>'.$detail['unit_of_issue'].'</td>';
					$table_body.='<td>'.$detail['beginning_bal'].'</td>';
					$table_body.='<td>'.$detail['q_received'].'</td>';
					$table_body.='<td>'.$detail['q_used'].'</td>';
					$table_body.='<td>'.$detail['no_of_tests_done'].'</td>';
					$table_body.='<td>'.$detail['losses'].'</td>';
					$table_body.='<td>'.$detail['positive_adj'].'</td>';
					$table_body.='<td>'.$detail['negative_adj'].'</td>';
					$table_body.='<td>'.$detail['closing_stock'].'</td>';
					$table_body.='<td>'.$detail['q_expiring'].'</td>';
					$table_body.='<td>'.$detail['days_out_of_stock'].'</td>';
					$table_body.='<td>'.$detail['q_requested'].'</td></tr>';					
				 }
				 ?>
<div style="margin-left: 80%">
	<div class="activity excel"><h2><a href="<?php echo site_url('rtk_management/get_lab_report/'.$this->uri->segment(3).'/excel');?>">
 Download Excel</a></h2></div>

<div class="activity pdf"><h2><a href="<?php echo site_url('rtk_management/get_lab_report/'.$this->uri->segment(3).'/pdf');?>">
 Download PDF</a></h2></div>
 
</div>

<table id="main1" width="100%">
	
	<thead>
	<tr>
		<th><strong>Category</strong></th>
		<th><strong>Description</strong></th>
		<th><strong>Unit of Issue</strong></th>
		<th><strong>Beginning Balance</strong></th>
		<th><strong>Quantity Received</strong></th>
		<th><strong>Quantity Used</strong></th>
		<th><strong>Number of Tests Done</strong></th>
		<th><strong>Losses</strong></th>
		<th><strong>Positive Adjustments</strong></th>
		<th><strong>Negative Adjustments</strong></th>
		<th><strong>Closing Stock</strong></th>
		<th><strong>Quantity Expiring in 6 Months</strong></th>
		<th><strong>Days Out of Stock</strong></th>
		<th><strong>Quantity Requested</strong></th>
	</tr>
	</thead>
	<tbody>
	<?php
		echo $table_body;
	?>
	</tbody>
</table>