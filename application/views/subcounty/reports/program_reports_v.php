`<style type="text/css">
	.well{
		background-color: white;
	}

	.page-header{
		border:none;
	}

	#information-table th
	{
		text-align: center;
		font-size: 120%;
	}
	#information-table td, th
	{
		padding: 5px;
	}
	a.btn
	{
		border-radius: 0;
	}
</style>
<?php   $identifier = $this -> session -> userdata('user_indicator');
		$countyname = $this -> session -> userdata('county_name');
		// $malaria_report_data='';
		$RH_report_details='';
		$TB_report_details='';
		$link_new_report_malaria = base_url('divisional_reports/malaria_report');
		$link_TB = base_url('divisional_reports/tb_report');
		$link_new_report_RH = base_url('divisional_reports/RH_report');
		
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
		    
		    /*$malaria_report_data .= <<<HTML_DATA
           <tr>           
				<td>$facility</td>          
 				<td>$username</td>
           		<td>$report_date</td>
           		<td colspan = '2'>
           			<a href='$link' target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>

		           	<a href='$link_excel' target="_blank">
           			<button  type="button" class="btn btn-xs btn-primary">
           			<span class="glyphicon glyphicon-save"></span>Download Report excel</button></a> 
		           	
           		</td>
           </tr>
           
HTML_DATA;*/
//echo $link;
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
           		<td colspan = '2'>
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
		foreach($TB as $TB_details1):
			foreach($TB_details1 as $TB_details):
				$facilityname = Facilities::get_facility_name2($TB_details['facility_code']);
				$facility = $facilityname['facility_name'];
				$user = Users::get_user_names($TB_details['user']);
				$username = $user[0]['fname']." ".$user[0]['lname'];
				$report_date = $TB_details['report_date'];
				$link = base_url('reports/get_facility_report_pdf/'.$TB_details['report_id'].'/'.$TB_details['facility_code'].'/TB');	
				$link_excel = base_url('reports/create_excel_facility_program_report/'.$TB_details['report_id'].'/'.$TB_details['facility_code'].'/TB');

			    
			    $TB_report_details .= <<<HTML_DATA
	            <tr>           
					<td>$facility</td>          
	 				<td>$username</td>
	           		<td>$report_date</td>
	           		<td colspan = '2'>

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
<div class="row container" style="width: 100%; margin: auto; background-color: white;">
<div class="" style="background-color: white;">
	<ul class='nav nav-tabs'>
      <li class="active"><a href="#Malaria" data-toggle="tab">Malaria</a></li>
      <li class=""><a href="#RH" data-toggle="tab">Reproductive Health</a></li>
    </ul>
    <div id="myTabContent" class="tab-content">
 		<div  id="Malaria" class="tab-pane fade active in">
				<?php
					$user_indicator = $this->session->userdata('user_indicator');
					$facility_listing = '';
					switch ($user_indicator) {
						case 'county':
							$facility_listing .= '<table class = "col-md-12" id = "information-table">';
							$facility_listing .= '<tbody><tr>
							<td><select class = "form-control" name = "subcounties" id = "subcounties"><option value = "" selected = "selected">Select a Sub County</option>'.$sub_counties.'</select></td>
							<td><select class = "form-control" name = "facilities" id = "facilities"><option value = "" selected = "selected">Select a Facility</option><optgroup id = "facility_listing"></optgroup></select></td>
							<td><a href = "#" class = "btn btn-success" id = "filter"><i class = "glyphicon glyphicon-filter"></i> Filter</a></td>
							<td><a href = "#" class = "btn btn-success pdf-download" data-facility = "" id = "mal-pdf-download" data-report-type = "malaria"><i class = "glyphicon glyphicon-save"></i> Download PDF</a></td>';
							$facility_listing .= '</table>';
							break;
						case 'district':
							$facility_listing .= '<table class = "col-md-12" id = "information-table">';
							$facility_listing .= '<thead><th style = "width :80%;">Facility</th><th style = "width :10%;"></th><th style = "width :10%;"></th></thead>';
							$facility_listing .= '<tbody><tr>
							<td><select class = "form-control" name = "facilities" id = "facilities"><option value = "" selected = "selected">Select a Facility</option><optgroup id = "facility_listing">'.$mal_report_data.'</optgroup></select></td>
							<td><a href = "#" class = "btn btn-success" id = "filter"><i class = "glyphicon glyphicon-filter"></i> Filter</a></td>
							<td><a href = "#" class = "btn btn-success pdf-download" data-facility = "" id = "mal-pdf-download" data-report-type = "malaria"><i class = "glyphicon glyphicon-save"></i> Download PDF</a></td>';
							$facility_listing .= '</table>';
							
							break;
						
						case 'facility':
						case 'facility_admin':
							$facility_listing .= '<center><a href = "#" class = "btn btn-success pdf-download" data-facility = "'.$fac_mfl.'" id = "mal-pdf-download" data-report-type = "malaria"><i class = "glyphicon glyphicon-save"></i> Download PDF</a></center>';
							break;
						default:
							# code...
							break;
					}
					echo $facility_listing;
				?>
				<div id = "table-holder">
				</div>						
		  </div>
     <div class="tab-pane fade" id="RH">
     	<?php
			$user_indicator = $this->session->userdata('user_indicator');
			$facility_listing = '';
			switch ($user_indicator) {
				case 'county':
					$facility_listing .= '<table class = "col-md-12" id = "information-table">';
					$facility_listing .= '<tbody><tr>
					<td><select class = "form-control" name = "rh-subcounties" id = "rh-subcounties"><option value = "" selected = "selected">Select a Sub County</option>'.$sub_counties.'</select></td>
					<td><select class = "form-control" name = "rh-facilities" id = "rh-facilities"><option value = "" selected = "selected">Select a Facility</option><optgroup id = "rh-facility_listing"></optgroup></select></td>
					<td><a href = "#" class = "btn btn-success" id = "rh-filter"><i class = "glyphicon glyphicon-filter"></i> Filter</a></td>
					<td><a href = "#" class = "btn btn-success pdf-download" data-facility = "" id = "rh-pdf-download" data-report-type = "rh"><i class = "glyphicon glyphicon-save"></i> Download PDF</a></td>';
					$facility_listing .= '</table>';
					break;
				case 'district':
					$facility_listing .= '<table class = "col-md-12" id = "information-table">';
					$facility_listing .= '<thead><th style = "width :80%;">Facility</th><th style = "width :10%;"></th><th style = "width :10%;"></th></thead>';
					$facility_listing .= '<tbody><tr>
					<td><select class = "form-control" name = "rh-facilities" id = "rh-facilities"><option value = "" selected = "selected">Select a Facility</option><optgroup id = "facility_listing">'.$mal_report_data.'</optgroup></select></td>
					<td><a href = "#" class = "btn btn-success" id = "rh-filter"><i class = "glyphicon glyphicon-filter"></i> Filter</a></td>
					<td><a href = "#" class = "btn btn-success pdf-download" data-facility = "" id = "rh-pdf-download" data-report-type = "rh"><i class = "glyphicon glyphicon-save"></i> Download PDF</a></td>';
					$facility_listing .= '</table>';
					
					break;
				
				case 'facility':
				case 'facility_admin':
					$facility_listing .= '<center><a href = "#" class = "btn btn-success pdf-download" data-facility = "'.$fac_mfl.'" id = "rh-pdf-download" data-report-type = "rh"><i class = "glyphicon glyphicon-save"></i> Download PDF</a></center>';
					break;
				default:
					# code...
					break;
			}
			echo $facility_listing;
		?>
		<div id = "rh-table-holder"></div>		           	
     </div>
    </div>
 	</div>
  </div>

<script type="text/javascript">
	$(document).ready(function(){
		$('#test1').dataTable({
			"sDom": "T lfrtip",
	     "sScrollY": "310px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print"
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
		});
		$('#test2').dataTable({
			"sDom": "T lfrtip",
	     "sScrollY": "310px",
	     "sScrollX": "100%",
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
			      "oTableTools": {
                 "aButtons": [
				"copy",
				"print"
			],

			"sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
		}
		});
	});
</script>

<script type="text/javascript">
	user_indicator = '<?php echo $this->session->userdata("user_indicator"); ?>';
	base_url = '<?php echo base_url(); ?>';
	$(document).ready(function(){
		switch(user_indicator)
		{
			case 'facility':
			case 'facility_admin':
				facility = '<?php echo $this->session->userdata("facility_id"); ?>';
				table_url = base_url + 'divisional_reports/malaria_report/'+facility;
				createtable(table_url, 'malaria');
				table_url = base_url + 'divisional_reports/rh_report/'+facility;
				createtable(table_url, 'rh');
				break;
			default:
				break;
		}
	});
	
	$('#filter').click(function(){
		facility = $('select[name="facilities"]').val();
		if (facility != '') {
			table_url = base_url + 'divisional_reports/malaria_report/'+facility;
			createtable(table_url, 'malaria');
		}
		else
		{
			alert('You must choose a Facility to filter data');
			$('select[name="facilities"]').focus();
		}
		
		
	});

	$('#rh-filter').click(function(){
		facility = $('#rh-facilities').val();
		if (facility != '') {
			table_url = base_url + 'divisional_reports/rh_report/'+facility;
			createtable(table_url, 'rh');
		}
		else
		{
			alert('You must choose a Facility to filter data');
			$('select[name="facilities"]').focus();
		}
	});

	$('select[name = "subcounties"]').change(function(){
		$('#table-holder').html('');
		subcounty_id = $(this).val();
		if (subcounty_id !== ''){
			$.get(base_url + 'divisional_reports/createfacilitiessubcounty/'+subcounty_id +'/ajax', function(data){
				$('#facility_listing').html(data);
				$('#mal-pdf-download').attr('data-facility', '');
			});
		}
		else
		{
			$('#mal-pdf-download').attr('data-facility', '');
		}
	});

	$('#rh-subcounties').change(function(){
		$('#rh-table-holder').html('');
		subcounty_id = $(this).val();
		if (subcounty_id !== ''){
			$.get(base_url + 'divisional_reports/createfacilitiessubcounty/'+subcounty_id +'/ajax', function(data){
				$('#rh-facility_listing').html(data);
				$('#rh-pdf-download').attr('data-facility', '');
			});
		}
		else
		{
			$('#rh-pdf-download').attr('data-facility', '');
		}
	});

	$('select[name="facilities"]').change(function(){
		facility = $(this).val();
		if (facility !== '') {
			$('#mal-pdf-download').attr('data-facility', facility);
		}
		else
		{
			$('#mal-pdf-download').attr('data-facility', '');
		}
	});

	$('#rh-facilities').change(function(){
		facility = $(this).val();
		if (facility !== '') {
			$('#rh-pdf-download').attr('data-facility', facility);
		}
		else
		{
			$('#rh-pdf-download').attr('data-facility', '')
		}
	});

	$('.pdf-download').click(function(){
		facility_id = $(this).attr('data-facility');
		report_type = $(this).attr('data-report-type');
		if (facility_id !== '') {
			window.open(base_url + 'divisional_reports/pdfreport/' + report_type + '/' + facility_id, '_blank');
		}
		else
		{
			alert('Please select a Facility to Download PDF');
		}
	});
	function createtable(table_url, type)
	{
		$('table-holder').html('');
		$.get(table_url, function(data)
		{
			if (type === 'malaria') {
				$('#table-holder').html(data);
			}
			else
			{
				$('#rh-table-holder').html(data);
			}
		});
	}
</script>
