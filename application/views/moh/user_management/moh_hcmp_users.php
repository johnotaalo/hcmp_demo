		<style type="text/css" title="currentStyle">
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
        <script src="<?php echo base_url()?>DataTables-1.9.3/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
<script>
	$(document).ready(function () {
		
	   	 $("#formEditData").validate({
      rules: {
         f_name:  "required",
          o_name:  "required",
          email:   { required: true, email: true },
          phone_no:  "required",
          user_type:  "required"
         },
         messages: {
            f_name: "Required Field",
            o_name: "Required Field",
            phone_no: "Required Field",
            email: "Input the correct format",
            user_type: "Required Field",
         }
     });
		    	
		    	
		    	//email bind event 
		   $("#email").live("click keyup", function(event){
		   	var email=encodeURI($(this).val());
		   	 var url = "<?php echo base_url().'user_management/check_user_email' ?>"+'/'+email;
		   	 
          $('#user_name').val(email);
          ajax_request (url);
                    }); 	
////change password disable enable bind event 

		    	$(".ulink").click(function(){
		    			
                   var status=false;
                	var id  = $(this).attr("id"); 
		    		var title=$(this).attr("title");		
		            var url = "<?php echo base_url().'user_management/reset_user_variable' ?>"+'/'+title+"/"+id;
		         
                 
                 var r=confirm("Please confirm");
                if (r==true)
                 {
                   ajax_request (url)	;
                    }
                   else
                      {
  
                         }

		    	});
		    	
//data table set up
		        $('#example').dataTable({
		        	                "bJQueryUI": true,		
									"bProcessing": true
									})
							
							
					$( "#formEditData" ).dialog({
		    autoOpen: false,
			height: 450,
			width: 800,
			modal: true,
			buttons: {
				"Confirm": function() {
           $('#formEditData').submit();
           $(this).dialog( "close" );
           $('#user_processing').modal({ keyboard: false });
				},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				
			}
			});	
			
			
			$( "#new_user" )
			.button()
			.click(function() {
				$( "#formEditData" ).dialog( "open" );
			});
							
									
			/////ajax request function 
			  	function ajax_request (url){
	            var url =url;
	           $.ajax({
                     type: "POST",
                     url: url,
                     beforeSend: function() {
                  $('#feedback').html('');
                      },
                     success: function(msg) {
                     	
                     	
                     	switch (msg){
                     		case 'User name is available':
                     		$('#feedback').html("<label class='error_2'>"+msg+"</label>");
                     		break;
                     		case 'User name is already in use':
                     		$('#feedback').html("<label class='error'>"+msg+"</label>");
                     		case 'Blank email':
                     		return
                     		break;
                     		default:
                     		window.location = "<?php echo base_url(); ?>user_management/moh_manage";
                     		break;
                     	}
                     	
              
                            
                     }
                    }); 
                     }

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
		<style>
			.user{
	background : none;
	border : none;
	text-align: center;
	}
			
			 .form_settings { 
  margin: 15px 0 0 0;
  font-size: 14px;
  font-family: 'trebuchet MS', 'Lucida sans', Arial;
}

.form_settings p { 
  padding: 0 0 4px 0;
}
			 
			 .form_settings span { 
  float: left; 
  width: 20%; 
  text-align: left;
}
  
.form_settings input, .form_settings textarea , .form_settings select { 
  padding: 5px; 
  width: 50%; 
  font: 100% arial; 
  border: 1px solid #D5D5D5; 
  color: #47433F;
  border-radius: 7px 7px 7px 7px;
  -moz-border-radius: 7px 7px 7px 7px;
  -webkit-border: 7px 7px 7px 7px;  
}

.super{
vertical-align: super;
padding-left: 0.3em;
color: #B70000;

			}
			
		</style> 

    <div class="dialogA">
  <?php $attributes = array( 'name' => 'myform', 'id'=>'formEditData','class'=>'form_settings', 'title'=>'Create New User');
	 echo form_open('user_management/create_new_facility_user',$attributes); ?>
    
    	
    	<p><span>First Name</span><input type="text" name="f_name" id="f_name" required="required" /><b class="super">*</b></p>
    	 <p><span>Other Name</span><input type="text" name="o_name" id="o_name" /><b class="super">*</b></p>
    	 <p><span>Email</span><input type="text" name="email" id="email" size="50" required="required" placeholder="someone@mail.com" /><b class="super">*<div style="font-size: 0.9em;" id="feedback"></div></b></p>
          
        
	      <p><span>User Name</span><input class="user" type="text" name="user_name" id="user_name" readonly="readonly"/> </p>

        <p><span>Phone No</span><input type="text" name="phone_no"  id="phone_no" required="required" placeholder="254...."/> <b class="super">*</b></p>
    	
       <p><span>User Type</span>
	<select name="user_type" id="user_type"><b class="super">*</b>
		<?php 
		foreach($user_type as $data1){
			echo "<option value=$data1->id>$data1->level</option>";
			
		}
		?>
		</select>
     </p>
		
		<p><span>Counties</span>
		<select id="counties" name="county" class="registerdropDown">
		<option>Select County</option>
		<?php 
		foreach ($counties as $counties) {
			$id=$counties->id;
			$county=$counties->county;?>
			<option value="<?php echo $id;?>"><?php echo $county;?></option>
		<?php }
		?>
	</select>
	</p>
	<p><span>District</span>
	<select id="districts" name="district" class="registerdropDown">
		<option>Select District</option>
	</select>
    	</p>

    </form>
    </div>
     <button class="btn btn-primary" id="new_user" style="margin-bottom: 1em;" >Add A New User</button>
    <table id="example" width="100%">
	       <thead>
			<tr>			
				<th>User Type</th>
				<th>Facility Name</th>
				<th>County</th>
				<th>District</th> 
				<th><strong>First Name</strong></th>
				<th><strong>Other Name</strong></th>				
				<th>Email</th>
				<th>Phone No</th>
				<th>Status</th>
				<th>Action</th>	
			</tr>
			</thead>
			<tbody>
			<?php foreach( $moh_users as $row):
				
		echo '<tr id="'.$row['id'].'" >
				<td>'.$row['level'].'</td>
				<td>'.$row['facility_name'].'</td>
				<td>'.$row['county'].'</td>
				<td>'.$row['district'].'</td>
				<td>'.$row['fname'].'</td><td> '.$row['lname'].' </td>
				<td>'.$row['email'].'</td>
				<td>'.$row['telephone'].'</td> 
				<td>'?><?php if ($row['status']==1){
					echo 'Active </td>';
				}else{
					echo 'In Active </td>';
				}?>
				<?php 
		echo "<td><a href='#' class='user_profile link' id='user_profile' user_id='".$row['id']."'>Edit</a> | 
		<a href='#' class='ulink link' id='".$row['id']."' title='reset'>Reset Password</a> | <a href='#' class='ulink link' id='".$row['id']."' title='delete'>DELETE</a> |" ?>
		
		<?php if ($row['status']==1) {
			echo "<a href='#' class='ulink link' id='".$row['id']."' title='deactive'>Deactivate</a>";
		} else {
			echo "<a href='#' class='ulink link' id='".$row['id']."' title='active'>Activate</a>";
		}?><?php echo '</td>
				
			</tr>';
	
 endforeach;
	?>
	</tbody>
		</table>
    
<!--------order processing data---------->
<div class="modal fade" id="user_processing" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
       
        <h2 class="modal-title">User Creation....</h2>
      </div>
      <div class="modal-body">
    
        <h2 class="label label-info">Please wait as the user is being created </h2><img src="<?php echo base_url().'Images/processing.gif' ?>" />
      </div>
      <div class="modal-footer">       
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

