<?php $facility=$this -> session -> userdata('news');?>

<script type="text/javascript">


$(function() {
	$( "#dialog" ).dialog({
			height: 140,
			modal: true
		});
	$(document).ready(function() {
		
		
	});	
	
	});

</script>
<div id="main_content">

	<div id="left_content">
		<fieldset>
			<legend>Action</legend>
	    
		<div class="activity issue">
		<a href="<?php echo site_url('Issues_main/Index/Internal/'.$facility);?>"><h2>Issue Commodities to Service Points</h2></a>
		</div>
			
		</fieldset>
		
		<?php if(isset($popout)){ ?><div id="dialog" title="System Message"><p><?php echo $popout;?></p></div><?php }?>
	</div>
	<div id="right_content">
		<fieldset>
			<legend>Action</legend>			
			<div class="activity ext">
		<a href="<?php echo site_url('Issues_main/Index/External/'.$facility);?>"><h2>Donate Commodities</h2></a>
		</div>	
		
	    
		<div class="activity ext">
		<a href="<?php echo site_url('Issues_main/Index/Donation/'.$facility)?>"><h2>Receive Donation From Other Sources</h2></a>
		</div>
      </fieldset>
	</div>

