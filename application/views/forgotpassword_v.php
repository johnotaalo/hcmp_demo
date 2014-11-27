<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="en">
	<style>
	
	
	
</style>	
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Forget Password</title>

 <link href="<?php echo base_url().'CSS/assets/css/style.css'?>" type="text/css" rel="stylesheet"/>
    <link rel="icon" href="<?php echo base_url().'CSS/assets/img/coat_of_arms1.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'CSS/assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'CSS/assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'CSS/assets/css/bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'CSS/assets/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url().'CSS/assets/scripts/jquery.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'CSS/assets/scripts/jquery-1.8.0.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'CSS/assets/scripts/alert.js'?>" type="text/javascript"></script>
<?php
if (isset($script_urls)) {
	foreach ($script_urls as $script_url) {
		echo "<script src=\"" . $script_url . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($scripts)) {
	foreach ($scripts as $script) {
		echo "<script src=\"" . base_url() . "Scripts/" . $script . "\" type=\"text/javascript\"></script>";
	}
}
?>
<?php
if (isset($styles)) {
	foreach ($styles as $style) {
		echo "<link href=\"" . base_url() . "CSS/" . $style . "\" type=\"text/css\" rel=\"stylesheet\"/>";
	}
}
?>  

<script type="text/javascript">
	$(document).ready(function() {
		
			$('.errorlogin').fadeOut(10000, function() {
    // Animation complete.
  });
  
  
  	$("#home").click(function(){
		window.location="<?php echo base_url();?>";
		});
	});

</script>
</head>

<body>
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
 <?php  

if (isset($popup)) {
	
	echo	'<div class="alert alert-danger alert-dismissable" >An Error has occured, Please Enter an Existing user.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>';
}
unset($popup);
 ?> 	
</div>
<div id="contain_login" class="" style="height: 20em;" >
  	<h2><i style="margin-right: 0.5em;" class="icon-user"></i>Password Recovery</h2>	
  	<div class="alert alert-info">Please Enter Email address below to recover password</div>
  	<?php 
    
	 echo form_open('User_Management/password_recovery'); ?>	
<div id="login" class="" >

  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" class="form-control input-lg" name="username" id="username" value="" placeholder="me@domain.com" required="required">
  </div>
   
   <input type="submit" class="btn btn-primary " name="register" id="register" value="Submit">
   
	<a href="<?php echo base_url();?>" class="btn btn-primary  btn-success" style="margin-left: 16em">Home</a>	
		
</div>
<?php 

		echo form_close();
		?>
</div>

    <div class="footer">
	Government of Kenya &copy; <?php echo date('Y');?>. All Rights Reserved
	
	</div>
    
</body>
</html>
