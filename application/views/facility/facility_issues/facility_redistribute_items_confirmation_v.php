<style>
 	.input-small{
 		width: 60px !important;
 	}

	.big{ width: 100px !important; }
	.row div p{
	padding:10px;
}
</style>

<div class="container" style="width: 96%; margin: auto;">
	
	<div class="row">
		<div class="col-md-6"><p class="text-danger">*To avoid adding items to your stock, leave the values as zero</p></div>
		
	</div>
	
 <?php $att=array("name"=>'myform','id'=>'myform'); echo form_open('stock/add_more_stock_level_external',$att); ?>
 <table width="98%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="example">
	<thead>
		<tr>
			<th>From</th>
			<th>To</th>
			<th>Commodity Name</th>
			<th>Commodity Code</th>
			<th>Unit Size</th>
			<th>Batch No</th>
			<th>Expiry Date</th>
			<th>Manufacturer</th>
			<th>Quantity Sent(units)</th>
			<th>Quantity Sent(packs)</th>
			<th>Issue Type</th>
			<th>Quantity Received</th>
			<th>Total Units</th>
		</tr>
	</thead>
	<tbody>
		<?php $edit=($editable!='to-me') ? "readonly='readonly'": null;	
		foreach($redistribution_data as $redistribution_data){
			$manu=$redistribution_data->manufacturer;
			foreach($redistribution_data->facility_detail_source as $facility){
					$name_=$facility->facility_name." MFL ".$facility->facility_code; $mfl=$facility->facility_code;}
			foreach($redistribution_data->facility_detail_receive as $facility){
					$name_facility_detail_receive=$facility->facility_name." MFL ".$facility->facility_code;}
			foreach($redistribution_data->stock_detail as $stock_detail){			
				
				foreach($stock_detail->commodity_detail as $commodity_detail){
				$name=$commodity_detail->commodity_name;
				$code=$commodity_detail->commodity_code;
				$unit_size=$commodity_detail->unit_size;
				$total_commodity_units=$commodity_detail->total_commodity_units;
				$source_of_item=$commodity_detail->commodity_source_id;	
				}
				$packs=round($redistribution_data->quantity_sent/$total_commodity_units,1);	
				$date=date('d My',strtotime($redistribution_data->expiry_date));
						
			}
		echo "<tr>
		<td>
		<input type='hidden' name='source_of_item[]' class='source_of_item' value='$source_of_item'>
		<input type='hidden' name='service_point[]' class='service_point' value='$mfl'>
		<input type='hidden' name='total_commodity_units[]' class='total_commodity_units' value='$total_commodity_units'>
		<input type='hidden' name='commodity_id[]' class='commodity_id' value='$redistribution_data->commodity_id'>
		<input type='hidden' name='facility_stock_id[]' class='facility_stock_id' value='$redistribution_data->id'>
		$name_</td>
		<td>$name_facility_detail_receive</td>
		<td>$name</td>
		<td>$code</td>
		<td>$unit_size</td>
		<td><input type='text' 
		name='commodity_batch_no[]' class='form-control input-small commodity_batch_no' value='$redistribution_data->batch_no' $edit></td>
		<td><input type='text' 
		name='clone_datepicker[]' class=' form-control big clone_datepicker' value='$date' $edit></td>
		<td><input type='text' 
		name='commodity_manufacture[]' class='form-control input-small  commodity_manufacture' value='$manu' $edit></td>
		<td><input type='text' readonly='readonly' 
		name='commodity_total_units[]' class='form-control input-small commodity_total_units' value='$redistribution_data->quantity_sent'></td>
		<td><input class='form-control big commodity_total_units' type='text' readonly='readonly' value='$packs'></td>
		<td><select class='form-control  commodity_unit_of_issue ' name='commodity_unit_of_issue[]'>
			<option value='Pack_Size'>Pack Size</option>
			<option value='Unit_Size'>Unit Size</option>
			</select></td>
		<td><input class='form-control big quantity' 
		type='text' 'name='quantity[]' value='0' $edit/></td>
		<td><input class='form-control big actual_quantity' 
		type='text' name='actual_quantity[]' readonly='readonly' value='0'/></td>
		</tr>";			
		}
		
		?>

</tbody>
</table> 
<?php echo form_close();?> 
<?php if(isset($edit)){ } else{ ?>
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="btn btn-success save" ><span class="glyphicon glyphicon-open"></span>Update</button></div>
</div>
</div>
 <?php };?>  
<script>
$(document).ready(function() {
	//datatables settings 
	$('#example').dataTable( {
		 "sDom": "T lfrtip",
	     "sScrollY": "377px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
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
			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
	} );
	$('#example_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');
	
		//compute the order totals here
	$(".quantity").on('keyup', function (){
	var selector_object=$(this);
	var user_input=$(this).val();
	var total_units=$(this).closest("tr").find(".total_commodity_units").val();
	var pack_unit_option=$(this).closest("tr").find(".commodity_unit_of_issue").val();
	var donated_items=$(this).closest("tr").find(".commodity_total_units").val();
	//var total_units=calculate_actual_stock (total_units,pack_unit_option,user_input,"return",selector_object,null);
	// check the user input value here
	var alert_message='';
			if (selector_object.val() <0) { alert_message+="<li>Value must be above 0</li>";}
		    if (selector_object.val().indexOf('.') > -1) {alert_message+="<li>Decimals are not allowed.</li>";}		
			if (isNaN(selector_object.val())){alert_message+="<li>Enter only numbers</li>";}	
			//if(total_units>donated_items){alert_message+="<li>You cannot receive more than was given to you</li>";}			
			if(isNaN(alert_message)){
	//reset the text field and the message dialog box 
    selector_object.val(""); var notification='<ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
    //hcmp custom message dialog
    dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
    //This event is fired immediately when the hide instance method has been called.
    $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();	})
    selector_object.closest("tr").find(".actual_quantity").val("");
    selector_object.val("");
    return;   } 
 
   calculate_actual_stock (total_units,pack_unit_option,user_input,".actual_quantity",selector_object,null);
	});
	
	$(".commodity_unit_of_issue").on('change', function (){
	$(this).closest("tr").find(".quantity").val("");
	$(this).closest("tr").find(".actual_quantity").val("");	
	})
	
	/************save the data here*******************/
	$('.save').button().click(function() {

    // save the form
    confirm_if_the_user_wants_to_save_the_form("#myform");
     });
});
</script>