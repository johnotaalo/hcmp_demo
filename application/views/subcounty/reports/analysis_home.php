<?php 
 function calculate_percentage($val1,$val2){
 		if(!isset($val1)) {
			 $val1 = 1;
		 }
		if (!isset($val2)){
			$val2 = 1;
		}
	
            $percentage = ($val2/$val1)*100;
            return @round($percentage);
        }
 ?>
<html>
<table width="100%" border="0" 
       class="row-fluid table table-hover table-bordered table-update"  id="test3">
	<thead>
		<tr>
			<td>
			<div>
				<select id="sub_county_filter" class="form-control">
	 				<?php
foreach($district_data as $district_):
		$district_id=$district_->id;
		$district_name=$district_->district;	
		echo "<option value='$district_id'";
		if ($county_id == $district_id) {
			echo 'selected =  "selected" ' ;
		}
		echo ">$district_name</option>";
endforeach;
?>

				</select>
				</div>
			</td>
			<td>
				<button id="subcounty_filter" class=" btn btn-sm btn-small btn-success">
				<span class = "ui-button-text">
					<span class = " glyphicon glyphicon-filter "></span> Filter
					</span>
				</button>
			
			</td>
		</tr>
		<tr>
			<td colspan="10">
				<div class="graphs" id="graph_id">
						
				</div>
			</td>
		</tr>
		</thead>

</table>
</html>

<script>
	$(function () { 
		<?php
			   echo $facility_evaluation_default;//first chart
               echo $frequency_of_use;
               echo $trained_personel;
               echo $comfort_level;//sixth chart
               echo $training_resource;
         ?>    
});

$(document).ready(function() {
	$("#subcounty_filter").click(function(e)
	 {	
	 	e.preventDefault();	
        var url_ = 'evaluation/analysis/'+$("#sub_county_filter").val();

		ajax_request_replace_div_content(url_,'.graphs');		
           });
	window.onload = function(){
		
        var url_ = 'evaluation/default_graph/'+$("#sub_county_filter").val();

		ajax_request_replace_div_content(url_,'.graphs');
	}

	});


</script>