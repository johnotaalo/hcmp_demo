<script>
	
	$(function() {
		
			

		$('#counties').click(function(){
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
			$("#districts").html("<option>Select District</option>");
			$("#facilities").html("<option>Select Health Facility</option>");
			json_obj={"url":"<?php echo site_url("order_management/getDistrict");?>",}
			var baseUrl=json_obj.url;
			var id=$(this).attr("value")
			dropdown(baseUrl,"county="+id,"#districts")
		});
		$('#districts').click(function(){
			/*
			 * when clicked, this object should populate facility names to facility dropdown list.
			 * Initially it sets a default value to the facility drop down list then ajax is used 
			 * is to retrieve the district names using the 'dropdown()' method used above.
			 */
			$("#facilities").html("<option>Select Health Facility</option>");
			json_obj={"url":"<?php echo site_url("order_management/getFacilities");?>",}
			var baseUrl=json_obj.url;
			var id=$(this).attr("value")
			dropdown(baseUrl,"district="+id,"#facilities")
		});
		$('#filter').click(function(){
			
		});
		function dropdown(baseUrl,post,identifier){
			/*
			 * ajax is used here to retrieve values from the server side and set them in dropdown list.
			 * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
			 * 'identifier' is the id of the dropdown list to be populated by values from the server side
			 */
			$.ajax({
			  type: "POST",
			  url: baseUrl,
			  data: post,
			  success: function(msg){
			  		var values=msg.split("_")
			  		var dropdown;
			  		for (var i=0; i < values.length-1; i++) {
			  			var id_value=values[i].split("*")
			  			dropdown+="<option value="+id_value[0]+">";
						dropdown+=id_value[1];
						dropdown+="</option>";
					};
					$(identifier).html(dropdown);
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
			});
		}
		
	});
	
</script>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="description" content="Fancy Sliding Form with jQuery" />
        <meta name="keywords" content="jquery, form, sliding, usability, css3, validation, javascript"/>
        
    </head>
    <div id="registerme">
    	<?php echo form_open('user_management/create_new_facility_user'); ?>
    <section id="registersec">
    	<h2>Account Details</h2>
    	<label>First Name</label>
    	<input type="text" class="validate[required]" name="f_name" placeholder="First Name" />
    	<label>Other Name</label>
    	<input type="text" class="validate[required]" name="o_name" placeholder="Other Name"  />
    	<label>Email</label>
    	<input type="email" class="validate[required,custom[email]]" placeholder="Johndoe@domain.com" name="email"/>
    	<label>Phone Number</label>
    	<input type="text"  name="phone_no" class="validate[custom[phone]]" placeholder="254xxxxxxxxx" />
    	
    	<label>User Type</label>
    	<select name="user_type" class="registerdropDown">
			<option >Select User Type</option>
			
			<?php 
		foreach ($level_l as $level_level) {
			$id=$level_level->id;
			$level=$level_level->level;
			$type=$level_level->type;
			?>
			<option value="<?php echo $id;?>"><?php echo $level;?></option>
		<?php }
		?>
			
		</select>
		

    	
    	
    	<button type="submit">Register</button>
    </section>
    
    
    
    </div>
    
</html>

