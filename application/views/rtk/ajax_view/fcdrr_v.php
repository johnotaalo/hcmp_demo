<?php
	/*$current_year = date('Y');
	$current_month = date('F');
	$current_monthdigit = date('m');
	$facilityName = $this -> session -> userdata('full_name');
	$districtName = $this->session->userdata('full_name');
*/
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
     Ministry of Health</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">NHPLS/NASCOP</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">FACILITY CONSUMPTION DATA REPORT & REQUEST(F-CDRR) FOR ART LABORATORY MONITORING REAGENTS</h2>
       	<h2 style="text-align:center;"><?php //echo $districtName  District?></h2>
        <h2 style="text-align:center;"><?php //echo $current_month   $current_year; ?> </h2>
       
       <hr/> 
</div>

<table class="data-table1">
		
	<tr>
    <td colspan="2"><b>Name of Facility:</b></td>
    <td colspan="2"></td>
    <td><b>Facility Code:</b></td>
    <td colspan="2"></td>
    <td><b>District:</b></td>
    <td colspan="2"></td>
    <td colspan="2"><b>Province/County:</b></td>
    <td colspan="2"> </td>
  </tr>
  <tr>
    <td><b>Affilliation:</b></td>
    <td align="left" colspan="2"><b>Ministry of Health</b></td>
    <td colspan="2"></td>    
    <td><b>Local Authority</b></td>
    <td></td>
    <td><b>FBO</b></td>
    <td> </td>
    <td><b>NGO</b></td>
    <td> </td>
    <td colspan="2"><b>Private</b></td>
    <td></td>
  </tr>
  
  <tr>
    <td align="right" colspan="3"><b>REPORT FOR PERIOD:BEGINNING:</b></td>
    <td colspan="2"><div contenteditable></td>
    <td colspan="4" align="right"><div contenteditable><b>ENDING:<b></td>
    <td colspan="2"></td>
    <td colspan="3"></td>    
  </tr>
  
  <tr>
    <td colspan="3"></td>
    <td colspan="2" align="center"><i>dd/mm/yyyy</i></td>
    <td colspan="4"></td>
    <td colspan="2" align="center"><i>dd/mm/yyyy</i></td>
    <td colspan="3"></td>
       
  </tr>
  <tr>
    <th colspan="4" align="left"><b>State the number of CD4 Tests conducted:-</b></th>
    <td colspan="10"></td>
    
  </tr>
  <tr>
    <td colspan="6"><b>TOTAL NUMBER OF CD4 TESTS DONE DURING THE MONTH(REPORTING PERIOD):</b></td>
    <td colspan="8">&nbsp;</td>
    
  </tr>


<tr>		 <td rowspan="2"><b>COMMODITY CODE</b></td>
			<td rowspan="2"><b>COMMODITY NAME</b></td>
            <td rowspan="2"><b>UNIT OF ISSUE</b></td>
            <td rowspan="2"><b>BEGINNING BALANCE</b></td>
            <td colspan="2"><b>QUANTITY RECEIVED FROM CENTRAL<br/> WAREHOUSE (e.g. KEMSA)</b></td>
 
            <td colspan="2" rowspan=""><b>QUANTITY RECEIVED FROM OTHER SOURCE(S)</b></td>
             
            <td rowspan="2"><b>QUANTITY USED</b></td>
            <td rowspan="2"><b>LOSSES/WASTAGE</b></td>
            <td colspan="2"><b>ADJUSTMENTS<br/><i>Indicate if (+) or (-)</i></b></td>
            <td rowspan="2"><b>ENDING BALANCE <br/>PYSICAL COUNT at end of the Month</b></td>
            <td rowspan="2"><b>QUANTITY REQUESTED</b></td>
            </tr>
            
            
            <tr>
            <td>Quantity</td>
            <td>Lot No.</td>           
             <td>Quantity</td>
            <td>Lot No.</td>
            <td>Positive</td>
            <td>Negative</td>    
            </tr>
            
            
<tr><td colspan="14"><b>FACS Calibular Reagents and Consumables</b></td></tr>

<tr>
<td>CAL 002</td>
<td>Tri-TEST CD3/CD4/CD45 with TruCOUNT Tubes</td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr><td>CAL 003</td>
<td>Calibrite 3 Beads</td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CAL 005</td>
<td>FACS Lysing solution</td>
<td>ml</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CAL 006</td>
<td>Falcon Tubes</td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr>
<td>CAL 009</td>
<td>Printing Paper</td>
<td>1 ream</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
</tr>

<tr><td>CAL 010</td>
<td>Printer Catridge</td>
<td>1</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td colspan="14"><b>FACS Count Reagents and Consumables</b></td></tr>

<tr><td>FACS 001</td>
<td>FACSCount CD4/CD3 Reagent <b>[Adult]</b></td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>FACS 002</td>
<td>FACSCount CD4 % Reagent <b>[Paediatric]</b></td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>FACS 003</td>
<td>FACSC Control kit</td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>FACS 004</td>
<td>Thermal Paper FacsCount</td>
<td>1 roll</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td colspan="14"><b>Cyflow Partec |Reagents and Consumables</b></td></tr>

<tr><td>PART 001</td>
<td>EASY Count CD4/CD3 Reagent <b>[Adult]</b></td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>PART 002</td>
<td>EASY Count CD4 % Reagent <b>[Paediatric]</b></td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>PART 003</td>
<td>Control check beads></td>
<td>test</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>PART 004</td>
<td>Thermal Paper</td>
<td>1 roll</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td colspan="14"><b>Common Reagents/Consumables</b></td></tr>

<tr><td>CON 001</td>
<td>Sheath fluid</td>
<td>20L</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 002</td>
<td>Cleaning fluid</td>
<td>5L</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 003</td>
<td>Rinse fluid</td>
<td>5L</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 005</td>
<td>Yellow Pipette Tips (5L)</td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 006</td>
<td>Blue Pipette Tips (1000L) <b>[FACSCalibur]</b></td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 008</td>
<td>CD4 Stabilizer tubes 5ml</td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 009</td>
<td>EDTA Microtainer tubes <b>[Paediatric]</b></td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 010</td>
<td>EDTA Vacutainer tubes 4ml</td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr>

<tr><td>CON 011</td>
<td>Red top/Plain/Silica Vacutainer tubes 4ml</td>
<td>pcs</td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td>
<td></td></tr><tbody>


</div>

<?php form_close();?>