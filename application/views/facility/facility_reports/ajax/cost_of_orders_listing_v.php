<?php  $delivery_data="";
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
		?>

<table width="100%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="test4">
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


 
