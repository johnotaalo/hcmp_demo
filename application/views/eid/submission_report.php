
<div id="cont_submission_report" style="margin: 0 auto">
	<table class="table table-bordered table-striped tbl_reports_title">
		<tr>
			<th>Date of Submission</th>
			<td>
				<div class="col-sm-4 col-md-4">
					<select id="subm_month" class="input-lg border_zero" required="">
						<option value=""> [ Select Month ]</option>
						<option value="1">1 ]&nbsp; January</option>
						<option value="2">2 ]&nbsp; February</option>
						<option value="3">3 ]&nbsp; March</option>
						<option value="4">4 ]&nbsp; April</option>
						<option value="5">5 ]&nbsp; May</option>
						<option value="6">6 ]&nbsp; June</option>
						<option value="7">7 ]&nbsp; July</option>
						<option value="8">8 ]&nbsp; August</option>
						<option value="9">9 ]&nbsp; September</option>
						<option value="10">10 ]&nbsp; October</option>
						<option value="11">11 ]&nbsp; November</option>
						<option value="12">12 ]&nbsp; December</option>
					</select>
				</div>
				<div class="col-sm-3 col-md-3">
					<select class="input-sm" id="subm_year">
						<?php
						foreach ($years as $value){
							echo "<option value=\"$value\">$value</option>\n";
						}	
						?>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<th>Testing Platform</th>
			<td>
				<span class="col-sm-4 col-md-4">
					<label >
					  <input type="radio" name="platform" id="taqman" value="1" checked>
					   TAQMAN / ROCHE
					</label>
				</span>
				<div class="col-sm-3 col-md-3">
					<label>
					  <input type="radio" name="platform" id="abbot" value="2">
					   ABBOTT
					</label>
				</span>
			</td>
		</tr>
		<tr>
			<th>Testing Lab</th>
			<td>
				<div class="col-sm-12 col-md-12">
					<select id="subm_testing_lab" class="input-lg">
						<option value="">Specify</option>
						<?php
						foreach ($labs as $value){
							echo "<option value='".$value['id']."'>".$value['name']."</option>";
						}	
						?>
					</select>
				</div>
			</td>
		</tr>
		<tr>
			<td colspan="2">
				<input type="button" class="input input-md" id="btn_submit_cons_report" value="Display Consumption Report" />
			</td>
		</tr>
	</table>
</div>