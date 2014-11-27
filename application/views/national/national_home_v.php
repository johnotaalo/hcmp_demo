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
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/tab-style/css/demo.css'?>" />
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
		
		width: 74%;
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
	
		<div class="tabs tabs-style-bar navbar-fixed-top">
	
					<nav>
						<ul><div style="margin: 13 6 0 0;">Ministry of Health</div>
							<a href="<?php echo base_url().'national';?>" style="margin-right: 60">   
           						 <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a></li>
							<li><a href="#hcmp" class="icon icon-graph1"><span>HCMP</span></a>
							<li><a href="#rtk" class="icon icon-display"><span>RTK</span></a></li>
							<li><a href="<?php echo base_url().'home';?>" class="icon icon-user"><span>System Log in</span></a></li>
							<li><a href="#section-underline-5" class="icon icon-config"><span>Settings</span></a></li>
						</ul>
					</nav>
					
					<div class="content-wrap">
						
							<!-- BEGIN HCMP CONTENT -->
						<section id="hcmp" class="row-fluid">
							
							<div class="row-fluid" style="max-height: 460px">							
							
							
						<div id="" class="col-lg-4" style="margin-top: 1%;">
							
							<div class="tile"  style="max-height: 460px;">
							<div id="map" style="max-height: 400px;"></div>	
						<script>
					var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
					map.setJSONData(<?php echo $maps; ?>);
					
    				map.render("map");
    				
                    </script>
                   		 <div style="">
				            <div style="display:inline-block;width:9px;height:9px;background:#528f42">
				                
				            </div> Using HCMP
				            
				            </div>
							</div>
							
			
					
						
						
						</div>
						
						<div id="" class=" tile col-lg-6" style="margin-top: 1%;">
							<div class="" style="height: 50px;">
								
									<button class="btn btn-sm btn-success"><span class="icon icon-display"></span>More</button>
								
							</div>
							<div class="" id="mos" style="height:370px ">
					
							</div>
						</div>
						
						<div id="" class="col-lg-2 tile" style="margin-top: 1%;height: 420px">
							
							<div class="" id="" style="height: ">
							<div class="row" style="">
								
								<div class="col-xs-1"></div>
								<div class="col-xs-10">
									<a href="" data-toggle="modal" data-target="#facilitystatsModal">
										<div class="">
											<span class="glyphicon glyphicon-user"></span>
					                  	Facilities with Stockouts <br/> <span id="hcw_trained"></span>
					                            
					                   </div>
					                   </a>
								</div>
								<div class="col-xs-1"></div>
								
							</div>
							<div class="row" >
								<div class="col-xs-1"></div>
								<div class="col-xs-10">
									<a href="" class="" data-toggle="modal" data-target="#Modal">
											<div class="">
												<span class="glyphicon "></span>
						                 	Facilities Rolled Out <br/><span id="facilities_rolled_out"></span> 
						                            
						                   </div>
						                   </a>
								</div>
								<div class="col-xs-1"></div>
										
							</div>
							</div>
						</div>
						
						
							</div>
							
							<div class="ui horizontal divider">
								<i class="fa fa-bar-chart-o"></i>
								 </div>
							
							<div class="row-fluid" style=" margin-top:1.2%;min-height: 400px">
								
								
							</div>
							
						</section>
						<!-- /END HCMP CONTENT -->
						
						
						
						
						
						
						
						
						
						
						
						
						<section id="rtk" class="row-fluid">
							<div id="" class="col-lg-3">
							<p>RTK dash</p>
							
						</div>
							
						</section>
						
						
						
						<section id="section-underline-3"><p>Log in</p></section>
						<section id="section-underline-5"><p>Settings</p></section>
					</div><!-- /content -->
					
				</div><!-- /tabs -->
				
				
				
				
		</div>
   	
  <!-- Modal -->
<div class="modal fade" id="facilitystatsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Facility Statistics</h4>
      </div>
      <div class="modal-body">
       <div class="">
       	
       </div>
       <div id="mosmodalgraph">
       	
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
<div class="modal fade" id="consumptionModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal consumptionModal -->

 <!-- Modal -->
<div class="modal fade" id="orderModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title" id="myModalLabel">Modal title</h4>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- end Modal orderModal -->
   
   
   
   
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="<?php echo base_url().'assets/tab-style/js/cbpFWTabs.js'?>"></script>
		<script>
			(function() {

				[].slice.call( document.querySelectorAll( '.tabs' ) ).forEach( function( el ) {
					new CBPFWTabs( el );
				});

			})();
		</script>
		
		<script>
   
  // ajax_fill_data('Kenya/facility_breakdown_pie',"#facility_breakdown");
  // ajax_fill_data('Kenya/mos_graph/NULL/NULL/NULL/NULL/NULL/mos',"#mos");
  // ajax_fill_data('Kenya/roll_out',"#roll_out");
  // ajax_fill_data('Kenya/consumption',"#consumption");
  // ajax_fill_data('national/expiry/NULL/NULL/NULL/NULL/NULL',"#actual_ex");
  // ajax_fill_data('Kenya/potential_expiries',"#potential_ex");
  // ajax_fill_data('national/order/NULL/NULL/NULL/NULL/NULL',"#orders");
  // ajax_fill_data('Kenya/write_dashboard_html',"#hcw_trained");
  // ajax_fill_data('Kenya/facility_over_view/',"#facilities_rolled_out");
  // ajax_fill_data('Kenya/get_lead_infor/NULL/NULL/NULL/NULL/NULL',"#leadtime");
   
   		 $("#mosgraph").click(function() {
    	ajax_fill_modal('Kenya/mos_graph/NULL/NULL/NULL/NULL/NULL/mosmodalgraph',"#mosmodalgraph");
    	});
    	
    	function ajax_fill_modal(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/Preloader_1.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin:20% 40% 0 40%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }  
   
   function ajax_fill_data(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/Preloader_1.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin:40% 50% 0 50%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }  
        
        function run(data){
        var county_data=data.split('^');
        $('.county-name').html(county_data[1]+"&nbsp;County &nbsp;");
        ajax_fill_data('Kenya/facility_breakdown_pie/'+county_data[0],"#facility_breakdown");
        ajax_fill_data('Kenya/facility_over_view/'+county_data[0],"#facilities_rolled_out");
        ajax_fill_data('Kenya/write_dashboard_html/'+county_data[0],"#hcw_trained");
        $('.county').val(county_data[0]);
        $('#county_id').val(county_data[0]);
        json_obj={"url":"<?php echo site_url("orders/getDistrict");?>",}
        var baseUrl=json_obj.url;
        dropdown(baseUrl,"county="+county_data[0],".subcounty");
        ajax_fill_data('national/expiry/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#actual_ex");
        ajax_fill_data('Kenya/potential_expiries/'+county_data[0]+'/NULL/NULL/NULL/NULL',"#potential_ex"); 
        ajax_fill_data('Kenya/mos_graph/'+county_data[0]+'/NULL/NULL/NULL/NULL/mos',"#mos");
        ajax_fill_data('Kenya/consumption/'+county_data[0]+'/NULL/NULL/NULL',"#consumption");
       // ajax_request_replace_div_content('national/get_facility_infor/'+county_data[0]+'/NULL/NULL/NULL',"#facilities");
        ajax_fill_data('national/order/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#orders");
       // ajax_request_replace_div_content('national/get_lead_infor/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#lead_infor");
    } 
    
        function dropdown(baseUrl,post,identifier){
            /*
             * ajax is used here to retrieve values from the server side and set them in dropdown list.
             * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
             * 'identifier' is the id of the dropdown list to be populated by values from the server side
             */
            $.ajax({
              type: "POST",
              url: baseUrl,
              data: post,
              success: function(msg){
                    var values=msg.split("_")
                    var dropdown="<option value='NULL'>All</option>";
                    for (var i=0; i < values.length-1; i++) {
                        var id_value=values[i].split("*")
                        dropdown+="<option value="+id_value[0]+">";
                        dropdown+=id_value[1];
                        dropdown+="</option>";
                    };
                    $(identifier).html(dropdown);
              },
              error: function(XMLHttpRequest, textStatus, errorThrown) {
                   if(textStatus == 'timeout') {}
               }
            }).done(function( msg ) {
            });
        }
         
</script>
    <script>
    var url='<?php echo base_url(); ?>';
    </script>
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