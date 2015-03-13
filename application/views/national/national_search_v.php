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
    <link href="<?php echo base_url().'assets/css/offline-theme-default.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/styles.css'?>" type="text/css" rel="stylesheet"/>
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/>  
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
	<link href="<?php echo base_url().'assets/css/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
	<link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
	
	<script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
    <script src="<?php echo base_url().'assets/scripts/offline-simulate-ui.min.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/typehead/handlebars.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script> 
	<script src="<?php echo base_url();?>assets/highcharts/highcharts.js"></script>
	<script src="<?php echo base_url();?>assets/highcharts/exporting.js"></script>
	<script src="<?php echo base_url().'assets/scripts/jquery-ui.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script> 
	<script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
	<script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
	<script src="<?php echo base_url().'assets/scripts/typehead/typeahead.js'?>" type="text/javascript"></script>
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
.tt-dropdown-menu {
  position: absolute;
  top: 100%;
  left: 0;
  z-index: 1000;
  display: none;
  float: left;
  min-width: 160px;
  padding: 5px 0;
  margin: 2px 0 0;
  list-style: none;
  font-size: 14px;
  background-color: #ffffff;
  border: 1px solid #cccccc;
  border: 1px solid rgba(0, 0, 0, 0.15);
  border-radius: 4px;
  -webkit-box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  box-shadow: 0 6px 12px rgba(0, 0, 0, 0.175);
  background-clip: padding-box;
}
.tt-suggestion > p {
  display: block;
  padding: 3px 20px;
  clear: both;
  font-weight: normal;
  line-height: 1.428571429;
  color: #333333;
  white-space: nowrap;
}
.tt-suggestion > p:hover,
.tt-suggestion > p:focus,
.tt-suggestion.tt-cursor p {
  color: #ffffff;
  text-decoration: none;
  outline: 0;
  background-color: #428bca;
}
.typeahead {width: 400px;}
.query-title{border-bottom:inset; font-weight:bold}

    .input-small{
        width: 100px !important;
    }
    .input-small_{
        width: 230px !important;
    }
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
      <div id="header_container" class="" id="top-panel" style="margin-bottom: 0px" >

    <div class="banner_logo">
            <a class="logo" href="<?php echo base_url();?>" ></a> 
        </div>

                <div id="logo_text">
                    <span style="display: block; font-weight: bold; font-size: 14px; margin:2px;">Ministry of Health</span>
                    <span style="display: block; font-size: 12px;">Health Commodities Management Platform(HCMP)</span>  
                </div>
      
 <div id="main_menu"> 

<div class="navbar-collapse collapse" id="navigate">
<ul>
    <li class="<?php
if (@@$current == "national") {echo "active";
}
?>"><a  href="<?php echo base_url(); ?>national">National </a></li>
    <li class="<?php
if (@@$current == "national") {echo "active";
}
?>"><a  href="<?php echo base_url(); ?>national/search">Search</a></li>
</ul>
</div>
</div>
<div style="font-size:0.75em; float:right; padding: 0.5em "><?php  echo date('l, dS F Y'); ?>&nbsp;<div id="clock" style="font-size:0.75em; float:right; " ></div>
     </div>
    
</div>
<div style="margin-left: 2%;margin-right: 1%; margin-top: 0%"> 
<div class="row" style="margin-top: 0%;">
<div class="col-md-4" style="margin-top: 6.5%;">
        <div class="panel panel-success" >
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Search</h3>
       </div>
        <div class="panel-body">
     <div id="multiple-datasets">
  <input class="typeahead form-control" type="text" placeholder="facility , county, subcounty name" data-provide="typeahead">
</div>
          </div>
       </div>    
</div><!-- search -->
</div><!-- end row 1-->
<div class="row"><!-- row 2-->
<div class="col-md-6">
           <div class="panel panel-success" >
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Facility Overview</h3>
       </div>
        <div class="panel-body">
     <div style="display:table-row" >
            <div style="display:table-cell">
               
               <p style="font-size:120%;display: inline-block;"> <span class="glyphicon glyphicon-user"></span>
                   <a id="hcw_excel" class="excel_" >#HCW Trained  &nbsp;</a>
                <div style="display: inline-block;" id="hcw_trained"></div></p> </div>
         <div style="display:table-cell;">&nbsp;&nbsp;&nbsp;&nbsp;</div>
            <div style="display:table-cell;">
             <p style="font-size:120%;display: inline-block;"><span class="glyphicon glyphicon-calendar"></span>
              <a id="rolled_out" class="excel_" >   #Facilities Rolled Out  &nbsp; </a>
                 <div style="display: inline-block;" id="facilities_rolled_out"></div></p></div>   
          </div>
          </div>
       </div> 
    
</div><!-- trained -->
<div class="col-md-6">
           <div class="panel panel-success" >
       <div class="panel-heading">
       <h3 class="panel-title" style="display:inline-block;"><div class="county-name" style="display:inline-block"></div>Facility Information</h3>
       </div>
        <div class="panel-body">
     <div id="facilities"></div>
          </div>
       </div> 
    
</div><!-- facilities -->
</div><!-- end row 2-->
<div class="row"><!-- row 3-->
      <div class="col-md-6"><!-- stock infor -->
                 <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Stock Level in Months of Stock (MOS)</h3>
       </div>
        <div class="panel-body" style="height:500px;">
        <ul class='nav nav-tabs'>
      <li class="active"><a href="#stracer" data-toggle="tab">Tracer Items</a></li>
      <li><a href="#sall" data-toggle="tab">All Items</a></li>
      </ul>
      <div id="myTabContent" class="tab-content">
      <div  id="stracer" class="tab-pane fade active in">
          <br />
           <form class="form-inline" role="form">
<div class="col-md-2">
<button class="btn btn-sm btn-success excel_" id="mos-download">
<span class="glyphicon glyphicon-save"></span>Download</button> 
</div>

          </form>
      </div>
            <div  id="sall" class="tab-pane fade  in">
                <br>
           <form class="form-inline" role="form">
           <select id="mos_commodity_filter" class="form-control col-md-3 input-small_">
<option value="NULL">Select Commodity</option>
<?php   
foreach($c_data as $data):
        $commodity_name=$data['drug_name'];    
        $commodity_id=$data['id'];
        echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>
<div class="col-md-2">
<button class="btn btn-sm btn-success filter" id="mos-commodity-filter">
<span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success excel_" id="mos-commodity-download">
    <span class="glyphicon glyphicon-save"></span>Download</button> 
</div>

          </form>
      </div>
       </div>
       
        <div id="mos"></div>
       </div>
       
       </div>
      </div> <!--mos -->
      <div class="col-md-6">
      <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Consumption</h3>
       </div>
        <div class="panel-body" style="height: 500px;">
       <ul class='nav nav-tabs'>
      <li class="active"><a href="#tracer" data-toggle="tab">Tracer Items</a></li>
       <li><a href="#all" data-toggle="tab">All Items</a></li>
       </ul>
   <div id="myTabContent" class="tab-content">
     <div  id="tracer" class="tab-pane fade active in">
<br>
<input type="text" name="from"  id="tracer_from" 
placeholder="FROM" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<input type="text" name="to"  id="tracer_to" placeholder="TO" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<div class="col-md-2">
<button class="btn btn-sm btn-success filter" id="tracer-consumption-filter">
<span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success excel_" id="tracer-consumption-download">
    <span class="glyphicon glyphicon-save"></span>Download</button> 
</div>

          </form>
      </div>
            <div  id="all" class="tab-pane fade  in">
                <br>
           <form class="form-inline" role="form">
           <select id="all_consumption_filter" class="form-control col-md-3 input-small_">
<option value="NULL">Select Commodity</option>
<?php
foreach($c_data as $data):
        $commodity_name=$data['drug_name'];    
        $commodity_id=$data['id'];
        echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>
<input type="text" name="from"  id="all_from" 
placeholder="FROM" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<input type="text" name="to"  id="all_to" placeholder="TO" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<div class="col-md-2">
<button class="btn btn-sm btn-success filter" id="all-commodity-filter">
    <span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success excel_" id="all-commodity-download">
    <span class="glyphicon glyphicon-save"></span>Download</button> 
</div>

          </form>
      </div>
      </div>
      <div id="consumption"></div>
       </div>    
       </div>
  </div>  <!-- consumption end row 2 --> 
  </div><!-- end row 3 -->
  <div class="row"><!-- row 4-->
        <div class="col-md-12"><!-- Actual Expiries -->
                 <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Actual Expiries</h3>
       </div>
        <div class="panel-body" style="height:500px;">

       <div class="filter row" style="margin-left: 2px;">
<form class="form-inline" role="form">
<select id="ayear" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Year</option>
<option  value="2014">2014</option>
<option  value="2013">2013</option>
</select> 
<div class="col-md-2">
<button class="btn btn-sm btn-success filter" id="a-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success excel_" id="a-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
</form>
</div>
<hr />
       <div id="actual">test</div>
       </div> 
       </div>

  </div>
</div>
<div class="row">
                <div class="col-md-6">
       <div class="panel panel-success">
       <div class="panel-heading">
       <h3 class="panel-title"><div class="county-name" style="display:inline-block"></div>Cost of Orders</h3>
       </div>
        <div class="panel-body" style="height:500px;">

       <div class="filter row" style="margin-left: 2px;">
<form class="form-inline" role="form">
<select id="order-year" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Year</option>
<option  value="2014">2014</option>
<option  value="2013">2013</option>
</select> 
<div class="col-md-2">
<button class="btn btn-sm btn-success filter" id="order-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success excel_" id="order-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
</form>
</div>
  <hr />
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
           
<button class="btn btn-sm btn-success excel_" id="order-lead-download">
    <span class="glyphicon glyphicon-save"></span>Download</button> 

  <hr />
      <div class="row">
          <div class="col-md-12">
       <div class="panel-heading">
       <h3 class="panel-title">Fill Rate</h3>
       </div>
       <div id="fill_rate">
            <div class="progress">
    <div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
        80%
    </div>
      </div>
       </div>
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

<div id="footer">
      <div class="container">
        <p class="text-muted"> Government of Kenya &copy <?php echo date('Y');?>. All Rights Reserved</p>
      </div>
    </div>

 <input type="hidden" name="county_id" id="county_id" value="NULL" />   
 <input type="hidden" name="district_id" id="district_id" value="NULL"/>  
 <input type="hidden" name="facility_id" id="facility_id" value="NULL"/>  
</body>
<script>
 jQuery.browser = {};
    (function () {
        jQuery.browser.msie = false;
        jQuery.browser.version = 0;
        if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
            jQuery.browser.msie = true;
            jQuery.browser.version = RegExp.$1;
        }
    })();
            var substringMatcher = function(strs) {
            return function findMatches(q, cb) {
                var matches, substringRegex;
                // an array that will be populated with substring matches
                matches = [];
                // regex used to determine if a string contains the substring `q`
                substrRegex = new RegExp(q, 'i');
                // iterate through the pool of strings and for any string that
                // contains the substring `q`, add it to the `matches` array
                $.each(strs, function(i, str) {
                if (substrRegex.test(str)) {
                    // the typeahead jQuery plugin expects suggestions to a
                    // JavaScript object, refer to typeahead docs for more info
                    matches.push({ value: str });
                }
                });
                cb(matches);
            };
            };
            
            
        var facilities = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('facilities'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../assets/scripts/typehead/json/facilities.json'
        });

        var districts = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('districts'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../assets/scripts/typehead/json/districts.json'
        });

        var counties = new Bloodhound({
        datumTokenizer: Bloodhound.tokenizers.obj.whitespace('county'),
        queryTokenizer: Bloodhound.tokenizers.whitespace,
        prefetch: '../assets/scripts/typehead/json/counties.json'
        });

        facilities.initialize();
        districts.initialize();
        counties.initialize();

        $('.typeahead').typeahead({
        highlight: true
        },
        {
        name: 'facilities',
        displayKey: 'facilities',
        source: facilities.ttAdapter(),
        templates: {
            header: '<h5 class="query-title">Facilities</h5>'
        }
        },
        {
        name: 'districts',
        displayKey: 'districts',
        source: districts.ttAdapter(),
        templates: {
            header: '<h5 class="query-title">Subcounty</h5>'
        }
        },
         {
        name: 'counties', 
        displayKey: 'county',
        source: counties.ttAdapter(),
        templates: {
            header: '<h5 class="query-title">Counties</h5>'
        }
        }).on('typeahead:selected',onSelected);


        function onSelected($e, datum) {
      $.each(datum, function( k, v ){
      $('#county_id').val('NULL');
      $("#district_id").val('NULL');
      $("#facility_id").val('NULL');
       var query_table= datum.name
       if(query_table=='county'){
        ajax_request_replace_div_content('national/get_facility_infor/'+datum.id+'/NULL/NULL/NULL',"#facilities");  
        ajax_request_replace_div_content('national/facility_over_view/'+datum.id,"#facilities_rolled_out");
        ajax_request_replace_div_content('national/hcw/'+datum.id,"#hcw_trained"); 
        ajax_request_replace_div_content('national/expiry/NULL/'+datum.id+'/NULL/NULL/NULL',"#actual");
        //ajax_request_replace_div_content('national/potential/'+datum.id+'/NULL/NULL/NULL/NULL',"#potential"); 
        ajax_request_replace_div_content('national/stock_level_mos/'+datum.id+'/NULL/NULL/NULL/ALL',"#mos");
        ajax_request_replace_div_content('national/consumption/'+datum.id+'/NULL/NULL/NULL',"#consumption");
        ajax_request_replace_div_content('national/order/NULL/'+datum.id+'/NULL/NULL/NULL',"#orders");
        ajax_request_replace_div_content('national/get_lead_infor/NULL/'+datum.id+'/NULL/NULL/NULL',"#lead_infor");
        $('#county_id').val(datum.id);
       }
       if(query_table=='district'){
        ajax_request_replace_div_content('national/get_facility_infor/NULL/'+datum.id+'/NULL/NULL',"#facilities");  
        ajax_request_replace_div_content('national/facility_over_view/NULL/'+datum.id+'/NULL/NULL',"#facilities_rolled_out");
        ajax_request_replace_div_content('national/hcw/NULL/'+datum.id,"#hcw_trained"); 
        ajax_request_replace_div_content('national/expiry/NULL/NULL/'+datum.id+'/NULL/NULL',"#actual");
       // ajax_request_replace_div_content('national/potential/NULL/'+datum.id+'/NULL/NULL/NULL',"#potential"); 
        ajax_request_replace_div_content('national/stock_level_mos/NULL/'+datum.id+'/NULL/NULL/ALL',"#mos");
        ajax_request_replace_div_content('national/consumption/NULL/'+datum.id+'/NULL/NULL',"#consumption");
        ajax_request_replace_div_content('national/order/NULL/NULL/'+datum.id+'/NULL/NULL',"#orders");
        ajax_request_replace_div_content('national/get_lead_infor/NULL/NULL/'+datum.id+'/NULL/NULL',"#lead_infor");
        $("#district_id").val(datum.id);
       }
       
       if(query_table=='facility'){
        ajax_request_replace_div_content('national/get_facility_infor/NULL/NULL/'+datum.id+'/NULL',"#facilities");  
        ajax_request_replace_div_content('national/facility_over_view/NULL/NULL/'+datum.id+'/NULL',"#facilities_rolled_out");
        ajax_request_replace_div_content('national/hcw/NULL/NULL/'+datum.id,"#hcw_trained"); 
        ajax_request_replace_div_content('national/expiry/NULL/NULL/NULL/'+datum.id+'/NULL',"#actual");
       // ajax_request_replace_div_content('national/potential/NULL/NULL/'+datum.id+'/NULL/NULL',"#potential"); 
        ajax_request_replace_div_content('national/stock_level_mos/NULL/NULL/'+datum.id+'/NULL/ALL',"#mos");
        ajax_request_replace_div_content('national/consumption/NULL/NULL/'+datum.id+'/NULL',"#consumption");
        ajax_request_replace_div_content('national/order/NULL/NULL/NULL/'+datum.id+'/NULL',"#orders");
        ajax_request_replace_div_content('national/get_lead_infor/NULL/NULL/NULL/'+datum.id+'/NULL',"#lead_infor");
        $("#facility_id").val(datum.id);
       }
    });
    }
         var url ='<?php echo base_url()?>';
         $('#potential_').on('shown.bs.tab', function (e) {
         $('#potential').html('');
         });
         $('#actual_').on('shown.bs.tab', function (e) {
         $('#actual').html('');
         });
      //auto run
      ajax_request_replace_div_content('national/expiry/NULL/NULL/NULL/NULL/NULL',"#actual"); 
    //  ajax_request_replace_div_content('national/potential/NULL/NULL/NULL/NULL/NULL',"#potential"); 
      //$('.county-name').html("National "+" &nbsp;");
      ajax_request_replace_div_content('national/facility_over_view/',"#facilities_rolled_out");
      ajax_request_replace_div_content('national/hcw/',"#hcw_trained");
      ajax_request_replace_div_content('national/stock_level_mos/NULL/NULL/NULL/NULL',"#mos");
      ajax_request_replace_div_content('national/consumption/NULL/NULL/NULL/NULL',"#consumption");
      ajax_request_replace_div_content('national/get_facility_infor/NULL/NULL/NULL/NULL',"#facilities");
      ajax_request_replace_div_content('national/order/NULL/NULL/NULL/NULL/NULL',"#orders");
      ajax_request_replace_div_content('national/get_lead_infor/NULL/NULL/NULL/NULL/NULL',"#lead_infor");

        $(".excel_").click(function(e) {
        e.preventDefault();
        var type=$(this).attr('id'); 

        var county_id=$('#county_id').val();
        var district=$("#district_id").val();
        var facility=$("#facility_id").val();
        var link='';
        
        if(type=='hcw_excel'){ 
        link='national/hcw/'+county_id+'/'+district+'/'+facility+'/excel';
        }
        
        if(type=='rolled_out'){
        link='national/facility_over_view/'+county_id+'/'+district+'/'+facility+'/excel';
        }
        
        if(type=='mos-download'){
        link='national/stock_level_mos/'+county_id+'/'+district+'/'+facility+'/NULL/excel';
        }

        if(type=='mos-commodity-download'){
        var commodity_id=$('#mos_commodity_filter').val();
        link='national/stock_level_mos/'+county_id+'/'+district+'/'+facility+'/'+commodity_id+'/excel';
        }
        
        if(type=='tracer-consumption-download'){ 
        var from =$("#tracer_from").val();
        var to =$("#tracer_to").val();
        
        if(from==''){from="NULL";}
        if(to==''){to="NULL";}

        link='national/consumption/'+county_id+'/'+district+'/'+facility+'/NULL/excel/'+encodeURI(from)+ '/'+encodeURI(to);
        }
        
        if(type=='all-commodity-download'){ 
        var commodity_id=$('#all_consumption_filter').val();
        var from =$("#all_from").val();
        var to =$("#all_to").val();
        
        if(from==''){from="NULL";   }
        if(to==''){to="NULL";}
        link='national/consumption/'+county_id+'/'+district+'/'+facility+'/'+commodity_id+'/excel/'+encodeURI(from)+ '/'+encodeURI(to);
        }
        
        if(type=='a-download'){
        var year=$('#ayear').val();
        link='national/expiry/'+year+'/'+county_id+'/'+district+'/'+facility+'/excel';  
        }
        
       
        if(type=='order-download'){
        var year=$('#order-year').val();
        link='national/order/'+year+'/'+county_id+'/'+district+'/'+facility+'/excel';    
        }
        
        if(type=='order-lead-download'){
        var year=$('#order-year').val(); 
        link='national/get_lead_infor/'+year+'/'+county_id+'/'+district+'/'+facility+'/excel';
        }
        
        if(type=='p-download'){//
        var year=$('#duration_filter_').val();
        link='national/potential/'+county_id+'/'+district+'/'+facility+'/excel/'+year;    
        }
        window.open(url+link,'_parent'); 
        });
        
        $(".filter").click(function(e) {
        e.preventDefault();
        var type=$(this).attr('id'); 
        var county_id=$('#county_id').val();
        var district=$("#district_id").val();
        var facility=$("#facility_id").val();
        
        if(type=='mos-commodity-filter'){ 
        var commodity_id=$('#mos_commodity_filter').val();
        ajax_request_replace_div_content('national/stock_level_mos/'+county_id+'/'+district+'/'+facility+'/'+commodity_id+'',"#mos");
        }
        
        if(type=='tracer-consumption-filter'){

        var from =$("#tracer_from").val();
        var to =$("#tracer_to").val();
        
        if(from==''){from="NULL";   }
        if(to==''){to="NULL";}
        ajax_request_replace_div_content('national/consumption/'+county_id+'/'+district+'/'+facility+'/NULL/NULL/'+encodeURI(from)+ '/'+encodeURI(to)+'',"#consumption");
        }
        
        if(type=='all-commodity-filter'){
        var commodity_id=$('#all_consumption_filter').val();
        var from =$("#all_from").val();
        var to =$("#all_to").val();
        
        if(from==''){from="NULL";   }
        if(to==''){to="NULL";}
        ajax_request_replace_div_content('national/consumption/'+county_id+'/'+district+'/'+facility+'/'+commodity_id+'/NULL/'+encodeURI(from)+ '/'+encodeURI(to)+'',"#consumption");
        }
        
        if(type=='a-filter'){
        var year=$('#ayear').val();
        ajax_request_replace_div_content('national/expiry/'+year+'/'+county_id+'/'+district+'/'+facility,"#actual");    
        }
        
        if(type=='p-filter'){//
        var year=$('#duration_filter_').val();
        ajax_request_replace_div_content('national/potential/'+county_id+'/'+district+'/'+facility+'/NULL/'+year,"#potential");    
        }
        
        if(type=='order-filter'){//
        var year=$('#order-year').val();
        ajax_request_replace_div_content('national/order/'+year+'/'+county_id+'/'+district+'/'+facility+'/NULL',"#orders"); 
        ajax_request_replace_div_content('national/get_lead_infor/'+year+'/'+county_id+'/'+district+'/'+facility+'/NULL',"#lead_infor");    
        }
        });
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
        json_obj = { "url" : "assets/img/calendar.gif",};
        var baseUrl = json_obj.url;
    $(".clone_datepicker_normal_limit_today").datepicker({
	    maxDate: new Date(),                
	    dateFormat: 'd M yy', 
	    changeMonth: true,
	    changeYear: true,
	    buttonImage: baseUrl,  });   
</script>
<script src="<?php echo base_url().'assets/scripts/hcmp_shared_functions.js'?>" type="text/javascript"></script>
</html>

