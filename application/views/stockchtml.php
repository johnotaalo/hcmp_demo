<?php

$from=$this -> session -> userdata('from');
$to=$this -> session -> userdata('to');
$desc=$this -> session -> userdata('desc');
$drugname=$this -> session -> userdata('drugname');
$facility_Code=$this -> session -> userdata('news');


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
	max-width: auto;
	}
table.data-table1 td, table th {
	padding: 4px;
	}
table.data-table1 td {
	border: none;
	border-left: 1px solid #000033;
	border-right: 1px solid #000033;
	height: 30px;
	width: auto;
	margin: 0px;
	font-size: 12.5px;
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
  width: 95%;
  background: #FFCCFF;
  -moz-border-radius: 4px;
  border-radius: 4px;
  padding: 2em 1.5em;
  color: rgba(0,0,0, .8);
  
  line-height: 1.5;
  margin: 20px auto;
  -webkit-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   -moz-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   box-shadow: 0px 0px 10px rgba(0,0,0,.8);	
	}
	
</style>
<?php

echo form_open('Raw_data/get_stockcontrolpdf');
 
?>
<div class="whole_report">
	<div class="try">
<button class="awesome rosy">Download PDF</button>
</div>
<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
       
       <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Health</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">Stock Control Card</h2>
       <h2 style="text-align:center;"><?php echo $drugname ?>(<?php echo $desc?>)</h2>
       <h2 style="text-align:center;">Between <?php echo date('d M y',strtotime($from)) ?> & <?php echo date( 'd M y', strtotime($to))?> </h2>
       </br>
       	<hr/> 
        
        	
</div>

<table class="data-table1">
		
	<tr>
		<th>Date of Issue</th>
		<th>Reference No/S11 No</th>
		<th>Batch No</th>
		<th>Expiry Date</th>
		<th>Receipts/Opening Bal.</th>
		<th>ADJ</th>
		<th>Issues</th>
		<th>Closing Bal.</th>
		<th>Issuing/Receiving Officer</th>
		<th>Service Point</th>
	</tr><tbody>
		
		<?php 
				foreach ($report as $user ) { ?>
					
					<?php foreach($user->Code as $d){
						        $qty_receipts=0; 
								$fname=$d->fname;
								$lname=$d->lname;
								$thedate=$user->date_issued;
								$qty_receipts=$user->receipts;
								$adj=0;
								$closing_bal=$user->balanceAsof-$user->qty_issued;

								if($user->s11_No=='(+ve Adj) Stock Addition'){
								$adj=$user ->receipts;
								$closing_bal=$user->balanceAsof+$adj;
								}
								
								if($user->s11_No=='(-ve Adj) Stock Deduction' || $user->s11_No=='(Loss) Expiry'){
								$adj=$user->receipts;
								$closing_bal=$user->balanceAsof+$adj;
								}
								
								$thedate1=$user->expiry_date;
								$formatme = new DateTime($thedate);
								$myvalue= $formatme->format('d M Y');

								if ($thedate1 == '0000-00-00') {
									$myvalue1 = 'N/A';
								} else{
								$formatme1 = new DateTime($thedate1);       							 
       							$myvalue1= $formatme1->format('d M Y');
       							}
								?>
				
						<tr>
							<?php if ($user->s11_No == 'Physical Stock Count') {?>


							
							<td><font color = 'red'><?php echo $myvalue;?></font></td>
							<td><font color = 'red'><?php echo $user->s11_No;?></font></td>
							<td><font color = 'red'><?php echo $user->batch_no;?></font></td>
							<td><font color = 'red'><?php echo $myvalue1;?></font></td>
							<td><font color = 'red'><?php echo $user->balanceAsof;?></font></td>
							<td><font color = 'red'><?php echo $adj;?></font></td>
							<td><font color = 'red'><?php echo $user->qty_issued;?></font></td>
							<td><font color = 'red'><?php echo $closing_bal;?></font></td>								
							<td><font color = 'red'><?php echo $lname.' '.$fname;?></font></td>
							<td><font color = 'red'> <?php echo $user->issued_to;?></font></td>
							<?php }

							else { ?>
							<td><?php echo $myvalue;?> </td>
							<td><?php echo $user->s11_No;?></td>
							<td><?php echo $user->batch_no;?> </td>
							<td><?php echo $myvalue1;?> </td>
							<td><?php echo $user->balanceAsof;?> </td>
							<td><?php echo $adj;?></td>
							<td><?php echo $user->qty_issued;?></td>
							<td><?php echo $closing_bal;?></td>									
							<td><?php echo $lname.' '.$fname;?></td>
							<td> <?php echo $user->issued_to;?> </td>
							<?php } ?>

						</tr>
					<?php }
							?>		
		</tbody>
		
		<?php }
					?>	
	 
</table>

</div>
<input type="hidden" value="<?php echo $from ?>" id="datefromStockC" name="datefromStockC" />
<input type="hidden"  value="<?php echo $to ?>" id="datetoStockC" name="datetoStockC" />
<input type="hidden" value="<?php echo $desc ?>" id="desc" name="desc" />
<input type="hidden" value="<?php echo $drugname ?>" id="drugname" name="drugname" />
<input type="hidden" value="<?php echo $facility_Code ?>" id="facilitycode" name="facilitycode" />



<?php form_close();
?>