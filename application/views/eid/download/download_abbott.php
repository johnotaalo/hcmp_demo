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
				<thead >
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
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>1</td>
						<td style="text-align: left">Molecular, m2000 RealTime HIV-1, Amplification Reagent Kit (<strong>Manf. code</strong> 4N6695) </td>
						<td><?php echo $openingqualkit;?></td>
						<td><?php echo $qualkitreceived;?></td>
						<td><?php echo $qualkitlotno;?></td>
						<td><?php echo ceil($uqualkit);?></td>
						<td><?php echo $wqualkit;?></td>
						<td><?php echo $lqualkitreceived;?></td>
						<td><?php echo $iqualkit;?></td>
						<td><?php echo $equalkit;?></td>
						<td><?php echo $rqualkit;?></td>
						<td><?php echo $aqualkit;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>2</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, HIV-1 Qualitative, Control Kit, 12 Vials HP + 12 Vials N</td>
						<td><?php echo $openingcontrol;?></td>
						<td ><?php echo ceil($controlreceived);?></td>
						<td ><?php echo $controllotno;?></td>
						<td><?php echo ceil($ucontrol);?></td>
						<td ><?php echo $wcontrol;?></td>
						<td><?php echo $lcontrolreceived;?></td>
						<td ><?php echo $icontrol;?></td>
						<td><?php echo $econtrol;?></td>
						<td><?php echo $rcontrol;?></td>
						<td><?php echo $acontrol;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>3</td>
						<td style="text-align: left">Molecular, m2000 Realtime PCR, mSample Preparation System Bulk Lysis Buffer</td>
						<td ><?php echo $openingbuffer;?></td>
						
						<td ><?php echo ceil($bufferreceived);?></td>
						<td ><?php echo $bufferlotno;?></td>
						<td ><?php echo ceil($ubuffer);?></td>
						<td ><?php echo $wbuffer;?></td>
						<td ><?php echo $lbufferreceived;?></td>
						<td ><?php echo $ibuffer;?></td>
						<td ><?php echo $ebuffer;?></td>
						<td ><?php echo $rbuffer;?></td>
						<td ><?php echo $abuffer;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>4</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, mSample Preparation Systems DNA</td>
						<td><?php echo $openingpreparation;?></td>
						<td ><?php echo ceil($preparationreceived);?></td>
						<td ><?php echo $preparationlotno;?></td>
						<td><?php echo ceil($upreparation);?></td>
						<td ><?php echo $wpreparation;?></td>
						<td><?php echo $lpreparationreceived;?></td>
						<td ><?php echo $ipreparation;?></td>
						<td><?php echo $epreparation;?></td>
						<td><?php echo $rpreparation;?></td>
						<td><?php echo $apreparation;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>5</td>
						<td style="text-align: left">MicroAmp Optical 96-Well Reaction Plate with Barcode and Optical Adhesive Films</td>
						<td ><?php echo $openingadhesive;?></td>
					  	<td ><?php echo ceil($adhesivereceived);?></td>
						<td >-</td>
						<td ><?php echo ceil($uadhesive);?></td>
						<td ><?php echo $wadhesive;?></td>
					  	<td ><?php echo $ladhesivereceived;?></td>
					  	<td ><?php echo $iadhesive;?></td>
						<td ><?php echo $eadhesive;?></td>
						<td ><?php echo $radhesive;?></td>
						<td ><?php echo $aadhesive;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>6</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, PCR Plate, Plastic, 96-Well, Deep</td>
						<td ><?php echo $openingdeepplate;?></td>
						<td ><?php echo ceil($deepplatereceived);?></td>
						<td >-</td>
						<td><?php echo ceil($udeepplate);?></td>
						<td ><?php echo $wdeepplate;?></td>
						<td><?php echo $ldeepplatereceived;?></td>
						<td><?php echo $ideepplate;?></td>
						<td><?php echo $edeepplate;?></td>
						<td><?php echo $rdeepplate;?></td>
						<td><?php echo $adeepplate;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>7</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Master Mix Tubes/caps, Plastic, 10ml</td>
						<td ><?php echo $openingmixtube;?></td>
						<td ><?php echo ceil($mixtubereceived);?></td>
						<td >-</td>
						<td ><?php echo ceil($umixtube);?></td>
						<td ><?php echo $wmixtube;?></td>
						<td ><?php echo $lmixtubereceived;?></td>
						<td ><?php echo $imixtube;?></td>
						<td ><?php echo $emixtube;?></td>
						<td ><?php echo $rmixtube;?></td>
						<td ><?php echo $amixtube;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>8</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Reaction Vessles (PCR Tube), 5mL, Plastic, 12 x 75mm</td>
						<td ><?php echo $openingreactionvessels;?></td>
						<td ><?php echo ceil($reactionvesselsreceived);?></td>
						<td >-</td>
						<td><?php echo ceil($ureactionvessels);?></td>
						<td><?php echo $wreactionvessels;?></td>
						<td><?php echo $lreactionvesselsreceived;?></td>
						<td><?php echo $ireactionvessels;?></td>
						<td><?php echo $ereactionvessels;?></td>
						<td><?php echo $rreactionvessels;?></td>
						<td><?php echo $areactionvessels;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>9</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Reagent Vessel, 200mL, Plastic</td>
						<td ><?php echo $openingreagent;?></td>
						<td ><?php echo ceil($reagentreceived);?></td>
						<td >-</td>
						<td ><?php echo ceil($ureagent);?></td>
						<td ><?php echo $wreagent;?></td>
						<td ><?php echo $lreagentreceived;?></td>
						<td ><?php echo $ireagent;?></td>
						<td ><?php echo $ereagent;?></td>
						<td ><?php echo $rreagent;?></td>
						<td ><?php echo $areagent;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>10</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Microplate, 96-Well, Optical Reaction, Clear</td>
						<td ><?php echo $openingreactionplate;?></td>
						<td ><?php echo ceil($reactionplatereceived);?></td>
						<td >-</td>
						<td><?php echo ceil($ureactionplate);?></td>
						<td><?php echo $wreactionplate;?></td>
						<td><?php echo $lreactionplatereceived;?></td>
						<td><?php echo $ireactionplate;?></td>
						<td><?php echo $ereactionplate;?></td>
						<td><?php echo $rreactionplate;?></td>
						<td><?php echo $areactionplate;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>11</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Pipet Tips (DiTis), Disposable, with Filter, 1000&Acirc;&micro;L</td>
						<td ><?php echo $opening1000disposable;?></td>
						<td ><?php echo ceil($disposable1000received);?></td>
						<td >-</td>
						<td ><?php echo ceil($u1000disposable);?></td>
						<td ><?php echo $w1000disposable;?></td>
						<td ><?php echo $ldisposable1000received;?></td>
						<td ><?php echo $i1000disposable;?></td>
						<td ><?php echo $e1000disposable;?></td>
						<td ><?php echo $r1000disposable;?></td>
						<td ><?php echo $a1000disposable;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>12</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Pipet Tips (DiTis), Disposable, with Filter, 200&Acirc;&micro;L</td>
						<td ><?php echo $opening200disposable;?></td>
						<td ><?php echo ceil($disposable200received);?></td>
						<td >-</td>
						<td><?php echo ceil($u200disposable);?></td>
						<td><?php echo $w200disposable;?></td>
						<td><?php echo $ldisposable200received;?></td>
						<td><?php echo $i200disposable;?></td>
						<td><?php echo $e200disposable;?></td>
						<td><?php echo $r200disposable;?></td>
						<td><?php echo $a200disposable;?></td>
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
					  	echo '<em>Test Kit Lot No = '.@$kitlotno.'<br>Kit Source = '.@$labfrom.'<br>Date Received = '.@$ldatereceived.'<br>Date Entered = '.@$ldateentered.'</em>';
					}?>
				</div>
				
				
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
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>1</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Amplification Reagent Kit, Hiv-1, Quantitative  (<strong>Manf. code</strong> 2G3190) </td>
						<td><?php echo $vopeningqualkit;?></td>
						<td><?php echo $vqualkitreceived;?></td>
						<td><?php echo $vqualkitlotno;?></td>
						<td><?php echo ceil($vuqualkit);?></td>
						<td><?php echo $vwqualkit;?></td>
						<td><?php echo $vlqualkitreceived;?></td>
						<td><?php echo $viqualkit;?></td>
						<td><?php echo $vequalkit;?></td>
						<td><?php echo $vrqualkit;?></td>
						<td><?php echo $vaqualkit;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>2</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Control Kit, 8 Low Positive, 8 High Positive, 8 Negative</td>
						<td><?php echo $vopeningcontrol;?></td>
						<td ><?php echo ceil($vcontrolreceived);?></td>
						<td ><?php echo $vcontrollotno;?></td>
						<td><?php echo ceil($vucontrol);?></td>
						<td ><?php echo $vwcontrol;?></td>
						<td><?php echo $vlcontrolreceived;?></td>
						<td ><?php echo $vicontrol;?></td>
						<td><?php echo $vecontrol;?></td>
						<td><?php echo $vrcontrol;?></td>
						<td><?php echo $vacontrol;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>3</td>
						<td style="text-align: left">Molecular, m2000 Realtime PCR, mSample Preparation System Bulk Lysis Buffer, 3 x 70ml</td>
						<td ><?php echo $vopeningbuffer;?></td>
						
						<td ><?php echo ceil($vbufferreceived);?></td>
						<td ><?php echo $vbufferlotno;?></td>
						<td ><?php echo ceil($vubuffer);?></td>
						<td ><?php echo $vwbuffer;?></td>
						<td ><?php echo $vlbufferreceived;?></td>
						<td ><?php echo $vibuffer;?></td>
						<td ><?php echo $vebuffer;?></td>
						<td ><?php echo $vrbuffer;?></td>
						<td ><?php echo $vabuffer;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>4</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Preparation System Reagents RNA, 4 x 24 Preps</td>
						<td><?php echo $vopeningpreparation;?></td>
						<td ><?php echo ceil($vpreparationreceived);?></td>
						<td ><?php echo $vpreparationlotno;?></td>
						<td><?php echo ceil($vupreparation);?></td>
						<td ><?php echo $vwpreparation;?></td>
						<td><?php echo $vlpreparationreceived;?></td>
						<td ><?php echo $vipreparation;?></td>
						<td><?php echo $vepreparation;?></td>
						<td><?php echo $vrpreparation;?></td>
						<td><?php echo $vapreparation;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>5</td>
						<td style="text-align: left">MicroAmp Optical 96-Well Reaction Plate with Barcode and Optical Adhesive Films</td>
						<td ><?php echo $vopeningadhesive;?></td>
					  	<td ><?php echo ceil($vadhesivereceived);?></td>
						<td >-</td>
						<td ><?php echo ceil($vuadhesive);?></td>
						<td ><?php echo $vwadhesive;?></td>
					  	<td ><?php echo $vladhesivereceived;?></td>
					  	<td ><?php echo $viadhesive;?></td>
						<td ><?php echo $veadhesive;?></td>
						<td ><?php echo $vradhesive;?></td>
						<td ><?php echo $vaadhesive;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>6</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, PCR Plate, Plastic, 96-Well, Deep</td>
						<td ><?php echo $vopeningdeepplate;?></td>
						<td ><?php echo ceil($vdeepplatereceived);?></td>
						<td >-</td>
						<td><?php echo ceil($vudeepplate);?></td>
						<td ><?php echo $vwdeepplate;?></td>
						<td><?php echo $vldeepplatereceived;?></td>
						<td><?php echo $videepplate;?></td>
						<td><?php echo $vedeepplate;?></td>
						<td><?php echo $vrdeepplate;?></td>
						<td><?php echo $vadeepplate;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>7</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Master Mix Tubes/caps, Plastic, 10ml </td>
						<td ><?php echo $vopeningmixtube;?></td>
						<td ><?php echo ceil($vmixtubereceived);?></td>
						<td >-</td>
						<td ><?php echo ceil($vumixtube);?></td>
						<td ><?php echo $vwmixtube;?></td>
						<td ><?php echo $vlmixtubereceived;?></td>
						<td ><?php echo $vimixtube;?></td>
						<td ><?php echo $vemixtube;?></td>
						<td ><?php echo $vrmixtube;?></td>
						<td ><?php echo $vamixtube;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>8</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Reaction Vessles (PCR Tube), 5mL, Plastic, 12 x 75mm</td>
						<td ><?php echo $vopeningreactionvessels;?></td>
						<td ><?php echo ceil($vreactionvesselsreceived);?></td>
						<td >-</td>
						<td><?php echo ceil($vureactionvessels);?></td>
						<td><?php echo $vwreactionvessels;?></td>
						<td><?php echo $vlreactionvesselsreceived;?></td>
						<td><?php echo $vireactionvessels;?></td>
						<td><?php echo $vereactionvessels;?></td>
						<td><?php echo $vrreactionvessels;?></td>
						<td><?php echo $vareactionvessels;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>9</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Reagent Vessel, 200mL, Plastic</td>
						<td ><?php echo $vopeningreagent;?></td>
						<td ><?php echo ceil($vreagentreceived);?></td>
						<td >-</td>
						<td ><?php echo ceil($vureagent);?></td>
						<td ><?php echo $vwreagent;?></td>
						<td ><?php echo $vlreagentreceived;?></td>
						<td ><?php echo $vireagent;?></td>
						<td ><?php echo $vereagent;?></td>
						<td ><?php echo $vrreagent;?></td>
						<td ><?php echo $vareagent;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>10</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Microplate, 96-Well, Optical Reaction, Clear</td>
						<td ><?php echo $vopeningreactionplate;?></td>
						<td ><?php echo ceil($vreactionplatereceived);?></td>
						<td >-</td>
						<td><?php echo ceil($vureactionplate);?></td>
						<td><?php echo $vwreactionplate;?></td>
						<td><?php echo $vlreactionplatereceived;?></td>
						<td><?php echo $vireactionplate;?></td>
						<td><?php echo $vereactionplate;?></td>
						<td><?php echo $vrreactionplate;?></td>
						<td><?php echo $vareactionplate;?></td>
					</tr>
					<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
						<td>11</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Pipet Tips (DiTis), Disposable, with Filter, 1000&Acirc;&micro;L</td>
						<td ><?php echo $vopening1000disposable;?></td>
						<td ><?php echo ceil($vdisposable1000received);?></td>
						<td >-</td>
						<td ><?php echo ceil($vu1000disposable);?></td>
						<td ><?php echo $vw1000disposable;?></td>
						<td ><?php echo $vldisposable1000received;?></td>
						<td ><?php echo $vi1000disposable;?></td>
						<td ><?php echo $ve1000disposable;?></td>
						<td ><?php echo $vr1000disposable;?></td>
						<td ><?php echo $va1000disposable;?></td>
					</tr>
					<tr style='border-bottom:1px dashed #CCCCCC; '>
						<td>12</td>
						<td style="text-align: left">Molecular, m2000 RealTime PCR, Pipet Tips (DiTis), Disposable, with Filter, 200&Acirc;&micro;L</td>
						<td ><?php echo $vopening200disposable;?></td>
						<td ><?php echo ceil($vdisposable200received);?></td>
						<td >-</td>
						<td><?php echo ceil($vu200disposable);?></td>
						<td><?php echo $vw200disposable;?></td>
						<td><?php echo $vldisposable200received;?></td>
						<td><?php echo $vi200disposable;?></td>
						<td><?php echo $ve200disposable;?></td>
						<td><?php echo $vr200disposable;?></td>
						<td><?php echo $va200disposable;?></td>
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
					  	echo '<em>Test Kit Lot No = '.@$vkitlotno.'<br>Kit Source = '.@$vlabfrom.'<br>Date Received = '.@$vldatereceived.'<br>Date Entered = '.@$vldateentered.'</em>';
					}?>
				</div>
				
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