<script>


$(function() {

		// Accordion
		$("#accordion").accordion({
			header : "h3"
		});
		//tabs
		$('#tabs').tabs();
	});
	
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
		$('#counties').click(function(){
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
			$("#districts").html("<option>--disticts--</option>");
			$("#facilities").html("<option>--facilities--</option>");
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
			$("#facilities").html("<option>--facilities--</option>");
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
<div id="tabs">
	<!--tabs!-->
	<ul>
		<li>
			<a href="#tabs-1">Register Dictrict Admin</a>
		</li>
		<li>
			<a href="#tabs-2">Register MOH User</a>
		</li>
		
	</ul>
	<div id="tabs-1">
		<!--tab1 content!-->
<?php echo form_open('user_registration/submit'); ?>

				<table class="data-table" width="700">
	
	
	<?php echo validation_errors('<p class="error">','</p>'); ?>
	<tr><p>
		<td><label for="fname">First Name:</label></td>
		<td><?php echo form_input('fname',set_value('fname')); ?></td>
	</p>
	</tr>
	<tr><p>
		<td><label for="fname">Other Names:</label></td>
		<td><?php echo form_input('lname',set_value('lname')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="fname">Mobile Number:</label></td>
		<td><?php echo form_input('tell',set_value('tell')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="email">E-mail: </label></td>
		<td><?php echo form_input('email',set_value('email')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="username">Username: </label></td>
		<td><?php echo form_input('username',set_value('username')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="password">Password: </label></td>
		<td><?php echo form_password('password'); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="passconf">Confirm Password: </label></td>
		<td><?php echo form_password('passconf'); ?></td>
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
		<option>--counties--</option>
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
		<option>--disticts--</option>
	</select></td>
	</tr>
	
	<tr><p>
		<td><?php echo form_submit('submit','Create my account'); ?></td>
	</p></tr>
	<?php echo form_close(); ?>
	</table>
			


<div class="pagination"></div>
	</div><!--tab1!-->
	<div id="tabs-2">
		<!--tab 2 content!-->
		
		<?php echo form_open('dist_registration/submit'); ?>

				<table class="data-table" width="500">
	
	
	<?php echo validation_errors('<p class="error">','</p>'); ?>
	<tr><p>
		<td><label for="fname">First Name:</label></td>
		<td><?php echo form_input('fname',set_value('fname')); ?></td>
	</p>
	</tr>
	<tr><p>
		<td><label for="fname">Other Names:</label></td>
		<td><?php echo form_input('lname',set_value('lname')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="fname">Mobile Number:</label></td>
		<td><?php echo form_input('tell',set_value('tell')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="email">E-mail: </label></td>
		<td><?php echo form_input('email',set_value('email')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="username">Username: </label></td>
		<td><?php echo form_input('username',set_value('username')); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="password">Password: </label></td>
		<td><?php echo form_password('password'); ?></td>
	</p></tr>
	<tr><p>
		<td><label for="passconf">Confirm Password: </label></td>
		<td><?php echo form_password('passconf'); ?></td>
	</p></tr>
	
	<tr><p>
		<td><?php echo form_submit('submit','Create my account'); ?></td>
	</p></tr>
	<?php echo form_close(); ?>
	</table>
		
<div class="ui-accordion-content"></div>
		<!--tab 2 ui-accordion-content!-->
	</div><!--tab 2 content!-->