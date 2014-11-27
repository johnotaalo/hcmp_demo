<?php
include("Scripts/FusionCharts/FusionCharts.php");
$strXML_c1="<chart palette='2' bgColor='#FFFFFF' showBorder='0' caption='Consumption' subcaption='$name' xAxisName='Month' yAxisName='Units' showValues='0' decimals='0' formatNumberScale='0' useRoundEdges='1'>";
for($i=0;$i<12;$i++){

switch ($i){
	case 0:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}
		$strXML_c1 .="<set label='Jan' value='$val' />";
		break;
		case 1:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}
		$strXML_c1 .="<set label='Feb' value='$val' />";
		break;
		case 2:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Mar' value='$val' />";
		break;
		case 3:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1 .="<set label='Apr' value='$val' />";
		break;
		case 4:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='May' value='$val' />";
		break;
		case 5:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Jun' value='$val' />";
		break;
		case 6:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Jul' value='$val' />";
		break;
		case 7:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Aug' value='$val' />";
		break;
		case 8:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Sep' value='$val' />";
		break;
		case 9:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Oct' value='$val' />";
		break;
		case 10:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Nov' value='$val' />";	
		break;
		case 11:
		if(isset($detail[$i]['total'])){
			$val=$detail[$i]['total'];
			
		}	else{
			$val=0;
		}	
		$strXML_c1.="<set label='Dec' value='$val' />";
		break;
											
		
}
	

}
$strXML_c1.="</chart>";

echo renderChart("".base_url()."Scripts/FusionCharts/Charts/Column2D.swf", "", $strXML_c1, "c1", 500, 300, false, true);
?>