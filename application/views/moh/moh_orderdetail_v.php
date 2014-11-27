<script type="text/javascript" language="javascript" src="<?php echo base_url();  ?>Scripts/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/ZeroClipboard.js"></script>
<script type="text/javascript" charset="utf-8" src="<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/js/TableTools.js"></script>
		<style type="text/css" title="currentStyle">			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media2/css/jquery.dataTables.css";
			@import "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/css/TableTools.css";
		</style>	
<script type="text/javascript" charset="utf-8">
/******************************************data-table set up*********************/
/* Define two custom functions (asc and desc) for string sorting */
/* Define two custom functions (asc and desc) for string sorting */


	   $(document).ready(function() {

    	$('#main1').dataTable( {
    		        "bJQueryUI": true,
    		        "bSort": false,
					
                   "bPaginate": false,
                  "sDom": '<"H"Tfr>t<"F"ip>',
					"oTableTools": {
			"sSwfPath": "<?php echo base_url(); ?>DataTables-1.9.3/extras/TableTools-2.0.0/media/swf/copy_cvs_xls_pdf.swf"
		}
				} );
    
});
</script>
<?php
$table_body="";
$total_fill_rate=0;
$order_value =0;

 //  $dStart = new DateTime(date($dates["orderDate"]));
   //$dEnd  = new DateTime(date($dates["deliverDate"]));
   //$dDiff = $dStart->diff($dEnd);
  // echo $dDiff->format('%R'); // use for point out relation: smaller/greater
   //$date_diff= $dDiff->days;

   
$ts1 = strtotime(date($dates["orderDate"]));
$ts2 = strtotime(date($dates["deliverDate"]));

$seconds_diff = $ts2 - $ts1;

$date_diff= floor($seconds_diff/3600/24);

 $tester= count($detail_list);

      if($tester==0){
      	
      }
	  else{
	  	

      
		foreach($detail_list as $rows){
			//setting the values to display
			 $received=$rows->quantityRecieved;
			 $price=$rows->price;
			 $ordered=$rows->quantityOrdered;
			 $code=$rows->kemsa_code;
			 
			 $total=$price* $ordered;
			 
			 
			 
		     if($ordered==0){
				$ordered=1;
			}
		   
		 
		
		 foreach($rows->Code as $drug) {
		 	
			 $drug_name=$drug->Drug_Name;
			 $kemsa_code=$drug->Kemsa_Code;
			 $unit_size=$drug->Unit_Size;
			 $total_units=$drug->total_units;
			 
			foreach($drug->Category as $cat){
				
			$cat_name=$cat;		
			}	 
		}
		   $received=round($received/$total_units);
		    $fill_rate=round(($received/$ordered)*100);
	        $total_fill_rate=$total_fill_rate+$fill_rate;
			
		 switch ($fill_rate) {
		case $fill_rate==0:
		 $table_body .="<tr style=' background-color: #FBBBB9;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
		 $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
				 break;  	
				 
		 case $fill_rate<=60:
		 $table_body .="<tr style=' background-color: #FAF8CC;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
		 $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
				 break;  
				 
				 case $fill_rate==100.01 || $fill_rate>100.01:
		 $table_body .="<tr style=' background-color: #FBBBB9;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
		 $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
				 break;
				  
			 case $fill_rate==100:
		 $table_body .="<tr style=' background-color: #C3FDB8;'>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
		 $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
				 break;
				 
				 default :
		 $table_body .="<tr>";
		 $table_body .= "<td>$cat_name</td>";
	     $table_body .= '<td>'.$drug_name.'</td><td>'. $kemsa_code.'</td>'.'<td>'.$unit_size.'</td>';
		 $table_body .='<td>'. $price.'</td>';
		 $table_body .='<td>'.$ordered.'</td>';
		 $table_body .='<td>'.number_format($total, 2, '.', ',').'</td>';
		 $table_body .='<td>'.$received.'</td>';	
		 $table_body .='<td>'.$fill_rate .'% '.'</td>';
		 $table_body .='</tr>'; 
				 break;
			
		 }
		 
				  } 
	
	$order_value  = round(($total_fill_rate/count($detail_list)),0,PHP_ROUND_HALF_UP);
		} 

?>
<div>
<div id="notification" style="float: left; height: 5%"> Fill Rate = ( Quantity Received / Quantity Ordered ) * 100</div>
<div style="margin-left: 80%" style="float: right" >
<div class="activity pdf"><h2><a href="<?php echo site_url('report_management/get_order_details_report/'.$this->uri->segment(3).'/'.$this->uri->segment(4));?>">
 Download</h2></div>
</a>
</div>
</div>


<table id="main1" width="100%">
	<thead>
		<tr>
		<th colspan='9'>
         <p style="letter-spacing: 1px;font-weight: bold;text-shadow: 0 1px rgba(0, 0, 0, 0.1);font-size: 14px; " >Facility Order No <?php echo $this->uri->segment(3);?>| KEMSA Order No <?php echo $this->uri->segment(4);?> | Total Order FIll Rate <?php echo $order_value ."%";?>| Order lead Time <?php echo $date_diff;?> day(s)</p>
		</th>
		</tr>
		<tr>
		<th width="50px" style="background-color: #C3FDB8; "></th>
		<th>Full Delivery 100%</th>
		<th width="50px" style="background-color:#FFFFFF"></th>
		<th>Ok Delivery 60%-less than 100%</th>
		<th width="50px" style="background-color:#FAF8CC;"></th> 
		<th>Partial Delivery less than 60% </th>
		<th width="50px" style="background-color:#FBBBB9;"></th>
		<th>Problematic Delivery 0% or over 100%</th>
		<th></th>
		</tr>
		<tr>
		<th><strong>Category</strong></th>
		<th><strong>Description</strong></th>
		<th><strong>KEMSA&nbsp;Code</strong></th>
		<th><strong>Unit Size</strong></th>
		<th><strong>Unit Cost Ksh</strong></th>
		<th><strong>Quantity Ordered</strong></th>
		<th><strong>Total Cost</strong></th>
		<th><strong>Quantity Received</strong></th>
		<th><strong>Fill rate</strong></th>	
		</tr>
	</thead>
	<tbody>
	<?php
		echo $table_body;
	?>
	</tbody>
</table>
