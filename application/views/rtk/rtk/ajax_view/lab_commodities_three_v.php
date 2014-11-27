<?php 
/*$current_year = date('Y');
$current_month = date('F');
$district_code = $this->session->userdata('district1');
$district_name_array=Districts::get_district_name($district_code)->toArray();
$district_name=$district_name_array['district'];
$facility_code=$this -> session -> userdata('news');
$facility_name_array=Facilities::get_facility_name($facility_code)->toArray();
$facility_name=$facility_name_array['facility_name'];*/
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
  width: 100%;
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
				<td><a href="<?php echo site_url('report_management/Contraceptives_Consumption_pdf/excel');?>">
				<div><button class="button">Download Excel Sheet</button></div></a>
				</td>
				<td><a href="<?php echo site_url('report_management/Contraceptives_Consumption_pdf/pdf');?>">
				<div><button class="button">Download PDF</button></div></a>
				</td>
			</tr>
			</table>
		</div>
	<div>
	<img src="<?php echo base_url().'Images/coat_of_arms.png'?>" style="position:absolute;  width:90px; width:90px; top:0px; left:0px; margin-bottom:-100px;margin-right:-100px;"></img>
   
          <span style="margin-left:100px;  font-family: arial,helvetica,clean,sans-serif;display: block; font-weight: bold; font-size: 15px;">
     Ministry of Health</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">Facility Consumption Data Report and Request (F-CDRR) For Laboratory Commodities 3</h2>
              
       <hr/> 
</div>

<table class="data-table1">
		
	<tr > 		
						<th colspan = "4" style = "text-align:left"><b>Name of Facility:</b></th>
						<th rowspan = "2" colspan = "1"></th>
						<th colspan = "2" style = "text-align:left"><b>Facility Code:</b></th>	
						<th rowspan = "4" colspan = "2"></th>
						<th colspan = "4"></th>	
						<th rowspan = "19" colspan = "1"></th>		
						
										    
					</tr>
<tr > 		
						<th colspan = "4" style = "color:#000"><b><?php //echo $facility_name; ?></b></th>				
						<th colspan = "2" style = "color:#000"><b><?php //echo $facility_code; ?></b></th>
						<th colspan = "2"><b>Type of Service</b></th>
						<th colspan = "2"><b>No. of Tests Done</b></th>
									    
					</tr>
<tr > 		
						<th colspan = "3" style = "text-align:left"><b>District:</b></th>
						<th rowspan = "2" colspan = "2"><b></b></th>
						<th colspan = "2" style = "text-align:left"><b>Province/County:</b></th>
						<th colspan = "4"><b>Applicable to HIV Test Kits Only</b></th>
						</tr>
<tr > 		
						<th colspan = "3" style = "color:#000"><b><?php //echo $district_name; ?> District</b></th>
						<th colspan = "2"><b></b></th>
						<th colspan = "2"><b>VCT</b></th>
						<th colspan = "2"><b></b></th>
						</tr>
<tr > 		
						<th colspan = "9"><b></b></th>
						<th colspan = "2"><b>PITC</b></th>
						<th colspan = "2"><b></b></th>
					</tr>
<tr > 		
						<th colspan = "2"><b>Affiliation:</b></th>
						<th colspan = "1"><b>Ministry of Health</b></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "1"><b>Local Authority</b></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "1"><b>FBO</b></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "1"><b></b></th>				
						<th colspan = "2"><b>PMTCT</b></th>
						<th colspan = "2"><b></b></th>
						</tr>
<tr > 		
						<th colspan = "2"><b></b></th>
						<th colspan = "1"><b>NGO</b></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "1"><b>Private</b></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "3"><b></b></th>				
						<th colspan = "2"><b>Blood Screening</b></th>
						<th colspan = "2"><b></b></th>
					</tr>
<tr > 		
						<th colspan = "9"><b></b></th>				
						<th colspan = "2"><b>Other (please specify)</b></th>
						<th colspan = "2"><b></b></th>
					</tr>
<tr>
						<th colspan = "2">Report for Period:</th>
						<th colspan = "11"></th>
					</tr>
<tr > 		
						<th colspan = "2" style = "text-align:right"><b>Beginning:</b></th>	
						<th colspan = "2"><b></b></th>				
						<th colspan = "2" style = "text-align:right"><b>Ending:</b></th>
						<th colspan = "2"><b></b></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "4"><b>Applicable to Malaria Testing Only</b></th>
					</tr>
<tr > 		
						<th colspan = "2"><b></b></th>
						<th colspan = "2" style = "text-align:center"><i>dd/mm/yyyy</i></th>	
						<th colspan = "2"><b></b></th>			
						<th colspan = "2" style = "text-align:center"><i>dd/mm/yyyy</i></th>
						<th colspan = "1"><b></b></th>
						<th colspan = "1"><b>Test</b></th>
						<th colspan = "1"><b>Category</b></th>
						<th colspan = "1"><b>No. of Tests Performed</b></th>
						<th colspan = "1"><b>No. Positive</b></th>
					</tr>
<tr>
						<th rowspan = "4" colspan = "9"></th>
						<th rowspan = "4">RDT</th>
						<tr>
							<th style = "text-align:left">Patients <u>under</u> 5 years</th>
							<th></th>
							<th></th>							
						</tr>
						<tr><th style = "text-align:left">Patients aged 5-14 yrs</th>
							<th></th>
							<th></th>
						</tr>
						<tr><th style = "text-align:left">Patients <u>over</u> 14 years</th>
							<th></th>
							<th></th>
						</tr>
					</tr>
<tr>
						<th rowspan = "4" colspan = "9"></th>
						<th rowspan = "4">Microscopy</th>
						<tr>
							<th style = "text-align:left">Patients <u>under</u> 5 years</th>
							<th></th>
							<th></th>							
						</tr>
						<tr><th style = "text-align:left">Patients aged 5-14 yrs</th>
							<th></th>
							<th></th>
						</tr>
						<tr><th style = "text-align:left">Patients <u>over</u> 14 years</th>
							<th></th>
							<th></th>
						</tr>
					</tr>

					<tr><th colspan = "14"></th></tr>
	<tr > 		
						<th rowspan = "2" colspan = "2"><b>Commodity Name</b></th>
						<th rowspan = "2"><b>Unit of Issue (e.g. Test)</b></th>
						<th rowspan = "2"><b>Beginning Balance</b></th>
						<th rowspan = "2"><b>Quantity Received</b></th>
						<th rowspan = "2"><b>Quantity Used</b></th>
						<th rowspan = "2"><b>Number of Tests Done</b></th>
						<th rowspan = "2"><b>Losses</b></th>
						<th colspan = "2"><b>Adjustments [indicate if (+) or (-)]</b></th>	
						<th rowspan = "2"><b>End of Month Physical Count</b></th>
						<th rowspan = "2"><b>Quantity Expriing in <u>less than</u> 6 Months</b></th>
						<th rowspan = "2"><b>Days out of Stock</b></th>	
						<th rowspan = "2"><b>Quantity Requested for Re-Supply</b></th>
					</tr>
					<tr>
							<th>Positive</th>
							<th>Negative</th>
						</tr>
					<tr>
						<th colspan = "14" style = "text-align:left"><b>HIV-RELATED LABORATORY COMMODITIES</b></th>		    
					</tr>
					
					<tr>
						<th colspan = "2" style = "text-align:left">Rapid HIV 1+2 Test 1 - <b>Screening</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>				    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Rapid HIV 1+2 Test 1 - <b>Confirmatory</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Rapid HIV 1+2 Test 1 - <b>Tiebreaker</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Rapid Syphillis Test<b>(RPR)</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2"><br/></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>				    
					</tr>
						<tr>
						<th colspan = "14" style = "text-align:left"><b>MALARIA-RELATED LABORATORY COMMODITIES</b></th>		    
					</tr>
					
					<tr>
						<th colspan = "2" style = "text-align:left">Malaria Rapid Diagnostic Test (RDT)</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>				    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Field Stain A</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Field Stain B</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Glemsa Stain</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2"><br/></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>				    
					</tr>
						<tr>
						<th colspan = "14" style = "text-align:left"><b>TB-RELATED LABORATORY COMMODITIES</b></th>		    
					</tr>
					
					<tr>
						<th colspan = "2" style = "text-align:left">Carbol Fuschin (solution)</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>				    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Falcon tubes</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Hydrochloric acid (HCL)</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Lens Tissue</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Methylene Blue</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Microscopic slides</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					
					<tr>
						<th colspan = "2" style = "text-align:left">Sputum mugs (AFB Polypots with lids)</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>	
						<th></th>				    
					</tr>
					<tr>
						<th colspan = "2" style = "text-align:left">Sulphuric acid</th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
					<tr>
						<th colspan = "2"><br/></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>					    
					</tr>
<tr>					
						<th colspan = "14" style = "text-align:left">Explain Losses and Adjustments</th>
					</tr>
<tr>					
						<th colspan = "14"><br/><br/></th>
					
					</tr>
					<tr></tr>
					

<tr>
						
						<th colspan = "3" style = "text-align:left"><b>Order for Extra LMIS tools:<br/> To be requested only when your data collection or reporting tools are nearly full. Indicate quantity required for each tool type.</b></th>
						<th colspan = "1"></th>
						<th colspan = "4"><b>(1) Daily Activity Register for Laboratory Reagents and Consumables (MOH 642):</b></th>
						<th colspan = "1"></th>
						<th colspan = "1"></th>
						<th colspan = "3"><b>(2) F-CDRR for Laboratory Commodities (MOH 643):</b></th>
						<th colspan = "1"></th>   
					</tr>	


<tr>					<th colspan = "2" style = "text-align:left">Compiled by:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Tel:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Designation:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Sign:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Date:</th>
					</tr>
<tr>					<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
					</tr>

					<tr></tr>

<tr>					<th colspan = "2" style = "text-align:left">Approved by:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Tel:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Designation:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Sign:</th>
						<th colspan = "1"></th>
						<th colspan = "2" style = "text-align:left">Date:</th>
					</tr>
<tr>					<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
						<th colspan = "1"><br/></th>
						<th colspan = "2"><br/></th>
					</tr>

</table>
</div>

<?php form_close();?>