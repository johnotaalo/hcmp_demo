<?php $facility=$this -> session -> userdata('news');?>
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
	.update{
	background: url('<?php echo base_url()?>Images/updates-resize1.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.issue{
	background: url('<?php echo base_url()?>Images/Drug-basket-resize.png') 10px 50% no-repeat;
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
	.update_order{
	background: url('<?php echo base_url()?>Images/Inventory-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.reports{
	background: url('<?php echo base_url()?>Images/numbers-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.users{
	background: url('<?php echo base_url()?>Images/user-resize.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.add{
	background: url('<?php echo base_url()?>Images/newer.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	.edit{
	background: url('<?php echo base_url()?>Images/edit.png') 10px 50% no-repeat;
	border: 1px solid black;
	width: 70%;
	height: 40%;
	}
	#left_content{
	width:45%;
	float: left;
	}
	#right_content{
	width:50%;
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
<script type="text/javascript">
	$(document).ready(function() {
	/*var chart = new FusionCharts("Scripts/FusionCharts/Charts/Line.swf", "ChartId", "800", "300", "0", "0");
	chart.setDataURL("XML/Line2D.xml");
	chart.render("order_satisfaction");*/
	
	var myChart = new FusionCharts("<?php echo base_url()?>Scripts/FusionWidgets/Charts/HLinearGauge.swf", "myChartId", "420", "90", "0", "0");
	myChart.setDataURL("XML/Linear5.xml");
	myChart.render("turn_around_time");

	});

</script>
<div id="main_content">
	<div id="left_content">
		<fieldset>
			<legend>Actions</legend>
	
	      
	    <div class="activity add">
	    <a href="<?php echo site_url('user_management/sign_up');?>"><h2>Add Users</h2>	</a>
		</div>
		<div class="activity edit">
	    <a href="<?php echo site_url('user_management/users_moh');?>"><h2>Edit Users</h2>	</a>
		</div>
		
	

	
		
		
		
		
		
				
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
