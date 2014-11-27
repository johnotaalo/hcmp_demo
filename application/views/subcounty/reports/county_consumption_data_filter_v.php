<style>
	.input-small{
 		width: 100px !important;
 	}
 	.input-small_{
 		width: 230px !important;
 	}
</style>
<div class="alert alert-info" style="width: 100%">
  <b>Below is the consumption Level in the County </b> :Select filter Options
</div>
<ul class='nav nav-tabs'>
      <li class="active"><a href="#cat" data-toggle="tab">Categories</a></li>
      <li class=""><a href="#county" data-toggle="tab">County View</a></li>
      <li class=""><a href="#subcounty" data-toggle="tab">Sub County View</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	<div  id="cat" class="tab-pane fade active in">
       	<br>
       	<div class="filter row">
<form class="form-inline" role="form">
       	<select id="category_filter" class="form-control col-md-3">
<option value="NULL">Select Commodity Category</option>
<?php
foreach($categories as $data):
		$commodity_name=$data->sub_category_name;	
		$commodity_id=$data->id;
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>
	<select id="category_district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 
<select id="category_facility_filter" class="form-control col-md-3">


<option value="NULL">Select facility</option>
</select>
<input type="text" name="from"  id="category_from" 
placeholder="FROM" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<input type="text" name="to"  id="category_to" placeholder="TO" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />		
<select id="category_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<!-- <option value="ksh">KSH</option> -->
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success category-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>	
<div class="col-md-1">
<button class="btn btn-sm btn-primary category-data"><span class="glyphicon glyphicon-th-list"></span>Results as Table</button> 
</div>
   </form>
      </div>
</div>
 <div  id="county" class="tab-pane fade in">
      	<br>
<div class="filter">
<form class="form-inline" role="form">
<select id="county_commodity_filter" class="form-control col-md-3">
<option value="NULL">Select Commodity</option>
<?php
foreach($c_data as $data):
		$commodity_name=$data['commodity_name'];	
		$commodity_id=$data['id'];
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>		
<select id="county_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<!-- <option value="ksh">KSH</option> -->
</select>
<input type="text" name="from"  id="county_from" 
placeholder="FROM" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<input type="text" name="to"  id="county_to" placeholder="TO" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />		

<div class="col-md-1">
<button class="btn btn-sm btn-success county-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-primary county-data"><span class="glyphicon glyphicon-filter"></span>Results as Table</button> 
</div>
</form>
</div>
</div>
      <div  id="subcounty" class="tab-pane fade in">
      	<br>
<div class="filter row">
<form class="form-inline" role="form">
<select id="subcounty_commodity_filter" class="form-control col-md-2">
<option value="NULL">Select Commodity</option>
<?php
foreach($c_data as $data):
		$commodity_name=$data['commodity_name'];	
		$commodity_id=$data['id'];
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>	
	<select id="subcounty_district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 
<select id="subcounty_facility_filter" class="form-control col-md-2">
<option value="NULL">Select facility</option>
</select>	
<input type="text" name="from"  id="subcounty_from" 
placeholder="FROM" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />
<input type="text" name="to"  id="subcounty_to" placeholder="TO" class="form-control input-small col-md-1 clone_datepicker_normal_limit_today" />		
<select id="subcounty_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<!-- <option value="ksh">KSH</option> -->
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success subcounty-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-primary subcounty-data"><span class="glyphicon glyphicon-filter"></span>Results as Table</button> 
</div>
</form>
</div>
</div>
</div>

</div>
<div class="graph_content">	
</div>
<script>
	$(document).ready(function() {
				json_obj = { "url" : "assets/img/calendar.gif'",};
var baseUrl=json_obj.url;
	  //	-- Datepicker	limit today		
	$(".clone_datepicker_normal_limit_today").datepicker({
    maxDate: new Date(),				
	dateFormat: 'd M yy', 
	changeMonth: true,
	changeYear: true,
	buttonImage: baseUrl,       });	
	    
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          $('.graph_content').html('');
          })
		$("#subcounty_facility_filter,#category_facility_filter").hide();
		
		$("#subcounty_district_filter").change(function() {
		var option_value=$(this).val();
		
		if(option_value=='NULL'){
		$("#subcounty_facility_filter").hide('slow');	
		}
		else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#subcounty_facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#subcounty_facility_filter").append(drop_down);
    });
		$("#subcounty_facility_filter").show('slow');		
		}
		});	
		$("#category_district_filter").change(function() {
		var option_value=$(this).val();
		if(option_value=='NULL'){
		$("#category_facility_filter").hide('slow');	
		}
		else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#category_facility_filter").append(drop_down);
    });
		$("#category_facility_filter").show('slow');		
		}
		});	
	$(".county-filter").button().click(function(e) {
		e.preventDefault();	
		
		var from =$("#county_from").val();
		var to =$("#county_to").val();
		
		if(from==''){from="NULL";	}
        if(to==''){to="NULL";}

        var url_ = "reports/consumption_stats_graph/"+
       $("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val()+ "/"+encodeURI(from)+ "/"+encodeURI(to)+ "/"+'column';	;	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          	
          
         $(".county-data").button().click(function(e) {
		e.preventDefault();	
		
		var from =$("#county_from").val();
		var to =$("#county_to").val();
		
		if(from==''){from="NULL";	}
        if(to==''){to="NULL";}

        var url_ = "reports/consumption_stats_graph/"+
       $("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val()+ "/"+encodeURI(from)+ "/"+encodeURI(to)+ "/"+'table_data';	;	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });    

        $(".subcounty-filter").button().click(function(e) {
		e.preventDefault();	
		var from =$("#subcounty_from").val();
		var to =$("#subcounty_to").val();
		
		if(from==''){from="NULL";	}
        if(to==''){to="NULL";}
        var url_ = "reports/consumption_stats_graph/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+ "/"+encodeURI(from)+ "/"+encodeURI(to)+ "/"+'column';	;	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
		
		   $(".subcounty-data").button().click(function(e) {
		e.preventDefault();	
		var from =$("#subcounty_from").val();
		var to =$("#subcounty_to").val();
		
		if(from==''){from="NULL";	}
        if(to==''){to="NULL";}
        var url_ = "reports/consumption_stats_graph/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+ "/"+encodeURI(from)+ "/"+encodeURI(to)+ "/"+'table_data';	;	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          
         $(".category-filter").button().click(function(e) {
		e.preventDefault();	
		var from =$("#category_from").val();
		var to =$("#category_to").val();
		
		if(from==''){from="NULL";	}
        if(to==''){to="NULL";}
        var url_ = "reports/consumption_stats_graph/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val()+ "/"+encodeURI(from)+ "/"+encodeURI(to)+ "/"+'column';	;	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          
        $(".category-data").button().click(function(e) {
		e.preventDefault();	
		var from =$("#category_from").val();
		var to =$("#category_to").val();
		
		if(from==''){from="NULL";	}
        if(to==''){to="NULL";}
        var url_ = "reports/consumption_stats_graph/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val()+ "/"+encodeURI(from)+ "/"+encodeURI(to)+ "/"+'table_data';	;	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });


		});
</script>