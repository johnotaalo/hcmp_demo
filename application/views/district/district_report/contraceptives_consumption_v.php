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
	font-size: 13px;
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
  -webkit-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   -moz-box-shadow: 0px 0px 10px rgba(0,0,0,.8);
   box-shadow: 0px 0px 10px rgba(0,0,0,.8);	
	}
	
</style>

	<div class="whole_report" width = "992px">
		<div class="try">
			<table>
			<tr>
				<td><a href="<?php echo site_url('report_management/Contraceptives_Report_pdf/excel');?>">
				<div><button class="button">Download Excel Sheet</button></div></a>
				</td>
				<td><a href="<?php echo site_url('report_management/Contraceptives_Report_pdf/pdf');?>">
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
       	<h2 style="text-align:center; font-size: 20px;">Division of Reproductive Health Report</h2>
       	
       
       <hr/> 
</div>

<table class="data-table1">
		
	<tr>
						<th><b>Contraceptive</b></th>
						<th><b>Beginning Balance</b></th>
						<th><b>Received This Month</b></th>
						<th><b>Dispensed</b></th>
						<th><b>Losses</b></th>
						<th><b>Adjustments</b></th>
						<th><b>Ending Balance</b></th>	
						<th><b>Quantity Requested</b></th>
								    
					</tr>
					<tr>
						<th><b>Combined Oral Contraceptive Pills</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
											    
					</tr>
					
					<tr>
						<th><b>Progestin Only Pills</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
													    
					</tr>
					<tr>
						<th><b>Injectables</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Implants(1-rod)</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Implants(2-rod)</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					
					<tr>
						<th><b>Emergency Contraceptive Pills</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
												    
					</tr>
					<tr>
						<th><b>IUCDs</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Male Condoms</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
														    
					</tr>
					<tr>
						<th><b>Female Condoms</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
												    
					</tr>
					
					<tr>
						<th><b>Standard Days Method (SDM) Cycle Beads</b></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>
						<th></th>	
													    
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
													    
					</tr>
					
</table>
</div>

<?php form_close();?>