<style type="text/css">
	.report-info{
		text-align: center;

	};

	table .fixed{
		position: fixed;
	}

</style>
<div class="container" style="width: 96%; margin: auto;">
<!-- <div class="table-responsive" style="height:400px; "> -->
	<!-- <form action="tb_data/save_data" name="" class="form-control" method="POST"> -->
	<?php $attributes = array('class'=>'form-control','id'=>'tb_form','name'=>'tb_form_'); echo form_open('divisional_reports/save_tb_data'),$att ?>
	<input type="hidden" name="table[facility_code][]" value= "<?php echo $facility_code ?>">

	<!--
	<div class="page-header report-info">
	<h2>Tuberculosis Report</h2>
	<h3><?php //echo $facility_name; ?></h3>
	<h4><?php //echo $facility_code; ?></h4>
	<h5><?php //echo $user_names; ?></h5>
	</div>
	-->
<table width="x0%" class="table table-bordered table-condensed row-fluid">
<!-- width="98%" border="0" class="row-fluid table table-hover table-bordered table-update" -->
	<tbody>
	<div style="margin:5px 0;">
		<p class="label label-info">Enter appropriate values in all fields as indicated: </p>
	</div>
<!-- second row -->
		<div class="input-group">
		<tr>

		<td>
			<label>Facility Name: </label>
			<input type="text" required name="facility_name" class="form-control" disabled value="<?php echo $facility_name; ?>">
		</td>			
		
		<td class="col-xs-2">
		<label>Facility Code: </label>
			<input type="text" required name="facility_code: " class="form-control" disabled value="<?php echo $facility_code; ?>">
		</td>
		</div>
		


		<div class="input-group">
			<td class="col-xs-4">
			<label>Facility Type: </label>
			<input type="text" required name="dispensary" disabled class="form-control" value="<?php echo $facility_type_; ?>" >
			</td>
			
			<td class="col-xs-2">
			<label>District/Region:</label>
			<input type= 'text' name="district_name" disabled class="form-control" value="<?php echo $district_region_name; ?>">
			</td>
			</div>
			</tr>
		<!-- fourth -->
		<tr>
			<td style="text-align:right;">
			<label>Beginning Date (of Reporting Period): </label>
			</td>
			<td>
			<!-- <input type="date"   name="table[beginning_date][]" value="" class='form-control'> -->
			<input type="text" required class="form-control clone_datepicker_normal_limit_today" required name="table[beginning_date][]" value="<?php echo date('d M Y'); ?>" />
			</td>
		
			<td  class="col-xs-2"  style="text-align:right;">
			<label>Ending Date (of Reporting Period): </label>
			</td>
			<td>
			<!-- <input type="date"   name="table[ending_date][]" value="" class='form-control'> -->
			<input type="text" required class="form-control clone_datepicker_normal_limit_today" required name="table[ending_date][]" value="<?php echo date('d M Y'); ?>" />
			</td>
		</tr>

		</tbody>
	</table>
		<!-- use colspan on a td -->
			<table width="98%" border="0" class="table-fixed-header row-fluid table table-hover table-bordered table-update">
				<tr>
				<div id="container">
				
				<thead>
				<div id="header-fixed" class="header-fixed"  style="position:fixed;">
					<th>Commodity</th>
					<th>Unit</th>
					<th>Beginning Balance (at the start of the month)</th>
					<th>Received This Month</th>
					<th>Quantity Dispensed</th>
					<th>Positive Adjustment</th>
					<th>Negative Adjustment</th>
					<th>Losses</th>
					<th>Physical Count</th>
					<th>Earliest Expiry Date (6 months)</th>
					<th>Quantity Needed</th>
				</div>
				</thead>
				
				</div>
				</tr>
				<tr>
					<td colspan="12" class=""><div class = "alert alert-info" style="padding:5px;margin:0;font-weight:bold;">TB drugs</div></td>
				</tr>
<!-- tb packs -->
				<tr>
					<td>TB Patient Packs Category</td>
					<td>Packs</td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control' class=""></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[1][]" value="<?php echo $report_data['0']['currently_recieved'] ?>" class='form-control'></td>

				</tr>

				<!-- r/h/z/e 150 -->
				<tr>
					<td>R/H/Z/E 150/75/400/275 mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[2][]" value="<?php echo $report_data['1']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- R/H/Z/E 150/75/275 mg -->
				<tr>
					<td>R/H/Z/E 150/75/275 mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[3][]" value="<?php echo $report_data['2']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Streptomycin Injection -->
				<tr>
					<td>Streptomycin Injection 1Gm</td>
					<td>Vials</td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[4][]" value="<?php echo $report_data['3']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- R/H 150/75 mg  -->
				<tr>
					<td>R/H 150/75 mg </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[5][]" value="<?php echo $report_data['4']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- R/H/Z 60/30/150 mg  -->
				<tr>
					<td>R/H/Z 60/30/150 mg  </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[6][]" value="<?php echo $report_data['5']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- R/H 60/30 mg  -->
				<tr>
					<td>R/H 60/30 mg </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[7][]" value="<?php echo $report_data['6']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- 60mg -->
				<tr>
					<td>R/H 60/60 mg </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[8][]" value="<?php echo $report_data['7']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Ethambutol 400 mg  -->
				<tr>
					<td>Ethambutol 400 mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[9][]" value="<?php echo $report_data['8']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- H, 300 mg -->
				<tr>
					<td>H, 300 mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>

					<td><input type="text" required  name="table[10][]" value="<?php echo $report_data['9']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- H,x0mg -->
				<tr>
					<td>H, x0 mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[11][]" value="<?php echo $report_data['10']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Rifabutin 150mg  -->
				<tr>
					<td>Rifabutin 150mg </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[12][]" value="<?php echo $report_data['11']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Pyrazinamide 500mg -->
				<tr>
					<td>Pyrazinamide 500mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[13][]" value="<?php echo $report_data['12']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Rifampicin 600mg -->
				<tr>
					<td>Rifampicin 600mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[14][]" value="<?php echo $report_data['13']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Pyridoxine 50mg -->
				<tr>
					<td>Pyridoxine 50mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[15][]" value="<?php echo $report_data['14']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole 960 Mg -->
				<tr>
					<td>Co-trimoxazole 960 Mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[16][]" value="<?php echo $report_data['15']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole, 480  mg -->
				<tr>
					<td>Co-trimoxazole, 480  mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[17][]" value="<?php echo $report_data['16']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Co-trimoxazole suspension, 240 mg/5ml -->
				<tr>
					<td>Co-trimoxazole suspension, 240 mg/5ml</td>
					<td>Bottles</td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[18][]" value="<?php echo $report_data['17']['currently_recieved'] ?>" class='form-control'></td>
				</tr>  

				<!-- Dapsone x0mg -->
				<tr>
					<td>Dapsone x0mg</td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[19][]" value="<?php echo $report_data['18']['currently_recieved'] ?>" class='form-control'></td>
				</tr> 

				<tr>
					<td>

					</td>
				</tr>
				
				<tr><td colspan="12" class=""><div class = "alert alert-info" style="padding:5px;margin:0;font-weight:bold;">Leprosy Drugs</div></td></tr>
				<!-- MB Adult Blister  -->
				<tr>
					<td>MB Adult Blister </td>
					<td>Packs</td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[20][]" value="<?php echo $report_data['19']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- MB Child Blister Packs -->
				<tr>
					<td>MB Child Blister Packs</td>
					<td>Packs</td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[21][]" value="<?php echo $report_data['20']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- PB Adult Blister Packs -->
				<tr>
					<td>PB Adult Blister Packs</td>
					<td>Packs</td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[22][]" value="<?php echo $report_data['21']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- PB Child Blister Packs -->
				<tr>
					<td>PB Child Blister Packs</td>
					<td>Packs</td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[23][]" value="<?php echo $report_data['22']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<tr><td colspan="12" class=""><div class = "alert alert-info" style="padding:5px;margin:0;font-weight:bold;">MDR TB drugs</div></td></tr>

				<!-- Capreomycin 1gm vial -->
				<tr>
					<td>Capreomycin 1gm vial</td>
					<td>Vial</td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[24][]" value="<?php echo $report_data['23']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Cycloserine 250mg  -->
				<tr>
					<td>Cycloserine 250mg </td>
					<td>Tablet</td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[25][]" value="<?php echo $report_data['24']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Kanamycin 1gm vial  -->
				<tr>
					<td>Kanamycin 1gm vial </td>
					<td>Vial</td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[26][]" value="<?php echo $report_data['25']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Levofloxacin 250mg   -->
				<tr>
					<td>Levofloxacin 250mg  </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[27][]" value="<?php echo $report_data['26']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Levofloxacin 500mg   -->
				<tr>
					<td>Levofloxacin 500mg  </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[28][]" value="<?php echo $report_data['27']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Para-aminosalicylic acid 4mg    -->
				<tr>
					<td>Para-aminosalicylic acid 4mg   </td>
					<td>Satchets</td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[29][]" value="<?php echo $report_data['28']['currently_recieved'] ?>" class='form-control'></td>
				</tr>

				<!-- Prothionamide 250mg    -->
				<tr>
					<td>Prothionamide 250mg   </td>
					<td>Tablets</td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
					<td><input type="text" required  name="table[30][]" value="<?php echo $report_data['29']['currently_recieved'] ?>" class='form-control'></td>
				</tr>
			</table>
		</tr>

		<tr>
		<td>
		<table class="table table-bordered ">
		<tr>
			<th>Collection or Reporting tool</th>
			<th colspan="2">DAR</th>
			<th>CDRR</th>
		</tr>
		<tr>
			<th>Reporting Tool</th>
			<th>50 page</th>
			<th>x0 page</th>
			<th>FCDRR</th>
		</tr>
		<tr>
			<th>Quantity Requested</th>
			<td><input type="text" required  name="qtt" value="" class='form-control'></td>
			<td><input type="text" required  name="x0pg" value="" class='form-control'></td>
			<td><input type="text" required  name="FCDRR" value="" class='form-control'></td>
		</tr>
			</table>
			</td>
		</tr>
<!-- patient summary table -->
		<tr>
				<table class="table table-bordered">
				<th colspan="8" class="">Patient Summaries: </th>
					<tr>
						<th></th>
						<th>New</th>
						<th>Retreatment</th>
						<th>Leprosy</th>
						<th>MDR</th>
						<th>IPT</th>
						<th>Rifabetia</th>
						<th>CPT</th>
					</tr>
					<tr>
						<th>Adult</th>
						<td><input type="text" required  name="summary_adult_new" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_adult_retreatment" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_adult_leprosy" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_adult_mdr" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_adult_ipt" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_adult_rifabetia" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_adult_cpt" value="" class='form-control'></td>
					</tr>

					<tr>
						<th>Children</th>
						<td><input type="text" required  name="summary_children_new" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_children_retreatment" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_children_leprosy" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_children_mdr" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_children_ipt" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_children_rifabetia" value="" class='form-control'></td>
						<td><input type="text" required  name="summary_children_cpt" value="" class='form-control'></td>
					</tr>
				</table>
		</tr>

		<tr>
			<table class="table table-bordered">
			<th colspan="8" class="accordion">Supply Box Commodities</th>
				<tr>
					<th>Commodity</th>
					<th>Beginning Balance</th>
					<th>Amount into Supply Box</th>
					<th>Amount out of Supply Box</th>
					<th>Amount Withdrawn to District Store</th>
					<th>Ending Balance</th>
				</tr>
				<tr>
					<th>A</th>
					<th>B</th>
					<th>C</th>
					<th>D</th>
					<th>E</th>
					<th>F</th>
				</tr>
				<tr>
					<th>RHZE Tablets</th>
					<td><input type="text" required  name="rhzeB" value="" class='form-control'></td>
					<td><input type="text" required  name="rhzeC" value="" class='form-control'></td>
					<td><input type="text" required  name="rhzeD" value="" class='form-control'></td>
					<td><input type="text" required  name="rhzeE" value="" class='form-control'></td>
					<td><input type="text" required  name="rhzeF" value="" class='form-control'></td>
				</tr>
				<tr>
					<th>RH Tablets</th>
					<td><input type="text" required  name="rhB" value="" class='form-control'></td>
					<td><input type="text" required  name="rhC" value="" class='form-control'></td>
					<td><input type="text" required  name="rhD" value="" class='form-control'></td>
					<td><input type="text" required  name="rhE" value="" class='form-control'></td>
					<td><input type="text" required  name="rhF" value="" class='form-control'></td>
				</tr>
			</table>
		</tr>
		<tr>
			<td>
			<hr/>
	<div class="container-fluid" style="float:right">
	<button type="submit" class="save btn btn-sm btn-success" id="save_data"><span class="glyphicon glyphicon-open"></span>Save</button>
</div>
			</td>
		</tr>

<!-- </div> -->
	</tbody>
</table>
</div> 


</form>

<script>

      $(document).ready(function () {
  $('[data-toggle=offcanvas]').click(function () {
    $('.row-offcanvas').toggleClass('active')
  });

  $(window).resize(function() {
    if (($(window).width() < 768))
    {
        $( ".col-md-2,.col-md-x" ).css( "position", "" );
    };
});
 	$('#dataTables_filter label input').addClass('form-control');
	$('#dataTables_length label select').addClass('form-control');
$('#exp_datatable,#potential_exp_datatable,#potential_exp_datatable2').dataTable( {
     "sDom": "T lfrtip",
  
       "sScrollY": "377px",
       
                    "sPaginationType": "bootstrap",
                    "oLanguage": {
                        "sLengthMenu": "_MENU_ Records per page",
                        "sInfo": "Showing _START_ to _END_ of _TOTAL_ records",
                    },
            "oTableTools": {
                 "aButtons": [
        "copy",
        "print",
        {
         "sExtends":    "collection",
					"sButtonText": 'Save',
					"aButtons":    [ "csv", "xls", "pdf" ]
        }
      ],
      "sSwfPath": "<?php echo base_url(); ?>assets/datatable/media/swf/copy_csv_xls_pdf.swf"
    }
  } ); 
   
});
    </script>