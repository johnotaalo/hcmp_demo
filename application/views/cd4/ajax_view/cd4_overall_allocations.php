
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
 
	 #allocated{
	 	background: #D1F8D5;
        }
		</style>


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
			function loadmonth(period){

			$.ajax({
  type: "POST",
  url: 'loadmonth_alloc/'+period,
  success: function(result){
  	$(".dash_main").html(result);
		}
	});

			}
		function send_mail(period){

			url = 'send_mail';

			$.ajax({
  type: "POST",
  url: 'send_mail/'+period,
  success: function(result){

		$("#notif").html(result);
		$( "#notif" ).fadeIn(400);
		$( "#notif" ).delay( 4000 ).slideUp(400);


		}
	});
}	
			$(function() { 
				$( "#notif" ).delay( 3000 ).slideUp(400);
//			setTimeout( "$('#notif').hide();", 4000);
 			 
				 
		 
								
			} );
			
			</script>

<div style="float:left;bacground=#fff;">
<h2>Months</h2>
	<ul class="allocation-months-list">
	<li><a href="#July" class="allocate" onclick="loadmonth(072013)">July</a></li>
	<li><a href="#Aug" class="allocate" onclick="loadmonth(082013)">Aug</a></li>
	<li><a href="#Sept" class="allocate" onclick="loadmonth(92013)">Sept</a></li>
	<li><a href="#Oct" class="allocate" onclick="loadmonth(102013)">Oct</a></li>
	<li><a href="#Nov" class="allocate" onclick="loadmonth(112013)">Nov</a></li>
	<li><a href="#Nov" class="allocate" onclick="loadmonth(112013)">Nov</a></li>

	</ul>
</div><span id="notif" style="
width: 80%;float: right;
    font-size: 20px;
    color: #82DA71;
    background: #F7F5C8;
    padding-left: 9px;
    /* padding-right: 9px; */
    position: relative;
   
    padding-top: 7px;
  
    border: solid 1px #C5C5C5;
    height: 26px;
    margin-top: 3px;
    display:none;
"> </span>
<div class="dash_main" style="width: 80%;float: right;">
<?php if (isset($_GET['allocationsuccess'])){?>
<span id="notif" style="
    font-size: 20px;
    color: #82DA71;
    background: #F7F5C8;
    padding-left: 9px;
    /* padding-right: 9px; */
    position: relative;
    float: left;
    padding-top: 7px;
    width: 100%;
    border: solid 1px #C5C5C5;
    height: 26px;
    margin-top: 3px;
">Allocation Succesful</span>
<?php }?>

<!--<button onclick="send_mail()" style="background: #CAEE59;border: solid 1px #ECECEC;">Send mail</button>-->
<table class="data-table" id="cd4_alloc">
<thead>
<th>Facility</th>
<th>MFLCode</th>
<th>Reagent</th>
<th>Quantity</th>
<th>Allocation For</th>
 
</thead>
<tbody>
<?php 
foreach ($allocations as $key => $allocations_details) {
//echo "<pre>";var_dump($allocations_details);echo "</pre>";
echo'<tr>
<td>'.$allocations_details['facilityname'].'</td>
<td>'.$allocations_details['MFLCode'].'</td>
<td>'.$allocations_details['reagentname'].'</td>
<td>'.$allocations_details['qty'].'</td>
<td>July 2013</td>
 

<tr/>';
}?>
</tbody>
</table>
</div>
<?php 
//echo"<pre>";var_dump($allocations);echo"</pre>";
?>
