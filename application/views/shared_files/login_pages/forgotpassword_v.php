<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP|Password Recovery</title>
    
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
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
  <link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
  <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery-1.8.0.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
   <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/offline-simulate-ui.min.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
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
    <script>
   paceOptions = {
  ajax: false, // disabled
  document: true, // 
  eventLag: true // 
  
};
  </script>
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
if (isset($popup)) {
	
	echo	'<div class="alert alert-danger alert-dismissable" style="text-align:center;"> Error! This user Does not exist! Try Again.
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
    
	 echo form_open('User/password_recovery'); ?>
<div id="login" >

		
  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Enter email" required="required">
  </div>
  
   <input type="submit" class="btn btn-primary " name="register" id="register" value="Recover" style="margin-bottom: 3%;">
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
	$(document).ready(function() {});
		
		</script>

</body>
</html>

