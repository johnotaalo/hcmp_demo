<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
<script type="text/javascript" charset="utf-8">
		
		
			/* Define two custom functions (asc and desc) for string sorting */
			jQuery.fn.dataTableExt.oSort['string-case-asc']  = function(x,y) {
				return ((x < y) ? -1 : ((x > y) ?  1 : 0));
			};
			
			jQuery.fn.dataTableExt.oSort['string-case-desc'] = function(x,y) {
				return ((x < y) ?  1 : ((x > y) ? -1 : 0));
			};
			
			$(document).ready(function() {
				
				
				$( "#dialog1" ).dialog({
			height: 140,
			modal: true
		});
	
				/* Build the DataTable with third column using our custom sort functions */
				$('#example').dataTable( {
					"bJQueryUI": true,
					"aaSorting": [ [7,'desc'], [0,'desc'] ],
					"aoColumnDefs": [
						{ "sType": 'string-case', "aTargets": [ 2 ] }
					]
				} );
			} );
		</script> 

<?php if(isset($msg)): ?>
<div id="dialog1">    
<?php echo $msg;?>
</div>
<?php endif;  unset($msg);?>
	<?php if(count($order_list)>0) :?>
<div id="notification">View your district orders below</div>
<table width="100%" id="example">
	<thead>
	<tr>
		<th>Order&nbsp;Number</th>
		<th>MFL&nbsp;Code</th>
		<th>Facility Name</th>
		<th>Compiled By</th>
		<th>Order&nbsp;Date</th>
		<th>Action</th>
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($order_list as $order){?>
	<tr>
		<td><?php echo $order['id'];?></td>		
		<td><?php echo $order['facility_code'];?></td>
		<td><?php echo $order['facility_name'];?></td>
		<td><?php echo $order['fname']." ".$order['lname'];?></td>
		<td><?php echo $order['order_date'];?></td>
		<td><a href="<?php echo site_url('rtk_management/lab_order_details/'.$order['id']);?>"class="link">View</a></td>
	</tr> 
	<?php
		}
	?>
	</tbody>
</table>
<?php 
else :
	echo '<p id="notification">No Records Found </p>';
endif; ?>
