<table class="data-table">
<?php 
	 echo form_open('#'); ?>	
	<caption> Orders details</caption>
	<tr>
		<th>Drug id</th>
		<th>Drug name</th>
		<th>Quantity Ordered</th>
		<th>Quantity Received</th>
		<th></th>
	</tr>
	<?php
		foreach($detail_list as $rows){
			
			 $received=$rows->quantityRecieved;
			 $ordered=$rows->quantityOrdered;
			 $code=$rows->kemsaCode;
			 
			?>
	<tr>
		<td><?php echo $code; ?></td>
		<td><?php foreach($rows->Code as $drug) echo $drug->Drug_Name;?></td>
		<td><?php echo $ordered;?></td>
		<td><?php echo $received;?></td>
	    <td><a href="#" class="link">Edit</a> </td>
	</tr> 
	<?php
		}
	?>
	<tr>
		<td><?php echo form_submit('submit','Confrim Order'); ?></td>
	</tr>
	<?php echo form_close(); ?>
</table>