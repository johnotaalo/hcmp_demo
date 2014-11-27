<script>
$(document).ready(function(){
	$("#dialog" ).dialog({
		  
            title: "User Details",
			 autoOpen: true,
			height: 450,
			width: 800,
			buttons: {
				"Update": function() {	
					$(this ).dialog( "close" );
					 $('#myform').submit();
					},
				Cancel: function() {
					$( this ).dialog( "close" );
				}
			},
			close: function() {
				  
				
			}
		});
		
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
		   $("#email_").live("click keyup", function(event){
		   	var email=encodeURI($(this).val());
		   	 var url = "<?php echo base_url().'user_management/check_user_email' ?>"+'/'+email;
		   	 
          $('#user_name_').val(email);
          ajax_request (url);
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
                     		$('#feedback_').html("<label class='error_2'>"+msg+"</label>");
                     		break;
                     		case 'User name is already in use':
                     		$('#feedback_').html("<label class='error'>"+msg+"</label>");
                     		case 'Blank email':
                     		return
                     		break;
                     		default:
                     		 alert(msg);
                     	}
                     	
              
                            
                     }
                    }); 
                     }  
                     
                  });
</script>
<style>
label{font-size: 1.0em;}
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
		<div id="dialog">
<?php $attributes = array( 'name' => 'myform', 'id'=>'myform','class'=>'form_settings', 'title'=>'User Details');
	 echo form_open('user_management/edit_user_profile',$attributes); ?>

      <p><span>First Name</span><input type="text" name="f_name" id="f_name" required="required" value="<?php echo $user_data[0]['fname'] ?>" /><b class="super">*</b></p> 
	 <input type="hidden" name="user_id" value="<?php echo $user_data[0]['id'] ?>" />
      
        <p><span>Other Name</span><input type="text" name="o_name" id="o_name" value="<?php echo $user_data[0]['lname'] ?>" /><b class="super">*</b></p>
        <p><span>Email</span><input type="text" name="email" id="email_" size="50" required="required" placeholder="someone@mail.com" value="<?php echo $user_data[0]['email'] ?>" /><b class="super">*</b></p>
           <p> <label id="feedback_"></label><input type="hidden" /></p>
        
	      <p><span>User Name</span><input class="user" type="text" name="user_name" value="<?php echo $user_data[0]['email'] ?>" id="user_name_" readonly="readonly"/> </p>

        <p><span>Phone No</span><input type="text" name="phone_no"  id="phone_no" required="required" value="<?php echo $user_data[0]['telephone'] ?>" placeholder="254...."/> <b class="super">*</b></p>
</form>
</div>