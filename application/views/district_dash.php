<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
      
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
    </style>
 
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
    var url = "<?php echo base_url().'report_management/get_stock_status_ajax'?>"
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
		
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/HLinearGauge.swf"?>", "ChartId8", "100%", "20%", "0", "0");
    var url = '<?php echo base_url()."report_management/lead_time_chart_county"?>'; 
    chart.setDataURL(url);
    chart.render("chart9");
    
  var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/AngularGauge.swf"?>", "ChartId5", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/cummulative_fill_rate_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart8");
		
		
       $('#facilities').change(function() {
       	var div=".stockstatuschart";
		var url = "<?php echo base_url().'report_management/get_district_facility_stock_/'?>";	
		url=url+"bar2d_facility/"+$(this).val();
		ajax_request(url,div);
		});

        $('#desc').change(function() {
        var div=".stockstatuschart";
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

		$(div).html("<img src="+loading_icon+">");

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
  .dash_container {
		width: 100%;
		height:700px;
		margin-left: 1.1em;
		
	}
    .chart_content{
    margin:0 auto;
    width:100%;
    
  }
  .multiple_chart_content{
    float:left;
    width:33%; 
    height:22em; 
    padding:0.2em
    background-color:#0E90D2;
    
    
  }
  .multiple_chart_content h2 {
		background: #b6b6b6; /* Old browsers */
		padding: 5px;
		text-align: center;
		margin: 0 0 0.625em 0;
		border-right-style: inset;
		
	}
	.multiple_chart_content label{
		font-size:12px;
	}
  
</style>
  
<div class="dash_container">
	
	<div class="multiple_chart_content" style="height:44em;  overflow: scroll;" >
<h2 >Stock Status</h2>
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
	<div class="stockstatuschart"></div>
	</div>
	
	<div class="multiple_chart_content"  >
<h2 >Ordering Rate</h2>
<div id=""></div>
	</div>
	<div class="multiple_chart_content"  >
<h2 >Notifications</h2>
<div style="display: table-row;  ">
    			<div style="display: table-cell;padding-bottom: 2em; ">
      				<label style=" font-weight: ">Total No of Orders Placed </label>
            			    				</div>
    				<div style="display: table-cell;padding-bottom: 2em">
      				<a class="link" href="#" >14</a>
    				</div>
  				</div>
  				
  				<div style="display: table-row; ">
    			<div style="display: table-cell;padding-bottom: 2em">
      				<label style="font-weight: ">Total Value of Orders Placed </label>
            		</div>
    				<div style="display: table-cell;padding-bottom: 2em">
      				<a class="link" href="#" >1,221,001</a>
    				</div>
  				</div>
  				
  				<div style="display: table-row;">
    			<div style="display: table-cell; padding-bottom: 2em">
      				<label style="font-weight: ">Total District Drawing Rights Bal (2013/2014)</label>
            		     				</div>
    				<div style="display: table-cell;padding-bottom: 2em">
      				<a class="link" href="#" >6,000,000</a>
    				</div>
  				</div>
  				
  				
  				
  				
	</div>
	
	
	<div class="multiple_chart_content"   >
<h2 >Cost of Orders</h2>
<div class="cost_orderschart"></div>
</div>
	
	<div class="multiple_chart_content"  >
<h2 >Allocated Drawing rights/Drawing rights Bal</h2>
<div id=""></div>
</div>


	<div class="multiple_chart_content"  >
<h2 >Cost of Expired commodities</h2>
<div class="cost_expirieschart"></div>
</div>
	
	<div class="multiple_chart_content"  >
		<h2 >Cummulative Order Fill rate</h2>
		<div id="chart8"></div>

</div>
	
	<div class="multiple_chart_content" style="height:60em">
	<h2>Order Lead Time</h2>
	<table width="100%" height="60" style="font-size:small">
		<tr>
		<td> Key</td>
		<td><div class="success">Order - Approval</div></td>
		<td><div style="background-color: #FFF6BF;"><font>Approval-Delivery</font></div></td>
		<td><div style="background-color:#FF4545"><font>Delivery-Update</font></div></td>
		<td><div style="background-color:#000000" ><font color="white">Turn Around Time	</font></div></td></tr>
	
		</table>

	<div id="chart9" ></div>
	</div>
  
 
 </div> 
 

  
  
            
 
 