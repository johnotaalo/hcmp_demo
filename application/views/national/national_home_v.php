<html lang="en">
	
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">   
    <!-- Bootstrap core CSS -->  
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/bower_components/semantic/packaged/css/semantic.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/bower_components/ionicons-2.0.0/css/ionicons.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <!--<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/demo.css'?>" />-->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/tabs.css'?>" />
	<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/tabstyles.css'?>" />
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/bower_components/semantic/packaged/javascript/semantic.js'?>" type="text/javascript"></script>
     
    <title>HCMP | National</title>
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
a ,u {
	text-decoration: none !important;
}
	.active-panel{
    	border-left: 6px solid #36BB24;
    }
    body {
padding-top: 1%;
}

.modal-content,.form-control
{
  border-radius: 0 !important;
}

h4{
	
	padding:4px;
	color:black;
	background:white;
	text-align:center;
	margin:0;	
	font-size:15px;
}

.stat_item {
		height: 36px;
		padding: 2px 5px;
		color: #fff;
		text-align: center;
		font-size: 1em;
		
	}	
	
	#notify .col-md-2,.col-md-1{
		padding:3px;
	}
	#notify {
		margin-bottom: 5px;
	}
	.tile{
		box-shadow:  0px 1px 5px 0px #d3d3d3;
		background:white;
	}
	.tile h4{
		padding: 5px;
		background-color:#528f42;
		color: white;
	}
	.btn{
		border-radius: 0;
	}
	.modal-dialog {
		
		width: 85%;
	}
	.statistic{
		display: inline-block;
		text-align: center;
		cursor: pointer;
	}
	.statistic .label{
		color:black;
		font-weight: 400;
	}
	.statistic .value{
		font-size:2.2em;
		font-weight: 800;
	}
	.corner-label{
		background-color: #5cb85c;
		border-color: #4cae4c;
		color:white;
		text-align: center;
		height:10%;
		padding: 15 2 2 2;
		width: 36;
		margin-right:0.5%;
		font-size:1.3rem;
		cursor: pointer;
	}
	.tabs-style-bar nav ul li.tab-current a {
	background: #4CAE4C;
	color: #fff;
}
.tile-header{
	background-color: #f7f7f7;
	height:25px;
	font-size:1.3rem;
	text-align: center;
	font-weight: 800;
}
	</style>
	
		
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
  </script>
  
  
  </head>
  
  <body screen_capture_injected="true" style="background-color: white;">
  	
<div class="container-fluid">
	
	<div class="ui large menu">
  <div style="margin: 13 6 0 0;">Ministry of Health</div>
    
     
  
  <div class="right menu">
    <a class="active item">
    <i class="home icon"></i> Home
  </a>
  <a class="item">
    <i class="mail icon"></i> Settings
  </a>1
    <div class="ui dropdown item">
      Log in <i class="dropdown icon"></i>
      <div class="menu">
        <a class="item">Login to HCMP</a>
        <a class="item">Login to RTK</a>
      </div>
    </div>
    <div class="item">
        <div class="ui primary button">Sign Up</div>
    </div>
  </div>
</div>
	
		<div class="tabs tabs-style-bar navbar-fixed-top">
	
					<nav>
						<ul><div style="margin: 13 6 0 0;">Ministry of Health</div>
							<a href="<?php echo base_url().'national';?>" style="margin-right: 60">   
           						 <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" 
           						 class="img-responsive " alt="Responsive image" id="logo" ></a></li>
							<li><a href="#hcmp" class="icon icon-graph1"><span>HCMP Dashboard</span></a>
							<li><a href="<?php echo base_url().'home';?>" class="icon icon-user"><span>System Log in</span></a></li>
						</ul>
					</nav>
					
					<div class="content-wrap">
						<input type="hidden" name="current_filter" value="">
						
							<!-- BEGIN HCMP CONTENT -->
						<section id="hcmp" class="row-fluid">
							
							<div class="row-fluid ui stackable four column grid" style="max-height: 550px">							
							
							
						<div id="" class="five wide column" style="margin-top: 1%;">
							
							<div class="tile"  style="max-height: 500px;">
								<div class="tile-header">National Over view</div>
							<div id="map" style="max-height: 480px;"></div>	
						<script>
					var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
					map.setJSONData(<?php echo $maps; ?>);
					
    				map.render("map");
    				
                    </script>
                   		 <div class="row-fluid">
                   		 	<div class="col-lg-1">
                   		 		<div style="display:inline-block;width:14px;height:12px;background:#528f42">
				                
				            </div>
                   		 	</div>
                   		 	<div class="col-lg-4">
                   		 		Using HCMP
                   		 	</div>
                   		 	<div class="col-lg-3">
                   		 	</div>
                   		 	<div class="col-lg-4">
                   		 		
                   		 	</div>
				             
				            
				            </div>
							</div>
							
			
					
						
						
						</div>
						
						
				<div id="" class="eleven wide column " style="margin-top: 1%;height: 480px">
					
					<div class="ui statistics ">
						<div class="ui grid tile ">
							<div class="tile-header">National Statistics</div>
							  <div class="four wide column">
								<div class="statistic">
								    <div class="value">
								      522
								    </div>
								    <div class="label">
								     Total HCW Trained   
								    </div>
								  </div>
							  </div>
							  <div class="four wide column">
								<div class="statistic">
								    <div class="text value">
								      184
								    </div>
								    <div class="label">
								      Total Facilities Rolled Out
								    </div>
								  </div>
							  </div>
							  <div class="four wide column">
								<div class="statistic">
								    <div class="value">
								      <i class="plane icon"></i> 5
								    </div>
								    <div class="label">
								      Avg Stock out days
								    </div>
								  </div>
							  </div>
							  <div class="three wide column">
								<div class="statistic">
								    <div class="value">
								      57%
			   						 </div>
			    					<div class="label">
								      Avg order fill rate
								    </div>
								    
			 					 </div>
			 					

							  </div>
							  <div class="one wide column" style="padding:0.5%">
							  	<div class="corner-label right" data-toggle="modal" data-target="#facilitystatsModal">
							  		
									    <div class="ion-chevron-right">More</div>
							  	</div>
							  	</div>
							 
						</div>
					  
					  <div class="ui grid">
					  	<div class="tile" style="height: 420px"> 
							<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#expiriesModal" class="btn btn-xs btn-success test "><span class="icon icon-display"></span>More</button>	
								
							</div>					  		<div id="expiries"></div>
					  		</div>
					  	</div>
					  
					  
				</div>	
							
						</div>
						
						
							</div>
							
							<div class="ui horizontal divider">
								<i style="font-size: 16px;" class="fa fa-bar-chart-o"></i>
								 </div>
							
							<div class="row-fluid ui stackable four column grid" style=" margin-top:1.2%;">
								<div class="five wide column tile " style="height: 500px ;margin-right: 0">
									<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#mosModal" class="btn btn-xs btn-success "><span class="icon icon-display"></span>More</button>	
								
							</div>
							<div id="mos" class=""></div>
								</div>
								<div class="six wide column " style="height: 500px;margin-left: 0">
									<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#ordersModal" class="btn btn-xs btn-success "><span class="icon icon-display"></span>More</button>	
								
							</div>
							<div id="orders" class="tile"></div>
								</div>
								<div class="five wide column " style="height: 500px ;margin-right: 0">
									<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#consumptionModal" class="btn btn-xs btn-success "><span class="icon icon-display"></span>More</button>	
								
							</div>
							<div id="consumption" class="tile"></div>
								</div>
								
																
							</div>
							
							<div class="ui horizontal divider">
								<i style="font-size: 16px;" class="fa fa-bar-chart-o"></i>
								 </div>
								 
							<div class="row-fluid ui stackable four column grid" style=" margin-top:1.2%;">
								<div class="five wide column " style="height: 500px ;margin-right: 0">
									<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#mosModal" class="btn btn-sm btn-success "><span class="icon icon-display"></span>More</button>	
								
							</div>
							<div id="" class="tile"></div>
								</div>
								<div class="six wide column " style="height: 500px;margin-left: 0">
									<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#ordersModal" class="btn btn-sm btn-success "><span class="icon icon-display"></span>More</button>	
								
							</div>
							<div id="" class="tile"></div>
								</div>
								<div class="five wide column " style="height: 500px ;margin-right: 0">
									<div class="" style="height: 50px; padding: 8px;margin: 0;">
								
								<button data-toggle="modal" data-target="#consumptionModal" class="btn btn-sm btn-success "><span class="icon icon-display"></span>More</button>	
								
							</div>
							<div id="" class="tile"></div>
								</div>
								
																
							</div>	
								 
							
						</section>
						<!-- /END HCMP CONTENT -->
						
						<section id="section-underline-3">
							
	<div class="container-fluid">
		
		<div class="row">
			<div class="col-md-4" style="">
				
			</div>
			<div class="col-md-4" style="">
				
				
 <?php 
if ($popup=="errorpopup") {
  
 echo '<div class="alert alert-danger alert-dismissable" style="text-align:center;"> Error! Wrong Credentials! Try Again.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>';
}elseif ($popup=="passwordchange") {
  echo  '<div class="alert alert-success alert-dismissable" style="text-align:center;">Your password '.$user_email.' has been changed. Please login.
<button type="button" class=" close" data-dismiss="alert" aria-hidden="true">×</button>
','</div>';
}elseif ($popup=="activation") {
  echo  '<div class="alert alert-success alert-dismissable" style="text-align:center;">Your account has been Activated. Please login.
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
        <div class="col-md-3">

       <!--<a href="<?php echo base_url('national/demo_accounts') ?>"><button class="btn btn-primary ">Demo Site Login Credentials </button></a>--></div>

  <div class="col-md-6"> 
  			<div class="row">
          <div class="col-md-1"></div>
          <div class="col-md-10">
            <div id="contain_login" class="">
    <h2><span style="margin-right: 0.5em;" class="glyphicon glyphicon-lock"></span>Login</h2> 
    <?php 
    
   echo form_open('user/login_submit'); ?>
<div id="login" >

    
  <div class="form-group" style="margin-top: 2.3em;">
    <label for="exampleInputEmail1">Email address</label>
    <input type="text" class="form-control input-lg" name="username" id="username" placeholder="Enter email" required="required">
  </div>
  <div class="form-group" style="margin-bottom: 2em;">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" class="form-control input-lg" name="password" id="password" placeholder="Password" required="required">
  </div>
  
   <input type="submit" class="btn btn-primary " name="register" id="register" value="Log in" style="margin-bottom: 3%;">
   
  <a class="" style="margin-left: 2%;" href="<?php echo base_url().'user/forgot_password'?>" id="modalbox">Can't access your account ?</a>
  <a class="" style="margin-left: 2%;" href="<?php echo base_url().'user/sms_activate'?>" id="modalbox">Activate my Account?</a>
    
    
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
							
						</section>
					</div><!-- /content -->
					
				</div><!-- /tabs -->
				
				
				
				
		</div>
   	
  <!-- Modal -->
<div class="modal fade" id="mosModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">MOS</h4>
      </div>
      <div class="modal-body">
       	<div class="row-fluid filters" style="height: 40px;">
      		<section class="col-lg-3">
      				
					<select class="form-control " id="county_val">
						<option value="NULL">Select County</option>
						<?php
							foreach($county as $data):
							    $county_id=$data["id"];
								$county_name=$data["county"];
							      echo "<option class='item' value='$county_id'>$county_name</option>";
							    
							endforeach;
						?>
					</select>
					
					
      		</section>
      		
      		<section class="col-lg-3">
      				
					<select class="form-control " id="subcounty_val">
						<option value="NULL">Select sub-county</option>
						
					</select>
					
					
					
      		</section>
      		<section class="col-lg-3">
      				
					<select class="form-control " id="commodity_name">
						<option value="NULL">Select Commodity</option>
						<?php
							foreach($commodities as $data):
							    $c_id=$data["id"];
								$c_name=$data["commodity_name"];
							      echo "<option class='item' value='$c_id'>$c_name</option>";
							    
							endforeach;
						?>
					</select>
					
					
					
      		</section>
      		<section class="col-lg-3">
      			<div class="ui green button mosfilter"><i class="fa fa-filter"></i> Filter</div>
      		</section>
      	</div>
       <div id="mosmodal">
       	
       </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal stockmosModal -->

 
 <!-- Modal -->
<div class="modal fade" id="facilitystatsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding: 10px">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Facility Statistics</h4>
      </div>
      <div class="modal-body" style="padding: 10px">
      	<div class="row-fluid filters" style="height: 40px;">
      		<section class="col-lg-3">
      				
					<select class="form-control " id="county_val2">
						<option value="NULL">Select County</option>
						<?php
							foreach($county as $data):
							    $county_id=$data["id"];
								$county_name=$data["county"];
							      echo "<option class='item' value='$county_id'>$county_name</option>";
							    
							endforeach;
						?>
					</select>
					
					
      		</section>
      		<section class="col-lg-3">
      				
					<select class="form-control " id="subcounty_val2">
						<option value="NULL">Select sub-county</option>
						
					</select>
					
					
					
      		</section>
      		<section class="col-lg-3 piefilter">
      				
      				<select class="form-control " id="piefilter">
						<option value="NULL">Select Criteria</option>
						<option value="activation">Activation</option>
						<option value="owner">Owner</option>
						<option value="level">Level/Type</option>
						
					</select>
      				
      			</section>
      		<section class="col-lg-3">
      			<div class="ui green button filterthis"><i class="fa fa-filter"></i> Filter</div>
      		</section>
      	</div>
      	
      	<div class="row-fluid">
      		<section class="col-lg-5 " style="height: auto;border: 0px solid #036;">
      			
      			<div id="pie">
      				
      			</div>
      			
      		</section>
      		<section class="col-lg-7 tabledata" style="border: 0px solid #036;">
      			
      			<div id="datatable" style="overflow-y: scroll;max-height: 400px;">
      				
      			</div>
      			
      		</section>
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal orderModal -->
   
      <!-- Modal -->
<div class="modal fade" id="consumptionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Facility Statistics</h4>
      </div>
      <div class="modal-body">
        <div class=""></div>
        <div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal consumptionModal -->

   <!-- Modal -->
<div class="modal fade" id="ordersModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Facility Statistics</h4>
      </div>
      <div class="modal-body">
        <div class=""></div>
        <div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal consumptionModal -->


<!-- Modal -->
<div class="modal fade" id="expiriesModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Facility Statistics</h4>
      </div>
      <div class="modal-body">
        <div class=""></div>
        <div></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal expiriesModal -->
    
    <script src="<?php echo base_url().'assets/tab-style/js/cbpFWTabs.js'?>"></script>
		<script>
		$('.ui.dropdown').dropdown();
					
		</script>
		
		
    <script>
    
    var url='<?php echo base_url(); ?>';
    
     $(document).ready(function () {
     	
     	
     	
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
					
							
				$("#county_val").change(function() {
			var option_value=$(this).val();
    		if(option_value==''){
    			$("#subcounty_val").hide('slow'); 
    		}else{
				var drop_down='';
 				var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_sub_county_json_data/"+$("#county_val").val();
 				$.getJSON( hcmp_facility_api ,function( json ) {
 					$("#subcounty_val").html('<option  >Select Sub-county</option>');
      				$.each(json, function( key, val ) {
      					drop_down +="<option  value='"+json[key]["id"]+"'>"+json[key]["district"]+"</option>"; 
      				});
      				$("#subcounty_val").append(drop_down);
    			});
    			$("#subcounty_val").show('slow');  
    			 
    		}
    	}); //end of district name change funtion
    	$("#county_val2").change(function() {
			var option_value=$(this).val();
    		if(option_value==''){
    			$("#subcounty_val2").hide('slow'); 
    		}else{
				var drop_down='';
 				var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_sub_county_json_data/"+$("#county_val2").val();
 				$.getJSON( hcmp_facility_api ,function( json ) {
 					$("#subcounty_val2").html('<option  >Select Sub-county</option>');
      				$.each(json, function( key, val ) {
      					drop_down +="<option  value='"+json[key]["id"]+"'>"+json[key]["district"]+"</option>"; 
      				});
      				$("#subcounty_val2").append(drop_down);
    			});
    			$("#subcounty_val2").show('slow');  
    			 
    		}
    	}); //end of district name change funtion
				
					//filter for statistics modal
		$(".filterthis").click(function(e) {
			
          var countyvalue=$("#county_val2").val(); 
          var subcountyvalue=$("#subcounty_val2").val();  
          var piefiltervalue=$("#piefilter").val(); 
              
        ajax_request('Kenya/statistics_table/'+countyvalue+'/'+subcountyvalue+'/'+piefiltervalue+'/',"#datatable");
        ajax_request('Kenya/statistics_pie/'+countyvalue+'/'+subcountyvalue+'/'+piefiltervalue+'/',"#pie");
        
        });
        $(".mosfilter").click(function(e) {
			
          var countyvalue2=$("#county_val").val(); 
          var subcountyvalue2=$("#subcounty_val").val() 
          var commodity=$("#commodity_name").val() 
              
        ajax_request('Kenya/mos_graph/'+countyvalue2+'/'+subcountyvalue2+'/'+commodity+'/NULL/mosmodal',"#mosmodal");
        
        });
        //ajax_request('kenya/mos_graph/NULL/NULL/NULL/NULL/mos',"#mos");
        ajax_request('Kenya/consumption/NULL/NULL/NULL/NULL',"#consumption");
        ajax_request('Kenya/orders/NULL/NULL/NULL/NULL/NULL',"#orders");
        ajax_request('Kenya/expiry/NULL/NULL/NULL/NULL/NULL',"#expiries");
     	
     	function ajax_request(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/Preloader_2.gif";
		        $.ajax({
		        	type: "POST",
		       		 url: function_url,
		       			 beforeSend: function() {
		       				 $(div).html("<img style='margin:25% 40% 20% 20%;' src="+loading_icon+">");
		       				 },
		       				 success: function(msg) {
		       					 $(div).html(msg);
		       		 }
        		});
        	}   
     	});
		
	</script>	
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
  		<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
		<!--  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
		<!-- Bootstrap core JavaScript===================== -->
		<script src="<?php echo base_url().'assets/scripts/jquery-ui-1.10.4.custom.min.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
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
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/loadingbar.css'?>" />
		<link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/elusive-webfont.css'?>" />

</body>

</html>