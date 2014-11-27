$strXML_e1="<chart palette='2' bgColor='#FFFFFF' showBorder='0' caption='Expiries per commodity'subcaption='Absolute Ethanol(Methylated spirit)' xAxisName='Month' yAxisName='Units' showValues='0' decimals='0' formatNumberScale='0' useRoundEdges='1'>";
for($i=0;$i<12;$i++){

switch ($i){
	case 0:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}
		$strXML_e1 .="<set label='Jan' value='$val' />";
		break;
		case 1:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}
		$strXML_e1 .="<set label='Feb' value='$val' />";
		break;
		case 2:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Mar' value='$val' />";
		break;
		case 3:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1 .="<set label='Apr' value='$val' />";
		break;
		case 4:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='May' value='$val' />";
		break;
		case 5:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Jun' value='$val' />";
		break;
		case 6:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Jul' value='$val' />";
		break;
		case 7:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Aug' value='$val' />";
		break;
		case 8:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Sep' value='$val' />";
		break;
		case 9:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Oct' value='$val' />";
		break;
		case 10:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Nov' value='$val' />";	
		break;
		case 11:
		if(isset($detail_e1[$i]['total'])){
			$val=$detail_e1[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_e1.="<set label='Dec' value='$val' />";
		break;
											
		
}
	

}
$strXML_e1.="</chart>";
$data['strXML_c1']=$strXML_e1;
