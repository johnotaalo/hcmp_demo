<div class="container">
	
	<?php $x = array();
	
					foreach ($counts as $key) {
						
						$x[] = $key['count'];
					}
					
					?>

<div class="row" style="padding-top: 0.5%;padding-bottom: 0.5%" >
	
	<div class="col-md-2">
					
	</div>
	
	<div class="col-md-2">
					
	</div>
	
	<div class="col-md-2">
			<div class="panel panel-default">
							<div class="panel-body" id="active">
								<div class="stat_item color_d">
									<span class="glyphicon glyphicon-user"></span>
									<span><?php echo($x[1]);?>
										Active</span>
								</div>
							</div>
						</div>	
	</div>
	
	<div class="col-md-2">
					<div class="panel panel-default">
							<div class="panel-body" id="inactive">
								<div class="stat_item color_g">
									<span class="glyphicon glyphicon-user"></span>
									<span><?php echo($x[0]); ?>
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

				<div class="col-md-1" style="padding-left: 0;">
					<button class="btn btn-primary add" data-toggle="modal" data-target="#addModal" id="add_new">
						<span class="glyphicon glyphicon-plus"></span>Add User
					</button>
				</div>
				<div class="col-md-11 dt" style="border: 1px solid #ddd;padding-top: 1%; " id="test">

					<table  class="table table-hover table-bordered table-update" id="datatable"  >
						<thead style="background-color: white">
							<tr style="font-size: 15px;">
								<th>First name</th>
								<th>Last name</th>
								<th>Email </th>
								<th>County</th>
								<th>Sub-County</th>
								<th>Health Facility</th>
								<th>User Type</th>
								<th>Status</th>
								<th>Action</th>

							</tr>
						</thead>

						<tbody>

							<?php
							foreach ($listing as $list ) {
							?>
							<tr class="edit_tr" style="font-size: 14px;">
								<td class="fname" ><?php echo $list['fname']; ?></td>
								<td class="lname"><?php echo $list['lname']; ?>	</td>
								<td class="email" data-attr="<?php echo $list['user_id']; ?>"><?php echo $list['email'];?></td>
								<td class="county" data-attr="<?php echo $list['county_id']; ?>"><?php echo $list['county']; ?></td>
								<td class="district" data-attr="<?php echo $list['district_id']; ?>"><?php echo $list['district']; ?></td>
								<td class="facility_name" data-attr="<?php echo $list['facility_code']; ?>"><?php echo $list['facility_name']; ?></td>
								<td class="level" data-attr="<?php echo $list['level_id']; ?>"><?php echo $list['level']; ?></td>
								<td >
								<?php
									if ($list['status']==1) {
								?>
								<div class="status_item color_d" data-attr="true" >
									<span style="font-size: 12px ;padding:4px">Active</span>
								</div>
								<?php }else{ ?>

								<div class=" status_item color_g" data-attr="false" >
									<span style="font-size: 12px;padding:4px">Deactivated</span>
								</div> <?php } ?> </td>
								<td>
								<button class="btn btn-primary btn-xs edit " data-toggle="modal" data-target="#editModal" id="<?php echo $list['user_id']; ?>" data-target="#">
									<span class="glyphicon glyphicon-edit"></span>Reports Viewed
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

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" id="myform">
	<div class="modal-dialog">
		<div class="modal-content">
			
			<div class="modal-header" style="padding-bottom:2px;background: #27ae60;color: white">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
					&times;
				</button>
				<h4 class="modal-title" id="editModalLabel" style="text-align: center;line-height: 1">Reports Viewed</h4>
			</div>
			
			<div class="modal-body editable" style="padding-top:0">
				<div id="contents">

					
						<form role="form">

							
								<h4>User details</h4>
						
							<div class="row" >

								<div class="col-md-6">
									<label> First Name </label>
									<div class="form-group">
										<input type="text" required="required" name="fname_edit" id="fname_edit" class="form-control " placeholder="First Name" >
									</div>
								</div>
								<div class="col-md-6">
									<label> Last Name </label>
									<div class="form-group">
										<input type="text" name="lname_edit" required="required" id="lname_edit" class="form-control " placeholder="Last Name" >
									</div>
								</div>
							</div>

							<div class="row">
								<div class="col-md-6">
									<label> Email </label>
									<div class="form-group">
										<input type="email" data-id="" name="email_edit" id="email_edit" required="required" class="form-control " placeholder="email@domain.com" tabindex="6">
									</div>
								</div>
								
								<div class=" col-md-6">
									<label> User Name </label>
									<div class="form-group">
										<input type="email" name="username_edit" id="username_edit" required="required" class="form-control " placeholder="email@domain.com" tabindex="6" readonly>
									</div>
								</div>

								<div class="col-md-6">
										<div class="err_edit" style="padding: 8px;">
											
										</div>
								</div>
							</div>
									
								
							
								<h4>Other details</h4>
								<div class="row" >
									
									<div class="col-md-6">
										<label> County </label>
										<div class="form-group">
											<select class="form-control " id="county_edit" name="county_edit" required="required">
												<option value=''>Select County</option>
														<?php
												foreach ($counties as $county_) :
													$id = $county_ ['id'];;
													$name = $county_ ['county'];;
													echo "<option value='$id'>$name</option>";
												endforeach;
												?>
														
											</select>
										</div>
										
									</div>	
								
									<div class=" col-md-6">
										<label> Sub-county </label>
										<div class="form-group">
											<select class="form-control " id="edit_district" name="edit_district" required="required">
												<option value=''>Select Sub-County</option>
														<?php
												foreach ($sub_counties as $subs_) :
													$id = $subs_ ['id'];;
													$name = $subs_ ['district'];;
													echo "<option value='$id'>$name</option>";
												endforeach;
												?>
											</select>
										</div>
									</div>
									
								</div>
								<div class="row" >
									
									<div class="col-md-6">
										<label> Facility </label>
										<div class="form-group">
											<select class="form-control " id="edit_facility" name="edit_facility" required="required">
												<option value=''>Select Facility</option>
												<?php
													foreach ($facilities as $facility) :
														$id = $facility ->facility_code;
														$f_name = $facility ->facility_name;
														echo "<option value='$id'>$f_name</option>";
													endforeach;
													?>
											</select>
										</div>
										
									</div>	
								
									<div class=" col-md-6">
										<div class="form-group">
											<label> User-type</label>
											<select class="form-control " id="user_type_edit_district" name="user_type_edit_district" required="required">
												<option value='NULL'>Select User Type</option>
												<?php
													foreach ($user_types as $user_t) :
														$id = $user_t ['id'];
														$type_name = $user_t ['level'];
														echo "<option value='$id'>$type_name</option>";
													endforeach;
													?>
											</select>
										</div>
									</div>
									
								</div>
								<div class="row">
									<div class=" col-md-6">
										
										
									</div>
									<div class="col-md-6">
									<div class="onoffswitch">
									    <input type="checkbox" name="onoffswitch" class="onoffswitch-checkbox" id="myonoffswitch" >
									    <label class="onoffswitch-label" for="myonoffswitch">
									        <div  class="onoffswitch-inner"></div>
									        <div  class="onoffswitch-switch"></div>
									    </label>
									</div>
									</div>
								</div>

								<div class="row" style="margin:auto" id="processing">
									<div class=" col-md-12">
										<div class="form-group">
										</div>
									</div>
								</div>

						</form>

					</div>
				
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">
					Close
				</button>
				<input type="button" class="btn btn-primary" id="edit_user" value="Save changes">
					
				</input>
			</div>
			</div>
		</div>
	</div>
</div><!-- end Modal new user -->



	