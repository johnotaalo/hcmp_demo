<p id="notification">Potential Expiries in <?php echo $potential_expiries[0]['district'] ?> District</p>
<input type="hidden" name="district_id" id="district_id" value="<?php echo $potential_expiries[0]['district_id'] ?>">
<div>
<table class="data-table">
	
	<tr>
		<th>MFL Code</th>
		<th>Facility Name</th>
		<th>Cost of Expiries</th>
		<th>Action</th>
	</tr>	
			
		<tbody>
			<?php echo $table_body;?>
		</tbody>
	
</table>
</div>