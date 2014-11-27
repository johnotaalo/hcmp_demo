<SCRIPT LANGUAGE="Javascript" SRC="<?php echo base_url();?>Scripts/FusionCharts/FusionCharts.js"></SCRIPT>
<script type="text/javascript" language="javascript" src="<?php echo base_url(); ?>Scripts/jquery.dataTables.js"></script>
    <style type="text/css" title="currentStyle">
      
      @import "<?php echo base_url(); ?>DataTables-1.9.3 /media/css/jquery.dataTables.css";
    </style>
 
    <style>

      .warning2 {
  background: #FEFFC8 url('<?php echo base_url()?>Images/excel-icon.jpg') 20px 50% no-repeat;
  border: 1px solid #F1AA2D;
  }
    </style>

    <script type="text/javascript" charset="utf-8">
      
      $(document).ready(function() {
      	//ajax reuest for the graphs
        var url = "<?php echo base_url()."report_management/get_stock_status_ajax/ajax-request_county"?>";			
		var div="#chart3";
		
		ajax_request(url,div);
		
		var url = "<?php echo base_url().'report_management/get_costofexpiries_chart_ajax/county/'?>"
		var div="#chart2";
		
		ajax_request (url,div);
		
		
		$('#desc').change(function() {
         var div="#chart3";
		var url = "<?php echo base_url()."report_management/get_stock_status_ajax/ajax-request_county"?>";		
		url=url+"/"+$(this).val();
		
		if($(this).val() =='default') {
			return;	
		}else{
		ajax_request (url,div)
		}
		
		
		});
		
		
		function ajax_request (url,div){
	var url =url;
	var loading_icon="<?php echo base_url().'Images/loader.gif' ?>";
	 $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $(div).html("");
            
             $(div).html("<img style='margin-top:-10%;' src="+loading_icon+">");
            
          },
          success: function(msg) {
          $(div).html("");
            $(div).html(msg);           
          }
        }); 
}
    
  
     
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "80%", "0", "0" );
    var url = '<?php echo base_url()."report_management/expired_commodities_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart1");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId3", "100%", "70%", "0", "0");
    var url = '<?php echo base_url()."report_management/orders_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart4");

      var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId4", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/generate_costofordered_County_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart5");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/AngularGauge.swf"?>", "ChartId5", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/cummulative_fill_rate_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart6");


     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/StackedColumn2D.swf"?>", "ChartId6", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/district_drawing_rights_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart7");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Pie3D.swf"?>", "ChartId7", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/orders_placed_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart8");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/HLinearGauge.swf"?>", "ChartId8", "100%", "20%", "0", "0");
    var url = '<?php echo base_url()."report_management/lead_time_chart_county"?>'; 
    chart.setDataURL(url);
    chart.render("chart9");
    
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/StackedColumn2D.swf"?>", "ChartId9", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/get_county_ordering_rate_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart10");
    
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/MSColumn2D.swf"?>", "ChartId10", "100%", "80%", "0", "0");
    var url = '<?php echo base_url()."report_management/get_county_drawing_rights_data"?>'; 
    chart.setDataURL(url);
    chart.render("chart11");


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
<select id="desc" name="desc" class="drop">
      <option value="default">Select</option>
      <option value="r_h">Reproductive Health</option>
      <option value="malaria">Malaria</option>
      <option value="all">All Commodities</option>
			
	</select>
<div id="chart3"></div>
	</div>
	
	<div class="multiple_chart_content"  >
<h2 >Ordering Rate</h2>
<div id="chart10"></div>
	</div>
	<div class="multiple_chart_content" style="">
<h2 >Notifications</h2>
	<?php echo $stats; ////// ?>			
			
	</div>
	
	
	<div class="multiple_chart_content"   >
<h2 >Cost of Orders</h2>
<div id="chart5"></div>
</div>
	
	<div class="multiple_chart_content"  >
<h2 >Allocated Drawing rights/Drawing rights Bal</h2>
<div id="chart11"></div>
</div>


	<div class="multiple_chart_content"  >
<h2 >Cost of Expired commodities</h2>
<div id="chart2"></div>
</div>
	
	<div class="multiple_chart_content"  >
		<h2 >Cummulative Order Fill rate</h2>
		<div id="chart6"></div>

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

	<div id="chart9" >
		
	</div>
	</div>
  
 
 </div> 
 

  
  
            
 
 