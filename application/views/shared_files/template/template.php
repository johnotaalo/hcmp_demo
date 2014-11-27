<?php session_start();
if (!$this -> session -> userdata('user_id')) {
  redirect("user");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP | <?php echo $title;?> </title>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/> 
	<link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/sweetalert/lib/sweet-alert.css'?>" />
  <link rel="stylesheet" href="<?php echo base_url().'assets/bower_components/alertifyjs/dist/css/alertify_bootstrap_3.css'?>" />
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
	<link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/bower_components/sweetalert/lib/sweet-alert.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/bower_components/alertifyjs/dist/js/alertify.js'?>" type="text/javascript"></script>
  
  <link href="<?php echo base_url().'assets/bower_components/intro.js/introjs.css'?>" type="text/css" rel="stylesheet"/>
	<!-- <link href="<?php echo base_url().'assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script>
   
   paceOptions = {
  ajax: false, // disabled
  document: true, // 
  eventLag: true,
  restartOnPushState: false,
  elements:{
  	selectors:['body']
  } // 
  
};
 
    function load(time){
      var x = new XMLHttpRequest()
      x.open('GET', document.URL , true);
      x.send();
    };

    

    setTimeout(function(){
      Pace.ignore(function(){
        load(3100);
      });
    },4500);

    Pace.on('hide', function(){
   //   console.log('done');
    });

    var url="<?php echo base_url(); ?>";
    </script>
    <style>
.panel-success>.panel-heading {
color: white;
background-color: #528f42;
border-color: #528f42;
border-radius:0;

}
.navbar-default {
background-color: white;
border-color: #e7e7e7;
}
.modal-content,.form-control
{
  border-radius: 0 !important;
}


</style>
  </head>  
  <body screen_capture_injected="true" onload="set_interval()" onmouseover="reset_interval()" onclick="reset_interval()">
    <!-- Fixed navbar -->
    
   <div class="navbar navbar-default navbar-fixed-top" id="welcome">
   <div class="container" style="width: 100%; padding-right: 0; ">
        <div class="navbar-header "  > 
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
         
            <a href="<?php echo base_url().'Home';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms-resized1.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
				    <div id="logo_text" style="display:inline-block;">
					<span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
					<span style="font-size: 0.85em;">Health Commodities Management Platform (HCMP)</span>	
				</div>
        </div>
        <div class="navbar-collapse collapse" style="" id="navigate">
          <ul class="nav navbar-nav navbar-right" id="nav-here">
       <li><a href="<?php echo site_url().'home';?>" class=" ">HOME</a> </li>   
<?php
//Retrieve all accessible menus/submenus from the session
$menus= $this -> session -> userdata('menus');
$sub_menus= $_SESSION["submenus"];

//Loop through all menus to display them in the top panel menu section
foreach($menus as $menu){ $menu_id=(int)$menu['menu_id'];?> 
	<li class="" >
            	<a id="sub" href="<?php echo site_url($menu['menu_url']); ?>" class=""><?php echo $menu['menu_text']?></a>            	
            	<ul class="dropdown-menu" style="min-width: 0" >
            	<?php 
            	foreach($sub_menus as $sub_menu){
            		if ($menu_id==(int)$sub_menu['menu_id']) {?>						
		<li><a style="background: whitesmoke;color: black !important"  href="<?php echo base_url().$sub_menu['submenu_url']?>"><?php echo $sub_menu['submenu_text']?></a></li>
					<?php	
            	} 
				}
            	?>
            </ul>
	</li>	 
<?php }?>
 <li><a href="<?php echo site_url("reports/commodity_listing");?>" class="">COMMODITY LIST</a> </li>
            <li class="dropdown " id="drop-step">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ></span><?php echo $this -> session -> userdata('full_name');?> <b class="caret"></b></a>
              <ul class="dropdown-menu" >
                <li><a style="background: whitesmoke;color: black !important" href="" data-toggle="modal" data-target="#changepassModal"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%; "></span>Change password</a></li>               
                <li><a style="background: whitesmoke;color: black !important" href="<?php echo site_url("user/logout");?>" ><span class="glyphicon glyphicon-off" style="margin-right: 2%;"></span>Log out</a></li>
                <li ><a style="background: whitesmoke;color: black !important" href="javascript:void(0);" onclick="startIntro();" ><span class="glyphicon glyphicon-question-sign" style="margin-right: 2%;"></span>Help</a></li>               
              </ul>
            </li>
          </ul>
    
      				<?php $flash_success_data = NULL;
					      $flash_error_data = NULL;
	                      $flash_success_data = $this -> session -> flashdata('system_success_message');
						  $flash_error_data = $this -> session -> flashdata('system_error_message');
							if ($flash_success_data != NULL) { ?>
								
								<script>
									$(document).ready(function() {
											alertify.set({ delay: 10000 });
											alertify.success("<?php echo $flash_success_data ?>", null);
		
										});
										
								</script>
							
						 <?php  } elseif ($flash_error_data != NULL) { ?>
						 	
						 		<script>
									$(document).ready(function() {
											alertify.set({ delay: 10000 });
											alertify.error("<?php echo $flash_error_data  ?>", null);
		
										});
										
								</script>
							
						<?php 	}
						   elseif (isset($system_error_message)) {?>
						   	
						   		<script>
									$(document).ready(function() {
											alertify.set({ delay: 10000 });
											alertify.log("<?php echo $system_error_message   ?>", null);
		
										});
										
								</script>
							
						<?php	}
 						?>
 
         </div><!--/.nav-collapse -->
      </div>
      <div class="container-fluid" style="/*border: 1px solid #036; */ height: 30px;" id="extras-bar">
      	<div class="row">
      		
      		<div class="col-md-4" style="font-weight:bold; ">
      		<span style="margin-left:2%;">  <?php echo $this -> session -> userdata('banner_name')." | ". $banner_text;?> </span>
      		 	
     		</div>
      		<div class="col-md-4">     			
      		</div>
      		<div class="col-md-4"  style="text-align: right;">
      			<?php  echo date('l, jS F Y'); ?>
             <span id="clock" style="font-size:0.85em; " ></span>
      		</div>
      	</div>      	
      </div>	
      </div>

    <div class="container-fluid" style="" id="main-content">
<!----------- HCMP MODAL dialog Box for all uses--------->
<div class="modal fade" id="communication_dialog" tabindex="-1" role="dialog"
 aria-labelledby="myModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title">HCMP: Notification Message</h4>
      </div>
      <div class="modal-body" style="max-height: 500px; overflow-y: auto">   
      </div>
      <div class="modal-footer">         
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div>
<!-- /.modal -->   
    <?php $this -> load -> view($content_view);?>
    </div> <!-- /container -->
   <div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
    
    <!-- Modal -->
<div class="modal fade" id="changepassModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" style="width: 35%;">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Change Password</h4>
      </div>
        
      <div class="modal-body">
        <div id="login" >

	<div class= "row">
    	<div class="col-md-11" >	
  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputpassword1">Old\Current Password </label>
    
    <input type="password" class="form-control input-lg" name="current_password" id="current_password" placeholder="Current Password" required="required">
    
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"></div>
  </div>

    <div class= "row">
    	<div class="col-md-11" >	
  <div class="form-group" style="margin-bottom: 2em;">
    <label for="exampleInputPassword1">New Password</label>
    <input type="password" class="form-control input-lg" name="new_password" id="new_password" placeholder="New Password" required="required">
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"><span class="error" id="result" style="margin-top: 50% !important;"></span></div>
  </div>

	<div class="row">
	<div class="col-md-11" >	
  <div class="form-group" >
    <label for="exampleInputPassword1">Confirm New Password</label>
    <input type="password" class="form-control input-lg" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm Password" required="required">
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"><span class="error" id="confirmerror" style="padding-top: 60%;"></span></div>
  
  </div>
  <div class="row">
  	<div class="col-md-12">
  		<div class="form-group" >
  	<div id="new_error"></div>
  </div>
  	</div>
  </div>
  
</div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-success" id="change">Save changes</button>
        
      </div>
    </div>
  </div>
</div>
    <script type="text/javascript">
    
    /*
 * Auto logout
 */
var timer = 0;
function set_interval() {
  showTime();
  // the interval 'timer' is set as soon as the page loads
  timer = setInterval("auto_logout()", 3600000);
  // the figure '1801000' above indicates how many milliseconds the timer be set to.
  // Eg: to set it to 5 mins, calculate 3min = 3x60 = 180 sec = 180,000 millisec.
  // So set it to 180000
}

function reset_interval() {
  showTime();
  //resets the timer. The timer is reset on each of the below events:
  // 1. mousemove   2. mouseclick   3. key press 4. scroliing
  //first step: clear the existing timer

  if(timer != 0) {
    clearInterval(timer);
    timer = 0;
    // second step: implement the timer again
    timer = setInterval("auto_logout()", 3600000);
    // completed the reset of the timer
  }
}

function auto_logout() {

  // this function will redirect the user to the logout script
  window.location = "<?php echo base_url(); ?>user/logout";
}

/*
* Auto logout end
*/
  function showTime()
{
var today=new Date();
var h=today.getHours();
var m=today.getMinutes();
var s=today.getSeconds();
// add a zero in front of numbers<10
h=checkTime(h);
m=checkTime(m);
s=checkTime(s);
$("#clock").text(h+":"+m);
t=setTimeout('showTime()',1000);

}
function checkTime(i)
{
if (i<10)
  {
  i="0" + i;
  }
return i;
}  
	
</script>

<script>
	$(document).ready(function() {
 changeHashOnLoad();
    	$('#new_password').keyup(function() {
			$('#result').html(checkStrength($('#new_password').val()))
		})
		
		$('#new_password_confirm').keyup(function() {
			var newps = $('#new_password').val()
			var newpsconfirm = $('#new_password_confirm').val()
			
			if(newps!= newpsconfirm){
						
						 $('#confirmerror').html('Your passwords dont match');
							 $('#change').prop('disabled', true);
							}else{
								$('#change').prop('disabled', false);
								$("#confirmerror").empty();
								$('#confirmerror').html('Your passwords match');
								$('#confirmerror').addClass('successtext')
								
								
							}
		})
		function checkStrength(password) {

			//initial strength
			var strength = 0

			//if the password length is less than 6, return message.
			if (password.length < 6) {
				$('#result').removeClass()
				$('#result').addClass('short')
				return 'Too short'
			}

			//length is ok, lets continue.

			//if length is 8 characters or more, increase strength value
			if (password.length > 7)
				strength += 1

			//if password contains both lower and uppercase characters, increase strength value
			if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))
				strength += 1

			//if it has numbers and characters, increase strength value
			if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))
				strength += 1

			//if it has one special character, increase strength value
			if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))
				strength += 1

			//if it has two special characters, increase strength value
			if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,",%,&,@,#,$,^,*,?,_,~])/))
				strength += 1

			//now we have calculated strength value, we can return messages

			//if value is less than 2
			if (strength < 2) {
				$('#result').removeClass()
				$('#result').addClass('weak')
				$("#result").css("color","#BE2E21")
				return 'Weak'
			} else if (strength == 2) {
				$('#result').removeClass()
				$('#result').addClass('good')
				$("#result").css("color","#006633")
				
				return 'Good'
			} else {
				$('#result').removeClass()
				$('#result').addClass('strong')
				$("#result").css("color","#003300")
				return 'Strong'
			}
		}
		
		
		$('#change').click(function(){
			var url = "<?php echo base_url()."user/save_new_password";?>";
			
			 $.ajax({
	            type: $('#change').attr('method'),

	            	url:url,
	            	type: "POST",
	            	async:false,
					cache:"false",
					data:{ 'current_password': $('#current_password').val(),'new_password_confirm': $('#new_password_confirm').val()},
					dataType:'json',
					beforeSend:function(){
						 $("#new_error").html("Processing...");
					},
					complete:function(){
						
					},
					success: function(data){
						console.log($('#current_password').val())
						console.log(data)
						//return;
						//response = jQuery.parseJSON(data);
					if(data.response=='false'){
						
						 $('#new_error').html(data.msg);
							$( "#current_password" ).focus();
							}else if(data.response=='true'){
								$("#new_error").empty();
								$("#current_password").val('');
								$("#new_password_confirm").val('');
								$("#new_password").val('');
								
								$('#new_error').html(data.msg);
								
							}

						}
	
							
	});

	return false;
	});
		
 });
 
		</script>
   <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
    <!-- Bootstrap core JavaScript===================== -->	
  <script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
   <script src="<?php echo base_url().'assets/scripts/exporting.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>	
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
    <!--Datatables==========================  -->
  <script src="<?php echo base_url().'assets/datatable/jquery.dataTables.min.js'?>" type="text/javascript"></script>	
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrap.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/TableTools.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/ZeroClipboard.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/datatable/dataTables.bootstrapPagination.js'?>" type="text/javascript"></script>
  <!-- validation ===================== -->
  <script src="<?php echo base_url().'assets/scripts/jquery.validate.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/bower_components/intro.js/intro.js'?>" type="text/javascript"></script>
</html>
