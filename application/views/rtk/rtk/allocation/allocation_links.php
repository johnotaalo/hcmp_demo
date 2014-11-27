<div id="tabs">	
	<a id="trend_tab" href="<?php echo base_url().'rtk_management/allocation_trend'; ?>" data-tab="1" class="tab">Reporting Rates</a>
	<a id="stocks_tab" href="<?php echo base_url().'rtk_management/allocation_stock_card'; ?>" data-tab="1" class="tab">National Stock Card</a>	
	<a id="allocations_tab" href="<?php echo base_url().'rtk_management/allocation_zone/a';?>" data-tab="1" class="tab">National Allocations</a>			
	<!--a id="allocations_tab" href="<?php echo base_url().'rtk_management/show_allocation_pending';?>" data-tab="1" class="tab">Pending Allocation</a-->			
	<a id="allocations_tab" href="<?php echo base_url().'rtk_management/new_non_reported_facilities';?>" data-tab="1" class="tab">Non-Reported Facilities</a>			
</div>


<style type="text/css">
	.tab {
		float: left;
		display: block;
		padding: 10px 20px;
		text-decoration: none;
		border-radius: 5px 5px 0 0;
		background: #F9F9F9;
		color: #777;		
	}
	#tabs a,#switch_tab a{		
		text-decoration: none;
		font-style: normal;		
	}
	#tabs a:hover,#switch_tab:hover{
		border-radius: 5px 5px 0 0;
		background: #CCCCCC;
	}
	.tab_switch {
		float: right;
		display: block;
		padding: 10px 20px;
		text-decoration: none;
		border-radius: 5px 5px 0 0;
		background: #F9F9F9;
		color: #777;
	}
	.drop-down{
		border-radius: 5px 5px 0 0;
		background: #CCCCCC;		
	}
	.drop-down ul li{
		display: none;		
		list-style-type: none;	
	}

	.drop-down ul li:hover > ul{
		display: block;
	}
	.active_tab{
		border-bottom: 4px solid #009933;
		float: left;
		display: block;
		padding: 10px 20px;
		text-decoration: none;
		border-radius: 5px 5px 0 0;
		background: #ECECEC;
		color: #777;		
	}

</style>
<script type="text/javascript">
	$(document).ready(function (){
		$('#go_county').hide();
		$('#counties').change(function (){
			var cid = $('#counties').val();
			if(cid==0){
				$('#go_county').hide();
			}else{
				$('#go_county').show();
			}			
		});
		$('#go_county').click(function (){
			var cid = $('#counties').val();
			url = "<?php echo base_url() . 'rtk_management/allocation_stock_card_county/'; ?>"+cid;			
			window.location = url;
		});
	});
</script>