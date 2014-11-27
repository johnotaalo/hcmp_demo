<html>
	<head>
		<style>
			body{
				font-size:11.5px;
			}
			h3{
				margin:8px;
				font-size:12px;
			}
			h2{
				text-align:center;
				
			}
			.table,td,th{
				border-collapse:collapse;
				border:solid 1px black;	
			}
			td{
				text-align:center;
				padding:4px;
			}
			th{
				text-transform:capitalize;
				background-color: rgb(231, 230, 230);
			}
		</style>
	</head>
	<body>
		
		<div>
			<?php if($d_type=="bylab"){ echo "<h2>".$plat.'. '.$platform."</h2>";}?>
			<div style=" width:100%;text-align: center;"><font color="#0000FF">EARLY INFANT DIAGNOSIS CONSUMPTION REPORT </font></div>
			<h3>EID TESTS DONE :<?php echo $testsdone;?></h3>
			
			<table class="table" id="tbl_subm_report" >
				<thead>
					<tr >
						<td rowspan="2" >&nbsp;</td>
						<th style="" rowspan="2">COMMODITY </th>
						<?php if(strtoupper($platform)=='TAQMAN'){ ?>
						<th rowspan="2"><small>UNIT PACK</small></th>
						<?php } ?>
						<th rowspan="2">BEGINNING BALANCE</th>
						<th style="" colspan="2"><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE (KEMSA, SCMS / RDC)</font></th>
						<th style="" rowspan="2">QUANTITY USED</th>
						<th rowspan="2">LOSSES / WASTAGE</th>
						<th style="" colspan="2">ADJUSTMENTS</th>
						<th rowspan="2">ENDING BALANCE <br><small>(PHYSICAL COUNT)</small></th>
						<th rowspan="2">QTY REQUESTED</th>		
						<th rowspan="2">QTY ALLOCATED</th>				
					</tr>
					<tr>
						<th style="">Quantity</th>
						<th style="">Lot No.</th>
						<th style="">Positive<br /><small style="color:#00CC00">(Received other source)</small></th>
						<th style="">Negative<br /><small style="color:#9900CC">(Issued Out)</small></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(strtoupper($platform)=='TAQMAN'){// If TAQMAN, load EID data
					?>
						<tr>
							<td >1</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, AmpliPrep, HIV-1, Qualitative (<strong>Manf. Code</strong> 5035724190)</td>
							<td><small>48 tests </small></td>
							<td><?php echo @$openingqualkit;?></td>
							<td><?php echo @$qualkitreceived_a;?></td>
							<td><?php echo @$kitlotno_a;?></td>
							<td><?php echo ceil(@$uqualkit);?></td>
							<td><?php echo @$wqualkit;?></td>
							<td><?php echo @$qualkitreceived;?></td>
							<td><?php echo @$iqualkit;?></td>
							<td><?php echo @$equalkit;?></td>
							<td><?php echo @$rqualkit;?></td>
						    <td><?php echo @$aqualkit;?></td>
						</tr>
						<tr>
							<td >2</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, AmpliPrep, Specimen Pre-Extraction Reagent</td>
							<td ><small>350 tests </small></td>
							<td ><?php echo @$openingspexagent;?></td>
							<td ><?php echo ceil(@$spexagentreceived_a);?></td>
							<td >-</td>
							<td ><?php echo ceil(@$uspexagent);?></td>
							<td ><?php echo @$wspexagent;?></td>
							<td ><?php echo @$spexagentreceived;?></td>
							<td ><?php echo @$ispexagent;?></td>
							<td ><?php echo @$espexagent;?></td>
							<td ><?php echo @$rspexagent;?></td>
						    <td ><?php echo @$aspexagent;?></td>
						</tr>
						<tr>
							<td >3</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, Ampliprep, Input S-tubes</td>
							<td><small>12 * 24</small></td>
							<td><?php echo @$openingampinput;?></td>
							<td><?php echo ceil(@$ampinputreceived_a);?></td>
							<td>-</td>
							<td><?php echo ceil(@$uampinput);?></td>
							<td><?php echo @$wampinput;?></td>
							<td><?php echo @$ampinputreceived;?></td>
							<td><?php echo @$iampinput;?></td>
							<td><?php echo @$eampinput;?></td>
							<td><?php echo @$rampinput;?></td>
							<td><?php echo @$aampinput;?></td>
						</tr>
						<tr>
							<td >4</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, Ampliprep <!--Flapless--> SPU</td>
							<td ><small>12 * 24</small></td>
							<td ><?php echo @$openingampflapless;?></td>
							<td ><?php echo ceil(@$ampflaplessreceived_a);?></td>
							<td >-</td>
							<td ><?php echo ceil(@$uampflapless);?></td>
							<td ><?php echo @$wampflapless;?></td>
							<td ><?php echo @$ampflaplessreceived;?></td>
							<td ><?php echo @$iampflapless;?></td>
							<td ><?php echo @$eampflapless;?></td>
							<td ><?php echo @$rampflapless;?></td>
							<td ><?php echo @$aampflapless;?></td>
						</tr>			
						<tr>
							<td >5</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, AmpliPrep, Wash Reagent</td>
							<td><small>5.1 Litres</small></td>
							<td><?php echo @$openingampwash;?></td>
							<td><?php echo ceil(@$ampwashreceived_a);?></td>
							<td>-</td>
							<td><?php echo ceil(@$uampwash);?></td>
							<td><?php echo @$wampwash;?></td>
							<td><?php echo @$ampwashreceived;?></td>
							<td><?php echo @$iampwash;?></td>
							<td><?php echo @$eampwash;?></td>
							<td><?php echo @$rampwash;?></td>
							<td><?php echo @$rampwash;?></td>
						</tr>
						<tr>
							<td >6</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, Ampliprep, K-tips, 1.2mm</td>
							<td ><small>12 * 36</small></td>
							<td ><?php echo @$openingampktips;?></td>
							<td ><?php echo ceil(@$ampktipsreceived_a);?></td>
							<td >-</td>
							<td ><?php echo ceil(@$uampktips);?></td>
							<td ><?php echo @$wampktips;?></td>
							<td ><?php echo @$ampktipsreceived;?></td>
							<td ><?php echo @$iampktips;?></td>
							<td ><?php echo @$eampktips;?></td>
							<td ><?php echo @$rampktips;?></td>
							<td ><?php echo @$rampktips;?></td>
						</tr>
						<tr>
							<td >7</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, K-Tubes</td>
							<td><small>12 * 96 </small></td>
							<td><?php echo @$openingktubes;?></td>
							<td><?php echo ceil(@$ktubesreceived_a);?></td>
							<td>-</td>
							<td><?php echo ceil(@$uktubes);?></td>
							<td><?php echo @$wktubes;?></td>
							<td><?php echo @$ktubesreceived;?></td>
							<td><?php echo @$iktubes;?></td>
							<td><?php echo @$ektubes;?></td>
							<td><?php echo @$rktubes;?></td>
							<td><?php echo @$rktubes;?></td>
						</tr>
				</tbody>
			</table>
			<div>
				<div><strong>Comments concerning negative adjustments</strong></div>
				<div><?php echo @$icomments;?></div>
				<div><strong>Comments concerning positive adjustments</strong></div>
				<div> <?php 
					  if (@$labfrom == '')
					  {	echo 'No Comments';
					  }
					  else
					  {
					  	echo '<em>Test Kit Lot No = '.@$kitlotno.'<br>Kit Source = '.@$labfrom.'<br>Date Received = '.@$datereceived.'<br>Date Entered = '.@$dateentered.'</em>';
					}?>
				</div>
				
					<?php
					}?>
			</div>
		</div>
		
		<!-- Viral Load -->
		<div style="margin-top: 10px">
			<div style=" width:100%;text-align: center;"><font color="#0000FF">VIRAL LOAD CONSUMPTION REPORT </font></div>
			
			<h3>VL TESTS DONE :<?php echo $vtestsdone;?></h3>
			
			<table class="table" id="tbl_subm_report" >
				<thead>
					<tr>
						<td rowspan="2" >&nbsp;</td>
						<th style="" rowspan="2">COMMODITY </th>
						<?php if(strtoupper($platform)=='TAQMAN'){ ?>
						<th rowspan="2"><small>UNIT PACK</small></th>
						<?php } ?>
						<th rowspan="2">BEGINNING BALANCE</th>
						<th style="" colspan="2"><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE (KEMSA, SCMS / RDC)</font></th>
						<th style="" rowspan="2">QUANTITY USED</th>
						<th rowspan="2">LOSSES / WASTAGE</th>
						<th style="" colspan="2">ADJUSTMENTS</th>
						<th rowspan="2">ENDING BALANCE <br><small>(PHYSICAL COUNT)</small></th>
						<th rowspan="2">QTY REQUESTED</th>		
						<th rowspan="2">QTY ALLOCATED</th>				
					</tr>
					<tr>
						<th style="">Quantity</th>
						<th style="">Lot No.</th>
						<th style="">Positive<br /><small style="color:#00CC00">(Received other source)</small></th>
						<th style="">Negative<br /><small style="color:#9900CC">(Issued Out)</small></th>
					</tr>
				</thead>
				<tbody>
					<?php
					if(strtoupper($platform)=='TAQMAN'){// If TAQMAN, load EID data
					?>
						<tr>
							<td >1</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, AmpliPrep, HIV-1, Qualitative (<strong>Manf. Code</strong> 5035724190)</td>
							<td><small>48 tests </small></td>
							<td><?php echo @$vopeningqualkit;?></td>
							<td><?php echo @$vqualkitreceived_a;?></td>
							<td><?php echo @$vkitlotno_a;?></td>
							<td><?php echo ceil(@$vuqualkit);?></td>
							<td><?php echo @$vwqualkit;?></td>
							<td><?php echo @$vqualkitreceived;?></td>
							<td><?php echo @$viqualkit;?></td>
							<td><?php echo @$vequalkit;?></td>
							<td><?php echo @$vrqualkit;?></td>
						    <td><?php echo @$vaqualkit;?></td>
						</tr>
						<tr>
							<td >2</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, AmpliPrep, Specimen Pre-Extraction Reagent</td>
							<td ><small>350 tests </small></td>
							<td ><?php echo @$vopeningspexagent;?></td>
							<td ><?php echo ceil(@$vspexagentreceived_a);?></td>
							<td >-</td>
							<td ><?php echo ceil(@$vuspexagent);?></td>
							<td ><?php echo @$vwspexagent;?></td>
							<td ><?php echo @$vspexagentreceived;?></td>
							<td ><?php echo @$vispexagent;?></td>
							<td ><?php echo @$vespexagent;?></td>
							<td ><?php echo @$vrspexagent;?></td>
						    <td ><?php echo @$vaspexagent;?></td>
						</tr>
						<tr>
							<td >3</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, Ampliprep, Input S-tubes</td>
							<td><small>12 * 24</small></td>
							<td><?php echo @$vopeningampinput;?></td>
							<td><?php echo ceil(@$vampinputreceived_a);?></td>
							<td>-</td>
							<td><?php echo ceil(@$vuampinput);?></td>
							<td><?php echo @$vwampinput;?></td>
							<td><?php echo @$vampinputreceived;?></td>
							<td><?php echo @$viampinput;?></td>
							<td><?php echo @$veampinput;?></td>
							<td><?php echo @$vrampinput;?></td>
							<td><?php echo @$vaampinput;?></td>
						</tr>
						<tr>
							<td >4</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, Ampliprep <!--Flapless--> SPU</td>
							<td ><small>12 * 24</small></td>
							<td ><?php echo @$vopeningampflapless;?></td>
							<td ><?php echo ceil(@$vampflaplessreceived_a);?></td>
							<td >-</td>
							<td ><?php echo ceil(@$vuampflapless);?></td>
							<td ><?php echo @$vwampflapless;?></td>
							<td ><?php echo @$vampflaplessreceived;?></td>
							<td ><?php echo @$viampflapless;?></td>
							<td ><?php echo @$veampflapless;?></td>
							<td ><?php echo @$vrampflapless;?></td>
							<td ><?php echo @$vaampflapless;?></td>
						</tr>			
						<tr>
							<td >5</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, AmpliPrep, Wash Reagent</td>
							<td><small>5.1 Litres</small></td>
							<td><?php echo @$vopeningampwash;?></td>
							<td><?php echo ceil(@$vampwashreceived_a);?></td>
							<td>-</td>
							<td><?php echo ceil(@$vuampwash);?></td>
							<td><?php echo @$vwampwash;?></td>
							<td><?php echo @$vampwashreceived;?></td>
							<td><?php echo @$viampwash;?></td>
							<td><?php echo @$veampwash;?></td>
							<td><?php echo @$vrampwash;?></td>
							<td><?php echo @$vrampwash;?></td>
						</tr>
						<tr>
							<td >6</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, Ampliprep, K-tips, 1.2mm</td>
							<td ><small>12 * 36</small></td>
							<td ><?php echo @$vopeningampktips;?></td>
							<td ><?php echo ceil(@$vampktipsreceived_a);?></td>
							<td >-</td>
							<td ><?php echo ceil(@$vuampktips);?></td>
							<td ><?php echo @$vwampktips;?></td>
							<td ><?php echo @$vampktipsreceived;?></td>
							<td ><?php echo @$viampktips;?></td>
							<td ><?php echo @$veampktips;?></td>
							<td ><?php echo @$vrampktips;?></td>
							<td ><?php echo @$vrampktips;?></td>
						</tr>
						<tr>
							<td >7</td>
							<td style="text-align: left">Molecular, COBAS, TaqMan, K-Tubes</td>
							<td><small>12 * 96 </small></td>
							<td><?php echo @$vopeningktubes;?></td>
							<td><?php echo ceil(@$vktubesreceived_a);?></td>
							<td>-</td>
							<td><?php echo ceil(@$vuktubes);?></td>
							<td><?php echo @$vwktubes;?></td>
							<td><?php echo @$vktubesreceived;?></td>
							<td><?php echo @$viktubes;?></td>
							<td><?php echo @$vektubes;?></td>
							<td><?php echo @$vrktubes;?></td>
							<td><?php echo @$vrktubes;?></td>
						</tr>
				</tbody>
			</table>
			<div>
				<div><strong>Comments concerning negative adjustments</strong></div>
				<div><?php echo @$vicomments;?></div>
				<div><strong>Comments concerning positive adjustments</strong></div>
				<div> <?php 
					  if (@$vlabfrom == '')
					  {	echo 'No Comments';
					  }
					  else
					  {
					  	echo '<em>Test Kit Lot No = '.@$vkitlotno.'<br>Kit Source = '.@$vlabfrom.'<br>Date Received = '.@$vdatereceived.'<br>Date Entered = '.@$vdateentered.'</em>';
					}?>
				</div>
				
					<?php
					}
					?>
			</div>
			<div style="width: 100%; border-top:solid 1px #000"> 
				<?php 
				if(date('Y-m-d',strtotime($approved_date))=="1970-01-01"){
					$approved_date= $monthname.' '.$year;
				}
				echo "<b style='font-size:14px'>Approved date</b> : ".date('Y-m-10',strtotime($approved_date));?>
			</div>
		</div>
	</body>
</html>
