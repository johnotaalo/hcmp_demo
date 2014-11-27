<div class="container" style="width: 95%; margin: auto;">
 <table cellpadding="0" cellspacing="0" width="100%" border="0" 
 class="row-fluid table table-hover table-bordered table-update my"  id="test1">
	<thead>
		<tr>
			<th>Sub County</th>
			<th>Facility Name</th>
			<th>MLF No.</th>
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Last day of usage</th>
			<th>No. days out of stock</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach($facility_stock_data as $facility_stock_data):
$day=date('j M, Y ',strtotime($facility_stock_data['last_day']));
$ts1 = strtotime($facility_stock_data['last_day']); $ts2 = strtotime(date("Y/m/d")); $seconds_diff = $ts2 - $ts1;
$days= floor($seconds_diff/3600/24);
$days=$days<0 ? 0: $days;
			echo "<tr>
			<td>$facility_stock_data[district]</td>
			<td>$facility_stock_data[facility_name]</td>
			<td>$facility_stock_data[facility_code]</td>
			<td>$facility_stock_data[commodity_name]</td>
			<td>$facility_stock_data[commodity_code]</td>
			<td>$day</td>
			<td>$days</td>
			</tr>";	
		endforeach;
		 ?>
</tbody>
</table> 	
</div>

<script>
	/* Table initialisation */
$(document).ready(function() {
	//datatables settings 
	$("#test1").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');
	} );
</script>