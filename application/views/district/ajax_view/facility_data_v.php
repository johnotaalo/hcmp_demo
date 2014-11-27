<style>
	.filter{
	width: 98%;
	height:7em;
	/*border: 1px solid black;*/
	margin:auto;	
	}
	.top_left_content{
	width: 49%;
	height:200px;
	-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
	box-shadow: 1px 1px 1px 1px #DDD3ED;
	margin-left:0.4%;
	float:left;	
	}
	.top_right_content{
	width: 50%;
	height:200px;
	-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
	box-shadow: 1px 1px 1px 1px #DDD3ED;
	margin:auto;
	margin-left:0.4%;
	float:left;		
	}
	.bottom_left_content{
	width: 49%;
	height:200px;
	-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
	box-shadow: 1px 1px 1px 1px #DDD3ED;
	margin:auto;
	margin-left:0.4%;
	float:left;		
	}
	.bottom_right_content{
	width: 50%;
	height:200px;
	-webkit-box-shadow: 1px 1px 1px 1px #DDD3ED;
	box-shadow: 1px 1px 1px 1px #DDD3ED;
	margin:auto;
	margin-left:0.4%;
	float:left;		
	}
</style>

<div class="alert alert-info" style="font-size: 1.6em ; width: 40em; ">
  <b>Please Select filter Options Below</b>
</div>
<div class="filter">
	<h2>
		

	
	
<select id="facility" style="width: 11em;">
<option value="">Select Facility</option>
<?php
foreach($facility_names as $facility):
		$f_id=$facility->facility_code;
		$f_name=$facility->facility_name;	
		echo "<option value='$f_id'>$f_name</option>";
endforeach;
?>
</select>
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
	<!--<a class="link" data-toggle="modal" data-target="#supplyplanModal" href="#">View Supply Plan</a>-->

	</h2>
</div>

<div class="top_left_content ">
	
</div>
<div class="top_right_content ">
	
</div>
<div class="bottom_left_content ">
	
</div>
<div class="bottom_right_content ">
	
</div>
<script>
	
	$(document).ready(function() {
	$(function() {
		
		
		
		});
  });
</script>