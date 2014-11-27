<script type="text/javascript">
$(document).ready(function(){
	
	  $( "#dialog-confirm" ).dialog({
      resizable: false,
      autoOpen: false,
      height:140,
      modal: true,
      buttons: {
        "Delete all items": function() {
        	window.location="<?php echo site_url('stock_management/reset_facility_details');?>";	
          $( this ).dialog( "close" );
        },
        Cancel: function() {
          $( this ).dialog( "close" );
        }
      }
    });
	
		
	
	  
		
		   $("#user_profile" ).click(function() {		   	
		  
          var url = "<?php echo base_url().'user_management/get_user_profile' ?>"
         
          $.ajax({
          type: "POST",
          data: "ajax=1",
          url: url,
          beforeSend: function() {
            $("#dialog").html("");
          },
          success: function(msg) {
         
            $("#dialog").html(msg);
           
           
          }
        });
        return false;
        
                
            });
            
               $("#facility_reset" ).click(function() {		   	
		  
    $( "#dialog-confirm" ).dialog( "open" );
});
      
            
            
});
</script>
	<div id="dialog-confirm" title="Delete facility data?">
  <p><span class="ui-icon ui-icon-alert" style="float: left; margin: 0 7px 20px 0;"></span>All facility data will be permanently deleted and cannot be recovered!. Are you sure?</p>
</div>
	<div id="left_content">
		<div id="dialog"></div> 
		<fieldset>
		<legend>Actions</legend>
		<div class="activity edit">
	    <a href="<?php echo site_url('stock_management/get_facility_stock_details');?>"><h2>Edit stock details</h2>	</a>
		</div>
			<div class="activity update">
	    <a href="<?php echo site_url('stock_management/historical_stock_take');?>"><h2>Historical Stock Data</h2></a>
		</div>
		<div class="activity users">
		<a id="user_profile" href="#"><h2>User Profile</h2></a>
		</div>
		
	
		
			<div class="activity update">
	    <a id="facility_reset"><h2>Reset Facility Stock Data</h2></a>
		</div>
	
			<div class="activity update">
	    <a href="<?php echo site_url('stock_management/facility_add_stock_data');?>"><h2>Add Facility Stock Data</h2></a>
		</div>
		    <div class="activity update">
      <a href="<?php echo site_url('report_management/facility_evaluation');?>"><h2>Perform HCMP Training Evaluation</h2></a>
    </div>
		</fieldset>
	</div>