<style type="text/css" title="currentStyle">
			@import "<?php echo base_url()?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
		</style>
        <script src="<?php echo base_url()?>DataTables-1.9.3/media/js/jquery.dataTables.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url()?>DataTables-1.9.3/media/js/jquery.validate.js" type="text/javascript"></script>

    
        
        
        <script type="text/javascript" charset="utf-8">
		    $(document).ready(function () {
		    	
		    	
		    	 $(".user_profile" ).click(function() {	
		    	 		var id  = $(this).attr("user_id");   	
		  
          var url = "<?php echo base_url().'user_management/get_user_profile/' ?>"+id
         
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
		    	
		    	$( "#dialog1" ).dialog({
			height: 140,
			modal: true
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
		    	
		    	
		   $("#email").live("click keyup", function(event){
		   	var email=encodeURI($(this).val());
		   	 var url = "<?php echo base_url().'user_management/check_user_email' ?>"+'/'+email;
		   	 
          $('#user_name').val(email);
          ajax_request (url);
                    }); 	

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
                     		
                     		window.location = "<?php echo base_url(); ?>user_management/dist_manage";
                     		break;
                     	}
                     	
              
                            
                     }
        }); 
}             
		    	
		    	
		    	
		        $('#example').dataTable({
		        	                "bJQueryUI": true,		
									"bProcessing": true
									});
									
									
							
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
		<div id="dialog"></div>
	
		<?php $attributes = array( 'name' => 'myform', 'id'=>'formEditData','class'=>'form_settings', 'title'=>'Create New User');
	 echo form_open('user_management/create_new_facility_user',$attributes); ?>
		
		
  <p><span>First Name</span><input type="text" name="f_name" id="f_name" required="required" /><b class="super">*</b></p> 
<p><span>Other Name</span><input type="text" name="o_name" id="o_name" /><b class="super">*</b></p>
     	 <p><span>Email</span><input type="text" name="email" id="email" size="50" required="required" placeholder="someone@mail.com" /><b class="super">*<div style="font-size: 0.9em;" id="feedback"></div></b></p>
   <p><span>User Name</span><input class="user" type="text" name="user_name" id="user_name" readonly="readonly"/> </p>
   <p><span>Phone No</span><input type="text" name="phone_no"  id="phone_no" required="required" placeholder="254...."/> <b class="super">*</b></p>
       <p><span>Facility Name</span>
        
	<select name="facility_code" id="facility_code"  rel="3" /><b class="super">*</b>
		<?php 
		foreach($facilities as $facility1){
			echo "<option value=$facility1->facility_code>$facility1->facility_name</option>";
			
		}
		?>
	</select>
	</p>
	
<p><span>User Type</span>
	<select name="user_type" id="user_type"><b class="super">*</b>
		<?php 
		foreach($user_type as $data){
			echo "<option value=$data->id>$data->level</option>";
			
		}
		?>
		</select>
       </p>
     
        
         <p><span>Status</span>
	<select name="status" id="status" rel="8">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
        </select>
      </p>
				
</form>
<input  class="btn btn-primary" id="new_user" style="margin-bottom: 1em;"  value="Add A New User" >
<br />
<table width="100%" id="example">
	<thead>
	<tr>
		<th>User ID</th>
		<th>First Name </th>
		<th>Other Name</th>
		<th>Facility Name</th>
		<th>User Type</th>
		<th>Email</th>
		<th>Username</th>
		<th>Telephone</th>
		<th>Status</th>
		<th>Actions</th>		
	</tr>
	</thead>
	<tbody>
	<?php
		foreach($result as $row){
	   
?>
	<tr id="<?php echo $row->id;?>">
		<td><?php echo $row->id;?></td>
		<td><?php echo $row->fname;?></td>
		<td><?php echo $row->lname;?></td>
		<td><?php 
		foreach($row->Codes as $facility)
		{echo  $facility->facility_name;}
		 ?></td>
		 <td>
		 	<?php 
		foreach($row->u_type as $test){echo  $test->level;}
		 ?>
		 </td>
		<td><?php echo $row->email;?></td>
		<td><?php echo $row->username;?></td>
		<td><?php echo $row->telephone ?></td>
		<td><?php if ($row->status==1) {
			echo 'Active';
		} else {
			echo 'Inactive';
		}
		 ?></td>
		
		
		<td><?php echo "<a href='#' class='user_profile link' id='user_profile' user_id='$row->id'>Edit</a> | 
		<a href='#' class='ulink link' id='$row->id' title='reset'>Reset Password</a> | <a href='#' class='ulink link' id='$row->id' title='delete'>DELETE</a> |" ?>
		
		<?php if ($row->status==1) {
			echo "<a href='#' class='ulink link' id='$row->id' title='deactive'>Deactivate</a>";
		} else {
			echo "<a href='#' class='ulink link' id='$row->id' title='active'>Activate</a>";
		}
		 ?>
		
		</td>
		
		
	</tr> 
	<?php
		}
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

