<div class="container" style="width: 96%; margin: auto;">
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
		<th>Submitted By:</th>
		<th>Date of Submission</th>
		<th>Action</th>
		
	</tr>
	</thead>
	<tbody>
		<?php 
		$counter = 6;
		//$malaria_values = Malaria_Data::getall($user);
			foreach($user_data as $d)
			{
				$user = $d['user_id'];
				$name = Users::get_user_names($user);
				
				
						?>
						<tr>
				
							<td><?php echo $name[0]['fname']." ".$name[0]['lname'];?> </td>
							<td><?php echo $d['Report_Date'];?></td>
							<td>Edit</td>
							
						</tr>
					<?php 	
			
					}
			
							?>	
	</tbody>
</table>  
</div> 
<script>
$(document).ready(function() {	
	//datatables settings 
	$('#example').dataTable( {
		 //"sDom": "T<'clear'>lfrtip",
	     "sScrollY": "377px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			     
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
});
</script>