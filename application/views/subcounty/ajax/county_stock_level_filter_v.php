<?php
//Notifications part of the view
$year = date("Y");
$county_id = $this -> session -> userdata('county_id');
$district_id_active =  $this -> session -> userdata('district_id');
$identifier = $this -> session -> userdata('user_indicator');

?>
<style>
	
	.stat_item {
		height: 52px;
		padding: 2px 5px;
		margin:0 1px 1px 1px;
		color: #fff;
		text-align: center;
		font-size: 1em;
		
	}	
	.stat_item:hover{
	-webkit-transform: scale(1.005);
	-moz-transform: scale(1.005);
	margin-left: 2px;
	-webkit-transition-duration: 50ms;
	-webkit-transition-function: ease-out;
	-moz-transition-duration: 50ms;
	-moz-transition-function: ease-out;
	box-shadow: 0 1px 3px 0.5px #000;
}
	.bold{
		font-weight:800;
	}
</style>

<div class="alert alert-info" style="width: 100%">
  <b>Below are the Stocking Levels in the County </b> :Select filter Options
</div>

<ul class='nav nav-tabs'>
	  <li class="active"><a href="#tracer" data-toggle="tab">Tracer Commodities <?php echo " ($number_of_tracer_items)"; ?></a></li>
      <li class=""><a href="#division" data-toggle="tab">Program Commodities</a></li>
      <!--<li class=""><a href="#cat" data-toggle="tab">Categories</a></li>-->
   	  <li class=""><a href="#county" data-toggle="tab">Sub County Comparison</a></li>
   	  <li class=""><a href="#stockouts" data-toggle="tab" onclick="stockouts_clicked()">Stock outs</a></li>
     <!--<li class=""><a href="#subcounty" data-toggle="tab">Sub County View</a></li>-->
</ul>
    <div id="myTabContent" class="tab-content">
    	<!-- div for tracer items-->
    	<div  id="tracer" class="tab-pane fade active in">
          	<br>
          	<div class="filter row">
          		<form class="form-inline" role="form">
    			<select id="tracer_district_filter" class="form-control col-md-2">
					<option selected="selected" value="NULL">Select Sub-county</option>
					<?php
					foreach($district_data as $district_):
					        $district_id=$district_->id;
							$district=$district_->id;
					        $district_name=$district_->district; 
							
					        echo "<option value='$district_id'>$district_name</option>";
					endforeach;
					?>
				</select> 

				<select id="tracer_facility_filter" class="form-control col-md-3">
					<option value="NULL">Select facility</option>
				</select>	
				<select id="tracer_plot_value_filter" class="form-control col-md-2">
					<option value="NULL">Select Plot value</option>
					<option value="packs">Packs</option>
					<option value="units">Units</option>
					<!--<option value="ksh">KSH</option>-->
					<!-- MoS has been removed until the issue of the amc is sorted out
					<option selected="selected" value="mos">Months of stock</option>-->
				</select>
				<!--First the filter buttons-->
				<div class="col-md-2">
					<button style="margin-left:30px;" class="btn btn-sm btn-success tracer-filter"><span class="glyphicon glyphicon-filter"></span>Filter Graph</button> 
				</div>
				<!-- seth's button -->
				<div class="col-md-2">
					<button style="margin-left:30px;" class="btn btn-sm btn-success tracer-filter-table"><span class="glyphicon glyphicon-th-list"></span>Filter Table</button> 
				</div>
				<!--Download button-->
				<div class="col-md-1">
					<button style="margin-left:30px;" class="btn btn-sm btn-primary tracer-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
				</div>
				
          	</form>
         </div>
      </div>
      <div  id="division" class="tab-pane fade">
      <br>
      <div class="filter row">
      <form class="form-inline" role="form">
      	<select id="division_name_filter" class="form-control col-md-2">
				<option selected="selected" value="NULL">Select Program</option>
				<?php
				foreach($division_commodities as $division_):
				        $division_id=$division_->id;
				        $division_name=$division_->division_name;    
				        echo "<option value='$division_id'>$division_name</option>";
				endforeach;
				?>
			</select>
	      	<select id="division_district_filter" class="form-control col-md-2">
				<option selected="selected" value="NULL">Select Sub-county</option>
				<?php
				foreach($district_data as $district_):
				        $district_id=$district_->id;
				        $district_name=$district_->district;    
				        echo "<option value='$district_id'>$district_name</option>";
				endforeach;
				?>
			</select>
			<select id="division_facility_filter" class="form-control col-md-3">
				<option value="NULL">Select Facility</option>
			</select>  
		    
			<select id="division_plot_value_filter" class="form-control col-md-2">
				<option selected="selected" value="NULL">Select Plot value</option>
				<option value="packs">Packs</option>
				<option value="units">Units</option>
				<!--<option value="ksh">KSH</option>-->
				<option value="mos">Months of stock</option>
			</select>
			<div class="col-md-1">
				<button class="btn btn-sm btn-success division-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
			</div>
			<div class="col-md-1">
				<button class="btn btn-sm btn-success division-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
			</div>
			<div class="col-md-2">
			<button style="margin-left:30px;" class="btn btn-sm btn-primary division-filter-table"><span class="glyphicon glyphicon-th-list"></span>Results as Table</button> 
			</div>
      </form>
      </div>
      </div>

      <div  id="county" class="tab-pane fade in">
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

<option  value="NULL">Select Plot value</option>
<!--<option value="packs">Packs</option>
<option value="units">Units</option>-->
<option selected="selected" value="mos">Months Of Stock</option>
<!--<option value="ksh">KSH</option>
-->
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success county-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success county-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
<div class="col-md-2">
<button class="btn btn-sm btn-primary county-filter-table"><span class="glyphicon glyphicon-th-list"></span>Results as Table</button> 
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
<option value="ksh">KSH</option>
<option value="mos">Months Of Stock</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-success subcounty-filter"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
<div class="col-md-1">
<button class="btn btn-sm btn-success subcounty-download"><span class="glyphicon glyphicon-save"></span>Download</button> 
</div>
</form>
</div>
</div>

<div  id="stockouts" class="tab-pane fade in">
	
<br>
<!-- <form class="form-inline" role="form">

	<select id="district_filter" class="form-control col-md-2">
<option selected="selected" value="NULL">Select Sub-county</option>
<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 
<select id="facility_filter" class="form-control col-md-2">
<option value="NULL">Select facility</option>
</select>	
<div class="col-md-1">
<button class="btn btn-sm btn-success filter" id="filter" name="filter">
<span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div> 
</form> -->
<div class="graph_content" id="stockouts_graph"  ></div>
</div>

</div>
<div class="graph_content" id="default_graph_"  ></div>	

	
<script>
	 $(function () { 
<?php echo $graph_data_default; ?>
<?php echo $default_graph; ?>
});

	function stockouts_clicked(){
	$.get("reports/stock_out_reports", function(data){
		$("#stockouts_graph").html(data);
	});
	};
	$(document).ready(function() {
		$('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
          $('.graph_content').html('');
          
          })
		$("#subcounty_facility_filter,#category_facility_filter,#tracer_facility_filter,#division_commodity_filter,#division_facility_filter").hide();
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

		$("#tracer_district_filter").change(function() {
				var option_value=$(this).val();
				if(option_value=='NULL'){
				$("#tracer_facility_filter").hide('slow');	
				}
				else{
		var drop_down='';
		 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
		  $.getJSON( hcmp_facility_api ,function( json ) {
		     $("#tracer_facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
		      $.each(json, function( key, val ) {
		      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
		      });
		      $("#tracer_facility_filter").append(drop_down);
		    });
				$("#tracer_facility_filter").show('slow');		
				}
		});		
		
		//Divion District filter
		$("#division_district_filter").change(function() {
				var option_value=$(this).val();
				if(option_value=='NULL'){
				$("#division_facility_filter").hide('slow');	
				}
				else{
		var drop_down='';
		 var hcmp_facility_api = "<?php echo base_url(); ?>reports/get_facility_json_data/"+option_value;
		  $.getJSON( hcmp_facility_api ,function( json ) {
		     $("#division_facility_filter").html('<option value="NULL" selected="selected">--Select Facility--</option>');
		      $.each(json, function( key, val ) {
		      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
		      });
		      $("#division_facility_filter").append(drop_down);
		    });
				$("#division_facility_filter").show('slow');		
				}
		});	
		//Tracer Filter Graph Button for the stock levels graph 
		$(".tracer-filter").button().click(function(e) {
	        e.preventDefault();
	        //($facility_code = null, $district_id = null, $option = null,$report) 
	        var url_ = "reports/get_county_stock_levels_tracer/"
	        					+$("#tracer_facility_filter").val()+"/"
	        					+$("#tracer_district_filter").val()+"/"
	        					+$("#tracer_plot_value_filter").val()+"/graph";
	        ajax_request_replace_div_content(url_,'.graph_content');    
          });
          
          //Tracer Items - Table Data
          $(".tracer-filter-table").button().click(function(e) {
	        e.preventDefault();
	        var url_ = "reports/get_county_stock_levels_tracer/"
	        					+$("#tracer_facility_filter").val()+"/"
	        					+$("#tracer_district_filter").val()+"/"
	        					+$("#tracer_plot_value_filter").val()+"/table_data";
	        ajax_request_replace_div_content(url_,'.graph_content');    
          });
          
          $(".tracer-download").button().click(function(e) {
	       	e.preventDefault(); 
	        var url_ = "reports/get_county_stock_levels_tracer/"
	        					+$("#tracer_facility_filter").val()+"/"
	        					+$("#tracer_district_filter").val()+"/"
	        					+$("#tracer_plot_value_filter").val()+"/excel";
	        window.open(url+url_ ,'_blank');   
          });

          //Division button filter
          $(".division-filter").button().click(function(e) {
	        e.preventDefault();
	        var url_ = "reports/get_division_commodities_data/"+
	        $("#division_district_filter").val()+"/"+
	        $("#division_facility_filter").val()+"/"+
	        $("#division_name_filter").val()+"/"+
	        $("#division_plot_value_filter").val()+
	        "/NULL";
	        ajax_request_replace_div_content(url_,'.graph_content');    
          });
          //division filter as table
          $(".division-filter-table").button().click(function(e) {
	        e.preventDefault();
	        var url_ = "reports/get_division_commodities_data/"+
	        $("#division_district_filter").val()+"/"+
	        $("#division_facility_filter").val()+"/"+
	        $("#division_name_filter").val()+"/"+
	        $("#division_plot_value_filter").val()+
	        "/table_data";
	        ajax_request_replace_div_content(url_,'.graph_content');    
          });
          
          $(".division-download").button().click(function(e) {
        e.preventDefault(); 
        var url_ = "reports/get_division_commodities_data/"+
		$("#division_name_filter").val()+"/"+$("#division_district_filter").val()+"/"+$("#division_facility_filter").val()+"/"+$("#division_plot_value_filter").val()+"/csv_data";   
         window.open(url+url_ ,'_blank');   
          });
   
		$(".county-filter").button().click(function(e) {
			e.preventDefault();	

	        var url_ = "reports/get_county_comparison_graph/"+$("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val()+"/1/table/group_special";	
			ajax_request_replace_div_content(url_,'.graph_content');	
          });
          //county filter tabular results
          $(".county-filter-table").button().click(function(e) {
			e.preventDefault();	

	        var url_ = "reports/get_county_comparison_graph/"+$("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val()+"/1/table_data/group_special";	
			ajax_request_replace_div_content(url_,'.graph_content');	
          });

         $(".county-download").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+$("#county_commodity_filter").val()+"/NULL/NULL/NULL/"+$("#county_plot_value_filter").val()+"/csv_data";	
		 window.open(url+url_ ,'_blank');	
          });
          
         $(".subcounty-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+"/1/NULL";	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
        $(".subcounty-download").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
$("#subcounty_commodity_filter").val()+"/NULL/"+$("#subcounty_district_filter").val()+"/"+ $("#subcounty_facility_filter").val()+"/"+$("#subcounty_plot_value_filter").val()+"/csv_data/1";	
		 window.open(url+url_ ,'_blank');	
          });
          
$(".category-filter").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val();	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });
          
        $(".category-download").button().click(function(e) {
		e.preventDefault();	
        var url_ = "reports/get_county_stock_level_new/"+
"NULL/"+$("#category_filter").val()+"/"+$("#category_district_filter").val()+"/"+ $("#category_facility_filter").val()+"/"+$("#category_plot_value_filter").val()+"/csv_data/1";	
		 window.open(url+url_ ,'_blank');	
          });
          
$(".general_stock_info").on(function(e)
	 {	
	 	e.preventDefault();	
        var url_ = 'evaluation/analysis/'+$("#sub_county_filter").val();

		ajax_request_replace_div_content(url_,'.graphs');		
           });
	
          		
		});			
</script>