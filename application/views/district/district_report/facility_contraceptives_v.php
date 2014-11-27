<?php 
$current_year = date('Y');
$current_month = date('F');
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
     Ministry of Public Health and Sanitation/Ministry of Medical Services</span><br>
       <span style=" font-size: 12px;  margin-left:100px;">Health Commodities Management Platform</span><span style="text-align:center;" >
       	<h2 style="text-align:center; font-size: 20px;">District Contraceptives Consumption Data Report and Request Form</h2>
       	<h2 style="text-align:center; font-size: px;"><?php echo $districtName; ?> District</h2>
       	<h2 style="text-align:center;"><?php echo $current_month ?> <?php echo $current_year ?> </h2>
       	
       
       <hr/> 
</div>

<table class="data-table1">
		
	<tr > 		
						<th><b>Programme</b></th>
						<th colspan = "3"><b>Family Planning</b></th>			
						<th colspan = "9"></th>
										    
					</tr>
<tr > 		
						<th><b>Name of District Store:</b></th>
						<th colspan = "4"><b></b></th>					
						<th><b>District:</b></th>
						<th colspan = "2"><b></b></th>
						<th><b>Province:</b></th>
						<th colspan = "4"><b></b></th>
							
										    
					</tr>
<tr > 		
						<th><b>Period of Reporting:</b></th>
						<th><b> Beginning:</b></th>
						<th colspan = "3"><b></b></th>		
						<th><b>Ending:</b></th>
						<th colspan = "7"><b></b></th>							
						
						</tr>
<tr > 		
						<th colspan="2"><b></b></th>
						<th colspan = "2"><b>(Day/Month/Year)</b></th>					
						<th colspan="2"></th>
						<th colspan = "2"><b>(Day/Month/Year)</b></th>						
						<th colspan="5"><b></b></th>
						</tr>
	<tr > 		
						<th><b>Contraceptive Name</b></th>
						<th><b>Unit of Issue</b></th>
						<th><b>Beginning Balance</b></th>
						<th><b>Quantity Received This Month</b></th>
						<th><b>Quantity Issued to facilities</b></th>
						<th><b>Losses</b></th>
						<th><b>Adjustments</b></th>
						<th><b>Ending Balance</b></th>	
						<th><b>Aggregated SDPs Quantity Dispensed</b></th>
						<th><b>Aggregated SDPs Ending Balance</b></th>
						<th><b>Quantity Requested for District Store</b></th>	
						<th><b>Quantity Requested (Aggregate SDP Qty Requested)</b></th>
						<th><i>Average MOS</i></th>				    
					</tr>
					<tr>
						<th><b>Combined Oral Contraceptive Pills</b></th>
						<th>Cycles</th>
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
						<th>0</th>					    
					</tr>
					
					<tr>
						<th><b>Progestin Only Pills</b></th>
						<th>Cycles</th>
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
						<th>0</th>				    
					</tr>
					<tr>
						<th><b>Injectables</b></th>
						<th>Vials</th>
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
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Implants(1-rod)</b></th>
						<th>Sets</th>
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
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Implants(2-rod)</b></th>
						<th>Sets</th>
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
						<th>0</th>					    
					</tr>
					
					<tr>
						<th><b>Emergency Contraceptive Pills</b></th>
						<th>Doses</th>
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
						<th>0</th>				    
					</tr>
					<tr>
						<th><b>IUCDs</b></th>
						<th>Sets</th>
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
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Male Condoms</b></th>
						<th>Pieces</th>
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
						<th>0</th>					    
					</tr>
					<tr>
						<th><b>Female Condoms</b></th>
						<th>Pieces</th>
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
						<th>0</th>				    
					</tr>
					
					<tr>
						<th><b>Standard Days Method (SDM) Cycle Beads</b></th>
						<th>Cycles</th>
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
						<th>0</th>				    
					</tr>
					<tr>
						<th><b>Others</b></th>
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
						
						<th>0</th>				    
					</tr>
					
<tr>
						<th colspan = "10"><b>SERVICE STATISTICS</b></th>
								<th></th>
								<th></th>
						<th></th>		    
					</tr>
<tr>
						<th><b></b></th>
						<th colspan = "2"><b>Aggregate Clients	</b></th>
						<th colspan = "2"><b>Aggregate Change of Method</b></th>
						<th colspan="4"></th>
						<th><b>Natural FP Counseling</b></th>
						<th></th>
						<th colspan="2"></th>									    
					</tr>
<tr>
						<th><b></b></th>
						<th ><b>New	</b></th>
						<th><b>Revisits</b></th>
						<th ><b>From</b></th>
						<th><b>To</b></th>
						<th colspan="4"></th>						
						<th><b>Natural FP Referrals</b></th>
						<th></th>	
						<th colspan="2"></th>		    
					</tr>
<tr>
						<th><b>Combined Oral Contraceptive Pills</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="8"></th>								    
					</tr>
					<tr>
						<th><b>Progestin only pills</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>HIV Counselling & Testing</b></th>
						<th colspan="2">Known HIV status</th>
						<th colspan="3"></th>	
					</tr>
	<tr>
						<th><b>Injectables</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th><b>Counseled & Tested</b></th>
						<th><b>Referred for Counseling & Testing</b></th>	
						<th><b>1</b></th>
						<th><b>2</b></th>
						<th colspan="3"></th>	
															    
					</tr>
					<tr>
						<th><b>Implants</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
						<th></th>
						<th></th>
						<th colspan="3"></th>	
						
										    
					</tr>
					<tr>
						<th><b>IUCDs</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Sterilisation</b></th>	
						<th colspan="4"></th>  
					</tr>
<tr>
						<th><b>Male Condoms</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Males</b></th>	
						<th></th>
						<th colspan="3"></th>	
							    
					</tr>
	<tr>
						<th><b>Female Condoms</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Females</b></th>	
						<th></th>
						<th colspan="3"></th>
										    
					</tr>
					<tr>
						<th><b>Standard Days Method (SDM)</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="2"><b>Referrals</b></th>	
						<th></th>
						<th colspan="3"></th>
										    
					</tr>
					<tr>
						<th colspan = "13"><b></b></th>
								    
					</tr>
					<tr>
						<th colspan="3"><b>SDP Reporting Rates</b></th>
						<th colspan="4"></th>
						<th colspan="2"><b>Cases for Emergency Pills</b></th>	
						<th></th>
						<th colspan="3"></th>										    
					</tr>
<tr>
						<th><b>Total Expected</b></th>
						<th ><b>Total Reported</b></th>
						<th><b>Reporting Rate</b></th>
						<th colspan="10"></th>						    
					</tr>
<tr>
						<th></th>
						<th ></th>
						<th><b>0%</b></th>
						<th colspan="10"></th>	
										    
					</tr>
					<tr><th colspan = "13"><b></b></th></tr>
			<tr>
						<th><b>Orders for Data</b></th>
						<th >DAR</th>
						<th></th>
						<th>SDP-CDRR</th>
						<th>DS-CDRR</th>
						<th colspan="8"></th>
						
										    
					</tr>
<tr>
						<th><b>Collection or</b></th>
						<th ></th>
						<th></th>
						<th></th>
						<th></th>
						<th colspan="8"></th>
										    
					</tr>
	<tr>
						<th><b>Reporting tool</b></th>
						<th ><b>100 page</b></th>
						<th ><b>300 page</b></th>
						<th></th>
						<th></th>
						<th colspan="8"></th>
										    
					</tr>
<tr>
						<th><b>Quantity requested</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
					<th colspan="8"></th>
						</tr>
		    <tr><th colspan = "13"><b></b></th></tr>
		    <tr>
						<th colspan="13"><b>Comments (On Commodity logistics and clinical issues, including explanation of Losses & Adjustments):</b></th>
						</tr>
						<tr>
						<th height="100px" colspan="13"></th>
						</tr>
					 <tr><th colspan = "13"><b></b></th></tr>
					 <tr>
						<th><b>Report submitted by: </b></th>
						<th colspan="3"></th>
						<th></th>
						<th colspan="2"></th>
						<th></th>
						<th colspan="2"></th>
						<th colspan="3"></th>
						
						</tr>
		<tr>
						<th></th>
						<th colspan="3">Head of the Health facility / SDP / Institution</th>
						<th></th>
						<th colspan="2">Designation</th>
						<th></th>
						<th colspan="2">Date</th>
						<th colspan="3"></th>
						</tr>
		<tr>
						<th><b>Report reviewed by:</b></th>
						<th colspan="3"></th>
						<th></th>
						<th colspan="2"></th>
						<th></th>
						<th colspan="2"></th>
						<th colspan="3"></th>
						</tr>
<tr>
						<th></th>
						<th colspan="3">Name of Reporting officer</th>
						<th></th>
						<th colspan="2">Designation</th>
						<th></th>
						<th colspan="2">Date</th>
						<th colspan="3"></th>
						</tr>
</table>
</div>

<?php form_close();?>