<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP | Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Le styles -->

    <link href="<?php echo base_url().'CSS/assets/css/style.css'?>" type="text/css" rel="stylesheet"/>
    <link rel="icon" href="<?php echo base_url().'CSS/assets/img/coat_of_arms1.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'CSS/assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'CSS/assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'CSS/assets/css/bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'CSS/assets/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url().'CSS/assets/scripts/jquery.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'CSS/assets/scripts/jquery-1.8.0.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'CSS/assets/scripts/alert.js'?>" type="text/javascript"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <script type="text/javascript">
function changeHashOnLoad() {
     window.location.href += "#";
     setTimeout("changeHashAgain()", "50"); 
}

function changeHashAgain() {
  window.location.href += "1";
}

var storedHash = window.location.hash;
window.setInterval(function () {
    if (window.location.hash != storedHash) {
         window.location.hash = storedHash;
    }
}, 50);
</script> 
  </head>  
  <body data-spy="scroll" data-target=".subnav" data-offset="50" screen_capture_injected="true">
	<div class="navbar  navbar-static-top" id="top-panel">
      

	

		<div class="banner_logo">
			<a class="logo" href="<?php echo base_url();?>" ></a> 
		</div>

				<div id="logo_text">
					<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Health</span>
					<span style="display: block; font-size: 12px;">Health Commodities Management Platform (HCMP)</span>	
				</div>
				
				
	</div>
	
	
<div id="error_contain" class="">
<?php echo validation_errors('<div class="alert alert-danger alert-dismissable" >
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>'); 

if (isset($popup)) {
	
	echo	'<div class="alert alert-success alert-dismissable" >Successful reset, an email has been sent to '.$email.' with the login details.
							<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>';
}
unset($popup);
 ?>
 
  </div>
  <div id="contain_login" class="" >
  	<h2><i style="margin-right: 0.5em;" class="icon-user"></i>Login</h2>	
  	<?php 
    
	 echo form_open('user_management/submit'); ?>
<div id="login" class="" >

		
  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Enter email" required="required">
  </div>
  <div class="form-group" style="margin-bottom: 2em;">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required="required">
  </div>
  
   <input type="submit" class="btn btn-primary btn-lg" name="register" id="register" value="Log in">
   
  <a class="" style="margin-left: 2%;" href="<?php echo base_url().'user_management/forget_pass'?>" id="modalbox">Can't access your account ?</a>
		
		
</div>
<?php 

		echo form_close();
		?>
</div>

<div class="footer">
	Government of Kenya &copy; <?php echo date('Y');?>. All Rights Reserved
</div>
      <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
    	
================================================== -->
		<script>
	$(document).ready(function() {
		$(".alert").alert()
	});
		</script>

</body>
</html>
