<?php
include("Scripts/FusionCharts/FusionCharts.php");


$array_size=count($detail_e1);
$strXML_e1="<chart palette='2' bgColor='#FFFFFF' showBorder='0' caption='Expiries per commodity'subcaption='$name' xAxisName='Month' yAxisName='Units' showValues='0' decimals='0' formatNumberScale='0' useRoundEdges='1'>";
			if($array_size>0){
			for($i=0;$i<$array_size;$i++){
				$month=date("M",strtotime($detail_e1[$i]['expiry_date']));
				$total=$detail_e1[$i]['total'];
				
				$strXML_e1 .="<set label='$month' value='$total' />";
			}}
else{
	$strXML_e1 .="<set label='' value='' />";
}
			$strXML_e1.="</chart>";

echo renderChart("".base_url()."Scripts/FusionCharts/Charts/Column2D.swf", "", $strXML_e1, "e1", 500, 300, false, true);
?>