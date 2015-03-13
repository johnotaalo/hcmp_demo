<?php   $identifier = $this -> session -> userdata('user_indicator');
				
		$rejected_data='';
		$delivery_data='';
		$pending_data='';
		$approved_data='';
				
		foreach($delivered as $delivered_details):			
			$order_id= $delivered_details['id'];                       
            $mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl);	
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$delivered_details['id'].'/'.$mfl);
			$link2=base_url().'reports/order_delivery/'.$delivered_details['id'];//view the order
			$link3=base_url().'reports/download_order_delivery/'.$delivered_details['id'];			
		    $delivery_data .= <<<HTML_DATA
           <tr>           
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>
           <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>
           <a href='$link_excel' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
           
           <a href='$link3' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Report</button></a>
           </tr>
HTML_DATA;
			
			endforeach;		
			$pending_button_text=($identifier==='district')? "Approve Order": "Edit Order";	
			foreach($pending as $delivered_details):			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl);
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$delivered_details['id'].'/'.$mfl);	
			$link2=base_url('orders/update_facility_order/'.$delivered_details['id']);			
		    $pending_data .= <<<HTML_DATA
            <tr>       
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>          
           <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>
            <a href='$link_excel' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
           <a href='$link2' ><button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span>$pending_button_text</button></a>
           <a id="$delivered_details[id]" href="#"class="delete"> 
		<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>Delete</button></a></td>
           </tr>
HTML_DATA;
			
			endforeach;
			
			foreach($rejected as $delivered_details):			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl);
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$delivered_details['id'].'/'.$mfl);	
			$link2=base_url('orders/update_facility_order/'.$delivered_details['id']."/rejected");
		    $rejected_data .= <<<HTML_DATA
            <tr>        
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>          
          <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a>      
              <a href='$link2' ><button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-pencil"></span>Edit Order</button></a>
               <a href='$link_excel' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>
              <a id="$delivered_details[id]" href="#"class="delete"> 
		<button type="button" class="btn btn-xs btn-danger"><span class="glyphicon glyphicon-remove-circle"></span>Delete</button></a></td>
           </tr>
HTML_DATA;
			endforeach;
				foreach($approved as $delivered_details):			
			$order_id= $delivered_details['id'];                       
$mfl=$delivered_details['facility_code'];
			$name=$delivered_details['facility_name'];
			$order_date=$delivered_details['order_date'];
			$district=$delivered_details['district'];
			$year=$delivered_details['mwaka'];
			$order_total=$delivered_details['order_total'];
			$order_total=number_format($order_total, 2, '.', ',');
	        $aggregate_data=($identifier==='district')? "<td><input type='checkbox' name='delete' value='$order_id' /></td>": null;
			$link=base_url('orders/get_facility_sorf/'.$delivered_details['id'].'/'.$mfl); 
			$link_excel=base_url('reports/create_excel_facility_order_template/'.$delivered_details['id'].'/'.$mfl);
			$link2=base_url('orders/update_facility_order/'.$delivered_details['id']."/0/readonly");
			$link3=base_url('orders/update_order_delivery/'.$delivered_details['id']);	
			$view_data=($identifier==='facility' ||$identifier==='facility_admin')? '<a href="'.$link3.'">
            <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span>Update Order</button></a>':'<a href="'.$link2.'">
            <button type="button" class="btn btn-xs btn-success"><span class="glyphicon glyphicon-zoom-in"></span>View Order</button></a>';		
		    $approved_data .= <<<HTML_DATA
            <tr>
           
	<td>$order_id</td>          
 <td>$district</td>
           <td>$name</td>
           <td>$mfl</td>
           <td>$year</td>
           <td>$order_total</td>
           <td><a href='$link' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order pdf</button></a> 
           <a href='$link_excel' target="_blank">
           <button  type="button" class="btn btn-xs btn-primary">
           <span class="glyphicon glyphicon-save"></span>Download Order excel</button></a>        
            $view_data
           </td>
           $aggregate_data
           </tr>
HTML_DATA;
			
			endforeach;
		$rejected_orders=0;
		$pending_orders=0;
		$approved_orders=0;
		$delivered_orders=0;
	//	foreach ($order_counts as $item) {
		    $rejected_orders=(array_key_exists('rejected', $order_counts) && $order_counts['rejected']>0)? $order_counts['rejected']: 0;
			$pending_orders=(array_key_exists('pending', $order_counts) && $order_counts['pending']>0)? $order_counts['pending']: 0;
			$approved_orders=(array_key_exists('approved', $order_counts) && $order_counts['approved']>0)? $order_counts['approved']: 0;
			$delivered_orders=(array_key_exists('delivered', $order_counts) && $order_counts['delivered']>0)? $order_counts['delivered']: 0;

		//} 
		?>
<div class="row container" style="width: 100%; margin: auto; padding: 0">
<div class="col-md-2" style="border: 1px solid #DDD; padding: 0">
<div style= "overflow-y: auto;">
	<legend>
		Summary
		</legend>

<table class="row-fluid table table-hover table-bordered table-update">
 <tr><td>Rejected Orders</td><td><?php echo $rejected_orders; ?></td></tr>
		<tr><td>Pending Approval</td><td><?php echo $pending_orders; ?></td></tr>
		<tr><td>Pending Delivery</td><td><?php echo $approved_orders; ?></td></tr>
		<tr><td>Delivered</td><td><?php echo $delivered_orders; ?></td></tr>
</table>
<hr />
<div class="">
<button class="btn btn-success btn-xs floppy-save"><span class="glyphicon glyphicon-floppy-save"></span>Download KEMSA template</button>
<?php  if($identifier==='district'): ?>
<button class="btn btn-success btn-xs order-for-excel" >
 <span class="glyphicon glyphicon-floppy-open"></span>Order For Facilities via excel</button>
<button class="btn btn-success btn-xs order-for" >
 <span class="glyphicon glyphicon-floppy-open"></span>Order For Facilities online</button>
<?php  endif; ?>

</div>
</div>
 </div>
<div class="col-md-10" style="border: 1px solid #DDD;">
	   
	<ul class='nav nav-tabs'>
      <li class="active"><a href="#Rejected" data-toggle="tab">Rejected Orders</a></li>
      <li class=""><a href="#Approval" data-toggle="tab">Pending Approval</a></li>
      <li class=""><a href="#Delivery" data-toggle="tab">Pending Delivery</a></li>
      <li class=""><a href="#Delivered" data-toggle="tab">Delivered</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
      <div  id="Rejected" class="tab-pane fade active in">
 <table cellpadding="0" cellspacing="0" width="100%" border="0" 
 class="row-fluid table table-hover table-bordered table-update"  id="test1">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $rejected_data; ?>
</tbody>
</table> 
      </div>
      <div  id="Approval" class="tab-pane fade">
        <table width="80%" border="0" 
        class="row-fluid table table-hover table-bordered table-update"  id="test2">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $pending_data; ?>
</tbody>
</table> 
      </div>
      <div class="tab-pane fade" id="Delivery">
       <table width="100%" border="0" 
       class="row-fluid table table-hover table-bordered table-update"  id="test3">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
			<?php echo ($identifier==='district')? "<th>Aggregate</th>": null;   ?>
		</tr>
	</thead>
	<tbody>
		<?php echo $approved_data; ?>
</tbody>
</table> 
<?php if($identifier==='district'): ?>
<hr />
<div class="container-fluid">
<div style="float: right">
<button class="btn btn-success aggregate-orders" style="margin-right: -30px"><span class="glyphicon glyphicon-th-list"></span>Aggregate Orders</button></div>
</div>
<?php endif; ?>

      </div>
      <div class="tab-pane fade" id="Delivered">
        <table cellpadding="0" cellspacing="0" width="100%" border="0" 
        class="row-fluid table table-bordered"  id="test4">
	<thead>
		<tr>
			<th>HCMP Order No.</th>
			<th>Subcounty</th>
			<th>Health Facility</th>
			<th>MLF No.</th>
			<th>Year</th>
			<th>Order Value (KSH)</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php echo $delivery_data; ?>
</tbody>
</table> 
      </div>
    </div>
 	

  </div>
  </div>
<script>
/* Table initialisation */
$(document).ready(function() {
	/*
	 	//datatables settings 
	$("#test1").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
	     
                  "bJQueryUI": true,
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test2").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                  "bJQueryUI": true,
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test3").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                  "bJQueryUI": true,
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );
		$("#test4").dataTable( {
	     "sDom": "T lfrtip",
	     "sScrollY": "377px",
                  "bJQueryUI": true,
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page"
                    },
			      "oTableTools": {
			      	"sSwfPath": "<?php echo base_url('assets/datatable/media/swf/copy_csv_xls_pdf.swf'); ?>",
                 "aButtons": [
				"copy",
				"print",
				{
					"sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
				}
			],
		
		},
		
	} );

	$('.dataTables_filter label input').addClass('form-control');
	$('.dataTables_length label select').addClass('form-control');*/
    $(".floppy-save").on('click', function(){
    	 window.location="<?php echo site_url('reports/force_file_download')."/?url=print_docs/excel/excel_template/KEMSA Customer Order Form.xlsx"?>";	
    })
    $( "#myTabContent_" ).tabs();
	$(".order-for").on('click', function() {
	var body_content='<select id="facility_code" name="facility_code" class="form-control"><option value="0">--Select Facility Name--</option>'+
                    '<?php	foreach($facilities as $facility):
						     $facility_code=$facility['facility_code'];
							 $facility_name=$facility['facility_name']; ?>'+					
						'<option <?php echo 'value="'.$facility_code.'">'.preg_replace("/[^A-Za-z0-9 ]/", "",$facility_name) ;?></option><?php endforeach;?>';
   //hcmp custom message dialog
    dialog_box(body_content,
    '<button type="button" class="btn btn-primary order_for_them" >Order For Them</button>'
    +'<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>'); 
    $(".order_for_them").on('click', function() {
    var facility_code=$('#facility_code').val();
    if(facility_code==0){
    alert("Please select a Facility First");
    	
    }else{
     window.location="<?php echo site_url('orders/facility_order_');?>/"+facility_code;		
    }
   	
    });
		
	});
	$(".order-for-excel").on('click', function() {
	var body_content='<?php  $att=array("name"=>'myform','id'=>'myform'); 
	echo form_open_multipart('orders/facility_order_',$att)?>'+
'<input type="file" name="file" id="file" required="required" class="form-control"><br>'+
'<input type="submit" name="submit"  value="Upload">'+
'</form>';
   //hcmp custom message dialog
    dialog_box(body_content,
    ''); 		
	});
	$(".delete").on('click', function() {
	id= $(this).attr("id");
		 //hcmp custom message dialog
    dialog_box("The order will be deleted and cannot be recovered!. Are you sure?",
    '<button type="button" class="btn btn-danger delete-dem-order" data-dismiss="modal">Delete</button>'
    +'<button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>');    
    $(".delete-dem-order").on('click', function() {
    window.location="<?php     $for=$identifier=='district'? 'subcounty': (($identifier=='facility'||$identifier=='facility_admin')? 'facility':'county'); 
     echo site_url("orders/delete_facility_order/$for");?>/"+id;	
    });
	});	
	$(".aggregate-orders").on('click', function() {
	var addition="";
	var url="<?php echo base_url("reports/aggragate_order_new_sorf");?>/";
	var aggragate=false;
	$("input[type=checkbox]").each(function(index, element){
     if(element.checked){
     aggragate=true; //if an order has been selected set it to true 
     addition +=$(this).val()+"_";
     } 
     });
     if(aggragate){ //check 
     window.open(url+addition,'_blank');
     }else{
     //hcmp custom message dialog
    dialog_box("First Select orders you want to aggragate",
    '<button type="button" class="btn btn-primary" data-dismiss="modal">OK</button>');	
     }
     
	});

} );
</script>