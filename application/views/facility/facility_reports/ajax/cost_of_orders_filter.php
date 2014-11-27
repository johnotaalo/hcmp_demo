<div class="filter">	
<h5>
<select name="year" id="year_filter" style="width: 7.8em;">
	<option value="0">Select Year</option>
	<option value="2014">2014</option>
	<option value="2013">2013</option>
</select>
	<button class="btn btn-small btn-success" id="filter" name="filter" style="margin-left: 1em;">Filter <i class="icon-filter"></i></button> 
</h5>
</div>
<div class='graph-section' id='graph-section'></div>
	
</div>
<script>
	$(document).ready(function() 
	{
		<?php echo @$graph_data; ?>
	
			$("#filter").click(function() 
			{
				var url = "reports/load_filtered_cost_of_orders/"+
				$("#year_filter").val();
				       
				ajax_request_replace_div_content(url,'#graph-section');
		
          });

		
		
  });
</script>
