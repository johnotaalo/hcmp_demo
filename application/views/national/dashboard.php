<html lang="en">
	
	<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">   
    <!-- Bootstrap core CSS -->  
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
    <link href="<?php echo base_url().'assets/bower_components/semantic/packaged/css/semantic.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/font-awesome/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/bower_components/ionicons-2.0.0/css/ionicons.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/bower_components/semantic/packaged/javascript/semantic.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
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
    	font-family: "Segoe UI Light","Segoe UI","Segoe WP","Helvetica Neue",sans-serif;
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
		font-size:1.7rem;
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
<div class="ui stackable four column grid" >
	
	  <div class="four wide column" style="margin-top: 0">
	  	<div class="ui grid">
	  		<div class="three wide column">
	  			<div class="item" style=""><a href="<?php echo base_url().'national';?>" style="">   
           						 <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" 
           						 class="img-responsive " alt="Responsive image" id="logo" ></a></div>
	  		</div>
	  		<div class="ten wide column">
	  			<div style="margin-top: 12">Ministry of Health</div>
	  		</div>
	  	</div>
	  	
	  	
           						 
	  </div>
	  
	  <div class="six wide column">
	  	
	  </div>
	  <div class="six wide column">
	  	<div class="ui menu">
  
  <div class="right menu">
    <a class="active item">
    <i class="home icon"></i> Home
  </a>
 
  <div class="ui dropdown item">
      Log In <i class="dropdown icon"></i>
      <div class="menu">
        <a href="<?php echo base_url().'home';?>" class="item">HCMP</a>
        <a href="" class="item">RTK</a>
      </div>
  </div>
  </div>
</div>
	  </div>
	  	
	  

</div>

<div class="ui stackable four column grid" style="max-height: 550px">

			<div id="" class="five wide column" style="margin-top: 1%;">

				<div class="tile"  style="max-height: 400px;">
					<div class="tile-header">
						National Over view
					</div>
					<div id="map" style="max-height: 480px;"></div>
					<script>
					var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
					map.setJSONData(<?php echo $maps; ?>
						);
					
						map.render("map");

					</script>

				</div>

			</div>

			<div id="" class="eleven wide column " style="margin-top: 1%;height: 480px">

				<div class="ui statistics ">
					<div class="ui grid tile ">
						<div class="tile-header">
							National Statistics
						</div>
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

								<div class="ion-chevron-right">
									More
								</div>
							</div>
						</div>

					</div>

					<div class="ui grid">
						<div class="tile" style="height: 420px">
							<div class="" style="height: 50px; padding: 8px;margin: 0;">

								<button data-toggle="modal" data-target="#expiriesModal" class="btn btn-xs btn-success test ">
									<span class="icon icon-display"></span>More
								</button>

							</div>
							<div id="expiries"></div>
						</div>
					</div>

				</div>

			</div>

		</div>
<div class="ui horizontal divider" style="margin-top: 2.2%">
			<i style="font-size: 16px;" class="fa fa-bar-chart-o"></i>
		</div>

   	
<div class="row-fluid ui stackable four column grid" style=" margin-top:1.2%;">
			<div class="five wide column " style="height: 500px ;margin-right: 0">
				<div class="" style="height: 50px; padding: 8px;margin: 0;">

					<button data-toggle="modal" data-target="#mosModal" class="btn btn-sm btn-success ">
						<span class="icon icon-display"></span>More
					</button>

				</div>
				<div id="" class="tile"></div>
			</div>
			<div class="six wide column " style="height: 500px;margin-left: 0">
				<div class="" style="height: 50px; padding: 8px;margin: 0;">

					<button data-toggle="modal" data-target="#ordersModal" class="btn btn-sm btn-success ">
						<span class="icon icon-display"></span>More
					</button>

				</div>
				<div id="" class="tile"></div>
			</div>
			<div class="five wide column " style="height: 500px ;margin-right: 0">
				<div class="" style="height: 50px; padding: 8px;margin: 0;">

					<button data-toggle="modal" data-target="#consumptionModal" class="btn btn-sm btn-success ">
						<span class="icon icon-display"></span>More
					</button>

				</div>
				<div id="" class="tile"></div>
			</div>

		</div>

    
		<script>
		$('.ui.dropdown').dropdown();
					
		</script>
		
		
    <script>
    
    var url='<?php echo base_url(); ?>';
    
     $(document).ready(function () {
						
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
    <!-- core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
		<script src="<?php echo base_url('assets/scripts/county_sub_county_functions.js')?>" type="text/javascript"></script>
		<!-- High Charts core JavaScript===================== -->
		<script src="<?php echo base_url().'assets/scripts/highcharts.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url().'assets/scripts/exporting.js'?>" type="text/javascript"></script>
		<script src="<?php echo base_url().'assets/scripts/jquery.floatThead.min.js'?>" type="text/javascript"></script>
		<!-- Placed at the end of the document so the pages load faster -->
		
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