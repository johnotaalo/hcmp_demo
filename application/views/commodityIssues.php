<?php

$from=$this -> session -> userdata('from');
$to=$this -> session -> userdata('to');
$desc=$this -> session -> userdata('desc');
$drugname=$this -> session -> userdata('drugname');
$facilityName=$this -> session -> userdata('full_name');


?>

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
	
	font-size: 13px;
	margin: 0px;
	border-bottom: 1px solid #000033;
	}
.col5{
	background:#C9C299;
	}
	.figures{
	width:30px;
	}
	.try{
		float: right;
		margin-bottom: 1px auto;
	}
	.whole_report{
	      
    position: relative;
  width: 88%;
  background: #F0FFFF;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 2em 1.5em;
  color: rgba(0,0,0, .8);
  
  line-height: 1.5;
  margin: 20px auto;
  -moz-box-shadow: 0 0 5px 5px #888;
-webkit-box-shadow: 0 0 5px 5px#888;
box-shadow: 0 0 5px 5px #888;
	}
	
</style>
<?php

echo form_open('Raw_data/get_commodityIpdf');
 
?>
<div class="whole_report">
	<div class="try">
<button class="button">Download PDF</button>
</div>
<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
       
       <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Public Health and Sanitation/Ministry of Medical Services</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">Commodity Issues Summary</h2>
      
       <h2 style="text-align:center;"><?php echo $facilityName ?></h2>
       <h2 style="text-align:center;">Between <?php echo $from ?> & <?php echo $to ?> </h2>
       
       	<hr/> 
        
        	
</div>

<table class="data-table1">
		
	<tr>
		<th>Kemsa Code</th>
		<th>Description</th>
		<th>Date</th>
		<th>Reference/S11 No</th>
		<th>Batch No</th>
		<th>Expiry Date</th>
		<th>Opening Bal</th>
		<th>Issues</th>
		<th>Closing Bal</th>
		
		<th>Issuing/Receiving Officer</th>
		<th>Service Point</th>
	</tr><tbody>
		
		<?php 
				foreach ($reports as $user ) { ?>
					
					<?php foreach($user->Code as $d){
							foreach ($user->stock_Drugs as $value) {
								
							$drugname=$value->Drug_Name;
								$code=$value->Kemsa_Code;
						 
								$fname=$d->fname;
								$lname=$d->lname;
								$thedate=$user->date_issued;
								$thedate1=$user->expiry_date;
								$formatme = new DateTime($thedate);
								$formatme1 = new DateTime($thedate1);
       							 $myvalue= $formatme->format('d M Y');
       						
								if ($thedate1 == '0000-00-00') {
									$myvalue1 = 'N/A';
								} else{
								$formatme1 = new DateTime($thedate1);       							 
       							$myvalue1= $formatme1->format('d M Y');
       							}
								?>
				
						<tr>
							<td> <?php echo $code;?> </td>
													
							<td> <?php echo $drugname ;?> </td>
							<td><?php echo $myvalue;?> </td>
							<td><?php echo $user->s11_No;?></td>
							<td> <?php echo $user->batch_no;?> </td>
							<td> <?php echo $myvalue1;?> </td>
							<td class="figures"><?php echo $user->balanceAsof+$user->qty_issued;?> </td>
							<td class="figures"><?php echo $user->qty_issued;?></td>
							<td class="figures"><?php echo $user->balanceAsof;?></td>
							
								
							<td><?php echo $lname.' '.$fname;?></td>
							<td> <?php echo $user->issued_to;?> </td>
							
						</tr>
					<?php }
							}?>		
		</tbody>
		
		<?php }
					?>	
	 
</table>

</div>
<input type="hidden" value="<?php echo $from ?>" id="datefromB" name="datefromB" />
<input type="hidden"  value="<?php echo $to ?>" id="datetoB" name="datetoB" />
<input type="hidden" value="<?php echo $facilityName ?>" id="facilitycode1" name="facilitycode1" />

<?php form_close();
?>