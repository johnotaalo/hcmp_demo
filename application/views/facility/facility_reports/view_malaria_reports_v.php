<div class="container" style="width: 96%; margin: auto;">
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
		<th>Prepared By:</th>
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
							<td><a href="<?php echo base_url().'Divisional_Reports/edit_report/'.$d['Report_Date'];?>">
								<button class="btn btn-primary" >
									<span class="glyphicon glyphicon-edit"></span>Edit
								</button></a>
								<a href="<?php echo base_url().'Divisional_Reports/malaria_report_pdf/pdf';?>">
									<button class="download btn btn-xs btn-primary btn-success" >
										<span class="glyphicon glyphicon-download"></span>PDF
										</button></a>
									<a href="<?php echo base_url().'Divisional_Reports/malaria_report_pdf/excel';?>">
								<button class="download btn btn-xs btn-primary btn-success" >
									<span class="glyphicon glyphicon-download"></span>Excel
									</button></a>
							</td>
							<!--<td><a href="<?php echo base_url().'Divisional_Reports/edit_report/'.$d['Report_Date'];?>"></a></td>-->
							
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