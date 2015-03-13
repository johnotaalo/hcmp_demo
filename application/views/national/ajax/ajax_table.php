<style>
	
	#facilitytable th{
		font-size:12px !important;
		
	}
	#facilitytable td{
		font-size:11px;
		
	}
</style>

<script>
    $(document).ready(function() {
	//datatables settings 
	$('#facilitytable').dataTable( {
	   "sDom": "T lfrtip",
	     
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
});
</script>

<table  class="table" id="facilitytable"  >
						<thead style="background-color: white">
							<tr>
								<th>Facility mfl</th>
								<th>Facility name</th>
								<th>Date activated </th>
								<th>County </th>
								<th>Sub County </th>
								<th>Owner</th>
								<th>Type</th>
								<th>Level</th>
								
							</tr>
						</thead>

						<tbody>
							<?php
							foreach ($facilities as $list ) {
							?>
							<tr class="edit_tr" >
								<td class="facility_code" ><?php echo $list['facility_code']; ?></td>
								<td class="facility_name"><?php echo $list['facility_name']; ?>	</td>
								<td class="date_of_activation" data-attr=""><?php echo $list['date_of_activation']; ?></td>
								<td class="" data-attr=""><?php echo $list['county']; ?></td>
								<td class="" data-attr=""><?php echo $list['district']; ?></td>
								<td class="phone"><?php echo $list['owner']; ?></td>
								<td class="district"><?php echo $list['type']; ?></td>
								<td class="district"><?php echo $list['level']; ?></td>
								
							
								

							</tr>
							<?php } ?>
						</tbody>
						
						
						
						
						</table>