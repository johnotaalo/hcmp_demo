<style type="text/css" title="currentStyle">
				@import "<?php echo base_url(); ?>DataTables-1.9.3/media/css/jquery.dataTables.css";
		</style>
		
		<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>DataTables-1.9.3/media/js/jquery.dataTables.js"></script>
		<script type="text/javascript" charset="utf-8">
			/* Formating function for row details */
			function fnFormatDetails ( oTable, nTr )
			{
				var aData = oTable.fnGetData( nTr );			
				var url = "<?php echo base_url().'report_management/get_facility_evaluation_data/'?>"+aData[1];	
				
		$.ajax({
		type: "POST",
		url: url,
		async: "false",
		beforeSend: function() {
		},
		success: function(msg) {			
		test=msg;			
		}
		});
	  
				return test;
			}
			
			$(document).ready(function() {
				/*
				 * Insert a 'details' column to the table
				 */
				var nCloneTh = document.createElement( 'th' );
				var nCloneTd = document.createElement( 'td' );
				nCloneTd.innerHTML = '<img src="<?php echo base_url(); ?>DataTables-1.9.3/examples/examples_support/details_open.png">';
				nCloneTd.className = "center";
				
				$('#example thead tr').each( function () {
					this.insertBefore( nCloneTh, this.childNodes[0] );
				} );
				
				$('#example tbody tr').each( function () {
					this.insertBefore(  nCloneTd.cloneNode( true ), this.childNodes[0] );
				} );
				
				/*
				 * Initialse DataTables, with no sorting on the 'details' column
				 */
				var oTable = $('#example').dataTable( {
					"bJQueryUI": true,
					"aoColumnDefs": [
						{ "bSortable": false, "aTargets": [ 0 ] }
					],
					"aaSorting": [[1, 'asc']]
					
				});
				
				/* Add event listener for opening and closing details
				 * Note that the indicator for showing which row is open is not controlled by DataTables,
				 * rather it is done here
				 */
				$('#example tbody td img').live('click', function () {
					var nTr = $(this).parents('tr')[0];
					if ( oTable.fnIsOpen(nTr) )
					{
						/* This row is already open - close it */
						this.src = "<?php echo base_url(); ?>DataTables-1.9.3/examples/examples_support/details_open.png";
						oTable.fnClose( nTr );
					}
					else
					{
						/* Open this row */
						this.src = "<?php echo base_url(); ?>DataTables-1.9.3/examples/examples_support/details_close.png";
						oTable.fnOpen( nTr, fnFormatDetails(oTable, nTr), 'details' );
					}
				} );
			} );
		</script>
		<table cellpadding="0" cellspacing="0" border="0" class="display" id="example" width="100%">
	<thead>
		<tr>
			<th>Mfl No</th>
			<th>Facility Name</th>
			<th>No. Users</th>
			<th># No Responses</th>
		
		</tr>
	</thead>
	<?php 
	echo $facility_response;
	?>
	<tbody>
		
	</tbody>
</table>