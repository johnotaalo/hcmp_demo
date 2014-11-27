<table class="data-table">	
	<caption>Facility Order No <?php echo $this->uri->segment(3);?>| Facility MFl code <?php echo $this->uri->segment(4);?></caption>
	<tr>
		<th><strong>KEMSA Code</strong></th>
		<th><strong>Description</strong></th>
		<th><strong>Total Issues</strong></th>
		<th><strong>Closing Stock</strong></th>
		<th><strong>Quantity Ordered</strong></th>
	</tr>
	<?php
		foreach($detail_list as $rows){
			//setting the values to display
			 $ordered=$rows->s_quantity;
			 $code=$rows->kemsa_code;
			 $t_issues=$rows->t_issues;
			 $c_stock=$rows->c_stock;
			 
			?>
	<tr>
		<td><?php echo $code; ?></td>
		<td><?php foreach($rows->Code as $drug) echo $drug->Drug_Name;?></td>
		<td><?php echo $t_issues;?></td>
		<td><?php echo $c_stock;?></td>
		<td><?php echo $ordered;?></td>		
	</tr> 
	<?php
		}
	?>
</table>


