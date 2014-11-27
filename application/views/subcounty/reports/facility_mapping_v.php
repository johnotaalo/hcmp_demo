<h1 class="page-header" id="page-header1" style="margin: 0;font-size: 1.6em;"></h1>
<div id="notification_"></div>
<script>
 $(document).ready(function () {
  		$('#page-header1').html('Roll out at a glance');
 		$('#roll_out').parent().parent().parent().addClass('active-panel');
		ajax_request_replace_div_content('reports/get_sub_county_facility_mapping_data',"#notification_");
 		//roll out function
		$("#roll_out").on('click', function(){
		$("#page-header1").html("Roll out at a glance");
		$('#notification_').html('');
		active_panel(this);
		  ajax_request_replace_div_content('reports/get_sub_county_facility_mapping_data',"#notification_");
		});
		//expiries function
		$("#subcounities").on('click', function(){
		$("#page-header1").html("Sub counties in the county");
		active_panel(this);
		$('#notification_').html('');

		});

		$(".ajax_call").click(function(){
		$("#page-header1").html("Facilities in "+$(this).html()+" subcounty");
		var url = 'reports/get_district_facility_mapping_/';	
		var id  = $(this).attr("id"); 
		ajax_request_replace_div_content(url+id,'#notification_');					
	    });
	    
	    $("#notification_").on('change', '.checkbox',function() {
		var selector_object=$(this);
		var id=selector_object.attr("id");
		var type=selector_object.attr("name");
		var data=null;
		var thisTr = $(this).closest('tr');
		var url = "<?php echo base_url('reports/set_tragget_facility')?>/";
    	if(this.checked) {
        //save the data in the db 
        if(type=='using_hcmp'){
    	thisTr.find("td:nth-child(5)").html("<span class='label label-success'>Active</span>");
    	thisTr.find("td:nth-child(8)").html("<?php echo date('d M Y') ?>");
    	}              	  
   	 	ajax_simple_post_with_console_response(url+id+"/"+1+"/"+type, data);	
    	} else{	
        //save the data in the db          	  
    	ajax_simple_post_with_console_response(url+id+"/"+0+"/"+type, data);
    	if(type=='using_hcmp'){
    	thisTr.find("td:nth-child(5)").html("<span class='label label-warning'>Inactive</span>");
    	}	  	
    }
    });
 });
</script>