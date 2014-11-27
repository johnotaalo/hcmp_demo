<style>
	.filter{
	width: 98%;
	height:7em;
	/*border: 1px solid black;*/
	margin:auto;	
	}
	.graph_content{
	width: 99%;
	height:400px;
	-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
box-shadow: 1px 1px 1px 1px #DDD3ED;
	margin:auto;	
	}
</style>

<div class="alert alert-info" style="font-size: 1.6em ; width: 40em; ">
  <b>Please Select filter Options Below</b>
</div>
<div class="filter">
	<h2>
		

	<select id="district_filter" style="width: 11em;">
<option value="">Select Sub-county</option>
<option value="0">All</option>
<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>
</select> 
<div id="facilities" style="vertical-align: baseline;
display: inline-block; white-space: nowrap; position:inherit;
margin-left: 0.2em;margin-right: 0.2em">
<select id="facility_filter" >
<option value="0">Select Facility</option>
</select>	
</div>


<select id="commodity_filter" style="width: 10.8em;">
	<option value="0">Select Commodity</option>
	
	<?php
foreach($c_data as $data):
		$commodity_name=$data['drug_name'];	
		$commodity_id=$data['id'];
		echo "<option value='$commodity_id'>$commodity_name</option>";
endforeach;
?>
</select>

	<select name="year" id="year_filter" style="width: 7.8em;">
		<option value="0">Select Year</option>
<option value="2014">2014</option>
<option value="2013">2013</option>
</select>
	
<select id="plot_value_filter">
	<option value="0">Select Plot value</option>
<option value="packs">Packs</option>
<option value="units">Units</option>
<option value="ksh">KSH</option>
</select> 
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#supplyplanModal" href="#">View Supply Plan</a>-->

	</h2>
</div>

<div class="graph_content ">
	
</div>

<script>
	
	$(document).ready(function() {
	$(function() {
		
		$('#filter').click(function() {
    	var district_cons=$("#district_filter").val();
    	var fcommodity=$("#commodity_filter").val();
    	var year=$("#year_filter").val();
    	var plot_value_filter=$("#plot_value_filter").val();
    	   	
    				if (district_cons=='') {
						
						alert("Please select Sub-county");
						return;
					}
					if (fcommodity==0) {
						
						alert("Please select Commodity.");
						return;
					}
					if (year==0) {
						
						alert("Please select Year.");
						return;
					}
					if (plot_value_filter==0) {
						
						alert("Please select Plot value.");
						return;
					}
         var div=".graph_content";
		var url = "<?php echo base_url()."report_management/consumption_stats_graph"?>";		
		
				ajax_supply (url,div);
		
			 
		});
		
		
		
		function ajax_supply (url,div){
			//alert (div);
			//return;
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loading.gif' ?>";
	 $.ajax({
          type: "POST",
           data: {facilityname:$('#commodity_filter option:selected').html(),facilities: $("#facility_filter").val(),district_filter: $("#district_filter").val(),commodity_filter: $("#commodity_filter").val(),year_filter: $("#year_filter").val(),plot_value_filter: $("#plot_value_filter").val()},
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-left:20%;margin-top:2%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
            $(div).html(msg);           
          }
        });
         
}
		$("#facilities").hide();
		$("#district_filter").change(function() {
		var option_value=$(this).val();
		
		if(option_value==''||option_value==0){
		$("#facilities").hide('slow');	
		}
		else{
  var drop_down='';
  var hcmp_facility_api = "<?php echo base_url(); ?>report_management/get_facility_json_data/"+$("#district_filter").val();
  $.getJSON( hcmp_facility_api ,function( json ) {
     $("#facility_filter").html('<option value="0" selected="selected">Select Facility</option>');
      $.each(json, function( key, val ) {
      	drop_down +="<option value='"+json[key]["facility_code"]+"'>"+json[key]["facility_name"]+"</option>";	
      });
      $("#facility_filter").append(drop_down);
    });
		

		$("#facilities").show('slow');		
		}

		});
		
		});
  });
</script>