<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
      
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
    </style>

<div>
<table class="data-table">
	
	<tr>
		<th>MFL Code</th>
		<th>Facility Name</th>
		<th>Order Value</th>
		<th>Action</th>
	</tr>	
			
		<tbody>
			<?php foreach ($delivered as $item) {?>
			<tr>
			<td><?php echo $item['facility_code']; ?></td>
			<td><?php echo $item['facility_name']; ?></td>
			<td><?php echo $item['orderTotal']; ?></td>
			<td><a href="<?php echo site_url('order_management/moh_order_details/'.$item['id']);?>"class="link">View</a></td>
			<a href=""></a>
			</tr>
			<?php } ?>
		</tbody>
	
</table>
</div>