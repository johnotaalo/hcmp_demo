<?php
if (!$this -> session -> userdata('user_id')) {
	redirect("user_management/login");
}
if (!isset($link)) {
	$link = null;
}
if (!isset($quick_link)) {
	$quick_link = null;
}
$access_level = $this -> session -> userdata('user_indicator');
$drawing_rights =0;

$user_is_facility = false;
$user_is_moh = false;
$user_is_district = false;
$user_is_moh_user = false;
$user_is_facility_user = false;
$user_is_kemsa = false;
$user_is_super_admin = false;
$user_is_rtk_manager = FALSE;
$user_is_county_facilitator = FALSE;
$user_is_allocation_committee = FALSE;
$user_is_dpp = FALSE;
$user_is_rca = FALSE;
if ($access_level == "facility" || $access_level == "fac_user") {
	$drawing_rights = $this -> session -> userdata('drawing_rights');
	$user_is_facility = true;
}
if ($access_level == "moh") {
	$user_is_moh = true;
}
if ($access_level == "district") {
	$user_is_district = true;
}
if ($access_level == "moh_user") {
	$user_is_moh_user = true;
}
if ($access_level == "kemsa") {
	$user_is_kemsa = true;
}
if ($access_level == "super_admin") {
	$user_is_super_admin = true;
}
if ($access_level == "rtk_manager") {
	$user_is_rtk_manager = true;
}
if ($access_level == "county_facilitator") {
	$user_is_county_facilitator = true;
}

if ($access_level == "allocation_committee") {
	$user_is_allocation_committee = true;
}
if ($access_level == "dpp") {
	$user_is_dpp = true;

}
if ($access_level=="rca"){
	$user_is_rca = true;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>

<link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
<link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/>  
<link href="<?php echo base_url() . 'assets/boot-strap3/css/bootstrap.min.css' ?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/css/offline.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url() . 'assets/boot-strap3/css/bootstrap-responsive.css' ?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'assets/CSS/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
 
<script src="<?php echo base_url().'assets/Scripts/jquery.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url();?>assets/HighCharts/highcharts.js"></script>
<!--<script src="<?php echo base_url().'Scripts/jquery.form.js'?>" type="text/javascript"></script> -->
<script src="<?php echo base_url().'assets/scripts/jquery-ui.js'?>" type="text/javascript"></script>
<!--<script type="text/javascript" src="http://ajax.microsoft.com/ajax/jquery.validate/1.7/jquery.validate.min.js"></script>-->

<script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/jquery.validate.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js' ?>" type="text/javascript"></script>

<script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
	
<!-- EID Scripts -->
<script src="<?php echo base_url().'assets/scripts/EID/jquery.hashchange.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'assets/scripts/EID/eid.js'?>" type="text/javascript"></script>
<!-- EID Scripts end--> 

<script type="text/javascript">

/*
 * Auto logout
 */
var timer = 0;
function set_interval() {
	showTime()
	// the interval 'timer' is set as soon as the page loads
	timer = setInterval("auto_logout()", 3600000);
	// the figure '1801000' above indicates how many milliseconds the timer be set to.
	// Eg: to set it to 5 mins, calculate 3min = 3x60 = 180 sec = 180,000 millisec.
	// So set it to 180000
}

function reset_interval() {
	showTime()
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
	//window.location = "<?php //echo base_url(); ?>/user_management/logout";
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
</head>
 
<body screen_capture_injected="true" style="">
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img style="display:inline-block;" src="<?php echo base_url(); ?>assets/img/coat_of_arms-resized1.png" class="img-responsive " alt="Responsive image">
                <div id="" style="display:inline-block;">
                    <span style="font-size: 0.95em;font-weight: bold; ">Ministry of Health</span><br />
                    <span style="font-size: 0.85em;">Health Commodities Management Platform (HCMP)</span>	
                </div>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right" >
                    <li><a class="" href="<?php echo site_url() . 'Home'; ?>" >HOME</a> </li>   
                    <?php
//Retrieve all accessible menus/submenus from the session
                    $menus = $this->session->userdata('menus');
                    $sub_menus = $this->session->userdata('sub_menus');
//Loop through all menus to display them in the top panel menu section
                    foreach ($menus as $menu) {
                    	
                        ?>
                        <li class="top_menu" id="<?php echo $menu['menu_url'] ;?>">
                            <a href="<?php echo site_url($menu['menu_url']); ?>" id="sub" class=""><?php echo $menu['menu_text']; ?></a>           	
                            <ul  class="dropdown-menu" style="min-width: 0">           		
                                <?php
                                foreach ($sub_menus as $sub_menu) {
                                    if ($menu['menu_id'] == $sub_menu['menu_id']) {
                                        ?>

                                        <li><a style="background: whitesmoke;color: black !important" class="" href="<?php echo $sub_menu['submenu_url'] ?>">
                                                <?php echo $sub_menu['submenu_text'] ?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                            </ul>
                        </li>

                        <?php
                    }
                    ?>
                    <li class="dropdown ">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user" ></span><?php echo $this->session->userdata('full_name'); ?> <b class="caret"></b></a>
                        <ul class="dropdown-menu">
                            <li><a style="background: whitesmoke;color: black !important" href="<?php echo site_url("user/change_password"); ?>"><span class="glyphicon glyphicon-pencil" style="margin-right: 2%; "></span>Change password</a></li>                
                            <li><a style="background: whitesmoke;color: black !important" href="<?php echo site_url("user/logout"); ?>" ><span class="glyphicon glyphicon-off" style="margin-right: 2%;"></span>Log out</a></li>               
                        </ul>
                    </li>
                </ul>         
            </div>
        </div>

    </div>   


	 <div id="inner_wrapper"> 
		<?php $this -> load -> view($content_view); ?>
	 </div>
 </div>

 </div>
    <div id="bottom_ribbon"><div id="footer">
    	<div class="container">
            <p class="text-muted"> Government of Kenya &copy <?php echo date('Y'); ?>. All Rights Reserved</p>
        </div>
    </div>

	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >
		<div class="modal-header">
		    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">x</button>
		    <h3 id="myModalLabel">Change Password</h3>
		    <div id="errsummary" style=""></div>
	  	</div>
	  
	  	<form class="form-horizontal" action="<?php echo base_url().'User_Management/save_new_password'?>" method="post" id="change">
			  <div class="control-group" style="margin-top: 1em;">
			    <label class="control-label" for="inputPassword">Old Password</label>
			    <div class="controls">
			      <input type="password" id="old_password"  name="old_password" placeholder="Old Password" required="required"><span class="error" id="err" style="margin-left: 0.2em;font-size: 10px"></span>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword">New Password</label>
			    <div class="controls">
			      <input type="password" id="new_password" name="new_password" placeholder="New Password" required="required"><span class="error" id="result" style="margin-left: 0.2em;font-size: 10px"></span>
			    </div>
			  </div>
			  <div class="control-group">
			    <label class="control-label" for="inputPassword">Confirm Password</label>
			    <div class="controls">
			      <input type="password" id="new_password_confirm" name="new_password_confirm" placeholder="Confirm Password" required="required"><span class="error" id="confirmerror" style="margin-left: 0.2em;font-size: 10px"></span>
			    </div>
			  </div>
			  <div class="modal-footer">
			    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
			    <button class="btn btn-primary" id="changepsaction" name="changepsaction">Change Password</button>
			    <div class="error"></div>
			  </div>
		</form>
	</div>
<?php
	echo form_close();
		?>
    
</body>
<script>
	$(document).ready(function() {
		
					$('.successreset').fadeOut(10000, function() {
    // Animation complete.
  });
//$('.errorlogin').fadeOut(10000, function() {
    // Animation complete.
 // });	
			
	
		//$('#myModal').modal('hide')
		
		$("#my_profile_link").click(function(){
			$("#logout_section").css("display","block");
		});
		$('#top-panel').waypoint('sticky');
		
		$('.dropdown-toggle').dropdown();

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


		$('#change').submit(function(){
			
			 $.ajax({
	            type: $('#change').attr('method'),

	            	url:$('#change').attr('action'),
					cache:"false",
					data:$('#change').serialize(),
					dataType:'json',
					beforeSend:function(){
						 $("#err").html("Processing...");
					},
					complete:function(){
						
					},
					success: function(data){
						//alert(data.response);
					if(data.response=='false'){
						
						 $('#err').html(data.msg);
						
							}else if(data.response=='true'){
								$("#err").empty();
								
								window.location="<?php echo base_url();?>";
								
							}

						}
	
							
	});

	return false;
	});
		});

</script>

</html>
