<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>				
				<script type="text/javascript" charset="utf-8">
			
			$(function() {

				/* Build the DataTable with third column using our custom sort functions */
				$('#example').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false} );
				
				
			} );
			
			
	
			
		</script>

		<table  style="margin-left: 0;" id="example" width="100%">
					<thead>
					<tr>
						<th><b>MFL</b></th>
						<th><b>Facility Name</b></th>
						<th><b>Test Type</b></th>
						<th><b>MOS</b></th>
						<th><b>Test Done</b></th>
						<th><b>Quantity Requested</b></th>
						<th><b>Quantity Allocated</b></th>
						<th><b>Quantity Distributed</b></th>
										    
					</tr>
					</thead>
					<tbody>
		<?php 
			echo $table_body;
			
		 ?>
							
				</tbody>