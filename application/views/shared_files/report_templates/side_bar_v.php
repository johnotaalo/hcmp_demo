<div class="panel-group " id="accordion" style="padding: 0;">
    <div class="panel panel-default <?php echo $active_panel=='expiries'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseone" id="expiries" ><span class="glyphicon glyphicon-trash">
                </span>Expiries</a>
            </h4>
        </div>
        <div id="collapseone" class="panel-collapse collapse <?php echo $active_panel=='expiries'? 'in': null; ?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <a href="<?php echo base_url().'reports' ?>">Potential Expiries</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo base_url().'reports/expiries' ?>">Expired</a> <span class="label label-info"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <a href="<?php echo base_url().'reports/expiry_tracking' ?>">Expiry Tracking</a> <span class="label label-info"></span>
                        </td>
                    </tr>

                </table>

            </div>
        </div>
    </div>
    <div class="panel panel-default <?php echo $active_panel=='stocking_levels'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-parent="#accordion" id="stocking_levels" href="<?php echo base_url().'reports/facility_stock_level_dashboard'?>"><span class="glyphicon glyphicon-sort-by-attributes">
                </span>Stocking Levels</a>
            </h4>
        </div>
     
    </div>
    <!--<div class="panel panel-default <?php echo $active_panel=='orders'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a  data-parent="#accordion" id="orders" href="<?php echo base_url("reports/order_report"); ?>"><span class="glyphicon glyphicon-list-alt">
                </span>Orders</a>
            </h4>
        </div>
    </div>-->
    <div class="panel panel-default <?php echo $active_panel=='consumption'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a  data-parent="#accordion" id="consumption" href="<?php echo base_url("reports/consumption"); ?>"><span class="glyphicon glyphicon-bookmark">
                </span>Consumption</a>
            </h4>
        </div>
    </div>
    <!--Divisional Reports Accordion-->
  
    <!--<div class="panel panel-default <?php echo $active_panel=='statistics'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour" id="facility_statistics"><span class="glyphicon glyphicon-screenshot">
                </span>Facility Statistics</a>
            </h4>
        </div>
        <div id="collapseFour" class="panel-collapse collapse <?php echo $active_panel=='statistics'? 'in': null; ?>">
            <div class="panel-body">
                <table class="table">
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/order_report'?>" >Orders</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/consumption'?>" >Consumption</a>
                        </td>
                    </tr>
                    
               </table>
            </div>
        </div>
    </div>-->
    <!--<div class="panel panel-default <?php echo $active_panel=='other'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a data-toggle="collapse" data-parent="#accordion" href="#collapseFive" id="other_reports"><span class="glyphicon glyphicon-file">
                </span>Other Reports</a>
            </h4>
        </div>
        <div id="collapseFive" class="panel-collapse collapse <?php echo $active_panel=='other'? 'in': null; ?>">
            <div class="panel-body">
                <table class="table">
                  	 <tr>
                        <td>
                            <span class="glyphicon ">
                            </span><a href="<?php echo base_url().'reports/stock_control' ?>">Stock Control Card</a>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/get_sub_county_facility_mapping_data'?>" >User Statistics</a>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <span class="glyphicon"></span><a href="<?php echo base_url().'reports/facility_stock_level_dashboard'?>" >Stocking Levels</a>
                        </td>
                    </tr>
                    
                </table>
            </div>
        </div>
        
    </div>-->
    <div class="panel panel-default <?php echo $active_panel=='stock_control_card'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a  data-parent="#accordion" id="stock_control_card" href="<?php echo base_url("reports/stock_control"); ?>"><span class="glyphicon glyphicon-calendar">
                </span>Stock Control Card</a>
            </h4>
        </div>
    </div>
    <div class="panel panel-default <?php echo $active_panel=='system_usage'? 'active-panel': null; ?>">
        <div class="panel-heading">
            <h4 class="panel-title">
                <a  data-parent="#accordion" id="system_usage" href="<?php echo base_url("reports/get_sub_county_facility_mapping_data"); ?>"><span class="glyphicon glyphicon-sort">
                </span>System Usage</a>
            </h4>
        </div>
    </div>
    
</div>

<script>

	$(document).ready(function() 
	{
		$("#expiries").on('click', function(){
			active_panel(this);
			});
			
		$("#divisional_reports").on('click', function(){
			active_panel(this);
			});	
		$("#stocking_levels").on('click', function(){
			active_panel(this);
			});	
		$("#consumption").on('click', function(){
			active_panel(this);
			});		
		$("#system_usage").on('click', function(){
			active_panel(this);
			});	
		$("#facility_statistics").on('click', function(){
			active_panel(this);
			});	
			
		$("#other_reports").on('click', function(){
			active_panel(this);
			});
	});
</script>
