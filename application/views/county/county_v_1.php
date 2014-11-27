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
        /* Build the DataTable with third column using our custom sort functions */
        $('#example_main').dataTable( {
          "bJQueryUI": true,
          "bPaginate": false
        } );
  
    
    
    
    
            $(".ajax_call_1").click(function(){
              var id  = $(this).attr("id"); 
              
              if(id=="county_facility"){
                
                             var url= $(this).attr("name"); 
    
                         ajax_request_special (url);
                      return;
                        }
  
  });
    function ajax_request_special (url){
  var url =url;
   $.ajax({
          type: "POST",
          url: url,
          beforeSend: function() {
            $("#pop_up").html("");
          },
          success: function(msg) {
  
          
          $('#dialog').html(msg);
         $( "#dialog" ).dialog({
      height: 650,
      width:900,
      modal: true
    });
          }
        }); 
}
    
  
     
    var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>","ChartId", "100%", "50%", "0", "1" );
    var url = '<?php echo base_url()."report_management/expired_commodities_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart1");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/cost_of_expired_commodities_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart2");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Bar2D.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/stock_status_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart3");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/orders_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart4");

      var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Line.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/cost_of_ordered_commodities_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart5");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/AngularGauge.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/cummulative_fill_rate_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart6");


     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/StackedColumn2D.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/district_drawing_rights_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart7");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionCharts/Pie3D.swf"?>", "ChartId", "100%", "50%", "0", "0");
    var url = '<?php echo base_url()."report_management/orders_placed_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart8");

     var chart = new FusionCharts("<?php echo base_url()."scripts/FusionWidgets/HLinearGauge.swf"?>", "ChartId", "100%", "20%", "0", "0");
    var url = '<?php echo base_url()."report_management/lead_time_chart"?>'; 
    chart.setDataURL(url);
    chart.render("chart9");

    
  
  
      $( "#filter-b" )
      .button()
      .click(function() {
        
}); 

  });
  </script>
  <style>
  .chart_content{
    margin:0 auto;
    width:100%;
    
  }
  .multiple_chart_content{
    float:left;
    box-shadow: 0 0 5px #888888;
    border-radius: 5px;
    width:33%; 
    height:60%; 
    padding:0.2em
    
    
  }
  .div{
  
    margin-left:50px;
  }
</style>
  <div class="chart_content" style="width:auto;">
    <div class="div"><div class="multiple_chart_content" style="" id="chart1"></div></div>
    <div class="div"><div class="multiple_chart_content"  id="chart2"></div></div>
    <div class="div"><div class="multiple_chart_content"  id="chart3"></div></div>
  
   <div class="div"><div class="multiple_chart_content"   id="chart4"></div></div>
   <div class="div"><div class="multiple_chart_content"   id="chart5"></div></div>
    <div class="div"><div class="multiple_chart_content"  id="chart7"></div></div>
    
   <div class="div"><div class="multiple_chart_content"  id="chart6"></div></div>
  <div class="div"><div class="multiple_chart_content"  id="chart8"></div></div>
  <div class="div"><div class="multiple_chart_content"   id="chart9"></div></div>
  </div>
 
  
 

  
  
            
 
 