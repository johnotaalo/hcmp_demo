<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
<script type="text/javascript" charset="utf-8">
			
			$(document).ready(function() {
					/* Build the DataTable with third column using our custom sort functions */
				$('#example_main').dataTable( {
					"bJQueryUI": true,
					"bPaginate": false,
					 "aaSorting": [[ 3, "asc" ]]
				} );
				
			$(".ajax_call_1").click(function(){
							var id  = $(this).attr("id"); 
							
							
							alert(id);
							//if(id=="county_facility"){
								
  	                     //    var url= $(this).attr("name"); 
  	
  	                   //  ajax_request_special (url);
  	                //  return;
                      //  }
	
	});
	
	
		function ajax_request_special (url){
	var url =url;
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $("#dialog").html("");
          },
          success: function(msg) {

        	
        	$('#dialog').html(msg);
            $( "#dialog" ).dialog({
			height: 650,
			width:900,
			modal: true
		});
          }
        }); 
}
	
			}
	);
	</script>
	<?php echo $stats_data; ////// ?>
			<table  style="margin-left: 0;" id="example_main" width="100%">
					<thead>
					<tr>
						<th><b>MFL Code</b></th>
						<th><b>Facility Name</b></th>
						 <th><b>Owner</b></th>
						<th><b>Facility Status</b></th>
						<th><b>No. Facility Users</b></th>
						<th><b>No. Facility Users Online</b></th>				    
					</tr>
					</thead>
					<tbody>
		<?php echo $table_body; ?>
							
				</tbody>
						
						
				</table>