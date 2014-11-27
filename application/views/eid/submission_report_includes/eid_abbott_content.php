<tr style='border-bottom:1px dashed #CCCCCC; '>
	<td>1</td>
	<td width="350px" colspan="">Molecular, m2000 RealTime HIV-1, Amplification Reagent Kit (<strong>Manf. code</strong> 4N6695) </td>
	<td><div align="center"><!--<input type="hidden"  name="oqualkit" size="5" value="<?php //echo $openingqualkit;?>" style="color:#999999; font-weight:bold"/> -->
	  <input type="text" class="input-sm"   name="oqualkit" size="5" value="<?php echo $openingqualkit;?>"  style="color:#999999; font-weight:bold"/>
	</div></td>
	<td><div align="center">
	  <input type="text" class="input-sm"  name="recqualkit" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo $qualkitreceived;?>"/>
	</div></td>
	<td><div align="center">
      <input type="text" class="input-sm" name="qualkitlotno" size="10" style = "font-weight:bold; color:#999999" value="<?php echo $qualkitlotno;?>"/>
    </div></td>
		<td><div align="center"><input type="hidden"  name="uqualkit" size="5"  value="<?php echo ceil($uqualkit);?>"  style="color:#999999; font-weight:bold"/> 
		  <input type="text" class="input-sm"  name="uqualkit2" size="5"  value="<?php echo ceil($uqualkit);?>"  style="color:#999999; font-weight:bold"/>
		</div></td><td><div align="center"><input type="text" class="input-sm" value="<?php echo $wqualkit;?>"  name="wqualkit" size="5" style="color:#999999; font-weight:bold"   /></div></td>
		<td><div align="center">
      <input type="text" class="input-sm" name="pqualkit" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lqualkitreceived;?>"/>
    </div></td>
		<td><div align="center"><input type="text" class="input-sm" name="iqualkit" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $iqualkit;?>"   /></div></td><td><div align="center">
		  <input type="text" class="input-sm" name="equalkit" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $equalkit;?>" />
		</div></td>
		<td><div align="center">
		  <input type="text" class="input-sm" name="o_rqualkit"  size="5"  style = "background:#FFFFFF;font-weight:bold"  value="<?php echo $rqualkit;?>"  />
		</div></td>
		<td class="allocate_column"><div align="center">
		  <input type="text" class="input-sm" name="rqualkit"  size="5"  style = "background:#FFFFFF;font-weight:bold"  value="<?php echo $rqualkit;?>"  />
		</div></td>
	</tr>
	<tr style='border-bottom:1px dashed #CCCCCC; '>
		<td>2</td>
		<td>Molecular, m2000 RealTime PCR, HIV-1 Qualitative, Control Kit, 12 Vials HP + 12 Vials N</td>
		<td><div align="center"><!--<input type="hidden"  name="ocontrol" size="5"  value="<?php echo $openingcontrol;?>" style="color:#999999; font-weight:bold" /> -->
		  <input type="text" class="input-sm"   name="ocontrol" size="5"  value="<?php echo $openingcontrol;?>"  style="color:#999999; font-weight:bold"/>
		</div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="reccontrol" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($controlreceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm" name="controllotno" size="10" style = "font-weight:bold; color:#999999" value="<?php echo $controllotno;?>"/>
    </div></td>
		<td><div align="center"><input type="hidden" name="ucontrol" size="5" value="<?php echo ceil($ucontrol);?>" style="color:#999999; font-weight:bold" /> 
		  <input type="text" class="input-sm" name="ucontrol2" size="5" value="<?php echo ceil($ucontrol);?>" style="color:#999999; font-weight:bold" />
		</div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="wcontrol" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wcontrol;?>"   /></div></td>
		<td><div align="center">
      <input type="text" class="input-sm"  name="pcontrol" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lcontrolreceived;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="icontrol" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $icontrol;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="econtrol" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $econtrol;?>"  /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="o_rcontrol"    size="5"  style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rcontrol;?>" /></div></td>
		<td class="allocate_column"><div align="center"><input type="text" class="input-sm"  name="rcontrol"    size="5"  style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rcontrol;?>" /></div></td>
	</tr>
	<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
		<td>3</td>
		<td>Molecular, m2000 Realtime PCR, mSample Preparation System Bulk Lysis Buffer</td>
		<td style="background-color:#FFFFFF"><div align="center"><!--<input type="hidden"  name="obuffer" size="5"   value="<?php //echo $openingbuffer;?>" style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"    name="obuffer" size="5"   value="<?php echo $openingbuffer;?>"  style="color:#999999; font-weight:bold"/>
		</div></td>
		
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recbuffer" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($bufferreceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm" name="bufferlotno" size="10" style = "font-weight:bold; color:#999999" value="<?php echo $bufferlotno;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="hidden" name="ubuffer" size="5" value="<?php echo ceil($ubuffer);?>" style="color:#999999; font-weight:bold"/>
		  <input type="text" class="input-sm" name="ubuffer2" size="5" value="<?php echo ceil($ubuffer);?>" style="color:#999999; font-weight:bold"/>
		</div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="wbuffer" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wbuffer;?>"   /></div></td>
		<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm"  name="pbuffer" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lbufferreceived;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"name="ibuffer" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $ibuffer;?>"  /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="ebuffer" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $ebuffer;?>" /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="o_rbuffer"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rbuffer;?>" /></div></td>
		<td style="background-color:#FFFFFF" class="allocate_column"><div align="center"><input type="text" class="input-sm" name="rbuffer"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rbuffer;?>" /></div></td>
	</tr>
	<tr style='border-bottom:1px dashed #CCCCCC; '>
		<td>4</td>
		<td>Molecular, m2000 RealTime PCR, mSample Preparation Systems DNA</td>
		<td><div align="center"><!--<input type="hidden" name="opreparation" size="5"  value="<?php //echo $openingpreparation;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"   name="opreparation" size="5"  value="<?php echo $openingpreparation;?>"   style="color:#999999; font-weight:bold"/>
		</div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recpreparation" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($preparationreceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm" name="preparationlotno" size="10" style = "font-weight:bold; color:#999999" value="<?php echo $preparationlotno;?>"/>
    </div></td>
		<td><div align="center"><input type="hidden"  name="upreparation" size="5" value="<?php echo ceil($upreparation);?>"  style="color:#999999; font-weight:bold"/>
		  <input type="text" class="input-sm"  name="upreparation2" size="5" value="<?php echo ceil($upreparation);?>"  style="color:#999999; font-weight:bold"/>
		</div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="wpreparation" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wpreparation;?>"  /></div></td>
		
		<td><div align="center">
      <input type="text" class="input-sm"  name="ppreparation" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lpreparationreceived;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="ipreparation" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $ipreparation;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm" name="epreparation" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $epreparation;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm" name="o_rpreparation" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rpreparation;?>" /></div></td>
		<td class="allocate_column"><div align="center" class="allocate_column"><input type="text" class="input-sm" name="rpreparation" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rpreparation;?>" /></div></td>
	</tr>
	<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
		<td>5</td>
		<td>MicroAmp Optical 96-Well Reaction Plate with Barcode and Optical Adhesive Films</td>
		<td style="background-color:#FFFFFF"><div align="center">
		 <!-- <input type="hidden" name="oadhesive" size="5"  value="<?php //echo $openingadhesive;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"  name="oadhesive" size="5"  value="<?php echo $openingadhesive;?>"   style="color:#999999; font-weight:bold"/>
		  </div></td>
		  <td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recadhesive" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($adhesivereceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center"><input type="hidden" name="uadhesive" size="5" value="<?php echo ceil($uadhesive);?>" style="color:#999999; font-weight:bold"/>
		      <input type="text" class="input-sm" name="uadhesive2" size="5" value="<?php echo ceil($uadhesive);?>" style="color:#999999; font-weight:bold"/>
		  </div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="wadhesive" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wadhesive;?>"   /></div></td>
		  <td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm"  name="padhesive" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $ladhesivereceived;?>"/>
    </div></td>
		  <td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="iadhesive" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $iadhesive;?>" /></div></td>
		  <td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="eadhesive" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $eadhesive;?>" /></div></td>
		  <td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="o_radhesive"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $radhesive;?>" /></div></td>
		  <td style="background-color:#FFFFFF" class="allocate_column"><div align="center"><input type="text" class="input-sm" name="radhesive"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $radhesive;?>" /></div></td>
	</tr>
	<tr style='border-bottom:1px dashed #CCCCCC; '>
		<td>6</td>
		<td>Molecular, m2000 RealTime PCR, PCR Plate, Plastic, 96-Well, Deep</td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <!--<input type="hidden"  name="odeepplate" size="5"  value="<?php //echo $openingdeepplate;?>" style="color:#999999; font-weight:bold" /> -->
		  <input type="text" class="input-sm"   name="odeepplate" size="5"  value="<?php echo $openingdeepplate;?>"  style="color:#999999; font-weight:bold"/>
	    </div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recdeepplate" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($deepplatereceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td><div align="center">
		  <input type="hidden"  name="udeepplate" size="5" value="<?php echo ceil($udeepplate);?>"  style="color:#999999; font-weight:bold"/>
		  <input type="text" class="input-sm"  name="udeepplate2" size="5" value="<?php echo ceil($udeepplate);?>"  style="color:#999999; font-weight:bold"/>
		</div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="wdeepplate"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wdeepplate;?>"  /></div></td>
		<td><div align="center">
      <input type="text" class="input-sm"  name="pdeepplate" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $ldeepplatereceived;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="ideepplate"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $ideepplate;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="edeepplate" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $edeepplate;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="o_rdeepplate" size="5"  style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rdeepplate;?>" /></div></td>
		<td class="allocate_column"><div align="center"><input type="text" class="input-sm"  name="rdeepplate" size="5"  style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rdeepplate;?>" /></div></td>
	</tr>
	<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
		<td>7</td>
		<td>Molecular, m2000 RealTime PCR, Master Mix Tubes/caps, Plastic, 10ml</td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <!--<input type="hidden"  name="omixtube" size="5"  value="<?php //echo $openingmixtube;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"   name="omixtube" size="5"  value="<?php echo $openingmixtube;?>"   style="color:#999999; font-weight:bold"/>
	    </div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recmixtube" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($mixtubereceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center"><input type="hidden"  name="umixtube" size="5" value="<?php echo ceil($umixtube);?>"  style="color:#999999; font-weight:bold"/>
	        <input type="text" class="input-sm"  name="umixtube2" size="5" value="<?php echo ceil($umixtube);?>"  style="color:#999999; font-weight:bold"/>
	    </div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="wmixtube" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wmixtube;?>"   /></div></td>
		<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm"  name="pmixtube" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lmixtubereceived;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="imixtube" size="5" style="color:#999999; font-weight:bold"  value="<?php echo $imixtube;?>" /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="emixtube" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $emixtube;?>" /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="o_rmixtube"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rmixtube;?>" /></div></td>
		<td style="background-color:#FFFFFF" class="allocate_column"><div align="center"><input type="text" class="input-sm"  name="rmixtube"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rmixtube;?>" /></div></td>
	</tr>
	<tr style='border-bottom:1px dashed #CCCCCC; '>
		<td>8</td>
		<td>Molecular, m2000 RealTime PCR, Reaction Vessles (PCR Tube), 5mL, Plastic, 12 x 75mm</td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <!--<input type="hidden"  name="oreactionvessels" size="5"  value="<?php //echo $openingreactionvessels;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"   name="oreactionvessels" size="5"  value="<?php echo $openingreactionvessels;?>"  style="color:#999999; font-weight:bold"/>
	    </div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recreactionvessels" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($reactionvesselsreceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td><div align="center"><input type="hidden"  name="ureactionvessels" size="5" value="<?php echo ceil($ureactionvessels);?>" style="color:#999999; font-weight:bold" />
	        <input type="text" class="input-sm"  name="ureactionvessels2" size="5" value="<?php echo ceil($ureactionvessels);?>" style="color:#999999; font-weight:bold" />
	    </div></td><td><div align="center"><input type="text" class="input-sm"  name="wreactionvessels"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wreactionvessels;?>" /></div></td>
		<td><div align="center">
      <input type="text" class="input-sm"  name="preactionvessels" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lreactionvesselsreceived;?>"/>
    </div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="ireactionvessels"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $ireactionvessels;?>"  /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="ereactionvessels" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $ereactionvessels;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="o_rreactionvessels" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rreactionvessels;?>" /></div></td>
		<td class="allocate_column"><div align="center"><input type="text" class="input-sm"  name="rreactionvessels" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rreactionvessels;?>" /></div></td>
	</tr>
	<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
		<td>9</td>
		<td>Molecular, m2000 RealTime PCR, Reagent Vessel, 200mL, Plastic</td>
		<td style="background-color:#FFFFFF"><div align="center">
		 <!-- <input type="hidden"  name="oreagent" size="5"  value="<?php //echo $openingreagent;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"   name="oreagent" size="5"  value="<?php echo $openingreagent;?>"  style="color:#999999; font-weight:bold"/>
	    </div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recreagent" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($reagentreceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="hidden" name="ureagent" size="5" value="<?php echo ceil($ureagent);?>"  style="color:#999999; font-weight:bold"/>
	        <input type="text" class="input-sm" name="ureagent2" size="5" value="<?php echo ceil($ureagent);?>"  style="color:#999999; font-weight:bold"/>
	    </div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="wreagent"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wreagent;?>"  /></div></td>
		<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm"  name="preagent" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lreagentreceived;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm"  name="ireagent"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $ireagent;?>" /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="ereagent" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $ereagent;?>" /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="o_rreagent" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rreagent;?>" /></div></td>
		<td style="background-color:#FFFFFF" class="allocate_column"><div align="center"><input type="text" class="input-sm" name="rreagent" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rreagent;?>" /></div></td>
	</tr>
	<tr style='border-bottom:1px dashed #CCCCCC; '>
		<td>10</td>
		<td>Molecular, m2000 RealTime PCR, Microplate, 96-Well, Optical Reaction, Clear</td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <!--<input type="hidden" name="oreactionplate" size="5"  value="<?php //echo $openingreactionplate;?>" style="color:#999999; font-weight:bold" /> -->
		  <input type="text" class="input-sm"  name="oreactionplate" size="5"  value="<?php echo $openingreactionplate;?>" style="color:#999999; font-weight:bold"/>
	    </div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="recreactionplate" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($reactionplatereceived);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
		<td><div align="center"><input type="hidden" name="ureactionplate" size="5" value="<?php echo ceil($ureactionplate);?>" style="color:#999999; font-weight:bold"/>
	        <input type="text" class="input-sm" name="ureactionplate2" size="5" value="<?php echo ceil($ureactionplate);?>" style="color:#999999; font-weight:bold"/>
	    </div></td><td><div align="center"><input type="text" class="input-sm"  name="wreactionplate"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $wreactionplate;?>" /></div></td>
		<td><div align="center">
      <input type="text" class="input-sm"  name="preactionplate" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $lreactionplatereceived;?>"/>
    </div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="ireactionplate"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $ireactionplate;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm" name="ereactionplate" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $ereactionplate;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm" name="o_rreactionplate" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rreactionplate;?>" /></div></td>
		<td class="allocate_column"><div align="center"><input type="text" class="input-sm" name="rreactionplate" size="5"    style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $rreactionplate;?>" /></div></td>
	</tr>
	<tr class="even" style='border-bottom:1px dashed #CCCCCC; '>
		<td>11</td>
		<td>Molecular, m2000 RealTime PCR, Pipet Tips (DiTis), Disposable, with Filter, 1000&Acirc;&micro;L</td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <!--<input type="hidden" name="o1000disposable" size="5"  value="<?php //echo $opening1000disposable;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"  name="o1000disposable" size="5"  value="<?php echo $opening1000disposable;?>" style="color:#999999; font-weight:bold"/>
	    </div></td><td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="rec1000disposable" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($disposable1000received);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td style="background-color:#FFFFFF"><div align="center"><input type="hidden" name="u1000disposable" size="5" value="<?php echo ceil($u1000disposable);?>" style="color:#999999; font-weight:bold"/>
	        <input type="text" class="input-sm" name="u1000disposable2" size="5" value="<?php echo ceil($u1000disposable);?>" style="color:#999999; font-weight:bold"/>
	    </div></td><td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="w1000disposable"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $w1000disposable;?>"  /></div></td>
		<td style="background-color:#FFFFFF"><div align="center">
      <input type="text" class="input-sm"  name="p1000disposable" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $ldisposable1000received;?>"/>
    </div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="i1000disposable"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $i1000disposable;?>"  /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="e1000disposable" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $e1000disposable;?>" /></div></td>
		<td style="background-color:#FFFFFF"><div align="center"><input type="text" class="input-sm" name="o_r1000disposable"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $r1000disposable;?>" /></div></td>
		<td style="background-color:#FFFFFF" class="allocate_column"><div align="center"><input type="text" class="input-sm" name="r1000disposable"    size="5" style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $r1000disposable;?>" /></div></td>
	</tr>
	<tr style='border-bottom:1px dashed #CCCCCC; '>
		<td>12</td>
		<td>Molecular, m2000 RealTime PCR, Pipet Tips (DiTis), Disposable, with Filter, 200&Acirc;&micro;L</td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <!--<input type="hidden" name="o200disposable" size="5"  value="<?php //echo $opening200disposable;?>"  style="color:#999999; font-weight:bold"/> -->
		  <input type="text" class="input-sm"  name="o200disposable" size="5"  value="<?php echo $opening200disposable;?>" style="color:#999999; font-weight:bold"/>
	    </div></td>
		<td style="background-color:#FFFFFF"><div align="center">
		  <input type="text" class="input-sm"  name="rec200disposable" size="5" style = "font-weight:bold; color:#999999" onkeyup="" value="<?php echo ceil($disposable200received);?>"/>
		</div></td>
	<td style="background-color:#FFFFFF">-</td>
	<td><div align="center"><input type="hidden"  name="u200disposable" size="5" value="<?php echo ceil($u200disposable);?>" style="color:#999999; font-weight:bold"/>
	        <input type="text" class="input-sm"  name="u200disposable2" size="5" value="<?php echo ceil($u200disposable);?>" style="color:#999999; font-weight:bold"/>
	    </div></td><td><div align="center"><input type="text" class="input-sm"  name="w200disposable"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $w200disposable;?>" /></div></td>
		<td><div align="center">
      <input type="text" class="input-sm"  name="p200disposable" size="5" style = "color:#999999; font-weight:bold"  value="<?php echo $ldisposable200received;?>"/>
    </div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="i200disposable"  size="5" style="color:#999999; font-weight:bold"  value="<?php echo $i200disposable;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="e200disposable" size="5"  style="color:#999999; font-weight:bold"  value="<?php echo $e200disposable;?>" /></div></td>
		<td><div align="center"><input type="text" class="input-sm"  name="o_r200disposable" size="5"  style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $r200disposable;?>" /></div></td>
		<td class="allocate_column"><div align="center"><input type="text" class="input-sm"  name="r200disposable" size="5"  style = "background:#FFFFFF;font-weight:bold"   value="<?php echo $r200disposable;?>" /></div></td>
	</tr>
	
	<tr class="even">
	<td colspan="2" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#9900CC">negative adjustments</font><br /><small>( eg. where were the kits issued out / donated to and why. )</small></strong></div></td>
	<td colspan="2"><textarea name="icomments" cols="30" rows="2" style="font-family:monospace; font-size:11.2px; border:none" disabled="disabled" ><?php echo $icomments;?></textarea></td>
	<td colspan="3" style="background-color:#F2F2F2"><div align="right"><strong>Comments concerning <font color="#009900">positive adjustments</font><br /><small>( eg. where were the kits were received from. )</small></strong></div></td>
  <td colspan="5">
  <input type="hidden" name="rowID" size="5" value="<?php echo $rowID;?>" style = "color:#999999; font-weight:bold font-weight:bold"/>
 
  <?php 
  if ($labfrom == '')
  {	echo 'No Comments';
  }
  else
  {
  	echo '<em>Kit Source = '.$labfrom.'<br>Date Received = '.$ldatereceived.'<br>Date Entered = '.$ldateentered.'</em>';
}?></td>				
</tr>