<div id="tabs">
	<a id="losses" href="<?php echo base_url().'rtk_management/partner_stock_status'; ?>" data-tab="1" class="tab">Losses</a>
	<a id="expiries" href="<?php echo base_url().'rtk_management/partner_stock_status_expiries'; ?>" data-tab="2" class="tab">Expiries</a>
	<a id="stock_level" href="<?php echo base_url().'rtk_management/partner_stock_level'; ?>" data-tab="1" class="tab">Stock Level</a>
	<a id="stock_card" href="<?php echo base_url().'rtk_management/partner_stock_card'; ?>" data-tab="2" class="tab">Stock Card</a>
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
