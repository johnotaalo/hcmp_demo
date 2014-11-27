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
	border: 1px solid #808080;
	
	margin: 15px;
	width: 80%;	
	}
	.activity p {
	margin-top: 0px;
	width:100%;
	text-align: center;
	background-color: #DADADA;
	font: bold;
	font-size: 14px;
	color: #000000;
	}

	#left_content{
	width:40%;
	float: left;
	}
	#right_content{
	width:50%;
	float: right;
	}

	#main_content{
	overflow:hidden;
	}
	#full_width{
	float:left;
	width:100%
	} 
	
	a{
		text-decoration: none;
	}
</style>
<script>
$(function() {
$('#demo').hide();	
});
</script>
<div id="main_content">
	<div id="left_content">
		<fieldset>
			<legend>District Summary</legend>

		<div class="activity">
		<p>Users</p>
		Facility admins "/n"
		Facility users 
		Total users 
		</div>
		<div class="activity">
		<p>Drugs</p>
		Facilities with expired drugs 
		
		</div>
		<div class="activity">
		<p>Orders</p>
		Orders pending approval \n
		Total orders approved \n
		
		</div>
		

		</fieldset>
	</div>
	
	<div id="right_content">
		<fieldset>
			<legend>Facility List</legend>
			<table class="data-table">
				<thead>
					<th>MFL Code</th>
					<th>Facility Name</th>
					<th>Facility Admin</th>
					<th>Facility Admin Phone</th>
					<th>Facility Admin Email</th>
					<th>Action</th>
				</thead>
				<tbody>
	<?php   foreach ($facility_list_arry as $value): {
					echo '<tr>
						<td>'.$value['facility_code'].'</td>
						<td>'.$value['facility_name'].'</td>
						<td>'. $value['fname'].' '. $value['lname'].'</td>
						<td>'.$value['telephone'].'</td>
						<td>'.$value['email'].'</td>
						<td><a class="link" href="'.site_url('dp_facility_list/get_facility_stock_details/'.$value['facility_code'].'').'">stock details</a></td>
					</tr>';
					 } endforeach;?>
				</tbody>
			</table>
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
