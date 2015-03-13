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
	
	<style>
		 body {
padding-top: 4.5%;
}

.modal-content,.form-control
{
  border-radius: 0 !important;
}
	</style>
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
    
</head>

<body screen_capture_injected="true" style="background-color: whitesmoke;">
	
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
            <li class=""><a href="<?php echo base_url().'national';?>">Home</a></li>
            <li class=""><a href="<?php echo base_url().'national/reports';?>">Reports</a></li>
            <li class="active"><a href="<?php echo base_url().'national/search';?>">Search</a></li>
            <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> Welcome, Guest</a>
                        <ul class="dropdown-menu">
                            <li><a href="<?php echo base_url();?>"><span class="glyphicon glyphicon-log-in" style="margin-right: 2%;"></span> Login</a></li>
                            
                            <li class="divider"></li>
                        </ul>
                    </li>
          </ul>
          
                                        
        </div><!--/.nav-collapse -->

      </div>
    </div>
	<div class="container">
		<div class="row">
			<div class="col-md-4">
				<div class="input-group">
						<input type="text" class="form-control typeahead " placeholder="facility , county, subcounty name" data-provide="typeahead">
						<span class="input-group-btn">
							<button type="submit" class="btn btn-default">
								<span class="glyphicon glyphicon-search">
									<span class="sr-only">Search...</span>
								</span>
							</button>
						</span>
					</div>
			</div>
		</div>
	</div>
	
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
        ajax_request_replace_div_content('national/potential/'+datum.id+'/NULL/NULL/NULL/NULL',"#potential"); 
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
        ajax_request_replace_div_content('national/potential/NULL/'+datum.id+'/NULL/NULL/NULL',"#potential"); 
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
        ajax_request_replace_div_content('national/potential/NULL/NULL/'+datum.id+'/NULL/NULL',"#potential"); 
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
      ajax_request_replace_div_content('national/potential/NULL/NULL/NULL/NULL/NULL',"#potential"); 
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