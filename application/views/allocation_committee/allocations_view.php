
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			.user2{
	width:70px;
	
	text-align: center;
	}
	 #allocated{
	 	background: #D1F8D5;
        }
		</style>	 
				<script type="text/javascript" charset="utf-8">
				function downloadcounty(id){
					alert(id);
				}
			
			$(function() { 

				/* Build the DataTable with third column using our custom sort functions */
				$('#allocated').dataTable( {
					"bJQueryUI": true,
					"aaSorting": [[ 10, "desc" ]],
					"bPaginate": false} );				
					$( "#allocate" )
			.button()
			.click(function() {
				  $('#myform').submit();
				
});	
								
			} );
			
			</script>
			<div id="inner_wrapper"> 
			<div>
				
			</div>
			<div class="dash_main" style="width: 80%;float: right;">
<table id="allocated" class="data-table"> 
<thead>
	<th>
	County 
	</th>
	<th>
		Reporting Period 
	</th>
		<th>
		Allocated Facilities/ total
	</th>
	<th>
		Allocations
	</th>
	<th>Action</th>
 
</thead>
<?php
echo($tdata);
?>
</table></div>
</div>
