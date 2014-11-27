
<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
		<style type="text/css" title="currentStyle">
			
			@import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
			.user2{
	width:70px;
	
	text-align: center;
	}
/*	 #allocated{
	 	background: #D1F8D5;
        }
*/		</style>	 
				<script type="text/javascript" charset="utf-8">
			
			$(function() { 

				/* Build the DataTable with third column using our custom sort functions */
				$('#allocateds').dataTable( {
					"bJQueryUI": true,
					"aaSorting": [[ 10, "desc" ]],
					"bPaginate": false} );				
					$( "#allocate" )
			.button()
			.click(function() {
				  $('#myform').submit();

	
});	

			$('#countiesselect').change(function(){
				var value = $('#countiesselect').val();
//				alert(value);
				 window.location.href=value;

			});
									
			} );
			
			</script>
			<div id="inner_wrapper">
			<div class="leftpanel">
			<div style="width:20%;">
	<nav class="sidenav">
  <ul>
    <li class="orders_minibar"><a href="../allocations" style="
    margin: 0;  padding: 5%;  height: 15px;  border-top: #f0f0f0 1px solid;  background: #cccccc;  font: normal 1.3em 'Trebuchet MS',Arial,Sans-Serif;  text-decoration: none;  text-transform: uppercase;  background: #29527b;  border-radius: 0.5em;  color: #fff;
"><< Back</a></li>
        <!--<li class="orders_minibar"><a href="http://localhost/HCMP/rtk_management/rtk_orders">Pending
    <span style="
    font-weight: 400;
    font-size: 1.5em;
    color: #F3EA0B;
    float: right;
    background: rgb(216, 40, 40);
    padding: 4px;
    border-radius: 28px;
    border: solid 1px rgb(150, 98, 98);
">30</span>
</a> </li>-->
 
  </ul>
</nav></div></div>
 
<div class="dash_main" style="width: 80%;float: right;">
<table id="allocated" class="data-table"> 
<thead>
	
	<th>Facility</th>
	<th>MFL</th>
	<th>District</th>
	<th>Commodity</th>
	<th>Begining Balance</th>
	<th>Closing Balance</th>
	<th>Requested</th>
	<th>Allocated</th>
	<th>Action</th>	
 
</thead>
<?php
echo($tdata);
?>
</table></div>

</div>