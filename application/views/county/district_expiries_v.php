<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
      
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
    </style>
<div>
<table class="data-table">	
	<tr>
		<th>MFL Code</th>
		<th>Facility Name</th>
		<th>Cost of Expiries</th>
		<th>Action</th>
	</tr>	
			
		<tbody>
			<?php echo $table_body2;?>
		</tbody>
	
</table>
</div>