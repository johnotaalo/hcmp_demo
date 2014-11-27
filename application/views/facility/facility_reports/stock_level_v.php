<table class="data-table">
					<caption>Stock Report as of <?php $fechab = new DateTime(); $dateb= $fechab->format(' jS  M Y'); echo $dateb; ?></caption>
					<tr>
						<th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Available Stock</b></th>
					</tr>
					<?php
					
						foreach($stock_count as $stock_balance){?>
						<tr>
							<?php foreach($stock_balance->Code as $d){
								
									foreach($stock_balance->stock_Drugs as $value){ 
										$drugname=$value->Drug_Name;
										$code=$value->Kemsa_Code;
										
										?>
							
							<td><?php echo $code;?></td>
							
							
							<td><?php echo $drugname;?></td>
							<td><?php echo $d->quantity1;?></td>>
						</tr>
						<?php
						}
								}
							?>
							<?php
							}
							?>
</table>

