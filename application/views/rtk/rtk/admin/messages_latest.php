<!DOCTYPE html>
<html lang="en">
<head>   
  <link href="<?php echo base_url().'assets/css/style.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/select2.css'?>" type="text/css" rel="stylesheet"/> 
    <link href="<?php echo base_url().'assets/css/offline-language-english.css'?>" type="text/css" rel="stylesheet"/>  
  <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap.min.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/boot-strap3/css/bootstrap-responsive.css'?>" type="text/css" rel="stylesheet"/>
  <link href="<?php echo base_url().'assets/css/jquery-ui.css'?>" type="text/css" rel="stylesheet"/>
  <link rel="stylesheet" href="<?php echo base_url().'assets/css/pace-theme-flash.css'?>" />
  
  <script src="<?php echo base_url().'assets/scripts/pace.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/offline.js'?>" type="text/javascript"></script>
     <script src="<?php echo base_url().'assets/scripts/select2.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/typehead/handlebars.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/jquery.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/validator.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/waypoints.js'?>" type="text/javascript"></script> 
  <script src="<?php echo base_url().'assets/scripts/waypoints-sticky.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/boot-strap3/js/bootstrap.min.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/scripts/typehead/typeahead.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url();?>assets/FusionCharts/FusionCharts.js" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/tagsinput/tagmanager.js'?>" type="text/javascript"></script>
  <script src="<?php echo base_url().'assets/tagsinput/bootstrap-tagsinput.js'?>" type="text/javascript"></script>
  <link rel="stylesheet" href="<?php echo base_url().'assets/tagsinput/bootstrap-tagsinput.css'?>" />


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
 #message{
  width: 60%;
  height: auto;
  border: ridge 1px;
  text-align: left;
  margin-top: 10px;
  background-color:#E6E6E6;
}
</style>
</head> 
<body style="padding-top: 0;">  
</div>
<center>
<div id="message">
  <div class="panel-body">
    <form id="compose" name="compose">       
      <table id="compose_table" >
        <tr>
          <label>To:</label>
        </tr><br/>
        <tr>          
            <input class="typeahead form-control" id="receipient" type="text" placeholder="Enter Receipient" style="width:96%"/>             
        </tr><br/>    
        <tr>
          <label>Subject:</label>
        </tr><br/>
        <tr>                   
          <input class="form-control" id="subject" type="text" style="width:96%" />   
          <tr>
            <label>Message:</label>
          </tr><br/>
          <tr>    
            <textarea class="form-control" id="message" style="width:96%;background:#ffffff" rows="10"></textarea>

          </tr> <br/>

        </table>
      </form>   
    </div>

  </div>

</div>
</center>




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
              prefetch: { 
                url:'../assets/scripts/typehead/json/messages.json',
                ttl:0
              }
            });           

            
            facilities.initialize();
            
            
            //$('#receipient').tagsinput();
           
            $('#receipients').typeahead({
              highlight: true
            },
            {
              name: 'facilities',
              displayKey: 'facilities',
              source: facilities.ttAdapter(),
              templates: {
                //header: '<h5 class="query-title">Facilities</h5>'
              }
            })/*.on('typeahead:selected',onSelected)*/;
            /*$('#receipient').tagsinput('items');
              var receipients = $(".tm-input").tagsManager({               
                replace:false,                              
                onlyTagList: true,  
                
              });*/
            /*$('#receipient').tagsinput({
              typeaheadjs: {
                name: 'facilities',
                displayKey: 'facilities',
                valueKey: 'facilities',
                source: facilities.ttAdapter()
              }
            });*/


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

</script>

</html>

