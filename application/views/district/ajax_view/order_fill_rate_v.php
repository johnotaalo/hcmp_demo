<?php      
      //We have included ../Includes/FusionCharts.php, which contains functions
      include("Scripts/FusionWidgets/FusionCharts.php");
      echo renderChart("".base_url()."Scripts/FusionWidgets/Charts/AngularGauge.swf", "", $strXML, "test", "350", "200");
      //"Scripts/FusionWidgets/AngularGauge.swf", "ChartId", "350", "200", "0", "0"
      ?>
