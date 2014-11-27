<?php   $identifier = $this -> session -> userdata('user_indicator');
		$countyname = $this -> session -> userdata('county_name');
		$malaria_report_data='';
		$RH_report_details='';
		$TB_report_details='';
	foreach($malaria as $malaria_details1):
		foreach($malaria_details1 as $malaria_details):
			$facilityname = Facilities::get_facility_name2($malaria_details['facility_code']);
			$facility = $facilityname['facility_name'];
			$user = Users::get_user_names($malaria_details['user']);
			$username = $user[0]['fname']." ".$user[0]['lname'];
			$report_date = $malaria_details['report_date'];
			//Dowwnload links
			$link = base_url('reports/get_facility_report_pdf/'.$malaria_details['report_id'].'/'.$malaria_details['facility_code'].'/malaria');	
			$link_excel = base_url('reports/create_excel_facility_program_report/'.$malaria_details['report_id'].'/'.$malaria_details['facility_code'].'/malaria');
		    $malaria_report_data .= <<<HTML_DATA
           <tr>           
				<td>$facility</td>          
 				<td>$username</td>
           		<td>$report_date</td>
           		<td>
           			<a href='$link' target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>
		           	<a href='$link_excel' target="_blank">
           			<button  type="button" class="btn btn-xs btn-primary">
           			<span class="glyphicon glyphicon-save"></span>Download Report excel</button></a> 
           		</td>
           
           </tr>
HTML_DATA;
			endforeach;	
			endforeach;	
			
			foreach($RH as $RH_details1):
				foreach($RH_details1 as $RH_details):
					
			$facilityname = Facilities::get_facility_name2($RH_details['facility_code']);
			$facility = $facilityname['facility_name'];
			
			$user = Users::get_user_names($RH_details['user']);
			$username = $user[0]['fname']." ".$user[0]['lname'];
			$report_date = $RH_details['report_date'];
			$link = base_url('reports/get_facility_report_pdf/'.$RH_details['report_id'].'/'.$RH_details['facility_code'].'/RH');	
			$link_excel = base_url('reports/create_excel_facility_program_report/'.$RH_details['report_id'].'/'.$RH_details['facility_code'].'/RH');
		    $RH_report_details .= <<<HTML_DATA
            <tr>           
				<td>$facility</td>          
 				<td>$username</td>
           		<td>$report_date</td>
           		<td>
           			<a href='$link' target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>
		           	<a href='$link_excel' target="_blank">
           			<button  type="button" class="btn btn-xs btn-primary">
           			<span class="glyphicon glyphicon-save"></span>Download Report excel</button></a>
		           
           		</td>
           </tr>
HTML_DATA;
			endforeach;
			endforeach;
		
		?>
<h1 class="page-header" style="margin: 0;font-size: 1.6em;">Program Reports</h1>
<div class="alert alert-info">
  <b>Below are the program reports for <?php echo $countyname; ?></b>
</div>
<div class="row container" style="width: 100%; margin: auto;">
<div class="col-md-10" style="border: 1px solid #DDD;">
	<ul class='nav nav-tabs'>
      <li class="active"><a href="#Malaria" data-toggle="tab">Malaria Reports</a></li>
      <li class=""><a href="#RH" data-toggle="tab">RH Reports</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
 		<div  id="Malaria" class="tab-pane fade active in">
	        <table width="80%" border="0" class="row-fluid table table-hover table-bordered table-update"  id="test1">
			<thead>
				<tr>
					<th>Facility Name</th>
					<th>Prepared By:</th>
					<th>Report Date</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<?php echo $malaria_report_data; ?>
			</tbody>
			</table> 
      </div>
     <div class="tab-pane fade" id="RH">
        <table cellpadding="0" cellspacing="0" width="100%" border="0" class="row-fluid table table-bordered"  id="test2">
		<thead>
			<tr>
				<th>Facility Name</th>
				<th>Prepared By:</th>
				<th>Report Date</th>
				<th>Action</th>
			</tr>
		</thead>
		<tbody>
			<?php echo $RH_report_details; ?>
	</tbody>
	</table> 
      </div>
    </div>
 	</div>
  </div>
<script>
$(document).ready(function() {
	
} );
</script>
