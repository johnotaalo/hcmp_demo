<style type="text/css">
	.button{
		text-align: right;
	}
	.button td {
		border: none;
		
	}
	<?php $link = base_url('reports/get_facility_report_pdf/'.'1101'.'/'.$facility_code.'/expiries'.'/'.$commodity_id.'/'.$from.'/'.$to);?>
</style>
<html>
<div class="container" style="width: 96%; margin: auto;">
				<div class="button">
           			<a href= <?php echo $link; ?> target="_blank">
		           	<button  type="button" class="btn btn-xs btn-primary">
		           	<span class="glyphicon glyphicon-save"></span>Download Report pdf</button></a>
		        </div>
<div class="input-group">
		<table width="x0%" class="table table-bordered table-condensed row-fluid">
		<tr>

		<td>
			<label>Facility Name: </label>
			<input type="text" requiredname="facility_name" class="form-control" disabled value="<?php echo $facility_name; ?>">
		</td>			
		
		<td class="col-xs-2">
		<label>Facility Code: </label>
			<input type="text" requiredname="facility_code: " class="form-control" disabled value="<?php echo $facility_code; ?>">
		</td>
		</div>
		


		<div class="input-group">
			<td class="col-xs-4">
			<label>Facility Type: </label>
			<input type="text" requiredname="dispensary" disabled class="form-control" value="<?php echo $facility_type_; ?>" >
			</td>
			
			<td class="col-xs-2">
			<label>District/Region:</label>
			<input type= 'text' name="district_name" disabled class="form-control" value="<?php echo $district_region_name; ?>">
			</td>
			</div>
			</tr>
			
			</table>
	</div>

<table width="x0%" class="table table-bordered table-condensed row-fluid">
<tbody>
<?php $attributes = array('class'=>'form-control','id'=>'tb_form','name'=>'tb_form_'); echo form_open('divisional_reports/save_tb_data'),$att ?>
	
	<div class="input-group">
		<tr>
		<thead>
			<th>Commodity</th>
			<th>Batch No</th>
			<th>Expiry Date</th>
			<th colspan="12" style="text-align: center;"><?php echo "Year: ".$years[0]; ?></th>
			<th colspan="12" style="text-align: center;"><?php echo "Year: ".$years[1]; ?></th>
			<th colspan="12" style="text-align: center;"><?php echo "Year: ".$years[2]; ?></th>
		</thead>
		</tr>

		<tr>
			<thead>

				<th></th>
				<th></th>
				<th></th>
				<!-- 2014 -->
				<th>J</th>
				<th>F</th>
				<th>M</th>
				<th>A</th>
				<th>M</th>
				<th>J</th>
				<th>J</th>
				<th>A</th>
				<th>S</th>
				<th>O</th>
				<th>N</th>
				<th>D</th>
				<!-- 2015 -->
				<th>J</th>
				<th>F</th>
				<th>M</th>
				<th>A</th>
				<th>M</th>
				<th>J</th>
				<th>J</th>
				<th>A</th>
				<th>S</th>
				<th>O</th>
				<th>N</th>
				<th>D</th>
				<!-- 2016 -->
				<th>J</th>
				<th>F</th>
				<th>M</th>
				<th>A</th>
				<th>M</th>
				<th>J</th>
				<th>J</th>
				<th>A</th>
				<th>S</th>
				<th>O</th>
				<th>N</th>
				<th>D</th>
			</thead>
		</tr>

					<?php
		$months = array();
		$final_date = array();
		$year_months1 = array();

		$checked = '<td><input type="checkbox"  checked disabled ></td>';
		$unchecked = '<td><input type="checkbox" disabled ></td>';

		$months_no = count($month_names);
		$yrs_no = count($years);

	$jan14=$feb14=$march14=$april14=$may14=$june14=$july14=$aug14=$sept14=$oct14=$nov14=$dec14 = $unchecked;
	$jan15=$feb15=$march15=$april15=$may15=$june15=$july15=$aug15=$sept15=$oct15=$nov15=$dec15 = $unchecked;
	$jan16=$feb16=$march16=$april16=$may16=$june16=$july16=$aug16=$sept16=$oct16=$nov16=$dec16 = $unchecked;

$yrs_no = count($years);
$months_no = count($month_names);
for ($i=0; $i < $yrs_no; $i++) { 
	for ($j=0; $j < $months_no; $j++) { 
		$final_date[]=$month_names[$j]." ".$years[$i];
	}
}


foreach($expiry_data as $data):
	$month = null;
	

	$jan14=$feb14=$march14=$april14=$may14=$june14=$july14=$aug14=$sept14=$oct14=$nov14=$dec14 = $unchecked;
	$jan15=$feb15=$march15=$april15=$may15=$june15=$july15=$aug15=$sept15=$oct15=$nov15=$dec15 = $unchecked;
	$jan16=$feb16=$march16=$april16=$may16=$june16=$july16=$aug16=$sept16=$oct16=$nov16=$dec16 = $unchecked;


	$month = $data['expiry_month'];
	$commodity = $data['commodity_name'];
	$batch = $data['batch_no'];

	echo '
		<tr>
		<td>'.$commodity.'</td>
		<td>'.$batch.'</td>
		<td>
			'.$data['expiry_date'].'			
		</td>';

switch ($month) {
			// 2014 SWITCH
			case NULL:
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case $final_date[0]:
			$jan14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[1]:
			$feb14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[2]:
			$march14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case $final_date[3]:
			$april14 = $checked;

			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[4]:
			$may14 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[5]:
			$june14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[6]:
			$july14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[7]:
			$aug14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[8]:
			$sept14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[9]:
			$oct14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[10]:
			$nov14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[11]:
			$dec14 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

				// 2015
			case $final_date[12]:
			$jan15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[13]:
			$feb15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[14]:
			$march15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case $final_date[15]:
			$april15 = $checked;

			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[16]:
			$may15 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[17]:
			$june15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[18]:
			$july15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[19]:
			$aug15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[20]:
			$sept15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[21]:
			$oct15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[22]:
			$nov15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[23]:
			$dec15 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			// 2016
			case $final_date[24]:
			$jan16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[25]:
			$feb16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[26]:
			$march16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
			
				break;

			case $final_date[27]:
			$april16 = $checked;

			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[28]:
			$may16 = $checked;
			
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[29]:
			$june16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[30]:
			$july16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[31]:
			$aug16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[32]:
			$sept16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[33]:
			$oct16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[34]:
			$nov16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;

			case $final_date[35]:
			$dec16 = $checked;
			echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;
			
			default:
				echo $jan14,$feb14,$march14,$april14,$may14,$june14,$july14,$aug14,$sept14,$oct14,$nov14,$dec14;
			echo $jan15,$feb15,$march15,$april15,$may15,$june15,$july15,$aug15,$sept15,$oct15,$nov15,$dec15;
			echo $jan16,$feb16,$march16,$april16,$may16,$june16,$july16,$aug16,$sept16,$oct16,$nov16,$dec16;
				break;
		}


			echo '</tr>';

endforeach;

?>


	</div>
	</form>
</tbody>

</table>
</div>
</html>