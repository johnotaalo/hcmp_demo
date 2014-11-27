<?php $current_year = date('Y');
$earliest_year = $current_year - 10;
?>
<script>
	$(function() {
		$("#year").change(function() {
			var selected_year = $(this).attr("value");
			//Get the last year of the dropdown list
			var last_year = $(this).children("option:last-child").attr("value");
			//If user has clicked on the last year element of the dropdown list, add 5 more
			if($(this).attr("value") == last_year) {
				last_year--;
				var new_last_year = last_year - 5;
				for(last_year; last_year >= new_last_year; last_year--) {
					var cloned_object = $(this).children("option:last-child").clone(true);
					cloned_object.attr("value", last_year);
					cloned_object.text(last_year);
					$(this).append(cloned_object);
				}
			}
		});
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
			json_obj={"url":"<?php echo site_url("order_management/getFacilities");?>",}
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
	});
	</script>
	<div id="filter">
		<legend>
			Select Filter Options
		</legend>
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
		<option>--facilities--</option>
	</select>
	
		<label>From</label>
		<select name="from" id="from" >
         <option value="1" >Jan</option>
         <option value="2" >Feb</option>
         <option value="3" >March</option>
         <option value="4" >April</option>
         <option value="5" >May</option>
         <option value="6" >June</option>
         <option value="7" >July</option>
         <option value="8" >August</option>
         <option value="9" >Sept</option>
         <option value="10" >Oct</option>
         <option value="11" >Nov</option>
         <option value="12" >Dec</option>
    </select>
		<label>To</label>
		<select name="to" id="to" >
         <option value="1" >Jan</option>
         <option value="2" >Feb</option>
         <option value="3" >March</option>
         <option value="4" >April</option>
         <option value="5" >May</option>
         <option value="6" >June</option>
         <option value="7" >July</option>
         <option value="8" >August</option>
         <option value="9" >Sept</option>
         <option value="10" >Oct</option>
         <option value="11" >Nov</option>
         <option value="12" >Dec</option>
    </select>
    
    <label for="year_from">Select Year</label>
		<select name="year_from" id="year">&nbsp;
			<?php
for($x=$current_year;$x>=$earliest_year;$x--){
			?>
			<option value="<?php echo $x;?>"
			<?php
			if ($x == $current_year) {echo "selected";
			}
			?>><?php echo $x;?></option>
			<?php }?>
			
	<input style="margin-left: 10px" type="button" id="filter" value="filter"/>
	
	&nbsp;&nbsp;view orders that are:  <a href="<?php echo site_url('order_management/kemsa_order_v/pending')?>" class="link">Pending</a>&nbsp;|&nbsp;
	<a href="<?php echo site_url('order_management/kemsa_order_v/approved')?>" class="link">Approved</a>&nbsp;|&nbsp;
	<a href="<?php echo site_url('order_management/kemsa_order_v/dispatched')?>" class="link">Dispatched</a>&nbsp;|&nbsp;
	<a href="<?php echo site_url('order_management/kemsa_order_v/delivered')?>" class="link">Delivered</a>
	</fieldset>
	</div>
	<?php if(count($order_list)>0) :?>
<div id="notification">Balance = ( Drawing Rights - Order Total)</div>
<table class="data-table">	
	<tr>
		<?php 
	 echo form_open('order_management/moh_order_details'); ?>
		<th>Order Number</th>
		<th>Kemsa Order No.</th>
		<th>MFL Code</th>
		<th>Facility Name</th>
		<th>Order Total</th>
		<th>Drawing Rights</th>
		<th>Balance</th>
		<th>Order Date</th>
		<th>Approval Date</th>
		<th>TAT</th>
		<th>Dispatched Date</th>
		<th>Deliver Date</th>
		<th>TAT</th>
		<th>Order Status</th>
		<th>Action</th>
		<th>Action</th>
	</tr>
	<?php
		foreach($order_list as $rows) :
	  $total=$rows->orderTotal;
	   $rights=$rows->drawing_rights;
	   $bal=$rights-$total;
	   
?>
	<tr>
		<td><?php echo $rows->id;?></td>
		<td><?php echo $rows->kemsaOrderid;?></td>
		<td><?php echo $rows->facilityCode;?></td>
		<td><?php foreach($rows->Code as $facility) echo $facility->facility_name;?></td>
		<td><?php echo  number_format($total, 2, '.', ',') ;?></td>
		<td><?php echo  number_format($rights, 2, '.', ',');?></td>
		<td><?php echo  number_format($bal, 2, '.', ',');?></td>
		<td><?php 
		$datea= $rows->orderDate;
		$fechaa = new DateTime($datea);
        $datea= $fechaa->format('d M Y');
		echo $datea;?></td>
		<td><?php 
		$dateb= $rows->approvalDate;
		if($dateb<>""){
		$fechab = new DateTime($dateb);
        $dateb= $fechab->format('d M Y');
		echo $dateb;
		}
		else {
			$fechab= NULL;
		}
		
		?></td>
		<td><?php 
		$days1=$myClass->getWorkingDays($fechaa,$fechab,0);
		if($days1!=NULL)
        {
        	echo $days1.' day(s)';
		}?></td>
		<td><?php 
		$date3= $rows->dispatchDate;
		if($date3<>""){
		$fecha3 = new DateTime($date3);
        $datec= $fecha3->format('d M Y');
		 echo $datec.'d';
		}
		else {
			$fecha3="";
		}
       ?></td>
		<td><?php 
		
		$dated= $rows->deliverDate;
		if($dated<>""){
		$fechad = new DateTime($dated);
        $dated= $fechad->format('d M Y');
		echo $dated.'dl';
		}
		else {
			$fechad="";
		}
		?></td>
		<td>
			<?php 
$days=$myClass->getWorkingDays($fecha3,$fechad,0);
		if($days!=NULL)
        {echo $days.' day(s)';}?></td>
		<td><?php echo $rows->orderStatus;?></td>
		
		<td><a href="<?php echo site_url('order_management/kemsa_order_details/'.$rows->id)?>"class="link">View</a></td>
		<td><a href="<?php echo site_url('order_management/kemsa_approve_order/'.$rows->id)?>"class="link">Dispatch</a></td>
	</tr> 
	<?php
		endforeach;
	?>
</table>
<?php 
else :
	echo '<div id="notification">No Records Found </div>';
endif; ?>