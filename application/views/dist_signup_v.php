<!--Validation Scripts-->
<link href="<?php echo base_url().'CSS/jquery.validate.css'?>" type="text/css" rel="stylesheet"/> 
<script src="<?php echo base_url().'Scripts/jquery.validate.js'?>" type="text/javascript"></script> 

<script>
	$(function() {
		$("#year").change(function() {
			var selected_year = $(this).attr("value");
			//Get the last year of the dropdown list
			var last_year = $(this).children("option:last-child").attr("value");
			//If user has clicked on the last year element of the dropdown list, add 5 more
			if($(this).attr("value") == last_year) {
				last_year--;
				var new_last_year = last_year - 5;
				for(last_year; last_year >= new_last_year; last_year--) {
					var cloned_object = $(this).children("option:last-child").clone(true);
					cloned_object.attr("value", last_year);
					cloned_object.text(last_year);
					$(this).append(cloned_object);
				}
			}
		});
		$("#accordion").accordion({
			autoHeight : false,
			active: false,
			collapsible: true
		});	
		$('#username').click(function(){
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
			var code= $("#username").val();
			$("#username").html();
			
			json_obj={"url":"<?php echo site_url("user_management/username");?>",}
			var baseUrl=json_obj.url;
			var id=$(this).attr("value")
			//alert(code);
			dropdownu(baseUrl,"username="+id)
		});
		
		function dropdownu(baseUrl,post,identifier){
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
			  	//alert(msg);
			  	if(msg==""){
			  		return;
			  	}else{
			  		alert('Sorry username is already in use. Please try another')
			  	}
					$(identifier).html(dropdown);
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
			});
		}
		$('#counties').click(function(){
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
			$("#districts").html("<option>--Disticts--</option>");
			$("#facilities").html("<option>--Facilities--</option>");
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
			$("#facilities").html("<option>--Facilities--</option>");
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
<script type="text/javascript">
            /* <![CDATA[ */
            jQuery(function(){
                jQuery("#ValidNumber").validate({
                    expression: "if (!isNaN(VAL) && VAL) return true; else return false;",
                    message: "Should be a number"
                });
                jQuery("#Email").validate({
                    expression: "if (VAL.match(/^[^\\W][a-zA-Z0-9\\_\\-\\.]+([a-zA-Z0-9\\_\\-\\.]+)*\\@[a-zA-Z0-9_]+(\\.[a-zA-Z0-9_]+)*\\.[a-zA-Z]{2,4}$/)) return true; else return false;",
                    message: "Should be a valid Email id"
                });
                jQuery("#ValidNumber").validate({
                    expression: "if (VAL > 100) return true; else return false;",
                    message: "Should be greater than 100"
                });
                jQuery("#Mobile").validate({
                    expression: "if (VAL.match(/^[254][0-9]{11}$/)) return true; else return false;",
                    message: "Should be a valid Mobile Number"
                });
                jQuery("#ValidField").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Required field"
                });
                jQuery("#ValidField1").validate({
                    expression: "if (VAL) return true; else return false;",
                    message: "Please enter the Required field"
                });
                 jQuery("#ValidPassword").validate({
                    expression: "if (VAL.length > 5 && VAL) return true; else return false;",
                    message: "Please enter a valid Password"
                });
                jQuery("#ValidConfirmPassword").validate({
                    expression: "if ((VAL == jQuery('#ValidPassword').val()) && VAL) return true; else return false;",
                    message: "Confirm password field doesn't match the password field"
                });
            });
            /* ]]> */
        </script>
        <script>
        function callme() {
        	//var a= field.value;
        	var user= $('#ValidField').val().substr(0,1);
        	var user2= $('#ValidField1').val();
        	var userCom=(user + user2);
        	//alert(userCom);
            $('input:text[name=username]').val(userCom);
            
        }
        </script>
<?php echo form_open('district_registration/submit'); ?>

				<table class="data-table" width="800">
	
	
	<?php echo validation_errors('<p class="error">','</p>'); ?>
	<tr><p>
		<td><label for="fname">First Name:</label></td>
		<td><input type="text" name="fname" id="ValidField" /></td>
	</p>
	</tr>
	<tr><p>
		<td><label for="fname">Other Names:</label></td>
		<td><input type="text" name="lname" id="ValidField1" onblur="callme(this);" /></td>
	</p></tr>
	<tr><p>
		<td><label for="fname">Mobile Number: eg 254728242546</label></td>
		<td><input type="text" name="tell" id="Mobile" /></td>
	</p></tr>
	<tr><p>
		<td><label for="email">E-mail: </label></td>
		<td><input type="text" name="email" id="Email" /></td>
	</p></tr>
	<tr><p>
		<td><label for="username">Username: </label></td>
		<td><input type="text" name="username"  /></td>
	</p></tr>
	<tr><p>
		<td><label for="password">Password: </label></td>
		<td><input type="password" name="password" id="ValidPassword" /></td>
	</p></tr>
	<tr><p>
		<td><label for="passconf">Confirm Password: </label></td>
		<td><input type="password" name="passconf" id="ValidConfirmPassword" /></td>
	</p></tr>
	<tr><p>
		<td><label for="typr">User Type :</label></td>
		
		<td><select name="type" >
			<option >---Select USer Type---</option>
			
			<?php 
		foreach ($level_l as $level_level) {
			$id=$level_level->id;
			$level=$level_level->level;
			$type=$level_level->type;
			?>
			<option value="<?php echo $type;?>"><?php echo $level;?></option>
		<?php }
		?>
			
		</select></td>
	</p></tr>
	<tr>
	<td><label>County</label></td>
	<td><select id="counties">
		<option>--Counties--</option>
		<?php 
		foreach ($counties as $counties) {
			$id=$counties->id;
			$county=$counties->county;?>
			<option value="<?php echo $id;?>"><?php echo $county;?></option>
		<?php }
		?>
	</select></td>
	<tr>
	<td><label>District</label></td>
	<td><select id="districts" name="district">
		<option>--Disticts--</option>
	</select></td>
	</tr>
	<tr>
	<td><label>Facility</label></td>
	<td><select id="facilities" name="facility">
		<option>--Facilities--</option>
	</select></td>
	
	</tr>
	<tr><p>
		<td><?php echo form_submit('submit','Create my account'); ?></td>
	</p></tr>
	<?php echo form_close(); ?>
	</table>