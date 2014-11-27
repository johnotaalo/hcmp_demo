<script>
	$(function() {
		$("#accordion").accordion({
			autoHeight : false,
			active: false,
			collapsible: true
		});		
		$('#counties').click(function(){
			/*
			 * when clicked, this object should populate district names to district dropdown list.
			 * Initially it sets default values to the 2 drop down lists(districts and facilities) 
			 * then ajax is used is to retrieve the district names using the 'dropdown()' method that has
			 * 3 arguments(the ajax url, value POSTed and the id of the object to populated)
			 */
			$("#districts").html("<option>--disticts--</option>");
			$("#facilities").html("<option>--facilities--</option>");
			json_obj={"url":"<?php echo site_url("order_management/getDistrict");?>",}
			var baseUrl=json_obj.url;
			var id=$(this).attr("value")
			dropdown(baseUrl,"county="+id,"#districts")
		});
		$('#districts').click(function(){
			/*
			 * when clicked, this object should populate facility names to facility dropdown list.
			 * Initially it sets a default value to the facility drop down list then ajax is used 
			 * is to retrieve the district names using the 'dropdown()' method used above.
			 */
			$("#facilities").html("<option>--facilities--</option>");
			json_obj={"url":"<?php echo site_url("order_management/getHFacilities");?>",}
			var baseUrl=json_obj.url;
			var id=$(this).attr("value")
			dropdown(baseUrl,"district="+id,"#facilities")
		});
		$('#filter').click(function(){
			
		});
		function dropdown(baseUrl,post,identifier){
			/*
			 * ajax is used here to retrieve values from the server side and set them in dropdown list.
			 * the 'baseUrl' is the target ajax url, 'post' contains the a POST varible with data and
			 * 'identifier' is the id of the dropdown list to be populated by values from the server side
			 */
			$.ajax({
			  type: "POST",
			  url: baseUrl,
			  data: post,
			  success: function(msg){
			  		var values=msg.split("_")
			  		var dropdown;
			  		for (var i=0; i < values.length-1; i++) {
			  			var id_value=values[i].split("*")
			  			dropdown+="<option value="+id_value[0]+">";
						dropdown+=id_value[1];
						dropdown+="</option>";
					};
					$(identifier).html(dropdown);
			  },
			  error: function(XMLHttpRequest, textStatus, errorThrown) {
			       if(textStatus == 'timeout') {}
			   }
			}).done(function( msg ) {
			});
		}
		
		$( "#filter-b" )
			.button()
			.click(function() {
				var facility=$("#facilities :selected").val();
				if(facility==0 || facility=="--facilities--"){	
				window.location.href = "<?php echo base_url();?>stock_management/county_stock/"+$("#counties :selected").val()+'/'+$("#counties :selected").text();
				}
				else{
					window.location.href = "<?php echo base_url();?>stock_management/get_facility_stock/"+$("#facilities :selected").val()+"/"+$("#facilities :selected").text();
				}
});
	});
	</script>
		<div id="filter">
		<fieldset>
	<label>County</label>
	<select id="counties">
		<option>--counties--</option>
		<?php 
		foreach ($counties as $counties) {
			$id=$counties->id;
			$county=$counties->county;?>
			<option value="<?php echo $id;?>"><?php echo $county;?></option>
		<?php }
		?>
	</select>
	<label>District</label><select id="districts">
		<option>--disticts--</option>
	</select>
	<label>Facility</label><select id="facilities">
		<option value="0">--facilities--</option>
	</select>			
	<input style="margin-left: 10px" type="button" id="filter-b" value="filter" />
	</fieldset>
	</div>
	<h2 style="margin-bottom: 10px; margin-top: 10px; margin-left: 35%"><?php
		if($this->uri->segment(4)) {echo urldecode($this->uri->segment(4)); } else {echo "Country wide";}?> Stock Balance as at <?php $fechab = new DateTime();
        $dateb= $fechab->format(' jS  M Y');
		echo $dateb; ?></h2>
		
		<table class="data-table">
					<tr>
						<th><b>KEMSA Code</b></th>
						<th><b>Description</b></th>
						<th><b>Stock Balance</b></th>
					</tr>
					<?php $count=0;
						foreach($stock_count as $stock_balance){?>
						<tr>
							<td><?php echo $stock_balance->kemsa_code;?></td>
							<td><?php 
							foreach($stock_balance->stock_Drugs as $test) {echo $test->Drug_Name;}?></td>
							<td><?php
							echo $stock_balance->quantity1;
							?></td>
							
						</tr>
						
						<?php
						$count++;
						}
					?>
						<?php if($count==0): ?><tr><td colspan="3"><h2>There is no data to display</h2>  </td></tr><?php endif;?>
				</table>
			
			

		
	<!--	</div>
	</div>
</div>-->
