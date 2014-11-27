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
		echo "<option value='$district_id'>$district_name</option>";
endforeach;
?>

				</select>
				</div>
			</td>
			<td>
			<div class="col-md-1">
				<button id="subcounty_filter" class="btn btn-sm btn-small btn-success">
					<span class = "ui-button-text glyphicon glyphicon-filter">Filter</span>
				</button>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="10">
				<div class="graphs">
					
				</div>
			</td>
		</tr>
		</thead>

</table>
</html>

<script>
$(document).ready(function() {
	$("#subcounty_filter").click(function(e)
	 {	
	 	e.preventDefault();	
        var url_ = 'evaluation/analysis/'+$("#sub_county_filter").val();
        // ;  
		ajax_request_replace_div_content(url_,'.graphs');		
           });
	
	});
</script>