<style>
	.message {
	display: block;
	padding: 10px 20px;
	margin: 15px;
	}
	.warning {
	background: #FEFFC8 url('<?php echo base_url()?>Images/Alert_Resized.png') 20px 50% no-repeat;
	border: 1px solid #F1AA2D;
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
	#left_content{
	width:45%;
	float: left;
	}
	#right_content{
	width:45%;
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
</style>
<script type="text/javascript">
	$(document).ready(function() {
	var chart = new FusionCharts("<?php echo base_url()?>Scripts/FusionCharts/Charts/MSLine.swf", "ChartId", "800", "300", "0", "0");
	chart.setDataURL("<?php echo base_url()?>/XML/Line2D2.xml");
	chart.render("stock_movement");

	});

</script>
<div id="main_content">
	<div id="full_width">
		<div class="message graph"> 
			<h2>Stock Movement Trend</h2>
			<p style="width:200px; margin:5px auto;">
				<select >
					<option>Acyclovir Tablets 400mg</option>
					<option>Albendazole Tablets 400mg</option>
					<option>Amitriptylline Tablets 25mg</option>
					<option>Amoxicillin /Clavulanic Acid Tablets 500mg/125mg</option>
					<option>Amoxicillin Capsules 250mg</option>
					<option>Artemether/lumefantrine Tablets 100/20mg</option> 
				</select>
			</p>
			<div id="stock_movement" class="graph_container"></div>
		</div>
	</div>
</div>
