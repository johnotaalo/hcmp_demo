<?php $facility=$this -> session -> userdata('news');
include_once("Scripts/FusionCharts/Code/PHP/Includes/FusionCharts.php");
?>
<?php
$current_year = date('Y');
$earliest_year = $current_year - 5;
?>
<script type="text/javascript">
	$(function() {
		$("#year").change(function() {
			var selected_year = $(this).attr("value");
			//Get the last year of the dropdown list
			var last_year = $(this).children("option:last-child").attr("value");
			//If user has clicked on the last year element of the dropdown list, add 5 more
			if($(this).attr("value") == last_year) {
				last_year--;
				var new_last_year = last_year - 5;
				for(last_year; last_year >= new_last_year; last_year--) {
					var cloned_object = $(this).children("option:last-child").clone(true);
					cloned_object.attr("value", last_year);
					cloned_object.text(last_year);
					$(this).append(cloned_object);
				}
			}
		});
	});

</script>


<SCRIPT LANGUAGE="Javascript" SRC="../../FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript">
	 

</script>
<style type="text/css">
	#filter {
		border: 2px solid #DDD;
		display: block;
		width: 100%;
		margin: 10px auto;
	}
	.filter_input {
		border: 1px solid black;
	}

</style>
<style>
	.message {
	display: block;
	padding: 10px 20px;
	margin: 15px;
	width: 70%;
	}
	.warning {
	background: #FEFFC8 url('<?php echo base_url()?>Images/Alert_Resized.png') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
	width: 70%;
	}
	.message h2 {
	margin-left: 60px;
	margin-bottom: 5px;
	}
	.message p {
	width: auto;
	margin-bottom: 0;
	margin-left: 60px;
	}
	.activity{
	display: block;
	padding: 10px 20px;
	margin: 15px;
	width: 70%;	
	}
	.activity h2 {
	margin-left: 60px;
	margin-bottom: 5px;
	}
	
	.issue{
	background: url('<?php echo base_url()?>Images/Drug-basket-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.stock{
	background: url('<?php echo base_url()?>Images/Quantity-resize.jpg') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.order{
	background: url('<?php echo base_url()?>Images/ordering-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	#left_content{
	width:59%;
	float: left;
	}
	#right_content{
	width:41%;
	float: right;
	}
	.information {
	background: #C3E4FD url('<?php echo base_url()?>Images/Notification_Resized.png') 20px 50% no-repeat;
	border: 1px solid #688FDC;
	}
	.graph{
	
	border: 1px solid #739F1D;
	}
	.graph h2{
		margin-left:0;
	}
	#main_content{
	overflow:hidden;
	}
	#full_width{
	float:left;
	width:100%
	} 
	.graph_container{
		margin:0 auto;
		width:800px;	
	}
	a{
		text-decoration: none;
	}
</style>

<div id="main_content">
	<div id="left_content">
		<fieldset>
			<legend>Select Report filter option</legend>	    

	<?php
	$attributes = array("method" => "POST");
	echo form_open('report_management/generate_order_report', $attributes);
	?>
		<label>Select Report</label>
		<select name="type_of_data">
			<option>--select---</option>
			<option>Raw Order Data</option>
			<option>Order Analysis</option>
		</select>
		<label>Select Reporting Period</label>
		<select name="duration">
			<option>--select---</option>
			<option>Annual</option>
			<option>Quarterly</option>
		</select>
		<label for="year_from">Select Year</label>
		<select name="year_from" id="year">
			<?php
for($x=$current_year;$x>=$earliest_year;$x--){
			?>
			<option value="<?php echo $x;?>"
			<?php
			if ($x == $current_year) {echo "selected";
			}
			?>><?php echo $x;?></option>
			<?php }?>
		</select>
		<label>Select Report Option</label>
		<select name="type_of_report">
			<option>--select---</option>
			<option>Download PDF</option>
			<option>View Report</option>
		</select>
		 
		<input type="submit" class="button"	value="Generate Report" /> 
	</form>		
		</fieldset>

	</div>
	<div id="right_content">
		<fieldset>
			<legend>Reports</legend>
			<b id="notification">Order Fill Rate: (Total Value Of Items Received /Total Value Of Total Items Ordered)* 100</b>
			<div class='graph>'<?php
   //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
   echo renderChartHTML("../Scripts/FusionWidgets/Charts/AngularGauge.swf", "", $strXML, "FactorySum", 370, 200);
   echo '<br><br><br> <b id="notification">Order TAT Order Date- Appoval Date</b><br>';
   echo renderChartHTML("../Scripts/FusionWidgets/Charts/HLinearGauge.swf", "", $strXML1, "Factory", 370, 100);
   echo '<br><br><br> <b id="notification">Order TAT Approval Date- Dispatch Date</b><br>';
   echo renderChartHTML("../Scripts/FusionWidgets/Charts/HLinearGauge.swf", "", $strXML1, "Fa1", 370, 100);
   echo '<br><br><br> <b id="notification">Order TAT Dispatch Date- Delivery Date</b><br>';
   echo renderChartHTML("../Scripts/FusionWidgets/Charts/HLinearGauge.swf", "", $strXML1, "Factory2", 370, 100);
?></div>
		</fieldset>
	</div>
	<!--<div id="full_width">
		<div class="message graph"> 
			<h2>Average Order Satisfaction %</h2>
			<p>
				
			</p>
			<div id="order_satisfaction" class="graph_container"></div>
			
		</div>
	</div>-->
	
</div>
