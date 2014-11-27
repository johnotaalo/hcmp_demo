 <style>
 	.row div p{
	padding:10px;
}
 </style>
 <!------MODAL BOX------>
 <div class="modal fade" id="edit_" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="myModalLabel">Edit Service Point</h4>
      </div>
      <div class="modal-body">
<form class="form-horizontal" role="form"  action="<?php echo base_url()?>issues/update_service_point" method="post">
    <div class="form-group">
   <label class="control-label col-sm-5 " for="category_name">Service Point Name</label>
    <div class="col-sm-7">
     <input type="text" name="name" id="name" class="required form-control"/>
	<input type="hidden" name="id" id="id" class="required"/>
    </div>
  </div>
  <?php // only the super admin can make a service point be for all facilities  echo 
	if($this -> session -> userdata('user_indicator')=='super_admin'){
	echo '
	<div class="form-group">
   <label class="control-label col-sm-5 " for="category_name">For All Facilities</label>
    <div class="col-sm-7">
    <select name="all_facilities" id="all_facilities"  class="form-control">
						<option value="1">Yes</option>
						<option value="0">No</option>
					</select>
    </div>
</div>'
		;	
	}else{
		echo '<input type="hidden" name="all_facilities" id="all_facilities"/>';
	}
?>	
<div class="form-group">
   <label class="control-label col-sm-5 " for="category_name">Status</label>
    <div class="col-sm-7">
    <select name="status" id="status"  class="form-control">
						<option value="1">Active</option>
						<option value="0">Inactive</option>
	</select>
    </div>
</div>	
	</div>
	<div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
	</form>
    </div>
  </div>
</div><!-----END--->
<div class="container" style="width: 96%; margin: auto;">
<div class="row">
	
<div class="col-md-3" style="border: 1px solid #DDD;">
<?php echo form_open('issues/save_service_points'); ?>
<div class="row">
		
		<div class="col-md-6" id=""><p class="bg-info"><span class="badge ">1</span>Enter the name of the Service Point
			</span></p>
		
	</div>
	<div class="col-md-6" id=""><p class="bg-info"><span class="badge ">2</span>Click save when done
			</span></p>
		
	</div>
	</div>
<div class="table-responsive" style="height:417px; overflow-y: auto;">
<table  class="table table-hover table-bordered table-update" id="facility_service_points" >
<thead style="background-color: white">
<tr><th>Service Point Name</th><th>Action</th></tr>
</thead>
<tbody>
<tr row_id='0'>
<td><input class='form-control input-small service_point' required="required" type="text" name="service_point[0]"/></td>
<td><button type="button" class="remove btn btn-danger btn-xs"><span class="glyphicon glyphicon-minus"></span>Remove Row</button></td>
</tr>
</tbody>
</table>
</div>
<hr />
<div class="container-fluid">
<div style="float: right">
<button type="button" class="add btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Add Row</button>
<button class="btn btn-success" id="save"><span class="glyphicon glyphicon-open"></span>Save</button></div>
</div>
<?php echo form_close();?>

 </div>
  <div class="col-md-9"  style="border: 1px solid #DDD;">
  	<table cellpadding="0" cellspacing="0" width="100%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<th>Service Point Name</th>
			<th>Date Added</th>
			<th>Facility MFL</th>
			<th>Facility Name</th>
			<th>Sub-County</th>
			<th>Added By</th>
			<th>Cred</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>

<?php 
foreach ($service_point as $service_point) :						
			$service_point_name=$service_point->service_point_name;
			$date_added=date('D d, M Y', strtotime($service_point->date_modified));
			$facility_code=$service_point->facility_code;
			$added_by=$service_point->added_by;	
			$status=$service_point->status;	
			$all_facilities=$service_point->for_all_facilities;	$user_type_name=$user_name='';			
			// get the facility detail
			foreach($service_point->facility_details as $facility1){
			$facility_name_=$facility1->facility_name;	
			foreach($facility1->facility_subcounty as $district_){ $sub_county_name=$district_->district;}	
			}//get the user details	
			foreach($service_point->system_users as $user){
			$user_name=$user->fname.' '.$user->lname;
			foreach($user->u_type as $user_type){ $user_type_name=$user_type->level;}					
			}//check if the item has been disabled
			if($status==0){
			$back_ground="#DDD";
		    $action='Activate';	
			}else{
			$back_ground="white";
		    $action='Edit';		
			}// check if the user can edit the service point
			if($added_by==$this -> session -> userdata('user_id')){
			$button='<button type="button" class="edit_record btn btn-success btn-xs">'.$action.'</button>';
			}else{
			$button='<span class="label label-default">'.$action.'</span>';	
			}	
		echo "<tr style='background-color:$back_ground' row_id='$service_point->id'><td>$service_point_name</td>
		<td><input type='hidden' name='status' class='status' value='$status'/>
		<input type='hidden' name='all_facilities' class='all_facilities' value='$all_facilities'/>
		$date_added</td>
		<td>$facility_code</td>
		<td>$facility_name_</td>
		<td>$sub_county_name</td>
		<td>$user_name</td>
		<td>$user_type_name</td>
		<td>$button</td>
		</tr>";		
endforeach;
?> 
</tbody>
</table>  	
  </div>
  </div>
  </div>
<script>
/* Table initialisation */
$(document).ready(function() {
	 var $table = $('#facility_service_points');
//float the headers
  $table.floatThead({ 
	 scrollingTop: 100,
	 zIndex: 1001,
	 scrollContainer: function($table){ return $table.closest('.table-responsive'); }
	});	
$(".add").click(function() { //add row here
             clone_the_last_row_of_the_table();
		});
			$('.remove').on('click',function(){
			var rowCount =0;
			rowCount = $('#facility_service_points  >tbody >tr').length;
			//finally remove the row 
	       if(rowCount==1){
	       	 clone_the_last_row_of_the_table();
	       	 $(this).parent().parent().remove(); }
	       else{$(this).parent().parent().remove(); }
			});		
	$(".edit_record").click(function() {
    var row_id = $(this).closest('tr').attr("row_id");
    var name =  $('td:first', $(this).parents('tr')).text();
	var status = $(this).closest("tr").find(".status").val();
	var for_all_facilities=$(this).closest("tr").find(".all_facilities").val();
	 $('#name').val(name);
	 $('#id').val(row_id);
	 $('#status').val(status);
	 $('#all_facilities').val(all_facilities);
	 $('#edit_').modal('show');
	});
	//datatables settings 
	$('#example').dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
         //"sDom": 'T<"clear">lfrtip',
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}

			],
			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_cvs_xls_pdf.swf"
		}
	} );

		function  clone_the_last_row_of_the_table(){
	        var selector_object = $('#facility_service_points tr:last');
            var cloned_object = selector_object.clone(true);
            var table_row = cloned_object.attr("row_id");
            var next_table_row = parseInt(table_row) + 1; 
            var blank_value = "";          
		    cloned_object.attr("row_id", next_table_row);
			cloned_object.find(".service_point").attr('name','service_point['+next_table_row+']');   
			cloned_object.find(".service_point").val(blank_value);          
			cloned_object.insertAfter('#facility_service_points tr:last');	
	}
} );
</script>

