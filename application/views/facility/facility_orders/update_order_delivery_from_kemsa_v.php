<style>
 	.input-small{
 		width: 80px !important;
 	}
 	.row div p{
	padding:10px;
}
 </style>
<?php $att = array("name" => 'myform', 'id' => 'myform');
echo form_open('stock/update_facility_stock_from_kemsa_order', $att);
 foreach($general_order_details as $general_order_details):
	 
	 foreach($general_order_details->ordered_detail as $ordered_detail_){
	 $ordered_by=$ordered_detail_->fname." ".$ordered_detail_->lname;
	 }
	 foreach($general_order_details->dispatch_detail as $dispatch_detail_){
	 $approved_by=$dispatch_detail_->fname." ".$dispatch_detail_->lname;
	 }
	 echo "<input type ='hidden' name='hcmp_order_id' value='$general_order_details->id' />"
 ?>
<div class="container" style="width: 96%; margin: auto;">

	<div class="row">
		<div class="col-md-12" id=""><p class="bg-info">Please enter Order Delivery details and Received commodities in Packs and NOT units

	&nbsp;&nbsp;<strong>*NB</strong>	&nbsp;Commodities as supplied by KEMSA</p></div>
		
	</div>
	</div>
<div class="container" style=" font-size: 15px; margin-bottom: 1em;">
	
	<button type="button" class="btn btn-success show_hide">Delivery Dispatch Details. Click to Hide</button>
</div>

<div class="row-fluid" id="updateord">
	<fieldset  class="col-md-3">
		<legend>
			Order Details
		</legend>
		<div >
			<label>Order Date :</label>
			<input type="text" class="form-control"   name="orderd" readonly="readonly" value="<?php echo date('d M, Y',strtotime($general_order_details->order_date))?>"  />

			<label>Order By:</label>
			<input type="text" class="form-control"  readonly="readonly"  name="orderby" value="<?php echo $ordered_by; ?>" />

			<label>Order Sheet No :</label>
			<input type="text" class="form-control"  name="order"   readonly="readonly" value="<?php echo $general_order_details->order_no  ?>" />
			
			<label>Order Total (KSH) :</label>
			<input type="text" class="form-control order_total"  name="order_total"   readonly="readonly" value="<?php echo $general_order_details->order_total  ?>" />
			
		</div>
	</fieldset>

	<fieldset  class="col-md-3">
		<legend>
			Approval Details
		</legend>
		<div >
			<label>Approval Date</label>
			<input type="text" class="form-control"  name="appd" readonly="readonly"  value="<?php echo date('d M, Y',strtotime($general_order_details->approval_date))?>" />

			<label>Approved By</label>
			<input type="text" class="form-control"   name="appby"  readonly="readonly" value="<?php echo $approved_by; ?>" />

		</div>
	</fieldset>

	<fieldset  class="col-md-3">
		<legend>
			Dispatch Details
		</legend>
		<div >

			<label>Dispatch Date:*</label>
			<input type="text" class="form-control clone_datepicker_normal_limit_today"  name="dispatch_date"  value="" id="dispatch_date" />
		

			<label>Delivery Note No:*</label>
			<input type="text" class="form-control"  name="dno" id="dno" />

			<label>Warehouse*</label>
			<input type="text" class="form-control"  name="warehouse" id="warehouse" />
			
			 <label>KEMSA Order No :*</label>
			<input type="text" class="form-control"  name="kemsa_order_no" value="" id="kemsa_order_no"  />
		</div>
	</fieldset>

	<fieldset  class="col-md-3">
		<legend>
			Delivery Details
		</legend>
		<div >

			<label>Date Delivered:</label>
			<input type="text" class="form-control clone_datepicker_normal_limit_today"  name="deliver_date" value="<?php echo date('d M Y'); ?>" />

			<label>Received By</label>
			<input type="text" class="form-control"  readonly="readonly"  name="rname" value="<?php echo $this -> session -> userdata('full_name') ?>" />

			<label>Receiver's Phone`s Number:</label>
			<input type="text" class="form-control"  name="rphone"  readonly="readonly" value="<?php echo $this -> session -> userdata('phone_no') ?>"  />
			
			<label>Order Total :</label>
			<input type="text" class="form-control actual_order_total"  name="actual_order_total"  readonly="readonly" value="" />

		</div>
	</fieldset>

</div>
<?php endforeach;  ?>

<div class="container-fluid"  style="margin-top: 2%">

	<table  id="main" width="100%" class="row-fluid table table-hover table-bordered table-update"  >
		<thead>
			<tr>
				<th>Description</th>
				<th>Item Code</th>
				<th>Unit Size</th>
				<th>Unit Cost(KSH)</th>
				<th>Ordered Qty (Packs)</th>
				<th>Ordered Qty (Units)</th>
				<th>Price Bought</th>
				<th>Total Cost(KSH)</th>
				<th>Batch No</th>
				<th>Manufacturer</th>
				<th>Expiry Date</th>
				<th>Quantity Received</th>
				<th>Total Unit Count</th>
				<th>Total Cost(KSH)</th>
			</tr>
		</thead>
		<tbody >
 <?php  $new_count=0; foreach($order_details as $order_details):
        $cost=$order_details['unit_cost']*$order_details['quantity_ordered_pack'];
        $expiry_date=strtotime($order_details['expiry_date'])  ? $order_details['expiry_date'] : null ;
        echo "<tr>
        <td>
        <input type='hidden' class='order_details_id' name='order_details_id[$new_count]' value='$order_details[id]'/>
        <input type='hidden' class='commodity_name' name='commodity_name[$new_count]' value='$order_details[commodity_name]'/>
        <input type='hidden' class='commodity_code' name='commodity_code[$new_count]' value='$order_details[commodity_code]' />
        <input type='hidden' class='commodity_id' name='commodity_id[$new_count]' value='$order_details[commodity_id]' />
        <input type='hidden' class='total_commodity_units' name='total_commodity_units[$new_count]' value='$order_details[total_commodity_units]' /> 
        <input type='hidden' class='unit_cost' name='unit_cost[$new_count]' value='$order_details[unit_cost]' />
        <input type='hidden' name='unit_size[$new_count]' value='$order_details[unit_size]' />
        $order_details[commodity_name]</td>
        <td>$order_details[commodity_code]</td>
        <td>$order_details[unit_size]</td>
        <td>$order_details[unit_cost]</td>
        <td><input class='form-control input-small' type='text' name='qty_pack[$new_count]' value='$order_details[quantity_ordered_pack]' readonly='yes'/></td>
        <td><input class='form-control input-small' type='text' name='qty_unit[$new_count]' value='$order_details[quantity_ordered_unit]' readonly='yes'/></td>
        <td><input class='form-control input-small' type='text' name='price_bought[$new_count]' value='$order_details[unit_cost]' readonly='yes'/></td>
        <td><input class='form-control input-small' type='text' name='total_cost[$new_count]' value='$cost' readonly='yes'/></td>
        <td><input class='form-control input-small batch_no' type='text' name='batch_no[$new_count]' value='$order_details[batch_no]' required='required'/></td>
        <td><input class='form-control input-small manu' type='text' name='manu[$new_count]' value='$order_details[maun]' required='required'/></td>
        <td><input class='form-control input-small clone_datepicker' type='text' name='expiry_date[$new_count]' 
        value='$expiry_date' required='required' /></td>
        <td><input class='form-control input-small quantity' type='text' name='quantity[$new_count]'
         value='$order_details[quantity_recieved]' required='required' /></td>
        <td><input class='form-control input-small actual_quantity' type='text' name='actual_quantity[$new_count]' 
        value='$order_details[quantity_recieved_unit]' readonly='yes'/></td>
        <td><input class='form-control input-small cost' type='text' name='cost[$new_count]' value='' readonly='yes'/></td>
        </tr>";
        $new_count++;
    endforeach;
 
 echo "<script>var count=".($new_count)."</script>"; ?>
		</tbody>

	</table>
	</div>
	<hr />
<div class="container">
<div style="float: right;">
<button type="button" class="add btn  btn-primary btn-sm"><span class="glyphicon glyphicon-plus"></span>Add Item</button>
<button type="button" class="test btn btn-success btn-sm"><span class="glyphicon glyphicon-open"></span>Update Stocks</button>
</div>
 </div>

<script>
	$(document).ready(function() {
		var new_count =count;
		//auto compute
        calculate_totals();
		$(".show_hide").show();
		$('.show_hide').click(function(event) {
		if($(this).html()=="Delivery Dispatch Details. Click to Hide"){
		$(this).html(); $(this).html("Delivery Dispatch Details. Click to Show")	
		}
		else{
		$(this).html(); $(this).html("Delivery Dispatch Details. Click to Hide")	
		}
		event.preventDefault();
		$("#updateord").slideToggle();
		});
			//datatables settings 
	$('#main').dataTable( {
       "sPaginationType": "bootstrap",
       "sScrollY": "277px",
	     "sScrollX": "100%",
        "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records"},
        "bPaginate": false} );
	$('.dataTables_filter label input').addClass('form-control');
	$('#example_length label select').addClass('form-control');	
	// add commodity data
    $(".add").button().click( function (){
    
    $('.modal-dialog').addClass("modal-lg");
	var body_content='<table class="row-fluid table table-hover table-bordered table-update" width="100%">'+
		'<thead><tr><th>Description</th><th>Item code</th><th>Unit Size</th><th>Unit Cost</th><th>Batch No</th><th>Manufacturer</th><th>Expiry Date &nbsp;</th>'+
		'<th>Quantity Received</th><th>Total Unit Count</th></tr></thead><tbody><tr>'+			   	    
		'<td><select id="desc" name="desc" class="form-control desc"><option value="0">--Select Commodity Name--</option>'+
                    '<?php	foreach($facility_commodity_list as $commodity):
					 		$commodity_name=preg_replace('/[^A-Za-z0-9\-]/', ' ',$commodity['commodity_name']);
						     $commodity_id=$commodity['commodity_id'];
							 $commodity_code=$commodity['commodity_code'];	
							 $sub_category_name=preg_replace('/[^A-Za-z0-9\-]/', ' ',$commodity['sub_category_name']);
							 $unit_size=preg_replace('/[^A-Za-z0-9\-]/', ' ',$commodity['unit_size']);						
							 $unit_cost=$commodity['unit_cost'];
							 $total_commodity_units=$commodity['total_commodity_units'];
							 ;?>'+					
						'<option <?php echo 'special_data="'.$commodity_id.'^'.$unit_cost.'^'.$unit_size.
	'^'.$sub_category_name.'^'.$commodity_code.'^'.$total_commodity_units.'" value="'.$commodity_id.'">'.$commodity_name ;?></option><?php endforeach;?>'+
	'</select></td><td><input readonly="readonly" class="form-control" type="text" name="commodity_code"    /></td>'+
						'<td><input class="form-control" readonly="readonly" type="text" name="unit_size"  /></td>'+
						'<td><input class="form-control unit_cost" readonly="readonly" type="text" name="unit_cost"   />'+
				'<td><input type="text" class="form-control"  name="batch_no" id="batch_no" value="" /></td>'+
				'<td><input type="text" class="form-control" name="manufacturer" id="manufacturer" value=""/></td>'+
				'<td><input type="text" class="form-control clone_datepicker" name="expiry_date" value=""  id="expiry_date" /></td>'+
				'<td><input type="text" class="form-control quantity" name="quantity" id="quantity" value="" /></td>'+
				'<td><input type="text"  class="form-control actual_quantity" id="actual_quantity" name="actual_quantity" value=""/>'+
						'<input type="hidden" name="cat_name"/><input type="hidden" name="commodity_id"  />' +
						'<input type="hidden" name="commodity_name_"  /><input type="hidden" class="total_commodity_units" name="total_commodity_units"/></td></tr></tbody></table>';
        //hcmp custom message dialog
    dialog_box(body_content,'<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>'+
        '<button type="button" class="btn btn-primary add_item"><span class="glyphicon glyphicon-plus"></span>Add</button>');
    $('#communication_dialog').on('hidden.bs.modal', function (e) {  $('.modal-dialog').removeClass("modal-lg");
    $('.modal-body').html(''); refreshDatePickers();	})    
   
    });  
     // add item modal box
   $(document.body).on('change','.desc', function (){
    var data= $('option:selected', this).attr('special_data');  
				var code_array=data.split("^");
				var commodity_id=code_array[0];
				$('input:text[name=commodity_code]').val(code_array[4]);
				$('input:text[name=commodity_id]').val(commodity_id);
				$('input:text[name=unit_size]').val(code_array[2]);
				$('input:text[name=unit_cost]').val(code_array[1]);
				$('input:hidden[name=cat_name]').val(code_array[3]);
				$('input:hidden[name=commodity_name_]').val($("#desc option:selected").text());
				$('input:hidden[name=total_commodity_units]').val(code_array[5]);
				calculate_totals();
				});
	// add the item to the order list			
	$(document.body).on("click",".add_item", function (){
	 var check_if_the_user_has_selected_a_commodity=$('#desc').val();
	 if(check_if_the_user_has_selected_a_commodity==0){
	 	alert("Please select a commodity first");
	 	return;
	 }	
	// add the items here to the order form
	  $("#main" ).dataTable().fnAddData( [
	  	 '<input type="hidden" class="commodity_name" name="commodity_name['+new_count+']" value="'+$("#desc option:selected").text()+'" />'+
          '<input type="hidden" class="commodity_code" name="commodity_code['+new_count+']" value="'+$('input:text[name=commodity_code]').val()+'" />'+
         '<input type="hidden" class="commodity_id" name="commodity_id['+new_count+']" value="'+$("#desc option:selected").val()+'" />'+
         '<input type="hidden" class="total_commodity_units" name="total_commodity_units['+new_count+']" value="'+$('input:hidden[name=total_commodity_units]').val()+'" />'+ 
         '<input type="hidden" class="unit_cost" name="unit_cost['+new_count+']" value="'+$('input:text[name=unit_cost]').val()+'" />'+
         '<input type="hidden" name="unit_size['+new_count+']" value="'+$('input:text[name=unit_size]').val()+'" />'+
							"" + $("#desc option:selected").text() + "" , 
							"" + $('input:text[name=commodity_code]').val() + "" ,
							"" + $('input:text[name=unit_size]').val() + "" ,
							"" + $('input:text[name=unit_cost]').val() + "" ,
						  '' +'<input class="form-control input-small" type="text" name="qty_pack['+new_count+']" value="0" readonly="yes"/>',
							'<input class="form-control input-small" type="text" name="qty_unit['+new_count+']"  value="0" readonly="yes"/>',
							'<input class="form-control input-small" type="text" name="price_bought['+new_count+']"  value="0" readonly="yes"/>',
							'<input class="form-control input-small" type="text" name="total_cost['+new_count+']"  value="0" readonly="yes"/>',
							'<input class="form-control input-small" type="text" name="batch_no['+new_count+']"  required="required" value="'+$('input:text[name=batch_no]').val()+'" />' ,
							'<input class="form-control input-small" type="text" name="manu['+new_count+']" required="required" value="'+$('input:text[name=manufacturer]').val()+'"   />' ,
							'<input class="form-control input-small clone_datepicker" type="text" name="expiry_date['+new_count+']" required="required" value="'+$('input:text[name=expiry_date]').val()+'"  />' ,
							'<input class="form-control input-small quantity" type="text" name="quantity['+new_count+']" required="required" value="'+$('input:text[name=quantity]').val()+'" />',
							'<input class="form-control input-small actual_quantity" type="text" name="actual_quantity['+new_count+']" value="'+$('input:text[name=actual_quantity]').val()+'" readonly="yes" />',
							'<input class="form-control input-small cost" type="text" name="cost['+new_count+']" value="'+parseInt($('input:text[name=unit_cost]').val().replace(",", ""))*$('input:text[name=quantity]').val()+'" readonly="yes" />'

		]); 
		new_count=new_count+1;
		$('#communication_dialog').modal('hide');	
		
	});
	//compute the order totals here
	$(document.body).on('keyup',".quantity" ,function (){
	var selector_object=$(this);
	var user_input=$(this).val();
	var total_units=$(this).closest("tr").find(".total_commodity_units").val();
	var unit_cost=$(this).closest("tr").find(".unit_cost").val();
	// check the user input value here
	var alert_message='';
			if (selector_object.val() <0) { alert_message+="<li>Order value must be above 0</li>";}
		    if (selector_object.val().indexOf('.') > -1) {alert_message+="<li>Decimals are not allowed.</li>";}		
			if (isNaN(selector_object.val())){alert_message+="<li>Enter only numbers</li>";}				
			if(isNaN(alert_message)){
	
	//reset the text field and the message dialog box 
    selector_object.val(""); var notification='<ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;';
    //hcmp custom message dialog
    dialog_box(notification,'<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
    //This event is fired immediately when the hide instance method has been called.
    $('#communication_dialog').on('hide.bs.modal', function (e) { selector_object.focus();	})
    
    $(this).closest("tr").find(".actual_quantity").val("");
    return;   } 
calculate_actual_stock (total_units, "Pack_Size",user_input,".actual_quantity",selector_object,null);
var total_cost=parseInt(unit_cost.replace(",", ""))*user_input;
$(this).closest("tr").find(".cost").val(total_cost);
get_the_data_from_the_form_to_save(selector_object);
calculate_totals();
	});
	
		$(".test").button().click( function (){
			var diff=parseInt($(".order_total").val())-parseInt($(".actual_order_total").val())
    var table_data='<div class="row" style="padding-left:2em"><div class="col-md-6">Order Summary</div></div>'+
    '<div class="row" style="padding-left:2em"><div class="col-md-6">Order Value (Ksh)</div><div class="col-md-6">'+number_format($(".order_total").val(), 2, '.', ',')+'</div></div>'+
    '<div class="row" style="padding-left:2em"><div class="col-md-6">Delivered Order Value (Ksh)</div><div class="col-md-6">'+number_format($(".actual_order_total").val(), 2, '.', ',')+'</div></div>'+
    '<div class="row" style="padding-left:2em"><div class="col-md-6">Difference (Ksh)</div><div class="col-md-6">'+number_format(diff, 2, '.', ',')+'</div></div>'+
    '<table class="table table-hover table-bordered table-update">'+
					"<thead><tr>"+
					"<th>Description</th>"+
					"<th>Commodity Code</th>"+
					"<th>Quantity Received</th>"+
					"<th>Unit Cost Ksh</th>"+
					"<th>Total Ksh</th></tr></thead><tbody>";	 	    			
         $("input[name^=cost]").each(function(i) { 
        table_data +="<tr>" +
							"<td>" +$(this).closest("tr").find(".commodity_name").val()+ "</td>" +
							"<td>" +$(this).closest("tr").find(".commodity_code").val()+ "</td>" +
							"<td>" +$(this).closest("tr").find(".quantity").val()+ "</td>" +	
							"<td>" +number_format($(this).closest("tr").find(".unit_cost").val(), 2, '.', ',')+ "</td>" +	
							"<td>" +number_format($(this).closest("tr").find(".cost").val(), 2, '.', ',')+ "</td>" +													
						"</tr>" 
                    });
         table_data +="</tbody></table>";
    //hcmp custom message dialog
    dialog_box(table_data,'<button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>'
    +'<button type="button" class="btn btn-primary" id="save_dem_order" data-dismiss="modal">Save</button>');
	});
      /************save the data here*******************/
     // validate the form
	 $("#myform").validate();
	$(document.body).on('click','#save_dem_order', function() {
     var order_total=$(".actual_order_total").val();
     var dispatch_date=$('#dispatch_date').val();
     var kemsa_order_no=$('#kemsa_order_no').val();
     var alert_message='';
     var checker=false;
     if (order_total==0) {alert_message+="<li>Sorry, cant submit an order value of zero</li>";}
     if (dispatch_date=='') {alert_message+="<li>Indicate the dispatch date of the order</li>"; checker=true}
     if (kemsa_order_no=='') {alert_message+="<li>Indicate kemsa order no</li>";checker=true}
     if(isNaN(alert_message)){
     if(checker){$("#updateord").slideToggle();}
     //This event is fired immediately when the hide instance method has been called.
    $('.actual_order_total').delay(500).queue(function (nxt){
    $(".show_hide").show();
    // Load up a new modal...
     dialog_box('fix this items before saving the order update <ol>'+alert_message+'</ol>&nbsp;&nbsp;&nbsp;&nbsp;',
     '<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>');
    	nxt();
    });
     }else{

    if($("#myform").valid()){
   	    $('.actual_order_total').delay(500).queue(function (nxt){
   	$("#myform").submit();
    // Load up a new modal...
    var img='<img src="<?php echo base_url('assets/img/wait.gif') ?>"/>';

     dialog_box(img+'<h5 style="display: inline-block; font-weight:500;font-size: 18px;padding-left: 2%;"> Please wait as the order is being processed</h5><span class="label label-danger"> Please DO NOT refresh the browser, First confirm if the stock levels have been updated</span>'
     ,
     '');
    	nxt();
    	
    });
   }

     	
     }
     });
     
    function calculate_totals(){
	var order_total=0;
	var balance=0
	 $("input[name^=quantity]").each(function() {

	 	if($(this).val()=='')
	 	{ var total=0} 
	 	else{ var total=$(this).val()
	 		}//calculate the balances here
	 	var unit_cost=$(this).closest("tr").find(".unit_cost").val();    	
        order_total=(parseInt(total)*parseInt(unit_cost.replace(",", "")))+parseInt(order_total); 
  
      $(this).closest("tr").find(".cost").val(parseInt(total)*parseInt(unit_cost.replace(",", "")));   
     });//check if order total is a NAN
     //set the balances here
     $(".actual_order_total").val(order_total);
		
	}
	function get_the_data_from_the_form_to_save(selector_object){
    var commodity_id=selector_object.closest("tr").find('.commodity_id').val();
    var order_details_id=selector_object.closest("tr").find('.order_details_id').val();
    var batch_no=selector_object.closest("tr").find('.batch_no').val();
    var manu=selector_object.closest("tr").find('.manu').val();
    var clone_datepicker=selector_object.closest("tr").find('.clone_datepicker').val();
    var quantity=selector_object.closest("tr").find('.quantity').val();
    var actual_quantity=selector_object.closest("tr").find('.actual_quantity').val();
    var data="commodity_id="+commodity_id+"&order_details_id="
        +order_details_id+" &batch_no="+batch_no+"&manu="+manu+"&clone_datepicker="+clone_datepicker
        +"&quantity="+quantity+"&actual_quantity="+actual_quantity;
    //return data;
    var url = "<?php echo base_url('orders/auto_save_order_detail')?>"; 
    if(order_details_id>0){
      ajax_simple_post_with_console_response(url, data);  
    }else{
      //do nothing  
    }     
    }
	}); 
</script>
