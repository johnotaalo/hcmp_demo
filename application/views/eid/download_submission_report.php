<?php
header("Content-type: application/vnd.ms-excel");
header("Content-Disposition: attachment;Filename=$monthname$year CONSUMPTION.xls");
?>
<font color="#0000FF" style="font-size:large">APPROVED CONSUMPTION REPORT :: TAQMAN [ <?php echo strtoupper($labname);?>&nbsp;-&nbsp;<?php echo $monthname.' '.$year;?> ]</font> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<font style="font-family:monospace; font-size:11.5px">Date Submitted : <?php echo $datesubmitted;?> </font>
<table><!--mother table -->
	<tr><!--mother row 1 -->
	<td colspan="2"><!--mother td 1 -->
		<table>
		<tr>
			<td>
				<table class="data-table">	
				<tr>&nbsp;</tr>			
				<tr>
				<td style="background-color:#FFFFFF"><label><strong>EID Total Tests Done</strong></label></td><td style="background-color:#FFFFFF"> <?php echo $testsdone ;?>  <input type="hidden" name="eidtestsdone" size="5" value="<?php echo $testsdone;?>" style = "background:#FFFFCC; font-weight:bold"/></td>
				</tr>
				</table>
			 </td>
			</tr>
		  </table>
	</td><!--end mother td 1 -->
	
	<td></td>
	
	</tr><!--end mother row 1 -->
	<tr>
	
	<tr><!--mother row 2 -->
	<td colspan="2"><!--mother td 2 -->
		<!--<div id="statediv3"></div> 		 -->
		
		<!--new table design -->
		<table style="font-family:Times New Roman" border="1">
			<tr>
			<td colspan="12" style="background-color:#FFFFFF"><br /><div align="center"><font color="#0000FF">EARLY INFANT DIAGNOSIS CONSUMPTION REPORT </font></div></td>				
			</tr>
			<tr>
				<td rowspan="2" style="background-color:#FFFFFF">&nbsp;</td>
				<th style="width:200px" rowspan="2">DESCRIPTION OF GOODS </th>
				<th rowspan="2"><small>UNIT OF ISSUE</small></th>
				<th rowspan="2">BEGINNING <br />BALANCE</th>
				<th style="width:200px; font-size:10px" colspan="2"><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE (KEMSA, SCMS / RDC)</font></th>
				<th style="width:100px" rowspan="2">QUANTITY <br />USED</th>
				<th rowspan="2">LOSSES /<br /> WASTAGE</th>
				<th style="width:200px" colspan="2">ADJUSTMENTS</th>
				<th rowspan="2">ENDING <br />BALANCE </th>
				<th rowspan="2">QUANTITY <br />REQUESTED</th>				
			</tr>
			<tr>
				<th style="width:100px">Quantity</th>
				<th style="width:150px">Lot No.</th>
				<th style="width:100px">Positive<br /><small style="color:#00CC00">(Received other source)</small></th>
				<th style="width:100px">Negative<br /><small style="color:#9900CC">(Issued Out)</small></th>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">1</td>
				<td>Molecular, COBAS, TaqMan, AmpliPrep, HIV-1, Qualitative (<strong>Manf. Code</strong> 5035724190)</td>
				<td><small>48 tests </small></td>
				<td><div align="center">
				 <?php echo $openingqualkit;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $qualkitreceived_a;?>
                </div></td>
				<td><div align="center">
                  <?php echo $kitlotno_a;?>
                </div></td>
				<td><div align="center">
				  <?php echo ceil($uqualkit);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $wqualkit;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $qualkitreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $iqualkit;?>
			    </div></td>
				<td><div align="center">
				 <?php echo $equalkit;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $rqualkit;?>
			    </div></td>
			</tr>
			
			<tr>
				<td style="background-color:#FFFFFF">2</td>
				<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, AmpliPrep, Specimen Pre-Extraction Reagent</td>
				<td style="background-color:#FFFFFF"><small>350 tests </small></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $openingspexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo ceil($spexagentreceived_a);?>
                </div></td>
				<td style="background-color:#FFFFFF">-</td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo ceil($uspexagent);?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $wspexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo $spexagentreceived;?>
                </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $ispexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $espexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $rspexagent;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">3</td>
				<td>Molecular, COBAS, TaqMan, Ampliprep, Input S-tubes</td>
				<td><small>12 * 24</small></td>
				<td><div align="center">
				  <?php echo $openingampinput;?>
			    </div></td>
				<td><div align="center">
                  <?php echo ceil($ampinputreceived_a);?>
                </div></td>
				<td>-</td>
				<td><div align="center">
				  <?php echo ceil($uampinput);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $wampinput;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $ampinputreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $iampinput;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $eampinput;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $rampinput;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">4</td>
				<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep <!--Flapless--> SPU</td>
				<td style="background-color:#FFFFFF"><small>12 * 24</small></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $openingampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo ceil($ampflaplessreceived_a);?>
                </div></td>
				<td style="background-color:#FFFFFF">-</td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo ceil($uampflapless);?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $wampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                 <?php echo $ampflaplessreceived;?>
                </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $iampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $eampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $rampflapless;?>
			    </div></td>
			</tr>			
			<tr>
				<td style="background-color:#FFFFFF">5</td>
				<td>Molecular, COBAS, TaqMan, AmpliPrep, Wash Reagent</td>
				<td><small>5.1 Litres</small></td>
				<td><div align="center">
				  <?php echo $openingampwash;?>
			    </div></td>
				<td><div align="center">
                  <?php echo ceil($ampwashreceived_a);?>
                </div></td>
				<td>-</td>
				<td><div align="center">
				  <?php echo ceil($uampwash);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $wampwash;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $ampwashreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $iampwash;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $eampwash;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $rampwash;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">6</td>
				<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep, K-tips, 1.2mm</td>
				<td style="background-color:#FFFFFF"><small>1.2mm, 12 * 36</small></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $openingampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo ceil($ampktipsreceived_a);?>
                </div></td>
				<td style="background-color:#FFFFFF">-</td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo ceil($uampktips);?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				 <?php echo $wampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo $ampktipsreceived;?>
                </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $iampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $eampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $rampktips;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">7</td>
				<td>Molecular, COBAS, TaqMan, K-Tubes</td>
				<td><small>12 * 96 </small></td>
				<td><div align="center">
				  <?php echo $openingktubes;?>
			    </div></td>
				<td><div align="center">
                  <?php echo ceil($ktubesreceived_a);?>
                </div></td>
				<td>-</td>
				<td><div align="center">
				  <?php echo ceil($uktubes);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $wktubes;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $ktubesreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $iktubes;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $ektubes;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $rktubes;?>
			    </div></td>
			</tr>
			
		</table>
		<!--//..comments table -->
		<table>
		<tr><td>&nbsp;</td></tr>
		<tr>
				<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#9900CC">negative adjustments</font><br /><small>( eg. where were the kits issued out / donated to and why. )</small></strong></div></td>
			  <td colspan="3">
		      <?php echo $icomments;?>		  </td>			
		</tr>
		<tr><td>&nbsp;</td></tr>
		<tr>	
				<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#009900">positive adjustments</font><br /><small>( eg. where were the kits were received from. )</small></strong></div></td>
			  <td colspan="3">			  
			  <?php 
			  if ($labfrom == '')
			  {	echo 'No Comments';
			  }
			  else
			  {
			  	echo '<em>Test Kit Lot No = '.$kitlotno.'<br>Kit Source = '.$labfrom.'<br>Date Received = '.$datereceived.'<br>Date Entered = '.$dateentered.'</em>';
			}?></td>				
			
			</tr>
		</table>
		<!--//..end comments table -->
		<!--end new table design -->
		
			<p><hr /></p>
			<p>&nbsp;</p>
			<table class="data-table">				
				<tr><td style="background-color:#FFFFFF"><label><strong>Viral Load Total Tests Done </strong></label></td><td align="left" style="background-color:#FFFFFF"><?php echo $vtestsdone ;?><input type="hidden" name="vtestsdone" size="5" value="<?php echo  $vtestsdone;?>" style = "background:#FFFFCC; font-weight:bold"/></td>              
				</tr><tr><td>&nbsp;</td></tr>
		  </table>
			
			<!--new table design vl -->
			<table border="1" style="font-family:Times New Roman">
			<tr>			
				<td colspan="12" style="background-color:#FFFFFF"><br />
				<div align="center"><font color="#0000FF">VIRAL LOAD CONSUMPTION REPORT </font></div></td>				
			</tr>
			
			<tr>
				<td rowspan="2" style="background-color:#FFFFFF">&nbsp;</td>
				<th style="width:200px" rowspan="2">DESCRIPTION OF GOODS </th>
				<th rowspan="2"><small>UNIT OF ISSUE</small></th>
				<th rowspan="2">BEGINNING <br />BALANCE</th>
				<th style="width:200px; font-size:10px" colspan="2"><font color="#990000">QUANTITY RECEIVED FROM CENTRAL WAREHOUSE (KEMSA, SCMS / RDC)</font></th>
				<th style="width:100px" rowspan="2">QUANTITY<br /> USED</th>
				<th rowspan="2">LOSSES /<br /> WASTAGE</th>
				<th style="width:200px" colspan="2">ADJUSTMENTS</th>
				<th rowspan="2">ENDING<br /> BALANCE </th>
				<th rowspan="2">QUANTITY <br />REQUESTED</th>				
			</tr>
			<tr>
				<th style="width:100px">Quantity</th>
				<th style="width:150px">Lot No.</th>
				<th style="width:100px">Positive<br /><small style="color:#00CC00">(Received other source)</small></th>
				<th style="width:100px">Negative<br /><small style="color:#9900CC">(Issued Out)</small></th>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">1</td>
				<td>Molecular , COBAS, TaqMan, CAP/CTM HIV v2.0, Quantitative (<strong>Manf. Code </strong>5212294190)</td>
				<td><small>48 tests</small></td>
				<td><div align="center">
				  <?php echo $vopeningqualkit;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $vqualkitreceived_a;?>
                </div></td>
				<td><div align="center">
                  <?php echo $vkitlotno_a;?>
                </div></td>
				<td><div align="center">
				  <?php echo ceil($vuqualkit);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vwqualkit;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $vqualkitreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $viqualkit;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vequalkit;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vrqualkit;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">2</td>
				<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, AmpliPrep, Specimen Pre-Extraction Reagent</td>
				<td style="background-color:#FFFFFF"><small>350 tests </small></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vopeningspexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo ceil($vspexagentreceived_a);?>
                </div></td>
				<td style="background-color:#FFFFFF">-</td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo ceil($vuspexagent);?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vwspexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo $vspexagentreceived;?>
                </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vispexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vespexagent;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vrspexagent;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">3</td>
				<td>Molecular, COBAS, TaqMan, Ampliprep,  Input S-tube</td>
				<td><small>12 * 24</small></td>
				<td><div align="center">
				  <?php echo $vopeningampinput;?>
			    </div></td>
				<td><div align="center">
                  <?php echo ceil($vampinputreceived_a);?>
                </div></td>
				<td>-</td>
				<td><div align="center">
				  <?php echo ceil($vuampinput);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vwampinput;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $vampinputreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $viampinput;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $veampinput;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vrampinput;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">4</td>
				<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep,
 <!--Flapless --> SPU</td>
				<td style="background-color:#FFFFFF"><small>12 * 24</small></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vopeningampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo ceil($vampflaplessreceived_a);?>
                </div></td>
				<td style="background-color:#FFFFFF">-</td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo ceil($vuampflapless);?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vwampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo $vampflaplessreceived;?>
                </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $viampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $veampflapless;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vrampflapless;?>
			    </div></td>
			</tr>			
			<tr>
				<td style="background-color:#FFFFFF">5</td>
				<td>Molecular, COBAS, TaqMan, Ampliprep,  Wash Reagent</td>
				<td><small>5.1 Litres</small></td>
				<td><div align="center">
				  <?php echo $vopeningampwash;?>
			    </div></td>
				<td><div align="center">
                  <?php echo ceil($vampwashreceived_a);?>
                </div></td>
				<td>-</td>
				<td><div align="center">
				  <?php echo ceil($vuampwash);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vwampwash;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $vampwashreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $viampwash;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $veampwash;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vrampwash;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">6</td>
				<td style="background-color:#FFFFFF">Molecular, COBAS, TaqMan, Ampliprep, K-tips, 1.2mm</td>
				<td style="background-color:#FFFFFF"><small> 12 * 36</small></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vopeningampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo ceil($vampktipsreceived_a);?>
                </div></td>
				<td style="background-color:#FFFFFF">-</td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo ceil($vuampktips);?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vwampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
                  <?php echo $vampktipsreceived;?>
                </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $viampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $veampktips;?>
			    </div></td>
				<td style="background-color:#FFFFFF"><div align="center">
				  <?php echo $vrampktips;?>
			    </div></td>
			</tr>
			<tr>
				<td style="background-color:#FFFFFF">7</td>
				<td>Molecular, COBAS, TaqMan, K-Tubes</td>
				<td><small>12 * 96 Pcs</small></td>
				<td><div align="center">
				  <?php echo $vopeningktubes;?>
			    </div></td>
				<td><div align="center">
                  <?php echo ceil($vktubesreceived_a);?>
                </div></td>
				<td>-</td>
				<td><div align="center">
				  <?php echo ceil($vuktubes);?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vwktubes;?>
			    </div></td>
				<td><div align="center">
                  <?php echo $vktubesreceived;?>
                </div></td>
				<td><div align="center">
				  <?php echo $viktubes;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vektubes;?>
			    </div></td>
				<td><div align="center">
				  <?php echo $vrktubes;?>
			    </div></td>
			</tr>	
		</table>
		
		<table><tr><td>&nbsp;</td></tr>
		<tr class="even">
				<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#9900CC">negative adjustments</font><br /><small>( eg. where were the kits issued out / donated to and why. )</small></strong></div></td>
			  <td colspan="3">
		      <?php echo $vicomments;?></td>
		</tr>
		<tr><td></td></tr>
		<tr> 
			 <td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#009900">positive adjustments</font><br /><small>( eg. where were the kits were received from. )</small></strong></div></td>
			  <td colspan="3">
			  <?php 
			  if ($vlabfrom == '')
			  {	echo 'No Comments';
			  }
			  else
			  {
			  	echo '<em>Test Kit Lot No = '.$vkitlotno.'<br>Kit Source = '.$vlabfrom.'<br>Date Received = '.$vdatereceived.'<br>Date Entered = '.$vdateentered.'</em>';
			  }
			  ?></td>					
			</tr>
		</table>
			<!--end new table design vl -->
			
	</td><!--end mother td 2 -->
	</tr><!--end mother row 2 -->
	
	<tr><!--mother row 3 -->	
	<td colspan="2"> 
		<table>
		<p><hr /></p>
			<p>&nbsp;</p>
		<tr><!--mother row 4 -->
		<td style="background-color:#F8F8F8">General Comments</td></tr><tr>
		<td> <?php if ($comments == '') { $comments = 'No Comment';}echo $comments;?>
		 </td>
		</tr><!--mother row 4 -->
		
		
		</table>
	</td>		
	</tr><!--mother row 3 -->	
	
</table><!--end mother table -->
?>