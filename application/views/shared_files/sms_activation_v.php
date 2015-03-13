 <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-theme-default.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/styles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/> 
<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
<style>
	
body{
	
	padding:0;
}
.modal {
    display:    none;
    position:   fixed;
    z-index:    1000;
    top:        0;
    left:       0;
    height:     100%;
    width:      100%;
    background: rgba( 255, 255, 255, .8 ) 
                url('<?php echo base_url().'assets/img/Preloader_4.gif'?>') 
                50% 50% 
                no-repeat;
}

/* When the body has the loading class, we turn
   the scrollbar off with overflow:hidden */
body.loading {
    overflow: hidden;   
}

/* Anytime the body has the loading class, our
   modal element will be visible */
body.loading .modal {
    display: block;
}

</style>
<div class="modal"></div>
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
if ($popup=="error_nomatch") {
  
 echo '<div class="alert alert-danger alert-dismissable" style="text-align:center;"> Error! Mismatch in one of you details! Try Again.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button></div>';

}
unset($popup);

 ?>
			</div>
			<div class="col-md-4" style="">
				
				
			</div>
		</div>
		
	</div>
	
<div class="container">
    <div class="row">
    	<div role="form" class="col-md-5 go-right">
    		
    		<div class="col-md-12">
          <h3>Important</h3>
          <ul id="notes">
    <li>
        <p><span style="color: green" class="glyphicon glyphicon-ok"></span>Please enter the phone No where you got the activation code.</p>
        <p><span style="color: green" class="glyphicon glyphicon-ok"></span>Then create a password.</p>
        <p><span style="color: green" class="glyphicon glyphicon-ok"></span>Confirm the password.</p>
        <p><span style="color: green" class="glyphicon glyphicon-ok"></span>Activate account. You will be redirected to the login page, from where you can use HCMP.</p>
        
    </li>
    
    
</ul>
          
        </div>
    		</div>
		<div role="form" class="col-md-6 ">
			 <div id="contain_login" class="">
    <h2><span style="margin-right: 0.5em;" class="glyphicon glyphicon-lock"></span>Activation</h2> 
    <?php 
    
   echo form_open('user/sms_activation'); ?>
<div id="login" >
<div class="error"></div>
    
  <div class="form-group" style="margin-top: 2.3em;">
   
   <div class="row">
    <div class="col-md-6">
     <label for="">Phone No</label>
    <input type="text" class="form-control input-md" name="phone_n" id="phone_n" placeholder="Confirm Phone" required="required">
    <span class="error" id="err" style="margin-left: 0.2em;font-size: 10px"></span>
  </div>
  <div class="col-md-6">
     <label for="">Activation Code</label>
    <input type="text"  class="form-control input-md" name="a_code" id="a_code" placeholder="Confirmation code" required="required">
    <span class="error" id="err" style="margin-left: 0.2em;font-size: 10px"></span>
  </div>
</div> 
    
  </div>
  <div class="form-group" style="margin-bottom: 2em;">
    <label for="exampleInputPassword1">Set Password</label>
    <input type="password" class="form-control input-md" name="new_password" id="new_password" placeholder="New Password" required="required">
    <span class="error" id="result" style="margin-left: 0.2em;font-size: 10px"></span>
  </div>
  
  <div class="form-group" style="margin-bottom: 2em;">
    <label for="exampleInputPassword1">Confirm Password</label>
    <input type="password" class="form-control input-md" name="new_password_confirm" id="new_password_confirm" placeholder="Confirm Password" required="required">
    <span class="error" id="confirmerror" style="margin-left: 0.2em;font-size: 10px"></span>
  </div>
  
   <button class="btn btn-success " name="activate" id="activate" style="margin-bottom: 3%;">Activate</button>
  
    
    
</div>

<?php 

    echo form_close();
    ?>
</div><!-- #contain_login -->
		</div>
		<div role="form" class="col-md-1 ">
			</div>
	</div>
</div>

<div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
    
<script>

$(document).ready(function () {
	
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
								$('#confirmerror').removeClass('error');
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
	
	
	
	$("#activat").click(function() {

      
      
      var newps = $('#new_password').val()
	  var newpsconfirm = $('#new_password_confirm').val()
	  
	  if(newps!= newpsconfirm){
						
						 $('#confirmerror').html('Cannot proceed. Make sure your passwords match');
						return;
							}
           
    });
    
  
});
</script>