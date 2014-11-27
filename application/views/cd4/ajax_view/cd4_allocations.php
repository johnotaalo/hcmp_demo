
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
						.user2{
	width:70px;
	
	text-align: center;
	}
	 #allocated{
	 	background: #D1F8D5;
        }

        	.allocation-months-list{
		list-style: none;
		font-size: 9px;
		font-family: verdana;

	}
	.allocation-months-list a{

	}

	.allocation-months-list a:active{
		border-left: solid 4px rgb(71, 224, 71);

		background: #EEF1DF;
	}
	.allocation-months-list li{
		border-left: solid 4px darkgreen;
		padding-left: 7px;
		margin-bottom: 1px
	}

	.allocation-months-list li:hover{
		background: #EEF1DF;
	}

			</style>
			<script type="text/javascript" charset="utf-8">
			
			$(function() { 

				/* Build the DataTable with third column using our custom sort functions */
				$('#cd4_allocations').dataTable( {
					"bJQueryUI": true,
					"aaSorting": [[ 10, "desc" ]],
					"bPaginate": false} );				
				 
		 
								
			} );
			
			</script>

<div style="float:left;bacground=#fff;">
<h2>Months</h2>
	<ul class="allocation-months-list">
	<li><a href="#July" class="allocate" onclick="showpreview(12121212)">July</a></li>
	<li><a href="#Aug" class="allocate" onclick="showpreview(12121212)">Aug</a></li>
	<li><a href="#Sept" class="allocate" onclick="showpreview(12121212)">Sept</a></li>
	<li><a href="#Oct" class="allocate" onclick="showpreview(12121212)">Oct</a></li>
	<li><a href="#Nov" class="allocate" onclick="showpreview(12121212)">Nov</a></li>

	</ul>
</div>
<div class="dash_main" style="width: 80%;float: right;">
<table class="data-table">
<thead>
<th>Facility</th>
<th>Reagent</th>
<th>MFLCode</th>
<th>qty</th>
<th>allocation_for</th>
<th>Action</th>
</thead>
<tbody>
<?php 
foreach ($allocations as $key => $allocations_details) {
echo'<tr>
<td>'.$allocations_details['name'].'</td>
<td>'.$allocations_details['MFLCode'].'</td>
<td>'.$allocations_details['reagentname'].'</td>
<td>'.$allocations_details['qty'].'</td>
<td>'.$allocations_details['allocation_for'].'</td>
<td><a>Send mail</a></td>

<tr/>';
}?>
</tbody>
</table>
</div>
<?php 
//echo"<pre>";var_dump($allocations);echo"</pre>";
?>
