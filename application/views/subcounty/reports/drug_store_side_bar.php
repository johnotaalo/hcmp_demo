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
                            <a href="<?php echo base_url().'issues/store_home' ?>">Back to Home</a> <span class="label label-info"></span>
                        </td>
                    </tr>
                </table>

            </div>
        </div>
    </div>
    <!--Divisional Reports Accordion-->
    
</div>

<script>

	$(document).ready(function() 
	{
		$("#expiries").on('click', function(){
			//$('.page-header').html('Expiries');
			active_panel(this);
			//ajax_request_replace_div_content('reports/expiries_dashboard',"#notification");
			});
			
		$("#divisional_reports").on('click', function(){
			//$('.page-header').html('Expiries');
			active_panel(this);
			
			//ajax_request_replace_div_content('reports/expiries_dashboard',"#notification");
			});	
			
		$("#facility_statistics").on('click', function(){
			//$('.page-header').html('Expiries');
			active_panel(this);
			//ajax_request_replace_div_content('reports/expiries_dashboard',"#notification");
			});	
			
		$("#other_reports").on('click', function(){
			//$('.page-header').html('Expiries');
			active_panel(this);
			//ajax_request_replace_div_content('reports/expiries_dashboard',"#notification");
			});
	});
</script>