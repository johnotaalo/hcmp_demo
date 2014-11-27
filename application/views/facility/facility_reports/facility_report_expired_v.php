<style>
table.data-table1 {
	border: 1px solid #000033;
	margin: 10px auto;
	border-spacing: 0px;
	}
	
table.data-table1 th {
	border: none;
	color:#036;
	text-align:center;
	font-size: 13.5px;
	border: 1px solid #000033;
	border-top: none;
	max-width: 600px;
	}
table.data-table1 td, table th {
	padding: 4px;
	}
table.data-table1 td {
	border: none;
	border-left: 1px solid #000033;
	border-right: 1px solid #000033;
	height: 30px;
	width: 130px;
	font-size: 12.5px;
	margin: 0px;
	border-bottom: 1px solid #000033;
	}
.col5{
	background:#C9C299;
	}
	.try{
		float: right;
		margin-bottom: 1px auto;
	}
	.whole_report{
	      
    position: relative;
  width: 88%;
  background: #FFFAF0;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 2em 1.5em;
  color: rgba(0,0,0, .8);
  
  line-height: 1.5;
  margin: 20px auto;
   box-shadow: 0px 0px 5px #ccc;
  -moz-box-shadow: 0px 0px 5px #ccc;
  -webkit-box-shadow: 0px 0px 5px #ccc;
	}
	
	.messages{
		background-color: #036;
width: auto;
height: 50px;
line-height: 50px;
color: white;
text-decoration: none;
font-size: 14px;
font-family: helvetica, arial;
font-weight: bold;
display: inline;
padding: 5px;

		 
		
	}

	
</style>
	<div class="whole_report">
<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
       <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Health</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;"><?php echo $facility_data['facility_name'].' MFL '.$facility_data['facility_code']?> Expired Commodities as of <?php 
					
					$today= ( date('d M, Y')); 
					echo $today;					
				?></h2>
       
       
      
       	<hr/> 
        
        	
</div>
<table class="data-table">
	
	<tr>
		<th>KEMSA Code</th>
		<th>Description</th>
		<th>Batch No Affected</th>
		<th>Manufacturer</th>
		<th>Expiry Date</th>
		<th>Unit size</th>
		<th>Stock Expired (Packs)</th>
		<th>Unit Cost</th>
		<th>Total Cost(KSH)</th>
	</tr>
	
			
		<tbody>
		
		<?php    $total=0;
				foreach ($expired as $drug ) { 
					
					
					?>
				
					
					<?php foreach($drug->Code as $d){
						        $total_units=$d->total_units ;
								$name=$d->Drug_Name;
								$code=$d->Kemsa_Code;
					            $unitS=$d->Unit_Size; 
								$unitC=$d->Unit_Cost;
								$calc=$drug->balance;
								$balance=round($calc/$total_units);
								$total_expired=$drug->total;
								$total=round($total+$total_expired,1);
								$thedate=$drug->expiry_date;
								$formatme = new DateTime($thedate);
								 $myvalue= $formatme->format('d M Y');
							
								?>
				
						<tr>
							
							<td><?php echo $code;?> </td>
							<td><?php echo $name;?></td>
							<td><?php echo $drug->batch_no;?> </td>
							<td><?php echo $drug->manufacture;?> </td>
							<td><?php echo $myvalue;?></td>
							<td><?php echo $unitS;?></td>
							<td><?php echo $balance;?></td>
							<td><?php echo $unitC;?></td>
							<td><?php echo number_format($total_expired, 2, '.', ',');?></td>
							
							
						</tr>
					<?php }
							?>	
		<?php }

					?>	
			<tr><td colspan="7" ></td><td><b>TOTAL (KSH) </b></td><td><b><?php echo number_format($total, 2, '.', ','); ?></b></td></tr>
		
	 </tbody>
</table>
</div>