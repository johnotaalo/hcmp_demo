<?php //echo "<pre>";print_r($facilities_listing_inactive);echo "</pre>";exit; ?>
<div class="container">
	
	<?php $x = array();
	
					foreach ($counts as $key) {
						
						$x[] = $key['count'];
					}
					$inactive_facilities = $facility_count[0]["total_no_of_facilities"] - $active_count[0]["total_active_facilities"];
					?>

<div class="row" style="padding-top: 0.5%;padding-bottom: 0.5%" >
	
	<div class="col-md-2">
					
	</div>
	
	<div class="col-md-2">
					
	</div>
	
	<div class="col-md-3">
			<div class="panel panel-default">
							<div class="panel-body" id="active">
								<div class="stat_item color_d">
									<span class="glyphicon glyphicon-user"></span>
									<span><?php echo($active_count[0]['total_active_facilities']);?>
										Active</span>
								</div>
							</div>
						</div>	
	</div>
	
	<div class="col-md-3">
					<div class="panel panel-default">
							<div class="panel-body" id="inactive">
								<div class="stat_item color_g">
									<span class="glyphicon glyphicon-user"></span>
									<span><?php echo($inactive_facilities); ?>
										Inactive</span>
								</div>
							</div>
						</div>
	</div>
	<div class="col-md-2">
					
	</div>
	<div class="col-md-2">
					
	</div>
	
</div>

</div>
<div class="container-fluid">
	<div class="page_content">
		
		<div class="container-fluid">
			
			<div class="row">
				<div class="col-md-13 dt" style="border: 1px solid #ddd;padding-top: 1%; " id="test">

					<table  class="table table-hover table-bordered table-update" id="datatable"  >
						<thead style="background-color: white">
							<tr style="font-size: 15px;">
								<th>Facility Name</th>
								<th>Facility Code</th>
								<th>District </th>
								<th>Partner</th>
								<th>Owner</th>
								<th>Facility Type</th>
								<th>Level</th>
								<th>RTK enabled</th>
								<th>CD4 enabled</th>
								<th>Date of Activation</th>
								<th>Status</th>
								<th>Action</th>

							</tr>
						</thead>

						<tbody>

							<?php
							foreach ($facilities_listing_inactive as $list ) {
							?>
							<tr class="edit_tr" style="font-size: 14px;">
								<td class="fname" ><?php echo $list['facility_name']; ?></td>
								<td class="lname"><?php echo $list['facility_code']; ?>	</td>
								<td class="email" data-attr="<?php echo $list['district_id']; ?>"><?php echo $list['district_name'];?></td>
								<td class="phone"><?php echo $list['partner']; ?></td>
								<td class="county"><?php echo $list['owner']; ?></td>
								<td class="district"><?php echo $list['type']; ?></td>
								<td class="district"><?php echo $list['level']; ?></td>
								<td class="district"><?php echo $list['rtk_enabled']; ?></td>
								<td class="district"><?php echo $list['cd4_enabled']; ?></td>
								<td class="level"><?php echo $list['date_of_activation']; ?></td>

								<td >
								<div class="status_item color_d" data-attr="true" >
									<span style="font-size: 12px ;padding:4px">Active</span>
								</div>
								</td>
								<!-- <td>
								<div class=" status_item color_g" data-attr="false" >
									<span style="font-size: 12px;padding:4px">Deactivate</span>
								</div> </td> -->
								<td>
								<button class="btn btn-primary btn-xs edit activate_facility" data-facility-id = "<?php echo $list['facility_code']; ?>" data-facility-status = "<?php echo $list['using_hcmp']; ?>">
									<span class="glyphicon glyphicon-edit"></span>Activate
								</button></td>

							</tr>
							<?php } ?>
						</tbody>
					</table>

				</div>

			</div>
		</div>
	</div>
</div>





	