<?php
	$current_year = date('Y');
	$current_month = date('F');
	$current_monthdigit = date('m');
	$facilityName = $this -> session -> userdata('full_name');
	$districtName = $this->session->userdata('full_name');

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
	font-size: 11px;
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
	font-size: 10.5px;
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
  -webkit-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   -moz-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   box-shadow: 0px 0px 10px rgba(0,0,0,.8);	
	}
	
</style>

	<div class="whole_report" width = "992px">
		<div class="try">
			<table>
			<tr>
				<td><a href="<?php echo site_url('report_management/get_malaria_report_pdf/excel');?>">
				<div><button class="button">Download Excel Sheet</button></div></a>
				</td>
				<td><a href="<?php echo site_url('report_management/get_malaria_report_pdf/pdf');?>">
				<div><button class="button">Download PDF</button></div></a>
				</td>
			</tr>
				</table>
		</div>
	<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
       
       <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Public Health and Sanitation/Ministry of Medical Services</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">Monthly Summary Report for the Division of Malaria Control</h2>
       	<h2 style="text-align:center;"><?php echo $districtName ?> District</h2>
        <h2 style="text-align:center;"><?php echo $current_month ?> <?php echo $current_year ?> </h2>
       
       <hr/> 
</div>

<table class="data-table1">
		
	<tr>
		<th>Data Element</th>
		<th>Beginning Balance</th>
		<th>Quantity Received this Period</th>
		<th>Total Quantity Dispensed</th>
		<th>Losses (Excluding Expiries)</th>
		<th>Positive Adjustments</th>
		<th>Negative Adjustments</th>
		<th>Physical Count</th>
		<th>Quantity of Expired Drugs</th>
		<th>Medicines with 6 Months to Expiry</th>
		<th>Days Out of Stock</th>
		<th>Total</th>
	</tr><tbody>
	<!--Continue with Data Input from Database-->
<?php 
$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("SELECT f.facility_code,  f.kemsa_code,  d.id,  d.drug_name,  f.cycle_date, f.opening_balance, f.total_receipts, f.total_issues, f.closing_stock, f.days_out_of_stock, f.adj, f.losses
FROM  facility_transaction_table f
INNER JOIN  drug d ON d.id =  f.kemsa_code
WHERE d.drug_name LIKE  '%Artemether%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
OR d.drug_name LIKE  '%Quinine%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
OR d.drug_name LIKE  '%Artesunate%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
OR d.drug_name LIKE  '%Sulfadoxine%'
AND f.cycle_date LIKE '%$current_year-$current_monthdigit%'
ORDER BY  d.drug_name ASC"); 
$numrows = count($query);
if ($numrows>0){
for ($got = 0; $got<$numrows; $got++){
$unitCost = 0.00;
	$drugID = $query[$got]['kemsa_code'];
	switch($drugID){
		case '41':
		$unitCost = 575.00;
		break;
		case '58':
		$unitCost = 1534.5;
		break;
		case '25':
		$unitCost = 4444.00;
		break;
		case '1':
		case '2':
		case '3':
		case '4':
		$unitCost = 0.01;
		break;
	}
	$dataElement = $query[$got]['drug_name'];
	$bBalance = $query[$got]['opening_balance']*$unitCost;
	$qReceived = $query[$got]['total_receipts']*$unitCost;
	$qDispensed = $query[$got]['total_issues']*$unitCost;
	$losses = $query[$got]['losses']*$unitCost;
	$posAdjustments = $query[$got]['adj']*$unitCost;
	$negAdjustments = 0*$unitCost;
	$physicalCount = $query[$got]['closing_stock']*$unitCost;
	$quantityOfExp = 0*$unitCost;
	$medsAboutToExp = 0*$unitCost;
	$daysOutOfStock = 0;
	$total = 0*$unitCost;
    ?>
							
<tr>
<td> <?php echo $dataElement;?> </td>
<td> <?php echo $bBalance;?> </td>
<td> <?php echo $qReceived;?> </td>
<td> <?php echo $qDispensed;?> </td>
<td> <?php echo $losses;?> </td>
<td> <?php echo $posAdjustments?> </td>
<td> <?php echo $negAdjustments;?> </td>
<td> <?php echo $physicalCount;?> </td>
<td> <?php echo $medsAboutToExp;?> </td>
<td> <?php echo $quantityOfExp;?> </td>
<td> <?php echo $daysOutOfStock;?> </td>
<td> <?php echo $total;?> </td>
</tr>				

<?php }}
?>	
</tbody>
	

</table>
</div>

<?php form_close();?>