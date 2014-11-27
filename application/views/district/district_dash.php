<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url(); ?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>

<script>
		$(document).ready(function(){
	        //$('.accordion').accordion({defaultOpen: ''});
         //custom animation for open/close
    $.fn.slideFadeToggle = function(speed, easing, callback) {
        return this.animate({opacity: 'toggle', height: 'toggle'}, speed, easing, callback);
    };
    $('.accordion').accordion({
        defaultOpen: 'section1',
        cookieName: 'nav',
        speed: 'medium',
        animateOpen: function (elem, opts) { //replace the standard slideUp with custom function
            elem.next().slideFadeToggle(opts.speed);
        },
        animateClose: function (elem, opts) { //replace the standard slideDown with custom function
            elem.next().slideFadeToggle(opts.speed);
        }
    });
    //default call
    var url = "<?php ////////
     echo base_url().'report_management/get_stock_status_ajax'?>"
		var div=".stockstatuschart";
		ajax_request (url,div);

		var url = "<?php echo base_url().'report_management/get_costofexpiries_chart_ajax'?>"
		var div=".cost_expirieschart";
		ajax_request (url,div);

		var url = "<?php echo base_url().'report_management/get_costoforders_chart_ajax'?>";
		var div=".cost_orderschart";
		ajax_request (url,div);

		var url = "<?php echo base_url().'report_management/get_consumption_trends_ajax' ?>	";
		var div=".consumptionchart";
		ajax_request (url,div);

		var url = "<?php echo base_url().'report_management/get_leadtime_chart_ajax'?>";
		var div=".lead_timechart";
		ajax_request (url,div);
		
		
       $('#facilities').change(function() {
       	var div="#stock_status";
		var url = "<?php echo base_url().'report_management/get_district_facility_stock_/'?>";	
		url=url+"bar2d_facility/"+$(this).val();
		ajax_request(url,div);
		});

        $('#desc').change(function() {
        var div="#stock_status";
		var url = "<?php echo base_url().'report_management/get_district_facility_stock_/'?>";	
		url=url+"bar2d_drug/"+$(this).val();
		ajax_request(url,div);
		});

		function ajax_request (url,div){
		var url =url;
		var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
		$.ajax({
		type: "POST",
		url: url,
		beforeSend: function() {
		$(div).html("");

		$(div).html("<img style='margin-left:20%;' src="+loading_icon+">");

		},
		success: function(msg) {
		$(div).html("");
		$(div).html(msg);
		}
		});
		}

		});
</script>


<style>
.right-content{
	width:70%;	
		display:inline-block;
		vertical-align:top;
		margin-bottom: 1%;
}
	.dash_container {
		width: 96%;
		margin: auto;
		padding-top:1%;
		margin-bottom: 5em;
	}
	
	.notifications_container{
		margin-top:2%;
		padding:3%;
		width:94%;
		border-radius:4px;
		
		
	}
	.statistics {
		width: 29%;
		height: 35em;
		display:inline-block;
		vertical-align:top;
		margin-right: 1.1em;
		margin-bottom: 1em;
		
	}
	.statistics h2, .stockstatus h2, .cost_expiries h2, .cost_orders h2, .consumption h2, .lead_time h2 {
		background: #29527B; /* Old browsers */
		color: #fff;
		padding: 10px;
		text-align: center;
		margin: 0 0 0.625em 0;
		-webkit-box-shadow:  0px 2px 6px 0.7px #000;
        box-shadow:  0px 2px 6px 0.7px #000;
        -moz-box-shadow:  0px 2px 6px 0.7px #000;
	}
	.stockstatus {

		width: 49%;
		height: 60em;
		float: left;
		margin-bottom: 1em;
	}
	.stockstatus_dropdown {
		height: auto;
		display: inline-block;
		padding-bottom: 0.5em;
		padding-top: 0.5em;
		margin-left:12em;
	}
	.drop {
		background: transparent;
		height: 2em;
		border: 1px solid #ccc;
		padding: 0.2em;
	}
	.stockstatuschart {

		width: 100%;
		display: inline-block;
	}

	.cost_expirieschart {
		width: 100%;
		margin: auto;
	}
	.cost_orders{
		
	}
	.cost_orders,.cost_expiries {
		float:right;
		display:inline-block;
		vertical-align:top;
		width: 49%;
		height: 35em;
		
	}
	.cost_orderschart {
		width: 100%;
	}
	.consumption {
		width: 49%;
		height: 40em;
		float: left;
		margin-right: 1.1em;
		
	}
	.consumptionchart {
		width: 100%;
	}
	.lead_time {
		width: 49%;
		height: 55em;
		float: left;
		margin-right: 1.1em;
		
	}
	.lead_timechart {
		width: 100%;
	}
	
</style>


<div class="dash_container">
<div class="statistics">
	<h2 style="margin-bottom: 1.5em">Statistics & Notification</h2>
	<div class="notifications_container">
		 
<?php echo $stats?>
			
	</div>
	
</div>
<div class="right-content">
<div class="stockstatus">
	<h2>Stock Status</h2>
	
	<div class="stockstatus_dropdown">
	<select id="desc" name="desc" class="drop">
    <option>Select Commodity Name</option>
		<?php 
		foreach ($drugs_array as $drugs) {
			$id=$drugs->id;
			$kemsa=$drugs->Kemsa_Code;
			$drug=$drugs->Drug_Name;
			?>
			<option value="<?php echo $id; ?>"><?php echo $drug; ?></option>
			
		<?php } ?>		
	</select>
		<select id="facilities" class="drop">
		<option>Select Facility</option>
		<?php 
		foreach ($facilities as $counties) {
			$id=$counties->facility_code;
			$county=$counties->facility_name;?>
			<option value="<?php echo $id; ?>"><?php echo $county; ?></option>
		<?php } ?>
	</select>
	
</div>
	<div class="stockstatuschart"  id="stock_status" style="height:100%;  overflow: auto;">
	
	
</div>
	
</div>


<div class="cost_expiries">
	<h2>Cost of Expiries</h2>
	<div class="cost_expirieschart">
	
	
</div>
</div>

<div class="cost_orders">
	<h2>Cost of orders</h2>
	<div class="cost_orderschart">
	
	
</div>
	
</div>	
</div>

<!--
<div class="consumption">
	<h2>Consumption Trends</h2>
	<div class="consumptionchart">
	
	
</div>
</div>

<div class="lead_time">
	<h2>Lead Time</h2>
	<div class="lead_timechart">
	
	
</div>
</div>
-->
</div>