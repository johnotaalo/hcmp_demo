<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <title>HCMP | <?php echo $title;?> </title>    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="<?php echo base_url().'assets/img/coat_of_arms.png'?>" type="image/x-icon" />
	<link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/styles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/>  
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/normalize.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/dashboard.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/jquery-ui-1.10.4.custom.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/font-awesome.min.css'?>" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
    <link href="<?php echo base_url().'assets/datatable/TableTools.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/datatable/dataTables.bootstrap.css'?>" type="text/css" rel="stylesheet"/>
	
	<script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script> 
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
	<script src="<?php echo base_url();?>assets/highcharts/exporting.js"></script>
	<script src="<?php echo base_url().'assets/scripts/jquery-ui.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/jquery.validate.js'?>" type="text/javascript"></script> 
	<script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
	<script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/typehead/typeahead.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/typehead/handlebars.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>

	<!-- <link href="<?php echo base_url().'assets/metro-bootstrap/docs/font-awesome.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/metro-bootstrap/css/metro-bootstrap.css'?>" type="text/css" rel="stylesheet"/>
    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
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
.panel-success>.panel-heading {
color: white;
background-color: #528f42;
border-color: #528f42;
border-radius:0;

}
.navbar-default {
background-color: white;
border-color: #e7e7e7;
}
.modal-content
{
  border-radius: 0 !important;
}
#navigate ul {
	text-align: left;
	display: inline;
	margin: 0;
	padding: 13px 4px 17px 0;
	list-style: none;
}
/*
 * For National Outlook only as it doesnt display properly
 */
#navigate ul li {
	display: inline-block;
	margin-right: -4px;
	position: relative;
	padding: 13px 18px;
	background: #29527b; /* Old browsers */
	cursor: pointer;
	-webkit-transition: all 0.2s;
	-moz-transition: all 0.2s;
	-ms-transition: all 0.2s;
	-o-transition: all 0.2s;
	transition: all 0.2s;
}

</style>
  </head> 
<body style="padding-top: 0;">
	<div class="container-fluid navbar-default navbar-fixed-top" role="navigation" style="background-color:white">
        <div class="container-fluid">
            <div class="navbar-header" id="st-trigger-effects">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand " href="<?php echo base_url().'national';?>" >HCMP</a>

        </div>
        <div class="navbar-header" >
  
            <a href="<?php echo base_url().'national';?>">   
            <img style="display:inline-block;"  src="<?php echo base_url();?>assets/img/coat_of_arms_dash.png" class="img-responsive " alt="Responsive image" id="logo" ></a>
            
        </div>
        
        <div class="collapse navbar-collapse navbar-right">
          <ul class="nav navbar-nav navbar-right">
            <li class="active"><a href="<?php echo base_url().'national';?>">Home</a></li>
            <li class=""><a href="<?php echo base_url().'national/reports';?>">Reports</a></li>
            <li class=""><a href="<?php echo base_url().'national/search';?>">Search</a></li>
            <li class="dropdown" style="background: #144d6e; color: white;">
     		<a href="#" class="dropdown-toggle" style="color:white" data-toggle="dropdown" role="button" aria-expanded="false">Log In <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
              	<li role="presentation"><a role="menuitem" tabindex="-1" href="<?php echo base_url().'home';?>"><span class="glyphicon glyphicon-user"></span>Essential Commodities</a></li>
                <li role="presentation" class="divider"></li>
                <li role="presentation"><a role="menuitem" tabindex="-1" href="http://41.89.6.223/HCMP/user"><span class="glyphicon glyphicon-user"></span>RTK</a></li>
                
              </ul>
            </li>
                    
          </ul>
          
                                        
        </div><!--/.nav-collapse -->

      </div>
    </div>

<div style="margin-left: 2%;margin-right: 2%;margin-top: 0%;" class="inner_wrapper"> 
 <div class="row" style="margin-top: 0%;">
     <div class="col-md-4" style="margin-top: 6.5%;"> <!-- map -->
      <div class="panel panel-success">
            <div class="panel-heading">
                <h3 class="panel-title" style="display:inline-block;">National Overview</h3>
            </div>
      <div class="panel-body">
      *Click on a County to View Data
      <div id="map" style="width:400px; height: 600px;">
                   
                   <script>
var map= new FusionMaps ("assets/FusionMaps/FCMap_KenyaCounty.swf","KenyaMap","100%","100%","0","0");
map.setJSONData(<?php
echo $maps; ?>
    );
    map.render("map");
                    </script>


        </div>
        <div style="width:130px;margin-left:30%;padding:2%">
            <div style="display:inline-block;width:10px;height:10px;background:#FFCC99">
                
            </div>
            <div style="width:80px;display:inline-block;margin-left:5px;font-size:120%">Using HCMP</div></div>
      </div> 
      </div>      
     </div><!-- map -->
     <div class="col-md-8"> <!-- 4 cell -->
      <div class="row"><!-- facility infor -->
       <div class="col-md-6"style="margin-top: 9.5%;">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Facility Overview</h3>
       </div>
        <div class="panel-body">
       
          <div style="display:table-row" >
            <div style="display:table-cell">
                <p style="font-size:120%;display: inline-block;"> <span class="glyphicon glyphicon-user"></span>#HCW Trained  &nbsp;
                <div style="display: inline-block;" id="hcw_trained"></p></div></div>
         <div style="display:table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div style="display:table-cell;">
             <p style="font-size:120%;display: inline-block;"><span class="glyphicon glyphicon-calendar"></span>#Facilities Rolled Out  &nbsp;
                 <div style="display: inline-block;" id="facilities_rolled_out"></div></p></div>   
          </div>
       </div>    
       </div>
       </div>
       <div class="col-md-6" style="margin-top: 9.5%;">
       <div class="panel panel-success" >
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Facility Information</h3>
       </div>
        <div class="panel-body">
     <div id="facilities"></div>
          </div>
       </div>    
       </div>      
     </div><!-- facility infor -->
 <div class="row"> <!-- row 2-->
    <div class="col-md-12" style="margin-left: -10px">
       <div class="panel panel-success">
	       <div class="panel-heading">
	       	<h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Expiries</h3>
	       </div>
	       <!--For the Expiries Tab-->
	       <div class="panel-body" style="height:500px;">
	       	<ul class='nav nav-tabs'>
		      <li class="active"><a href="#stracer" data-toggle="tab">Expiries</a></li>
	      	</ul>
	      	<div id="myTabContent" class="tab-content">
      			<div class="row" style="margin-left: 2px">
	        	<div class="filter row" style="margin-left: 2px;">
	        	<form class="form-inline" role="form">
					<select id="ecounty_filter" class="form-control col-md-2 county">
						<option value="NULL">Select County</option>
						<?php
							foreach($counties as $data):
							    foreach($data as $key=>$name):
							      echo "<option value='$key'>$name</option>";
							    endforeach;
							endforeach;
						?>
					</select>   
					<select id="eyear" class="form-control col-md-2">
						<option selected="selected" value="NULL">Select Year</option>
						<option  value="2014">2014</option>
						<option  value="2013">2013</option>
					</select> 
					<div class="col-md-2">
					<button class="btn btn-sm btn-success ecounty-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
					</div>
	
				</form>
				</div>
	        	
	
	        </div>
       </div>
       		
	        <div id="actual">test</div>
	       </div>
	          
       </div> 
       </div>
 </div> <!-- row 2-->
     </div><!-- 4 cell -->
 </div> <!-- row 1-->
 <div class="row">
                <div class="col-md-6">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Stock Level in Months of Stock (MOS)</h3>
       </div>
        <div class="panel-body" style="height:500px;">
        <ul class='nav nav-tabs'>
      <li class="active"><a href="#stracer" data-toggle="tab">Tracer Items</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
      <div  id="stracer" class="tab-pane fade active in">
<br>
<div class="col-md-1">
    <a href="national/search" target="_blank">
    <button class="btn btn-sm btn-success"><span class="glyphicon glyphicon-filter"></span>More</button> 
</a>

</div>
      </div>
       </div>
        <div id="mos"></div> <!--- MOS -->
       </div>
       
       </div>
      
       </div>
       <div class="col-md-6">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Consumption</h3>
       </div>
        <div class="panel-body" style="height: 500px;">
       <ul class='nav nav-tabs'>
      <li class="active"><a href="#tracer" data-toggle="tab">Tracer Items</a></li>
       </ul>
   <div id="myTabContent" class="tab-content">
                <div  id="tracer" class="tab-pane fade active in">
<br>
<div class="col-md-1">
    <a href="national/search" target="_blank">
    <button class="btn btn-sm btn-success"><span class="glyphicon glyphicon-filter"></span>More</button> 
</a>

</div>

        
      </div>
      </div>
      <div id="consumption"></div> <!-- consumption -->
       </div>    
       </div>
       </div>
 </div><!--- row 2 -->
  <div class="row">
                <div class="col-md-6">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Cost of Orders</h3>
       </div>
        <div class="panel-body" style="height:500px;">
        <ul class='nav nav-tabs'>
      <li class="active"><a href="#corders" data-toggle="tab">Year</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
      <div  id="corders" class="tab-pane fade active in">
<br>
<div class="col-md-1">
    <a href="national/search" target="_blank">
    <button class="btn btn-sm btn-success"><span class="glyphicon glyphicon-filter"></span>More</button> 
</a>

</div>
      </div>
       </div>
        <div id="orders"></div> <!--- MOS -->
       </div>
       
       </div>
      
       </div>
       <div class="col-md-6">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Order Lead Time</h3>
       </div>
        <div class="panel-body" style="height: 500px;">
  <hr />
    <a href="national/search" target="_blank">
    <button class="btn btn-sm btn-success"><span class="glyphicon glyphicon-filter"></span>More</button> 
</a>
      <div class="row">
          <div class="col-md-12">
       <!--<div class="panel-heading">
       <h3 class="panel-title">Fill Rate</h3>
       </div>
       <div id="fill_rate">
            <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
        80%
    </div>
      </div>
       </div>-->
       </div>  
       <div class="col-md-12">
       <div class="panel-heading">
       <h3 class="panel-title">Order Lead Time</h3>
       </div>
       <div id="lead_infor">
         


       </div>
       </div>  
      </div>
    
       </div>    
       </div>
       </div>
     </div>
</div>

<div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>
 <input type="hidden" name="county_id" id="county_id" />   
</body>
<script>
         //auto run
         var url ='<?php echo base_url()?>';
        // $('#potential_').on('shown.bs.tab', function (e) {
        // $('#potential').html('');
       // });
         $('#actual_').on('shown.bs.tab', function (e) {
         $('#actual').html('');
         });

      $('.county-name').html("National "+" &nbsp;");
      ajax_request_replace_div_content('national/expiry/NULL/NULL/NULL/NULL/NULL',"#actual"); 
      //ajax_request_replace_div_content('national/potential/NULL/NULL/NULL/NULL/NULL',"#potential"); 
      ajax_request_replace_div_content('national/facility_over_view/',"#facilities_rolled_out");
      ajax_request_replace_div_content('national/hcw/',"#hcw_trained");
      ajax_request_replace_div_content('kenya/mos_graph/NULL/NULL/NULL/NULL',"#mos");
      ajax_request_replace_div_content('national/consumption/NULL/NULL/NULL/NULL',"#consumption");
      ajax_request_replace_div_content('national/get_facility_infor/NULL/NULL/NULL/NULL',"#facilities");
      ajax_request_replace_div_content('national/order/NULL/NULL/NULL/NULL/NULL',"#orders");
      ajax_request_replace_div_content('national/get_lead_infor/NULL/NULL/NULL/NULL/NULL',"#lead_infor");
      
        $(".ecounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var year = $("#eyear").val();
        var county = $("#ecounty_filter").val();
       // var district=$(this).closest("tr").find("#ecounty_filter").val();
       // var facility=$(this).closest("tr").find("#ecounty_filter").val();
           ajax_request_replace_div_content('national/expiry/'+year+'/'+county+'/NULL/NULL/NULL',"#actual");
        });
        
        $(".asubcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var year=$("#asubcountyyear").val();
        var county_id=$('#county_id').val();
        var district=$("#asubcounty_filter").val();
        var facility=$("#asubcounty_facility_filter").val();
        ajax_request_replace_div_content('national/expiry/'+year+'/'+county_id+'/'+district+'/'+facility+'/NULL',"#actual");
        });
        /////potential
        $(".pcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var county=$("#pcounty_filter").val();
        ajax_request_replace_div_content('national/potential/'+county+'/NULL/NULL/NULL',"#potential");
        });
        
        $(".psubcounty-filter").button().click(function(e) {
        e.preventDefault(); 
        var county_id=$('#county_id').val();
        var district=$("#psubcounty_filter").val();
        var facility=$("#psubcounty_facility_filter").val();
        ajax_request_replace_div_content('national/potential/'+county_id+'/'+district+'/'+facility+'/NULL',"#potential");
        });
     
         $(".subcounty").click(function(){
            /*
             * when clicked, this object should populate facility names to facility dropdown list.
             * Initially it sets a default value to the facility drop down list then ajax is used 
             * is to retrieve the district names using the 'dropdown()' method used above.
             */
            json_obj = {"url":"<?php echo site_url("orders/getFacilities");?>",}
            var baseUrl = json_obj.url;
            var id = $(this).attr("value");
            $('.subcounty').val(id);
            dropdown(baseUrl,"district="+id,".facility");
 
          
        });

      
    function run(data){
        var county_data=data.split('^');
        $('.county-name').html(county_data[1]+"&nbsp;County &nbsp;");
        ajax_request_replace_div_content('national/facility_over_view/'+county_data[0],"#facilities_rolled_out");
        ajax_request_replace_div_content('national/hcw/'+county_data[0],"#hcw_trained");
        $('.county').val(county_data[0]);
        $('#county_id').val(county_data[0]);
        json_obj={"url":"<?php echo site_url("orders/getDistrict");?>",}
        var baseUrl=json_obj.url;
        dropdown(baseUrl,"county="+county_data[0],".subcounty");
        ajax_request_replace_div_content('national/expiry/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#actual");
        //ajax_request_replace_div_content('national/potential/'+county_data[0]+'/NULL/NULL/NULL/NULL',"#potential"); 
        ajax_request_replace_div_content('national/stock_level_mos/'+county_data[0]+'/NULL/NULL/NULL/ALL',"#mos");
        ajax_request_replace_div_content('national/consumption/'+county_data[0]+'/NULL/NULL/NULL',"#consumption");
        ajax_request_replace_div_content('national/get_facility_infor/'+county_data[0]+'/NULL/NULL/NULL',"#facilities");
        ajax_request_replace_div_content('national/order/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#orders");
        ajax_request_replace_div_content('national/get_lead_infor/NULL/'+county_data[0]+'/NULL/NULL/NULL',"#lead_infor");
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
       function ajax_request_replace_div_content(function_url,div){
        var function_url =url+function_url;
        var loading_icon=url+"assets/img/loader2.gif";
        $.ajax({
        type: "POST",
        url: function_url,
        beforeSend: function() {
        $(div).html("<img style='margin-left:20%;' src="+loading_icon+">");
        },
        success: function(msg) {
        $(div).html(msg);
        }
        });
        }   
</script>

</html>
