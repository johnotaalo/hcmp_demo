<table>
	<tr>
	<td colspan="2"><p>The No. of Kits Used is based on the No. of Tests Done for that Month.</p></td>
	</tr>
	<tr>
	<th>&nbsp;</th>
	<th style="background-color:#e7e7e7"><div align="center">TAQMAN CONSUMPTION TREND</div></th>
	<th style="background-color:#e9e9e9"><div align="center">ABBOTT CONSUMPTION TREND</div></th>
	</tr>
	<tr>
	<th style="background-color:#e7e7e7">EID</th>
	<td>
	<div id="chartdiv" align="left"></div>
	  <script type="text/javascript">
	  	 if  ( FusionCharts( "myChartId1" ) )  FusionCharts( "myChartId1" ).dispose();	
		 var myChart = new FusionCharts("<?php echo base_url() ?>assets/FusionCharts/MSLine.swf", "myChartId1", "470", "450", "0", "0");
		 myChart.setDataURL("<?php echo base_url() ?>eid_management/consumption_trend/eid_taqmanprocurement/1");
		 myChart.render("chartdiv");
	  </script>		  
	</td>
	  <td>
	  <div id="chartdiv2" align="left"></div>
	  <script type="text/javascript">
	  	if  ( FusionCharts( "myChartId2" ) )  FusionCharts( "myChartId2" ).dispose();	
		 var myChart = new FusionCharts("<?php echo base_url() ?>assets/FusionCharts/MSLine.swf", "myChartId2", "470", "450", "0", "0");
		 myChart.setDataURL("<?php echo base_url() ?>eid_management/consumption_trend/eid_abbottprocurement/1");
		 myChart.render("chartdiv2");
	  </script>		  </td>
	  </tr>
	  <tr>
	<td colspan="3" style="color:#999999"><p align="center">* Click on the Lab Name on the above Key to either Add or Remove it from the graph.</p></td>
	</tr>
	<tr>
	<th style="background-color:#e7e7e7">VL</th>
	<td>
	<div id="chartdiv3" align="left"></div>
	  <script type="text/javascript">
	     if  ( FusionCharts( "myChartId3" ) )  FusionCharts( "myChartId3" ).dispose();	
		 var myChart = new FusionCharts("<?php echo base_url() ?>assets/FusionCharts/MSLine.swf", "myChartId3", "470", "450", "0", "0");
		 myChart.setDataURL("<?php echo base_url() ?>eid_management/consumption_trend/eid_taqmanprocurement/2");
		 myChart.render("chartdiv3");
	  </script>		  </td>
	  <td>
	  <div id="chartdiv4" align="left"></div>
	  <script type="text/javascript">
	     if  ( FusionCharts( "myChartId4" ) )  FusionCharts( "myChartId4" ).dispose();	
		 var myChart = new FusionCharts("<?php echo base_url() ?>assets/FusionCharts/MSLine.swf", "myChartId4", "470", "450", "0", "0");
		 myChart.setDataURL("<?php echo base_url() ?>eid_management/consumption_trend/eid_abbottprocurement/2");
		 myChart.render("chartdiv4");
	  </script>		  </td>
	  </tr>
	  <tr>
	<td colspan="3" style="color:#999999"><p align="center">* Click on the Lab Name on the above Key to either Add or Remove it from the graph.</p></td>
	</tr>
  </table>