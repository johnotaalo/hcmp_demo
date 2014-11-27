<?php 
$facility_code =$this -> session -> userdata('facility_id'); 
if (empty($facility_code)){
	$facility_code = 'NULL';
}?>
<h1 class="page-header" style="margin: 0;font-size: 1.6em;">Stock Level</h1>
<div class="alert alert-info" style="width: 100%">
  <b>Below are the Stocking Levels in the County </b> :Select filter Options
</div>
<ul class='nav nav-tabs'>
      <li class="active"><a href="#county" data-toggle="tab">County View</a></li>
      <li class=""><a href="#subcounty" data-toggle="tab">Sub County View</a></li>
</ul>
    <div id="myTabContent" class="tab-content">
       <div  id="county" class="tab-pane active fade in">
      	<br>
<div class="filter row">
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
<option value="ksh">KSH</option>
<option value="mos">Month of Stock</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success county-filter"  id="county-filter" ><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div> 
<div class="col-md-1">
<button class="btn btn-sm btn-primary county-filter-table"  id="county-filter-table" ><span class="glyphicon glyphicon-th-list"></span>Results as Table</button> 
</div> 
<div class="col-md-1">
<!--<button class="btn btn-sm btn-primary county-filter-table"  id="county-filter-table" ><span class="glyphicon glyphicon-th-list"></span>Data Table</button>--> 
</div>
</form>
</div>
</div>
      <div  id="subcounty" class="tab-pane fade in">
      	<br>
<div class="filter row">
<form class="form-inline" role="form">
<select id="subcounty_commodity_filter" class="form-control col-md-3">
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
<select id="subcounty_facility_filter" class="form-control col-md-3">
<option value="NULL">Select facility</option>
</select>	
<select id="subcounty_plot_value_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<!-- <option value="ksh">KSH</option> -->
<!-- <option value="mos">Month of Stock</option> -->
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success subcounty-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-primary subcounty-filter-table"><span class="glyphicon glyphicon-th-list"></span>Results as Table</button> 
</div>
</form>
</div>
</div>
</div>

<div class="graph_content">	
</div>
<script>	
	$(document).ready(function() {
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
        var url_ = "reports/get_county_stock_level_new/"+
$("#county_commodity_filter").val()+"/NULL/"+"<?php echo $this -> session -> userdata('district_id');?>"+"/"+"<?php echo $facility_code;?>"+"/"+$("#county_plot_value_filter").val()+'/NULL/NULL';	
		ajax_request_replace_div_content(url_,'.graph_content');	

          });

		$(".county-filter-table").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#county_commodity_filter").val()+"/NULL/"+"<?php echo $this -> session -> userdata('district_id');?>"+"/"+"<?php echo $facility_code;?>"+"/"+$("#county_plot_value_filter").val()+'/table_data/NULL';	
		ajax_request_replace_div_content(url_,'.graph_content');	

          });
          
	     $(".subcounty-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+ "/"+'NULLSub';	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          $(".subcounty-filter-table").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+ "/"+'table_data/NULLSub';	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });


          $(".category-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val()+ "/"+'table_data';		
		ajax_request_replace_div_content(url_,'.graph_content');	
          });

		});
</script>