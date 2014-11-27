<?php
$county_id = $this->uri->segment(3);


$htm = '';

	$data['content_view']='cd4/ajax_view/county_allocation_v';
	$data['title']='this';
	$data['banner_text']='Allocate county';

	



	$facilities =$this->db->query('SELECT *
			FROM cd4_facility, cd4_facilityequipments, cd4_districts
			WHERE cd4_facility.AutoID = cd4_facilityequipments.facility
			AND cd4_facility.district = cd4_districts.ID
			AND equipment  <=3
			AND county = "'.$county_id.'" LIMIT 0,1');

			


		if ($facilities->num_rows() > 0){

			// checks whether any equipments 
 
		foreach ($facilities->result_array() as $facilitiessarr) 
		{
			//echo $facilitiessarr['countyname'].'<Br />';

			$facility= $facilitiessarr['AutoID'];
			$facility_name = $facilitiessarr['fname'];
			$facility_mfl = $facilitiessarr['MFLCode'];

	$htm = '';
	$equipments  = $this->db->query('SELECT * 
FROM cd4_facilityequipments, cd4_equipments, cd4_reagentcategory, cd4_reagents
WHERE cd4_facilityequipments.equipment = cd4_equipments.ID
AND cd4_reagentcategory.equipmentType = cd4_equipments.ID
AND cd4_reagents.categoryID = cd4_equipments.ID
AND cd4_equipments.ID = cd4_equipments.ID
AND facility= '.$facility.'');

			if ($equipments->num_rows()>0){
				$facility_details = $this->db->query('SELECT * 
								FROM cd4_facilityequipments, cd4_equipments, cd4_reagentcategory, cd4_reagents
								WHERE cd4_facilityequipments.equipment = cd4_equipments.ID
								AND cd4_reagentcategory.equipmentType = cd4_equipments.ID
								AND cd4_reagents.categoryID = cd4_equipments.ID
								AND cd4_equipments.ID = cd4_equipments.ID
								AND facility ='.$facility.'
								LIMIT 0 , 1');
				foreach ($facility_details->result_array() as $facility_details_arr) {	 
					$facility_equipment =$facility_details_arr['equipmentname'];
					$facility_name  = $facility_details_arr['fname'];
					$facility_mfl  = $facility_details_arr['fname'];

			 $htm .= '<fieldset style="font-size: 14px;background: #FCF8F8;padding: 10px;">
			<span><b>DEVICE :</b>'.$facility_equipment.'</span><br>
			<span><b>FACILITY :</b> '.$facility_name.'</span><br>
			</fieldset>';

}
		$htm .=  "<table class='data-table' style='font-size: 0.9em;'>";
		$htm .=  "<thead>
		<!--<th>Equipment Name</th> -->
 
		<th ROWSPAN=2> Reagent Name</th>
		<th COLSPAN=3>Quantity Received(3 months av)</th>
		<th COLSPAN=3>Quantity Consumed(3 months av)</th>
		<th ROWSPAN=2>End Balance(July)</th>
		<th ROWSPAN=2>Requested</th>
		<th ROWSPAN=2>Allocated</th>
		</tr>
		<tr>
		<th>May</th><th>June</th><th>July</th>
		<th>May</th><th>June</th><th>July</th>
		</tr></thead>
		";
  
				foreach ($equipments->result_array() as $equipmentsarr) {

				$name = $equipmentsarr['reagentname'];
				$reagentname = $equipmentsarr['reagentname'];
				$equipmentname = $equipmentsarr['equipmentname'];
				$unit = $equipmentsarr['unit'];

//				echo "<pre>";
//			var_dump($equipmentsarr);

 
			 	$htm .= '<tr> <td>'.$name.'<br />('.$unit.')</td><td>1</td><td>1</td><td>1</td><td>1</td><td>1</td><td>1</td><td>3</td><td>3</td><td><input type="text" value="0" /></td></tr>';
 

//				echo "</pre>";
			}
			$htm.="</table>";
			$htm.='<input class="button ui-button ui-widget ui-state-default ui-corner-all" id="allocate" value="Allocate" role="button" aria-disabled="false">';

			}
			echo $htm;



		} 

		}
	 
 

		  
 


?>