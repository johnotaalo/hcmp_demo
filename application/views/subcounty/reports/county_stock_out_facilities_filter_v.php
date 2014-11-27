<h1 class="page-header" style="margin: 0;font-size: 1.6em;">Stock Outs</h1>
<div class="alert alert-info">
  <b>Below are the facilities that have stock outs in the County</b>:Select filter Options
</div>
<ul class='nav nav-tabs'>
      <li class="active"><a href="#county" data-toggle="tab">County View</a></li>
      <li class=""><a href="#subcounty" data-toggle="tab">Sub County View</a></li>
</ul>
<div id="myTabContent" class="tab-content">
	       <div  id="county" class="tab-pane fade active in">
       	<br>
<div class="filter row">
<form class="form-inline" role="form">
<div class="col-md-1">
<button class="btn btn-sm btn-success filter" id="county-filter" name="filter">
<span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div> 
</form>
</div>
</div>
<div  id="subcounty" class="tab-pane fade in">
       	<br>
<div class="filter row">
<form class="form-inline" role="form">

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
		$("#facility_filter").hide();
		$("#district_filter").change(function() {
		var option_value=$(this).val();
		
		if(option_value=='NULL'){
		$("#facility_filter").hide('slow');	
		}
		else{
var drop_down='';
 var hcmp_facility_api = "<?php echo base_url(); ?>/reports/get_facility_json_data/"+$("#district_filter").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_filter").html('<option value="NULL" selected="selected">--select facility--</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#facility_filter").append(drop_down);
    });
		$("#facility_filter").show('slow');		
		}
		});	
		$("#county-filter").on('click',function(e) {
		e.preventDefault();	
        var url_ = "reports/stock_out_reports/"+
        "/NULL"+
        "/NULL";	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });	
		$("#filter").on('click',function(e) {
		e.preventDefault();	
        var url_ = "reports/stock_out_reports/"+
        "/"+$("#district_filter").val()+
        "/"+ $("#facility_filter").val();	
		ajax_request_replace_div_content(url_,'.graph_content');	
          });

		});
</script>