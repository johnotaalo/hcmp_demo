<style>
	.filter{
	width: 100%;
	height:3em;
	/*border: 1px solid black;*/
	margin:auto;
	padding-bottom: 2em;	
	}
.graph_content{
	padding-top: 2em;
	width: 100%;
	height:auto;
	-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
box-shadow: 1px 1px 1px 1px #DDD3ED;
	margin:auto;
	}
</style>
<h1 class="page-header" style="margin: 0;font-size: 1.6em;">Expiries</h1>
<div class="alert alert-info">
  <b>Below are the expiries in the County</b>:Select filter Options
</div>
	<ul class='nav nav-tabs'>
      <li class="active"><a href="#Rejected" data-toggle="tab">Expired Commodities</a></li>
      <li class=""><a href="#Approval" data-toggle="tab" id="potential_e">Potential Expiries</a></li>
    </ul>
<div id="myTabContent" class="tab-content">
      <div  id="Rejected" class="tab-pane fade active in">
      	<br>
<div class="filter row">
<form class="form-inline" role="form">
<select id="year_expired" class="form-control col-md-2">
	<option value="NULL">Select year</option>
	<?php for($i=2014; $i<=date('Y'); $i++): echo "<option value='$i'selected='selected'>$i</option>"; endfor;  ?>
</select>

<div class="col-md-1">
<button class="btn btn-sm btn-small btn-success filter-expired"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div> 
</div>
</form>
<div class="graph_content" id="div_expiried">
	</div>
</div>
<div  id="Approval" class="tab-pane fade">
<br>
<div class="filter row">
<form class="form-inline" role="form">
<select id="duration_filter" class="form-control col-md-2">
	<option value="NULL" selected="selected">Select Duration</option>
	<option value="3">Next 3 months</option>
	<option value="6">Next 6 months</option>
	<option value="9">Next 9 months</option>
	<option value="12">Next 12 months</option>
</select>
<div class="col-md-1">
<button class="btn btn-sm btn-small btn-success filter-potential"><span class="glyphicon glyphicon-filter"></span>Filter</button> 
</div>
</form> 
</div>
<div class="graph_content" id="div_potential">	
	</div>
</div>
</div>
<script>
$(window).load(function() {

$("#potential_e").on('click', function(e){
		//e.preventDefault();
		$('#duration_filter').val(3)
		$( ".filter-potential" ).trigger( "click" );
	})
        var year='<?php echo $year ?>';
		var url_='<?php echo "reports/actual_expiries_reports/".$this->session->userdata('county_id') ?>'+'/'+year;
		ajax_request_replace_div_content(url_,'#div_expiried');	
});
	$(function(){
	$(".filter-expired").on('click', function(e){
		e.preventDefault();
		var year=$('#year_expired').val();
		if(year=='NULL'){
		 dialog_box('<h5>select the year first<h5>','<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');	
		}
		else{

		var url_='<?php echo "reports/actual_expiries_reports/".$this->session->userdata('county_id') ?>'+'/'+year;
		ajax_request_replace_div_content(url_,'#div_expiried');	
		}
	})
		$(".filter-potential").on('click', function(e){
		e.preventDefault();
		var year=$('#duration_filter').val();
		if(year=='NULL'){
		 dialog_box('<h5>Select the Duration first<h5>','<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');	
		}
		else{
		var url_='<?php echo "reports/potential_expiries_reports/".$this->session->userdata('county_id') ?>'+'/'+year;
		ajax_request_replace_div_content(url_,'#div_potential');	
		}
	})
	})
</script>