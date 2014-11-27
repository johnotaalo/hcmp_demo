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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $title; ?></title>

<link rel="icon" href="<?php echo base_url().'Images/coat_of_arms.png'?>" type="image/x-icon" />
<link href="<?php echo base_url().'CSS/style.css'?>" type="text/css" rel="stylesheet"/> 
<link href="<?php echo base_url().'CSS/bootstrap.css'?>" type="text/css" rel="stylesheet"/>
<link href="<?php echo base_url().'CSS/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
 
<script src="<?php echo base_url().'Scripts/jquery.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url();?>Scripts/HighCharts/highcharts.js"></script>
<script src="<?php echo base_url();?>Scripts/HighCharts/modules/exporting.js"></script>
<!--<script src="<?php echo base_url().'Scripts/jquery.form.js'?>" type="text/javascript"></script> -->
<script src="<?php echo base_url().'Scripts/jquery-ui.js'?>" type="text/javascript"></script>

<script src="<?php echo base_url().'Scripts/validator.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/jquery.validate.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/waypoints.js'?>" type="text/javascript"></script> 
<script src="<?php echo base_url().'Scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
<script src="<?php echo base_url().'Scripts/bootstrap.js'?>" type="text/javascript"></script>

<script src="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js" type="text/javascript"></SCRIPT>
	
 

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
	window.location = "<?php echo base_url(); ?>user_management/logout";
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
 
<body onload="set_interval()" onmouseover="reset_interval()" onclick="reset_interval()">
<div id="header_container" class="" id="top-panel" style="margin-bottom: 0px" >

	<div class="banner_logo">
			<a class="logo" href="<?php echo base_url();?>" ></a> 
		</div>

				<div id="logo_text">
					<span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Health</span>
					<span style="display: block; font-size: 12px;">Health Commodities Management Platform(HCMP)</span>	
				</div>
			<?php if($banner_text=="New Order"):?>
				<div id="notification" style="display: block; margin-left: 40%;">
					
			<span ><b > Total Order Value </b><b id="t" >  0</b></span><br />
			<span> Drawing Rights Available Balance :<b id="drawing"><?php echo $drawing_rights; ?>   </b>
				
			</span>
		        
	</div>
	
	
	<?php endif; ?>
	<?php $facility = $this -> session -> userdata('news'); ?>
 <div id="main_menu"> 

<nav id="navigate">
<ul>
 	
<?php
if($user_is_facility){
?>
<li class="<?php
if (@@$current == "home_controller") {echo "active";
}
?>"><a  href="<?php echo base_url(); ?>home_controller">Home </a></li>
 	<li><a  href="<?php echo base_url(); ?>order_management" class="<?php
	if ($quick_link == "order_listing") {echo "active";
	}
?>"> Orders </a></li> 

<li><a  class="<?php
if (@@$current == "Issues_main") {echo "active";
}
?>">Issues <b class="caret"></b></a>
<ul>
                  <li><a href="<?php echo site_url('Issues_main/Index/Internal/'.$facility);?>">Issue to Service Point</a></li>
                  <li><a href="<?php echo site_url('Issues_main/Index/External/'.$facility);?>">Redistribute Commodities</a></li>
                  <li><a href="<?php echo site_url('Issues_main/Index/Donation/'.$facility)?>">Recieve Commodities from other Sources</a></li>
                </ul>
    	
</li>

<!--<a href="<?php echo base_url();?>order_management/all_deliveries/<?php echo $facility?>" class="top_menu_link<?php
	if ($quick_link == "dispatched_listing_v") {echo " top_menu_active ";
	}
	?>">Deliveries</a>-->

<li><a  href="<?php echo base_url(); ?>report_management/reports_Home"  class="<?php
if (@@$current == "report_management") {echo "active";
}
?>">Reports </a></li>
<li><a  href="<?php echo base_url(); ?>report_management/commodity_list" class="<?php
if ($quick_link == "commodity_list") {echo "active";
}
?>">Commodity List</a></li>
<?php if($access_level == "fac_user"){} else{?>
<li><a  href="<?php echo base_url(); ?>user_management/users_manage"  class="<?php
if ($quick_link == "user_facility_v") {echo "active";
}
?>">Users</a></li>
 <?php } ?>
<li>
	<i class="icon icon-wrench  icon-white" style="margin-right: 0.3em; margin-top: 0.1em;">
		
	</i><a  href="<?php echo base_url(); ?>report_management/facility_settings"  class="<?php
	if ($quick_link == "user_facility_v") {echo "active";
	}
?>">Settings</a></li>
 
<?php } if($user_is_district){ ?>
	
	
		<li class="<?php
		if (@@$current == "home_controller") {echo "active";
		}
	?>"><a data-clone="Home" href="<?php echo base_url(); ?>home_controller">Home </a></li>
	<!--<li><a data-clone="Actions" href="<?php echo base_url();?>dp_facility_list/actions"  class="<?php
	if ($quick_link == "actions") {echo "active";
	}
?>">Actions</a></li>-->
	 	<li><a data-clone="District Orders" href="<?php echo base_url(); ?>order_approval/district_orders"  class="<?php
		if ($quick_link == "new_order") {echo "active";
		}
	?>">District Orders</a></li>

<li><a data-clone="District Facilities" href="<?php echo base_url(); ?>order_approval/district_orders"  class="<?php
if ($quick_link == "new_order") {echo "active";
}
?>">District Facilities</a></li>

	 	<li><a data-clone="Users" href="<?php echo base_url(); ?>user_management/dist_manage"  class="<?php
		if (@@$current == "user_management") {echo "active";
		}
	?>">Users</a></li>
	
	<li><a data-clone="Reports" href="<?php echo base_url(); ?>report_management/division_reports"  class="<?php
	if ($quick_link == "new_order") {echo "active";
	}
?>">Reports</a></li>


	<li><a data-clone="Commodity List" href="<?php echo base_url(); ?>report_management/get_facility_evaluation_form_results" class="<?php
	if ($quick_link == "commodity_list") {echo "active";
	}
?>">Evaluation Forms</a></li>

<li><a data-clone="Commodity List" href="<?php echo base_url(); ?>report_management/commodity_list" class="<?php
	if ($quick_link == "commodity_list") {echo "active";
	}
?>">Commodity List</a></li>
<!--	<li><a data-clone="Facility List" href="<?php echo base_url();?>dp_facility_list/get_facility_list"  class="<?php
	if ($quick_link == "facility_list") {echo "active";
	}
?>">Facility List</a></li>-->


	<?php } ?>
<?php if($user_is_kemsa){
	?>
	<li><a data-clone="Orders" href="<?php echo site_url('order_management/kemsa_order_v'); ?>"  class="<?php
	if ($quick_link == "kemsa_order_v") {echo "active";
	}
?>">Orders</a></li>
	<?php } ?>
<?php if($user_is_super_admin){
	?>
	<li><a data-clone="User" href="<?php echo site_url('user_management/create_user_super_admin'); ?>"  class="<?php
	if ($quick_link == "kemsa_order_v") {echo "active";
	}
?>">Users</a></li>
	<?php } ?>
<?php if($user_is_rtk_manager){
	?>
	<li class="active"><a data-clone="Home" href="<?php echo base_url(); ?>home_controller">Home </a></li>
<!--	<li><a data-clone="Facility Mapping" href="<?php echo site_url('rtk_management/rtk_mapping'); ?>"  class="<?php
	if ($quick_link == "kemsa_order_v") {echo "active";
	}
?>">Facility Mapping</a></li>-->
	<?php } ?>
<?php if($user_is_moh_user){
	?>

<li class="<?php
if (@@$current == "home_controller") {echo "active";
}
?>"><a data-clone="Home" href="<?php echo base_url(); ?>home_controller">Home </a></li>

	<li>
		<a data-clone="Stock Level"  href="<?php echo site_url('stock_management/stock_level_moh'); ?>" class="<?php
		if ($quick_link == "load_stock") {echo "active";
		}
	?>">Stock Level</a></li>
	<li><a data-clone="View Orders"  href="<?php echo site_url('order_management/moh_order_v'); ?>" class="<?php
	if ($quick_link == "moh_order_v") {echo "active";
	}
	?>">View Orders</a></li>
	<li><a data-clone="Unconfirmed Orders"  href="<?php echo site_url('order_management/unconfirmed'); ?>" class="<?php
	if ($quick_link == "unconfirmed_orders") {echo "active";
	}
	?>">Unconfirmed Orders</a></li>
	<li><a data-clone="Trends" href="<?php echo site_url('raw_data/trends'); ?>"   class="<?php
	if ($quick_link == "trends") {echo "active";
	}
	?>">Trends</a></li>
	

<?php } ?>

<?php if($user_is_county_facilitator){
	?>
	<li class="active"><a data-clone="Home" href="<?php echo base_url(); ?>home_controller">Home </a></li>
	<!--<li class="active"><a data-clone="Orders" href="<?php echo base_url();?>rtk_management/rtk_orders">Orders</a></li>-->
	<li class="active"><a data-clone="County Orders" href="<?php echo base_url(); ?>stock_expiry_management/county_deliveries">County Orders</a></li>
	<li class="active"><a data-clone="Expiries" href="<?php echo base_url(); ?>stock_expiry_management/county_expiries">Expiries</a></li>
	<li><a data-clone="Commodity List" href="<?php echo base_url(); ?>report_management/get_county_evaluation_form_results" class="<?php
	if ($quick_link == "commodity_list") {echo "active";
	}
?>">Evaluation Forms</a></li>
	<li class="active"><a data-clone="Commodity List" href="<?php echo base_url(); ?>report_management/commodity_list">Commodity List</a></li>
	<li><a data-clone="Facility Mapping" href="<?php echo site_url('report_management/get_county_facility_mapping'); ?>"  class="<?php
	if ($quick_link == "kemsa_order_v") {echo "active";
	}
?>">Facility Mapping</a></li>
	<?php } ?>
<?php if($user_is_dpp){
	?>
	<li class="active"><a data-clone="Home" href="<?php echo base_url();?>home_controller">Home </a></li>
	<li class="active"><a data-clone="Orders" href="<?php echo base_url();?>rtk_management/rtk_orders">Orders</a></li>
	<li><a data-clone="Facility Mapping" href="<?php echo site_url('rtk_management/rtk_mapping/dpp');?>"  class="<?php
	if ($quick_link == "kemsa_order_v") {echo "active";
	}
?>">Facility Mapping</a></li>
	<?php
}
?>
<?php if($user_is_allocation_committee){
	?>
	<li class="active"><a data-clone="RTK Home" href="<?php echo base_url();?>home_controller">RTK</a></li>

 <li><a  data-clone="RTK Allocation" href="<?php echo base_url();?>rtk_management/allocations">RTK Allocations</a></li>
	<li><a  data-clone="CD4 Home" href="<?php echo base_url();?>cd4_management/">CD4</a></li> 
	<li><a  data-clone="CD4 Allocation" href="<?php echo base_url();?>cd4_management/allocations">CD4 Allocations</a></li>
	<?php } ?>
<?php if($user_is_moh){
	?>
	
<li class="<?php
if (@@$current == "home_controller") {echo "active";
}
?>"><a data-clone="Home" href="<?php echo base_url(); ?>home_controller">Home </a></li>
	
		
		<li><a data-clone="Users" href="<?php echo base_url(); ?>user_management/moh_manage" class="<?php
		if (@@$current == "user_management") {echo "active";
		}
	?>">Users</a></li>
	
	<li><a data-clone="Stock Level"  href="<?php echo site_url('stock_management/stock_level_moh'); ?>"   <?php
	if ($quick_link == "load_stock") {echo "top_menu_active";
	}
	?>">Stock</a></li>
	<li><a data-clone="Orders"   href="<?php echo site_url('order_management/moh_order_v'); ?>"  <?php
	if ($quick_link == "moh_order_v") {echo "top_menu_active";
	}
	?>>Orders</a></li>
	<li>
		<a data-clone="Trends" href="<?php echo site_url('raw_data/trends'); ?>" <?php
		if ($quick_link == "trends") {echo "active";
		}
	?>>Trends</a>
	</li>
    <li><a data-clone="Consumption"  href="<?php echo site_url('raw_data/getCounty'); ?>"   <?php
	if ($quick_link == "Consumption") {echo "active";
	}
	?>>Consumption</a>
	</li>
<?php } ?>

</ul>
</nav>
</div>
<div  id="system_alerts">
      				<?php $flash_success_data = NULL;
					      $flash_error_data = NULL;
	                      $flash_success_data = $this -> session -> flashdata('system_success_message');
						  $flash_error_data = $this -> session -> flashdata('system_error_message');
							if ($flash_success_data != NULL) {
							echo '<div class="alert alert-success alert-dismissable" >
							<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>' . $flash_success_data . '</div>';
						   } elseif ($flash_error_data != NULL) {
							echo '<div class="alert alert-danger alert-dismissable" >
							<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>' . $flash_error_data . '</div>';
							}
 						?>
 </div>
<div class="btn-group " id="btnlogout">
  <a  class="btn btn-primary dropdown-toggle" data-toggle="dropdown" href="#"><i class="icon-user icon-white"></i> <?php echo $this -> session -> userdata('names'); ?> <?php echo $this -> session -> userdata('inames'); ?><span style="margin-left: 0.3em;" class="caret"></span></a>
  
  <ul class="dropdown-menu" style="font:#FFF;">
    <li><a href="#"><i class="icon-pencil"></i> Edit Settings</a></li>
    <li><a href="#myModal" data-toggle="modal" data-target="#myModal" id="changepswd" ><i class="icon-edit"></i> Change password</a></li>
    
    
    <li class="divider"></li>
    <li><a href="<?php echo base_url(); ?>user_management/logout"><i class=" icon-off"></i> Log Out</a></li>
  </ul>
  
</div>
<div style="font-size:0.75em; float:right; padding: 0.5em "><?php  echo date('l, dS F Y'); ?>&nbsp;<div id="clock" style="font-size:0.75em; float:right; " ></div>
	 </div>
  	
</div>
	 <div>
	<div class="divide" >
	
    			<div   id="banner_text">
      				<?php echo $this -> session -> userdata('full_name') . ": " . $banner_text; ?>
            			    				</div>
    				
    			  				
  				</div>




 <div id="inner_wrapper"> 
 		
	<?php $this -> load -> view($content_view); ?>
<!-- end inner wrapper -->

  <!--End Wrapper div-->
    
    
 </div>
 </div>

 </div>
    <div id="bottom_ribbon"><div id="footer"><?php $this -> load -> view("footer");?></div></div>

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


</div>
</form>
<?php
	echo form_close();
		?>
    
</body>
<script>
	$(document).ready(function() {
		
					$('.alert-success').fadeOut(10000, function() {
    // Animation complete.
  });
//$('.errorlogin').fadeOut(10000, function() {
    // Animation complete.
 // });	
			
	
		//$('#myModal').modal('hide')
		
		$("#my_profile_link").click(function(){
			$("#logout_section").css("display","block");
		});
		
		
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
