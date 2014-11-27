
<script type="text/javascript">





	function showpreview(id)
{
//	for (initial=0;initial<22;initial++){}
//$("#view").click(function (){$("#overlay-preview").show(); });
//alert("Welcome " + name + ", the ");
    $.ajax({
    url:'<?php echo base_url();?>cd4_management/facility_allocate/'+id,
    data:name,
	success: function(result){
		$(".cd4-allocate").html(result);
		}});
}

</script>
<style type="text/css">
	.facility-list{
		list-style: none;
		font-size: 9px;
		font-family: verdana;

	}
	.facility-list a{

	}
	.facility-list ul {
		margin: 0 0 2px 8px;
	}
	.facility-list li a:active{
		background: #EEF1DF;
	}
	.facility-list li{
		border-left: solid 4px darkgreen;
		padding-left: 7px;
		margin-bottom: 1px
	}

	.facility-list li:hover{
		background: #EEF1DF;
	}

	.sub-list{
		list-style: none;
		font-size: 9px;
		font-family: verdana;

	}
	.sub-list li{
		border-left: solid 4px darkgreen;
		padding-left: 7px;
		margin-bottom: 1px
	}
</style>
 <div id="main_content">
 <div>
	<div style="float: left;position: relative;z-index: -100;background: #fff;">

		 <?php
		 echo'<h2 style="padding-left: 24px;">Facilities in '. $countyname.'</h2>';
	 echo $htm;
	 ?>

		
		
	</div>
	</div>
 
		
	<div class="cd4-allocate" style="width: 80%;
float: right;">

<?php //$this->load->view('cd4/ajax_view/initial_facility_allocate');?>

	</div>

	 
	
</div>