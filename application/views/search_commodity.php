<script>
	$(function() {
    $("#accordion").accordion({
			autoHeight : false,
			active: false,
			collapsible: true
		});
	});	
</script>
	<div id="accordion" >
		<?php 
		foreach($drug_categories as $category):?>
			<h3><a href="#"><?php echo $category->Category_Name?></a></h3>
			<div>
			<p>
				<table class="data-table" style="margin-left: 0;" width="80%">
					<thead>
					<tr>
						<th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Order Unit Size</b></th>
						<th><b>Order Unit Cost (KSH)</b></th>				    
					</tr>
					</thead>
					<?php
						foreach($category->Category as $drug):?>
							<tbody>
						<tr>
							<td><?php echo $drug->Kemsa_Code;?></td>
							<td><?php echo $drug->Drug_Name;?></td>
							<td> <?php echo $drug->Unit_Size;?> </td>
							<td><?php echo $drug->Unit_Cost;?> </td>
						</tr>
						</tbody>
						<?php endforeach;?>
				</table>
			</p>
		</div>
		<?php endforeach;?>
	</div>
 <!--<a href="<?php echo site_url('report_management/test_excel');?>"> excel</a>-->