<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP|Change Password</title>
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-theme-default.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/styles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/> 
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
	<script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/jquery-1.8.0.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
	<!--<script src="<?php echo base_url().'assets/scripts/alert.js'?>" type="text/javascript"></script>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
    <style>
    	h2{
    		font-size:1.6em;
    	}
    </style>
    
  </head>  
  <body data-spy="scroll" data-target=".subnav" data-offset="50" screen_capture_injected="true" style="padding: 0;">
	<div class="navbar  navbar-static-top" id="top-panel">
      
<a href="<?php echo base_url();?>">
	<img style="max-width: 9em; float: left; margin-right: 2px;" src="<?php echo base_url();?>assets/img/coat_of_arms.png" class="img-responsive " alt="Responsive image"></a>

				<div id="logo_text" style="margin-top: 3%">
					<span style="font-size: 1.7em;font-weight: bold">Ministry of Health</span><br />
					<span style="font-size: 1.3em">Health Commodities Management Platform (HCMP)</span>	
				</div>
				
				
	</div>
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-md-4" style="">
				
			</div>
			<div class="col-md-4" style="">
				
				<?php 
if ($popup=="success") {
	
	echo	'<div class="alert alert-info alert-dismissable" style="text-align:center;">Your code matched. Proceed to Set a new Password below.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>';
}elseif ($popup=="error") {
	echo	'<div class="alert alert-success alert-dismissable" style="text-align:center;">Please Check your email for a Reset Code.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>';
}elseif ($popup=="error_nomatch") {
	echo	'<div class="alert alert-danger alert-dismissable" style="text-align:center;">Your passwords do not match.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>';
}
unset($popup);

 ?>
			</div>
			<div class="col-md-4" style="">
				
				
			</div>
		</div>
		
	</div>
	
	
  	
  		   
<div class="container" style="margin-top: 3%;" id="containerlogin">
      
                
 <div class="row">
        <div class="col-md-3"></div>
  <div class="col-md-6"> 
  			<div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div id="contain_login" class="">
    <h2><span style="margin-right: 0.5em;" class="glyphicon glyphicon-lock"></span>Password Recovery</h2> 
    <?php 
    
   echo form_open('User/change_pw_recovery'); ?>
<div id="login" >

	<div class= "row">
    	<div class="col-md-11" >	
  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputEmail1">Username / Email </label>
    
    <p class="form-control-static">Password recovery for <strong><?php echo $user_email ?></strong>  </p>
    <input type="hidden" name="username" id="username" readonly="readonly" required="required" value="<?php echo $user_email ?>">
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
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control input-lg" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm Password" required="required">
  </div>
  </div>
  <div class="col-md-1" style="padding-left: 0;"><span class="error" id="confirmerror" style="padding-top: 60%;"></span></div>
  </div>
   <input type="submit" class="btn btn-primary " name="Reset" id="Reset" value="Reset" style="margin-bottom: 3%;">
   
  <a class="btn btn-success" style="margin-left: 2%;margin-bottom: 3%;" href="<?php echo base_url().'Home'?>" id="modalbox">Home</a>
    
    
</div>

<?php 

    echo form_close();
    ?>
</div><!-- #contain_login -->


          </div>
          <div class="col-md-1"></div>
  
</div><!-- .row #contain_login -->
</div>
  		<div class="col-md-3"></div>  
   
 </div><!-- .row -->
 </div><!-- .container -->
 <div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
      <!-- JS and analytics only. -->
    <!-- Bootstrap core JavaScript
    	
================================================== -->
		<script>
	$(document).ready(function() {
		
		$('#new_password').keyup(function() {
			$('#result').html(checkStrength($('#new_password').val()))
		})
		
		$('#new_password_confirm').keyup(function() {
			var newps = $('#new_password').val()
			var newpsconfirm = $('#new_password_confirm').val()
			
			if(newps!= newpsconfirm){
						
						 $('#confirmerror').html('Your passwords dont match');
						
							}else{
								
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
		
 });
		</script>

</body>
</html>
