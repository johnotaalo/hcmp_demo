<style>
	
	.sub-menu{
		width: 15%;
		height:300px;
    	float: left;
    	margin-right: 0%;
    	font-family: "Segoe UI", "Segoe WP", "Helvetica Neue", sans-serif;
    	/*border: 1px solid black;*/
    	
	}
	.graph-section{
		width: 84%;
		height:500px;
    	min-height:100%;
    	float: left;
    	margin-left:0.4%;
    	margin-bottom:1em;
    	-webkit-box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.75);
		-moz-box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.75);
		box-shadow: -1px 1px 5px 0px rgba(0,0,0,0.75);
    	/*border: 1px solid black;*/
	}
	#list_headers {

	margin-right: 0.3em;
	font-size:1em;
}
	
	#list_headers ul{
	text-align: left;
	display: inline;
	margin: 0;
	
	list-style: none;
	}
	#list_headers ul li{
	display: block;
	line-height: 40px;
	position: relative;
	background: #29527b; /* Old browsers */
	cursor: pointer;
	
   }
   #list_headers ul li a{
   	color:white;
   	text-decoration: none;
   }
   h3{
	margin: 1px;
	font-size: 1.5em;
	padding-left:6%;
	font-weight: 200;
}
#list_headers ul li :hover {
	background: #289909;
}
#list_headers ul li:hover ul {
	display: block;
	opacity: 1;
	visibility: visible;
}

</style>


<div class="sub-menu">
	
			<nav id="list_headers">
	
              <ul>
                <li ><a  href="#" id="consumption"><h3>Consumption</h3></a></li>                
                <li><a  href="#" id="stock_level"><h3>Stock Levels</h3></a></li>              
                <li><a  href="#" id='expiries'><h3>Expiries</h3></a></li>
                <li><a  href="#" id="system_usage"><h3>System Up take</h3></a></li>
              </ul>
            </nav>
</div>

<div class="graph-section">
	
	
</div>

<script>
	$(document).ready(function() {
		$( "#consumption" ).css( "background-color", "#29527b" );
	$(function() {
		
	$( "#list_headers li" ).click(function() {
		
		$( "#list_headers li" ).css( "background-color", "#29527b" );
 		$( this ).css( "background-color", "#289909" );
 		
});

		$('#consumption').focus();
		var url = "<?php echo base_url().'report_management/consumption_data/'?>";	
		ajax_request_special(url,'.graph-section','','system_usage');	
		$("#system_usage").click(function(){	
		var url = "<?php echo base_url().'report_management/get_county_facility_mapping_data/'?>";	
		ajax_request_special(url,'.graph-section','','system_usage');	
	    });	    
	    $("#consumption").click(function(){
		var url = "<?php echo base_url().'report_management/consumption_data/'?>";	
		ajax_request_special(url,'.graph-section','','consumption');	
	    });	    
	     $("#stock_level").click(function(){
		var url = "<?php echo base_url().'report_management/load_county_consumption_graph_view/'?>";	
		ajax_request_special(url,'.graph-section','','stock_level');	
	    });	    
	     $("#expiries").click(function(){
		var url = "<?php echo base_url().'report_management/load_county_cost_of_expiries_graph_view/'?>";	
		ajax_request_special(url,'.graph-section','','expiries');	
	    });
	 	$("#filter_system_usage").live( "click", function() {
        var url = "<?php echo base_url().'report_management/get_county_facility_mapping_data/'?>"+$("#year_filter").val()+"/"+$("#month_filter").val();	
		ajax_request_special(url,'.graph-section','','system_usage');
          });		
	    $("#filter_consumption").live( "click", function() {
        var url = "<?php echo base_url().'report_management/get_county_consumption_level_new/'?>"+
        $("#year_filter").val()+"/"+$("#month_filter").val()+"/"+$("#commodity_filter").val()+"/null/"+$("#district_filter").val()+"/"+$("#plot_value_filter").val();	
		ajax_request_special(url,'.graph-section','','consumption');
		
          });

           $("#filter_expiries").live( "click", function() {
        var url = "<?php echo base_url().'report_management/get_county_cost_of_expiries_new/'?>"+
         $("#year_filter").val()+"/"+$("#district_filter").val()+"/"+$("#commodity_filter").val()+"/"+$("#plot_value_filter").val();	
		ajax_request_special(url,'.graph-section','','expiries');
		
          });
		
	function ajax_request_special(url,checker,date,option){
	var url =url;
	var checker=checker;
	
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
          	
          	if(checker==".graph-section"){
          	 $(".graph-section").html("<img style='margin-left:20%;' src="+loading_icon+">");	
          	}else{
          	 $('.graph-section').html("");	
          	}

          },
          success: function(msg) {
          	if(checker==".graph-section"){	
          		
          $(".graph-section").html(""); 	
          $(".graph-section").html(msg); 
          
          }
          else{
        
          }

        if(option=='system_usage'){
        	$("#temp").prepend('<select name="year" id="year_filter">'+ '<option value="0">Select Year</option>'+
'<option value="2014">2014</option>'+
'<option value="2013">2013</option></select>'+
'<select name="month" id="month_filter">'+
'<option value="01">Jan</option>'+
'<option value="02">Feb</option>'+
'<option value="03">Mar</option>'+
'<option value="04">Apr</option>'+
'<option value="05">May</option>'+
'<option value="06">Jun</option>'+
'<option value="07">Jul</option>'+
'<option value="08">Aug</option>'+
'<option value="09">Sep</option>'+
'<option value="10">Oct</option>'+
'<option value="11">Nov</option>'+
'<option value="12">Dec</option>'+
'</select>'+
'<button class="btn btn-small btn-success" id="filter_system_usage" style="margin-left: 1em;" >Filter</button>');
        }
          }
        }); 
}
});
});
</script>