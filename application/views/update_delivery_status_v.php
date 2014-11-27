<?php
$use_id=$this -> session -> userdata('news');
?>


<script>
	json_obj = {
				"url" : "<?php echo base_url().'Images/calendar.gif';?>",
				};
	var baseUrl=json_obj.url;
	
	$(function() {
		$("#accordion").accordion({
			autoHeight : false,
			collapsible: true,
			active: false
		});
		$( "#datepicker" ).datepicker({
			showOn: "button",
			dateFormat: 'd M yy', 
			buttonImage: baseUrl,
			buttonImageOnly: true
		});
		$( "#Update-Order" )
			.button()
			.click(function() {
				 var name= $('input:text[name=r_name]').val();
				  var phone= $('input:text[name=r_phone]').val();
				   var pin= $('input:text[name=r_pin]').val();
				   
				   
				    $('#myform').submit();
				
});
      
	});
</script>
<style>
	td {
		padding: 5px;
	}
</style>

<style>
	td {
		padding: 5px;
	}
	form {
    font-family: helvetica, arial, sans-serif;
    font-size: 11px;
}

form div{
    margin-bottom:10px;
}

form a {
    font-size: 12px;
    padding: 4px 10px;
    border: 1px solid #444444;
    background: #555555;
    color:#f7f7f7;
    text-decoration:none;
    vertical-align: middle;
}

form a:hover{
    color:#ffffff;
    background:#111111;   
}

#multi label {
    margin-left:20px;
    margin-right:5px;
    font-size:12px;
    background:#f7f7f7;
    padding: 4px 10px;
    border:1px solid #cccccc;
    vertical-align: middle;
}

#multi input[type="text"]{
    height:22px;
    padding-left:10px;
    padding-right:10px;
    border:1px solid #cccccc;
    vertical-align: middle;
}

#multi input[type="submit"]{
    margin-left:20px;
    border:none;
    background:#222222;
    outline:none;
    color:#ffffff;
    padding: 4px 10px;
    font-size:12px;
}


</style>
<?php 
$att=array("id"=>"myform","name"=>"myform");
echo form_open('stock/index',$att);?>
<?php echo form_hidden('kemsa_order_no', $batch_no[2]);?>
<?php echo form_hidden('order_dispatched', $batch_no[4]);?>
	<table style="margin: 5px auto; border: 2px solid #036; font-size:14px;">
		<tr>
			<td><input type="hidden" name="ord_no" value="<?php echo $batch_no[2];?>"/><b>Order Number:</b></td><td><?php echo $batch_no[2];?> </td>
			<td><b>Total Value:</b></td><td> <?php echo $batch_no[1];?> </td>
			<td><b>Order Made on: </b></td>
			<td> <?php $date1=new DateTime($batch_no[3]);echo $date1->format(' d M Y');?> </td>
			<td><b>Order Dispatched on: </b></td>
			<td> <?php $date2=new DateTime($batch_no[4]);echo $date2->format('d M Y');?> </td>
			
		</tr>
	</table>
	<div style="width: 700px; margin-left: 20%;">  
	<table style="float: left;">
		<tr>
			<?php 
					$today= ( date('d M, Y'));								
				?>
			<td><label for="delivery_date">Delivery Date</label></td>
			<td>
			<input name="deliver_date" type="text" value="<?php echo $today;?>" id="datepicker"/>
			</td>
		</tr>
		<tr>
			<td><label for="commodity_batch">Delivery Note Number</label></td>
			<td>
			<input name="batch" type="text" value="">
			</td>
		</tr>
			
		<tr>
			<td><label style="visibility:hidden"><input type="text"/></label></td>
			<td>
			<label><input type="hidden" name="facility_a" value="<?php echo $use_id?>" /></label>
			</td>
		</tr>
	</table>
	
	<table style="float:right;">
		<tr>
			<td><label for="name">Your Name</label></td>
			<td>
			<input name="r_name" type="text" value="<?php echo $this -> session -> userdata('names').$this -> session -> userdata('inames');?>"  />
			</td>
		</tr>
		<tr>
			<td><label for="phone">Phone No</label></td>
			<td>
			<input name="r_phone" type="text" id="r_phone" />
			</td>
		</tr>
		<tr>
			<td><label for="pin">ID No</label></td>
			<td>
			<input name="r_pin" type="text" value="" id="r_pin"/>
			</td>
		</tr>
		

	</table>
	
	</div>
	<table class="data-table">
	<tr>
		<th>KEMSA Code</th>
		<th>Description</th>
		<th>Batch No</th>
		
		<th>Expiry Date</th>
		<th>Ordered Quantities</th>
		<th>Quantity Dispatched</th>
		<th>Quantity Received</th>
	</tr>
	
		<?php
		
		foreach($dispatch_ord as $rows1):?>
			<tr>
				<input type="hidden" name="manufacture[]" value="<?php echo $rows1->manufacture?>" />
				<input type="hidden" name="expiry[]" value="<?php echo $rows1->expiry_date?>" />
				<input type="hidden" name="batch[]" value="<?php echo $rows1->batch_no?>" />
				<td><input type="hidden" name="kemsa[]" value="<?php echo $rows1->kemsa_code?>" /><?php echo $rows1->kemsa_code?></td>
				<td><?php foreach($rows1->Code as $drug){echo $drug->Drug_Name;}?></td>
				<td><?php echo $rows1->batch_no?></td>
				<td><?php 
		$datea= $rows1->expiry_date;
		$fechaa = new DateTime($datea);
        $datea= $fechaa->format(' d M Y');
		echo $datea;?></td>
				<td><?php echo $rows1->quantityOrdered?></td>
				<td><?php echo $rows1->quantity?></td>
				<td><input type="text" name="ordered[]" /></td>
				 </tr>
			
		<?php endforeach;
		?>
		</table>
		<input type="submit" class="button" id="Update-Order"  value="Update" style="margin-left: 20%" >
		<?php echo form_close();?>
		
		