<script>
	$(function() {
    $("#accordion").accordion({
			autoHeight : false,
			active: false,
			collapsible: true
		});
	});	
</script>

	
		
			
			<div>
			<p>
				<table class="data-table" style="margin-left: 0;" width="80%">
					<thead>
					<tr>
						<th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Available Balance</b></th>
										    
					</tr>
					</thead>
					<?php
						foreach($drug_c as $drug):?>
							<tbody>
						<tr>
							<td><?php echo $drug->kemsa_code;?></td>
							<?php foreach($drug->stock_Drugs as $d):?>
							<td><?php echo $d->Drug_Name;?></td>
							<?php endforeach;?>
							<td> <?php echo $drug->SUM;?> </td>
							
						</tr>
						</tbody>
						<?php endforeach;?>
				</table>
			</p>
		</div>
		
	
 